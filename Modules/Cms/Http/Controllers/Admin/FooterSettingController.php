<?php

namespace Modules\Cms\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Cms\Entities\FrontPage;
use Modules\Cms\Http\Requests\Footer\FooterCreateRequest;
use Modules\Cms\Http\Requests\Footer\FooterEditRequest;
use Modules\Cms\Repositories\FooterSettingRepository;
use Modules\Cms\Repositories\FooterWidgetRepository;
use Modules\Cms\Services\FooterSettingService;
use Modules\Cms\Services\FooterWidgetService;


class FooterSettingController extends Controller
{
   protected $footerService;
   protected $widgetService;
   protected $footerwidgetrepository;
   protected $footersettnigrepository;

//    protected $staticPageService;
   public function __construct(FooterSettingService $footerService, FooterWidgetService $widgetService, FooterSettingRepository $footersettnigrepository
      , FooterWidgetRepository $footerwidgetrepository

   )
   {
      $this->footerwidgetrepository = $footerwidgetrepository;
      $this->footersettnigrepository = $footersettnigrepository;
      $this->footerService = $footerService;
//        $this->staticPageService = $staticPageService;
      $this->widgetService = $widgetService;
   }

   public function index()
   {
      try {

         $staticPageList = FrontPage::where('status', 1)->get();
         $SectionOnePages = $this->widgetService->getAllCompany();
         $SectionTwoPages = $this->widgetService->getAllAccount();
         $SectionThreePages = $this->widgetService->getAllService();
         $SectionFourPages = $this->widgetService->getAllAbout();
         $setting = $this->footerService->getAll();
         return view('cms::admin.footer.index', compact('staticPageList', 'SectionOnePages', 'SectionTwoPages', 'SectionThreePages', 'SectionFourPages', 'setting'));
      } catch (Exception $e) {
         return $e->getMessage();
      }
   }


   public function widgetStore(FooterCreateRequest $request)
   {


      try {
         if ($request->page) {
            $page = FrontPage::where('slug', $request->page)->first();

         } else {
            $page = null;
         }


         if ($page) {
            $request->merge(['slug' => $page->slug ?? '#']);
            $request->merge(['page_id' => $page->id] ?? 0);
            $request->merge(['is_static' => $page->is_static ?? 0]);
            $request->merge(['description' => $page->details ?? '']);
         } else {
            $request->merge(['slug' => '#']);
            $request->merge(['page_id' => 0]);
            $request->merge(['is_static' => 0]);
            $request->merge(['description' => '']);
         }

         $this->footerwidgetrepository->save($request->except('_token'));


//         return redirect()->back()->with($notification);


         return response()->json([
            'messege' => __('site.Post created successfully!'),
            'status' => 'success',
            'route' => route('footerSetting.footer.index')
         ]);
      } catch (\Throwable $e) {
         throw $e;
         return $e->getMessage();
      }
   }

   public function widgetStatus(Request $request)
   {
      if (demoCheck()) {
         return redirect()->back();
      }
      try {
         $data = [
            'status' => $request->status == 1 ? 0 : 1
         ];
         return $this->widgetService->statusUpdate($data, $request->id);

      } catch (Exception $e) {
         return $e->getMessage();
      }
   }


   public function widgetUpdate(FooterCreateRequest $request)
   {


      if (demoCheck()) {
         return redirect()->back();
      }


      try {
         if ($request->page) {
            $page = FrontPage::where('slug', $request->page)->first();

         } else {
            $page = null;
         }
         if ($page) {
            $request->merge(['slug' => $page->slug ?? '#']);
            $request->merge(['page_id' => $page->id] ?? 0);
            $request->merge(['is_static' => $page->is_static ?? 0]);
            $request->merge(['description' => $page->details ?? '']);
         } else {
            $request->merge(['slug' => '#']);
            $request->merge(['page_id' => 0]);
            $request->merge(['is_static' => 0]);
            $request->merge(['description' => '']);
         }


         $request->merge(['user_id' => Auth::user()->id]);


         $this->footerwidgetrepository->update($request->except('_token'), $request->id ?? 0);


         $notification = array(
            'messege' => 'Page Updated Successfully.',
            'alert-type' => 'success'
         );
         return response()->json([
            'messege' => __('site.Post created successfully!'),
            'status' => 'success',
            'route' => route('footerSetting.footer.index')
         ]);

      } catch (Exception $e) {

         return $e->getMessage();
      }
   }

   public function contentUpdate(Request $request)
   {
//      dd($request);

      if (demoCheck()) {
         return redirect()->back();
      }
      try {
         $result = $this->footersettnigrepository->update($request->except('_token'), $request->id);

         return response()->json([
            'messege' => __('site.Post edit successfully!'),
            'status' => 'success', 'route' => route('footerSetting.footer.index')]);
//         return $result;
      } catch (\Throwable $e) {
         throw $e;
//         return $e->getMessage();
      }
   }


   public function destroy(Request $request)
   {
      $id = $request->id;
      if (demoCheck()) {
         return redirect()->back();
      }
      try {
         $this->widgetService->delete($id);


         $notification = array(
            'messege' => 'Page Deleted Successfully.',
            'alert-type' => 'success'
         );
         return response()->json([
            'messege' => 'Page Deleted Successfully.',
            'status' => 'success',
         ]);
      } catch (Exception $e) {
         return $e->getMessage();
      }
   }

   public function tabSelect($id)
   {
      Session::put('footer_tab', $id);
      return 'done';
   }
}
