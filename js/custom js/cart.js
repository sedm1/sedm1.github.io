var cart = {
	init: function(){
		$('.cart-close').add('.cart-modal .cart-action .cart-next').off().on('click', function(){
			$(this).parents('.cart-modal:first').removeClass('active');
		});
		$('.cart-modal').off().on('click', function(){
			$(this).removeClass('active');
		});
		$('.cart-body').off().on('click', function(e){
			event.preventDefault();
			event.stopPropagation();
		});
	},
	add: function() {
		
	},
	show: function() {
		$('.cart-modal').addClass('active');
	}
}

cart.init();