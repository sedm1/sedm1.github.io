$(document).ready(function()
{
	$(".fancybox").fancybox();

	$('.accordeon').click(function(event)
	{
		$(this).toggleClass('active').next('ul').slideToggle(300);
		if($('.banner__nav-ul-items').hasClass('one')) {
			$('.accordeon').not($(this)).removeClass('active');
			$('.acitem').not($(this).next()).slideUp(300);
		}
		if ($('.all').hasClass('active'))
		{
			$('.all').removeClass('active');
		} 	
	});

	$(document).mouseup(function (e)
	{
		var div = $(".accordeon"); // 
		if (!div.is(e.target)
		    && div.has(e.target).length === 0) { 
			div.removeClass('active');
			div.next().slideUp(300); 
		}
	});

	$('.all').click(function()
	{
		$('.all').toggleClass('active');
		if( $('.accordeon').hasClass('active') )
		{
			$('.accordeon').removeClass('active');
			$('.acitem').not($(this).next()).slideUp(300);
		}
	});

	var fileCatcher = document.getElementById('file-catcher');
	var fileInput = document.getElementById('file-input');
	var fileListDisplay = document.getElementById('file-list-display');
  
	var fileList = [];
	var renderFileList, sendFile;
  
	// fileCatcher.addEventListener('submit', function (evnt)
	// {
	// 	evnt.preventDefault();
	// 	fileList.forEach(function (file) {
	// 		sendFile(file);
	// 	});
	// });
  
	fileInput.addEventListener('change', function (evnt)
	{
		fileList = [];
		for (var i = 0; i < fileInput.files.length; i++) {
			fileList.push(fileInput.files[i]);
		}
		renderFileList();
	});
  
	renderFileList = function () {
		fileListDisplay.innerHTML = '';
		fileList.forEach( function (file, index) {
			var fileDisplayEl = document.createElement('p');
			fileDisplayEl.innerHTML = file.name;
			fileListDisplay.appendChild(fileDisplayEl);
		});
	};

	$('#file-catcher').on( 'submit', function()
	{
		let element = $(this);
		let response = element.find(`.response`);
		response.empty();

		let formData = new FormData( element[0] );
		fileList.forEach( function (file, index)
		{
			formData.append('file[]', file);
		});

		$.ajax(
		{
			type: `POST`,
			url: `/send_review.php`,
			cache: false,
			contentType: false,
			processData: false,
			// data: element.serialize(),
			data: formData,
			dataType: `json`,
			beforeSend: function()
			{
				$(`#btn_send_review`).prop( `disabled`, true );
			},
			success: function( r )
			{
				$('#btn_send_review').removeAttr( `disabled` );
				if( r.msg )
					response.html( r.msg );
				if( r.ok )
				{
					element[0].reset();
					$( `#file-list-display` ).empty();
				}
			}
		});
		return false;
	})

});