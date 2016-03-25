<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" id="navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
			<span class="label">
                <a href="#top" class="hidden"></a>

                {{--@if(isset($_COOKIE['name']))--}}
                    {{--Здраствуйте, {{$_COOKIE['name']}}--}}
                    {{--<a href="{{$getRoute('api:vk_logout')}}" class="page-scroll"><i class="fa fa-sign-out"></i></a>--}}

                {{--@else--}}
                    {{--<a href="{{$getRoute('api:auth')}}" class="page-scroll"><i class="fa fa-vk"></i></a>--}}
                {{--@endif--}}
			</span>
        </div>
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a class="page-scroll" href="#projects">Проекты</a>
                </li>
                <li>
                    <a class="page-scroll" href="#working">Услуги компании</a>
                </li>
                <li>
                    <a class="page-scroll" href="#about">О нас</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">Свяжитесь с нами</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
