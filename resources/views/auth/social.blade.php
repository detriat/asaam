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

            const action = '/ulogin/'+token;

            $.post(action, {}, (res) => {
                console.log(res);
                res['id_image'] = '{{$id_image}}';

               if (res['network']){
                    const network = res['network'];

                    if (network === 'facebook'){
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
                                    hashtag: '#чайАССАМ',
                                    quote: 'Я сделал сэлфи со слоном что бы выиграть крутые призы. Попробуй и ты!',
                                    action_properties: JSON.stringify({
                                        object:'{{action('HomeController@publication', ['id' => $id_image])}}',
                                    })
                                },(response) => {

                                    console.log('respones facebook: '+response);

                                    if (response){
                                        $.post('/register', res, () => {
                                            showWarningNotice('Поздравляем, Вы стали участником розыграша');
                                        })
                                    }else{
                                        showWarningNotice('Увы, для участия в розыграше Вы должны поделиться фото в одной из социальных сетей!');
                                    }
                                });
                        });
                    }else if (network === 'vkontakte'){

                        $.post('/register', res, (register_res) => {
                            console.log(register_res);
                            if (!register_res['error']){
                                showWarningNotice('Поздравляем, Вы стали участником розыграша');
                                setTimeout(() => {
                                    window.location.href = res['profile'];
                                }, 1500)
                            }else{
                                showWarningNotice(register_res['error']);
                            }
                        }).error((xhr) => console.log(xhr));

                    }else if (network === 'instagram'){

                        $.post('/register', res, (register_res) => {
                            if (register_res['network']){
                                $('.instagram-download-link').attr('download', '');
                                $('.share-image').click(function () {
                                    $(this).find('a')[0].click();
                                });
                                $('.share-image').trigger('click');
                                showWarningNotice('Отлично! Вы на полпути к победе. Теперь разместите это фото в своем инстаграм согласно правил акции');
                            }
                        }).error((xhr) => console.log(xhr));
                    }
                }else{
                    showWarningNotice(res['error']);
                }
            })
            .error((xhr) => console.log(xhr));

        }
    </script>
@endsection