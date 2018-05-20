<div class="text-center margin-bottom-20" id="uLogin"
     data-ulogin="display=panel;theme=flat;fields=first_name,last_name,email,nickname,photo,country;
                             providers=facebook,vkontakte,odnoklassniki,mailru;hidden=other;
                             redirect_uri={{ urlencode('https://' . $_SERVER['HTTP_HOST']) }}/ulogin/{{$id_image}}">
</div>

@section('extra-scripts')
    <script src="//ulogin.ru/js/ulogin.js"></script>
@endsection