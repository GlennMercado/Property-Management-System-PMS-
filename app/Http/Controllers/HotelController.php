<?php

namespace App\Http\Controllers;

use App\Models\hotel_reservations;
use App\Models\housekeepings;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hotel_reservation_form()
    {
        $list = DB::select('SELECT * FROM hotel_reservations');
		$room = DB::select('SELECT * FROM novadeci_suites');    
        return view('Admin.pages.Reservations.HotelReservationForm', ['list'=>$list, 'room'=>$room]);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Available alpha caracters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];

        // shuffle the result
        $randID = str_shuffle($pin);

        
        $this->validate($request,[
            'checkIn' => 'required',
            'checkOut' => 'required',
            'gName' => 'required',
            'mobile' => 'required',
            'room_no' => 'required',
            'pax' => 'required'
        ]);

        $paystats = "Paid";
        $status;

        $chckin = $request->input('checkIn');

        $chckin = date('Y-m-d');
        $datenow = now()->format('Y-m-d');

        if($chckin == $datenow)
        {
            $status = "Occupied";
        }
        elseif($chckin > $datenow)
        {
            $status = "Reserved";
        }
        
        $reserve = new hotel_reservations;
        $roomno = $request->input('room_no');

        $reserve->Booking_No = $randID;
        $reserve->Check_In_Date = $request->input('checkIn');
        $reserve->Check_Out_Date = $request->input('checkOut');
        $reserve->Guest_Name = $request->input('gName');
        $reserve->Mobile_Num = $request->input('mobile');
        $reserve->No_of_Pax = $request->input('pax');
        $reserve->Room_No = $roomno;
        $reserve->Payment_Status = $paystats;
        $reserve->Booking_Status = $status;

        if($reserve->save())
        {
            $facility = "Hotel Room";
            DB::table('novadeci_suites')->where('Room_No', $roomno)->update(array('Status' => $status));

            DB::insert('insert into housekeepings (Room_No, Booking_No, Facility_Type, Facility_Status, Front_Desk_Status, Check_In_Date, Check_Out_Date) 
            values (?, ?, ?, ?, ?, ?, ?)', [$roomno, $randID, $facility, $status, $status, $request->input('checkIn'), $request->input('checkOut')]);
            
            Alert::Success('Success', 'Reservation was successfully submitted!');
            return redirect('HotelReservationForm')->with('Success', 'Data Saved');
        }
        else
        {
            Alert::Error('Error', 'Reservation Failed!');
            return redirect('HotelReservationForm')->with('Error', 'Failed!');
        }

        
    }

    public function update_payment($id, $no, $check)
    {
        $bookno = $id;
        $roomno = $no;
        $isarchived = $check;

        $stats = "Paid";
        $stats2 = "Reserved";

        if($isarchived == true)
        {
            $check = DB::select("SELECT * FROM novadeci_suites WHERE Room_No = '$roomno' AND Status = 'Vacant for Accommodation'");
        
            if($check)
            {
                DB::table('hotel_reservations')->where('Booking_No', $bookno)->update(array('Payment_Status' => $stats, 'Booking_Status' => $stats2));
                DB::table('novadeci_suites')->where('Room_No', $roomno)->update(array('Status' => $stats2));
        
                Alert::Success('Success', 'Reservation successfully updated!');
                return redirect('HotelReservationForm')->with('Success', 'Data Saved');
            }
            else
            {
                Alert::Error('Failed', 'Room is already reserved!');
                return redirect('HotelReservationForm')->with('Success', 'Data Saved');
            }
        }
        else
        {
            Alert::Error('Failed', 'Reservation is not available!');
            return redirect('HotelReservationForm')->with('Success', 'Data Saved');
        }    
    }

    public function update_booking_status($id, $no, $check, $stats)
    {
            $bookno = $id;
            $roomno = $no;
            $isarchived = $check;
            
            $status = $stats;
            
            if($status == "Checked-In")
            {
                if($isarchived == false)
                {
                    $roomstats = "Occupied";
                    DB::table('hotel_reservations')->where('Booking_No', $bookno)->update(array('Booking_Status' => $status));
                    DB::table('novadeci_suites')->where('Room_No', $roomno)->update(array('Status' => $roomstats));
    
                    Alert::Success('Success', 'Reservation successfully updated!');
                    return redirect('HotelReservationForm')->with('Success', 'Data Saved');
                }
                else
                {
                    Alert::Error('Error', 'Reservation is not available!');
                    return redirect('HotelReservationForm')->with('Success', 'Data Updated');
                }
            }
            if($status == "Checked-Out")
            {
                if($isarchived == false)
                {
                    $hstatus = "Out of Service";
                    $roomstats = "Vacant for Cleaning";
                    DB::table('hotel_reservations')->where('Booking_No', $bookno)->update(array(
                        'Booking_Status' => $status,
                        'isarchived' => true
                    ));
                    DB::table('novadeci_suites')->where('Room_No', $roomno)->update(array('Status' => $roomstats));
                    DB::table('housekeepings')->where('Room_No', $roomno)->update(array('Housekeeping_Status' => $hstatus));


                    Alert::Success('Success', 'Reservation successfully updated!');
                    return redirect('HotelReservationForm')->with('Success', 'Data Saved');
                }
                else
                {
                    Alert::Error('Error', 'Reservation is not available!');
                    return redirect('HotelReservationForm')->with('Success', 'Data Updated');
                }
            }
            
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
