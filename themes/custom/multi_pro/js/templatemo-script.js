/**
 *	www.templatemo.com
 */

/* HTML document is loaded. DOM is ready.
-----------------------------------------*/
(function ($) {


	$(document).ready(function () {

		$('.mobile-menu-icon').click(function () {
			// Mobile menu
			$('.templatemo-nav').slideToggle();
		});

		$(window).resize(function () {
			if ($(window).width() > 767) {
				$('.templatemo-nav').show();
			}
			else {
				$('.templatemo-nav').hide();
			}
		});

		// http://stackoverflow.com/questions/2851663/how-do-i-simulate-a-hover-with-a-touch-in-touch-enabled-browsers
		$('body').bind('touchstart', function () {
		});

	});
})(jQuery);

(function($){
	$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
		if (!$(this).next().hasClass('show')) {
			$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
		}
		var $subMenu = $(this).next(".dropdown-menu");
		$subMenu.toggleClass('show');

		$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
			$('.dropdown-submenu .show').removeClass("show");
		});

		return false;
	});
})(jQuery);

(function($) {
	$('.drop').click(function () {
		$(this).toggleClass('open').siblings().removeClass('open');
	});

	$('.drop-menu li').each(function () {
		var delay = $(this).index() * 100 + 'ms';

		$(this).css({
			'-webkit-transition-delay': delay,
			'-moz-transition-delay': delay,
			'-o-transition-delay': delay,
			'transition-delay': delay
		});
	});
})(jQuery);