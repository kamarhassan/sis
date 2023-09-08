<?php

namespace App\Http\Controllers\Admin;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Models\CerteficateTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Repository\Certeficate\CertificateInterface;
use App\Http\Requests\Certificate\CreateOrUpdateCertificateTemplatesRequest;

class CertificatetemplatesController extends Controller
{
   protected $certificaterepository;
   public function __construct(CertificateInterface $certificateintefcae)
   {
      $this->certificaterepository = $certificateintefcae;
   }

   public function index()
   {
      $certificate = CerteficateTemplate::get();
      return view('admin.setup.certeficate-templates.index', compact('certificate'));
   }

   public function create()
   {
      // return view
      return view('admin.setup.certeficate-templates.create-edit');
   }



   public function edit($id)
   {
      $certificate = CerteficateTemplate::find($id);
      return view('admin.setup.certeficate-templates.create-edit', compact('certificate'));
   }


   public function create_update(CreateOrUpdateCertificateTemplatesRequest $request)
   {

      // return $request;
      try {
         //code...

         $id = '';
         if ($request->id != '')
            $id = Crypt::decryptString($request->id);


         
      $request->has('isactive') ? $status = 1 : $status = 0;
      // $request->has('availabletosearche') ? $availabletosearche = 1 : $availabletosearche = 0;


         CerteficateTemplate::updateOrCreate(
            [
               'id' => $id
            ],
            [
               'name' => $request->name,
               'template' => $request->certeficate_template,
               'isactive'=>$status,
               // 'availabletosearche'=>1  
            ]
         );
         // return response()->json(['status' => 'success', '']);


         return  response()->json([
            'message' => __('site.Post created successfully!'),
            'status' => 'success',
            'route' => route('admin.certificate.templates.all')
         ]);
      } catch (\Throwable $th) {
         throw $th;
         return  response()->json([
            'message' => __('site.you have error'),
            'status' => 'error',
            'route' => '#'
         ]);
      }
   }


   public function delete(Request $request)
   {
      // $cours = $this->cours->is_defined($request->id);


      try {
         $cert = CerteficateTemplate::find($request->id); //->delete();
         if ($cert->count() > 0) {
            $cert->delete();
            $message = __('site.deleted_msg_swal_fire');
            $status = 'success';
            $route = "#";

            return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
            // return view('admin.setup.certeficate-templates.create-edit', compact('certificate'));
         }
      } catch (\Throwable $th) {
         // throw $th;
         $message = __('site.you have error');
         $status = 'error';
         $route = "#";
         return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
      }
   }
}
