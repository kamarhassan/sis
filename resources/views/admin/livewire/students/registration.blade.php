<div>
   @if (current_school_year()['year'] != last_school_year()['year']) 
      
     
      <div class="callout callout-danger">
        

         <p>{{__('site.not are not in current school year please choose the correct year and try again later')}}</p>
        </div>
   
    @elseif ($current_step == 1)


        <div class="text-center text-capitalize ">
            <h1 class="text-warning"><label>@lang('site.registration std step 1') </label></h1>
        </div>

        <form wire:submit.prevent="validate_std_register">
            <div class="col-md-12">
                <div class="form-gourp">
                    <label>
                        @lang('site.students') <span class="text text-danger">*</span>
                    </label>
                    <input wire:model='std_name' wire:keypress.debounce.500ms="updateQuery()"
                        class='form-control' type="text" placeholder="@lang('site.searche std')" list="std_list"
                        wire:keydown.escape="reset_" wire:keydown.tab="reset_" name="std_name">
                    {{-- <input wire:model.debounce.500ms='std_name' class='form-control' type="text" list="std_name"> --}}

                    @error('std_name')
                        <span class="text-danger">{{ $message }} </span>
                    @enderror

                    @if (!empty($std_name))
                    <div wire:loading wire:target="updateQuery()"> </div>

                        <div class="fixed  top-0 bottom-0 left-0 right-0" wire:click="reset_">

                        </div>
                        <div class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group">
                            @if (!empty($all_std_as_std_name))
                                <datalist id="std_list" class="col-md-12">
                                    @foreach ($all_std_as_std_name as $i => $student)
                                        <option class="form-control" value="{{ $student['name'] }}">
                                            {{ $student['id'] }}#{{ $student['name'] }}</option>
                                    @endforeach
                                </datalist>
                            @else
                                <div wire:loading.remove>
                                    {{-- <div class="text-error"> --}}
                                    <span class="text-danger"> @lang('site.No results!')</span>
                                    {{-- </div> --}}
                                </div>
                            @endif
                        </div>

                    @endif

                </div>

            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <div class="form-group">
                        <label>@lang('site.cours') <span class="text text-danger">*</span> </label>
                        <select wire:model="cours_id" wire:change="get_cours_fee($event.target.value)" name="cours_id"
                            class="form-control " style="width: 100%;">
                            @isset($cours)
                                <option value="">@lang('site.chosse the cours')</option>
                                @foreach ($cours as $cours_)
                                    <option value="{{ $cours_->id }}">{{ $cours_->id }} -
                                        {{ $cours_['category_grade_level']['grade']['grade'] }} -
                                        {{ $cours_['category_grade_level']['level']['level'] }} - {{ $cours_->teacher['name'] }} </option>
                                @endforeach
                            @endisset
                        </select>
                        @error('cours_id')
                            <span class="text-danger">{{ $message }} </span>
                        @enderror
                    </div>
                </div>
            </div>

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
                            <th scope="col">@lang('site.fee type')</th>
                            <th scope="col">@lang('site.fee value')</th>
                        </tr>

                        @foreach ($cours_fee as $cours_fe)
                            <tr>
                                <td scope="row">{{ $cours_fe->fee_type['fee'] }}</td>
                                <td scope="row">{{ $cours_fe->value }}</td>

                            </tr>
                        @endforeach

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
            <div>

                @if ($cours_fee_count == 0)
                    <a class="btn glyphicon glyphicon-arrow-left hover-danger text-danger text-light" disabled
                        title="@lang('site.save')">
                    </a><span class="text text-danger"> @lang('site.next step')</span>
                @elseif($cours_fee_count < 0)
                    <a class="btn glyphicon glyphicon-arrow-left hover-danger text-danger text-light" disabled
                        title="@lang('site.save')">
                    </a><span class="text text-danger"> @lang('site.next step')</span>
                @else
                    <button class="btn  glyphicon glyphicon-arrow-left hover-success text-warning-light"
                        title="@lang('site.save')" type="submit"> <span> @lang('site.next step')</span>
                    </button>
                @endif

            </div>

        </form>
    @elseif ($current_step == 2)
        @include('admin.livewire.students.fee')
    @elseif ($current_step == 3)
        @include('admin.livewire.students.payment')
    @elseif ($current_step == 4)
        @include('admin.livewire.students.report')
    @endif

</div>
