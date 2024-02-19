$(document).ready(function(){
  //Просто элементы
    $(".services__item").slice(0, 3).show();
    $(".services__button").on("click", function(e){
      e.preventDefault();
      $(".services__item:hidden").slice(0, 3).slideDown();
      if($(".services__item:hidden").length == 0) {
        $(".services__button").hide()
      }
    });

    $(".blag__item").slice(0, 4).show();
    $(".blag__button").on("click", function(e){
      e.preventDefault();
      $(".blag__item:hidden").slice(0, 4).slideDown();
      if($(".blag__item:hidden").length == 0) {
        $(".blag__button").hide()
      }
    });
    $('.kluch__item-icon').click((e) => {
      var parent = $(e.currentTarget).siblings('.kluch__item-d');
      parent.toggleClass('kluch__item-d-active')
    })
    $('.ur__block-first .ur__img-item').mouseenter((e) => {
      $('.ur__block-first .ur__img-item').addClass('ur__img-filter')
      $(e.currentTarget).addClass('ur__img-active')
    })
    $('.ur__block-first .ur__img-item').mouseleave((e) => {
      $('.ur__block-first .ur__img-item').removeClass('ur__img-filter')
      $(e.currentTarget).removeClass('ur__img-active')
    }) 

    $('.ur__block-second .ur__img-item').mouseenter((e) => {
      $('.ur__block-second .ur__img-item').addClass('ur__img-filter')
      $(e.currentTarget).addClass('ur__img-active')
    })
    $('.ur__block-second .ur__img-item').mouseleave((e) => {
      $('.ur__block-second .ur__img-item').removeClass('ur__img-filter')
      $(e.currentTarget).removeClass('ur__img-active')
    })
    $('.quest__item').click((e) => {
      $(e.currentTarget).toggleClass('quest__item-active')
    })

    //Модалки
    function OpenWindow(bg, mainWindow){
      $('.'+bg).css({'display': 'flex'})
      setTimeout(() => {
        $('.'+bg).addClass(bg+ '-active')
      }, 10)
      $('.'+mainWindow).css({'display': 'block'})
      setTimeout(() => {
        $('.'+mainWindow).addClass(mainWindow+ '-active')
      }, 10)
    }
    function CloseWindow(bg, mainWindow){
      $('.'+mainWindow).removeClass(mainWindow+ '-active')
      setTimeout(() => {
        $('.'+mainWindow).css({'display': ''})
      }, 300)
      $('.'+bg).removeClass(bg+ '-active')
      setTimeout(() => {
        $('.'+bg).css({'display': ''})
      }, 300)
    }
    //Модалка с формой
    $('.main__button').click(() => {
      OpenWindow('modal__bg', 'modal__form')
    })
    $('.modal__form-close').click(() => {
      CloseWindow('modal__bg', 'modal__form')
    })

    //Видео блок
    $('.how__video-button').click(()=> {
      OpenWindow('modal__bg', 'modal__video')
    })
    $('.modal__video-close').click(() => {
      CloseWindow('modal__bg', 'modal__video')
    })
    //Верхушка
    $('.burger').click(()=> {
      OpenWindow('header__nav', 'header__menu')
    })
    $('.header__menu-close').click(()=> {
      CloseWindow('header__nav', 'header__menu')
    })

    //Табуляция
    $('.tabs__header-item').click((e) => {
      let CurrentItem = $(e.currentTarget).data('tab')
      $('.tabs__header-item').removeClass('tabs__header-active')
      $(e.currentTarget).addClass('tabs__header-active')
      $('.tabs__item').show()
      if(CurrentItem != 0){
        $('.tabs__item').each(function(){
          if ($(this).data('item') != CurrentItem){
            $(this).hide()
          }
        })
      }
      
      
    })
})