<?php

namespace Modules\Cms\Http\Controllers\Admin;

//use App\Traits\ImageStore;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Cms\Entities\FooterWidget;
use Modules\Cms\Entities\FrontPage;
use Modules\Cms\Entities\HeaderMenu;
use Modules\Cms\Http\Requests\Page\CreatePageRequest;
use Modules\Cms\Traits\Image;
use Modules\Cms\Traits\ImageStore;

class FrontPageController extends Controller
{
   // use ImageStore;
   use Image;

 
   public function index()
   {

      $query = FrontPage::query();

      if (!hasDynamicPage()) {
         $query->where('is_static', '=', '0');
      } else {
         $query->where('is_static', 0)->orWhere(function ($q) {
            $slugs = [
               '/',
               '/courses',
               '/classes',
               '/quizzes',
               '/instructors',
               '/contact-us',
               '/about-us',
               '/become-instructor',
               '/blog',
               'free-course',
               'certificate-verification'
            ];
            $q->where('is_static', 1)->whereIn('slug', $slugs);
         });
      }

      $frontPages = $query->latest()->get();
      return view('cms::admin.front_page.index', compact('frontPages'));
   }


   public function create()
   {
      return view('cms::admin.front_page.create-page');
   }

   public function store(CreatePageRequest $request)
   {
      try {
//         return $request;
         $frontpage = new FrontPage();
         $frontpage->title = $request->title;
         $request->sub_title != null ? $frontpage->sub_title = $request->sub_title : $frontpage->sub_title = '';
         if ($this->checkUrl($request->slug)) {
            return response()->json([
               'status' => 'error',
               'message' => __('site.URL Already Exist'),
               'route' => redirect()->back()
            ]);
         }
         $frontpage->is_static = 0;
         $frontpage->slug = $this->createSlug(empty($request->slug) ? $frontpage->title : $request->slug);
         $is_saved = $frontpage->save();

         if ($is_saved) {
            $status = 'success';
            $message = __('site.Post created successfully!');
            $route = route('cms.admin.page');
         } else {
            $status = 'error';
            $message = __('site.you have error');
            $route = '#';
         }


         return response()->json([
            'status' => $status,
            'message' => $message,
            'route' => $route
         ]);

//         return redirect()->route('frontend.page.index');
      } catch (\Throwable $e) {

         throw  $e;
//
//         GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
      }
   }

   public function checkUrl($url = null)
   {
      $status = false;
      if (!empty($url)) {
         $routes = Route::getRoutes()->getRoutes();
         foreach ($routes as $r) {
            if ($r->uri() == $url) {
               return true;
            }
         }
      }
      return $status;
   }

   protected function createSlug(string $title): string
   {

      $slugsFound = $this->getSlugs($title);

      $counter = 0;
      $counter += $slugsFound;

      $slug = Str::slug($title) == "" ? str_replace(' ', '-', $title) : Str::slug($title);


      if ($counter) {
         $slug = $slug . '-' . $counter;
      }
      return $slug;
   }

   protected function getSlugs($title): int
   {
      return FrontPage::select()->where('title', 'like', $title)->count();
   }

   public function show($id)
   {
      $row = FrontPage::find($id);
      if (!$row) {
         abort(404);
      }
      // dd(1);
//      return route('laravelpwa.manifest');
      $active = request('lang', LaravelLocalization::getCurrentLocale());
      app()->setLocale($active);
      $data['row'] = $row;
      $data['details'] = $row->details;
      $url_template = $row->url_storage;

      return view('websitepagebuilder::page.design', compact('active', 'data', 'url_template'));
      // return view('websitepagebuilder::page.design',compact($));
   }

   public function edit($id)
   {
      $data = FrontPage::findOrFail($id);
//      return $data['editData'];
      return view('cms::admin.front_page.create-page', compact('data'));

   }

   public function update(CreatePageRequest $request)
   {


   //   return store$request;

      $id = $request->id;
      if (demoCheck()) {
         return redirect()->back();
      }
      $page = FrontPage::findOrFail($id);
      try {
         DB::beginTransaction();
         $page->title = $request->title;
         $page->sub_title = $request->sub_title;
         $page->slug = $request->slug;

         if ($this->checkUrl($request->slug)) {
            return response()->json([
               'status' => 'error',
               'message' => __('site.URL Already Exist'),
               'route' => '#'
            ]);
         }

         if ($page->is_static == 1 && !empty($request->slug)) {
            $page->slug = $this->createSlug($request->slug);
         }

         if ($request->banner != null) {
            // $page->banner = $this->saveImage($request->banner,);
         }


         $menus = HeaderMenu::where('element_id', $id)->get();
         if ($menus != null) {
            foreach ($menus as $menu) {
               $menu->title = $request->title;
               $menu->link = route('cms.web.front.page.show', $request->slug);
               $menu->save();
            }
         }

         $footers = FooterWidget::where('page_id', $page->id)->get();
         if ($footers != null) {
            foreach ($footers as $footer) {
               $footer->page = $request->slug;
               $footer->page_id = $page->id;
               $footer->slug = $request->slug;
               $footer->save();
            }
         }

         $is_saved = $page->save();


         if ($is_saved) {
            $status = 'success';
            $message = __('site.Post created successfully!');
            $route = route('cms.admin.page');
         } else {
            $status = 'error';
            $message = __('site.you have error');
            $route = '#';
         }
         
         DB::commit();

         return response()->json([
            'status' => $status,
            'message' => $message,
            'route' => $route
         ]);


      } catch (Exception $e) {
         DB::rollBack();
         return response()->json([
            'messege' =>__('site.you have error'),
            'status' =>  $status = 'error',
         ]);
         // GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
      }


   }

   public function destroy(Request $request)
   {

      $id = $request->id;
      if (demoCheck()) {
         return redirect()->back();
      }
      try {
         $page = FrontPage::where('id', $id)->first();
         if ($page->is_static != 1) {
            $page->delete();
          
            $messege = __('site.deleted');
            $status = 'success';
         } else {
            $messege = __('site.deleted');
            $status = 'error';
         }
//         Toastr::success('Operation done successfully.', 'Success');
//         return redirect()->back();
         return response()->json([
            'messege' => $messege,
            'status' => $status,
         ]);
      } catch (Exception $e) {
         return response()->json([
            'messege' =>__('site.you have error'),
            'status' =>  $status = 'error',
         ]);
        
      }
   }

   public function changeHomepage(Request $request, $id)
   {
      if (demoCheck()) {
         return redirect()->back();
      }
      FrontPage::query()->update([
         'homepage' => 0
      ]);
      FrontPage::where('id', $id)->update([
         'homepage' => 1
      ]);
      Toastr::success(trans('common.Operation successful'), trans('common.Success'));

      return redirect()->back();
   }


}
