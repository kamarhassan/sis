{{-- {{dd($coursinfo)}} --}}
<h1 class="text-capitalize text-warning text-uppercase text-center  ">
    <span>@lang('site.registration std step 2')</span>
</h1>
<!--  for  std info -->
<div class="box bl-3 border-warning br-3  ">
    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <span>
                    @lang('site.student name') : <span class="bb-1 border-success">
                        @isset($std_name)
                            {{ $std_name }}
                        @endisset
                    </span>
                </span>

            </div>

            <div class="col-md-6">
                <span>
                    @lang('site.cours info') : <span class="bb-1 border-success">

                        @if ($coursinfo->grade['grade'] != '' && $coursinfo->level['level'] != '' && $coursinfo->teacher['name'] != '')
                            {{ $coursinfo->grade['grade'] }} -{{ $coursinfo->level['level'] }} -
                            {{ $coursinfo->teacher['name'] }}
                        @endif
                    </span>
                </span>
            </div>
            <div class="col-md-3">
                <span>
                    @lang('site.registration date') : <span class="bb-1 border-success">{{ date('Y-m-d') }}</span>
                </span>

            </div>
        </div>
    </div>
</div>

<!--  for  note -->
<div class="box bl-3 border-warning br-3  ">

    <div class="controls">
        <textarea name="textarea" wire:model="fee_note" id="textarea" class="form-control"
            placeholder="@lang('site.note write')" aria-invalid="false">
        </textarea>
        <div class="help-block"></div>
    </div>

    {{-- <div class="box-body">

    </div> --}}
</div>
{{-- for fe --}}

<div class="box box-default box bl-3 border-warning br-3">

    <!-- /.box-header -->
    <div class="box-body">
        <!-- Nav tabs -->
        <ul class="nav nav-pills customtab justify-content-center" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#fee_no_discount" role="tab">
                    <span class="hidden-sm-up">
                        <i class="ion-home"></i></span>
                    <span class="hidden-xs-down">@lang('site.fee no discount')</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#fee_with_discount" role="tab">
                    <span class="hidden-sm-up">
                        <i class="ion-person"></i></span>
                    <span class="hidden-xs-down">@lang('site.sponsor/ discount') </span>
                </a>
            </li>
            {{-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#messages2" role="tab">
                        <span class="hidden-sm-up">
                            <i class="ion-email"></i></span>
                        <span class="hidden-xs-down">Messages</span>
                    </a>
                </li> --}}
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="fee_no_discount" role="tabpanel">
            </div>
            <div class="tab-pane" id="fee_with_discount" role="tabpanel">
                {{-- <div class="row">

                    <div class="col-sm-6">sponsor:
                        @isset($sponsor)
                            <select wire:model="sponsor_id" name="sponsor_id" class="form-control ">
                                @foreach ($sponsor as $sponsors)
                                    <option value="{{ $sponsors->id }}">{{ $sponsors->name }}</option>
                                @endforeach
                            </select>
                        @endisset
                    </div>
                    <div class="col-sm-6">precentage :
                        <input wire:model='sponsor_precentage'
                            wire:keypress.debounce.500ms="updateQuery($event.target.value)"
                            class='form-control'
                            type="text"
                             placeholder="@lang('site.searche std')" list="std_list"

                              name="sponsor_precentage"></div>


                </div> --}}
            </div>
            {{-- <div class="tab-pane" id="messages2" role="tabpanel">
                    <div class="p-15">
                        maybe not used
                    </div>
                </div> --}}
        </div>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

<div class="box">
    {{-- <div class="box-header with-border">
        <h3 class="box-title text-capitalize text-warning text-uppercase "> <span>@lang('site.result')</span></h3>
    </div> --}}
    <!-- /.box-header -->
    <div class="box-body">


        @if ($cours_fee_count > 0)
            <div class="table-responsive">
                <div class="box-header with-border">
                    <h4 class="box-title">@lang('site.fee of this cours is')
                        <span class="badge badge-pill badge-danger">
                            {{ $cours_fee[0]->currency['currency'] }} -> {{ $cours_fee[0]->currency['abbr'] }}
                        </span>
                    </h4>
                </div>




                <table class="table table-hover mb-0">
                    <tr>
                        <th scope="col">@lang('site.fee required') / @lang('site.fee type')</th>
                        <th scope="col">@lang('site.fee value')</th>
                        {{-- <th scope="col">@lang('site.covered by sponsor')</th> --}}
                    </tr>

                    @foreach ($cours_fee as $cours_fe)
                        <tr>
                            <td scope="row">

                                {{-- <div class="demo-checkbox"> --}}
                                <input type="checkbox" @if ($ini_fee_required == 1) checked @endif
                                    wire:model="feerequired" class="chk-col-primary"
                                    id="md_checkbox_{{ $cours_fe->id }}" value="{{ $cours_fe->id }}"
                                    name="{{ $ini_fee_required }}" checked />
                                <label
                                    for="md_checkbox_{{ $cours_fe->id }}">{{ $cours_fe->fee_type['fee'] }}</label>
                                {{-- </div> --}}
                            </td>


                            <td scope="row">{{ $cours_fe->value }}</td>
                            {{-- <td scope="row">
                                <div class="demo-checkbox"> <input  wire:model="coveredfee" type="checkbox" class="chk-col-danger"
                                        id="covered_checkbox_{{ $cours_fe->id }}" />
                                    <label for="covered_checkbox_{{ $cours_fe->fee_types_id }}"></label>
                                </div>
                            </td> --}}
                        </tr>
                    @endforeach
                    @if (!empty($selectedfee))
                        {{-- {{ print_r($selectedfee) }} --}}
                    @endif


                    <tr scope="col" class="text-warning text-uppercase">
                        <td scope="row">@lang('site.cours fee total') </td>
                        <td scope="row"> {{ $cours_fee_sum }}</td>
                    </tr>
                </table>
            </div>
        @elseif ($cours_fee_count == 0)
            <div>
                <label>
                    <span class="border-warning">
                        <h3 class="text-danger">
                            @lang('site.fee of this cours note defined')
                        </h3>
                    </span>
                </label>
            </div>
        @else
        @endif
        <div class="row">
            <div class="col-md-3">
                <button class="btn  glyphicon glyphicon-arrow-left hover-success" wire:click="save_and_go_to_payment()"
                    title="@lang('site.save')" type="submit">
                    <span> @lang('site.next step')</span>
                </button>

            </div>
            <div class="col-md-3">
                <button class="btn glyphicon glyphicon-arrow-right hover-danger " wire:click="back_and_reset_fee_()"
                    title="@lang('site.back')" >
                    <span >@lang('site.previous step')</span>
                </button>
            </div>
        </div>
    </div>
</div>
