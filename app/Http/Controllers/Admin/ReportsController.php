<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Receipt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Service;
use App\Models\ServiceReceipt;

use App\Repository\Reports\ReportInterface;


class ReportsController extends Controller
{
    protected $reportrepository;

    public function __construct(
        ReportInterface $reportinterface

    ) {
        $this->reportrepository = $reportinterface;
    }
    public function index()
    {
        return view('admin.reports.index');
    }

    public function daily_report(Request $request)
    {
        try {
            $mode = "daily";
            $receipts = $this->reportrepository->daily_report($request);
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
                'notification' => $notification, 'mode' => $mode, 'title' => __('site.daily reports'),
                'dataset' => json_encode($this->reportrepository->dataset_daily_reports($receipts))
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
                'mode' => $mode, 'dataset' => json_encode($this->reportrepository->dataset_distrubion_reports())
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public  function service_by_type(Request $request)
    {
        $mode = "service_by_type";
        $receipts = $this->reportrepository->get_receipt_service_sold_by_type_bteween_date(ServiceReceipt::class,  $request);

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
            'notification' => $notification, 'mode' => $mode, 'title' => __('site.Receipt Report Service Sold By Type'),
            'dataset' => json_encode($this->reportrepository->dataset_service_sold_by_type_reports($receipts))
        ]);
    }

    public function  unpaid_account_summary(Request $request)
    {

        try {
            $mode = "unpaid_account_summary";
             $unpaid_account = $this->reportrepository->unpaid_account_summary_and_details($request);
            //   $this->reportrepository->dataset_unpaid_account($unpaid_account);

            if (!empty($unpaid_account)) {
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

            return response()->json([
                'notification' => $notification, 'mode' => $mode, 'title' => __('site.Receipt Report unpaid accounting summary'),
                'dataset' => json_encode($this->reportrepository->dataset_unpaid_account_summary($unpaid_account))
            ]);
        } catch (\Throwable $th) {
            //  return -1;
            throw $th;
        }
    }

    public function unpaid_account_details(Request $request)
    {

        try {
            $mode = "unpaid_account_details";
           $unpaid_account = $this->reportrepository->unpaid_account_summary_and_details($request);
            //   return $this->reportrepository->dataset_unpaid_account_details($unpaid_account);
            if (!empty($unpaid_account)) {
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

            return response()->json([
                'notification' => $notification, 'mode' => $mode, 'title' => __('site.Receipt Report unpaid account details'),
                'dataset' => json_encode($this->reportrepository->dataset_unpaid_account_details($unpaid_account))
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function cours_account_summary(Request $request)
    {

        try {
            $mode = "cours_account_summary";
            $cours_account_summary = $this->reportrepository->cours_account_summary_and_details($request);
            //  return $this->reportrepository->dataset_cours_account_summary($cours_account_summary);
            if (!empty($cours_account_summary)) {
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
            return response()->json([
                'notification' => $notification, 'mode' => $mode, 'title' => __('Receipt Report course accounting details'),
                'dataset' => json_encode($this->reportrepository->dataset_cours_account_summary($cours_account_summary))
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function cours_account_details(Request $request){
        try {
            $mode = "cours_account_details";
            $cours_account_summary = $this->reportrepository->cours_account_summary_and_details($request);
            //  return $this->reportrepository->dataset_cours_account_summary($cours_account_summary);
            if (!empty($cours_account_summary)) {
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
            return response()->json([
                'notification' => $notification, 'mode' => $mode, 'title' => __('Receipt Report course accounting details'),
                'dataset' => json_encode($this->reportrepository->dataset_cours_account_details($cours_account_summary))
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
