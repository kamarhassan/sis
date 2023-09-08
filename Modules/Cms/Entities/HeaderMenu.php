<?php

namespace Modules\Cms\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderMenu extends Model
{
   use HasFactory;

   protected $guarded = [];

   protected static function newFactory()
   {
      return \Modules\Cms\Database\factories\HeaderMenuFactory::new();
   }

   public function childs()
   {
       return $this->hasMany(HeaderMenu::class, 'parent_id', 'id')->orderBy('position');
   }
// 
public function children()
{
    return $this->hasMany(HeaderMenu::class, 'parent_id', 'id')->orderBy('position');
}
   public function parent()
   {
      return $this->belongsTo(HeaderMenu::class, 'parent_id');
   }
   
   
   public static function menu($parent_id =null)
   {
      $menuItems = HeaderMenu::where('parent_id',$parent_id)->get();
      $menu = [];

      foreach ($menuItems as $menuItem) {
         $menuItemData = [
            'id' => $menuItem->id,
            'type' =>$menuItem->type,
            'element_id' => $menuItem->element_id,
            'title' => $menuItem->title,
            'link' => $menuItem->link,
            'children' => HeaderMenu::menu($menuItem->id)
         ];

         $menu[] = $menuItemData;
      }

      return $menu;
   }

}
