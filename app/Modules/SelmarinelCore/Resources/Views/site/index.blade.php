@extends('SelmarinelCore::site.layouts.template')

@section('title', 'Ivanko Group')

@section('links')
    <link rel="stylesheet" href="{{$app['selmarinel_admin.assets']->getPath('css/pnotify.core.min.css')}}">
@endsection

@section('content')
    @include('SelmarinelCore::site.layouts.elements.navbar')
    <header class="intro" id="top">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="col-xs-12 brand-image"><img src="{{$app['SelmarinelCore.assets']->getPath('images/logo.png')}}" alt="emblem" id="Em" class="img-responsive"></div>
                        <h1 class="brand-heading">IvankoGroup</h1>
                        <p class="intro-text" style="font-family: Avdiva;">МЫ – КОМПАНИЯ, КОТОРАЯ ПРОИЗВОДИТ ХОРОШИЕ И ИНТЕРЕСНЫЕ ИЗДЕЛИЯ.</p>
                    </div>
                    <div class="col-xs-12 linker">
                        <a href="#projects" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-down"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @include('SelmarinelCore::site.layouts.elements.projects')

    <section class="content-section text-center" id="hr">
        <div class="container">
            <div class="row">
                <img style="width: 220px;" src="{{$app['SelmarinelCore.assets']->getPath('images/logo.png')}}">
                <h2>Ivanko Group</h2>
                <p>Это обитель добрых гениев, способных воплотить в реальность изделия из любых материалов,
                    дабы принести частичку волшебства и уюта в Ваш дом.</p>
            </div>
        </div>
    </section>

    <section id="working" class="content-section text-center container">
        <div class="content row">
            <div class="col-lg-12"><h2 class="custom_title">Услуги компании</h2></div>
            <div class="col-lg-12">
                <ul class="timeline">
                    <li>
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="{{$app['SelmarinelCore.assets']->getPath('/images/1.jpg')}}" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading"><i class="fa fa-paint-brush"></i> ГОТОВАЯ ПРОДУКЦИЯ НА ПРОДАЖУ</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    Вы можете приобрести уже готовую продукцию, произведённую в нашей мастерской
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="{{$app['SelmarinelCore.assets']->getPath('/images/2.jpg')}}" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading"><i class="fa fa-briefcase"></i> РАЗРАБОТКА И ОФОРМЛЕНИЕ</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    Разработка концепции и изготовление элементов фасадных витрин и интерьеров ( мебель, арт-объекты  декора, силовые конструкции).
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="{{$app['SelmarinelCore.assets']->getPath('/images/3.jpg')}}" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading"><i class="fa fa-wrench"></i> ПРОИЗВОДСТВО</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    При создании нашей продукции мы используем древесину различных пород, а также комбинируем ее с другими видами материалов. Качество европейское -  цены наши.
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="{{$app['SelmarinelCore.assets']->getPath('/images/4.jpg')}}" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading"><i class="fa fa-file-text"></i> ГАРАНТИЯ</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    Мы гарантируем качество любой продукции, созданной в нашей мастерской.
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section id="download" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h3>Закажите уникальные изделия прямо сейчас</h3>
                    <p>Оставьте заявку и мы свяжемся с вами в ближайшее время</p>
                    <a href="#contact" class="btn btn-success btn-default page-scroll">Заказать!</a>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-12"><h2 class="custom_title">ПОЧЕМУ ИМЕННО МЫ</h2></div>
            <!--<div class="col-lg-12"><h3>Мы никогда не сидим без дела!</h3></div>-->
            <div class="col-lg-12">
                <p>
                    Наша команда состоит из идейных специалистов, любящих свое дело. Каждый из нас прошёл долгий путь в разной производственной деятельности. Продукция, которую создает мастерская, имеет качество и гарантии в своем сегменте. В нашей компании работаю умельцы с золотыми руками и ясной головой в области создания, дизайна, проектирования, и внедрения деревянных изделий. Взаимопонимание с каждым клиентом обеспечивает создание уникального продукта с гарантией от нашей компании.
                    <br/>
                    Мастера компании Ivanko Group имеют опыт работы в создании мебели которая создаст уют, и будет радовать Вас каждый день.
                </p>
            </div>
        </div>
        <div class="clearfix"><br></div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="timeline">
                    <li>
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="{{$app['SelmarinelCore.assets']->getPath('/images/5.jpg')}}" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading">ОПЫТНЫЕ СПЕЦИАЛИСТЫ</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    В нашей мастерской, работают специалисты любящие свое дело. Они вкладывают душу в каждое изделие и всегда рады порадовать заказчика.
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="{{$app['SelmarinelCore.assets']->getPath('/images/6.jpg')}}" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading">БОЛЬШЕ ВОЗМОЖНОСТЕЙ</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    Вы можете получить уже готовое изделие просто приехав к нам в шоу рум.
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="{{$app['SelmarinelCore.assets']->getPath('/images/7.jpg')}}" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading">ИНДИВИДУАЛЬНЫЙ ПОДХОД</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    Мы всегда рады рассказать заказчику о техническом подходе к вопросу изготовления продукта, чтобы он мог понять и поучаствовать в изготовлении своего заказа. Также вы можете прийти со своей идеей, которую мы с удовольствием воплотим в жизнь.
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
<!-- Map Section -->
<section id ="mapSection" class="embed-container  maps">
	<div id="map" style="pointer-events: none;"></div>
