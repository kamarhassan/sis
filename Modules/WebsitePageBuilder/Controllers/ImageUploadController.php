<?php

namespace Modules\AoraPageBuilder\Http\Controllers;

use App\Traits\ImageStore;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ImageUploadController extends Controller
{
    use ImageStore;


    public function upload(Request $request)
    {
        try {
            if ($request->hasFile('upload')) {
                $url = $this->saveImage($request->file('upload'));
                if (!empty($url)) {
                    $url = asset($url);
                }

                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                $msg = trans('common.Image uploaded successfully');
                $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

                @header('Content-type: text/html; charset=utf-8');
                echo $response;
            }
        } catch (\Exception $e) {
            echo '';
        }
    }
}
