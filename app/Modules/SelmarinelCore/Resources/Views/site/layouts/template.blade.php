<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" Content="ru">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="ivankogroup, крафт, мебель, купить мебель, новая, купить, новая мебель, заказ, заказать мебель, заказать уникальную мебель, уникальную, мастерская, ivanko, group, мастерская мебели, Киев, Украина, купить уникальную мебель">
    <meta name="description" content="Творческая мастерская ,по изготовлению , проектированию ,
            специализированных изделий под заказ , оформление деревом ,
            разработка подсветки и освящения , а так же многое другое">

    <meta name="author" content="Selmarinel"/>
    <meta name="copyright" content="©2015-2016 Selmarinel"/>
	<meta http-equiv="Cache-Control" content="public">
	<meta http-equiv="Cache-Control" content="max-age=12000">
	<meta http-equiv="Expires" content="Wed, 22 Mar 2017 00:20:05 GMT">
    <title>
        @section('title')
            Selmarinel Core
        @show
    </title>

    <!-- Bootstrap core CSS -->
    <link href="{{$app['SelmarinelCore.assets']->getPath('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{$app['SelmarinelCore.assets']->getPath('fonts/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{$app['SelmarinelCore.assets']->getPath('css/animate.min.css')}}" rel="stylesheet">
    <link href="{{$app['SelmarinelCore.assets']->getPath('css/main.min.css')}}" rel="stylesheet">
    <link rel="icon" href="{{$app['SelmarinelCore.assets']->getPath('/favicon.ico')}}">
    <link rel="icon" href="{{$app['SelmarinelCore.assets']->getPath('/favicon-32.png')}}" sizes="32x32"/>
    <link rel="icon" href="{{$app['SelmarinelCore.assets']->getPath('/favicon-64.png')}}" sizes="64x64"/>
    <!--[if IE]><link rel="shortcut icon" href="{{$app['SelmarinelCore.assets']->getPath('/favicon.ico')}}"><![endif]-->
    <!-- IE10 -->
    <meta name="msapplication-TileColor" content="#D83434">
    <meta name="msapplication-TileImage" content="/favicon.ico">
	<script src="{{$app['SelmarinelCore.assets']->getPath('js/lib/jquery/jquery-2.1.3.min.js')}}"></script>
    <script type="text/javascript" src="{{$app['SelmarinelCore.assets']->getPath('js/lib/underscore/underscore-min.js')}}"></script>
    <script type="text/javascript" src="{{$app['SelmarinelCore.assets']->getPath('js/lib/bootstrap/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{$app['SelmarinelCore.assets']->getPath('js/jquery.easing.min.js')}}"></script>
    <script type="text/javascript" src="{{$app['SelmarinelCore.assets']->getPath('js/grayscale.js')}}"></script>
    <script type="text/javascript" src="{{$app['SelmarinelCore.assets']->getPath('js/lib/masonry/masonry.pkgd.min.js')}}"></script>
    <script type="text/javascript" src="{{$app['SelmarinelCore.assets']->getPath('js/lib/masonry/imagesloaded.pkgd.min.js')}}"></script>
	    <!-- PNotify -->
    <script type="text/javascript" src="{{$app['selmarinel_admin.assets']->getPath('/js/lib/notify/pnotify.core.js')}}"></script>

    <!--[if lt IE 9]>
    <script src="../assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('links')
</head>
<body>

    @yield('content')

    <script>
        //Функция отображения PopUp
        function PopUpShow(){
            var $preloader = $('#page-preloader'), $spinner   = $preloader.find('.spinner');
            $spinner.fadeIn();
            $preloader.fadeIn(500);
        }
        //Функция скрытия PopUp
        function PopUpHide(){
            var $preloader = $('#page-preloader'), $spinner   = $preloader.find('.spinner');
            $spinner.fadeOut();
            $preloader.fadeOut(500);
        }
    </script>
    @section('script')
        <script>
            alert('WELCOME TO SELMARINEL CORE')
        </script>
    @show
</body>
</html>