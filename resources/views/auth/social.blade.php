{{--<div class="text-center margin-bottom-20" id="uLogin"
     data-ulogin="display=panel;theme=flat;fields=first_name,last_name,email,photo,country;
                             providers=facebook,vkontakte,instagram;hidden=other;
                             redirect_uri={{ urlencode('https://' . $_SERVER['HTTP_HOST'] . '/ulogin/' . $id_image) }}">
</div>--}}

<ul class="socials" id="uLogin"
    data-ulogin="display=buttons;fields=first_name,last_name,email,photo,country; providers=facebook,vkontakte,instagram; redirect_uri={{--{{ urlencode('https://' . $_SERVER['HTTP_HOST'] . '/ulogin/' . $id_image) }}--}};callback=uLoginCallback;mobilebuttons=0;">
    <li class="social fb" data-uloginbutton="facebook">Разместить на facebook</li>
    <li class="social vk" data-uloginbutton="vkontakte">Разместить на vk.com</li>
    <li class="social in" data-uloginbutton="instagram">
        Скачать для размещения в instagram<span>Чтобы разметстить фото в инстаграм, скачайте фото на устройство. Не забудьте разместить хэштег #попробуйсам </span>
    </li>
</ul>

@section('extra-scripts')
    <script src="//ulogin.ru/js/ulogin.js"></script>
    <script>
        function uLoginCallback(token){

            const action = '/ulogin/'+token+'/{{$id_image}}';

            $.post(action, {}, (res) => {
                if (res['network']){
                    const network = res['network'];

                    if (network === 'facebook'){
                        $('.pluso-facebook').trigger('click');
                    }else if (network === 'vkontakte'){
                        $('.pluso-vkontakte').trigger('click');
                    }else if (network === 'instagram'){

                        $('.instagram-download-link').attr('download', '');

                        $('.share-image').click(function () {
                            $(this).find('a')[0].click();
                        });
                        $('.share-image').trigger('click');
                    }
                }else{
                    showWarningNotice(res['error']);
                }

            })
            .error((xhr) => console.log(xhr));

        }
    </script>
@endsection