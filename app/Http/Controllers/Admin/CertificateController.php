<?php

namespace App\Http\Controllers\Admin;

use App\Models\Grade;
use App\Models\Level;
use App\Models\Certificate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Certeficate\CertificateInterface;
use App\Http\Requests\Certificate\CertificateRequest;
use App\Http\Requests\Certificate\CertificateEditRequest;

class CertificateController extends Controller
{

    protected $certificate;

    public function __construct(
        CertificateInterface $certificate
    ) {
        $this->certificate = $certificate;
    }

    public function index()
    {
        $certificate =  $this->certificate->get_all_certificate();
        return view('admin.setup.certificate.index', compact('certificate'));
    }
    public function create()
    {
        $grades = Grade::get();
        $levels = Level::get();
        return view('admin.setup.certificate.create', compact('grades', 'levels'));
    }
    public function store_certificate(CertificateRequest $request)
    {

        try {
            $insert =   Certificate::create([
                'name' => $request->certificate,
                'grade_id' => $request->grade,
                'levels' => $request->level,
            ]);
            if ($insert) {

                $message = __('site.Post created successfully!');
                $status = 'success';
                $route = route('admin.certificate.new');
            } else {
                $message = __('site.wrong try again');
                $status = 'error';
                $route = '#';
            }

            return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
        } catch (\Throwable $th) {
            // throw $th;
            $message = __('site.wrong try again');
            $status = 'error';
            $route = '';
            return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
        }

        // return $request;
    }


    public function delete_certificate(Request $request)
    {
        // return $request;
        try {
            $certificate = Certificate::find($request->id);
            if (!$certificate) {
                $message = __('site.wrong try again');
                $status = 'error';
            } else {

                $is_delet = $certificate->delete();
                if ($is_delet) {

                    $message = __('site.succes_msj_swal_fire');
                    $status = 'success';
                }
            }
            return response()->json(['status' => $status, 'message' => $message, 'certificate' => $certificate]);
        } catch (\Throwable $th) {
            throw $th;
            // $message = __('site.wrong try again');
            // $status = 'error';
            // return response()->json(['status' => $status, 'message' => $message]);
        }
    }

    public function edit_certificate($certificate_id)
    {

        $certificate = Certificate::find($certificate_id);
        if (!$certificate) {
            toastr()->error(__('site.wrong try again'));
            return redirect()->route('admin.certificate.all');
        }
        $grades = Grade::get();
        $levels = Level::get();
        return view('admin.setup.certificate.edit', compact('grades', 'levels', 'certificate'));
    }
    public function save_edit_certificate(CertificateEditRequest $request)
    {
        // $certificate_id = decrypt($request->certificate_id);
        try {
            $certificate_updated = Certificate::find($request->certificate_id)->update([
                'name' => $request->certificate,
                'grade_id' => $request->grade,
                'levels' => $request->level
            ]);
            if ($certificate_updated) {

                $message = __('site.success update certificate');
                $status = 'success';
                $route = route('admin.certificate.all');
            } else {
                $message = __('site.wrong try again');
                $status = 'error';
                $route = '#';
            }

            return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
        } catch (\Throwable $th) {
            // throw $th;
            $message = __('site.wrong try again');
            $status = 'error';
            $route = '';
            return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
        }
        // return $request;
    }




  
}
