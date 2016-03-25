<article class="white-panel text-center grid-item col-md-6 col-sm-6 col-xs-12">
    <figure class="block">
        <img src="{{$model->getCover(450)}}" class="img-responsive">
        <span class="name">{{$model->title}}</span>
        <figcaption class="text-block">
            <div class="text">
                {{$model->getShort()}}
            </div>
            <p class="link">
                <button type="button" class="btn btn-more btn-link project_item" data-toggle="modal" value="{{$model->id}}" data-target="#project{{$model->id}}">
                    Подробнее
                </button>
            </p>
            <span class="views"><i class="fa fa-eye"></i> {{$model->views}}</span>
            <span class="views likes"><i class="fa fa-photo"></i> {{$model->files->count()}}</span>
            <span class="proj_comments"><i class="fa fa-comments"></i> {{$model->comments->count()}}</span>
            {{--<span class="proj_comments likes"><i class="fa fa-thumbs-up"></i> {{$model->likes}}</span>--}}
        </figcaption>
    </figure>
</article>