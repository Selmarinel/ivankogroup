<style>
.box-holder{
    padding: 0 30px;
}
.panel .title {
    font-size: 17px;
}
.panel .huge {
    font-size: 45px;
}
</style>
@extends('selmarinel_admin::admin.layouts.template')

@section('content')
    <div class="wrapper">
        <div class="content-wrapper">
            @include('selmarinel_admin::admin.layouts.navbar')
            <section class="content-header">
                <h1>
                    Ivanko Group
                    <small>Админ Панель</small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="x_title">
                        <div class="row box-holder">
                            @foreach($collection as $model)
                                @if($model->type == 'order')
                                    <a href="{{route('admin:orders:index')}}">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="panel {{($model->status == \App\Modules\SelmarinelCore\Database\Models\Base::STATUS_NOT_CHK) ? 'panel-warning' : 'panel-info'}}">
                                                <div class="panel-heading col-xs-12">
                                                    <div class="col-xs-7">
                                                        {{$model->name}}
                                                    </div>
                                                    <div class="col-xs-5 text-right huge">
                                                        <i class="fa {{($model->status == \App\Modules\SelmarinelCore\Database\Models\Base::STATUS_NOT_CHK) ? 'fa-archive' : 'fa-wrench'}}"></i>
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                   {{$model->text}}
                                                    <div class="pull-right">{{$model->created_at}}</div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @elseif($model->type == 'comment')
                                    <a href="{{route('admin:comments:index')}}">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="panel panel-primary ">
                                                <div class="panel-heading col-xs-12">
                                                    <div class="col-xs-7">
                                                        <b>{{$model->user}}</b>
                                                    </div>
                                                    <div class="col-xs-5 text-right huge">
                                                        <i class="fa fa-comment"></i>
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                    {{$model->text}}
                                                    <div class="pull-right">{{$model->created_at}}</div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection