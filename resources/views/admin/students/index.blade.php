@extends('admin.layouts.master')

@section('css')
    <style>
        cursor_pointer {
            cursor: pointer;
            margin: 15px 0;

        }

    </style>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">


            @isset($std)
                @foreach ($std as $key => $stduents)
                    <div id="Row{{ $stduents->id }}" onclick="" class="row bg-light mb-10 p-10 cursor_pointer hover-success">
                        <div class="col-sm-1">{{ $stduents->id }}</div>
                        <div class="col-sm-2">{{ $stduents->name }} </div>
                        <div class="col-md-3">{{ $stduents->email }}</div>
                        <div class="col-md-3">
                            <img class="avatar avatar-xl avatar-1" src="{{ photos_dir($stduents->photo) }}" alt="">
                        </div>
                        <div class="col-md-3">{{ $stduents->birthday }} </div>
                    </div>
                @endforeach
            @endisset



            {{ $std->links() }}
        </div>
    </div>
    <!-- /.box-body -->






@endsection

@section('script')
@endsection
