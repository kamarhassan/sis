@php
    
    function render_menu_front($items, $level)
    {
        foreach ($items as $key => $element) {
            echo ' <li class="dd-item" data-id=" ' . $element->id . ' ">';
            if ($level == 1) {
                $mega_menu = $element->mega_menu;
            }
            $level = $level;
            echo '<div class="card box-make-menu" id="accordion_' . $element->id . '">';
            echo '<div class="card-header item_header" id="heading_' . $element->id . '">';
            echo ' <div class="dd-handle" style="width: 85%">';
            echo '  <div>';
            echo $element->title . ' (' . $element->type . ')';
            echo '</div>';
            echo ' </div>';
            echo ' <div class="float-right ">';
            echo '<a href="javascript:void(0);" onclick="" data-toggle="collapse"';
            echo 'data-target="#collapse_' . $element->id . '" aria-expanded="false"';
            echo 'aria-controls="collapse_' . $element->id . '">';
            echo '<i class="fa fa-chevron-down text-warning"></i>';
            echo '</a>';
    
            // echo '<a href="javascript:void(0);" onclick="delete_by_id( ' . $element->id . ',\''.json_encode(swal_fire_msg()). '\' );"  class="primary-btn small fix-gr-bg text-center button">';
            // echo '<i class="ti-close text-danger"></i>';
            // echo '</a>';
 
            echo Blade::render('cms::admin.menubuilder.action-delete-edit.delete-menu-form', ['id'=>$element->id, 'swal_fire_msg'=>json_encode(swal_fire_msg())]);
            echo '</div>';
            echo '</div>';
    
             // echo Blade::render('cms::admin.menubuilder.action-delete-edit.edit-menu-form', ['element_page_id'=>$element->element_id,'element_id' => $element->id, 'element_type' => $element->type, 'element_is_newtab' => $element->is_newtab, 'element_parent_id' => $element->parent_id, 'element_mega_menu' => $element->mega_menu, 'element_show' => $element->show, 'mega_menu' => $element->mega_menu, 'element_link' => $element->link , 'element_mega_menu_column' =>$element->mega_menu_column]);
    
            echo '     </div>';
            // dd($element->children)
            if (!empty($element->childs)) {
                echo '<ol class="dd-list"> ';
                render_menu_front($element->childs, $level + 1); // Recursive call
                echo ' </ol>';
            }
    
            echo '</li>';
        }
    }
    
@endphp





