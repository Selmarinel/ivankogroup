@extends('selmarinel_admin::admin.layouts.template')
@section('page_title', 'Управление заказами')
@section('tHead')
    <th>Заказчик</th>
    <th>Телефон</th>
    <th>Почта</th>
    <th width="30%">Текст</th>
    <th>Дата Заказа</th>
    <th>Статус</th>
@endsection

@section('tBody')
    @foreach($collection as $model)
        <tr class="even pointer">
            <td class="a-center ">
                <input value="{{$model->id}}" type="checkbox" class="tableflat">
            </td>
            <td>{{$model->name}}</td>
            <td>{{$model->phone}}</td>
            <td>{{$model->mail}}</td>
            <td>{{$model->text}}</td>
            <td>{{$model->created_at}}</td>

            <td>
                <span class="btn {{$model->getStateClass()}}">
                    {{($model->getStateName())}}
                </span>
            </td>
            <td class="last">
                @if($model->status == \App\Modules\SelmarinelCore\Database\Models\Base::STATUS_NOT_CHK)
                    <a class="btn btn-info" href="{{$getRoute('active',['id'=>$model->id])}}">
                        <i class="glyphicon glyphicon-play-circle"></i> Начать Выполнение
                    </a>
                    <a class="btn btn-danger" href="{{$getRoute('decline',['id'=>$model->id])}}">
                        <i class="glyphicon glyphicon-remove-sign"></i> Отменить
                    </a>
                @elseif($model->status == \App\Modules\SelmarinelCore\Database\Models\Base::STATUS_ACTIVE)
                    <a class="btn btn-success" href="{{$getRoute('active',['id'=>$model->id])}}">
                        <i class="glyphicon glyphicon-ok-sign"></i> Закончить
                    </a>
                    <a class="btn btn-danger" href="{{$getRoute('decline',['id'=>$model->id])}}">
                        <i class="glyphicon glyphicon-remove-sign"></i> Отменить
                    </a>
                @else
                    <span class="label label-info">{{($model->getStateName())}}</span>
                @endif
            </td>
        </tr>
    @endforeach
@endsection