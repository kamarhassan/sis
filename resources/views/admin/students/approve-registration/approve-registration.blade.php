@extends('admin.layouts.master')

@section('css')
@endsection

@section('content')

    <h1 class="text-capitalize text-warning text-uppercase text-center  ">
        <span>@lang('site.registration std step 2')</span>
    </h1>
    <!--  for  std info -->
    <form id='registartion_form'>
        @csrf
        <div class="box bl-3 border-warning br-3  ">
            <div class="box-body">
                <div class="row">

                    <div class="col-md-3">
                        <span>
                            @lang('site.student name') : <span class="bb-1 border-success">
                                @isset($user_info)
                                    {{ $user_info['name'] }}
                                @endisset
                            </span>
                        </span>
                        <input type="hidden" name="user_id" id="" value="{{$user_info['id'] }}">
                      
                    </div>

                    <div class="col-md-6">
                        <span>
                            @lang('site.cours info') :
                            <span class="bb-1 border-success">

                                @isset($cours_info)
                                    @if ($cours_info['grade']['grade'] != '' &&
                                        $cours_info['level']['level'] != '' &&
                                        $cours_info['teacher_name']['name'] != '')
                                        {{ $cours_info['grade']['grade'] }} -{{ $cours_info['level']['level'] }} -
                                        {{ $cours_info['teacher_name']['name'] }}
                                    @endif
                                    <input type="hidden" name="cours_id" id="" value="{{ $cours_info['id']}}">
                                    @endisset

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


        <div class="box bl-3 border-warning br-3  ">
            <span>
                @lang('site.note write')
            </span>
            <div class="controls">
                <textarea name="textarea" wire:model="fee_note" id="textarea" class="form-control" placeholder="@lang('site.note write')"
                    aria-invalid="false">
                    </textarea>
            </div>
            <div class="help-block"></div>
        </div>




        <div class="box box-default box bl-3 border-warning br-3">
            <div class="box-body">
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
                </ul>

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




            @include('admin.students.approve-registration.cours-fee')

           
                <div class="col-md-3">
                    <a class="btn  glyphicon glyphicon-arrow-left hover-success"  title="@lang('site.save')" 
                       onclick="submit('{{ route('admin.notification.approve.new.register') }}','registartion_form');">
                        <span> @lang('site.next step')</span>
                    </a>

                </div>
          
        </div>
    </form>

@endsection

@section('script')
<script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
@endsection
