<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationStydentsRequest;
use App\Repository\Cours\CoursInterface;
use App\Repository\Cours_fee\CoursFeeInterface;
use App\Repository\User\UserInterface;
use Illuminate\Http\Request;

    class RegistartionStudentsController extends Controller
{
    protected $userrepository;
    protected $coursrepository;
    protected $coursfeerepository;
    public function __construct(
        UserInterface $userinterface,
        CoursInterface $coursinterface,
        CoursFeeInterface $coursfeeintefrace
    ) {
        $this->userrepository = $userinterface;
        $this->coursrepository = $coursinterface;
        $this->coursfeerepository = $coursfeeintefrace;
    }

    public function approve_user_register(RegistrationStydentsRequest $request)
    {
        $user_info = $this->userrepository->get_user_by_id($request->user_id);
        $cours_fee_currency = $this->coursrepository->cours_fee_currency($request->cours_id);
        $cours_info = $this->coursrepository->is_defined($request->cours_id);
        $grade = $cours_info->grade;
        $level = $cours_info->level;
        $cours_fee = $this->coursfeerepository->cours_fee_with_type($cours_info);
        $total_cours_fee = $cours_fee->sum('value');
        return redirect()->route('admin.notification.approve.edit.register')->with([
            'status' => 'success',
            'user_info' => $user_info,
            'cours_details' => $cours_info,
            'cours_fee' => $cours_fee,
            'total_cours_fee' => $total_cours_fee, 
            'cours_fee_currency' =>$cours_fee_currency        
        ]);
        // return response()->json([
        //     'status' => 'success',
        //     'user_info' => $user_info,
        //     'cours_details' => $cours_info,
        //     'cours_fee' => $cours_fee,
        //     'total_cours_fee' => $total_cours_fee,         
        // ]);
    }
    public function approve_edit_register(Request $request)
    {
       return $request;
    }
}
