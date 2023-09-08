{{-- <div class="modal center-modal fade bs-example-modal-lg" id="modal-center" tabindex="-1"> --}}
<div class="modal bs-examplemodal-lg  center-modal" id="modal-center" tabindex="-1" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="" id="permission_for_role">
                @csrf
                <div class="modal-header">
                    <span class="modal-title" id="myLargeModalLabel"> @lang('permission.role name') : </span> <input type="text"
                        class='form-control' name="role_name" id="role_name">
                    @error('role_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <a onclick="reset_permission({{ $all_permisssion}});" type="button" class="close text-warning"
                        data-dismiss="modal" aria-hidden="true">×</a>
                </div>


                <div class="modal-body">
                    <div class="box">
                        <div class="box-body no-bg">
                            <ul class="nav nav-pills mb-20 no-border">
                                @php
                                    $tab_counter_active = 0;
                                    $item_counter_active = 0;
                                @endphp
                                @isset($tab_name)
                                    @foreach ($tab_name as $tab)
                                        <li class="nav-item">
                                            <a href="#{{ $tab['tab_name'] }}"
                                                class="nav-link 
                                            @if ($tab_counter_active == 0) active @php
                                            $tab_counter_active++;
                                        @endphp @endif"
                                                data-toggle="tab" aria-expanded="false">
                                                {{ $tab['tab_name'] }}</a>

                                        </li>
                                    @endforeach
                                @endisset
                            </ul>
                            <div class="tab-content">
                                @isset($permission)
                                    @foreach ($permission as $tab_names => $permission)
                                        <div id="{{ $tab_names }}"
                                            class="tab-pane  
                                    @if ($item_counter_active == 0) active @php
                                    $item_counter_active++;
                                   @endphp @endif">
                                            {{-- <input type="hidden" name="tab" value="{{ $tab_names }}"> --}}
                                            <table class="table table-striped">
                                                @foreach ($permission as $key => $permission_in_tab)
                                                    <tr>
                                                        <td>{{ $key }}</td>
                                                        <td>
                                                            <div class="row">
                                                                @foreach ($permission_in_tab as $permission)
                                                                    <div class="demo-checkbox">
                                                                        <input type="checkbox" name="permission[]"
                                                                            id="md_checkbox_{{ $permission['id'] }}"
                                                                            class="chk-col-primary"
                                                                            value="{{ $permission['name'] }}" />
                                                                        <label for="md_checkbox_{{ $permission['id'] }}">
                                                                            {{ $permission['name'] }}
                                                                            {{-- {{ __('permission.' . $permission['name']) }} --}}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    @endforeach
                                @endisset
                            </div>
                            <div class="row">
                                <div class="text-xs-right" id="update_role" hidden>
                                    <a class="btn  glyphicon glyphicon-ok hover-success " title="@lang('site.edit')"
                                        onclick="update_permission_for_role('{{ route('admin.setting.update.permission.for.role') }}','permission_for_role','{{$all_permisssion}}');"><span
                                            class=""> @lang('site.next step')</span>
                                    </a>
                                </div>
                                <div class="text-xs-right" id="new_role">
                                    <a class="btn  glyphicon glyphicon-ok hover-success " title="@lang('site.save')"
                                        onclick="submit('{{ route('admin.setting.new.role') }}','permission_for_role');";><span
                                            class=""> @lang('site.next step')</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

