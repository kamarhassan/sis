<div class="row">
    <div class="col-lg-12 col-12">
        <div class="box">

            <form class="form" id="teacher_can_add_std">
                @csrf
                 
                 
               
                  <div class="form-group col-12 mb-2 contact-repeater">
                    <div data-repeater-list="students">
                      <div class="input-group mb-1" data-repeater-item>
                        <input type="text" placeholder="@lang('site.student name')"  onchange="userlist(this,'{{route('admin.search.std.teacher.register.new.std')}}');" name="std" class="form-control" id="example-tel-input">
                        <span class="input-group-append" id="button-addon2">
                          <button class="btn btn-danger" type="button" data-repeater-delete><i class="ft-x"></i></button>
                        </span>
                        <input type="hidden" placeholder="UserID"  name="id" class="form-control" id="example-tel-input">
                        
                      </div>
                    </div>
                    <button type="button" data-repeater-create class="btn btn-primary">
                      <i class="ft-plus"></i> Add new telephone number
                    </button>
                  </div>
                  <div class="form-group col-12 mb-2">
                    <input type="text" class="form-control" placeholder="Occupation" name="occupation">
                  </div>
                  <div class="form-group col-12 mb-2">
                    <textarea rows="5" class="form-control" name="bio" placeholder="Bio"></textarea>
                  </div>
                <div class="box-footer">
                    <a onclick="submit('{{ route('admin.save.teacher.register.new.std') }}','teacher_can_add_std') ;"
                        class="btn btn-rounded btn-outline-success ft-plus-circle">
                        <i class="ti-save-alt"></i> Save
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>
