<div class="box" id="spinner_loading">
    <div class="d-flex justify-content-center text-primary">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>

<div class="box" id="services-table-" hidden>
    {{-- @if ((new \Jenssegers\Agent\Agent())->isDesktop()) --}}
    <div class="box-body">
        <div class="table-responsive ">
            <table id="services-table" class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.fee type')</th>
                        <th>@lang('site.fee order')</th>
                        <th>@lang('site.fee value')</th>
                        <th>@lang('site.options')</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @isset($fee_type)
                        @foreach ($fee_type as $key => $fee_types)
                            <tr class="Row{{ $fee_types['id'] }} ">
                              <td>{{ $fee_types['id'] }}</td>
                              <td>{{$fee_types['fee']}}</td>
                              <td>{{$fee_types['order']}}</td>
                              <td>{{$fee_types['primary_price']}}</td>
                              <td>
                               
                                        <a class="btn text-success fa fa-pencil hover  hover-primary"
                                      
                                            onclick=""
                                            title="@lang('site.edit')">
                                        </a>
                             
                            
                                <a class="btn text-danger  glyphicon glyphicon-trash hover  hover-primary"
                                    title="@lang('site.delete')"
                                    onclick="">
                                </a>
                            </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
          
        </div>
    </div>
</div>
