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
                        <div class="row  flex-justified">
                            <div>

                                <div class="tab-pane" id="activity">
                                    <div class="box p-15">
                                        <div class="post clearfix">
                                            <div class="user-block">
                                                {{-- <img class="img-bordered-sm rounded-circle" src="../images/user7-128x128.jpg" alt="user image"> --}}
                                                <span class="username">
                                                    <a href="#">@lang('site.name') :
                                                        @isset($contact_us_info['name'])
                                                            {{ $contact_us_info['name'] }}
                                                        @endisset
                                                    </a>

                                                </span>
                                                <span class="description">
                                                    @isset($contact_us_info['time_from_send_message'])
                                                        {{ $contact_us_info['time_from_send_message'] }}
                                                    @endisset time ago
                                                </span>
                                            </div>

                                            <div class="activitytimeline">
                                                <p>
                                                    @lang('site.subject') :
                                                    @isset($contact_us_info['subject'])
                                                        {{ $contact_us_info['subject'] }}
                                                    @endisset
                                                </p>
                                                <p>
                                                    @lang('site.description cours') :
                                                    @isset($contact_us_info['message'])
                                                        {{ $contact_us_info['message'] }}
                                                    @endisset
                                                </p>

                                                <form class="message_respond" id="contact_us_respond">
                                                    <div class="form-group row no-gutters">
                                                        <div class="col-sm-12">
                                                            @csrf @isset($contact_us_info['id'])
                                                                <input type="hidden" name='id_resposned[]'
                                                                    value="{{ $contact_us_info['id'] }}"
                                                                    placeholder="subject">
                                                            @endisset



                                                            @isset($contact_us_info['email'])
                                                                <input type="hidden" name='email'
                                                                    value="{{ $contact_us_info['email'] }}"
                                                                    placeholder="subject">
                                                            @endisset
                                                            @isset($contact_us_info['id'])
                                                                <input class="form-control input-sm" required=""
                                                                    name='subject' placeholder="subject">

                                                                <textarea name="response" id="textarea" class="form-control" required="" placeholder="Response"
                                                                    aria-invalid="false"></textarea>
                                                            </div>
                                                            <div class="col-sm-3">

                                                                <a onclick="submit('{{ route('admin.notification.contact.us.respond') }}' ,'contact_us_respond');"
                                                                    type="submit"
                                                                    class="btn btn-close btn-success btn-round">
                                                                    <i class="ft-check"></i> @lang('site.answer')
                                                                </a>
                                                            @endisset
                                                         </div>
                                                      </div>
                                                   </form>
                                                   
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="contact_us_delete" method="POST"
                    action="{{ route('admin.notification.approve.edit.register') }}">
                    @csrf

                    <input hidden name="order_id[]" id="order_id"
                        @isset($contact_us_info)
                 value="  {{ $contact_us_info['id'] }}"
                @endisset>


                    <div class="mailbox-controls ">

                        <div class="btn-group">
                            <a type="button" class="text-white btn btn-outline btn-sm hover-danger"
                                title="@lang('site.delete all')"
                                onclick="delete_notification_admin_selected('{{ route('admin.notification.contact.us.delete') }}','contact_us_delete','{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}','modal-center');">
                                <i class="ion ion-trash-a"></i>
                            </a>
                        </div>

                        <div class="btn-group">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.layouts.spinner-loader.loader')
</div>
