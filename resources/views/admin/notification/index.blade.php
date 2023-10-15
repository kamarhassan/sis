@extends('admin.layouts.master')
@section('title')
    @lang('site.new registration')
@endsection
@section('css')
    <style>
        .overlayl {
            position: fixed;

            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')


    @if (current_school_year()['year'] != last_school_year()['year'])
        <div class="callout callout-danger">


            <p>{{ __('site.not are not in current school year please choose the correct year and try again later') }}</p>
        </div>
    @else
        <div class="box">
         

            <div class="box-body">
                @canany([
                    'register order delete all',
                    'register order deny all',
                    'register order read all',
                    'register order
                    aprrove all',
                    ])
                    <div class="mailbox-controls">

                        <a type="button" class="btn btn-sm checkbox-toggle btn-outline" id="action_after_select"><i
                                class="ion ion-android-checkbox-outline-blank"></i>
                        </a>
                        @can('register order delete all')
                            <div class="btn-group">
                                <a type="button" class="btn btn-outline btn-sm hover-danger" title="@lang('site.delete all')"
                                    onclick="delete_notification_admin_selected('{{ route('admin.notification.delete.marked') }}','new_regitration_order','{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">
                                    <i class="ion ion-trash-a"></i>
                                </a>
                            </div>
                        @endcan


                        @can('register order read all')
                            <div class="btn-group">
                                <a type="button" class="btn btn-outline btn-sm hover-warning" title="@lang('site.mark all as read')"
                                    onclick="submit('{{ route('admin.notification.read.marked') }}','new_regitration_order');">
                                    <i class="fa fa-envelope-open-o"></i>
                                </a>
                            </div>
                        @endcan

                        @can('register order deny all')
                            <div class="btn-group">
                                <a type="button" class="btn btn-outline btn-sm hover-danger" title="@lang('site.deny')"
                                    onclick="submit('{{ route('admin.notification.deny.marked') }}','new_regitration_order');">
                                    <i class="ti ti-close"></i>
                                </a>
                            </div>
                        @endcan

                    </div>
                @endcan
                <div class="mailbox-messages">
                    <div class="table-responsive">
                        <form id='new_regitration_order'>
                            @csrf
                            <table class="table responsive no-border" id="cours_fee_datatable">

                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($low_stoc)
                                        @foreach ($low_stoc as $new_order)
                                            <tr class="Row{{ $new_order['id'] }}" id="Row{{ $new_order['id'] }}">
                                                <td><input type="checkbox" name="order_id[]" value="{{ $new_order['id'] }}">
                                                </td>
                                                <td class="w-80"><a><img class="avatar" src="../images/avatar/2.jpg"
                                                            alt="..."></a></td>
                                                <td>

                                                    <a href="#" class="mailbox-name hover-primary"
                                                    
                                                    onclick="get_notification_details('{{ route('admin.low.stock.notification', $new_order['id']) }}','{{ csrf_token() }}');"
                                                        >
                                                        {{ $new_order['service']['service'] }}
                                                    </a>
                                                </td>
                                                <td class="mailbox-subject">
                                                    @lang('site.low stock notify')
                                                </td>
                                                <td>
                                                    <div class="box-body ribbon-box">
                                                        @if (is_null($new_order['status']))
                                                            <div class="ribbon ribbon-warning rounded20" id="pending">
                                                                @lang('site.pending')</div>
                                                        @elseif ($new_order['status'] == 1)
                                                            <div class="ribbon ribbon-success rounded20" id="approved">
                                                                @lang('site.approved')</div>
                                                        @elseif($new_order['status'] == 0)
                                                            <div class="ribbon ribbon-danger rounded20" id="deny">
                                                                @lang('site.deny')</div>
                                                        @else
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="box-body ribbon-box">
                                                        @if ($new_order['is_read'] == 0)
                                                            <div class="ribbon ribbon-success  rounded20" id="read">
                                                                @lang('site.read')</div>
                                                        @else
                                                            <div class="ribbon ribbon-warning  rounded20" id="unread">
                                                                @lang('site.unread')</div>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset

                                    @isset($new_order_registeration)
                                        @foreach ($new_order_registeration as $new_order)
                                            <tr class="Row{{ $new_order['id'] }}" id="Row{{ $new_order['id'] }}">
                                                <td><input type="checkbox" name="order_id[]" value="{{ $new_order['id'] }}">
                                                </td>
                                                <td class="w-80"><a><img class="avatar" src="../images/avatar/2.jpg"
                                                            alt="..."></a></td>
                                                <td>
                                                    {{-- admin.notification.get.user.info --}}
                                                    <a href="#"
                                                        @can('read only register order')
                                             onclick="get_notification_details('{{ route('admin.notification.get.user.info', $new_order['id']) }}','{{ csrf_token() }}');"
            
                                                @endcan
                                                        class="mailbox-name hover-primary" 
                                                         >
                                                        {{ $new_order['user']['id'] }} # {{ $new_order['user']['name'] }}
                                                    </a>
                                                </td>
                                                <td class="mailbox-subject">
                                                    {{ $new_order['cours_reserved']['category_grade_level']['grade']['grade'] }}
                                                    #
                                                    {{ $new_order['cours_reserved']['category_grade_level']['level']['level'] }}
                                                </td>
                                                <td>
                                                    <div class="box-body ribbon-box">
                                                        @if (is_null($new_order['status']))
                                                            <div class="ribbon ribbon-warning rounded20" id="pending">
                                                                @lang('site.pending')</div>
                                                        @elseif ($new_order['status'] == 1)
                                                            <div class="ribbon ribbon-success rounded20" id="approved">
                                                                @lang('site.approved')</div>
                                                        @elseif($new_order['status'] == 0)
                                                            <div class="ribbon ribbon-danger rounded20" id="deny">
                                                                @lang('site.deny')</div>
                                                        @else
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="box-body ribbon-box">
                                                        @if ($new_order['is_read'] == 0)
                                                            <div class="ribbon ribbon-success  rounded20" id="read">
                                                                @lang('site.read')</div>
                                                        @else
                                                            <div class="ribbon ribbon-warning  rounded20" id="unread">
                                                                @lang('site.unread')</div>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset

                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.notification.sub-blade.user-information')
    @endif

@endsection


@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#cours_fee_datatable').DataTable({

                scrollY: "400px",
                // scrollX: true,
                // scrollCollapse: true,
                responsive: true,
                paging: false,
                // ajax: '/test/0',

            });
        });
    </script>
    <script src="{{ URL::asset('assets/custome_js/save.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_plugins/iCheck/icheck.js') }}"></script>
    <script
        src="{{ URL::asset('assets/assets/vendor_components/perfect-scrollbar-master/perfect-scrollbar.jquery.min.js') }}">
    </script>
    {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script> --}}

    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/app-assets/js/pages/mailbox.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/get_info_user.js') }}"></script>
@endsection
