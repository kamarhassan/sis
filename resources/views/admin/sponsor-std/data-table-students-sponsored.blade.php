<div class="box" id="spinner_loading" hidden>
    <div class="d-flex justify-content-center text-primary">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>
<div class="box" id="data_sponsored" hidden>

    <div class="row">
        <div class="col-md-4">
            <span class="text-warning">@lang('site.cours fee total')</span>
        </div>
        <div class="col-md-2">
            <span class="text-warning" id="cours_fee_total"></span>
        </div>
    </div>

    <div class="box-body">
        <div class="table-responsive table-responsive-xl responsive">
            <form id="update_or_new_sponsored">
                @csrf
                <div id="first_row"></div>
                <input type="hidden" name="cours_id" id="cours_id">
                <input type="hidden" name="sponsor_id" id="sponsor_id">

                <table id="data_students_sponsored" style="width: 100%" class="table table-hover " hidden>
                    <thead>
                        <tr>
                            <th> id</th>
                            <th> Name</th>
                            <th> Amount</th>
                            <th> Date</th>
                            <th> Date</th>


                        </tr>

                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <div id="btn_submit">
                            <a id="submit_btn"
                                onclick="submit('{{ route('admin.create.sponsor.fee.for.students') }}','update_or_new_sponsored')"
                                class="btn text-success fa fa-pencil hover  hover-primary">
                                <span>@lang('site.save')</span>
                            </a>

                        </div>
                    </tfoot>
                    {{-- admin.create.sponsor.fee.for.students --}}
                </table>
            </form>
        </div>
    </div>




</div>