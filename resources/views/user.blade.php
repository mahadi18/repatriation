<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Missing Child Alert - RIMS</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    {!! Html::script('js/html5shiv.js') !!}
    {!! Html::script('js/respond.min.js') !!}
    <![endif]-->

    <!-- js placed at the end of the document so the pages load faster -->
    {!! Html::script('js/jquery.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}

    {{-- Script for TimezoneDetect --}}
    {!! Html::script('js/jstz.min.js') !!}
</head>
<body class="user" >

@yield('content')

<!-- Scripts -->

<script type="text/javascript">
    $( document ).ready(function() {
        var w = $( window ).width();
        var h = $( window ).height();
        $('body.user').css('width',w);
        $('body.user').css('height',h);

       var box_height = $('.panel.panel-default').height();
       var box_width = $('.panel.panel-default').width();
       var top_offset = ((h-box_height)/8);

        $('a.mca-app-logo').css({
            'top':top_offset+30+'px',
            'left':(w/2-80)+'px'
        });

        $('#user_timezone').val(jstz.determine().name());

    });
</script>
</body>
</html>
