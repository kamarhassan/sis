<div>
    {{-- <button type="button" wire:click="callFunction" class="btn btn-danger">Click Me</button> --}}
    {{-- <button type="button" wire:click="callFunctionArg({{$user_id}})" class="btn btn-danger">Click Me!</button> --}}
    @if ($current_step == 1)
        <form wire:submit.prevent="save_std_register">
            <div class="col-md-12">
                <div class="form-gourp">
                    <label>
                        @lang('site.students')
                    </label>
                    <input wire:model='std_name' wire:keypress.debounce.500ms="updateQuery($event.target.value)"
                        class='form-control' type="text" placeholder="@lang('site.searche std')" list="std_list"
                        wire:keydown.escape="reset_" wire:keydown.tab="reset_" name="std_name">
                    {{-- <input wire:model.debounce.500ms='std_name' class='form-control' type="text" list="std_name"> --}}

                    @error('std_name')
                        <span class="text-danger">{{ $message }} </span>
                    @enderror

                    @if (!empty($std_name))

                       
                        <div class="fixed  top-0 bottom-0 left-0 right-0" wire:click="reset_"></div>
                        <div class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group">
                            @if (!empty($all_std_as_std_name))
                                <datalist id="std_list" class="col-md-12">
                                    @foreach ($all_std_as_std_name as $i => $student)
                                        <option class="form-control" value="{{ $student['name'] }}">
                                            {{ $student['name'] }}</option>
                                    @endforeach
                                </datalist>

                            @endif
                        </div>
                        @if (empty($all_std_as_std_name))
                            <div class="text-error">
                                <span class="text-danger"> @lang('site.No results!')</span>
                            </div>
                        @endif
                    @endif

                </div>

            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <div class="form-group">
                        <label>@lang('site.cours') </label>
                        <select wire:model="cours_id" wire:change="get_cours_fee($event.target.value)"
                            name="get_cours_fee" class="form-control " style="width: 100%;">
                            @isset($cours)
                                <option value="">@lang("site.chosse the cours")</option>
                                @foreach ($cours as $cours_)
                                    <option value="{{ $cours_->id }}">{{ $cours_->id }} - {{ $cours_->grade }} -
                                        {{ $cours_->level }} - {{ $cours_->name }} </option>
                                @endforeach
                            @endisset
                        </select>
                        @error('get_cours_fee')
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
                <button class="btn btn-success glyphicon glyphicon-ok" title="@lang('site.save')" type="submit">
                </button>
            </div>
        </form>
    @elseif ($current_step == 2)
        @include('admin.livewire.students.fee')
    @elseif ($current_step == 3)
        @include('admin.livewire.students.report')
    @endif

</div>
