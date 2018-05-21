$(function() {

    $(document).ready(function () {
        pageComplete();


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

        $('.burger').click(function () {
            $('.menu').fadeIn();
        });

        $('.menu').click(function (e) {
            if ( !$(e.target).closest('ul').length ){
                $('.menu').hide();
            }
        });

        $('.share-socials li').click(function(e){
            e.preventDefault();
            e.stopPropagation();

            var str = $(this).find('i').attr('class');
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
            navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

            if (navigator.getUserMedia){
                init();
            }else{
                showWarningNotice('Мы не получили доступ к вашей камере!');
            }

        }else if ( action === 'confirm-action' ){
            $('#results').empty();
            $('.snapshot-form').hide();
            $('.snapshot-btn').show();
        }
    }

	function pageComplete() {
		$('.preload').hide();
		$('.page-content').fadeIn();

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
