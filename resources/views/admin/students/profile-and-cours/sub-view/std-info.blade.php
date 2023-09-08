<h3>
   <div class="box">
      <div class="box-header with-border">
         <h3 class="box-title">@lang('site.student information')</h3>
      </div>

      <div class="box-body">
         <div class="row">
            <div class="col-md-6">
               <span class="bb-1 border-warning text-primary">@lang('site.student name')</span>
               <span class="bb-1 border-warning text-warning">@isset ($std['name'] )
                     {{ $std['name'] }}
                  @endisset</span>
            </div>
            <div class="col-md-6">
               <span class="bb-1 border-warning text-primary">@lang('site.E-mail')</span>
               <span class="bb-1 border-warning text-warning">@isset ($std['email'] )
                     {{ $std['email'] }}
                  @endisset</span>
            </div>
         </div>
         <div class="row">

            <div class="col-md-6">
               <span class="bb-1 border-warning text-primary">@lang('site.phone')</span>
               <span class="bb-1 border-warning text-warning">@isset ($std['phonenumber'] )
                     {{ $std['phonenumber'] }}
                  @endisset</span>
            </div>
            <div class="col-md-6">
               <span class="bb-1 border-warning text-primary">@lang('site.students birthday')</span>
               <span class="bb-1 border-warning text-warning">@isset ($std['birthday'] )
                     {{ $std['birthday'] }}
                  @endisset</span>
            </div>
         </div>

         <div class="row">

            <div class="col-md-6">
               <span class="bb-1 border-warning text-primary">@lang('site.birthday place')</span>
               <span class="bb-1 border-warning text-warning">@isset ($std['birthday_place']['area'])
                     {{ $std['birthday_place']['area'] }}
                  @endisset</span>
            </div>
            <div class="col-md-6">
               <span class="bb-1 border-warning text-primary">@lang('site.gender')</span>
               <span class="bb-1 border-warning text-warning">@isset ($std['gender'])
                     {{ $std['gender'] }}
                  @endisset</span>
            </div>
         </div>

         <div class="row">
            <div class="col-md-6">
               <span class="bb-1 border-warning text-primary">@lang('site.sejel')</span>
               <span class="bb-1 border-warning text-warning">@isset ($std['segel'])
                     {{ $std['segel'] }}
                  @endisset</span>
            </div>
            <div class="col-md-6">
               <span class="bb-1 border-warning text-primary">@lang('site.segel place')</span>
               <span class="bb-1 border-warning text-warning">@isset ($std['segel_place'])
                     {{ $std['segel_place'] }}
                  @endisset</span>
            </div>
         </div>
         <div class="row">

            <div class="col-md-6">
               {{-- <span class="bb-1 border-warning text-primary">@lang('site.gender')</span>
               <span class="bb-1 border-warning text-warning">{{ $std['gender'] }}</span> --}}
            </div>
         </div>
      </div>
   </div>
</h3>
