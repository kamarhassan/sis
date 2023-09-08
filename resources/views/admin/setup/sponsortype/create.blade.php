<section id="html">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"></h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body card-dashboard">

                        <form id='grades_form'>
                            @csrf
                            <div class="add_item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>@lang('site.grade') <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" id="sponsore_fee_type_0" name="sponsorefeetype[]"
                                                    class="form-control">
                                                <span class="text-danger" id="sponsore_fee_type_0_"> </span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-2" style="padding-top: 25px;">
                                        <span class="btn btn-success addeventmore"><i class="fa-plus"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<div style="visibility: hidden;">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
            <div class="form-row">
                <div class="col-md-6">

                    <div class="form-group">
                        <h5>@lang('site.grade') <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" id="sponsore_fee_type_number" name="sponsorefeetype[]"
                                class="form-control">
                            <span class="text-danger" id="sponsore_fee_type_number_error"> </span>
                        </div>
                    </div>
                </div>


                <div class="col-md-2" style="padding-top: 25px;">
                    <span class="btn btn-success addeventmore"><i class="fa-plus"></i> </span>
                    <span class="btn btn-danger removeeventmore"><i class="ft-minus"></i> </span>
                </div><!-- End col-md-2 -->
            </div><!-- End col-md-5 -->
        </div>
    </div>
</div>
