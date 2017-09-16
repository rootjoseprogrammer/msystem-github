<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>H.C.M. S.A.</title>

    <!-- Styles -->

    {!! Html::style("public/css/bootstrap.min.css") !!}

    <!-- Custom CSS -->
    {!! Html::style("public/css/metisMenu.min.css") !!}
    {!! Html::style("public/css/sb-admin.min.css") !!}


    <!-- Morris Charts CSS -->
    <!--<link href="css/plugins/morris.css" rel="stylesheet">-->

    <!-- Custom Fonts -->
    {!! Html::style("public/font-awesome/css/font-awesome.min.css") !!}


    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    <div id="app">

        @include('layouts.navM')

        <div id="wrapper">
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        @include('alerts.success')
                        @include('alerts.errors')
                    </div>
                </div>
                @yield('content')
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->

    </div>

    <!-- Scripts -->
    {!! Html::script("public/js/jquery.min.js") !!}
    {!! Html::script("public/js/bootstrap.min.js") !!}
    {!! Html::script("public/js/msystem.js") !!}

    <!-- Metis Menu Plugin JavaScript -->
    {!! Html::script("public/js/metisMenu.min.js") !!}

    <!-- Custom Theme JavaScript -->
    {!! Html::script("public/js/sb-admin.min.js") !!}

    <!--<script src="public/js/app.js"></script>-->
</body>
</html>
