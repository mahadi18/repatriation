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
    <link media="all" type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <title>Missing Child Alert - RIMS</title>
    {!! Html::script('js/jquery.js') !!}
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
</head>
<body>

    <a href=#" class="logo"><img alt="" src="{!! asset('img/mca-app-logo.png') !!}"></a>



            @yield('content')

        <!-- page start-->

        <!-- page end-->

    <!--main content end-->

<hr style="width: 100%">
    <!--footer start-->
    <footer class="site-footer">
        <div class="text-center">
            2015 &copy; Missing Child Alert (MCA).
            <a href="#" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
    <!--footer end-->








<script>

    $(document).ready(function () {
        window.print();
    });
</script>


</body>
</html>
