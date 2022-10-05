<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repository\User\UserInterface;
use App\Repository\Cours\CoursInterface;
use App\Repository\Cours_fee\CoursFeeInterface;
use App\Http\Requests\RegistrationStydentsRequest;
use App\Repository\AdminNotification\AdminNotificationInterface;
use App\Repository\RegisterCours\RegisterCoursInterface;

class RegistartionStudentsController extends Controller
{
    protected $userrepository;
    protected $coursrepository;
    protected $coursfeerepository;
    protected $registerCoursrepository;
    protected $adminnotoficationrepository;
    public function __construct(
        UserInterface $userinterface,
        CoursInterface $coursinterface,
        CoursFeeInterface $coursfee,
        RegisterCoursInterface $registerCours,
        AdminNotificationInterface $adminnotofication
    ) {
        $this->userrepository = $userinterface;
        $this->coursrepository = $coursinterface;
        $this->coursfeerepository = $coursfee;
        $this->registerCoursrepository = $registerCours;
        $this->adminnotoficationrepository = $adminnotofication; 
     }

    public function approve_user_register(Request $request)
    {



        $user_info = $this->userrepository->get_user_by_id($request->user_id);
        $cours_fee_currency = $this->coursrepository->cours_fee_currency($request->cours_id);
        $cours_info = $this->coursrepository->is_defined($request->cours_id);
        $grade = $cours_info->grade;
        $level = $cours_info->level;
        $cours_fee = $this->coursfeerepository->cours_fee_with_type($cours_info);
        $total_cours_fee = $cours_fee->sum('value');
        $route = route('admin.notification.approve.edit.register');
        return response()->json([
            'status' => 'success',
            'user_info' => $user_info,
            'cours_details' => $cours_info,
            'cours_fee' => $cours_fee,
            'total_cours_fee' => $total_cours_fee,
            'cours_fee_currency' => $cours_fee_currency,
            'route' => $route,
        ]);
        // return response()->json([
        //     'status' => 'success',
        //     'user_info' => $user_info,
        //     'cours_details' => $cours_info,
        //     'cours_fee' => $cours_fee,
        //     'total_cours_fee' => $total_cours_fee,         
        // ]);
    }
    public function approve_edit_register(RegistrationStydentsRequest $request)
    {
      
        $user_info = $this->userrepository->get_user_by_id($request->user_id);
        $cours_info = $this->coursrepository->is_defined($request->cours_id);
        $cours_fee_currency = $this->coursrepository->cours_fee_currency($request->cours_id);
        $grade = $cours_info->grade;
        $level = $cours_info->level;
        $cours_fee = $this->coursfeerepository->cours_fee_with_type($cours_info);
        $teachear_name = $this->coursrepository->cours_theacher_name($cours_info);
        $total_cours_fee = $cours_fee->sum('value');
        $this->adminnotoficationrepository->approve_all_notification($request->order_id);
        return view(
            'admin.students.approve-registration.approve-registration',
            compact([
                'user_info', 'cours_info', 'cours_fee', 'cours_fee_currency', 'total_cours_fee'
            ])
        );
    }

    public function approved_new_register(RegistrationStydentsRequest $request)
    {
         
        try {
            //code...
            DB::beginTransaction();
            $feerequired = $this->coursfeerepository->get_fee_required_cours($request->feerequired);
            $cours_fee_total = array_sum(array_column($feerequired, 'fee_value'));

            $std_registragtion = $this->registerCoursrepository->registration_user_in_cours($request, $cours_fee_total);
            $route = route(
                'admin.payment.user_paid_for_cours',
                [$std_registragtion->cours_id, $std_registragtion->user_id]
            );

            DB::commit();
            if ($std_registragtion) {
                $status = 'success';
                $message = __('site.students created successfully!');
            } else {
                $status = 'error';
                $message = __('site.fail created successfully!');
            }
            return response()->json(['status' => $status, 'message' => $message,'route'=>$route]);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
