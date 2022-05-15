 {{-- @if ($current_step == 4) --}}
 {{-- <div class="row">
    <div class="col-md-12">

        <button class="btn  fa fa-print  hover-light text-danger text-light"
            title="@lang('site.back')" type="button" onclick="printarea()" >
            <span>@lang('site.previous step')</span>
        </button>

    </div>
</div> --}}
 {{-- <button id="print2" class="btn btn-rounded btn-warning" > <span><i class="fa fa-print"></i> Print</span> </button> --}}

 {{-- @endif --}}
 {{-- <button id="print2" class="btn btn-rounded btn-danger"  wire:click="back_()" type="button"> <span><i class="fa fa-print"></i> Print</span> </button> --}}


 <section class="invoice printableArea" id="print">
     <div class="col-12 no-print">
         <div class="bb-1 clearFix">
             <div class="text-right pb-15">
                 <button class="btn  fa fa-print  hover-success text-white text-light" title="@lang('site.back')"
                     type="button" onclick="printarea()">
                     <span>@lang('site.print')</span>
                 </button>
             </div>
         </div>
     </div>
     <div class=" row">
         <div class="col-12">
             <div class="bb-1 clearFix">
             </div>
         </div>
         <div class="col-12">
             <div class="page-header">
                 <h2 class="d-inline"><span class="font-size-30">@lang('site.receipt')</span></h2>
                 <div class="pull-right text-right">
                     <h3><label>@lang('site.Release Date')</label> : {{ $receipt_information->created_at->format('d-m-Y') }}
                     </h3>
                     {{-- <h3>{{ date('d-m-Y') }}</h3> --}}
                 </div>
             </div>
         </div>
     </div>
     <div class="row invoice-info">
         <div class="col-md-6 invoice-col">
             <strong>@lang('site.from')</strong>
             <address>
                 <strong class="text-blue bb-1 font-size-24">{{ $std_name }}</strong>
                 <br>@lang('site.registration id') : {{ $registration_students->id }} <br>
                 <br>@lang('site.registration date') : {{ $registration_students->created_at }} <br>

             </address>
         </div>
         <div class="col-md-6 invoice-col">
             <strong>@lang('site.to')</strong>
             <address>
                 <strong class="text-blue bb-1  font-size-24">@lang('site.site name') </strong><br>
                 <strong class="d-inline">العنوان from database settings table and site name</strong><br>
                 <strong>تفاصيل email , nb pfone ...... from database settings table and site name</strong>
             </address>
         </div>
         <div class="col-sm-12 invoice-col mb-15">
             <div class="invoice-details row no-margin">
                 <div class="col-md-6 col-lg-3"><b>receipr id # </b> {{ $receipt_information_id }}</div>
                 <div class="col-md-6 col-lg-3"><b>user ID:</b>{{ $registration_students->user_id }}</div>
                 <div class="col-md-6 col-lg-3"><b>cours :</b>
                     @if ($coursinfo->grade['grade'] != '' && $coursinfo->level['level'] != '')
                         {{ $coursinfo->grade['grade'] }} -{{ $coursinfo->level['level'] }}
                     @endif
                 </div>
                 <div class="col-md-6 col-lg-3"><b>amount:</b> {{ $init_amount_to_paid }}</div>
             </div>
         </div>

     </div>
     <div class="row">
         <div class="col-12 table-responsive">
             <table class="table table-bordered">
                 <tbody>
                     <tr>
                         {{-- <th>#</th> --}}
                         <th>@lang('site.type')</th>
                         {{-- <th>@lang('site.payment date')</th> --}}
                         <th>@lang('site.fee amount')</th>
                         <th>@lang('site.paid amount')</th>
                         <th>@lang('site.remaining')</th>
                     </tr>
                     @foreach ($payment_information as $key => $pay_information)
                         <tr>
                             {{-- <td>{{$pay_information['fee_type_value']}}</td> --}}
                             <td>{{ $pay_information['fee_type'] }}</td>
                             <td>{{ $pay_information['amount'] }}</td>
                             <td>{{ $pay_information['paid_amount'] }}</td>
                             <td>{{ $pay_information['remaining'] }}</td>
                             {{-- <td>{{$pay_information['fee_type_value']}}</td> --}}
                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>

     </div>
 </section>
