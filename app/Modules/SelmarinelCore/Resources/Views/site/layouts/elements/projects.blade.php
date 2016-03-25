<section id="projects" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="custom_title">Проекты</h2>
        </div>
        <div class="container marketing">
            <section id="blog-landing" class="grid">
                @if(isset($collection) && !empty($collection))
                    @foreach($collection as $model)
                        @include('SelmarinelCore::site.layouts.elements.project')
                        @include('SelmarinelCore::site.layouts.elements.modal')
                    @endforeach
                @else
                    <div class="col-lg-12 text-center">
                        <h1>Извините, но возникли неполадки в базе, или проэкты еще не загружены</h1>
                    </div>
                @endif
            </section>
        </div>
    </div>
</section>

<div class="col-lg-12 text-center">
    <a href="{{$getRoute('all')}}"><span class="btn btn-link btn-more">Показать все</span> </a>
</div>