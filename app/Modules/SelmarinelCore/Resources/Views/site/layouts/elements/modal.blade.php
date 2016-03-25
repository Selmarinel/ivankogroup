<div class="modal fade" id="project{{$model->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{$model->title}}</h4>
            </div>
            <div id="carousel-example-generic-{{$model->id}}" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="{{$model->getCover()}}" alt="...">
                    </div>
                    @foreach($model->files as $file)
                        <div class="item">
                            <img src="{{$file->getCover()}}" alt="{{$file->name}}" class="img-responsive">
                        </div>
                    @endforeach
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic-{{$model->id}}" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic-{{$model->id}}" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="col-xs-12 text-justify">
                <hr>
                <?= $model->description ?>
            </div>
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
                <form class="form-group popup text-left col-xs-12" action="{{$getRoute('api:comments',['id'=>$model->id])}}">
                    <h5 class="custom_title" style="margin:5px -5px">Ваш комментарий</h5>
                    <input type="text" class="form-control {{(isset($_COOKIE['name']))?'hidden':''}}" required
                           value="{{(isset($_COOKIE['name']))?$_COOKIE['name']:null}}" placeholder="Ваше имя" name="user">

                    <input type="text" class="hidden"  name="avatar"
                           value="{{(isset($_COOKIE['img']))?$_COOKIE['img']:$app['SelmarinelCore.assets']->getPath('/images/user_blank.png')}}" >

                    <textarea class="form-control" required id="tex{{$model->id}}" placeholder="Тест комментария" name="text"></textarea>
                    <input type="submit" value="Оставить комментарий" class="btn btn-more btn-link comment-button" style="margin-top: 5px;">
                </form>

            <div class="modal-footer">
                <div class="col-xs-4 text-left">
                    <button type="button" class="btn btn-more btn-link" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Закрыть</span></button>
                </div>
                <div class="col-xs-8">
                    <span class="btn btn-xs btn-more"><i class="fa fa-eye"></i> {{$model->views}}</span>
                    <span class="btn btn-xs btn-more"><i class="fa fa-photo"></i> {{$model->files->count()}}</span>
                    <span class="btn btn-xs btn-more"><i class="fa fa-comments"></i> {{$model->comments->count()}}</span>
                </div>
                {{--<span class="btn btn-xs btn-more"><i class="fa fa-thumbs-up"></i> {{$model->likes}}</span>--}}
            </div>
        </div>
    </div>
</div>