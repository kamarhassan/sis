<?php

namespace Modules\WebsitePageBuilder\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cms\Traits\Image;
use Modules\WebsitePageBuilder\Http\Requests\CustomPageRequest;
use Modules\WebsitePageBuilder\Repositories\PageBuilderRepository;

class PageBuilderController extends Controller
{
   use Image;
   protected $pageBuilderRepo;

   public function __construct(PageBuilderRepository $pageBuilderRepository)
   {

      $this->pageBuilderRepo = $pageBuilderRepository;
   }

   // public function index()
   // {
   //    try {
   //       $data['data'] = $this->pageBuilderRepo->all();

   //       return view('aorapagebuilder::pages.index', $data);
   //    } catch (Exception $e) {
   //       Toastr::error($e->getMessage(), 'Error!!');
   //       return response()->json(['error' => $e->getMessage()], 503);
   //    }

   // }


   // public function store(CustomPageRequest $request)
   // {
   //    try {
   //       $this->pageBuilderRepo->create($request->validated());
   //       return $this->reloadWithData();
   //    } catch (Exception $e) {
   //       Toastr::error($e->getMessage(), 'Error!!');
   //       return response()->json(['error' => $e->getMessage()], 503);
   //    }
   // }

   // private function reloadWithData()
   // {
   //    try {
   //       $data = $this->pageBuilderRepo->all();
   //       return response()->json([
   //          'TableData' => (string)view('aorapagebuilder::pages.list', ['data' => $data]),
   //       ], 200);
   //    } catch (Exception $e) {
   //       Toastr::error($e->getMessage(), 'Error!!');
   //       return response()->json([
   //          'error' => $e->getMessage()
   //       ], 503);
   //    }
   // }

   // public function design($id)
   // {
   //    try {
   //       $data['row'] = $this->pageBuilderRepo->find($id);
   //       return view('aorapagebuilder::pages.design', $data);
   //    } catch (Exception $e) {
   //       Toastr::error($e->getMessage(), 'Error!!');
   //       return response()->json(['error' => $e->getMessage()], 503);
   //    }
   // }

   public function designUpdate(Request $request, $id)
   {
      try {
        // return $request;
         $this->pageBuilderRepo->designUpdate($request->all(), $id);
         return response()->json(['status' => 200]);
      } catch (\Throwable $e) {
         throw $e;
         // Toastr::error($e->getMessage(), 'Error!!');
         return response()->json(['error' => $e->getMessage()], 503);
      }
   }

   public function upload_image(Request $request)
   {
      $image_url = null;

      try {
         switch ($request->assetType) {
            case 'upload':
               $image_url = $this->uploadImage($request->file, 'public/images/WebsitePageBuilder/' . $request->slug . '/image');
               break;

            default:
               # code...
               break;
         }

         return response()->json(['url' => asset($image_url)]);
      } catch (\Throwable $th) {
         throw $th;
      }
   }

   // public function show($id)
   // {
   //    try {
   //       $data['row'] = $this->pageBuilderRepo->find($id);

   //       return view('aorapagebuilder::pages.show', $data);
   //    } catch (Exception $e) {
   //       Toastr::error($e->getMessage(), 'Error!!');
   //       return response()->json(['error' => $e->getMessage()], 503);
   //    }

   // }

   // public function edit($id)
   // {
   //    try {
   //       $data['row'] = $this->pageBuilderRepo->find($id);
   //       return view('aorapagebuilder::pages.edit', $data);
   //    } catch (Exception $e) {
   //       Toastr::error($e->getMessage(), 'Error!!');
   //       return response()->json(['error' => $e->getMessage()], 503);
   //    }
   // }

   // public function update(CustomPageRequest $request, $id)
   // {
   //    try {
   //       $this->pageBuilderRepo->update($request->validated(), $id);
   //       return $this->reloadWithData();
   //    } catch (Exception $e) {
   //       Toastr::error($e->getMessage(), 'Error!!');
   //       return response()->json(['error' => $e->getMessage()], 503);
   //    }
   // }

   // public function destroy(Request $request)
   // {
   //    try {
   //       $this->pageBuilderRepo->delete($request->id);;
   //       return $this->reloadWithData();
   //    } catch (Exception $e) {
   //       Toastr::error($e->getMessage(), 'Error!!');
   //       return response()->json([
   //          'error' => $e->getMessage()
   //       ], 503);
   //    }
   // }

   // public function status(Request $request)
   // {
   //    try {
   //       $this->pageBuilderRepo->status($request->except('_token'));
   //       return true;
   //    } catch (Exception $e) {
   //       Toastr::error($e->getMessage(), 'Error!!');
   //       return response()->json([
   //          'error' => $e->getMessage()
   //       ], 503);
   //    }
   // }

   // public function snippet()
   // {
   //    try {
   //       return view('appointment::snippet.index');
   //    } catch (Exception $e) {
   //       Toastr::error($e->getMessage(), 'Error!!');
   //       return response()->json(['error' => $e->getMessage()], 503);
   //    }

   // }

   // public function slugGenerate(Request $request)
   // {
   //    try {
   //       $slug = Str::slug($request->title, '-');
   //       return response()->json(['slug' => $slug]);
   //    } catch (Exception $e) {
   //       Toastr::error($e->getMessage(), 'Error!!');
   //       return response()->json(['error' => $e->getMessage()], 503);
   //    }
   // }

   // public function affSnippet()
   // {
   //    try {
   //       return view(theme('snippets.index'));
   //    } catch (Exception $e) {
   //       Toastr::error($e->getMessage(), 'Error!!');
   //       return response()->json(['error' => $e->getMessage()], 503);
   //    }

   // }
}
