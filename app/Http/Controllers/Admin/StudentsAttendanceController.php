<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Repository\Admin\AdminInterface;
use Illuminate\Support\Facades\Auth;
use App\Repository\Cours\CoursInterface;

class StudentsAttendanceController extends Controller
{
    protected $coursrepos;
    protected $adminrepos;
    public function __construct(CoursInterface $coursinterface, AdminInterface $admininterfcae)
    {
        $this->coursrepos = $coursinterface;
        $this->adminrepos = $admininterfcae;
    }

    public function index()
    {

        $admin_logged = Admin::find(Auth::id());
        // $this->adminrepos->all_teacher_id();
        if (!$admin_logged->hasRole('super admin'))
            $cours = $this->coursrepos->cours_of_teacher($admin_logged->id);
        else  $cours = $this->coursrepos->cours_of_teacher($this->adminrepos->all_teacher_id()) ;
// return $cours[0]['grade'];
        return view('admin.students-attendance.index', compact('cours'));
    }
}
