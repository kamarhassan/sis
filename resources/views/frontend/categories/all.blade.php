@extends('frontend.layouts.master')
@section('title')
@endsection
@section('css')
@endsection

@section('content')
    <div class="row" id="allcours">
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            allcours('{{ route('api.categorie.all') }}', 'allcours');
        });
    </script>
@endsection
