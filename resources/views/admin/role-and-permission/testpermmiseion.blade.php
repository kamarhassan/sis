@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')
@endsection
@section('content')

    <div class="box">
        <div class="box-body ">
            {{-- <form action=""> --}}


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
                            <input type="hidden" name="tab" value="{{ $tab['tab_name'] }}">
                        </li>
                    @endforeach
                @endisset
            </ul>
            <div class="tab-content">
                @isset($permission)
                    @foreach ($permission as $tab_names => $item)
                        <div id="{{ $tab_names }}"
                            class="tab-pane  
                        @if ($item_counter_active == 0) active @php
                        $item_counter_active++;
                    @endphp @endif">

                            <table class="table table-striped">


                                @foreach ($item as $item_in_tab => $permission_in_tab)
                                    {{-- <input type="hidden" name="permission[]" value="{{ $item_in_tab }}"> --}}
                                    <tr>
                                        {{-- <td>1</td>
                                        <td>2</td> --}}
                                        <td>
                                            <div class="row">
                                        @foreach ($permission_in_tab as $permission)
                                            
                                                <div class="demo-checkbox">
                                                    <input type="checkbox" name="per[]"
                                                        id="md_checkbox_{{ $permission['id'] }}" class="chk-col-primary" />
                                                    <label
                                                        for="md_checkbox_{{ $permission['id'] }}">{{ $permission['name'] }}</label>
                                                </div>
                                         
                                        @endforeach
                                     </div>
                                      </td></tr>
                                @endforeach
                            </table>
                        </div>
                    @endforeach
                @endisset
            </div>
            {{-- </form> --}}
        </div>
    </div>




@endsection


@section('script')
@endsection
