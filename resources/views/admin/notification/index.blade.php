@extends('admin.layouts.master')
@section('title')
    @lang('site.notifications')
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

    {{-- {{dd($low_stoc)}} --}}
    @if (current_school_year()['year'] != last_school_year()['year'])
        <div class="callout callout-danger">


            <p>{{ __('site.not are not in current school year please choose the correct year and try again later') }}</p>
        </div>
    @else
        <div class="box">


            <div class="box-body">

                <div class="mailbox-controls">

                    {{--   <a type="button" class="btn btn-sm checkbox-toggle btn-outline" id="action_after_select"><i
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
                        @endcan --}}

                </div>
            @endcan
            <div class="mailbox-messages">
                <div class="table-responsive">
                    <form id='new_regitration_order'>
                        @csrf
                        <table class="table responsive no-border" id="cours_fee_datatable">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>type</th>
                                    <th>name</th>

                                    <th>cours/message</th>
                                    <th>status</th>
                                    <th>is read</th>
                                </tr>
                            </thead>
                            <tbody>
                                @can('low_stock')
                                    @isset($low_stoc)
                                        @foreach ($low_stoc as $new_order)
                                            @include(
                                                'admin.notification.sub-blade.tr-of-notificationtable',
                                                [
                                                    'id' => $new_order['id'],
                                                    'type' => __('site.new registration'),
                                                    'name' =>
                                                        $new_order['user']['id'] .
                                                        '#' .
                                                        $new_order['user']['name'],
                                                    'route_name' => 'admin.low.stock.notification',
                                                    'subject' => __('site.low stock notify'),
                                                    'route' => route(
                                                        'admin.low.stock.notification',
                                                        $new_order['id']),
                                                    'status' => $new_order['status'],
                                                    'is_read' => $new_order['is_read'],
                                                ]
                                            )
                                        @endforeach
                                    @endisset
                                @endcan
                                @can('show new registration')
                                    @isset($new_order_registeration)
                                        @foreach ($new_order_registeration as $new_order)
                                            @include(
                                                'admin.notification.sub-blade.tr-of-notificationtable',
                                                [
                                                    'id' => $new_order['id'],
                                                    'type' => __('site.new registration'),
                                                    'name' =>
                                                        $new_order['user']['id'] .
                                                        '#' .
                                                        $new_order['user']['name'],
                                                    'route_name' => 'admin.notification.get.user.info',
                                                    'subject' =>
                                                        $new_order['cours_reserved']['category_grade_level'][
                                                            'grade'
                                                        ]['grade'] .
                                                        '#' .
                                                        $new_order['cours_reserved']['category_grade_level'][
                                                            'level'
                                                        ]['level'],
                                                    'route' => route(
                                                        'admin.notification.get.user.info',
                                                        $new_order['id']),
                                                    'status' => $new_order['status'],
                                                    'is_read' => $new_order['is_read'],
                                                    'status_message_pending' => __('site.pending'),
                                                    'status_message_approved' => __('site.approved'),
                                                    'status_message_deny' => __('site.deny'),
                                                ]
                                            )
                                        @endforeach
                                    @endisset
                                @endcan




                                @can('show contuct us')
                                    @isset($contact_us)
                                        @foreach ($contact_us as $contact)
                                            @include(
                                                'admin.notification.sub-blade.tr-of-notificationtable',
                                                [
                                                    'id' => $contact['id'],
                                                    'type' => __('site.contact us'),
                                                    'name' => $contact['name'],
                                                    'subject' => $contact['subject'],
                                                    'status' => $contact['status'],
                                                    'is_read' => $contact['is_read'],
                                                    'route_name' => 'admin.notification.contact.us',
                                                    'route' => route(
                                                        'admin.notification.contact.us',
                                                        $contact['id']),
                                                        
                                                    'status_message_pending' => __('site.pending to response'),
                                                    'status_message_approved' => __('site.answered'),
                                                    'status_message_deny' => __('site.not answered'),
                                                ]
                                            )
                                        @endforeach
                                    @endisset
                                @endcan
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @can('show new registration')
        @include('admin.notification.contact-us-sub-blade.contact-us')
    @endcan

    @can('show contuct us')
        @include('admin.notification.contact-us-sub-blade.contact-us')
    @endcan


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
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/mailbox.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/get_info_user.js') }}"></script>
@endsection
