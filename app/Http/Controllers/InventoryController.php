<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hotelstocks;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function addstock(Request $request)
    {
        $this->validate($request,[
        'name' => 'required',
        'description' => 'required',
        'quantity' => 'required',
        'in' => 'required',
        'out' => 'required',
        'category' => 'required'
       ]);

       $stock = new hotelstocks;

       $stock->name = $request->input('name');
       $stock->description = $request->input('description');
       $stock->total = $request->input('quantity');
       $stock->in = $request->input('in');
       $stock->out = $request->input('out');
       $stock->category = $request->input('category');

       $stock->save();

       Alert::Success('Success', 'Stock Successfully Submitted!');
       return redirect('StockCount')->with('Success', 'Data Saved');
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
    public function edit_stockC(Request $request)
    {
        //
        try{
            $this->validate($request,[
                'productid' => 'productid',
                'name' => 'required',
                'description' => 'required',
                'quantity' => 'required',
                'in' => 'required',
                'out' => 'required',
                'category' => 'required'
            ]);
    
           $productid = $request->input('productid');
           $name = $request->input('name');
           $description = $request->input('description');
           $total = $request->input('quantity');
           $in = $request->input('in');
           $out = $request->input('out');
           $category = $request->input('category');
           
           DB::table('hotelstocks')->where('productid', $productid)->update(array
            (
                'productid' => $productid,
                'name' => $name,
                'description' => $description,
                'total' => $total,
                'in' => $in,
                'out' => $out,
                'category' => $category
            ));
    
           Alert::Success('Success', 'Stock Successfully Updated!');
           return redirect('StockCount')->with('Success', 'Data Updated');
          
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            Alert::Error('Failed', 'Room Edit Failed!');
            return redirect('StockCount')->with('Failed', 'Data not Updateds');
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