</section>
    @include('SelmarinelCore::site.layouts.elements.contact')

    <footer>
        <div class="container text-center">
			<p class="raz">Copyright &copy; <a href="http://admin.ivankogroup.com">Selmarinel</a> & <a href="http://vergo.space"><strong class="raz">[VERGO]</strong> </a>2016</p>
        </div>
    </footer>
@endsection

@section('script')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALQk6TeigssrTVIg-pxowMLhaXxGiRfoY&callback=initMap"
        async defer></script>
<script>
function initMap() {

    var myLatlng = new google.maps.LatLng(50.5026094, 30.4457486);
    var myOptions = {
        zoom: 17,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById("map"), myOptions);

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title:"ул. Мостицкая,24"
    });
}

 // Disable scroll zooming and bind back the click event
  var onMapMouseleaveHandler = function (event) {
    var that = $(this);

    that.on('click', onMapClickHandler);
    that.off('mouseleave', onMapMouseleaveHandler);
    that.find('#map').css("pointer-events", "none");
  }

  var onMapClickHandler = function (event) {
    var that = $(this);

    // Disable the click handler until the user leaves the map area
    that.off('click', onMapClickHandler);

    // Enable scrolling zoom
    that.find('#map').css("pointer-events", "auto");

    // Handle the mouse leave event
    that.on('mouseleave', onMapMouseleaveHandler);
  }

  // Enable map zooming with mouse scroll when the user clicks the map
  $('.maps.embed-container').on('click', onMapClickHandler);
</script>
        <!-- PNotify -->
    <script type="text/javascript" src="{{$app['selmarinel_admin.assets']->getPath('/js/lib/notify/pnotify.core.js')}}"></script>
    <script>
        function setMasonry(){
            var $grid = $('.grid');
            $grid.imagesLoaded().progress( function() {
                $grid.masonry({
                    animate: true,
                    columnWidth: '.grid-item',
                    isFitWidth: true,
                    itemSelector : '.grid-item'
                });
            });
        }
        $(document).ready(function(){
            var $grid_item = $('.grid-item').width();
   	        $('.grid-item').width($grid_item-10);
            $('.text-block').hide();
			setMasonry();
        }
        );
        $('.block').on('mousemove',function(){
            $(this).find('.text-block').fadeIn(300);
            $(this).find('.name').addClass('padi');
        });
        $('.block').on('mouseleave',function(){
            $(this).find('.text-block').fadeOut(300);
            $(this).find('.name').removeClass('padi');
        });
        $('.project_item').on('click',function(){
            $id = $(this).val();
            $.ajax({
                type: "GET",
                url: "/site/api/increment/"+$id
            });
        });

        $('form').on('submit',function(e) {
            $this = $(this);
            var form = $(e.target);
            if (!form.hasClass('popup')) {
                return true;
            }
            var formData = new FormData();
            form.serializeArray().reduce(function (obj, item) {
                formData.append(item.name, item.value);
                return obj;
            }, {});
            _.each(form.find('input[type=file]'), function (file) {
                if (file.files[0] != undefined) {
                    console.log($(file).attr('name'), file.files[0]);
                    formData.append($(file).attr('name'), file.files[0]);
                }
            });
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    var response = JSON.parse(res)
                    new PNotify({
                        title: 'Успешно',
                        text: (response.message) ? response.message :'Ваш заказ успешно отправлен',
                        type: 'success'
                    });
                    if(response.order != undefined) {
                        $('input[name="name"]').val('');
                        $('input[name="phone"]').val('');
                        $('input[name="mail"]').val('');
                        $('textarea[name="text"]').val('');
                    }
                    if(response.comment != undefined){
                        var comment = _.template('<div class="comments col-xs-12 panel text-left">'+
                                '<div class="col-xs-2">'+
                                '<img src="<%= image %>" class="img-responsive img-circle">'+
                                '<span class="text-center"><%= user %></span>'+
                                '</div>'+
                                '<div class="col-xs-10 comment-text"><%= commenttext %></div>'+
                                '</div>');

                        $('#comments-block-'+response.id).prepend(comment({user:response.model.user,commenttext:response.model.text,image:response.model.avatar}));
                        $this.find('textarea[name="text"]').val('');

                    }
                },
                error: function (res) {
                    var errors = JSON.parse(res.responseText).errors || ['Данные не валидные'];
                    new PNotify({
                        title: 'Ошибка',
                        text: errors.join("<br>"),
                        type: 'error'
                    })
                    return false;
                }
            });
            return false;
        });
    </script>
@endsection