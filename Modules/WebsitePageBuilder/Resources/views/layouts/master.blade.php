
<!doctype html>
<html>

<head>
    <title>BuilderJS 4.0</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ URL::asset('Modules/WebsitePageBuilder/assets/image/builderjs_color_logo.png') }}" rel="icon"
        type="image/x-icon" />
    <link rel="stylesheet" href="{{ URL::asset('Modules/WebsitePageBuilder/assets/dist/builder.css') }}">
    <script src="{{ URL::asset('Modules/WebsitePageBuilder/assets/dist/builder.js') }}"></script>
    {{-- <script src="{{ URL::asset('Modules/WebsitePageBuilder/assets/src/js/builder.js') }}"></script> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    @yield('head')

</head>

<body class="overflow-hidden">
    <div
        style="text-align: center;
            height: 100vh;
            vertical-align: middle;
            padding: auto;
            display: flex;">
        <div style="margin:auto" class="lds-dual-ring"></div>
    </div>
    @yield('content')

    @yield('script')

</body>

</html>
