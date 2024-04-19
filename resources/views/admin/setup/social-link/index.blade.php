@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')
@endsection
@section('content')
    <div class="box">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="box">
                    <form id="social_link">
                        @csrf
                        @isset($socialMedia)
                            @foreach ($socialMedia as $social_type => $link)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ $social_type }}</label>
                                        <input type="text" class="form-control" name="{{ $social_type }}" id="role"
                                            style="width: 100%;"
                                            @isset($link)
                                     value="{{ $link }}"
                                  @endisset>

                                    </div>
                                    <span class="text-danger" id="role_"></span>
                                </div>
                            @endforeach
                        @endisset


                    </form>
                    <div class="box-footer">
                        <a onclick="submit('{{ route('admin.edit.social.link.save') }}' ,'social_link');" type="submit"
                            class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> Save
                        </a>
                    </div>

                </div>
            </div>
        </div>



        {{-- @foreach($socialMedia as $platform => $url)
    <form action="{{ route('admin.edit.social.link.save', $platform) }}" method="POST">
        @csrf
        <label for="{{ $platform }}">{{ ucfirst($platform) }}</label>
        <input type="text" name="{{ $platform }}" value="{{ $url }}">
        <button type="submit">Save</button>
    </form> 
@endforeach--}}
    @endsection


    @section('script')
    @endsection
