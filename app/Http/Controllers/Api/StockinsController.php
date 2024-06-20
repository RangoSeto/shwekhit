<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StockinsResource;
use App\Models\Status;
use App\Models\Stockin;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class StockinsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $this->validate($request,[
//            'item_id'=>'required'
//        ]);
//
//        $counteach = $request['phocount']*200+$request['pharcount']*100;
//
//        $totalprice =
//
//        $stockins = new Stockin();
//        $stockins->item_id = $request['item_id'];
//        $stockins->phocount = $request['phocount'];
//        $stockins->pharcount = $request['pharcount'];
//        $stockins->countbyeach = $counteach;
//        $stockins->price = $request['price'];
//        $stockins->save();
//
//        return new StockinsResource($stockins);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stockins = Stockin::findOrFail($id);
        $stockins->delete();
        return new StockinsResource($stockins);
    }

    public function fetchalldatas()
    {
        $stockins = Stockin::orderBy('created_at','desc')->get();


        return StockinsResource::collection($stockins);
    }

    public function stockinsstatus(Request $request)
    {
        $stockins = Stockin::findOrFail($request['id']);
        $stockins->status_id = $request['status_id'];
        $stockins->save();
        return new StockinsResource($stockins);
    }
}
