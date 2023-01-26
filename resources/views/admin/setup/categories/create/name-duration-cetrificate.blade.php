<div class="row col-md-12">
    <div class="form-group col-md-4">
        <label for="email-addr">@lang('site.categorie name')</label>
        <br>
        <input type="text" name="categorie" class="form-control" id="email-addr"
            @isset($categorie['name'])
            value="{{ $categorie['name'] }}"
        @endisset>
        <span class="text-danger" id="categorie_"></span>
    </div>
    <div class="form-group  col-md-4">
        <label for="profession">@lang('site.certificate')</label>

        @isset($certificates)
            <select name="certificate[]" class="selectize-multiple" multiple>
                <option value="" selected>------------------</option>
                @foreach ($certificates as $certificate)
                    <option value="{{ $certificate['id'] }}"
                        @isset($categorie) 
                            @foreach ($categorie['certificate_id'] as $certificate_id)
                        @if ($certificate_id == $certificate['id'])  selected   @endif @endforeach
                        
                    @endisset>
                        {{ $certificate['name'] }}
                    </option>
                @endforeach
            </select>
        @endisset
        <span id="certificate_" class="text-danger"></span>
    </div>
    <div class="form-group col-md-4">
        <label for="email-addr">@lang('site.nb of hours total for cours')</label>
        <br>
        <input type="text" name="nb_total_hours" class="form-control" id="email-addr"
            @isset($categorie['duration'])
        value="{{ $categorie['duration'] }}"
    @endisset>
        <span class="text-danger" id="nb_total_hours_"></span>
    </div>

    <div class="form-group col-md-4">
        <label for="email-addr">@lang('site.status')</label>
        <br>
        <div class="form-group mt-1">
            <label for="switcherySize13" class="font-medium-2 text-bold-600 mr-1 text-success">@lang('site.activate')</label>
            <input type="checkbox" id="switcherySize13"
                @isset($categorie['status'])
                @if ($categorie['status'] == 1)
                checked
                                   
                @endif
            value="{{ $categorie['status'] }}"
        @endisset
                value="1" name="status" class="switchery" data-size="sm" />
            <label for="switcherySize13" class="font-medium-2 text-bold-600 ml-1 text-danger">@lang('site.disactivate')</label>
        </div>
        <span id="status_" class="text-danger"></span>
    </div>
</div>
