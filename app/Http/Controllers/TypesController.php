<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TypesController extends Controller
{

    public function index()
    {
        return view('types.index');
    }

    public function show(string $id)
    {

    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name'=>'required|unique:types,name',
            'itemscount'=>'required'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        try{
            if($request){
                $type = new Type();
                $type->name = $request['name'];
                $type->slug = $request['name'];
                $type->itemscount = $request['itemscount'];
                $type->user_id = $user_id;
                $type->save();

                return response()->json(["status"=>"success","data"=>$type]);
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
            'name'=>'required|unique:types,name,'.$id,
            'itemscount'=>'required'
        ]);


        $user = Auth::user();
        $user_id = $user->id;

        try{
            if($request){
                $type = Type::findOrFail($id);
                $type->name = $request['name'];
                $type->slug = $request['name'];
                $type->itemscount = $request['itemscount'];
                $type->user_id = $user_id;
                $type->save();

                return response()->json(["status"=>"success","data"=>$type]);
            }
            return response()->json(["status"=>"failed","message"=>"Error Your Data is wrong"]);

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }


    public function destroy(Type $type)
    {
        try{
            if($type){
                $type->delete();
                return response()->json(["status"=>"success","data"=>$type]);
            }
        }catch (Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }

    public function fetchalldatas(){

        try{
            $statuses = Type::with('user')->dateformat()->get();
            return response()->json(["data"=>$statuses]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }

    }
}
