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
                       for=""> {{__('org.Target Job Position Audience')}} <span class="text-danger">*</span></label>
            </div>
            <div class="col-md-6 mb-25">
                <label class="primary_checkbox d-flex mr-12"
                       for="type11">
                    <input type="radio"
                           class="common-radio type11"
                           id="type11"
                           name="position_audience"
                           {{isset($blog)?$blog->position_audience==1?'checked':'':'checked'}}
                           value="1">
                    <span
                        class="checkmark mr-2"></span> {{__('common.All')}}
                </label>
            </div>
            <div class="col-md-6  mb-25">
                <label class="primary_checkbox d-flex mr-12"
                       for="type22">
                    <input type="radio"
                           class="common-radio type22"
                           id="type22"
                           {{isset($blog)&&$blog->position_audience==2?'checked':''}}
                           name="position_audience"
                           data-toggle="modal" data-target="#selectPositionBranch"
                           value="2">
                    <span
                        class="checkmark mr-2"></span> {{__('blog.Specify')}}
                </label>
            </div>
        </div>
    </div>
</div>
<div class="modal fade admin-query" id="selectPositionBranch">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">


            <div class="modal-header">
                <h4 class="modal-title">{{__('common.Select')}} {{__('org.Position')}} </h4>
                <button type="button" class="close" data-dismiss="modal"><i
                        class="ti-close "></i></button>
            </div>

            <div class="modal-body">
                <div class="text-center">

                    <div class="white_boxx ">
                        <div class="org_table ">


                            @php
                                $positions =\Modules\Org\Entities\OrgPosition::all();
                            @endphp
                            <table id="" class="table  branchList ">
                                <tbody>
                                @foreach($positions as $position)
                                    <tr>
                                        <td class="text-left activePosition">
                                            {{$position->name}}
                                        </td>
                                        <td class="">
                                            <label class="primary_checkbox d-flex mr-12">
                                                <input type="checkbox" class="common-radio changePositionStatus "
                                                       name="position[{{$position->id}}]" value="1"
                                                    {{in_array($position->id,$position_ids)?'checked':''}}
                                                >
                                                <span class="checkmark mr-2"></span>
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


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
    $(document).on("click", ".changePositionStatus", function () {
        let status = $(this).prop("checked");
        let text = $(this).closest('tr').find('.activePosition');
        if (status) {
            text.addClass('active');
        } else {
            text.removeClass('active');
        }
    });

    $('#selectPositionBranch').on('hidden.bs.modal', function () {
        let total = $('.changePositionStatus:checked').length;
        if (total === 0) {
            $('#type11').prop('checked', true);
        }
    })
</script>
