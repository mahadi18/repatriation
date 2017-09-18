<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    {{--
    <link rel="shortcut icon" href="img/favicon.png">
    --}}
    <link rel="shortcut icon" href="{!! asset('img/favicon.ico') !!}">
    <title>Missing Child Alert - RIMS</title>
    <!-- Bootstrap core CSS -->
{!! Html::style('css/bootstrap.min.css') !!}
{!! Html::style('css/bootstrap-reset.css') !!}
<!--external css-->
{!! Html::style('assets/font-awesome/css/font-awesome.css') !!}

{!! Html::style('assets/bootstrap-fileupload/bootstrap-fileupload.css') !!}
{!! Html::style('assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css') !!}
{!! Html::style('assets/bootstrap-datepicker/css/datepicker.css') !!}
{!! Html::style('assets/bootstrap-timepicker/compiled/timepicker.css') !!}
{!! Html::style('assets/bootstrap-colorpicker/css/colorpicker.css') !!}
{!! Html::style('assets/bootstrap-daterangepicker/daterangepicker-bs3.css') !!}
{!! Html::style('assets/bootstrap-datetimepicker/css/datetimepicker.css') !!}
{!! Html::style('assets/jquery-multi-select/css/multi-select.css') !!}

<!-- Custom styles for this template -->
{!! Html::style('css/style.css') !!}
{!! Html::style('css/style-responsive.css') !!}
{!! Html::style('css/custom.css') !!}
@yield('style')
<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    {!! Html::script('js/html5shiv.js') !!}
    {!! Html::script('js/respond.min.js') !!}
    <![endif]-->
</head>
<body class="<?php echo $controller . ' ' . $action . ' ' . Auth::user()->roles[0]->name; ?>">
<section id="container" class="">

{{--@section('header')--}}
<!--header start-->
@include('layouts.header')
<!--header end-->
{{--@show--}}

{{--@section('sidebar')--}}
<!--sidebar start-->
@include('layouts.left_navigation')
<!--sidebar end-->
{{--@show--}}

<!--main content start-->
    <section id="main-content">
        <section class="wrapper site-min-height">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif


        <!-- page start-->
        @yield('content')
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->

{{--@section('footer')--}}
<!--footer start-->
@include('layouts.footer')
<!--footer end-->
    {{--@show--}}


</section>

<!-- js placed at the end of the document so the pages load faster -->
{!! Html::script('js/jquery.js') !!}
{!! Html::script('js/bootstrap.min.js') !!}
{{--
<script class="include" type="text/javascript" src="{!! asset('js/jquery.dcjqaccordion.2.7.js') !!}"></script>
--}}
{!! Html::script('js/jquery.dcjqaccordion.2.7.js') !!}
{!! Html::script('js/jquery.scrollTo.min.js') !!}
{!! Html::script('js/jquery.nicescroll.js') !!}
{!! Html::script('js/respond.min.js') !!}

<!-- dataTables scripts start -->
{!! Html::script('assets/data-tables/jquery.dataTables.js') !!}
{!! Html::script('assets/data-tables/DT_bootstrap.js') !!}
<!-- editable dataTables script -->
{!! Html::script('js/editable-table.js') !!}
<!-- dataTables scripts end -->

<!--this page plugins-->

{!! Html::script('assets/fuelux/js/spinner.min.js') !!}
{!! Html::script('assets/bootstrap-fileupload/bootstrap-fileupload.js') !!}
{!! Html::script('assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js') !!}
{!! Html::script('assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js') !!}
{!! Html::script('assets/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
{!! Html::script('assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') !!}
{!! Html::script('assets/bootstrap-daterangepicker/moment.min.js') !!}
{!! Html::script('assets/bootstrap-daterangepicker/daterangepicker.js') !!}
{!! Html::script('assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js') !!}
{!! Html::script('assets/bootstrap-timepicker/js/bootstrap-timepicker.js') !!}
{!! Html::script('assets/jquery-multi-select/js/jquery.multi-select.js') !!}
{!! Html::script('assets/jquery-multi-select/js/jquery.quicksearch.js') !!}

{{-- Script for CKEditor --}}
{!! Html::script('assets/ckeditor/ckeditor.js') !!}

{{-- Script for TimezoneDetect --}}
{!! Html::script('js/jstz.min.js') !!}

<!--common script for all pages-->
{!! Html::script('js/common-scripts.js') !!}

<!--this page  script only-->
{!! Html::script('js/advanced-form-components.js') !!}
{!! Html::script('js/jquery.highlight.js') !!}
{!! Html::script('js/iucms.js') !!}

<script>

    $(document).ready(function () {

        // Disable all inputs in a page
        // $("form :input").attr("disabled","disabled");

        EditableTable.init();

        $(document).on('click', '.add_doc_type', function () {
            alert('This feature is under development. Please be patient.');
        });

        $(document).on('click', '#detect_timezone', function () {
            var timezone = jstz.determine();
            console.log(timezone.name());
            alert(timezone.name());
        });

    });
</script>

@yield('script')
</body>
</html>
