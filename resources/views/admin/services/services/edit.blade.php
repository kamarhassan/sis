{{-- <div class="modal center-modal fade bs-example-modal-lg" id="modal-center" tabindex="-1"> --}}
<div class="modal bs-examplemodal-lg  center-modal  " id="modal-center" tabindex="-1" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title">Modal title</h5> --}}
                <a type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">

                {{-- <p id="cours_details">@lang('site.please wait to load service')</p> --}}
                <div class="box-body">
                    <div class="row">
                        <div class="col-12">
                            <form id='services_form_edit'>
                                @csrf
                                <input hidden name="service_id" id="service_id" value="{{ $services['id'] }}">
                                <div class="add_item">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>@lang('site.services') <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" id="service" name="service"
                                                        class="form-control"
                                                        @isset($services)
                                                        value="{{ $services['service'] }}"   
                                                        @endisset>
                                                    <span class="text-danger" id="service_"> </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>@lang('site.fee value') </h5>
                                                <div class="controls">
                                                    <input type="text" id="fee" name="fee"
                                                        class="form-control"
                                                        @isset($services)
                                                        value="{{ $services['fee'] }}"   
                                                        @endisset>
                                                    <span class="text-danger" id="fee_"> </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>@lang('site.quantity') </h5>
                                                <div class="controls">
                                                    <input type="text" id="quantity" name="quantity"
                                                        class="form-control"
                                                        @isset($services)
                                                   value="{{ $services['quantity'] }}"   
                                                   @endisset>
                                                    <span class="text-danger" id="quantity_"> </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                       <div class="col-md-4">
                                          <div class="form-group">
                                              <h5>@lang('site.low stock notify') </h5>
                                              <div class="controls">
                                                  <input type="text" id="low_stock_notifiy" name="low_stock"
                                                      class="form-control"
                                                      @isset($services)
                                                 value="{{ $services['low_stock_notifiy'] }}"   
                                                 @endisset>
                                                  <span class="text-danger" id="low_stock_"> </span>
                                              </div>
                                          </div>
                                      </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>@lang('site.currency name') <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    @isset($currency)
                                                        <select name="currency" id="currency" class="form-control select2"
                                                            style="width: 100%;">

                                                            @foreach ($currency as $currencys)
                                                                <option value="{{ $currencys->id }}"
                                                                    @if ($currencys->id == $services['currencies_id']) selected @endif>
                                                                    {{ $currencys->symbol }} <- {{ $currencys->currency }}
                                                                        </option>
                                                            @endforeach
                                                        </select>
                                                    @endisset
                                                    <span class="text-danger" id="currency_"> </span>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <h5>@lang('site.is active') <span class="text-danger"></span></h5>
                                            <div class="form-group">
                                                <div class="box-controls pull-left">
                                                    <label class="switch switch-border switch-success">
                                                        <input type="checkbox" value="1" name="active"
                                                            id="active"
                                                            @if ($services['active']) checked @endif>
                                                        <span class="switch-indicator"></span>
                                                        <label for="switcheryColor4"
                                                            class="card-title ml-1">@lang('site.is active') </label>

                                                        <span class="text-danger" id="active_"> </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </form>
                        <div class="row">
                            <div class="text-xs-right">
                                <a class="btn  glyphicon glyphicon-arrow-left hover-success " title="@lang('site.save')"
                                    onclick="services('{{ route('admin.services.update') }}','services_form_edit')">
                                    <span class=""> @lang('site.next step')</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- <div class="modal-footer modal-footer-uniform">
                <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-rounded btn-primary float-right">Save changes</button>
            </div> --}}
    </div>
</div>
</div>
