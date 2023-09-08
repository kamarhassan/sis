<?php

namespace Modules\Cms\Http\Controllers\FrontEnd;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cms\Entities\HeaderMenu;

class MenuBuilderController extends Controller
{
   
    public function render_menu_in_front($parent_id=null )
    {

     return  $menuItems = HeaderMenu::menu(null);
       $menu = [];

       foreach ($menuItems as $menuItem) {
          $menuItemData = [
             'id' => $menuItem->id,
             'title' => $menuItem->title,
             'url' => $menuItem->link,
             'children' => $this->render_menu_in_front($menuItem->id)
          ];

          $menu[] = $menuItemData;
       }

       return $menu;


   
    }



   
}
