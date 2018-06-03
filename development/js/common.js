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

    $('.social').on('click', function(e){

        e.preventDefault();

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


    $(document).on('click', '.ulogin-button-facebook', function(){
       console.log('click faceBook');
    });

    $(document).on('click', '.ulogin-button-vkontakte', function(){
        console.log('click vk');
    });

    $(document).on('click', '.ulogin-button-vkontakte', function(){
        console.log('click instagram');
    });


    $(".header li a, .burger").css({height: hh, lineHeight: hh + "px"});
    if ($(window).width() > 800) {
        $("section").css({height: bh});
    }
	
	setTimeout(function() {
		var title = $("#title").offset().left;
		$(".title").css({left: title});
	}, 100);
	$("#title").hover(function() {
		if ($(this).is(":hover")) {
			$(".title").css({zIndex: "99999", opacity: "1"});
		} else {
			$(".title").css({zIndex: "-1", opacity: "0"});
		}
	});
	$("body:not(:has(.tracking))").attr("class", "index-2");
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