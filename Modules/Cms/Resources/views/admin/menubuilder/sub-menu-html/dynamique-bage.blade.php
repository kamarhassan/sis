<div id="accordion">
   <div class="box box-slided-up ">
       <div class="box-header with-border">
           <h4 class="box-title">@lang('site.dynamique page')</h4>
           <ul class="box-controls pull-right">
               <li><a class="box-btn-slide" href="#"></a></li>
           </ul>
       </div>
       <div class="box-body">
           <form id="dynamic-page">
              @csrf
               <label class="primary_input_label" for="pagess">
                   @lang('frontendmanage.Pages')
                   <span class="text-danger">*</span></label>
               <select name="page[]" id="pagess" class="selectize-multiple" multiple>
                   <option value="">------------</option>
                   @isset($pages)
                       @foreach ($pages as $key => $page)
                           <option value="{{ $page->id }}">{{ $page->title }}</option>
                       @endforeach
                   @endisset
               </select>
               <input type="hidden" name="type" value="Dynamic Page">

               <div class="col-lg-12 text-center mt-10">


                   <a onclick="submit('{{ route('cms.admin.post.menu') }}' ,'dynamic-page');" type="submit"
                       class="btn btn-rounded btn-primary btn-outline">
                       <i class="ti-save-alt"></i> @lang('site.save')
                   </a>


                   </a>
               </div>

           </form>
       </div>

   </div>
</div>
