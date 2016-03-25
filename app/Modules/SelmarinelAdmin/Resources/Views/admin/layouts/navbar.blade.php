<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">
                <a href="/" class="logo">
                    <img src="{{$app['SelmarinelCore.assets']->getPath('/images/logo.png')}}" class="img-rounded" style="width: 130px">
                    <h4 class="text-justify">IvankoGroup</h4>
                </a>
            </li>
            <li class="treeview">
                <a href="{{route('admin:index')}}">
                    <i class="fa fa-home"></i>
                    <span>Главная</span>
                </a>
            </li>
            <li class="treeview">
                <a role="button" data-toggle="collapse" href="#collapseProjects" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-pencil"></i>
                    <span>Проекты</span>
                </a>
                <div class="collapse" id="collapseProjects">
                    <ul class="treeview-menu nav child_menu">
                        <li class=""><a href="{{route('admin:projects:index')}}"><i class="fa fa-gears"></i> Управление</a></li>
                        <li class=""><a href="{{route('admin:projects:add')}}"><i class="fa fa-plus-circle"></i> Добавить</a></li>
                    </ul>
                </div>
            </li>
            <li class="treeview">
                <a role="button" data-toggle="collapse" href="#collapseComments" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-comments"></i>
                    <span>Комментарии</span>
                </a>
                <div class="collapse" id="collapseComments">
                    <ul class="treeview-menu nav child_menu">
                        <li class=""><a href="{{route('admin:comments:index')}}"><i class="fa fa-gears"></i> Управление</a></li>
                    </ul>
                </div>
            </li>
            <li class="treeview">
                <a role="button" data-toggle="collapse" href="#collapseOrders" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-hand-o-up"></i>
                    <span>Заказы</span>
                </a>
                <div class="collapse" id="collapseOrders">
                    <ul class="treeview-menu nav child_menu">
                        <li class=""><a href="{{route('admin:orders:index')}}"><i class="fa fa-gears"></i> Управление</a></li>
                    </ul>
                </div>
            </li>
            <li class="treeview">
                <a role="button" data-toggle="collapse" href="#collapseFiles" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-chain"></i>
                    <span>Файлы</span>
                </a>
                <div class="collapse" id="collapseFiles">
                    <ul class="treeview-menu nav child_menu">
                        <li class=""><a href="{{route('admin:files:index')}}"><i class="fa fa-gears"></i> Управление</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </section>
</aside>