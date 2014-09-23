$(document).ready(function() {

	//MENU: Boton de Signin
	$( "#signin_btn" ).click(function() {
		$( "#singin_form" ).toggle(0);
	});



	//MENU: Para que el menu se reacomode al scrollear
	$(function() {

		var sticky_navigation_offset_top = $('.navbar-collapse').offset().top;

		var sticky_navigation = function(){
			var scroll_top = $(window).scrollTop();

			if (scroll_top > sticky_navigation_offset_top) {
				$('.navbar-collapse').attr('style', 'position:fixed; margin-top:0; width:inherit !important');
				$('.navbar-brand img').attr('style', 'position:fixed; z-index:9999; margin-top:-10px; margin-left:-30px; width:63px;');
				$('.slider').attr('style', 'margin-top:inherit;');


			} else {
				$('.navbar-collapse').attr('style', 'position: inherit; margin-top:50px;');
				$('.navbar-brand img').attr('style', 'position:inherit; z-index:9999; margin-top:0; margin-left:inherit;');
				$('.slider').attr('style', 'margin-top:inherit;');
			}
		};

		sticky_navigation();

		$(window).scroll(function() {
			sticky_navigation();
		});
	});



	//HOME: Fades entre estilos y medidas
	$( ".style_videos a" ).click(function() {
		$( ".style_medidas" ).fadeIn(200);
	});

	$( "#home_estilo_back" ).click(function() {
		$( ".style_medidas" ).fadeOut(200);
	});



	//TIENDAS: Scroll a zonas
	function scrollToAnchor(aid){
		var aTag = $("a[name='"+ aid +"']");
		$('html,body').animate({scrollTop: aTag.offset().top},'slow');
	}

	$("#btn_norte").click(function() {
		scrollToAnchor('tiendas_norte');
	});

	$("#btn_poniente").click(function() {
		scrollToAnchor('tiendas_poniente');
	});

	$("#btn_oriente").click(function() {
		scrollToAnchor('tiendas_oriente');
	});

	$("#btn_sur").click(function() {
		scrollToAnchor('tiendas_sur');
	});



	//GALERIAS/RESULTADOS/ETC: para MOUSEOVER y MOUSEOUT en los thumbnails
	function ThumbOut() {
		timer_thumb = setTimeout(function() {
			$(".caption").fadeOut(200);
		},0);
	}

	$(".thumb_click").mouseover(function() {
		$(this).siblings(".caption").fadeIn(300);
	}).mouseout(ThumbOut);

	$(".social_thumbs").mouseover(function() {
		clearTimeout(timer_thumb);
	});

})