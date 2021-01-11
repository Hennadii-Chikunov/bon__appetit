// Скрипт для плавных переходов по ссылкам
$(document).ready(function() {
	$("body").css("display", "none");
	$("body").fadeIn(1300);
  $("a.transition").click(function(event){
	  event.preventDefault();
	  linkLocation = this.href;
	  $("body").fadeOut(1600, redirectPage);
  });
  function redirectPage() {
	  window.location = linkLocation;
  }
});
// Скрипт работы со Scroll to Top
// ScrollToTop button toggle
$(window).scroll(function () {
	if($(window).scrollTop() > $(window).height()/3){
	$('.scrolltotop').toggleClass('showScrolltop', true);}
	else { $('.scrolltotop').removeClass('showScrolltop');}
	});
// данный скрипт это надежное меню по юзабилити и удобвству пользователя
	$(document).ready(function() {
		$(".header__burger").click(function(event) {
			$(".header__burger, .header__nav").toggleClass("active");
			// Отмена скролла при включенном мобильном меню
			$("body").toggleClass("lock");
		});
	});
	// ДАННЫЙ СКРИПТИК, ВЫПОЛНЯЕТ ПРОСТЕЙШУЮ ЗАДАЧУ - РЕАЛИЗАЦИЮ ТОГО , ЧТО ЕСТЬ В МАКЕТЕ (ФОРМА ПОД ХЭДЕРОМ)
	$(".text").val("2 peoples");