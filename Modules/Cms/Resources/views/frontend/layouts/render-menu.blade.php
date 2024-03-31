@php
   $items = Modules\Cms\Entities\HeaderMenu::menu(null);
@endphp
{{render_menu_front_website($items,0)}}

