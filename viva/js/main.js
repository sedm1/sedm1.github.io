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
	$("body").addClass("block-bb")
	var id = $(this).attr('id')
	openModal(id, "modal__window-active")
})
$(".closeMore").click(function(){
	closeAllModal()
	var parent = $(this).parent(".more")
	closeModal(parent, "modal__window-active")
	$("body").removeClass("block-bb")
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
$(".car__descript__text").click(function(){
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
$("#md__diag").hover(function(){
	$(".car__img").toggleClass("car-drop")
})
$(".md__diag-clas").hover(function(){
	$(".car__img").toggleClass("car-drop")
})
$(".car__descript__text").hover(function(){
	var a = $($(this).siblings("button"))
	a.toggleClass("round-active")
})
$('.label__item').click(function(){
	//setTimeout нужен что бы состояние checked успело перейти на следующий input. Иначе будет получать не тот id
	setTimeout(() => {
		const all = $(".action__item")
		var nume = $('input[name="rad"]:checked').attr("id")
		all.each(function(){
			$(this).removeClass("hid non")
			$(".block__min").css({"display":"", "justify-content": "", "flex-direction": ""})
			if($(this).hasClass(nume)){
				$(this).addClass("hid")
				setTimeout(() => {
					$(this).addClass("non")
					if($(".big-item").hasClass("hid")){
						$(".block__min").css({"display":"flex", "justify-content": "space-between", "flex-direction": "row"})
					}
				}, 1000)
			}
		})
	}, 100)
	

})
$(".soz__item img").hover(function(){
    $(this).attr("src", function(index, attr){
        return attr.replace(".svg", "-active.svg");
    });
}, function(){
    $(this).attr("src", function(index, attr){
        return attr.replace("-active.svg", ".svg");
    });
});
$(".next-step").click(function(){
	$(".reg__modal .input__block-reg").hide()
	$(".reg__modal .pol").hide()
	$(".next-step").hide()
	$(".Tolog-form__btn").hide()
	$(".kod__text").css({"display": "block"})
	$("#kod").css({"display": "block"})
})
$(".LogIn").click(function(){
	closeAllModal()
	openModal("log__modal", "modal__window-active")
})
$(".reg").click(function(){
	closeAllModal()
	openModal("reg__modal", "modal__window-active")
})
$(".Tolog-form__btn").click(function(){
	closeAllModal()
	openModal("log__modal", "modal__window-active")
})
$(".Toreg-form__btn").click(function(){
	closeAllModal()
	openModal("reg__modal", "modal__window-active")
})