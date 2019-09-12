<!DOCTYPE html>
<html>
<head>
    <title>Laravel Test</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="format-detection" content="telephone=no"/>

    <link rel="stylesheet" type="text/css" href="{{ url('/css/bootstrap/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ url('/css/font-awesome/css/font-awesome.min.css') }}" />
    <script type="text/javascript" src="{{ url('/js/jquery/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ url('/js/bootstrap/bootstrap.min.js') }}"></script>
    <!-- CSS -->
    @yield('css')

</head>
<body class="companyDetails">
    <!--middle-content-->
    <div class="container-fluid">
        <div class="row dFlex">
            <!--vertical-sidebar-->
            @yield('content')
        </div>
    </div>
    <!--/middle-content-->
</body>
</html>
