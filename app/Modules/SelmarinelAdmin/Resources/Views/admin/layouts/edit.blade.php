@extends('selmarinel_admin::admin.layouts.template')

@section('content')
    <link rel="stylesheet" href="{{$app['selmarinel_admin.assets']->getPath('css/admin.css')}}">
    <link rel="stylesheet" href="{{$app['selmarinel_admin.assets']->getPath('css/custom.min.css')}}">
    <link rel="stylesheet" href="{{$app['selmarinel_admin.assets']->getPath('css/pnotify.core.min.css')}}">
    <link href="{{$app['selmarinel_admin.assets']->getPath('css/icheck/flat/green.css')}}" rel="stylesheet">

    <div class="wrapper">
        @include('selmarinel_admin::admin.layouts.navbar')

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Ivank Group
                    <small>Админ Панель</small>
                </h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="x_title">
                        <h2>
                            @yield('page_title')
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <h2>
                                    @if($model->id)Редактирование @else Создание @endif
                                        @yield('title_name')
                                </h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form action="{{$getRoute(($model->id) ? 'edit' : 'add', ["id" => $model->id])}}" class="popup form-horizontal form-label-left" enctype="multipart/form-data">
                                        <div class="col-md-12 col-md-offset-0">
                                            <input type="hidden" name="id" value="{{$model->id}}" />
                                            @yield('form_body')
                                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                            <a href="{{$getRoute()}}" class="btn btn-warning">Отмена</a>
                                            @if($model->id)
                                                <input type="text" value="{{$model->id}}" class="hidden">
                                                <input type="submit" value="Обновить" class="btn btn-primary">
                                            @else
                                                <input type="submit" value="Создать" class="btn btn-primary">
                                            @endif
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script>
        $('form').on('submit',function(e){
            PopUpShow();
            function goTo(url){
                console.log(2)
                //
            }
            var form = $(e.target);
            if(! form.hasClass('popup')) {
                console.log(form);
                return true;
            }
            var formData = new FormData();
            form.serializeArray().reduce(function(obj, item) {
                formData.append(item.name, item.value);
                return obj;
            }, {});
            _.each(form.find('input[type=file]'), function(file){
                if(file.files[0] != undefined) {
                    console.log($(file).attr('name'), file.files[0]);
                    formData.append($(file).attr('name'), file.files[0]);
                }
            })

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    PopUpHide();
                    var response = JSON.parse(res)
                    new PNotify({
                        title: 'Успех',
                        text: 'Сохранение данных прошло успешно!',
                        type: 'success'
                    })

                    if(response.goto != undefined) {
                        console.log(1);
                        setTimeout(function(){
                            window.location.href = response.goto;
                        }, 1000);
                    }
                },
                error: function(res){
                    PopUpHide();
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

        $('#addICover span').on('click',function(){
            $('#selectCover').click();
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#addICover img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#selectCover[type=file]').on('change', function(){
            readURL(this);
        })
    </script>
@endsection