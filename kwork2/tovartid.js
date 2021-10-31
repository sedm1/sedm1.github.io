$(document).ready(function(){
	$(".technik__item").on('click', parseId2)
});
function parseId2(){
    var id = $(this).attr('data-id')
    console.log(id)
	//localStorage.setItem('id', id)
}