<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('site.start date') <span class="text-danger">*</span></label>
            <input name="start_date" id="start_date" class="form-control" type="date" onchange="Set_Month_ToEndDate('start_date','end_date','duration')"
              @isset ($cours->startDate) 
                  value="{{ $cours->startDate }}" 
              @endisset
                id="example-date-input">
            
            <span class="text-danger" id="start_date_"> </span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('site.end date') <span class="text-danger">*</span></label>
            <input name="end_date" id="end_date" class="form-control" type="date"
               @isset ( $cours->endDate) 
                 value="{{ $cours->endDate }}"
               @endisset id="example-date-input">
            
            <span class="text-danger" id="end_date_"> </span>
        </div>
    </div>
</div>{{-- end of row start and end date --}}


<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('site.start time') </label>
            <input name="start_time" class="form-control" type="time" 
               @isset ($cours->startTime) 
                 value="{{ $cours->startTime }}"
               @endisset id="example-date-input">
        
            <span class="text-danger" id="start_time_"> </span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('site.end time') </label>
            <input name="end_time" class="form-control" type="time" id="example-date-input"
               @isset ($cours->endTime) 
                 value="{{ $cours->endTime }}" 
               @endisset  >
         
                <span class="text-danger" id="end_time_"></span>
      
            
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('site.actually start date') <span class="text-danger">*</span></label>
            <input name="ac_start_date" id="ac_start_date" class="form-control"  onchange="Set_Month_ToEndDate('ac_start_date','ac_end_date','duration')"
                type="date" @isset ($cours->act_StartDa) 
                    value="{{ $cours->act_StartDa }}"
                @endisset
                id="example-date-input">
            
            <span class="text-danger" id="ac_start_date_"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('site.actually end date')<span class="text-danger">*</span> </label>
            <input name="ac_end_date" id="ac_end_date" class="form-control"
                type="date" @isset ($cours->act_EndDa) 
                    value="{{ $cours->act_EndDa }}"
                @endisset
                id="example-date-input">
            
                <span class="text-danger" id="ac_end_date_"></span>
        </div>
    </div>
</div>