<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['statuses'] = Status::whereIn('id',[3,4])->get();
        return view('items.index',$data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:items,name'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        try{
            if($request){
                $item = new Item();
                $item->name = $request['name'];
                $item->slug = Str::slug($request['name']);
                $item->price = $request['price'];
                $item->status_id = $request['status_id'];
                $item->user_id = $user_id;
                $item->save();

                return  response()->json(["status"=>"success","data"=>$item]);
            }
        }catch (Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }

    }

    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required|unique:items,name,'.$id
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        try{
            if($request){
                $item = Item::findOrFail($id);
                $item->name = $request['name'];
                $item->slug = Str::slug($request['name']);
                $item->price = $request['price'];
                $item->status_id = $request['status_id'];
                $item->user_id = $user_id;
                $item->save();

                return  response()->json(["status"=>"success","data"=>$item]);
            }
        }catch (Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }


    public function destroy(Item $item)
    {
        try{
            if($item){
                $item->delete();
                return response()->json(["status"=>"success","data"=>$item]);
            }
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }

    public function fetchalldatas()
    {
        try{
            $items = Item::with(['status','user'])->dateformat()->orderBy('created_at','asc')->get();
            return response()->json(['status'=>"success","data"=>$items]);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }

    public function changestatus(Request $request)
    {
        try{
            $item = Item::findOrFail($request['id']);
            $item->status_id = $request['status_id'];
            $item->save();

            return response()->json(["status"=>"success","data"=>$item]);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }
    }


}
