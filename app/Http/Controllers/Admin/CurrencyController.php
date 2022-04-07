<?php

namespace App\Http\Controllers\Admin;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{


    public function index()
    {
        $currency =  Currency::select()->Descending()->get();
        return view('admin.setup.Currency.index', compact('currency'));
    }
    public function edit(Request $request)
    {
        // return  $request->currecny_name;

        $cur = Currency::select()->find($request->currecny_name);


        try {
            if (!$cur) {

                toastr()->error(__('site.currency is not defined'));
                return redirect()->route('admin.Currency.get');
            } else {

                $statuse = $cur->active == 1 ? 0 : 1;

                $cur->update(['active' => $statuse]);
                toastr()->success(__('site.Post created successfully!'));
                // toastr()->warning(__('site.only not empty'));
                return redirect()->route('admin.Currency.get');
            }
        } catch (\Exception $th) {
            toastr()->error(__('site.you have error'));
            return redirect()->back();
        }
    }

    public function delete(Request $request){
return $request;
    }
}
