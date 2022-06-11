$(function(){
    $("#includedHeader").load("blocks/Header.html"); 
    $("#includedFooter").load("blocks/Footer.html"); 
    $('html, body').animate({ scrollTop: 0 })
    FormClose()
    var $videoContainer = $('#video'),
		$videoControls = $('.video-control'),
		$video = $('#myVideo')[0];

	$videoControls.click(function () {
		if ($video.paused) {
			$video.play();
			$videoContainer.addClass('video-is-playing');
		} else {
			$video.pause();
			$videoContainer.removeClass('video-is-playing');
			//	возвращаем постер
			$video.load();
		}
	});
})
function FormClose(){
    $(".redact-2").hide()
    $(".profile__redict").hide()
}
$(".redact-1").click(function(){
    $(".redact-1").hide()
    $(".redact-2").show()
    $(".profile__redict").show()
})