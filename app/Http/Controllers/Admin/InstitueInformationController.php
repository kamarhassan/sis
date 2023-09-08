<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InstitueInfromation\EditInstitueInformation;
use App\Http\Requests\InstitueInfromation\DeleteInstitueInformation;
use App\Http\Requests\InstitueInfromation\InsertInstitueInformation;
use App\Repository\InstitueInformation\InstitueInformationInterface;

class InstitueInformationController extends Controller
{
    protected $institueinformations;
    public function __construct(
        InstitueInformationInterface $institueinformationsinterface
    ) {
        $this->institueinformations = $institueinformationsinterface;
    }
    public function index()
    {
        $institueinformations = $this->institueinformations->InstitueInformation();
        return view('admin.setup.institue-information.index', compact('institueinformations'));
    }
    public function delete_InstitueInformation(DeleteInstitueInformation $request)
    {
        try {
            // return $request;
            //code...
            $is_deleted = $this->institueinformations->DeleteByID($request->id);
            if (!$is_deleted) {
                $message = __('site.wrong try again');
                $status = 'error';
            } else {
                $message = __('site.succes_msj_swal_fire');
                $status = 'success';
            }
            return response()->json(['status' => $status, 'message' => $message]);
        } catch (\Throwable $th) {
            // throw $th;
            $message = __('site.wrong try again');
            $status = 'error';
            return response()->json(['status' => $status, 'message' => $message]);
        }
    }



    public function create()
    {

        return view('admin.setup.institue-information.create');
    }


    public function edit($id)
    {
        try {
            $InstitueInformation = $this->institueinformations->InstitueInformation_by_id($id);
            if (!$InstitueInformation) {
                toastr()->error(__('site.wrong try again'));
                return redirect()->route('admin.institue.all');
            } else {
                return view('admin.setup.institue-information.edit', compact('InstitueInformation'));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function store_InstitueInformation(InsertInstitueInformation $request)
    {
        try {
            // return $request;
            //code...
            $is_stored = $this->institueinformations->store($request);
            if (!$is_stored) {
                $message = __('site.wrong try again');
                $status = 'error';
                $route="#";
            } else {
                $message = __('site.Post created successfully!');
                $status = 'success';
                $route=route('admin.institue.all');
            }
            return response()->json(['status' => $status, 'message' => $message,'route'=>$route]);
        } catch (\Throwable $th) {
            throw $th;
            $message = __('site.wrong try again');
            $status = 'error';
            return response()->json(['status' => $status, 'message' => $message]);
        }
    }
    public function save_edit(EditInstitueInformation $request)
    {
        try {
            // return $request;
            //code...
            $is_stored = $this->institueinformations->edit($request);
            if (!$is_stored) {
                $message = __('site.wrong try again');
                $status = 'error';
                $route="#";
            } else {
                $message = __('site.Post created successfully!');
                $status = 'success';
                $route=route('admin.institue.all');
            }
            return response()->json(['status' => $status, 'message' => $message,'route'=>$route]);
        } catch (\Throwable $th) {
            throw $th;
            $message = __('site.wrong try again');
            $status = 'error';
            return response()->json(['status' => $status, 'message' => $message]);
        }
    }



}
