<?php

namespace App\Repository\Reports;

use App\Models\Receipt;
use App\Models\Service;
use App\Models\Currency;
use App\Models\ServiceReceipt;
use Illuminate\Support\Facades\DB;
use App\Models\StudentsRegistration;
use Illuminate\Database\Eloquent\Model;

class ReportRepository implements ReportInterface
{

    public function daily_report($request)
    {
        try {

            $currency_actives = Currency::active()->get();

            foreach ($currency_actives  as $currency_active) {
                $currency_id[] =  $currency_active['id'];
                $receipts_ = $this->get_receipt_bteween_date(Receipt::class, $currency_active['id'], $request, 'currency');
                $client_recipt = $this->get_receipt_bteween_date(ServiceReceipt::class,  $currency_active['id'], $request, 'client_paid_currency');

                $receipts[]  = [$currency_active['abbr'] => $receipts_->merge($client_recipt)];
            }
            return $receipts;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function get_receipt_service_sold_by_type_bteween_date($Model,  $request)
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
    public function dataset_daily_reports($array_of_data)
    {

        $dataSet =  [];
        foreach ($array_of_data as $key => $data) {
            foreach ($data as $key => $by_abbr_) {   // array cointain all for one currency
                $dataSet[] = [
                    "id" => '',
                    "Name" => __('site.Receipt Info by currency'),
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
                    "id" => '',
                    "Name" => __('site.sum of payment for'),
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
    public function dataset_service_sold_by_type_reports($array_of_data)
    {
        /*******************************

        need to set dataset for service sold by type

         */

        //  $sort_array_by_abbr_currency = $array_of_data->groupBy('currencies_id');
        $result_sort_array_by_abbr_currency = [];
        $dataSet = [];

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
                    "id" => '',
                    "Name" => __('site.Receipt Info by currency and services'),
                    "Name" =>  '',
                    "Amount" => $services_name,
                    "Payment date" => $currency_abbr,
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
                    "id" => '',
                    "Name" => __('site.Receipt Info by currency and services'),
                    "Name" =>  '',
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
    }

    // public function dataset_distrubion_reports()
    // {
    // }


    public function unpaid_account_summary_and_details($request)
    {
        try {

            $array_of_data_seleted = [
                'users.id as user_id',
                'users.name as user_name',
                'users.email as user_email',
                'users.phonenumber as user_phone',

                'levels.level as level',
                'grades.grade as grade',
                'courss.id as cours_id',
                'courss.startTime as cours_start_time',
                'courss.endTime as cours_end_time',
                'courss.status as cours_status',
                'courss.act_StartDa as cours_start_at',
                'courss.act_EndDa as cours_end_at',

                'teacher.id as teacher_id',
                'teacher.name as teacher_name',
                'currencies.abbr as abbr',
                'studentsregistrations.remaining as remaining'
            ];
            return $this->unpaid_and_cours_account_summary_and_details($request, $array_of_data_seleted);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function dataset_unpaid_account_summary($array_of_data_by_unpaid_account)
    {

        $array_of_data_by_unpaid_account;
        $result_sort_array_by_cours_id_and_abbr = [];
        $dataSet = [];

        $result_sort_array_by_cours_id_and_abbr = $array_of_data_by_unpaid_account->groupBy(['abbr', 'cours_id']);

        if ($array_of_data_by_unpaid_account->count() == 0) {
            return  $dataSet[] = [
                "Course # Level" => '',
                "Status" => "",
                // "Std Name" => "",
                "Teacher" =>  '',
                "Start Date" =>  '',
                "End Date" =>  '',
                "Start Time" => '',
                "End Time" => '',
                "Reamining" => '',
                // "Description" => "",
            ];
            return $dataSet;
        }

        foreach ($result_sort_array_by_cours_id_and_abbr as $key_currency => $result_sort_array_by_currency) {

            $dataSet[] = [

                "Course # Level" => '',
                "Status" => "",
                // "Std Name" => '',
                "Teacher" =>   $key_currency,
                "Start Date" =>  '',
                "End Date" =>  '',
                "Start Time" => '',
                "End Time" => '',
                "Reamining" => '',
            ];
            $sum_remaining = 0;
            foreach ($result_sort_array_by_currency as $key_unpaid_account => $by_unpaid_account) {

                $dataSet[] = [
                    // abbr // :  // "L.L" // cours_end_at // :  // "2022-10-07" // cours_end_time // :  // "02:16:27" // cours_id // :  // 1 // cours_start_at // :  // "2022-10-07" // cours_start_time // :  // "12:27:00" // cours_status // :  // "open" // grade // :  // "Html" // level // :  // "level 4" // remaining // :  // 5000000 // teacher_id // :  // 9 // teacher_name // :  // "Leila Bartell"
                    "Course # Level" => $by_unpaid_account[0]->grade . " # " . $by_unpaid_account[0]->level,
                    "Status" => $by_unpaid_account[0]->cours_status,
                    // "Std Name" => $by_unpaid_account[0]->,
                    "Teacher" =>  $by_unpaid_account[0]->teacher_name,
                    "Start Date" => $by_unpaid_account[0]->cours_start_at,
                    "End Date" => $by_unpaid_account[0]->cours_end_at,
                    "Start Time" => $by_unpaid_account[0]->cours_start_time,
                    "End Time" => $by_unpaid_account[0]->cours_end_time,
                    "Reamining" => $by_unpaid_account->sum('remaining'),
                ];
                $sum_remaining += $by_unpaid_account->sum('remaining');
            }
            $dataSet[] = [
                "Course # Level" => '',
                "Status" => "",
                // "Std Name" => '',
                "Teacher" =>  '',
                "Start Date" =>  '',
                "End Date" =>  '',
                "Start Time" => '',
                "End Time" => '',
                "Reamining" => $sum_remaining,
            ];
            $dataSet[] = [
                "Course # Level" => '',
                "Status" => "",
                // "Std Name" => '',
                "Teacher" =>  '',
                "Start Date" =>  '',
                "End Date" =>  '',
                "Start Time" => '',
                "End Time" => '',
                "Reamining" => '',
            ];
        }
        return $dataSet;
    }




    public function dataset_unpaid_account_details($array_of_data_by_unpaid_account)
    {
        $array_of_data_by_unpaid_account;
        $result_sort_array_by_abbr = [];
        $dataSet = [];

        $result_sort_array_by_abbr = $array_of_data_by_unpaid_account->groupBy(['abbr']);

        if ($array_of_data_by_unpaid_account->count() == 0) {
            return  $dataSet[] = [
                "Course # Level" => '',
                "Status" => "",
                // "Std Name" => "",
                "Teacher" =>  '',
                "Start Date" =>  '',
                "End Date" =>  '',
                "Start Time" => '',
                "End Time" => '',
                "Reamining" => '',
                // "Description" => "",
            ];
            return $dataSet;
        }
        foreach ($result_sort_array_by_abbr as $key_currency => $result_sort_array_by_currency) {

            $dataSet[] = [

                "Course # Level" => '',
                "Status" => "",
                "Teacher" =>   $key_currency,
                "Start Date" =>  '',
                "End Date" =>  '',
                "Start Time" => '',
                "End Time" => '',
                "Student Info" => '',
                "Reamining" => '',
            ];
            $sum_remaining = 0;
            foreach ($result_sort_array_by_currency as $key_unpaid_account => $by_unpaid_account) {
                $dataSet[] = [
                    // abbr // :  // "L.L" // cours_end_at // :  // "2022-10-07" // cours_end_time // :  // "02:16:27" // cours_id // :  // 1 // cours_start_at // :  // "2022-10-07" // cours_start_time // :  // "12:27:00" // cours_status // :  // "open" // grade // :  // "Html" // level // :  // "level 4" // remaining // :  // 5000000 // teacher_id // :  // 9 // teacher_name // :  // "Leila Bartell"
                    "Course # Level" => $by_unpaid_account->grade . "\r#\n\r" . $by_unpaid_account->level,
                    "Status" => $by_unpaid_account->cours_status,
                    "Teacher" =>  $by_unpaid_account->teacher_name,
                    "Start Date" => $by_unpaid_account->cours_start_at,
                    "End Date" => $by_unpaid_account->cours_end_at,
                    "Start Time" => $by_unpaid_account->cours_start_time,
                    "End Time" => $by_unpaid_account->cours_end_time,
                    "Student Info" => $by_unpaid_account->user_id . " # " . $by_unpaid_account->user_name
                        . "\n<span>" . $by_unpaid_account->user_email . " <i class=\"ti ti-email\"></i> </span>"
                        . "\n<span>" . $by_unpaid_account->user_phone . " <i class=\"ti ti-mobile\"></i> </span>",
                    "Reamining" => $by_unpaid_account->remaining,
                ];
                $sum_remaining += $by_unpaid_account->remaining;
            }
            $dataSet[] = [
                "Course # Level" => '',
                "Status" => "",
                "Student Info" => '',
                "Teacher" =>  '',
                "Start Date" =>  '',
                "End Date" =>  '',
                "Start Time" => '',
                "End Time" => '',
                "Reamining" => $sum_remaining,
            ];
            $dataSet[] = [
                "Course # Level" => '',
                "Status" => "",
                "Student Info" => '',
                "Teacher" =>  '',
                "Start Date" =>  '',
                "End Date" =>  '',
                "Start Time" => '',
                "End Time" => '',
                "Reamining" => '',
            ];
        }
        return $dataSet;
    }



    public function cours_account_summary_and_details($request)
    {
        try {

            $array_of_data_seleted = [
                'users.id as user_id',
                'users.name as user_name',
                'users.email as user_email',
                'users.phonenumber as user_phone',

                'levels.level as level',
                'grades.grade as grade',
                'courss.id as cours_id',
                'courss.startTime as cours_start_time',
                'courss.endTime as cours_end_time',
                'courss.status as cours_status',
                'courss.act_StartDa as cours_start_at',
                'courss.act_EndDa as cours_end_at',

                'teacher.id as teacher_id',
                'teacher.name as teacher_name',
                'currencies.abbr as abbr',
                'studentsregistrations.cours_fee_total as cours_fee_total',
                'studentsregistrations.remaining as remaining'
            ];
            return $this->unpaid_and_cours_account_summary_and_details($request, $array_of_data_seleted);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function dataset_cours_account_summary($array_of_data_by_cours_account)
    {

        $result_sort_array_by_cours_id_and_abbr = [];
        $dataSet = [];

        $result_sort_array_by_cours_id_and_abbr = $array_of_data_by_cours_account->groupBy(['abbr', 'cours_id']);
        if ($array_of_data_by_cours_account->count() == 0) {
            return  $dataSet[] = [
                "Course # Level" => '',
                "Status" => "",
                // "Std Name" => "",
                "Teacher" =>  '',
                "Start Date" =>  '',
                "End Date" =>  '',
                "Start Time" => '',
                "End Time" => '',
                'Due Amount' => '',
                'Payed Amount' => '',
                "Reamining" => '',
                // "Description" => "",
            ];
            return $dataSet;
        }
        // return  $result_sort_array_by_cours_id_and_abbr;
        foreach ($result_sort_array_by_cours_id_and_abbr as $key_currency => $result_sort_array_by_currency) {

            $dataSet[] = [

                "Course # Level" => '',
                "Status" => "",
                "Teacher" =>   $key_currency,
                "Start Date" =>  '',
                "End Date" =>  '',
                "Start Time" => '',
                "End Time" => '',
                'Due Amount' => '',
                'Payed Amount' => '',
                "Reamining" => '',
            ];
            $sum_remaining = $sum_due_amount = $sum_payed_amount = 0;
            foreach ($result_sort_array_by_currency as $key_unpaid_account => $by_unpaid_account) {

                $dataSet[] = [
                    // abbr // :  // "L.L" // cours_end_at // :  // "2022-10-07" // cours_end_time // :  // "02:16:27" // cours_id // :  // 1 // cours_start_at // :  // "2022-10-07" // cours_start_time // :  // "12:27:00" // cours_status // :  // "open" // grade // :  // "Html" // level // :  // "level 4" // remaining // :  // 5000000 // teacher_id // :  // 9 // teacher_name // :  // "Leila Bartell"
                    "Course # Level" => $by_unpaid_account[0]->grade . " # " . $by_unpaid_account[0]->level,
                    "Status" => $by_unpaid_account[0]->cours_status,
                    // "Std Name" => $by_unpaid_account[0]->,
                    "Teacher" =>  $by_unpaid_account[0]->teacher_name,
                    "Start Date" => $by_unpaid_account[0]->cours_start_at,
                    "End Date" => $by_unpaid_account[0]->cours_end_at,
                    "Start Time" => $by_unpaid_account[0]->cours_start_time,
                    "End Time" => $by_unpaid_account[0]->cours_end_time,
                    'Due Amount' => $by_unpaid_account->sum('cours_fee_total'),
                    'Payed Amount' => $by_unpaid_account->sum('cours_fee_total') - $by_unpaid_account->sum('remaining'),
                    "Reamining" => $by_unpaid_account->sum('remaining'),
                ];
                $sum_remaining += $by_unpaid_account->sum('remaining');
                $sum_due_amount += $by_unpaid_account->sum('cours_fee_total');
                $sum_payed_amount += $by_unpaid_account->sum('cours_fee_total') - $by_unpaid_account->sum('remaining');
            }
            $dataSet[] = [
                "Course # Level" => '',
                "Status" => "",
                // "Std Name" => '',
                "Teacher" =>  '',
                "Start Date" =>  '',
                "End Date" =>  '',
                "Start Time" => '',
                "End Time" => '',
                'Due Amount' => $sum_due_amount,
                'Payed Amount' => $sum_payed_amount,
                "Reamining" => $sum_remaining,
            ];
            $dataSet[] = [
                "Course # Level" => '',
                "Status" => "",
                // "Std Name" => '',
                "Teacher" =>  '',
                "Start Date" =>  '',
                "End Date" =>  '',
                "Start Time" => '',
                "End Time" => '',
                "Reamining" => '',
            ];
        }
        return $dataSet;
    }
    public function dataset_cours_account_details($array_of_data_by_cours_account)
    {

         
        $result_sort_array_by_abbr = [];
        $dataSet = [];

        $result_sort_array_by_abbr = $array_of_data_by_cours_account->groupBy(['abbr']);

        if ($array_of_data_by_cours_account->count() == 0) {
            return  $dataSet[] = [
                "Course # Level" => '',
                "Status" => "",
                // "Std Name" => "",
                "Teacher" =>  '',
                "Start Date" =>  '',
                "End Date" =>  '',
                "Start Time" => '',
                "End Time" => '',
                "Reamining" => '',
                // "Description" => "",
            ];
            return $dataSet;
        }
        foreach ($result_sort_array_by_abbr as $key_currency => $result_sort_array_by_currency) {

            $dataSet[] = [

                "Course # Level" => '',
                "Status" => "",
                "Teacher" =>   $key_currency,
                "Start Date" =>  '',
                "End Date" =>  '',
                "Start Time" => '',
                "End Time" => '',
                "Student Info" => '',
                'Due Amount' => '',
                'Payed Amount' => '',
                "Reamining" => '',
            ];
            $sum_remaining = $sum_due_amount = $sum_payed_amount = 0;
            foreach ($result_sort_array_by_currency as $key_unpaid_account => $by_unpaid_account) {
                $dataSet[] = [
                    // abbr // :  // "L.L" // cours_end_at // :  // "2022-10-07" // cours_end_time // :  // "02:16:27" // cours_id // :  // 1 // cours_start_at // :  // "2022-10-07" // cours_start_time // :  // "12:27:00" // cours_status // :  // "open" // grade // :  // "Html" // level // :  // "level 4" // remaining // :  // 5000000 // teacher_id // :  // 9 // teacher_name // :  // "Leila Bartell"
                    "Course # Level" => $by_unpaid_account->grade . "\r#\n\r" . $by_unpaid_account->level,
                    "Status" => $by_unpaid_account->cours_status,
                    "Teacher" =>  $by_unpaid_account->teacher_name,
                    "Start Date" => $by_unpaid_account->cours_start_at,
                    "End Date" => $by_unpaid_account->cours_end_at,
                    "Start Time" => $by_unpaid_account->cours_start_time,
                    "End Time" => $by_unpaid_account->cours_end_time,
                    "Student Info" => $by_unpaid_account->user_id . " # " . $by_unpaid_account->user_name
                        // . "\n<span>" . $by_unpaid_account->user_email . " <i class=\"ti ti-email\"></i> </span>"
                        . "\n<span>" . $by_unpaid_account->user_phone . " <i class=\"ti ti-mobile\"></i> </span>",
                    'Due Amount' =>  $by_unpaid_account->cours_fee_total,
                    'Payed Amount' => $by_unpaid_account->cours_fee_total - $by_unpaid_account->remaining,
                    "Reamining" => $by_unpaid_account->remaining,
                ];
                $sum_remaining += $by_unpaid_account->remaining;
                $sum_due_amount+= $by_unpaid_account->cours_fee_total;
                $sum_payed_amount  +=$by_unpaid_account->cours_fee_total - $by_unpaid_account->remaining;
            }
            $dataSet[] = [
                "Course # Level" => '',
                "Status" => "",
                "Student Info" => '',
                "Teacher" =>  '',
                "Start Date" =>  '',
                "End Date" =>  '',
                "Start Time" => '',
                "End Time" => '',
                'Due Amount' => $sum_due_amount,
                'Payed Amount' => $sum_payed_amount,
                "Reamining" => $sum_remaining,
            ];
            $dataSet[] = [
                "Course # Level" => '',
                "Status" => "",
                "Student Info" => '',
                "Teacher" =>  '',
                "Start Date" =>  '',
                "End Date" =>  '',
                "Start Time" => '',
                "End Time" => '',
                "Reamining" => '',
            ];
        }
        return $dataSet;
    }

    private function unpaid_and_cours_account_summary_and_details($request, array $select_data)
    {
        $data = DB::table('courss')
            ->join('grades', 'grade_id', '=', 'grades.id')
            ->join('levels', 'level_id', '=', 'levels.id')
            ->join('currencies', 'currencies_id', '=', 'currencies.id')
            ->join('admins as teacher', 'teacher_id', '=', 'teacher.id')
            ->join('studentsregistrations', 'courss.id', '=', 'studentsregistrations.cours_id')
            ->join('users', 'studentsregistrations.user_id', '=', 'users.id');

        if ($request->start_date != null) {
            $data = $data->where('studentsregistrations.created_at', '>=', $request->start_date);
        }
        if ($request->end_date != null) {
            $data = $data->where('studentsregistrations.created_at', '<=', $request->end_date);
        }

        $data->select($select_data);
        return $data->get();
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
}
