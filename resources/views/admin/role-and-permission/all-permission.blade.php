

    <div class="col-md-12">
        @lang('site.permission for students')
    </div>


    <ul class="sidebar-menu " data-widget="tree">
    <li class="treeview active menu-open ">
        <a href="#">
            {{-- <i class="ti-settings"></i> --}}
            <span> @lang('site.setting')</span>

            <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <div class="row">
                {{-- <div class="demo-checkbox "> --}}
                <div class="col-md-4">
                    <input type="checkbox" name="setting[create_edit_levels]" id="create_edit_levels" class="chk-col-warning" />
                    <label for="create_edit_levels" class="text-success">@lang('site.create_edit levels') </label>
                </div>
                <div class="col-md-4">
                    <input type="checkbox" name="setting[create_edit_grades]" id="create_edit_grades" class="chk-col-warning" />
                    <label for="create_edit_grades" class="text-success">@lang('site.create_edit grades') </label>
                </div>

                <div class="col-md-4">
                    <input type="checkbox" name="setting[activate_currency]" id="activate_currency" class="chk-col-warning" />
                    <label for="activate_currency" class="text-success ">@lang('site.activate currency') </label>
                </div>


                <div class="col-md-4">
                    <input type="checkbox" name="setting[create_edit_roles]" id="md_checkbox_create_edit_roles" class="chk-col-warning" />
                    <label for="md_checkbox_create_edit_roles" class="text-success">@lang('site.create_edit roles') </label>
                </div>
                {{-- </div> --}}
            </div>
        </ul>
    </li>
    <li class="treeview active menu-open ">
        <a href="#">
            {{-- <i class="ti-settings"></i> --}}
            <span> @lang('site.cours')</span>

            <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <div class="row">
                {{-- <div class="demo-checkbox "> --}}
                <div class="col-md-4">
                    <input type="checkbox" name="cours[cours]" id="cours" class="chk-col-warning" />
                    <label for="cours" class="text-success">@lang('site.cours') </label>
                </div>
                <div class="col-md-4">
                    <input type="checkbox" name="cours[show_all_cours]" id="show_all_cours" class="chk-col-warning" />
                    <label for="show_all_cours" class="text-success">@lang('site.show all cours') </label>
                </div>

                <div class="col-md-4">
                    <input type="checkbox" name="cours[add_cours]" id="add_cours" class="chk-col-warning" />
                    <label for="add_cours" class="text-success ">@lang('site.add cours') </label>
                </div>


                {{-- <div class="col-md-4">
                    <input type="checkbox" name="setting[]" id="md_checkbox_create_edit_roles" class="chk-col-warning" />
                    <label for="md_checkbox_create_edit_roles" class="text-success">@lang('site.create_edit roles') </label>
                </div> --}}
                {{-- </div> --}}
            </div>
        </ul>
    </li>



    </ul>




