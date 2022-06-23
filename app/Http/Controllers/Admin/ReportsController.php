<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Receipt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    public function index()
    {

        return view('admin.reports.index');
    }

    public function daily(Request $request)
    {
        // $start =  $request->start_date->format('Y-m-d');
        // $end = $request->end_date->format('Y-m-d');
        //  $start = Carbon::createFromFormat('Y-m-d', $request->start_date);
        // $end = Carbon::createFromFormat('Y-m-d', $request->end_date);

        $receipt = Receipt::select('id', 'amount')->whereBetween('created_at',  [$request->start_date,$request->end_date])
        // ->where('created_at', '<=', $request->end_date)
        ->get();
        return $receipt;
    }
}
