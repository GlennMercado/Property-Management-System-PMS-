<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hotelstocks;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Models\hotel_room_supplies;
use App\Models\hotel_room_linen;
use App\Models\hotel_room_supplies_reports;
use App\Models\hotel_room_linens_reports;
use App\Models\stockhistories;
use Carbon\Carbon;
use PDF;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function StockHotel()
    {


       //Hotel Inventory
		
		$list = DB::select('SELECT * FROM hotelstocks');
		$check = DB::select('SELECT COUNT(*) as cnt FROM hotelstocks');
		$count = array();

        $list2 = DB::select('SELECT * FROM novadeci_suites');
        $check2 = DB::select('SELECT * FROM novadeci_suites');
		$count2 = array();
        $list3 = DB::select('SELECT * FROM stockhistories');

		foreach($check as $checks)
		{
			$count[] = ['counts' => $checks->cnt];
		}

        foreach($check2 as $checks2)
		{
			$count2[] = ['Room_No' => $checks2->Room_No];
		}
		

		return view('Admin.pages.Inventory.StockCount', ['list'=>$list, 'count' => $count, 'count2'=>$count2, 'list3'=>$list3]);
	
    
    }

    public function StockReport()
    {
       //Hotel Reports

        $datenow = Carbon::now();

        $list2 = hotel_room_supplies_reports::select("*")->whereDate('Date_Received', '=', $datenow)->get();

        $list = hotel_room_linens_reports::select("*")->whereDate('Date_Received', '=', $datenow)->get();

        return view('Admin.pages.Inventory.StockReports', ['list'=>$list, 'list2'=>$list2]);
	
    }

    public function StockDistribute()
    {
       //Hotel Reports
        $sql = DB::select("SELECT * FROM hotel_room_linens WHERE Status = 'Received'");
        $sql = DB::select("SELECT * FROM hotel_room_supplies WHERE Status = 'Received'");
        $list = DB::select('SELECT * FROM hotel_room_linens');
        $list2 = DB::select('SELECT * FROM hotel_room_supplies');


	if($sql){
        return view('Admin.pages.Inventory.StockRoomSupply', ['list'=>$list, 'list2'=>$list2]);
    }
    }

    public function Stock_history_report()
    {
        $start_date = Carbon::parse(request('start_date'))->format('Y-m-d');
        $end_date = Carbon::parse(request('end_date'))->format('Y-m-d');
        $data;
        $title;

        $data = stockhistories::where('Stock', '1')->whereBetween('created_at', [$start_date, $end_date])->get();
            $title = "Stock History Report";

        $pdf = PDF::loadView('Admin.pages.Inventory.HistoryReport', compact('data', 'title'))->setOption('font_path', '')->setOption('font_data', []);
        // return $pdf->download('report.pdf');
        return view('Admin.pages.Inventory.HistoryReport', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_stock_room(Request $request)
    {
        $roomno = $request->input('roomno');
        $prodid = $request->input('id');
        $category = $request->input('category');
        $name = $request->input('name');
        $quan = $request->input('quantity');
        $stock = '1';
        $in = '0';
        $sql = DB::select("SELECT * FROM hotelstocks WHERE productid = '$prodid'");
        $sql2 = DB::select("SELECT * FROM hotel_room_supplies WHERE Room_No = '$roomno' AND productid = '$prodid'");
        $sql3 = DB::select("SELECT * FROM hotel_room_linens WHERE Room_No = '$roomno' AND productid = '$prodid'");
        $quantity;
    

        if($category == "Linen")
        {
            if($sql3)
            {
                Alert::Error('Error', 'Item already exist!');
                return redirect('StockCount')->with('Success', 'Data Updated');
            }
            else
            {
                foreach($sql as $lists)
                {
                    if($lists->total < $request->input('quantity'))
                    {
                        Alert::Error('Error', 'The requested quantity exceeds the available stock!');
                        return redirect('StockCount')->with('Success', 'Data Updated');
                    }
                    else
                    {
                        $quantity = $lists->total - $request->input('quantity');
                    }
                }
    
                $datenow = Carbon::now();
                Carbon::createFromFormat('Y-m-d H:i:s', $datenow);
    
                $supply = new hotel_room_linen;
    
                $supply->Room_No = $roomno;
                $supply->productid = $prodid;
                $supply->name = $request->input('name');
                $supply->Category = $category;
                $supply->Quantity = $request->input('quantity');
                $supply->Date_Received = $datenow;
                $supply->Price = $request->input('price');
    
                if($supply->save())
                {
                    DB::table('hotelstocks')->where('productid', $prodid)->update(['total' => $quantity]);

                    DB::table('stockhistories')->insert(array(
                        'name'=>$name,
                        'category'=>$category,
                        'Stock_In'=>$in,
                        'Stock_Out'=>$quan,
                        'Quantity'=>$quantity,
                        'Stock'=>$stock,
                        'created_at'=>now()
                    ));
        
                    Alert::Success('Success', 'Successfully added to room!');
                    return redirect('StockCount')->with('Success', 'Data Updated');
                }
                else
                {
                    Alert::Error('Error', 'Failed Adding to Room!');
                    return redirect('StockCount')->with('Success', 'Data Updated');
                }
            }
        }
        elseif($category == "Guest Supply")
        {
            if($sql2)
            {
                Alert::Error('Error', 'Item already exist!');
                return redirect('StockCount')->with('Success', 'Data Updated');
            }
            else
            {
                foreach($sql as $lists)
                {
                    if($lists->total < $request->input('quantity'))
                    {
                        Alert::Error('Error', 'The requested quantity exceeds the available stock!');
                        return redirect('StockCount')->with('Success', 'Data Updated');
                    }
                    else
                    {
                        $quantity = $lists->total - $request->input('quantity');
                    }
                }
    
                $datenow = Carbon::now();
                Carbon::createFromFormat('Y-m-d H:i:s', $datenow);
    
                $supply = new hotel_room_supplies;
    
                $supply->Room_No = $roomno;
                $supply->productid = $prodid;
                $supply->name = $request->input('name');
                $supply->Category = $category;
                $supply->Quantity = $request->input('quantity');
                $supply->Date_Received = $datenow;
                $supply->Price = $request->input('price');
    
                if($supply->save())
                {
                    DB::table('hotelstocks')->where('productid', $prodid)->update(['total' => $quantity]);

                    DB::table('stockhistories')->insert(array(
                        'name'=>$name,
                        'category'=>$category,
                        'Stock_In'=>$in,
                        'Stock_Out'=>$quan,
                        'Quantity'=>$quantity,
                        'Stock'=>$stock,
                        'created_at'=>now()
                    ));
    
                    Alert::Success('Success', 'Successfully Added to Room!');
                    return redirect('StockCount')->with('Success', 'Data Updated');
                }
                else
                {
                    Alert::Error('Error', 'Failed Adding Room!');
                    return redirect('StockCount')->with('Success', 'Data Updated');
                }
            }
        }
        
    }

    public function received_supply(Request $request)
    {
        //
        $roomno = $request->input('roomno');
        $prodid = $request->input('id');
        $category = $request->input('category');
        $sql = DB::select("SELECT * FROM hotelstocks WHERE productid = '$prodid'");
        $sql2 = DB::select("SELECT * FROM hotel_room_supplies WHERE Room_No = '$roomno' AND productid = '$prodid'");
        $sql3 = DB::select("SELECT * FROM hotel_room_linens WHERE Room_No = '$roomno' AND productid = '$prodid'");
        $quantity;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addstock(Request $request)
    {
       //dd($request->all());
        $this->validate($request,[
            'productid' => 'required',
            'category' => 'required',
            'Linens' => 'required',
            'GuestSupplies' => 'required',
            'Amenities' => 'required',
            'description' => 'required',
            'allstock' => 'required',
            'quantity' => 'required',
            'stock' => 'required',
            'price' => 'required'
       ]);

       $stock = new hotelstocks;

       $stock->productid = $request->input('productid');

       $category = $request->input('category');
       $name;

       if($category == 'Linen')
        {
            $name = $request->input('Linens');
        }
        elseif($category == 'Guest Supply')
        {
            $name = $request->input('GuestSupplies');
        }
        elseif($category == 'Amenities')
        {
            $name = $request->input('Amenities');
        }

        

       $stock->description = $request->input('description');
       $stock->allstock = $request->input('allstock');
       $stock->total = $request->input('quantity');
       $stock->Stock_Level = $request->input('stock');
       $stock->category = $request->input('category');
       $stock->name = $name;
       $stock->price = $request->input('price');

       $sql = DB::select("SELECT * FROM hotelstocks WHERE name = '$name'");

    if($sql)
    {
        Alert::Error('Error', 'Stock Already Exist!');
        return redirect('StockCount')->with('Success', 'Failed');
    }
    else
    {
       if($stock->save())
        {
            Alert::Success('Success', 'Stock Successfully Added!');
            return redirect('StockCount')->with('Success', 'Data Saved');
        }
        else
        {
            Alert::Error('Error', 'Stock Submission Failed!, Please Try again.');
            return redirect('StockCount')->with('Error', 'Failed!');
        }
    }
    }


    public function edit_stock(Request $request)
    {
        try
        {
            $this->validate($request,[
                'productid' => 'required',
                'name' => 'required',
                'quantity' => 'required',
                'in' => 'required',
                'category' => 'required'
            ]);
            
            $productid = $request->input('productid');
            $name = $request->input('name');
            $total = $request->input('quantity');
            $in = $request->input('in');
            $category = $request->input('category');
            $out = 0;
            $stock = '1'; 

            if($in > 0)
            {
                $total = $total + $in;

            }

           
            DB::table('stockhistories')->insert(array(
                'name'=>$name,
                'category'=>$category,
                'Stock_In'=>$in,
                'Stock_Out'=>$out,
                'Quantity'=>$total,
                'Stock'=>$stock,
                'created_at'=>now()
            ));
           
           DB::table('hotelstocks')->where('productid', $productid)->update(array
            (
                'productid' => $productid,
                'name' => $name,
                'total' => $total,
                'category' => $category
            ));
           
            
    
           Alert::Success('Success', 'Successfully Updated!');
           return redirect('StockCount')->with('Success', 'Data Updated');

          
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            Alert::Error('Failed', 'Editing of Stock Failed!');
            return redirect('StockCount')->with('Failed', 'Data not Updated');
        }
    }

    public function addrequest(Request $request)
    {
        $this->validate($request,[
            'productid' => 'required',
            'category' => 'required',
            'Linens' => 'required',
            'GuestSupplies' => 'required',
            'Amenities' => 'required',
            'description' => 'required',
            'allstock' => 'required',
            'quantity' => 'required',
            'stock' => 'required'
       ]);

       $stock = new hotelstocks;

       $stock->productid = $request->input('productid');
       $linens = $request->input('Linens');
       $guest = $request->input('GuestSupplies');
       $amenities = $request->input('Amenities');

       if($linens = 'Linens')
        {
            $stock->name = $request->input('Linens');
        }
        elseif($guest = 'GuestSupplies')
        {
            $stock->name = $request->input('GuestSupplies');
        }
        elseif($amenities =  'Amenities')
        {
            $stock->name = $request->input('Amenities');
        }

       $stock->description = $request->input('description');
       $stock->allstock = $request->input('allstock');
       $stock->total = $request->input('quantity');
       $stock->Stock_Level = $request->input('stock');
       $stock->category = $request->input('category');

       
       if($stock->save())
        {
            Alert::Success('Success', 'Successfully Submitted!');
            return redirect('StockCount')->with('Success', 'Data Saved');
        }
        else
        {
            Alert::Error('Error', 'Stock Submission Failed!, Please Try again.');
            return redirect('StockCount')->with('Error', 'Failed!');
        }
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

    public function GuestRequest()
    {
        $list = DB::select("SELECT * FROM guest_requests a INNER JOIN hotel_reservations b ON a.Booking_No = b.Booking_No where a.Status = 'Approved' AND a.Type_of_Request = 'Item Request'");
    
        return view('Admin.pages.Inventory.GuestRequest', ['list' => $list]);
    }

    public function req_up($id, $qty, $name)
    {
      try
      {
        $request_id = $id;
        $requested_quantity = $qty;
        $item_name = $name;

        $available_quantity;
        $item = DB::select("SELECT * FROM hotelstocks WHERE name = '$item_name'");

        foreach($item as $lists)
        {
            $available_quantity = $lists->total;
        }
    
        if($available_quantity < $requested_quantity)
        {
            Alert::Error('Failed', 'Insufficient Stock!');
            return redirect('GuestRequest')->with('Failed', 'Data not Updated');
        }
        else
        {
            $total = $available_quantity - $requested_quantity;

            $inventory = DB::table('hotelstocks')->where('name', $item_name)->update(['total' => $total]);
            $guestrequest = DB::table('guest_requests')->where('Request_ID', $request_id)->update(['Status' => "Dispersed"]);

            if($inventory && $guestrequest)
            {
                Alert::Success('Success', 'Requested Item Successfully Dispersed!');
                return redirect('GuestRequest')->with('Failed', 'Data not Updated');
            }
            else
            {
                Alert::Error('Failed', 'Request updating failed!');
                return redirect('GuestRequest')->with('Failed', 'Data not Updated');
            }
        }


      }
      catch(\Illuminate\Database\QueryException $e)
      {
        Alert::Error('Failed', 'Request updating failed!');
        return redirect('GuestRequest')->with('Failed', 'Data not Updated');
      }
    }
}
