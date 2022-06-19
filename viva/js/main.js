$(function(){
    $("#includedFooter").load("blocks/Footer.html"); 
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
function openModalBg(){
	$("body").addClass("block-body")
	$(".modal__bg").css({"display":"flex"})
}
function closeModalBg(){
	$("body").removeClass("block-body")
	$(".modal__bg").css({"display":""})
}
function closeAllModal(){
	$(".modal__window").removeClass("modal__window-active")
	$(".modal__window").removeClass("modal__window-preactive")
}
function openModal(clas, clas_active){
	
	$("." + clas).addClass("modal__window-preactive")
	openModalBg()
	setTimeout(() => {
		$("." + clas).addClass("" + clas_active)
	}, "100")
}
function closeModal(clas, clas_active){
	closeModalBg()
	$(clas).removeClass("modal__window-preactive")
	setTimeout(() => {
		$(clas).removeClass("" + clas_active)
	}, "100")
}
$(".modal__bg").click(function(e){
	if ($(e.target).hasClass("modal__bg")){
		closeAllModal()
		closeModalBg()
	}
})
$(".redact-1").click(function(){
    $(".redact-1").hide()
    $(".redact-2").show()
    $(".profile__redict").show()
})
$(".item__more-info").click(function(){
	closeAllModal()
	openModalBg()
	var id = $(this).attr('id')
	openModal(id, "modal__window-active")
})
$(".closeMore").click(function(){
	closeAllModal()
	var parent = $(this).parent(".more")
	closeModal(parent, "modal__window-active")
})
$(".abo").click(function(){
	$(".about").toggleClass("about-active")
	$(".actions__block").toggleClass("none")
	$(".action__label").toggleClass("dis")
})
$(".header__burger").click(function(){
	$(".burger__block").addClass("burger__block-active")
	if (window.innerWidth < 600) {
		$("body").addClass("block-body")
	}
})
$(".burder-close").click(function(){
	$(".burger__block").removeClass("burger__block-active")
	$("body").removeClass("block-body")
})
$(".lich_kab").click(function(){
	$(".reg__block").toggleClass("reg__block-active")
})
$(".zvonModal").click(function(){
	closeAllModal()
	openModal("zvonok", "modal__window-active")
})
$(".zapisat").click(function(){
	closeAllModal()
	openModal("zapis", "modal__window-active")
})
$(".car__descript-round").click(function(){
	var clas = $(this).attr("id")
	var CarBg = $(".car__bg")

	CarBg.addClass("car__bg-active")
	$("." + clas).css({"display":"flex"})
	setTimeout(() => {
		CarBg.addClass("car__bg-op")
	}, 200)
	setTimeout(() => {
		$(".md-main__img").addClass("md-main__img-active")
		$("body").addClass("bb")
	}, 400)
	setTimeout(() => {
		$(".xod__descript-item").addClass("xod__descript-item-active")
	}, 800)
})
$(".prev").click(function(){
	var Modals = $(".car__bg .container")
	var CarBg = $(".car__bg")
	Modals.css({"display":""})
	CarBg.removeClass("car__bg-active")
	$("body").removeClass("bb")
	CarBg.removeClass("car__bg-op")
	$(".md-main__img").removeClass("md-main__img-active")
	$(".xod__descript-item").removeClass("xod__descript-item-active")
})