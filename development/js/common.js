$(function() {

    $(window).load(function () {
        pageComplete();

        createAnimationBuffer();

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

        $('.share-socials a').click(function(e){
            e.preventDefault();
            e.stopPropagation();

            var str = $(this).attr('class');
            str = str.split(' ');

            switch (str[1]){
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
    });



    function cancelConfirm(e) {
        var overlay = e.attr('href').slice(1);

        $('#'+overlay).hide();
        showWarningNotice('Мы не получили доступ к вашей камере!');
    }

    function confirmationConfirm(e) {
        var overlay = e.attr('href').slice(1);
        var action = e.attr('data-action');

        $('#'+overlay).hide();
        $('.work_zone').show();

        if ( action === 'start-stream' ){

            navigator.getUserMedia = navigator.getUserMedia ||
                                 navigator.webkitGetUserMedia ||
                                 navigator.mozGetUserMedia ||
                                 navigator.msGetUserMedia;

            if (navigator.getUserMedia){
                init();
            }else{
                showWarningNotice('Мы не получили доступ к вашей камере! Возможно Вам следует обновить Ваш браузер новой версии.');
            }

        }else if ( action === 'confirm-action' ){
            $('#results').empty();
            $('.buttons .step-2').hide();
            $('.buttons .step-1').show();
        }
    }

	function pageComplete() {
		//$('.preloader').hide();
		//$('.page-content').fadeIn();

		$('#startStream').displayFlex();
		$('#container').displayFlex();

    }

});
$.fn.displayFlex = function () {
    $(this).css('display', 'flex');
};
function showWarningNotice(message) {

    $('#warningNotice .confirm-title').text(message);
    $('#warningNotice').displayFlex();

}

$(window).load(function() {
	var bh = $("body").height();
	var hh = $(".header img").height();
	
	$(".header li a, .burger").css({height: hh, lineHeight: hh+"px"});
	if ($(window).width() > 800) {
		$("section").css({height: bh});
	}
});
$(window).resize(function() {
	var bh = $("body").height();
	var hh = $(".header img").height();
	
	$("header li a, .burger").css({height: hh, lineHeight: hh+"px"});
	if ($(window).width() > 800) {
		$("section").css({height: bh});
	}
});

$(".help .x").click(function() {
	$(".help").fadeOut();
});

$(".burger").click(function() {
	$(".menu").fadeToggle();
});