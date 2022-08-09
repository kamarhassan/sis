<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Receipt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\ServiceReceipt;

class ReportsController extends Controller
{
    public function index()
    {

        return view('admin.reports.index');
    }

    public function daily_report(Request $request)
    {
        try {
            $mode = "daily";
            $currency_actives = Currency::active()->get();

            foreach ($currency_actives  as $currency_active) {
                $currency_id[] =  $currency_active['id'];
                $receipts_ = $this->get_receipt_bteween_date(Receipt::class, $currency_active['id'], $request, 'currency');

                $client_recipt = $this->get_receipt_bteween_date(ServiceReceipt::class,  $currency_active['id'], $request, 'client_paid_currency');

                $receipts[]  = [$currency_active['abbr'] => $receipts_->merge($client_recipt)];
            }


            if (!empty($receipts)) {
                $notification = [
                    'message' => __('site.you can edit only the last receipt or receipt not found'),
                    'status' => 'success',
                ];
            } else {
                $notification = [
                    'message' => __('site.you can edit only the last receipt or receipt not found'),
                    'status' => 'error',
                ];
            }
            // return $this->dataset_daily_reports($receipts);
            return response()->json([
                'notification' => $notification, 'mode' => $mode,
                'dataset' => json_encode($this->dataset_daily_reports($receipts))
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function dist_()
    {
        try {
            $mode = "distrubtion";
            $notification = [
                'message' => __('site.you can edit only the last receipt or receipt not found'),
                'status' => 'success',
            ];
            $receipts = [];

            return response()->json([
                'receipt' => $receipts, 'notification' => $notification,
                'mode' => $mode, 'dataset' => "json_encode()"
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function get_currencies_bteween_date($Model, $request, $relation)
    {
        $receipt  = $Model::with($relation)->distinct('currencies_id');
        if ($request->start_date != null) {
            $receipt = $receipt->where('created_at', '>=', $request->start_date);
        }
        if ($request->end_date != null) {
            $receipt = $receipt->where('created_at', '<=', $request->end_date);
        }
        return $receipt->get('currencies_id', $relation)->toArray();
    }

    private function get_receipt_bteween_date($Model,  $paid_for_cours_and_services, $request, $relation)
    {
        $receipt  =  $Model::whereIn('currencies_id', [$paid_for_cours_and_services])->with('user:id,name', $relation);

        if ($request->start_date != null) {
            $receipt = $receipt->where('created_at', '>=', $request->start_date);
        }
        if ($request->end_date != null) {
            $receipt = $receipt->where('created_at', '<=', $request->end_date);
        }
        return $receipt->get();
    }



    private function dataset_daily_reports($array_of_data)
    {

        $dataSet =  [];
        foreach ($array_of_data as $key => $data) {  // for
            foreach ($data as $key => $by_abbr_) {   // array cointain all for one currency
                $dataSet[] = [
                    "id" => $key,
                    "Name" => "",
                    "Amount" => "",
                    "Payment date" => "",
                    "Description" => "",
                ];
                $sum = 0;
                foreach ($by_abbr_ as $receipt){ // merge in one dataset
                    $dataSet[] = [
                        "id" => $receipt['id'],
                         "Name" => $receipt['user']['name'] . ' # ' . $receipt['user']['id'],
                         "Amount" =>  $receipt['amount_total'],
                         "Payment date" => $receipt['created_at']->format('d-m-Y'),
                         "Description" => $receipt['description'],
                    ];
                $sum += $receipt['amount_total'];
                }
                $dataSet[] = [
                    "id" => __('site.sum of payment for')."   ". $key."   :    ".$sum,
                    "Name" => "",
                    "Amount" =>  "",
                    "Payment date" => "",
                    "Description" => "",
                ];
            }
        }

        return $dataSet;
    }
}
