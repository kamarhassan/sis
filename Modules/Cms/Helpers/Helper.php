<?php


function render_menu_front_website($menuItems)
{


   foreach ($menuItems as $item) {
      echo '<li class="menu-item">';
      echo '<a class="menu-link" href="' . $item['link'] . '">';
      echo '<div>' . $item['title'] . '</div>';
      echo '</a>';

      if (!empty($item['children'])) {
         echo '<ul class="sub-menu-container">';
         echo render_menu_front_website($item['children']);

         echo '</ul>';
      }

      echo '</li>';
   }


   // return $menu;
}


function ting()
{
   echo "new helper regitsr";
}


function swal_fire_msg_cms()
{

   return [
      'title' => __('site.title_of_delet_swal_fire'),
      'text_of_delet' => __('site.text_of_delet_swal_fire'),
      'confirmButtonTextof' => __('site.confirmButtonTextof_delet_swal_fire'),
      'cancelButton' => __('site.cancelButtonTextof_delet_swal_fire'),
      'deleted_msg' => __('site.deleted_msg_swal_fire'),
      'succes_msj' => __('site.succes_msj_swal_fire'),
      'failed_delete' => __('site.failed_delete'),
      'not_any_selection' => __('site.select_at_least_one_to_delete'),
   ];
}


function Settings($t)
{
   return $t;
}

function demoCheck()
{
   return false;
}


function render_footer_front()
{
   //   $footerrepo = new \Modules\Cms\Repositories\FooterWidgetRepository();

   return [
      'section1' => \Modules\Cms\Entities\FooterWidget::where('status', 1)->where('section', '1')->orderBy('id', 'ASC')->get(['id', 'name', 'slug', 'category']),
      'section2' => \Modules\Cms\Entities\FooterWidget::where('status', 1)->where('section', '2')->orderBy('id', 'ASC')->get(['id', 'name', 'slug', 'category']),
      'section3' => \Modules\Cms\Entities\FooterWidget::where('status', 1)->where('section', '3')->orderBy('id', 'ASC')->get(['id', 'name', 'slug', 'category']),
      'section4' => \Modules\Cms\Entities\FooterWidget::where('status', 1)->where('section', '4')->orderBy('id', 'ASC')->get(['id', 'name', 'slug', 'category']),
      'footersectionsetting' => \Modules\Cms\Entities\FooterSetting::orderBy('id', 'ASC')->get()
   ];
}

if (!function_exists('hasDynamicPage')) {
   function hasDynamicPage()
   {

      return true;
   }
}


if (!function_exists('assetVersion')) {
   function assetVersion()
   {
      if (config('app.debug')) {
         $ver = rand(1, 9999);
      } else {
         $ver = Storage::has('.version') ? Storage::get('.version') : Settings('system_version');
      }
      return '?v=' . 1;
   }
}


function render_comment($comment)
{
   $id_input = ["parent_id" => 'parent_id', "comment_id" => 'comment_id'];

   foreach ($comment as $item) {

      $item['parent_id'] == null ?  $parent_id = $item['id'] :  $parent_id = $item['parent_id'];
      // $item['comment_id'] == null ?  $comment_id = $item['id'] :  $comment_id =  $item['comment_id'];
     $comment_id = $item['id'] ;
   // $comment_id = $item['comment_id'];
      $data = 1; //["parent_id" => $item['comment_id'], "comment_id" => $item['id']];

      echo view('cms::frontend.blog.post-details-and-comment.comment', compact('item', 'parent_id', 'comment_id'));

      if (!empty($item['children'])) {
         echo ' <ul class=\'children\'>';
         echo render_comment($item['children']);

         echo '</ul>';
      }

      echo '</li>';
   }
}
