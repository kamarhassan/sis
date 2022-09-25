{{-- <div class="modal center-modal fade bs-example-modal-lg" id="modal-center" tabindex="-1"> --}}
<div class="modal bs-examplemodal-lg  center-modal  modal-primary" id="modal-center" tabindex="-1" tabindex="-1"
    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {{-- <div class="modal-header"> --}}
            {{-- <h5 class="modal-title">Modal title</h5> --}}
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
            </button>
            {{-- </div> --}}
            <div class="modal-body">
                <div class="" style="background-image: {{ URL::asset('assets/images/users/team-2.jpg') }};"
                    data-overlay="2">
                    <div class="box-body text-center pb-50">
                        <div class="row  flex-justified">
                            <div>
                                <span>
                                    <img class="avatar avatar-xxl avatar-bordered" id="img_profile"
                                        src="{{ URL::asset('assets/images/users/team-1.jpg') }}" alt="">
                                </span>
                                <h4 class="mt-2 mb-0"><a class="text-white"><span  id="full_name"></span></a></h4>
                                <i class="ti ti-email"></i> <span id="user_mail"></span></a> <i
                                    class="ti ti-mobile"></i> <span id="user_Phone"></span></a>
                            </div>

                            <div>
                                @lang('site.cours info') :<span id='cours_grade_level'></span>

                                <div> <i class="ti ti-calendar"></i> @lang('site.actually start date') : <span id="start_date"></span>
                                </div>
                                <div> <i class="ti ti-calendar"></i> @lang('site.actually end date') : <span id="end_date"></span>
                                </div>
                                <div> <i class="ti ti-calendar"></i> @lang('site.days') : <span id="days"></span>
                                </div>

                                <div> <i class="ti ti-user"></i>@lang('site.teacher name') : <span id="teacher_name"></span>
                                    <div class="box-bordered border-warning"> <i class="fa fa-money"></i>
                                        @lang('site.cours fees') : <br><span id="cours_fee"></span>
                                    </div>
                                    <div class="text-warning"><i class="fa fa-money"></i> @lang('site.cours fee total') : <br>
                                        <span  id="total_cours_fee" ></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            {{-- <div class="modal-footer modal-footer-uniform">
                <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-rounded btn-primary float-right">Save changes</button>
            </div> --}}
        </div>
    </div>
</div>
