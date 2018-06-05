<ul class="socials" id="uLogin"
    data-ulogin="display=buttons;fields=first_name,last_name,email,photo,country; providers=facebook,vkontakte,instagram; redirect_uri=;callback=uLoginCallback;mobilebuttons=0;">
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
                console.log(res);
                if (res['network']){
                    const network = res['network'];

                    if (network === 'facebook'){
                        /*$('.pluso-facebook').trigger('click');*/
                        $.ajaxSetup({ cache: false });
                        $.getScript('https://connect.facebook.net/en_US/sdk.js', () => {
                            FB.init({
                                appId: '157954035054756',
                                version: 'v3.0'
                            });

                            FB.ui(
                                {
                                    method: 'share_open_graph',
                                    action_type: 'og.likes',
                                    hashtag: '#селфизапризы#чайАССАМ',
                                    quote: 'Я сделал сэлфи со слоном что бы выиграть крутые призы. Попробуй и ты!',
                                    action_properties: JSON.stringify({
                                        object:'{{action('HomeController@publication', ['id' => $id_image])}}',
                                    })
                                },(response) => {
                                    // Debug response (optional)
                                    console.log(response);
                                });
                        });
                    }else if (network === 'vkontakte'){

                        // VK Code

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