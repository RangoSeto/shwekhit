<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Status;
use App\Models\Stockin;
use App\Models\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StockinsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['items'] = Item::all();
        $data['statuses'] = Status::whereIn('id',[3,4])->get();
        $data['types'] = Type::all();

        return view('stockins.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'item_id'=>'required'
        ]);


        try{

            $item = Item::findOrFail($request['item_id']);

            if($item){

                $counteach = $request['pocount']*200+$request['pharcount']*100;

                $geteachprice = $item->price;
                $totalprice = $geteachprice*$counteach;

                $stockins = new Stockin();
                $stockins->item_id = $request['item_id'];
                $stockins->pocount = $request['pocount'];
                $stockins->pharcount = $request['pharcount'];
                $stockins->countbyeach = $counteach;
                $stockins->price = $totalprice;
                $stockins->status_id = $request['status_id'];
                $stockins->user_id = Auth::id();
                $stockins->save();

                return response()->json(["status"=>"success","data"=>$stockins]);
            }


        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>"failed","message"=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->validate($request,[
            'item_id'=>'required'
        ]);


        try{

            $item = Item::findOrFail($request['item_id']);

            if($item){

                $counteach = $request['pocount']*200+$request['pharcount']*100;

                $geteachprice = $item->price;
                $totalprice = $geteachprice*$counteach;

                $stockins = Stockin::findOrFail($id);
                $stockins->item_id = $request['item_id'];
                $stockins->pocount = $request['pocount'];
                $stockins->pharcount = $request['pharcount'];
                $stockins->countbyeach = $counteach;
                $stockins->price = $totalprice;
                $stockins->status_id = $request['status_id'];
                $stockins->user_id = Auth::id();
                $stockins->save();

                return response()->json(["status"=>"success","data"=>$stockins]);
            }


        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>"failed","message"=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
