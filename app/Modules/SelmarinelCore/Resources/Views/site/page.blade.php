@extends('SelmarinelCore::site.layouts.template')

@include('SelmarinelCore::site.layouts.elements.bar')

@section('links')
    <link rel="stylesheet" href="{{$app['selmarinel_admin.assets']->getPath('css/pnotify.core.min.css')}}">
@endsection

@section('content')
    <div class="container" id="project-row">
        @foreach($collection as $model)
        @section('title')
            {{$model->title}}
        @endsection
        <div class="panel project-block col-xs-12" style="padding: 0px">
            <div class="active">
                <img src="{{$model->getCover()}}" alt="..." style="max-height: 650px; width: auto">
                <div class="carousel-caption">
                    <h3>{{$model->title}}</h3>
                </div>
            </div>
            <!-- Controls -->
            @if($collection->previousPageUrl())
                <a class="left carousel-control" href="<?php echo $collection->previousPageUrl(); ?>" role="button"
                   data-slide="prev" style="text-shadow: 0px 0px 15px #fff, 1px 1px 1em #fff;z-index:20000;">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
            @endif
            @if($collection->nextPageUrl())
                <a class="right carousel-control" href="<?php echo $collection->nextPageUrl(); ?>" role="button"
                   data-slide="next" style="text-shadow: 0px 0px 15px #fff, 1px 1px 1em #fff;z-index:20000;">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            @endif
            </div>
            <h5 class="text-justify panel-body">

                @foreach($model->files as $file)
                    <div class="col-sm-6 col-xs-12 img-thumbnail">
                        <img src="{{$file->getCover()}}" alt="{{$file->name}}" class="img-responsive">
                        <div class="carousel-caption">
                            <h3>{{$file->name}}</h3>
                        </div>
                    </div>
                @endforeach
                <div class="col-xs-12" style="margin-top: 15px">
                    <?= $model->description ?>
                </div>
            </h5>

            <h2 class="custom_title">Комментарии</h2>

            <div id="comments-block-{{$model->id}}">
                @foreach($model->comments as $comment)
                    <div class="comments col-xs-12 panel text-left">
                        <div class="col-xs-2">
                            <img src="{{$comment->getCover()}}" class="img-responsive img-circle">
                            <span class="text-center">{{$comment->user}}</span>
                        </div>
                        <div class="col-xs-10 comment-text">{{$comment->text}}</div>
                    </div>
                @endforeach
            </div>
            <div id="content"></div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react-dom.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.5/marked.min.js"></script>
            <script type="text/babel" src="{{$app['SelmarinelCore.assets']->getPath('js/lib/comments_loader.js')}}"></script>

            <form class="form-group popup text-left col-xs-12"
                  action="{{$getRoute('api:comments',['id'=>$model->id])}}">
                <h5 class="custom_title" style="margin:5px -5px">Ваш комментарий</h5>
                <input type="text" class="form-control {{(isset($_COOKIE['name']))?'hidden':''}}" required
                       value="{{(isset($_COOKIE['name']))?$_COOKIE['name']:null}}" placeholder="Ваше имя" name="user">

                <input type="text" class="hidden" name="avatar"
                       value="{{(isset($_COOKIE['img']))?$_COOKIE['img']:$app['SelmarinelCore.assets']->getPath('/images/user_blank.png')}}">

                <textarea class="form-control" required id="tex{{$model->id}}" placeholder="Тест комментария"
                          name="text"></textarea>
                <input type="submit" value="Оставить комментарий" class="btn btn-more btn-link comment-button"
                       style="margin-top: 5px;">
            </form>
            <div class="panel-footer">
                <span class="btn btn-xs btn-more"><i class="fa fa-eye"></i> {{$model->views}}</span>
                <span class="btn btn-xs btn-more"><i class="fa fa-photo"></i> {{$model->files->count()}}</span>
                <span class="btn btn-xs btn-more"><i class="fa fa-comments"></i> {{$model->comments->count()}}</span>
                {{--<span class="btn btn-xs btn-more"><i class="fa fa-thumbs-up"></i> {{$model->likes}}</span>--}}
            </div>
            <div class="hidden">{{$model->id}}</div>
        @endforeach
    </div>
    <div class="text-center"> <?php echo $collection->render(); ?></div>
@endsection

@section('script')
        <!-- PNotify -->
    <script type="text/javascript" src="{{$app['selmarinel_admin.assets']->getPath('/js/lib/notify/pnotify.core.js')}}"></script>
    <script>
        $('form').on('submit', function (e) {
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
                        text: (response.message) ? response.message : 'Ваш заказ успешно отправлен',
                        type: 'success'
                    });
                    if (response.order != undefined) {
                        $('input[name="name"]').val('');
                        $('input[name="phone"]').val('');
                        $('input[name="mail"]').val('');
                        $('textarea[name="text"]').val('');
                    }
                    if (response.comment != undefined) {
                        var comment = _.template('<div class="comments col-xs-12 panel text-left">' +
                                '<div class="col-xs-2">' +
                                '<img src="<%= image %>" class="img-responsive img-circle">' +
                                '<span class="text-center"><%= user %></span>' +
                                '</div>' +
                                '<div class="col-xs-10 comment-text"><%= commenttext %></div>' +
                                '</div>');

                        $('#comments-block-' + response.id).prepend(comment({
                            user: response.model.user,
                            commenttext: response.model.text,
                            image: response.model.avatar
                        }));
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