<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="X-XSRF-TOKEN" content="{{ csrf_token() }}">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    @inertiaHead
    {!! $settings->header !!}
</head>

<body class="text-gray-900 bg-gray-50 dark:bg-gray-900 dark:text-white">
    @inertia
    <script src="{{ mix('/js/manifest.js') }}" defer></script>
    <script src="{{ mix('/js/vendor.js') }}" defer></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>
    {!! $settings->footer !!}
</body>

</html>
