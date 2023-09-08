<?php

namespace Modules\AoraPageBuilder\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\AoraPageBuilder\Http\Requests\CustomPageRequest;
use Modules\AoraPageBuilder\Repositories\PageBuilderRepository;

class PageBuilderController extends Controller
{
   protected $pageBuilderRepo;

   public function __construct(PageBuilderRepository $pageBuilderRepository)
   {

      $this->pageBuilderRepo = $pageBuilderRepository;
   }

   public function index()
   {
      try {
         $data['data'] = $this->pageBuilderRepo->all();

         return view('aorapagebuilder::pages.index', $data);
      } catch (Exception $e) {
         Toastr::error($e->getMessage(), 'Error!!');
         return response()->json(['error' => $e->getMessage()], 503);
      }

   }


   public function store(CustomPageRequest $request)
   {
      try {
         $this->pageBuilderRepo->create($request->validated());
         return $this->reloadWithData();
      } catch (Exception $e) {
         Toastr::error($e->getMessage(), 'Error!!');
         return response()->json(['error' => $e->getMessage()], 503);
      }
   }

   private function reloadWithData()
   {
      try {
         $data = $this->pageBuilderRepo->all();
         return response()->json([
            'TableData' => (string)view('aorapagebuilder::pages.list', ['data' => $data]),
         ], 200);
      } catch (Exception $e) {
         Toastr::error($e->getMessage(), 'Error!!');
         return response()->json([
            'error' => $e->getMessage()
         ], 503);
      }
   }

   public function design($id)
   {
      try {
         $data['row'] = $this->pageBuilderRepo->find($id);
         return view('aorapagebuilder::pages.design', $data);
      } catch (Exception $e) {
         Toastr::error($e->getMessage(), 'Error!!');
         return response()->json(['error' => $e->getMessage()], 503);
      }
   }

   public function designUpdate(Request $request, $id)
   {
      try {
         $this->pageBuilderRepo->designUpdate($request->all(), $id);
         return response()->json(['status' => 200]);
      } catch (Exception $e) {
         Toastr::error($e->getMessage(), 'Error!!');
         return response()->json(['error' => $e->getMessage()], 503);
      }


   }

   public function show($id)
   {
      try {
         $data['row'] = $this->pageBuilderRepo->find($id);

         return view('aorapagebuilder::pages.show', $data);
      } catch (Exception $e) {
         Toastr::error($e->getMessage(), 'Error!!');
         return response()->json(['error' => $e->getMessage()], 503);
      }

   }

   public function edit($id)
   {
      try {
         $data['row'] = $this->pageBuilderRepo->find($id);
         return view('aorapagebuilder::pages.edit', $data);
      } catch (Exception $e) {
         Toastr::error($e->getMessage(), 'Error!!');
         return response()->json(['error' => $e->getMessage()], 503);
      }
   }

   public function update(CustomPageRequest $request, $id)
   {
      try {
         $this->pageBuilderRepo->update($request->validated(), $id);
         return $this->reloadWithData();
      } catch (Exception $e) {
         Toastr::error($e->getMessage(), 'Error!!');
         return response()->json(['error' => $e->getMessage()], 503);
      }
   }

   public function destroy(Request $request)
   {
      try {
         $this->pageBuilderRepo->delete($request->id);;
         return $this->reloadWithData();
      } catch (Exception $e) {
         Toastr::error($e->getMessage(), 'Error!!');
         return response()->json([
            'error' => $e->getMessage()
         ], 503);
      }
   }

   public function status(Request $request)
   {
      try {
         $this->pageBuilderRepo->status($request->except('_token'));
         return true;
      } catch (Exception $e) {
         Toastr::error($e->getMessage(), 'Error!!');
         return response()->json([
            'error' => $e->getMessage()
         ], 503);
      }
   }

   public function snippet()
   {
      try {
         return view('appointment::snippet.index');
      } catch (Exception $e) {
         Toastr::error($e->getMessage(), 'Error!!');
         return response()->json(['error' => $e->getMessage()], 503);
      }

   }

   public function slugGenerate(Request $request)
   {
      try {
         $slug = Str::slug($request->title, '-');
         return response()->json(['slug' => $slug]);
      } catch (Exception $e) {
         Toastr::error($e->getMessage(), 'Error!!');
         return response()->json(['error' => $e->getMessage()], 503);
      }
   }

   public function affSnippet()
   {
      try {
         return view(theme('snippets.index'));
      } catch (Exception $e) {
         Toastr::error($e->getMessage(), 'Error!!');
         return response()->json(['error' => $e->getMessage()], 503);
      }

   }
}
