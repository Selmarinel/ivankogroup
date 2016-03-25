@extends('selmarinel_admin::admin.layouts.edit')
@section('title_name', 'Проекта')

@section('form_body')
    <div class="form-group">
        <label>Аватар</label>
        <div class="addCover" id="addICover">
            <span class="addCoverPhoto">
                <div class="middle"><i class="glyphicon glyphicon-plus"></i> Выбрать обложку</div>
            </span>
            <input type="file" name="cover" class="hidden" id="selectCover">
            <img src="{{$model->getCover()}}" style="width:250px" class="img-rounded">
        </div>
    </div>

    <div class="form-group">
        <label>Название</label>
        <input name="title" type="text" value="{{$model->title}}" class="form-control">
    </div>

    <div class="form-group">
        <label>Описание</label>
        <textarea name="description" class="form-control" id="edit">{{$model->description}}</textarea>
    </div>

    <h2>Добавить Галерею</h2>
    <div id="galery_panel">
        <div class="tab-content">
            <div class="" id="profile">
                <div class="col-xs-12 grid">
                    @foreach($model->files as $file)
                        <div id='el{{$file->id}}' class='elementPhoto col-md-2 col-sm-4 col-xs-6 panel grid-item'>
                            <img src = '{{$file->getCover()}}' class='img-responsive'>
                                <span class='deletePhoto'>
                                    <div class='middle'>
                                        <i class='glyphicon glyphicon-trash'></i> Удалить фото
                                    </div>
                                </span>
                            <input class='form-control' name='photo_ids[]' type='hidden' value='{{$file->id}}'>
                        </div>
                    @endforeach
                </div>
                <div class="col-xs-12 panel" id="addPhoto">
                    <span class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Добавить фото</span>
                    <div class="form-group">
                        {!! Form::file('file_photo', ['class' => 'hidden', 'id' => 'coverInput']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <link href="{{$app['selmarinel_admin.assets']->getPath('js/lib/froala_editor/css/froala_editor.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{$app['selmarinel_admin.assets']->getPath('js/lib/froala_editor/css/froala_style.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{$app['selmarinel_admin.assets']->getPath('js/lib/froala_editor/css/themes/gray.min.css')}}" rel="stylesheet" type="text/css">
    <script src="{{$app['selmarinel_admin.assets']->getPath('js/lib/froala_editor/froala_editor.min.js')}}"></script>
    <!--[if lt IE 9]>
    <script src="{{$app['selmarinel_admin.assets']->getPath('js/lib/froala_editor/froala_editor_ie8.min.js')}}"></script>
    <![endif]-->
    <script src="{{$app['selmarinel_admin.assets']->getPath('js/lib/froala_editor/plugins/tables.min.js')}}"></script>
    <script src="{{$app['selmarinel_admin.assets']->getPath('js/lib/froala_editor/plugins/lists.min.js')}}"></script>
    <script src="{{$app['selmarinel_admin.assets']->getPath('js/lib/froala_editor/plugins/colors.min.js')}}"></script>
    <script src="{{$app['selmarinel_admin.assets']->getPath('js/lib/froala_editor/plugins/media_manager.min.js')}}"></script>
    <script src="{{$app['selmarinel_admin.assets']->getPath('js/lib/froala_editor/plugins/font_family.min.js')}}"></script>
    <script src="{{$app['selmarinel_admin.assets']->getPath('js/lib/froala_editor/plugins/font_size.min.js')}}"></script>
    <script src="{{$app['selmarinel_admin.assets']->getPath('js/lib/froala_editor/plugins/block_styles.min.js')}}"></script>
    <script src="{{$app['selmarinel_admin.assets']->getPath('js/lib/froala_editor/plugins/video.min.js')}}"></script>
    <script>
        $(function () {
            $('#edit').editable({
                inlineMode: false,
                theme: 'gray',
                height: '300',
                language: 'ru'
            })
            $('.froala-box div').last().remove();
        });
    </script>
    <script>
        $('#addPhoto span').on('click', function(){
            $('#coverInput').click();
            return;
        });
        $('#coverInput[type=file]').on('change', function(){
            var formData = new FormData();
            if(this.files[0] == undefined) {
                return new PNotify({
                    title: 'Ошибка',
                    text: 'Файл не найден',
                    type: 'error'
                })
            }
            formData.append($(this).attr('name'), this.files[0]);
            var photo_element = _.template("<div id='el<%=id %>' class='elementPhoto col-md-2 col-sm-4 col-xs-6 panel grid-item'>"+
                    "<img src = '<%= image %>' class='img-responsive'>"+
                    "<span class='deletePhoto'><div class='middle'><i class='glyphicon glyphicon-trash'></i> Удалить фото</div></span>"+
                    "<input class='form-control' name='photo_ids[]' type='hidden' value='<%=id %>'></div>");
            $.ajax({
                type: 'POST',
                url: '/api/gallery/add',
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    var response = JSON.parse(res);
                    $item = photo_element({image:response.image,id:response.id});
                    console.log($item);
                    $('.grid').append($item);
                    $('#el'+response.id).find('.deletePhoto').on('click', function(){
                        deletePhoto(this);
                    });
                    new PNotify({
                        title: 'Успех',
                        text: 'Добавление данных прошло успешно!',
                        type: 'success'
                    });
                },
                error: function (res) {
                    new PNotify({
                        title: 'Ошибка',
                        text: 'Фото не загружено',
                        type: 'error'
                    });
                    return false;
                }
            });
        });

        var deletePhoto = function(self) {
            var rootEl = $(self).parent();
            var id = rootEl.find('input').val();

            $.ajax({
                type: 'DELETE',
                url: '/api/gallery/del/' + id,
                success: function(res) {
                    new PNotify({
                        title: 'Успех',
                        text: 'Удаление данных прошло успешно!',
                        type: 'success'
                    });
                    rootEl.slideToggle(500);
                    setTimeout(function(){
                        rootEl.remove();
                    }, 500);
                },
                error: function(res){
                    var errors = JSON.parse(res.responseText).errors || ['Данные не валидные'];
                    new PNotify({
                        title: 'Ошибка',
                        text: errors.join("<br>"),
                        type: 'error'
                    });
                    return false;
                }
            });
        };

        $('.elementPhoto .deletePhoto').on('click', function(e){
            deletePhoto(this);
        });
    </script>
@endsection