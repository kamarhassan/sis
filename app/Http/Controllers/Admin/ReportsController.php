<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Receipt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Service;
use App\Models\ServiceReceipt;

class ReportsController extends Controller
{
    public function __construct()
    {
      
     }
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
                    'message' => __('site.'),
                    'status' => 'success',
                ];
            } else {
                $notification = [
                    'message' => __('site.'),
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
                'mode' => $mode, 'dataset' => json_encode($this->dataset_distrubion_reports())
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public  function service_by_type(Request $request)
    {
        $mode = "service_by_type";


        $receipts = $this->get_receipt_service_sold_by_type_bteween_date(ServiceReceipt::class,  $request);
        if (!empty($receipts)) {
            $notification = [
                'message' => __('site.'),
                'status' => 'success',
            ];
        } else {
            $notification = [
                'message' => __('site.'),
                'status' => 'error',
            ];
        }
        // return $this->dataset_service_sold_by_type_reports($receipts);
        return response()->json([
            'notification' => $notification, 'mode' => $mode,
            'dataset' => json_encode($this->dataset_service_sold_by_type_reports($receipts))
        ]);
    }






    private function get_receipt_service_sold_by_type_bteween_date($Model,  $request)
    {
        $receipt  = $Model::with('user:id,name', 'client_paid_currency', 'services_:id,service');

        if ($request->start_date != null) {
            $receipt = $receipt->where('created_at', '>=', $request->start_date);
        }
        if ($request->end_date != null) {
            $receipt = $receipt->where('created_at', '<=', $request->end_date);
        }
        return $receipt->get();
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
    ############################################  Data Set  ############################################
    private function dataset_service_sold_by_type_reports($array_of_data)
    {
        /*******************************

            need to set dataset for service sold by type

         */

        //  $sort_array_by_abbr_currency = $array_of_data->groupBy('currencies_id');
        $result_sort_array_by_abbr_currency = [];
        $dataSet=[];

        $result_sort_array_by_abbr_currency = $array_of_data->groupBy([
            'currencies_id',
            function ($item) {
                return $item['service_id'];
            },
        ], $preserveKeys = true);

        // return $result_sort_array_by_abbr_currency;
        if ($array_of_data->count() == 0) {
          return  $dataSet[] = [
                "id" => '',
                "Name" => "",
                "Amount" =>  '',
                "Payment date" => '',
                "Description" => "",
            ];
        }

        foreach ($result_sort_array_by_abbr_currency as $key_currency => $result_sort_array_by_services) {

            $currency_abbr = Currency::find($key_currency)['abbr'];
            foreach ($result_sort_array_by_services as $key_services => $by_services) {   // array cointain all for one currency
                //   return $key_services;
                $services_name = Service::find($key_services)['service'];
                $dataSet[] = [
                    "id" => __('site.Receipt Info by currency and services'),
                    "Name" =>   $services_name,
                    "Amount" => $currency_abbr,
                    "Payment date" => "",
                    "Description" => "",
                ];
                $sum = 0;
                foreach ($by_services as $key => $receipt) {

                    $dataSet[] = [
                        "id" => $receipt['id'],
                        "Name" => $receipt['user']['name'] . ' # ' . $receipt['user']['id'],
                        "Amount" => $receipt['amount'] + $receipt['other_amount'],
                        "Payment date" => $receipt['created_at']->format('d-m-Y'),
                        "Description" => $receipt['description'],
                    ];
                    $sum += $receipt['amount'] + $receipt['other_amount'];
                }
                $dataSet[] = [
                    "id" => __('site.sum of payment for'),
                    "Name" => "",
                    "Amount" =>  $sum,
                    "Payment date" => $currency_abbr,
                    "Description" => "",
                ];
                $dataSet[] = [
                    "id" => '',
                    "Name" => "",
                    "Amount" =>  '',
                    "Payment date" => '',
                    "Description" => "",
                ];
            }
        }

        return $dataSet;


        // foreach ($result_sort_array_by_abbr_currency as $key => $value) {
        //     $dataSet[] = [
        //         "id" => __('site.Receipt Info by currency'),
        //         "Name" => "",
        //         "Amount" => $key,
        //         "Payment date" => "",
        //         "Description" => "",
        //     ];
        //     $sum = 0;
        //     foreach ($value as $key => $receipt) {
        //         $dataSet[] = [
        //             "id" => $receipt['id'],
        //             "Name" => $receipt['user']['name'] . ' # ' . $receipt['user']['id'],
        //             "Amount" =>  $receipt['amount_total'],
        //             "Payment date" => $receipt['created_at']->format('d-m-Y'),
        //             "Description" => $receipt['description'],
        //         ];
        //         $sum += $receipt['amount_total'];
        //     }
        //     $dataSet[] = [
        //         "id" => __('site.sum of payment for'),
        //         "Name" => "",
        //         "Amount" =>  $sum,
        //         "Payment date" => $key,
        //         "Description" => "",
        //     ];
        // }

        // return  $dataSet;
    }
    private function dataset_daily_reports($array_of_data)
    {

        $dataSet =  [];
        foreach ($array_of_data as $key => $data) {
            foreach ($data as $key => $by_abbr_) {   // array cointain all for one currency
                $dataSet[] = [
                    "id" => __('site.Receipt Info by currency'),
                    "Name" => "",
                    "Amount" => $key,
                    "Payment date" => "",
                    "Description" => "",
                ];
                $sum = 0;
                foreach ($by_abbr_ as $receipt) { // merge in one dataset
                    $dataSet[] = [
                        "id" => $receipt['id'],
                        "Name" => $receipt['user']['name'] . ' # ' . $receipt['user']['id'],
                        "Amount" =>  $receipt['amount'] + $receipt['other_amount'],
                        "Payment date" => $receipt['created_at']->format('d-m-Y'),
                        "Description" => $receipt['description'],
                    ];
                    $sum += $receipt['amount'] + $receipt['other_amount'];
                }
                $dataSet[] = [
                    "id" => __('site.sum of payment for'),
                    "Name" => "",
                    "Amount" =>  $sum,
                    "Payment date" => $key,
                    "Description" => "",
                ];
                $dataSet[] = [
                    "id" => '',
                    "Name" => "",
                    "Amount" =>  '',
                    "Payment date" => '',
                    "Description" => "",
                ];
            }
        }

        return $dataSet;
    }
    private function dataset_distrubion_reports()
    {
        return [
            [
                'Course' => 'Course',
                'Name' => 'Name',
                'Level' => 'Level',
                'Status' => 'Status',
                'Start Date' => 'Start Date',
                'End Date' => 'End Date',
                'Receipt Number' => 'Receipt Number',
                'First Name' => 'First Name',
                'Father Name' => 'Father Name',
                'Last Name' => 'Last Name',
                'Amount Amount' => 'Amount Amount',
                'Date' => 'Date',
                'Payment Type' => 'Payment Type',
            ],
            [
                'Course' => 'Course',
                'Name' => 'Name',
                'Level' => 'Level',
                'Status' => 'Status',
                'Start Date' => 'Start Date',
                'End Date' => 'End Date',
                'Receipt Number' => 'Receipt Number',
                'First Name' => 'First Name',
                'Father Name' => 'Father Name',
                'Last Name' => 'Last Name',
                'Amount Amount' => 'Amount Amount',
                'Date' => 'Date',
                'Payment Type' => 'Payment Type',
            ],
            [
                'Course' => 'Course',
                'Name' => 'Name',
                'Level' => 'Level',
                'Status' => 'Status',
                'Start Date' => 'Start Date',
                'End Date' => 'End Date',
                'Receipt Number' => 'Receipt Number',
                'First Name' => 'First Name',
                'Father Name' => 'Father Name',
                'Last Name' => 'Last Name',
                'Amount Amount' => 'Amount Amount',
                'Date' => 'Date',
                'Payment Type' => 'Payment Type',
            ],
            [
                'Course' => 'Course',
                'Name' => 'Name',
                'Level' => 'Level',
                'Status' => 'Status',
                'Start Date' => 'Start Date',
                'End Date' => 'End Date',
                'Receipt Number' => 'Receipt Number',
                'First Name' => 'First Name',
                'Father Name' => 'Father Name',
                'Last Name' => 'Last Name',
                'Amount Amount' => 'Amount Amount',
                'Date' => 'Date',
                'Payment Type' => 'Payment Type',
            ],
            [
                'Course' => 'Course',
                'Name' => 'Name',
                'Level' => 'Level',
                'Status' => 'Status',
                'Start Date' => 'Start Date',
                'End Date' => 'End Date',
                'Receipt Number' => 'Receipt Number',
                'First Name' => 'First Name',
                'Father Name' => 'Father Name',
                'Last Name' => 'Last Name',
                'Amount Amount' => 'Amount Amount',
                'Date' => 'Date',
                'Payment Type' => 'Payment Type',
            ],
            [
                'Course' => 'Course',
                'Name' => 'Name',
                'Level' => 'Level',
                'Status' => 'Status',
                'Start Date' => 'Start Date',
                'End Date' => 'End Date',
                'Receipt Number' => 'Receipt Number',
                'First Name' => 'First Name',
                'Father Name' => 'Father Name',
                'Last Name' => 'Last Name',
                'Amount Amount' => 'Amount Amount',
                'Date' => 'Date',
                'Payment Type' => 'Payment Type',
            ],
            [
                'Course' => 'Course',
                'Name' => 'Name',
                'Level' => 'Level',
                'Status' => 'Status',
                'Start Date' => 'Start Date',
                'End Date' => 'End Date',
                'Receipt Number' => 'Receipt Number',
                'First Name' => 'First Name',
                'Father Name' => 'Father Name',
                'Last Name' => 'Last Name',
                'Amount Amount' => 'Amount Amount',
                'Date' => 'Date',
                'Payment Type' => 'Payment Type',
            ],
            [
                'Course' => 'Course',
                'Name' => 'Name',
                'Level' => 'Level',
                'Status' => 'Status',
                'Start Date' => 'Start Date',
                'End Date' => 'End Date',
                'Receipt Number' => 'Receipt Number',
                'First Name' => 'First Name',
                'Father Name' => 'Father Name',
                'Last Name' => 'Last Name',
                'Amount Amount' => 'Amount Amount',
                'Date' => 'Date',
                'Payment Type' => 'Payment Type',
            ],
            [
                'Course' => 'Course',
                'Name' => 'Name',
                'Level' => 'Level',
                'Status' => 'Status',
                'Start Date' => 'Start Date',
                'End Date' => 'End Date',
                'Receipt Number' => 'Receipt Number',
                'First Name' => 'First Name',
                'Father Name' => 'Father Name',
                'Last Name' => 'Last Name',
                'Amount Amount' => 'Amount Amount',
                'Date' => 'Date',
                'Payment Type' => 'Payment Type',
            ],
            [
                'Course' => 'Course',
                'Name' => 'Name',
                'Level' => 'Level',
                'Status' => 'Status',
                'Start Date' => 'Start Date',
                'End Date' => 'End Date',
                'Receipt Number' => 'Receipt Number',
                'First Name' => 'First Name',
                'Father Name' => 'Father Name',
                'Last Name' => 'Last Name',
                'Amount Amount' => 'Amount Amount',
                'Date' => 'Date',
                'Payment Type' => 'Payment Type',
            ],

        ];
    }
    #####################################
}
