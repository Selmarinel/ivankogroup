@extends('selmarinel_admin::admin.layouts.edit')

@section('title_name', 'Комментария')

@section('form_body')
    <div class="form-group">
        <label>Текст</label>
        <textarea name="text" class="form-control">{{$model->text}}</textarea>
    </div>
@endsection

@section('script')

@endsection