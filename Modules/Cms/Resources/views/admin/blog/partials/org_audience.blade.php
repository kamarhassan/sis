<style>
    .branchList td, .branchList th {
        border-bottom: 1px solid rgba(130, 139, 178, .15);
    }
</style>
<div class="col-xl-3 ">
    <div class="primary_input mb-25">
        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="primary_input_label"
                       for=""> {{__('org.Target Org Chart Audience')}} <span class="text-danger">*</span></label>
            </div>
            <div class="col-md-6 mb-25">
                <label class="primary_checkbox d-flex mr-12"
                       for="type1">
                    <input type="radio"
                           class="common-radio type1"
                           id="type1"
                           name="audience"
                           {{isset($blog)?$blog->audience==1?'checked':'':'checked'}}
                           value="1">
                    <span
                        class="checkmark mr-2"></span> {{__('blog.Public')}}
                </label>
            </div>
            <div class="col-md-6  mb-25">
                <label class="primary_checkbox d-flex mr-12"
                       for="type2">
                    <input type="radio"
                           class="common-radio type2"
                           id="type2"
                           name="audience"
                           {{isset($blog)&&$blog->audience==2?'checked':''}}
                           data-toggle="modal" data-target="#selectBranch"
                           value="2">
                    <span
                        class="checkmark mr-2"></span> {{__('blog.Specify')}}
                </label>
            </div>
        </div>
    </div>
</div>
<div class="modal fade admin-query" id="selectBranch">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">


            <div class="modal-header">
                <h4 class="modal-title">{{__('common.Select')}} {{__('blog.Org Branch')}} </h4>
                <button type="button" class="close" data-dismiss="modal"><i
                        class="ti-close "></i></button>
            </div>

            <div class="modal-body">
                <div class="text-center">

                    <div class="white_boxx ">
                        <div class="org_table ">
                            @livewire('show-policy-branch',['codes' =>
                            $codes])
                        </div>
                    </div>
                </div>
                <div class="mt-40 d-flex justify-content-center">
                    <button class="primary-btn float-right fix-gr-bg"
                            data-dismiss="modal"
                            type="button">{{__('common.Add')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // $(document).on("click", ".checkBranch", function () {
    //     return false;
    // });

    $('#selectBranch').on('hidden.bs.modal', function () {
        let total = $('.checkBranch:checked').length;
        if (total === 0) {
            $('#type1').prop('checked', true);
        }
    })
</script>
