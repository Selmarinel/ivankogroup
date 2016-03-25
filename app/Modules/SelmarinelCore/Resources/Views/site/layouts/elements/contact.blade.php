<section id="contact" class="content-section text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="col-lg-12">
                    <h3 class="bebas" style="color:#eee">Свяжитесь с нами</h3>
                </div>
                <div class="col-xs-3" style="z-index: 2;"><a href="https://www.facebook.com/ivankogroup" class="btn btn-dark btn-lg" target="_blank"><i class="fa fa-facebook fa-2x"></i></a></div>
                <div class="col-xs-3"style="z-index: 2;"><a href="https://www.instagram.com/ivankogroup/" class="btn btn-dark btn-lg" target="_blank"><i class="fa fa-instagram fa-2x"></i></a></div>
                <div class="col-xs-3"style="z-index: 2;"><a href="https://plus.google.com/115226412993562348306" class="btn btn-dark btn-lg" target="_blank"><i class="fa fa-google-plus fa-2x"></i></a></div>
                <div class="col-xs-3"style="z-index: 2;"><a href="https://vk.com/ivankogroup" class="btn btn-dark btn-lg"><i class="fa fa-vk fa-2x" target="_blank"></i></a></div>
                <div class="col-xs-6" style="color:#eee"><h5>(095) 594 41 63</h5></div>
                <div class="col-xs-6" style="color:#eee"><h5>(067) 900 35 75</h5></div>
            </div>
            <form class="popup" action="{{$getRoute('api:order')}}">
                <div class="col-lg-4">
                    <div class="input-div"><input name="name" class="about-text-input ni" placeholder="Ваше имя" type="text" required value="{{isset($_COOKIE['name']) ? $_COOKIE['name'] : '' }}"></div>
                    <div class="input-div"><input name="phone" class="about-text-input ti" placeholder="Ваш телефон +3 (012) 345-67-89" type="tel" required></div>
                    <div class="input-div"><input name="mail" class="about-text-input mi" placeholder="Ваш e-mail" type="text"></div>
                </div>
                <div class="col-lg-4">
                    <div class="input-div">
                        <textarea class="about-textarea" name="text" required placeholder="Введите подробности заказа"></textarea>
                        <input type="submit" class="about-button" value="Отправить">
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>