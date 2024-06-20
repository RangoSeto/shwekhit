<?php

namespace App\Http\Controllers;

use App\Models\Stockin;
use App\Models\Transition;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonthlysalesController extends Controller
{
    public function index()
    {
        $stockins = Stockin::select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as quantity'))
                    ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))->get();

        return view('monthlysales.index', compact('stockins'));
    }

    public function show(Request $request)
    {
        $date = $request['date'];
        $changedate = \Carbon\Carbon::parse('01'.$date);
        $year = $changedate->year;
        $month = $changedate->month;


        $data['stockins'] = Stockin::whereYear('created_at', $year)->whereMonth('created_at', $month)->with('item')->get();

        $data['totals'] = DB::table('stockins')->whereYear('created_at', $year)->whereMonth('created_at', $month)->select(DB::raw('SUM(price) as total_price'),DB::raw('SUM(pocount) as total_pocount'),DB::raw('SUM(pharcount) as total_pharcount'))->first();

        $data['commercialitems'] = DB::table('stockins')->whereYear('created_at', $year)->whereMonth('created_at', $month)->where('item_id',"!=",5)->select(DB::raw('SUM(countbyeach) as total_countbyeach'))->first();
        $data['commercial'] = $data['commercialitems']->total_countbyeach * 10;
        $data['mainamount'] = $data['totals']->total_price - $data['commercial'];

        $data['totaltransition'] = Transition::whereYear('created_at', $year)->whereMonth('created_at', $month)->select(DB::raw('SUM(price) as totaltranprice'))->first();

        $data['final_amount'] = $data['mainamount'] - $data['totaltransition']->totaltranprice;

        return view('monthlysales.show', $data);
    }

    public function transitions(Request $request){
        $date = $request['date'];
        $changedate = \Carbon\Carbon::parse('01'.$date);
        $year = $changedate->year;
        $month = $changedate->month;

        $data['transitions'] = Transition::whereYear('created_at', $year)->whereMonth('created_at', $month)->with('paymenttype')->get();
        $data['totaltransition'] = Transition::whereYear('created_at', $year)->whereMonth('created_at', $month)->select(DB::raw('SUM(price) as totaltranprice'))->first();

        return view('monthlysales.transition', $data);
    }

}
