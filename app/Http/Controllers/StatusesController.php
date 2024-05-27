<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StatusesController extends Controller
{

    public function index()
    {
        return view('statuses.index');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name'=>'required|unique:statuses,name'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        try{
            if($request){
                $status = new Status();
                $status->name = $request['name'];
                $status->slug = $request['name'];
                $status->user_id = $user_id;
                $status->save();

                return response()->json(["status"=>"success","data"=>$status]);
            }
            return response()->json(["status"=>"failed","message"=>"Error Your Data is wrong"]);

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }


    }

    public function update(Request $request, string $id)
    {

        $this->validate($request,[
            'name'=>'required|unique:statuses,name,'.$id
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        try{
            if($request){
                $status = Status::findOrFail($id);
                $status->name = $request['name'];
                $status->slug = $request['name'];
                $status->user_id = $user_id;
                $status->save();

                return response()->json(["status"=>"success","data"=>$status]);
            }
            return response()->json(["status"=>"failed","message"=>"Error Your Data is wrong"]);

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }


    public function destroy(Status $status)
    {
        try{
            if($status){
                $status->delete();
                return response()->json(["status"=>"success","data"=>$status]);
            }
        }catch (Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }

    public function fetchalldatas(){

        try{
            $statuses = Status::with('user')->dateformat()->get();
            return response()->json(["data"=>$statuses]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }

    }
}
