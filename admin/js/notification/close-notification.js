$(document).ready(function () {
	$(".close").click(
		function () {
			$(this).parent().fadeTo(400, 0, function () {
				$(this).slideUp(400);
			});
			return false;
		}
	);
});