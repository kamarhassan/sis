<?php

namespace Modules\Cms\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cms\Entities\FrontPage;
use Modules\Cms\Entities\HeaderMenu;

class MenuBuilderController extends Controller
{
   /**
    * Display a listing of the resource.
    * @return Renderable
    */
   public function index()
   {
      //       return 1;
      $menus = HeaderMenu::where('parent_id', NULL)->with('childs')->orderBy('position')->get();

      $allPages = FrontPage::all();
      $pages = $allPages->where('is_static', 0);
      $static_pages = $allPages->where('is_static', 1);

      return view('cms::admin.menubuilder.index', compact('menus', 'pages','static_pages'));
   }



   public function store(Request $request)
   {
      //       return $request;
      try {
         $position = HeaderMenu::count() + 1;
         // return $request;
         if ($request->type == "Dynamic Page") {
            foreach ($request->page as $data) {
               $dpage = FrontPage::findOrFail($data);
               $is_craeted =  HeaderMenu::create([
                  'title' => $dpage->title,
                  'type' => $request->type,
                  'element_id' => $data,
                  'link' => route('cms.web.front.page.show',[$dpage->slug]),//\route('frontPage', [$dpage->slug]),
                  'position' => $position
               ]);
            }
         } elseif ($request->type == "Static Page") {
 
            foreach ($request->page as $data) {
               $spage = FrontPage::findOrFail($data);
               $is_craeted =  HeaderMenu::create([
                  'title' => $spage->title,
                  'type' => $request->type,
                  'link' => url($spage->slug),
                  'element_id' => $data,
                  'position' => $position
               ]);
            }
         } elseif ($request->type == "Category") {
            foreach ($request->element_id as $data) {
               $item = Category::findOrFail($data);
               $is_craeted =  HeaderMenu::create([
                  'title' => $item->name,
                  'type' => $request->type,
                  'element_id' => $data,
                  'link' => route('courses') . "?category=" . $data,
                  'position' => $position
               ]);
            }
         } elseif ($request->type == "Sub Category") {
            foreach ($request->element_id as $data) {
               $item = SubCategory::findOrFail($data);
               $is_craeted =  HeaderMenu::create([
                  'title' => $item->name,
                  'type' => $request->type,
                  'element_id' => $data,
                  'link' => route('courses') . "?category=" . $item->category_id,
                  'position' => $position
               ]);
            }
         } elseif ($request->type == "Course") {
            foreach ($request->element_id as $data) {
               $item = Course::findOrFail($data);
               $is_craeted =   HeaderMenu::create([
                  'title' => $item->title,
                  'type' => $request->type,
                  'element_id' => $data,
                  'link' => route('courseDetailsView', [$item->slug]),
                  'position' => $position
               ]);
            }
         } elseif ($request->type == "Quiz") {

            foreach ($request->element_id as $data) {
               $item = Course::findOrFail($data);
               $is_craeted =   HeaderMenu::create([
                  'title' => $item->title,
                  'type' => $request->type,
                  'element_id' => $data,
                  'link' => route('quizDetailsView', [$item->slug]),
                  'position' => $position
               ]);
            }
         } elseif ($request->type == "Class") {
            foreach ($request->element_id as $data) {
               $item = Course::findOrFail($data);
               $is_craeted =    HeaderMenu::create([
                  'title' => $item->title,
                  'type' => $request->type,
                  'element_id' => $data,
                  'link' => route('classDetails', [$item->slug]),
                  'position' => $position
               ]);
            }
         } elseif ($request->type == "Custom Link") {
            $is_craeted =  HeaderMenu::create([
               'title' => $request->title,
               'link' => $request->link,
               'type' => $request->type,
               'position' => $position
            ]);
         }
         // return $is_craeted;// == 1 ? $status = 'success' : $status = 'error';
         return $this->reloadWithData();
         // $is_craeted == 1 ? $status = 'success' : $status = 'error';
         // $is_craeted == 1 ? $message = __('site.Post') : $message = __('');
      } catch (\Throwable $th) {
         throw $th;
         Toastr::error('Operation Failed', 'Failed');
         return ['data'=>$this->reloadWithData(),'id_template'=>'menuList'];
      }
   }

   private function reloadWithData()
   {

      $menus = HeaderMenu::where('parent_id', NULL)->with('childs')->orderBy('position')->get();

      $allPages = FrontPage::all();
     $pages = $allPages->where('is_static', 0);
      $static_pages = $allPages->where('is_static', 1);
      //      $courses = Course::whereType(1)->whereStatus('1')->get();
      //      $quizzes = Course::whereType(2)->whereStatus('1')->get();
      //      $classes = Course::whereType(3)->whereStatus('1')->get();
      //      $categories = Category::whereStatus('1')->get();
      //      $subCategories = SubCategory::whereStatus('1')->get();
      // $menus = HeaderMenu::where('parent_id', NULL)->with('childs')->orderBy('position')->get();

      //      return view('frontendmanage::headermenu.submenu_list', compact('pages', 'static_pages',
      //         'courses', 'quizzes', 'classes', 'categories', 'subCategories', 'menus'));
      return view('cms::admin.menubuilder.menu-and-reorder',  compact('menus', 'pages','static_pages'));
      //return view('frontendmanage::headermenu.submenu_list', compact('menus'));


   }
   public function reordering(Request $request)
   {
      $menuItemOrder = json_decode($request->get('order'));
      $this->orderMenu($menuItemOrder, null);
      return true;
   }




