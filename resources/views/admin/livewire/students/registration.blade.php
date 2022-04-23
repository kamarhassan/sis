<div>
    <button type="button" wire:click="callFunction" class="btn btn-danger">Click Me</button>
    {{-- <button type="button" wire:click="callFunctionArg({{$user_id}})" class="btn btn-danger">Click Me!</button> --}}
    @if ($current_step == 1)
        <div class="col-md-6">
            <div class="form-gourp">
                <label>
                </label>
                <input wire:model='std_name' class='form-control' type="text" list="cityname">
                @if (!is_null($std_name))
                    {{-- @for ($i = 0; $i < 5; $i++)
                        <div class="absolute bg-gray-800 text-sm-center rounded w-64 mt-4">
                            <ul>
                                <li class="border-b bg-gray-700">
                                    <a href="#" class="block hover:bg-gray-700 px-3 py-3"> {{ $std_name }}</a>
                                </li>
                            </ul>
                        </div>
                    @endfor --}}
                @endif
                {{-- <datalist class="border-danger"  id="cityname"  >
                    <option   value="Boston">
                        <option   value="Cambridge">
                            <option   value="Boston">
                                <option   value="Cambridge">
                                    <option   value="Boston">
                                        <option   value="Cambridge">
                                        </datalist> --}}

            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-group">
                    <label>@lang('site.cours') </label>
                    <select wire:model="cours_id" wire:change="get_cours_fee($event.target.value)" name="get_cours_fee"
                        class="form-control select2" style="width: 100%;">
                        @isset($cours)
                            <option value="">@lang("site.chosse the cours")</option>
                            @foreach ($cours as $cours_)
                                <option value="{{ $cours_->id }}">{{ $cours_->id }} - {{ $cours_->grade }} -
                                    {{ $cours_->level }} - {{ $cours_->name }} </option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
        </div>

        @if ($cours_fee_count > 0)
            <div class="table-responsive">
                <div class="box-header with-border">
                    <h4 class="box-title">@lang('site.fee of this cours is')
                        {{ $cours_fee[0]->currency['currency'] }} -> {{ $cours_fee[0]->currency['abbr'] }}
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
                        <td scope="row"> {{$cours_fee_sum}}</td>
                    </tr>
                </table>
            </div>
            @elseif ($cours_fee_count == 0)
                <label>
                    <span class="border-warning">
                        <h3 class="text-danger">
                            @lang('site.fee of this cours note defined')
                        </h3>
                    </span>
                </label>
            @else
        @endif
    @elseif ($current_step == 2)
        @include('admin.livewire.students.fee')
    @elseif ($current_step == 3)
        @include('admin.livewire.students.report')
    @endif

</div>
