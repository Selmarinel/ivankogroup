@extends('selmarinel_admin::admin.layouts.edit')

@section('title_name', 'Файла')

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
        <label>Текст</label>
        <textarea name="name" class="form-control">{{$model->name}}</textarea>
    </div>
@endsection

@section('script')
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
                url: '/vadmin/media/del_photo/' + id,
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