   public function addElement(Request $request)
   {
      try {
         $position = HeaderMenu::count() + 1;
         if ($request->type == "Dynamic Page") {

            foreach ($request->element_id as $data) {
               $dpage = FrontPage::findOrFail($data);
               HeaderMenu::create([
                  'title' => $dpage->title,
                  'type' => $request->type,
                  'element_id' => $data,
                  'link' => \route('frontPage', [$dpage->slug]),
                  'position' => $position
               ]);
            }
         } elseif ($request->type == "Static Page") {
            foreach ($request->element_id as $data) {
               $spage = FrontPage::findOrFail($data);
               HeaderMenu::create([
                  'title' => $spage->title,
                  'type' => $request->type,
                  'link' => url($spage->slug),
                  'element_id' => $data,
                  'position' => $position
               ]);
            }
         } elseif ($request->type == "Category") {
            foreach ($request->element_id as $data) {
               $item = Category::findOrFail($data);
               HeaderMenu::create([
                  'title' => $item->name,
                  'type' => $request->type,
                  'element_id' => $data,
                  'link' => route('courses') . "?category=" . $data,
                  'position' => $position
               ]);
            }
         } elseif ($request->type == "Sub Category") {
            foreach ($request->element_id as $data) {
               $item = SubCategory::findOrFail($data);
               HeaderMenu::create([
                  'title' => $item->name,
                  'type' => $request->type,
                  'element_id' => $data,
                  'link' => route('courses') . "?category=" . $item->category_id,
                  'position' => $position
               ]);
            }
         } elseif ($request->type == "Course") {
            foreach ($request->element_id as $data) {
               $item = Course::findOrFail($data);
               HeaderMenu::create([
                  'title' => $item->title,
                  'type' => $request->type,
                  'element_id' => $data,
                  'link' => route('courseDetailsView', [$item->slug]),
                  'position' => $position
               ]);
            }
         } elseif ($request->type == "Quiz") {

            foreach ($request->element_id as $data) {
               $item = Course::findOrFail($data);
               HeaderMenu::create([
                  'title' => $item->title,
                  'type' => $request->type,
                  'element_id' => $data,
                  'link' => route('quizDetailsView', [$item->slug]),
                  'position' => $position
               ]);
            }
         } elseif ($request->type == "Class") {
            foreach ($request->element_id as $data) {
               $item = Course::findOrFail($data);
               HeaderMenu::create([
                  'title' => $item->title,
                  'type' => $request->type,
                  'element_id' => $data,
                  'link' => route('classDetails', [$item->slug]),
                  'position' => $position
               ]);
            }
         } elseif ($request->type == "Custom Link") {
            HeaderMenu::create([
               'title' => $request->title,
               'link' => $request->link,
               'type' => $request->type,
               'position' => $position
            ]);
         }
         return ['data'=>$this->reloadWithData(),'id_template'=>'menuList'];
      } catch (\Exception $e) {
         Toastr::error('Operation Failed', 'Failed');
         return $this->reloadWithData();
      }
   }


   private function orderMenu(array $menuItems, $parentId)
   {
      foreach ($menuItems as $index => $item) {

         $menuItem = HeaderMenu::findOrFail($item->id);
         $menuItem->update([
            'position' => $index + 1,
            'parent_id' => $parentId
         ]);
         if (isset($item->children)) {
            $this->orderMenu($item->children, $menuItem->id);
         }
      }
   }

   public function deleteElement(Request $request)
   {
      try {
        
         $element = HeaderMenu::find($request->id);
         if (count($element->childs) > 0) {
            foreach ($element->childs as $child) {
               $child->update(['parent_id' => $element->parent_id]);
            }
         }
         $element->delete();
         return $this->reloadWithData();
      } catch (\Exception $e) {
         return response('error');
      }
   }


   public function editElement(Request $request)
   {
      // return $request;
      $menu = HeaderMenu::find($request->get('id'));
      if ($menu) {
         if (!empty($request->title)) {
            foreach ($request->title as $key => $title) {
               $menu->setTranslation('title', $key, $title);
            }
         }
         $menu->link = $request->link;
         $menu->show = $request->from_bank_name;
         $menu->mega_menu = $request->mega_menu;
         $menu->mega_menu_column = $request->mega_menu_column;
         if (!isset($request->is_newtab)) {
            $menu->is_newtab = 0;
         } else {
            $menu->is_newtab = $request->is_newtab;
         }
         if (!empty($menu->parent_id)) {
            $menu->mega_menu = 0;
         }
         // FrontPage::find($request->page_id)->update(['slug',])
         $menu->save();
      }
      return ['data'=>$this->reloadWithData(),'id_template'=>'menuList'];
   }
}
