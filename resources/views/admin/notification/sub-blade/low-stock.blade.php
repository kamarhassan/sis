<div class="modal bs-examplemodal-lg  center-modal  modal-primary" id="modal-center" tabindex="-1" tabindex="-1"
    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {{-- <div class="modal-header"> --}}
            {{-- <h5 class="modal-title">Modal title</h5> --}}
            <a type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
            </a>

            <div class="modal-body">
                <div class="" style="background-image: {{ URL::asset('assets/images/users/team-2.jpg') }};"
                    data-overlay="2">
                    <div class="box-body text-center pb-50">
                        <div class="flex-justified">
                       

                                <div class="row bb-1 border-warning">
                                    <div class="col-md-6"> @lang('site.services info')</div>
                                    <div class="col-md-6">{{ $service['service'] }}</div>
                                </div>
                                <br>
                                <div class="row bb-1 border-warning">
                                    <div class="col-md-6">@lang('site.quantite')</div>
                                    <div class="col-md-6">{{ $service['quantity'] }} </div>
                                </div>
                                <br>
                                <div class="row bb-1 border-warning">
                                    <div class="col-md-6">@lang('site.low stock notify')</div>
                                    <div class="col-md-6">{{ $service['low_stock_notifiy'] }} </div>
                                </div>
                                <br>
                                <div class="row bb-1 border-warning">
                                    <div class="col-md-6">@lang('site.fee amount')</div>
                                    <div class="col-md-6">{{ $service['fee'] }} - {{ $service['currency']['symbol'] }}
                                    </div>
                                </div>




                         
                        </div>

                    </div>
                </div>
                <form id="user_registration" method="POST"
                    action="{{ route('admin.notification.approve.edit.register') }}">
                    @csrf

                   <input type="hidden" name="id" value="{{$notification['id']}}">



                    <div class="mailbox-controls ">
                        @can('register order delete')
                            <div class="btn-group">
                                <a type="button" class="text-white btn btn-outline btn-sm hover-danger"
                                    title="@lang('site.delete all')"
                                    onclick="delete_notification_admin_selected('{{ route('admin.notification.delete.marked') }}','user_registration','{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">
                                    <i class="ion ion-trash-a"></i>
                                </a>
                            </div>
                        @endcan
                        @can('register order aprrove')
                            <div class="btn-group">


                                <div class="btn-group">
                                    <button type="submit"
                                        class="text-white btn btn-outline btn-sm hover-success"title="@lang('site.approved')">
                                        <i class="ti ti-check"></i>
                                    </button>
                                </div>
                            </div>
                        @endcan
                        @can('register order deny')
                            <div class="btn-group">
                                <a type="button" class="text-white btn btn-outline btn-sm hover-danger"
                                    title="@lang('site.deny')"
                                    onclick="submit('{{ route('admin.notification.deny.marked') }}','user_registration');">
                                    <i class="ti ti-close"></i>
                                </a>
                            </div>
                        @endcan
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
