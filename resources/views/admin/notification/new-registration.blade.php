@extends('admin.layouts.master')
@section('title')
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
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Mailbox</h4>
            <p class="subtitle">Here is the list of mail</p>

            <div class="box-controls pull-right">
                <div class="lookup lookup-circle lookup-right">
                    <input type="text" name="s">
                </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="mailbox-controls">

                <button type="button" class="btn btn-sm checkbox-toggle btn-outline"><i
                        class="ion ion-android-checkbox-outline-blank"></i>
                </button>
                <div class="btn-group">
                    <a type="button" onclick="submit('{{route('admin.notification.delete.marked')}}','new_regitration_order');" class="btn btn-outline btn-sm"><i class="ion ion-trash-a"></i></a>
                    <a type="button" onclick=""class="btn btn-outline btn-sm"><i class="ion ion-reply"></i></a>
                    <a type="button" onclick=""class="btn btn-outline btn-sm"><i class="ion ion-share"></i></a>
                </div>

                <div class="btn-group">
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline btn-sm dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ion ion-flag margin-r-5"></i>
                            <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline btn-sm dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ion ion-folder margin-r-5"></i>
                            <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-outline btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                    1-50/200
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button type="button" class="btn btn-outline btn-sm"><i class="fa fa-chevron-right"></i></button>
                    </div>

                </div>

            </div>
            <div class="mailbox-messages">
                <div class="table-responsive"> 
                    <form  id='new_regitration_order'> 
                         @csrf
                    <table class="table no-border">
                        
                        <tbody> 
                           
                            @isset($new_order_registeration)
                           
                              
                            @foreach ($new_order_registeration as $new_order)
                                    <tr class="Row{{ $new_order['id'] }}">
                                        <td><input type="checkbox" name="order_id[]" value="{{ $new_order['id'] }}" >
                                        </td>
                                        <td hidden>{{ $new_order['id'] }}</td>
                                        <td class="w-80"><a><img class="avatar" src="../images/avatar/2.jpg"
                                                    alt="..."></a></td>
                                            
                                        <td>
                                            {{-- admin.notification.get.user.info --}}
                                            <a onclick="get_user_info('{{ route('admin.notification.get.user.info', $new_order['id']) }}','{{ csrf_token() }}');"
                                                class="mailbox-name hover-primary" data-toggle="modal"
                                                data-target="#modal-center">

                                                {{ $new_order['user']['id'] }} # {{ $new_order['user']['name'] }}</a>
                                        </td>
                                        <td class="mailbox-subject">
                                            {{ $new_order['cours_reserved']['grade']['grade'] }} #
                                            {{ $new_order['cours_reserved']['level']['level'] }}
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
        </section>
    @endsection

    @include('admin.notification.user-information')

    @section('script')
            <script type = "text/javascript">
                $(document).ready(function() {
                    var table = $('#cours_fee_datatable').DataTable({
                        scrollY: "400px",
                        // scrollX: true,
                        scrollCollapse: true,
                        paging: false,
                        // ajax: '/test/0',

                    });
                });
        </script>
       
        <script src="{{ URL::asset('assets/custome_js/save.js') }}"></script>
        <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
        <script src="{{ URL::asset('assets/assets/vendor_plugins/iCheck/icheck.js') }}"></script>
        <script src="{{ URL::asset('assets/vendor_components/perfect-scrollbar-master/perfect-scrollbar.jquery.min.js') }}">
        </script>
        <script src="{{ URL::asset('assets/app-assets/js/pages/mailbox.js') }}"></script>
        <script src="{{ URL::asset('assets/custome_js/get_info_user.js') }}"></script>
    @endsection
