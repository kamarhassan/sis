         @isset($InstitueInformation['id'])
             <input type="hidden" name="id" value="{{ $InstitueInformation['id'] }}">
         @endisset


         <div class="row">
             <div class="col-md-6">
                 <div class="form-group">
                     <h5>@lang('site.branch name') <span class="text-danger">*</span></h5>
                     <div class="controls">
                         <input type="text" name="name" id="name" class="form-control"
                             @isset($InstitueInformation['name'])
                                               value="{{ $InstitueInformation['name'] }}" 
                                            @endisset>
                     </div>
                 </div>
                 <span class="text-danger" id="name_"> </span>
                </div>
            
             <div class="col-md-6">
                 <div class="form-group">
                     <h5>@lang('site.phone') <span class="text-danger">*</span></h5>
                     <div class="controls">
                         <input type="text" name="phone" id="phone" class="form-control"
                             @isset($InstitueInformation['phone'])
                                            value="{{ $InstitueInformation['phone'] }}" 
                                            @endisset>
                     </div>
                 </div>
                 <span class="text-danger" id="phone_"> </span>
             </div>
         </div>
        
         <div class="row">
             <div class="col-md-4">
                 <div class="form-group">
                     <h5>@lang('site.E-mail') <span class="text-danger">*</span></h5>
                     <div class="controls">
                         <input type="email" name="email" id="email" class="form-control"
                             @isset($InstitueInformation['email'])
                                            value="{{ $InstitueInformation['email'] }}" 
                                            @endisset>
                     </div>
                 </div>
                 <span class="text-danger" id="email_"> </span>
             </div>
             <div class="col-md-4">
                 <div class="form-group">
                     <h5>@lang('site.city') <span class="text-danger">*</span></h5>
                     <div class="controls">
                         <input type="text" name="city" id="city" class="form-control"
                             @isset($InstitueInformation['city'])
                                            value="{{ $InstitueInformation['city'] }}" 
                                            @endisset>
                     </div>
                 </div>
                 <span class="text-danger" id="city_"> </span>
             </div>
             <div class="col-md-4">
                 <div class="form-group">
                     <h5>@lang('site.building') <span class="text-danger">*</span></h5>
                     <div class="controls">
                         <input type="text" name="building" id="building" class="form-control"
                             @isset($InstitueInformation['building'])
                                            value="{{ $InstitueInformation['building'] }}" 
                                            @endisset>
                     </div>
                 </div>
             </div>
             <span class="text-danger" id="building_"> </span>
         </div>


         <div class="row">
             <label class="label-control" for="googlemaplocation"></label>
         </div>
