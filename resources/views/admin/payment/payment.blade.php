@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')
@endsection
@section('content')
    <div class="box bl-3 border-warning br-3">

        <div class="box-body">
            <div class="box-header with-border">
                <h3 class="box-title text-capitalize text-warning text-uppercase ">
                    <span>@lang('site.receipt info')</span>
                </h3>
            </div>
            <div class="row show-grid">
                <div class="col-md-6">
                    <span>
                        @lang('site.student name') : <span class="bb-1 border-success">
                            {{ $user[0]['name'] }}
                        </span>
                    </span>
                </div>
                <div class="col-md-6">
                    <span>
                        @lang('site.cours info') : <span class="bb-1 border-success">
                            @if ($cours[0]['grade']['grade'] != '' && $cours[0]['level']['level'] != '' && $cours[0]['teacher']['name'] != '')
                                {{ $cours[0]['grade']['grade'] }} - {{ $cours[0]['level']['level'] }} -
                                {{ $cours[0]['teacher']['name'] }}
                            @endif
                        </span>
                    </span>
                </div>
            </div> <!-- End of row show-grid cours info and std name -->
        </div>
        <div class="box">

            <div class="col-md-4">
                <input type="hidden">
                <h4 class=" bb-1  border-danger box-title text-capitalize  text-uppercase" style="color:rgb(255, 153, 0)">
                    @lang('site.fee of this cours is')
                    {{ $fees[0]['currency']['currency'] }} - {{ $fees[0]['currency']['abbr'] }} -
                    {{ $fees[0]['currency']['symbol'] }}
                </h4>
            </div>

            <div class="row show-grid">
                <div class="col-md-3">
                    <span>
                        @lang('site.amount') :
                    </span>
                </div>
                <form id="payment_data">
                    @csrf
                    <div class="col-md-6">
                        <input type="number" id="amount_to_paid" step="any" class='form-control'
                            placeholder="@lang('site.paid fee here')" name="amount_to_paid" value="0">
                        @error('amount_to_paid')
                            <span class="text-danger"> $message </span>
                        @enderror
                    </div>

            </div>
        </div>
        <div class="box ">
            <div class="row show-grid">
                <div class="col-md-3">
                    <span>
                        @lang('site.receipt description') :
                    </span>
                </div>
                <div class="col-md-6">
                    <input type="text" class='form-control' placeholder="@lang('site.description')" name="receipt_description"
                        id="receipt_description">
                    <span class="bb-1 border-success">
                </div>
            </div>
        </div>
        <div class="box ">

            <div class="row show-grid">

                <div class="col-md-3">
                    <span>
                        @lang('site.payment type') <span class="bb-1 border-success">
                        </span>
                    </span>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="radio">
                            <input name="group1" type="radio" id="pay_cache_" checked onclick="change_pay_type(this.value);"
                                value="pay_cache_">
                            <label for="pay_cache_">cache</label>


                            <input name="group1" type="radio" id="pay_check_" onclick="change_pay_type(this.value);"
                                value="pay_check_">
                            <label for="pay_check_">check</label>
                        </div>
                    </div>
                </div>

                <div id="div_pay_check" hidden>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-1 col-form-label">#</label>
                        <div class="col-sm-10">
                            <input class='form-control' id="check_number" type="number" step="any"
                                placeholder="@lang('site.Enter check number')" name="check_number"id="check_number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-1 col-form-label">#</label>
                        <div class="col-sm-10" >
                            <select class="form-control" name = "bank_" id="bank_">
                                <option></option>
                                <option>slect from bank list 2</option>
                                <option>slect from bank list3 </option>
                                <option>slect from bank list 4</option>
                                <option>slect from bank list 5</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <div class="col-md-12">



            @isset($fees)
                <div class="table-responsive">
                    <table id="payment_table" class="table table-hover mb-0">
                        <tr>
                            <th scope="col">@lang('site.fee type')</th>
                            <th scope="col">@lang('site.fee value')</th>
                            <th scope="col">@lang('site.registration date')</th>
                            <th scope="col">@lang('site.paid')</th>
                            {{-- <th scope="col">@lang('site.paid date')</th> --}}
                            <th scope="col">@lang('site.remaining')</th>
                            <th scope="col">@lang('site.desription')</th>
                        </tr>
                        <form id="alldata">
                            @foreach ($fees as $feestopaid)
                                <tr>
                                    {{-- <td scope="row"> feestopaid['id']</td> -- --}}
                                    <td scope="row"> {{ $feestopaid['fee_type']['fee'] }} </td>
                                    <td scope="row"> {{ $feestopaid['value'] }} </td>
                                    <td scope="row"> {{ $std[0]['created_at']->format('d-m-Y') }} </td>
                                    @if (!empty($feestopaid['payment']))
                                        <td scope="row">{{ $feestopaid['payment']['paid_amount'] }} </td>
                                        <td scope="row"> {{ $feestopaid['payment']['remaining'] }} </td>
                                    @else
                                        <td scope="row">0 </td>
                                        <td scope="row"> {{ $feestopaid['value'] }} </td>
                                    @endif
                                </tr>
                            @endforeach
                        </form>
                        <tr scope="col" class="text-warning text-uppercase">
                            <td scope="row">@lang('site.cours fee total') </td>
                            <td scope="row"> {{ $std[0]['cours_fee_total'] }}</td>
                        </tr>
                    </table>
                </div>
            @endisset


            <div>
                <div class="row">
                    <div class="col-md-3">
                        <button class="btn  glyphicon glyphicon-arrow-left hover-success " title="@lang('site.save')"
                            type="submit"
                            onclick="savepayment('{{ route('admin.students.payment_to_receipt') }}','{{ csrf_token() }}');">
                            <span class=""> @lang('site.next step')</span>
                        </button>
                    </div>
                </div>
            </div>
        @endsection


        @section('script')
            <script src="{{ URL::asset('assets\custome_js\payment_for_cours.js') }}"></script>
        @endsection
