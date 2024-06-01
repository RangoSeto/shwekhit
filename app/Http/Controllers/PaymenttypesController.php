<?php

namespace App\Http\Controllers;

use App\Models\Paymenttype;
use App\Models\Status;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PHPUnit\Exception;

class PaymenttypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['paymenttypes'] = Paymenttype::all();
        $data['statuses'] = Status::whereIn('id',[3,4])->get();
        return view('paymenttypes.index',$data);
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
            'name'=>'required'
        ]);

        try{
            $user = Auth::user();
            $user_id = $user->id;
            $paymenttypes = new Paymenttype();
            $paymenttypes->name = $request->input('name');
            $paymenttypes->slug = Str::slug($request->input('name'));
            $paymenttypes->status_id = $request->input('status_id');
            $paymenttypes->user_id = $user_id;
            $paymenttypes->save();
            return response()->json(["status"=>"success","data"=>$paymenttypes]);
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
            'name'=>'required'
        ]);

        try{
            $user = Auth::user();
            $user_id = $user->id;

            $paymenttypes = Paymenttype::findOrFail($id);
            $paymenttypes->name = $request['name'];
            $paymenttypes->slug = Str::slug($request['name']);
            $paymenttypes->status_id = $request['status_id'];
            $paymenttypes->user_id = $user_id;
            $paymenttypes->save();
            return response()->json(["status"=>"success","data"=>$paymenttypes]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['status'=>"failed","message"=>$e->getMessage()]);
        }
    }


    public function destroy(string $id)
    {
        try{
            $paymenttypes = Paymenttype::findOrFail($id);
            $paymenttypes->delete();
            return response()->json(['status'=>"success","data"=>$paymenttypes]);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }

    public function fetchalldatas(){
        try{
            $paymenttypes = Paymenttype::with(['status','user'])->dateformat()->orderBy('created_at','asc')->get();
            return response()->json(['status'=>"success","data"=>$paymenttypes]);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }

    public function changestatus(Request $request)
    {
        try{
            $paymenttypes = Paymenttype::findOrFail($request['id']);
            $paymenttypes->status_id = $request['status_id'];
            $paymenttypes->save();

            return response()->json(["status"=>"success","data"=>$paymenttypes]);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }
}
