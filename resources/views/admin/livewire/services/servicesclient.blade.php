<div class="col-md-12 col-12">
    <div class="box-body">
        <form wire:submit.prevent="validate_client_service">
            <div class="col-md-12">
                <div class="form-gourp">
                    <label>
                        @lang('site.students') <span class="text text-danger">*</span>
                    </label>
                    <input wire:model='client_name' wire:keypress.debounce.500ms="updateQuery()" class='form-control'
                        type="text" placeholder="@lang('site.searche std')" list="std_list" wire:keydown.escape="reset_"
                        wire:keydown.tab="reset_" name="client_name">
                    @error('client_name')
                        <span class="text-danger">{{ $message }} </span>
                    @enderror
                    @if (!empty($client_name))
                        <div wire:loading wire:target="updateQuery()"> </div>
                        <div class="fixed  top-0 bottom-0 left-0 right-0" wire:click="reset_"></div>
                        <div class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group">
                            @if (!empty($all_client_name))
                                <datalist id="std_list" class="col-md-12">
                                    @foreach ($all_client_name as $i => $client)
                                        <option class="form-control" value="{{ $client['name'] }}">
                                            {{ $client['id'] }}#{{ $client['name'] }}</option>
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
                        <select wire:model="service_id" wire:change="get_service()" name="service_id"
                            class="form-control " style="width: 100%;">
                            @isset($services)
                                <option value="">@lang('site.chosse the services')</option>
                                @foreach ($services as $services_)
                                    <option value="{{ $services_->id }}">
                                        <span class=""># {{ $services_['id'] }} # </span>
                                        <span class="">{{ $services_['service'] }} -</span>
                                        <span class="">{{ $services_['fee'] }} </span>
                                        {{-- <span class="">{{ $services_['id'] }}</span> --}}
                                        <span class=""> {{ $services_['currency']['abbr'] }}</span>
                                        {{-- <span class="">{{ $services_['currency']['symbol'] }}</span> --}}
                                        {{-- #{{ $services_['id'] }} --}}
                                        {{-- {{ $services_['currency']['abbr'] }}
                                    {{ $services_['currency']['symbol'] }} --}}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        @error('service_id')
                            <span class="text-danger">{{ $message }} </span>
                        @enderror
                    </div>
                </div>
            </div>

            <button class="btn  glyphicon glyphicon-arrow-left hover-success text-warning-light"
                title="@lang('site.save')" type="submit"> <span> @lang('site.next step')</span>
            </button>
        </form>
    </div>
</div>
