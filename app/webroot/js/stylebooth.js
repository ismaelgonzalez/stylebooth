
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


	//GALERIA: Thumbs como pinterest
	var container = document.querySelector('#productsResults');
	var msnry = new Masonry( container, {
	//columnWidth: '25%',
	itemSelector: '.col-md-3'
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
		clearTimeout(ThumbOut);
	});

	$("#productsFilter").change(function(event){
		$text = $(this).val();
		$sizes = $("#sizes").val();
		$style = $("#style").val();
		$.ajax({
			type: 'post',
			url: '/products/getProductsByFilter/' + $text + '/' + $sizes + '/' + $style,
			success: function(html) {
				filterProducts(html);
			}
		});
	});
});

function filterProducts(html) {
	var obj = JSON.parse(html);
	var result = "";
	for (i=0; i<obj.length; i++) {
		/*result += '<div class="col-md-4">'
		 + '<div class="thumbnail">'
		 + '<a href="/products/detail/' + obj[i].Product.id + '"> <img style="min-height:210px;height:210px;" src="/files/products/' + obj[i].Product.image + '" alt="' + obj[i].Product.name + '"></a>'
		 + '<div class="caption">'
		 + '<h5><b>' + obj[i].Product.name + '</b></h5>'
		 + '<h5>' + obj[i].Store.name + '</h5>'
		 + '<h5>$' + obj[i].Product.price + '</h5>';
		 if (obj[i].Coupon.length > 0){
		 result += '<h5><a href="/products/detail/' + obj[i].Product.id + '">Ve Por Tu Cupon!</a></h5>';
		 }
		 result += '</div>'
		 + '</div>'
		 + '</div>';*/

		result += '<div class="col-md-3">'
		+ '<div class="thumbnail products-thumb outfit_pieces">'
		+ '<img src="files/products/' + obj[i].Product.image + '" alt="' + obj[i].Product.name + '">'
		+ '<div class="caption">'
		+ obj[i].Product.name + '.<br/>$' + obj[i].Product.price;
		/*if (obj[i].Coupon.length > 0){
		 result += '<h6><a href="/products/detail/' + obj[i].Product.id + '">Ve Por Tu Cupon!</a></h6>';
		 }*/
		result += '<div class="social_thumbs">'
		+ '<img src="/img/social_thumbs_sb.jpg" alt="Stylebooth" border="0" class="stylebooth_thumb"/>'
		+ '<a href="http://instagram.com/styleboothmx"><img src="/img/social_thumbs_inst.jpg" alt="Instagram" border="0"/></a>'
		+ '<a href="https://www.facebook.com/sharer/sharer.php?u=http://stylebooth.mx/products/detail/' + obj[i].Product.id + '"><img src="/img/social_thumbs_fb.jpg" alt="Facebook" border="0"/></a>'
		+ '<a href="https://twitter.com/home?status=Nuevo producto de Stylebooth http://stylebooth.mx/products/detail/' + obj[i].Product.id + '"><img src="/img/social_thumbs_tw.jpg" alt="Twitter" border="0"/></a>'
		+ '<a href="https://plus.google.com/share?url=http://stylebooth.mx/products/detail/' + obj[i].Product.id + '"><img src="/img/social_thumbs_go.jpg" alt="Google+" border="0"/></a>'
		+ '<a href="https://pinterest.com/pin/create/button/?url=http://stylebooth.mx/products/detail/' + obj[i].Product.id + '&media=http://stylebooth.mx/files/products/' + obj[i].Product.image + '&description=' + obj[i].Product.name + '"><img src="/img/social_thumbs_pin.jpg" alt="Pinterest" border="0"/></a>'
		+ '<a href="#"><img src="/img/social_thumbs_more.jpg" alt="More" border="0"/></a>'
		+ '</div>'
		+ '</div>'
		+ '<a href="/products/detail/' + obj[i].Product.id + '" class="thumb_click"></a>'
		+ '</div>'
		+ '</div>';
	}

	$('#productsResults').empty()
		.append(result);
}