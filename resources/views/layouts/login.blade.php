<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Wuash') }}</title>

        <!-- Styles -->

        <script>var PATH = '{{url("/")}}'</script>
        {!!Html::script('/vendor/template/vendors/jquery/dist/jquery.min.js')!!}
        <!--{!!Html::script('/vendor/jquery-ui.js')!!}-->

        {!!Html::script('/vendor/DataTables-1.10.13/media/js/jquery.dataTables.min.js')!!}
        {!!Html::script('/vendor/DataTables-1.10.13/extensions/ColReorder/js/dataTables.colReorder.min.js')!!}
        {!!Html::script('/vendor/DataTables-1.10.13/extensions/Buttons/js/dataTables.buttons.min.js')!!}
        {!!Html::script('/vendor/DataTables-1.10.13/jszip.min.js')!!}
        {!!Html::script('/vendor/DataTables-1.10.13/pdfmake.min.js')!!}
        {!!Html::script('/vendor/DataTables-1.10.13/vfs_fonts.js')!!}
        {!!Html::script('/vendor/DataTables-1.10.13/buttons.html5.min.js')!!}

        {!!Html::style('/vendor/DataTables-1.10.13/media/css/jquery.dataTables.css')!!}	

        {!!Html::style('/vendor/DataTables-1.10.13/extensions/Buttons/css/buttons.bootstrap.css')!!}
        {!!Html::style('/vendor/DataTables-1.10.13/extensions/Buttons/css/buttons.dataTables.min.css')!!}

        {!!Html::script('/vendor/DataTables-1.10.13/extensions/Buttons/js/buttons.html5.js')!!}
        {!!Html::script('/vendor/DataTables-1.10.13/extensions/Buttons/js/buttons.colVis.js')!!}
        {!!Html::script('/vendor/DataTables-1.10.13/extensions/Buttons/js/buttons.flash.js')!!}
        {!!Html::script('/vendor/DataTables-1.10.13/extensions/Buttons/js/buttons.print.js')!!}



<!--        <script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
        <link href='//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css' rel="stylesheet" />-->

        {!!Html::script('/vendor/toastr/toastr.min.js')!!}
        {!!Html::style('/vendor/toastr/toastr.min.css')!!}
        <!--{!!Html::style('/vendor/DataTables-1.10.13/media/css/dataTables.bootstrap.css')!!}--> 
        <!--{!!Html::style('/vendor/DataTables-1.10.13/media/css/jquery.dataTables.css')!!}--> 

        <!--{!!Html::script('js/Administration/dash.js')!!}-->
        <!-- Bootstrap -->
        <!--<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">-->
        {!!Html::style('/vendor/template/vendors/bootstrap/dist/css/bootstrap.min.css')!!}
        {!!Html::script('/vendor/template/vendors/bootstrap/dist/js/bootstrap.min.js')!!}
        {!!Html::style('/vendor/template/vendors/font-awesome/css/font-awesome.min.css')!!}
        {!!Html::style('/vendor/template/vendors/nprogress/nprogress.css')!!}
        {!!Html::style('/vendor/template/vendors/google-code-prettify/bin/prettify.min.css')!!}

        <!-- Font Awesome -->

        <!--<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">-->
        <!-- NProgress -->
        <!--<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">-->
        <!-- bootstrap-wysiwyg -->
        <!--<link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">-->

        <!-- Custom styling plus plugins -->
        <!--<link href="../build/css/custom.min.css" rel="stylesheet">-->

        {!!Html::style('/vendor/datetimepicker/css/jquery.datetimepicker.css')!!}
        {!!Html::script('/vendor/datetimepicker/js/jquery.datetimepicker.full.min.js')!!}


        {!!Html::style('/vendor/font-awesome-4.7.0/css/font-awesome.min.css')!!}


        {!!Html::style('/vendor/select2/css/select2.min.css')!!}
        {!!Html::style('/css/page.css')!!}
        {!!Html::script('/vendor/select2/js/select2.js')!!}
        {!!Html::script('/vendor/plugins.js')!!}

    </head>
    <body style="background-image: url('../images/fondo_azul.jpg');   background-repeat: no-repeat, repeat;background-size: 100%">
        <div id="app">
            @yield('content')
        </div>

        <!-- Scripts -->
        <!--<script src="{{ asset('js/app.js') }}"></script>-->
    </body>
</html>
