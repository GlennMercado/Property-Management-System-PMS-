<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\hotel_reservations;
use App\Models\convention_center_application;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function welcome()
    {
       
        
        return view('Guest.guest_welcome');
    }
    public function about_us()
    {
        return view('Guest.AboutUs');
    }
    public function contact_us()
    {
        return view('Guest.ContactUs');
    }
    public function map()
    {
        return view('Guest.Map');
    }
    public function guest_profile()
    {
        return view('Guest.guestedit');
    }
    public function guest_event()
    {
        return view('Guest.guest_event');
    }
    public function guest_commercial()
    {
        return view('Guest.guest_commercial_space');
    }
    public function suites()
    {
        $email = Auth::user()->email;
        $list = DB::select('SELECT * FROM hotel_reservations');
	    $room = DB::select('SELECT * FROM novadeci_suites');
        $guest = DB::select("SELECT * FROM users WHERE email = '$email'");
        
        return view('Guest.suites', ['list'=>$list, 'room'=>$room, 'guest'=>$guest]);
    }
    public function convention_center()
    {
        return view('Guest.convention_center');
    }
    public function function_room()
    {
        return view('Guest.function_room');
    }
    public function commercial_spaces()
    {
        return view('Guest.commercial_spaces');
    }
    public function event_form()
    {
        return view('Guest.event_form');
    }
    
    public function guest_reservation(Request $request)
    {
        $email = Auth::user()->email;

        $check = DB::select("SELECT * FROM hotel_reservations WHERE Email = '$email'");

        if($check)
        {
            Alert::Error('Failed', 'You have already booked a hotel reservation!');
            return redirect('/welcome')->with('Error', 'Failed');
        }
        else
        {
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
            

            $reserve = new hotel_reservations;

            $reserve->Booking_No = $randID;
            $reserve->Email = $email;
            $reserve->Check_In_Date = $request->input('checkIn');
            $reserve->Check_Out_Date = $request->input('checkOut');
            $reserve->Guest_Name = $request->input('gName');
            $reserve->Mobile_Num = $request->input('mobile');
            $reserve->No_of_Pax = $request->input('pax');
            $reserve->Room_No = $request->input('room_no');

            if($reserve->save())
            {
                Alert::Success('Success', 'Reservation was successfully submitted!');
                return redirect('/welcome')->with('Success', 'Data Saved');
            }
            else
            {
                Alert::Error('Error', 'Reservation Failed!');
                return redirect('/welcome')->with('Error', 'Failed!');
            }
        }
    }
    public function convention_center_application(Request $request)
    {         
            $this->validate($request,[
                'client_name' => 'required',
                'contact_no' => 'required',
                'contact_person' => 'required',
                'contact_person_no' => 'required',
                'billing_address' => 'required',
                'email_address' => 'required',
                'event_name' => 'required',
                'event_type' => 'required',
                'event_date' => 'required',
                'no_of_guest' => 'required'
            ]);
            
            $submit = new convention_center_application;
            $submit->client_name = $request->input('client_name');
            $submit->contact_no = $request->input('contact_no');
            $submit->contact_person = $request->input('contact_person');
            $submit->contact_person_no = $request->input('contact_person_no');
            $submit->billing_address = $request->input('billing_address');
            $submit->email_address = $request->input('email_address');
            $submit->event_name = $request->input('event_name');
            $submit->event_type = $request->input('event_type');
            $submit->event_date = $request->input('event_date');
            $submit->no_of_guest = $request->input('no_of_guest');


            if($submit->save())
            {
                Alert::Success('Success', 'Inquiry was sent successfully submitted!');
                return redirect('/convention_center')->with('Success', 'Data Saved');
            }
            else
            {
                Alert::Error('Failed', 'Inquiry was not sent');
                return redirect('/convention_center')->with('Error', 'Failed!');
            }
    }



}
