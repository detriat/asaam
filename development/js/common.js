const bh = $("body").height();
const hh = $(".header img").height();

if ( typeof createAnimationBuffer != 'undefined'){
    $(window).load(() => {
        pageComplete();
        createAnimationBuffer();
    });
}else{
    $(window).ready(() => {

        pageComplete();
        $('.preloader').hide();
        $('.page-content').fadeIn();
    }); 
}

$(document).ready(function(){
    $(".help .x").click(function () {
        $(".help").fadeOut();
    });

    $(".burger").click(function () {
        $(".menu").fadeToggle();
    });

    $('.cancel-confirm').click(function (e) {
        e.preventDefault();
        e.stopPropagation();

        cancelConfirm($(this));
    });

    $('.confirmation-confirm').click(function (e) {
        e.preventDefault();
        e.stopPropagation();

        confirmationConfirm($(this));
    });

    $('.share-socials a').click(function (e) {
        e.preventDefault();
        e.stopPropagation();

        let str = $(this).attr('class');
        str = str.split(' ');

        switch (str[1]) {
            case 'social-fb':
                $('.ulogin-button-facebook').trigger('click');
                break;
            case 'social-vk':
                $('.ulogin-button-vkontakte').trigger('click');
                break;
            case 'social-in':
                $('.ulogin-button-instagram').trigger('click');
                break;
        }

    });

    $(".header li a, .burger").css({height: hh, lineHeight: hh + "px"});
    if ($(window).width() > 800) {
        $("section").css({height: bh});
    }
});

$(window).resize(function () {
    $("header li a, .burger").css({height: hh, lineHeight: hh + "px"});
    if ($(window).width() > 800) {
        $("section").css({height: bh});
    }
});

function cancelConfirm(e) {
    const overlay = e.attr('href').slice(1);

    $('#' + overlay).hide();
    showWarningNotice('Мы не получили доступ к вашей камере!');
}

function confirmationConfirm(e) {
    const overlay = e.attr('href').slice(1);
    const action = e.attr('data-action');

    $('#' + overlay).hide();
    $('.work_zone').show();

    if (action === 'start-stream') {

        navigator.getUserMedia = navigator.getUserMedia ||
            navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia ||
            navigator.msGetUserMedia;

        if (navigator.getUserMedia) {
            init();
        } else {
            showWarningNotice('Мы не получили доступ к вашей камере! Возможно Вам следует обновить Ваш браузер новой версии.');
        }

    } else if (action === 'confirm-action') {
        $('#results').empty();
        $('.buttons .step-2').hide();
        $('.buttons .step-1').show();
    }
}

function pageComplete() {

    /*$('.preloader').hide();
    $('.page-content').fadeIn();*/

    $('#startStream').displayFlex();
    $('#container').displayFlex();

}

$.fn.displayFlex = function () {
    $(this).css('display', 'flex');
};

function showWarningNotice(message) {

    $('#warningNotice .confirm-title').text(message);
    $('#warningNotice').displayFlex();

} 