@if (count(@$menus) > 0)
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div id="accordion" class="dd">
                        <ol class="dd-list">
                            {{ render_menu_front($menus, 1) }}

                            {{--               {{render_menu_front($items,1)}} --}}

                            {{-- @foreach ($menus as $key => $element)
                         @php
                             $mega_menu = $element->mega_menu;
                             $level = 1;
                         @endphp
                         <li class="dd-item" data-id="{{ $element->id }}">
                             <div class="card box-make-menu" id="accordion_{{ $element->id }}">
                                 <div class="card-header item_header" id="heading_{{ $element->id }}">
                                     <div class="dd-handle" style="width: 85%">
                                         <div>
                                             {{ $element->title }} ( {{ $element->type }} )
                                         </div>
                                     </div>
                                     <div class="float-right ">
                                         <a href="javascript:void(0);" onclick="" data-toggle="collapse"
                                             data-target="#collapse_{{ $element->id }}" aria-expanded="false"
                                             aria-controls="collapse_{{ $element->id }}">
                                             <i class="fa fa-chevron-down text-warning"></i>
                                             <span class="collapge_arrow_normal"></span>
                                         </a>
                                         <a href="javascript:void(0);"
                                             onclick="delete_by_id('{{ route('cms.headermenu.delete') }}', '{{ $element->id }}', '{{ csrf_token() }}', '{{ json_encode(swal_fire_msg()) }}')"onclick="elementDelete({{ $element->id }})"
                                             class="primary-btn small fix-gr-bg text-center button">
                                             <i class="ti-close text-danger"></i>
                                         </a>
                                     </div>
                                 </div>
                                 @include('cms::admin.menubuilder.edit-menu-form')
                             </div>

                             <ol class="dd-list">
                                 @foreach ($element->childs as $key => $element)
                                     @php
                                         $level = 2;
                                     @endphp
                                     <li class="dd-item" data-id="{{ $element->id }}">
                                         <div class="card box-make-menu" id="accordion_{{ $element->id }}">
                                             <div class="card-header item_header"
                                                 id="heading_{{ $element->id }}">
                                                 <div class="dd-handle">
                                                     <div class="float-left">
                                                         {{ $element->title }} ( {{ $element->type }} )
                                                     </div>
                                                 </div>
                                                 <div class="float-right btn_div">
                                                     <a href="javascript:void(0);" onclick=""
                                                         data-toggle="collapse"
                                                         data-target="#collapse_{{ $element->id }}"
                                                         aria-expanded="false"
                                                         aria-controls="collapse_{{ $element->id }}"
                                                         class="primary-btn small fix-gr-bg text-center button panel-title ">
                                                         <i class="fa-search-plus settingBtn"></i>
                                                         <span class="collapge_arrow_normal"></span></a>
                                                     <a href="javascript:void(0);"
                                                         onclick="elementDelete({{ $element->id }})"
                                                         class="primary-btn small fix-gr-bg text-center button"><i
                                                             class="ti-close"></i></a>
                                                 </div>
                                             </div>
                                             @include('cms::admin.menubuilder.edit-menu-form')
                                         </div>
                                     </li>
                                     
                                     <ol class="dd-list">
                                         @foreach ($element->childs as $key => $element)
                                             @php
                                                 $level = 3;
                                             @endphp
                                             <li class="dd-item" data-id="{{ $element->id }}">
                                                 <div class="card box-make-menu"
                                                     id="accordion_{{ $element->id }}">
                                                     <div class="card-header item_header"
                                                         id="heading_{{ $element->id }}">
                                                         <div class="dd-handle">
                                                             <div class="float-left">
                                                                 {{ $element->title }} ( {{ $element->type }} )
                                                             </div>
                                                         </div>
                                                         <div class="float-right btn_div">
                                                             <a href="javascript:void(0);" onclick=""
                                                                 data-toggle="collapse"
                                                                 data-target="#collapse_{{ $element->id }}"
                                                                 aria-expanded="false"
                                                                 aria-controls="collapse_{{ $element->id }}"
                                                                 class="primary-btn small fix-gr-bg text-center button panel-title">
                                                                 <i class="fa-search-plus settingBtn"></i>
                                                                 <span class="collapge_arrow_normal"></span></a>
                                                             <a href="javascript:void(0);"
                                                                 onclick="elementDelete({{ $element->id }})"
                                                                 class="primary-btn small fix-gr-bg text-center button"><i
                                                                     class="ti-close"></i></a>
                                                         </div>
                                                     </div>
                                                     @include('cms::admin.menubuilder.edit-menu-form')
                                                 </div>
                                             </li>
                                             <ol class="dd-list">
                                                 @foreach ($element->childs as $key => $element)
                                                     @php
                                                         $level = 4;
                                                     @endphp
                                                     <li class="dd-item" data-id="{{ $element->id }}">
                                                         <div class="card box-make-menu"
                                                             id="accordion_{{ $element->id }}">
                                                             <div class="card-header item_header"
                                                                 id="heading_{{ $element->id }}">
                                                                 <div class="dd-handle">
                                                                     <div class="float-left">
                                                                         {{ $element->title }} (
                                                                         {{ $element->type }} )
                                                                     </div>
                                                                 </div>
                                                                 <div class="float-right btn_div">
                                                                     <a href="javascript:void(0);" onclick=""
                                                                         data-toggle="collapse"
                                                                         data-target="#collapse_{{ $element->id }}"
                                                                         aria-expanded="false"
                                                                         aria-controls="collapse_{{ $element->id }}"
                                                                         class="primary-btn small fix-gr-bg text-center button panel-title">
                                                                         <i
                                                                             class="fa-search-plus settingBtn"></i>
                                                                         <span
                                                                             class="collapge_arrow_normal"></span></a>
                                                                     <a href="javascript:void(0);"
                                                                         onclick="elementDelete({{ $element->id }})"
                                                                         class="primary-btn small fix-gr-bg text-center button"><i
                                                                             class="ti-close"></i></a>
                                                                 </div>
                                                             </div>
                                                             @include('cms::admin.menubuilder.edit-menu-form')
                                                         </div>
                                                     </li>
                                                     <ol class="dd-list">
                                                         @foreach ($element->childs as $key => $element)
                                                             @php
                                                                 $level = 5;
                                                             @endphp
                                                             <li class="dd-item" data-id="{{ $element->id }}">
                                                                 <div class="card box-make-menu"
                                                                     id="accordion_{{ $element->id }}">
                                                                     <div class="card-header item_header"
                                                                         id="heading_{{ $element->id }}">
                                                                         <div class="dd-handle">
                                                                             <div class="float-left">
                                                                                 {{ $element->title }} (
                                                                                 {{ $element->type }} )
                                                                             </div>
                                                                         </div>
                                                                         <div class="float-right btn_div">
                                                                             <a href="javascript:void(0);"
                                                                                 onclick=""
                                                                                 data-toggle="collapse"
                                                                                 data-target="#collapse_{{ $element->id }}"
                                                                                 aria-expanded="false"
                                                                                 aria-controls="collapse_{{ $element->id }}"
                                                                                 class="primary-btn small fix-gr-bg text-center button panel-title">
                                                                                 <i
                                                                                     class="fa-search-plus fa-search-plus settingBtn"></i>
                                                                                 <span
                                                                                     class="collapge_arrow_normal"></span></a>
                                                                             <a href="javascript:void(0);"
                                                                                 onclick="elementDelete({{ $element->id }})"
                                                                                 class="primary-btn small fix-gr-bg text-center button"><i
                                                                                     class="ti-close"></i></a>
                                                                         </div>
                                                                     </div>
                                                                     @include('cms::admin.menubuilder.edit-menu-form')
                                                                 </div>
                                                             </li>
                                                             <ol class="dd-list">
                                                                 @foreach ($element->childs as $key => $element)
                                                                     @php
                                                                         $level = 6;
                                                                     @endphp
                                                                     <li class="dd-item"
                                                                         data-id="{{ $element->id }}">
                                                                         <div class="card box-make-menu"
                                                                             id="accordion_{{ $element->id }}">
                                                                             <div class="card-header item_header"
                                                                                 id="heading_{{ $element->id }}">
                                                                                 <div class="dd-handle">
                                                                                     <div class="float-left">
                                                                                         {{ $element->title }} (
                                                                                         {{ $element->type }} )
                                                                                     </div>
                                                                                 </div>
                                                                                 <div
                                                                                     class="float-right btn_div">
                                                                                     <a href="javascript:void(0);"
                                                                                         onclick=""
                                                                                         data-toggle="collapse"
                                                                                         data-target="#collapse_{{ $element->id }}"
                                                                                         aria-expanded="false"
                                                                                         aria-controls="collapse_{{ $element->id }}"
                                                                                         class="primary-btn small fix-gr-bg text-center button panel-title">
                                                                                         <i
                                                                                             class="fa-search-plus fa-search-plus settingBtn"></i>
                                                                                         <span
                                                                                             class="collapge_arrow_normal"></span></a>
                                                                                     <a href="javascript:void(0);"
                                                                                         onclick="elementDelete({{ $element->id }})"
                                                                                         class="primary-btn small fix-gr-bg text-center button"><i
                                                                                             class="ti-close"></i></a>
                                                                                 </div>
                                                                             </div>
                                                                             @include('cms::admin.menubuilder.edit-menu-form')
                                                                         </div>
                                                                     </li>
                                                                     <ol class="dd-list">
                                                                         @foreach ($element->childs as $key => $element)
                                                                             @php
                                                                                 $level = 7;
                                                                             @endphp
                                                                             <li class="dd-item"
                                                                                 data-id="{{ $element->id }}">
                                                                                 <div class="card box-make-menu"
                                                                                     id="accordion_{{ $element->id }}">
                                                                                     <div class="card-header item_header"
                                                                                         id="heading_{{ $element->id }}">
                                                                                         <div class="dd-handle">
                                                                                             <div
                                                                                                 class="float-left">
                                                                                                 {{ $element->title }}
                                                                                                 (
                                                                                                 {{ $element->type }}
                                                                                                 )
                                                                                             </div>
                                                                                         </div>
                                                                                         <div
                                                                                             class="float-right btn_div">
                                                                                             <a href="javascript:void(0);"
                                                                                                 onclick=""
                                                                                                 data-toggle="collapse"
                                                                                                 data-target="#collapse_{{ $element->id }}"
                                                                                                 aria-expanded="false"
                                                                                                 aria-controls="collapse_{{ $element->id }}"
                                                                                                 class="primary-btn small fix-gr-bg text-center button panel-title">
                                                                                                 <i
                                                                                                     class="fa-search-plus fa-search-plus settingBtn"></i>
                                                                                                 <span
                                                                                                     class="collapge_arrow_normal"></span></a>
                                                                                             <a href="javascript:void(0);"
                                                                                                 onclick="elementDelete({{ $element->id }})"
                                                                                                 class="primary-btn small fix-gr-bg text-center button"><i
                                                                                                     class="ti-close"></i></a>
                                                                                         </div>
                                                                                     </div>
                                                                                     @include('cms::admin.menubuilder.edit-menu-form')
                                                                                 </div>
                                                                             </li>
                                                                             <ol class="dd-list">
                                                                                 @foreach ($element->childs as $key => $element)
                                                                                     @php
                                                                                         $level = 8;
                                                                                     @endphp
                                                                                     <li class="dd-item"
                                                                                         data-id="{{ $element->id }}">
                                                                                         <div class="card box-make-menu"
                                                                                             id="accordion_{{ $element->id }}">
                                                                                             <div class="card-header item_header"
                                                                                                 id="heading_{{ $element->id }}">
                                                                                                 <div
                                                                                                     class="dd-handle">
                                                                                                     <div
                                                                                                         class="float-left">
                                                                                                         {{ $element->title }}
                                                                                                         (
                                                                                                         {{ $element->type }}
                                                                                                         )
                                                                                                     </div>
                                                                                                 </div>
                                                                                                 <div
                                                                                                     class="float-right btn_div">
                                                                                                     <a href="javascript:void(0);"
                                                                                                         onclick=""
                                                                                                         data-toggle="collapse"
                                                                                                         data-target="#collapse_{{ $element->id }}"
                                                                                                         aria-expanded="false"
                                                                                                         aria-controls="collapse_{{ $element->id }}"
                                                                                                         class="primary-btn small fix-gr-bg text-center button panel-title">
                                                                                                         <i
                                                                                                             class="fa-search-plus fa-search-plus settingBtn"></i>
                                                                                                         <span
                                                                                                             class="collapge_arrow_normal"></span></a>
                                                                                                     <a href="javascript:void(0);"
                                                                                                         onclick="elementDelete({{ $element->id }})"
                                                                                                         class="primary-btn small fix-gr-bg text-center button"><i
                                                                                                             class="ti-close"></i></a>
                                                                                                 </div>
                                                                                             </div>
                                                                                             @include('cms::admin.menubuilder.edit-menu-form')
                                                                                         </div>
                                                                                     </li>
                                                                                     <ol class="dd-list">
                                                                                         @foreach ($element->childs as $key => $element)
                                                                                             @php
                                                                                                 $level = 9;
                                                                                             @endphp
                                                                                             <li class="dd-item"
                                                                                                 data-id="{{ $element->id }}">
                                                                                                 <div class="card box-make-menu"
                                                                                                     id="accordion_{{ $element->id }}">
                                                                                                     <div class="card-header item_header"
                                                                                                         id="heading_{{ $element->id }}">
                                                                                                         <div
                                                                                                             class="dd-handle">
                                                                                                             <div class="float-left"
                                                                                                                 style="width: 100%">
                                                                                                                 {{ $element->title }}
                                                                                                                 (
                                                                                                                 {{ $element->type }}
                                                                                                                 )
                                                                                                             </div>
                                                                                                         </div>
                                                                                                         <div
                                                                                                             class="float-right btn_div">
                                                                                                             <a href="javascript:void(0);"
                                                                                                                 onclick=""
                                                                                                                 data-toggle="collapse"
                                                                                                                 data-target="#collapse_{{ $element->id }}"
                                                                                                                 aria-expanded="false"
                                                                                                                 aria-controls="collapse_{{ $element->id }}"
                                                                                                                 class="primary-btn small fix-gr-bg text-center button panel-title">
                                                                                                                 <i
                                                                                                                     class="fa-search-plus fa-search-plus settingBtn"></i>
                                                                                                                 <span
                                                                                                                     class="collapge_arrow_normal"></span></a>
                                                                                                             <a href="javascript:void(0);"
                                                                                                                 onclick="elementDelete({{ $element->id }})"
                                                                                                                 class="primary-btn small fix-gr-bg text-center button"><i
                                                                                                                     class="ti-close"></i></a>
                                                                                                         </div>
                                                                                                     </div>
                                                                                                     @include('cms::admin.menubuilder.edit-menu-form')
                                                                                                 </div>
                                                                                             </li>
                                                                                         @endforeach
                                                                                     </ol>
                                                                                     <ol class="dd-list">
                                                                                         @foreach ($element->childs as $key => $element)
                                                                                             @php
                                                                                                 $level = 10;
                                                                                             @endphp
                                                                                             <li class="dd-item"
                                                                                                 data-id="{{ $element->id }}">
                                                                                                 <div class="card box-make-menu"
                                                                                                     id="accordion_{{ $element->id }}">
                                                                                                     <div class="card-header item_header"
                                                                                                         id="heading_{{ $element->id }}">
                                                                                                         <div
                                                                                                             class="dd-handle">
                                                                                                             <div
                                                                                                                 class="float-left">
                                                                                                                 {{ $element->title }}
                                                                                                                 (
                                                                                                                 {{ $element->type }}
                                                                                                                 )
                                                                                                             </div>
                                                                                                         </div>
                                                                                                         <div
                                                                                                             class="float-right btn_div">
                                                                                                             <a href="javascript:void(0);"
                                                                                                                 onclick=""
                                                                                                                 data-toggle="collapse"
                                                                                                                 data-target="#collapse_{{ $element->id }}"
                                                                                                                 aria-expanded="false"
                                                                                                                 aria-controls="collapse_{{ $element->id }}"
                                                                                                                 class="primary-btn small fix-gr-bg text-center button panel-title">
                                                                                                                 <i
                                                                                                                     class="fa-search-plus fa-search-plus settingBtn"></i>
                                                                                                                 <span
                                                                                                                     class="collapge_arrow_normal"></span></a>
                                                                                                             <a href="javascript:void(0);"
                                                                                                                 onclick="elementDelete({{ $element->id }})"
                                                                                                                 class="primary-btn small fix-gr-bg text-center button"><i
                                                                                                                     class="ti-close"></i></a>
                                                                                                         </div>
                                                                                                     </div>
                                                                                                     @include('cms::admin.menubuilder.edit-menu-form')
                                                                                                 </div>
                                                                                             </li>
                                                                                         @endforeach
                                                                                     </ol>
                                                                                 @endforeach
                                                                             </ol>
                                                                         @endforeach
                                                                     </ol>
                                                                 @endforeach
                                                             </ol>
                                                         @endforeach
                                                     </ol>
                                                 @endforeach
                                             </ol>
                                         @endforeach
                                     </ol>
                                 @endforeach

                             </ol>
                         </li>
                     @endforeach --}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="card">
        <div class="card-body text-center">
            @lang('frontendmanage.Not Found Data')
        </div>
    </div>
@endif
