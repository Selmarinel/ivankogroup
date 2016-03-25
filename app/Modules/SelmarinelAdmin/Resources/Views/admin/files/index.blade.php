@extends('selmarinel_admin::admin.layouts.template')
@section('page_title', 'Управление Файлами')
@section('tHead')
    <th>Название</th>
    <th>Изображение</th>
    <th>Связка</th>
    <th>Дата создания</th>
    <th>Статус</th>
@endsection

@section('tBody')
    @foreach($collection as $model)
        <tr class="even pointer">
            <td class="a-center ">
                <input value="{{$model->id}}" type="checkbox" class="tableflat">
            </td>
            <td>{{$model->name}}</td>
            <td><img src="{{$model->getCover()}}" class="img-rounded" style="width: 75px"></td>
            <td>{{$model->project->title}}</td>
            <td>{{$model->created_at}}</td>

            <td>
                <span class="btn {{$model->getStateClass()}}">
                    {{($model->getStateName())}}
                </span>
            </td>
            <td class="last">
                <a class="btn btn-success" href="{{$getRoute('edit',['id'=>$model->id])}}">
                    <i class="fa fa-pencil-square-o"></i>
                </a>
                <a class="btn {{($model->status)?"btn-warning":"btn-info"}}" href="{{$getRoute('active',['id'=>$model->id])}}">
                    <i class="fa {{($model->status)?"fa-eye-slash":"fa-eye"}}"></i>
                </a>
            </td>
        </tr>
    @endforeach
@endsection