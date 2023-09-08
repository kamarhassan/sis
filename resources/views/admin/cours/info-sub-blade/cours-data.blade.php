<div class="card">
    <div class="card-body">

        <div class="form-group row ">
            <div class="col-xs-6 col-md-4 ">
                <span class="col-sm-1 bb-groove"> @lang('site.grade') :</span>
                <span class="col-sm-1 bb-groove text-success"> {{ $cours['category']['grade']['grade'] }}</span>
            </div>
            <div class="col-xs-6 col-md-4 ">
                <span class="col-sm-1 bb-groove"> @lang('site.level') :</span>
                <span class="col-sm-1 bb-groove text-success"> {{ $cours['category']['level']['level'] }}</span>
            </div>
            <div class="col-xs-6 col-md-4 ">
                <span class="col-sm-1 bb-groove"> @lang('site.Id') :</span>
                <span class="col-sm-1 bb-groove text-success"> {{ $cours['id'] }}</span>
            </div>
        </div>
       
        <div class="form-group row ">
            <div class="col-xs-6 col-md-4 ">
                <span class="col-sm-1 bb-groove"> @lang('site.start date') :</span>
                <span class="col-sm-1 bb-groove text-success"> {{ $cours['act_StartDa'] }}</span>
            </div>
            <div class="col-xs-6 col-md-4 ">
                <span class="col-sm-1 bb-groove"> @lang('site.end date') :</span>
                <span class="col-sm-1 bb-groove text-success"> {{ $cours['act_EndDa'] }}</span>
            </div>
            <div class="col-xs-6 col-md-4 ">
                <span class="col-sm-1 bb-groove"> @lang('site.status') :</span>
                <span class="col-sm-1 bb-groove text-success"> {{ $cours['status'] }}</span>
            </div>
        </div>



        <div class="form-group row ">
            <div class="col-xs-6 col-md-4 ">
                <span class="col-sm-1 bb-groove"> @lang('site.nb of session') :</span>
                <span class="col-sm-1 bb-groove text-success"> {{ $cours['category']['total_hours'] }}</span>
            </div>
            <div class="col-xs-6 col-md-4 ">
                <span class="col-sm-1 bb-groove"> @lang('site.nb of month') :</span>
                <span class="col-sm-1 bb-groove text-success"> {{ $cours['category']['duration']}}</span>
            </div>
            <div class="col-xs-6 col-md-4 ">
                
               
            </div>
        </div>



        <div class="form-group row ">
            <div class="col-xs-6 col-md-4 ">
                <span class="col-sm-1 bb-groove"> @lang('site.teacher name') :</span>
                <span class="col-sm-1 bb-groove text-success"> {{ $cours['teacher_name']['name'] }}</span>
            </div>
            <div class="col-xs-6 col-md-4 ">
                <span class="col-sm-1 bb-groove"> @lang('site.nb of month') :</span>
                <span class="col-sm-1 bb-groove text-success"> {{ $cours['category']['duration']}}</span>
            </div>
            <div class="col-xs-6 col-md-4 ">
                

            </div>
        </div>

    </div>
</div>
