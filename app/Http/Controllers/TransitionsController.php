<?php

namespace App\Http\Controllers;

use App\Models\Paymenttype;
use App\Models\Transition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

class TransitionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['transitions'] = Transition::all();
        $data['paymenttypes'] = Paymenttype::all();
        return view('transitions.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name'=>'required',
            'price'=>'required'
        ]);

        try{

            $user = Auth::user();
            $user_id = $user->id;

            $transition = new Transition();
            $transition->name = $request['name'];
            $transition->paymenttype_id = $request['paymenttype_id'];
            $transition->price = $request['price'];
            $transition->user_id = $user_id;
            $transition->save();

            return response()->json(["status"=>"success","data"=>$transition]);

        }catch (Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
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
            'name'=>'required',
            'price'=>'required'
        ]);

        try{

            $user = Auth::user();
            $user_id = $user->id;

            $transition = Transition::findOrFail($id);
            $transition->name = $request['name'];
            $transition->paymenttype_id = $request['paymenttype_id'];
            $transition->price = $request['price'];
            $transition->user_id = $user_id;
            $transition->save();

            return response()->json(["status"=>"success","data"=>$transition]);

        }catch (Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $transition = Transition::findOrFail($id);
            $transition->delete();
            return response()->json(["status"=>"success","data"=>$transition]);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }

    public function fetchalldatas(Request $request){
        try{
            $transitions = Transition::with(['paymenttype','user'])->dateformat()->orderBy('created_at','asc')->get();

            return response()->json(["status"=>"success","data"=>$transitions]);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }

}
