<?php

namespace App\Repository\Reports;

interface ReportInterface
{
    public function daily_report($request);
    public function dataset_daily_reports($array_of_data_daily);

    public function dataset_service_sold_by_type_reports($array_of_data_by_type);
    public function get_receipt_service_sold_by_type_bteween_date($Model,  $request);

    // public function dataset_distrubion_reports();
    
    public function unpaid_account_summary_and_details($request);
    public function dataset_unpaid_account_summary($array_of_data_by_unpaid_account);
    public function dataset_unpaid_account_details($array_of_data_by_unpaid_account);

    public function cours_account_summary_and_details($request);
    public function dataset_cours_account_summary($array_of_data_by_cours_account);
    public function dataset_cours_account_details($array_of_data_by_cours_account);



    
    // public function unpaid_account($request);
    // public function dataset_unpaid_account($array_of_data_by_unpaid_account);
}
