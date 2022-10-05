@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')
    <style>
        active:hover {
            background-color: @lang('site.activate');
        }

        active:hover {
            background-color: @lang('site.disactivate');
        }
    </style>
@endsection
@section('content')


    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Form inputs</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table  table-striped">
                    <thead>
                        <tr>

                            <th>@lang('site.currency name')</th>
                            <th>@lang('site.currency abbr')</th>
                            <th>@lang('site.currency country')</th>
                            <th>@lang('site.currency symbol')</th>
                            {{-- <th>@lang('site.status')</th> --}}
                            <th>@lang('site.options')</th>
                        </tr>
                    </thead>
                    <tbody>

                        @isset($currency)
                            @foreach ($currency as $currenc)
                                <tr>
                                   
                                    <td>
                                        @if ($currenc->active == 1)
                                            <div class="box-body ribbon-box">
                                                <div class="ribbon-two ribbon-two-success">
                                                    <span>{{ $currenc->getactive() }}</span>
                                                </div>
                                                <p class="mb-0 pt-20">{{ $currenc->currency }}
                                            </div>
                                        @else
                                            <div class="box-body ribbon-box">
                                                <div class="ribbon-two ribbon-two-danger">
                                                    <span>{{ $currenc->getactive() }}</span>
                                                </div>
                                                <p class="mb-0 pt-20">{{ $currenc->currency }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $currenc->abbr }}</td>
                                    <td>{{ $currenc->Country }}</td>
                                    <td>{{ $currenc->symbol }}</td>

                                    <td>
                                        {{-- @php  $currenc->active == 1 ? @lang('site.disactivate') : @lang('site.activate')  @endphp --}}
                                        {{-- @if ($currenc->active == 1) @lang('site.disactivate') @else @lang('site.activate') @endif --}}
                                        {{-- <div class="btn-group mb-5">
                                                <button type="submit" class="">  @if ($currenc->active == 1) @lang('site.disactivate') @else @lang('site.activate') @endif</button>

                                                <button type="submit" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                  <span class="caret"></span>
                                                  <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button type="submit" class="btn btn-default">@lang('site.disactivate')</button>

                                                </div>
                                              </div> --}}

                                        <div class="text-xs-right">
                                            @if ($currenc->active == 1)
                                                <a onclick="activate_cuurency('{{route('admin.Currency.active.disactive')}}', '{{ $currenc->id }}', '{{ csrf_token() }}')" class="btn btn-rounded btn-info mb-5  btn-danger"
                                                    title="@lang('site.disactivate')">
                                                    <i class=" fa fa-close"></i> </span>
                                                </a>
                                                {{-- {{-- class="btn btn-rounded btn-info mb-5"
                                                    value="@lang('site.')"> --}}
                                            @else
                                                <a onclick="activate_cuurency('{{route('admin.Currency.active.disactive')}}', '{{ $currenc->id }}', '{{ csrf_token() }}')" class="btn btn-rounded btn-info mb-5  btn-success"
                                                    title="@lang('site.activate')">
                                                    <i class="mdi mdi-check"></i> </span>
                                                </a>
                                            @endif

                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        @endisset

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>@lang('site.currency name')</th>
                            <th>@lang('site.currency abbr')</th>
                            <th>@lang('site.currency country')</th>
                            <th>@lang('site.currency symbol')</th>
                            {{-- <th>@lang('site.status')</th> --}}
                            <th>@lang('site.options')</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>


@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>


    <script src="{{ URL::asset('assets/custome_js/activate_currency.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
@endsection
