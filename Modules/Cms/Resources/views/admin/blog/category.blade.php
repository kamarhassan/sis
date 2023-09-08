@extends('backend.master')

@php
    $table_name='blog_categories';
@endphp
@section('table')
    {{$table_name}}
@endsection
@section('mainContent')
    @php
        $LanguageList = getLanguageList();
    @endphp
    {!! generateBreadcrumb() !!}
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-3">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex mb-0">
                            <h3 class="mb-0"> @if(!isset($edit))
                                    {{__('courses.Add New Category') }}
                                @else
                                    {{__('courses.Update Category')}}
                                @endif</h3>
                            @if(isset($edit))
                                <a href="{{route('blog-category.store')}}"
                                   class="primary-btn small fix-gr-bg ml-4" style="line-height: 25px;"
                                   title="{{__('courses.Add New')}}">+</a>
                            @endif
                        </div>
                    </div>
                    <div class="white-box mb_30 student-details header-menu">
                        <div class="row pt-0">
                            @if(isModuleActive('FrontendMultiLang'))
                                <ul class="nav nav-tabs no-bottom-border  mt-sm-md-20 mb-10 ml-3"
                                    role="tablist">
                                    @foreach ($LanguageList as $key => $language)
                                        <li class="nav-item">
                                            <a class="nav-link  @if (auth()->user()->language_code == $language->code) active @endif"
                                               href="#element{{$language->code}}"
                                               role="tab"
                                               data-toggle="tab">{{ $language->native }}  </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        @if (isset($edit))
                            @if(permissionCheck('blog-category.update'))
                                <form action="{{route('blog-category.update')}}" method="POST" id="category-form"
                                      name="category-form" enctype="multipart/form-data">
                                    <input type="hidden" name="id"
                                           value="{{$edit->id}}">
                                    @endif
                                    @else
                                        @if(permissionCheck('blog-category.store'))
                                            <form action="{{route('blog-category.store') }}" method="POST"
                                                  id="category-form" name="category-form" enctype="multipart/form-data">
                                                @endif
                                                @endif
                                                @csrf


                                                <div class="tab-content">
                                                    @foreach ($LanguageList as $key => $language)
                                                        <div role="tabpanel"
                                                             class="tab-pane fade @if (auth()->user()->language_code == $language->code) show active @endif  "
                                                             id="element{{$language->code}}">
                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label"
                                                                               for="nameInput">{{ __('common.Title') }}
                                                                            <strong
                                                                                class="text-danger">*</strong></label>
                                                                        <input name="title[{{$language->code}}]"
                                                                               id="nameInput"

                                                                               class="primary_input_field name {{ @$errors->has('title') ? ' is-invalid' : '' }}"
                                                                               placeholder="{{ __('common.Title') }}"
                                                                               type="text"
                                                                               value="{{isset($edit)?$edit->getTranslation('title',$language->code):old('title.'.$language->code)}}" {{$errors->has('title') ? 'autofocus' : ''}}>
                                                                        @if ($errors->has('title'))
                                                                            <span class="invalid-feedback d-block mb-10"
                                                                                  role="alert">
                                                                <strong>{{ @$errors->first('title') }}</strong>
                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="row">


                                                    <div class="col-xl-12">
                                                        <div class="primary_input mb-25">
                                                            <label class="primary_input_label"
                                                                   for="parent">{{ __('common.Parent') }}</label>
                                                            <select class="primary_select mb-25" name="parent"
                                                                    id="parent">
                                                                <option value="">{{__('common.None')}}</option>
                                                                @foreach($categories as $category)
                                                                    @if(isset($edit) && $category->id==$edit->id)
                                                                        @php
                                                                            continue;
                                                                        @endphp
                                                                    @endif
                                                                    <option
                                                                        value="{{$category->id}}"
                                                                        {{isset($edit)?($edit->parent_id==$category->id?'selected':old('parent')):old('parent')}}
                                                                    >{{$category->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12">
                                                        <div class="primary_input mb-25">
                                                            <label class="primary_input_label"
                                                                   for="position_order">{{ __('courses.Position Order') }}</label>


                                                            <input name="position_order"
                                                                   class="primary_input_field name {{ @$errors->has('position_order') ? ' is-invalid' : '' }}"
                                                                   placeholder="{{ __('courses.Position Order') }}"
                                                                   type="number"
                                                                   value="{{isset($edit)?$edit->position_order:old('position_order',$max_id)}}" {{$errors->has('position_order') ? 'autofocus' : ''}}>
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-12 text-center">
                                                        <div class="d-flex justify-content-center pt_20">
                                                            <button type="submit"
                                                                    class="primary-btn semi_large fix-gr-bg"
                                                                    data-toggle="tooltip"
                                                                    id="save_button_parent">
                                                                <i class="ti-check"></i>
                                                                @if(!isset($edit))
                                                                    {{ __('common.Save') }}
                                                                @else
                                                                    {{ __('common.Update') }}
                                                                @endif
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex mb-0">
                            <h3 class="mb-0">{{__('courses.Category List')}}</h3>
                        </div>
                    </div>
                    <div class="  QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('common.SL') }}</th>
                                        <th scope="col">{{ __('common.Name') }}</th>
                                        <th scope="col">{{ __('common.Parent') }}</th>
                                        <th scope="col">{{ __('common.Position') }} {{ __('common.ID') }}</th>
                                        <th scope="col">{{ __('common.Status') }}</th>
                                        <th scope="col">{{ __('common.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($categories as $key => $category)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>
                                                {{--                                                {{checkParent($category)}}--}}
                                                {{@$category->title }}</td>
                                            <td>{{@$category->parent->title }}</td>
                                            <td>{{@$category->position_order }}</td>

                                            <td class="nowrap">
                                                @if(permissionCheck('blog-category.changeStatus'))
                                                    <label class="switch_toggle"
                                                           for="active_checkbox{{@$category->id }}">
                                                        <input type="checkbox"
                                                               class="@if (permissionCheck('blog-category.status_update'))  status_enable_disable @endif "
                                                               id="active_checkbox{{@$category->id }}"
                                                               @if (@$category->status == 1) checked
                                                               @endif value="{{@$category->id }}">
                                                        <i class="slider round"></i>
                                                    </label>
                                                @else
                                                    {{$category->status == 1?trans('common.Active'):trans('common.Inactive')}}
                                                @endif
                                            </td>

                                            <td>
                                                <!-- shortby  -->
                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu1{{@$category->id}}" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{ __('common.Select') }}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                         aria-labelledby="dropdownMenu1{{@$category->id}}">
                                                        @if(permissionCheck('blog-category.update'))
                                                            <a class="dropdown-item edit_brand"
                                                               href="{{route('blog-category.edit',$category->id)}}">{{__('common.Edit')}}</a>
                                                        @endif
                                                        @if(permissionCheck('blog-category.destroy'))
                                                            <a onclick="confirm_modal('{{route('blog-category.destroy', $category->id)}}');"
                                                               class="dropdown-item edit_brand">{{__('common.Delete')}}</a>
                                                        @endif

                                                    </div>
                                                </div>
                                                <!-- shortby  -->
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.partials.delete_modal')
@endsection

@push('scripts')
    <script src="{{asset('public/backend/js/category.js')}}"></script>
@endpush
