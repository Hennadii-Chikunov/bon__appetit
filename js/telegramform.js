(function ($) {
	$(".contact-form").submit(function (event) {
		event.preventDefault();
		
		// Сохраняем в переменную form id текущей формы, на которой сработало событие submit
		let form = $('#' + $(this).attr('id'))[0];
		 
		// Сохраняем в переменную класс с параграфом для вывода сообщений
		let message = $(this).find(".contact-form__message");
		
		let fd = new FormData(form);
		$.ajax({
			url: "/php/send-message-to-telegram.php",
			type: "POST",
			data: fd,
			processData: false,
			contentType: false,
		    
		});
		
	});
	$('.show_popup').click(function() { // Вызываем функцию по нажатию на кнопку 
		var popup_id = $('#' + $(this).attr("rel")); // Связываем rel и popup_id 
		$(popup_id).show(); // Открываем окно
		$('.overlay_popup').show(); // Открываем блок заднего фона
	}) 
	$('.overlay_popup').click(function() { // Обрабатываем клик по заднему фону
		$('.overlay_popup, .popup').hide(); // Скрываем затемнённый задний фон и основное всплывающее окно
	})
	}(jQuery));
	