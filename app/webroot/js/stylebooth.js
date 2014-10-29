
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
	if( $('#productsResults').length > 0 ){
		var container = document.querySelector('#productsResults');
		var msnry = new Masonry( container, {
			//columnWidth: '25%',
			itemSelector: '.col-md-3'
		});
	}


	//GALERIAS/RESULTADOS/ETC: para MOUSEOVER y MOUSEOUT en los thumbnails
	function ThumbOut() {
		timer_thumb = setTimeout(function() {
			$(".caption").fadeOut(200);
		},0);
	}

	/*$(".thumb_click").mouseover(function() {
		$(this).siblings(".caption").fadeIn(300);
	}).mouseout(ThumbOut);

	$(".social_thumbs").mouseover(function() {
		clearTimeout(ThumbOut);
	});*/

	$(".col-md-3").live({
		mouseenter: function() {
			$caption = $(this).find('.caption');
			$caption.fadeIn(300);
		},
		mouseleave: function() {
			$caption = $(this).find('.caption');
			$caption.fadeOut(200);
		}
	});

	$(".social_thumbs").live('mouseover', function(event) {
		clearTimeout(ThumbOut);
	});

	$("#productsFilter").change(function(event){
		$text = $(this).val();
		$sizes = $("#sizes").val();
		$style = $("#style").val();
		$outfit = $('#outfitID');
		$hasAllProducts = $('#hasAllProducts');
		$user_id = $('#user-id');
		$store_id = $('#store_id');

		if ($outfit.length > 0 && $hasAllProducts.val() !== 1) {
			$id   = $outfit.val();
			$.ajax({
				type: 'post',
				url: '/products/getProductsByOutfit/' + $id + '/' + $text,
				success: function(html) {
					filterProductsWithOutfit(html);
				}
			});
		} else if ($hasAllProducts.length > 0 && $hasAllProducts.val() == 1) {
			$.ajax({
				type: 'post',
				url: '/products/filterAllProducts/' + $text,
				success: function(html) {
					filterProducts(html, 'galeria_thumb');
				}
			});
		} else if ($user_id.length > 0 && $user_id.val() !== '') {
			$.ajax({
				type: 'post',
				url: '/products/filterAllProductsFromWishlist/' + $text + '/' + $user_id.val(),
				success: function(html) {
					filterProductsNoSocialButtons(html);
				}
			});
		} else if ($store_id.length > 0 && $store_id.val() != '') {
			$.ajax({
				type: 'post',
				url: '/products/filterAllProducts/' + $text,	//TODO: change this url
				success: function(html) {
					filterProducts(html, 'galeria_thumb');
				}
			});
		} else {
			$.ajax({
				type: 'post',
				url: '/products/getProductsByFilter/' + $text + '/' + $sizes + '/' + $style,
				success: function(html) {
					filterProducts(html, 'products-thumb outfit_pieces');
				}
			});
		}
	});


});

function filterProducts(html, type) {
	var obj = JSON.parse(html);
	var result = "";
	for (i=0; i<obj.length; i++) {
		result += '<div class="col-md-3">'
		+ '<div class="thumbnail '+ type + '">'
		+ '<img src="/files/products/' + obj[i].Product.image + '" alt="' + obj[i].Product.name + '">'
		+ '<div class="caption">';

		if (type === 'galeria_thumb') {
			result += '<div class="galeria_thumb_specs">'
				+ obj[i].Product.name + '.<br/>$' + obj[i].Product.price
				+ '</div>';
		} else {
			result += obj[i].Product.name + '.<br/>$' + obj[i].Product.price;
		}

		if (obj[i].Coupon.length > 0){
			result += '<h6><a href="/products/detail/' + obj[i].Product.id + '">Ve Por Tu Cupon!</a></h6>';
		}
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

function filterProductsWithOutfit(html) {
	var obj = JSON.parse(html);
	var result = "";
	for (i=0; i<obj.Product.length; i++) {
		result += '<div class="col-md-3">'
		+ '<div class="thumbnail products-thumb outfit_pieces">'
		+ '<img src="/files/products/' + obj.Product[i].image + '" alt="' + obj.Product[i].name + '">'
		+ '<div class="caption">'
		+ obj.Product[i].name + '.<br/>$' + obj.Product[i].price;
		if (obj.Product[i].Coupon.length > 0){
			result += '<h6><a href="/products/detail/' + obj.Product[i].id + '">Ve Por Tu Cupon!</a></h6>';
		}
		result += '<div class="social_thumbs">'
		+ '<img src="/img/social_thumbs_sb.jpg" alt="Stylebooth" border="0" class="stylebooth_thumb"/>'
		+ '<a href="http://instagram.com/styleboothmx"><img src="/img/social_thumbs_inst.jpg" alt="Instagram" border="0"/></a>'
		+ '<a href="https://www.facebook.com/sharer/sharer.php?u=http://stylebooth.mx/products/detail/' + obj.Product[i].id + '"><img src="/img/social_thumbs_fb.jpg" alt="Facebook" border="0"/></a>'
		+ '<a href="https://twitter.com/home?status=Nuevo producto de Stylebooth http://stylebooth.mx/products/detail/' + obj.Product[i].id + '"><img src="/img/social_thumbs_tw.jpg" alt="Twitter" border="0"/></a>'
		+ '<a href="https://plus.google.com/share?url=http://stylebooth.mx/products/detail/' + obj.Product[i].id + '"><img src="/img/social_thumbs_go.jpg" alt="Google+" border="0"/></a>'
		+ '<a href="https://pinterest.com/pin/create/button/?url=http://stylebooth.mx/products/detail/' + obj.Product[i].id + '&media=http://stylebooth.mx/files/products/' + obj.Product[i].image + '&description=' + obj.Product[i].name + '"><img src="/img/social_thumbs_pin.jpg" alt="Pinterest" border="0"/></a>'
		+ '<a href="#"><img src="/img/social_thumbs_more.jpg" alt="More" border="0"/></a>'
		+ '</div>'
		+ '</div>'
		+ '<a href="/products/detail/' + obj.Product[i].id + '" class="thumb_click"></a>'
		+ '</div>'
		+ '</div>';
	}

	$('#productsResults').empty()
		.append(result);
}

function filterProductsNoSocialButtons(html) {
	var obj = JSON.parse(html);
	var result = "";

	for (i=0; i<obj.length; i++) {
		result += '<div class="col-md-3 product_' + obj[i].Product.id + '">' +
		'<div class="thumbnail mibooth_thumb">' +
		'<a class="thumb-booth" href="/products/detail/' + obj[i].Product.id + '"><img src="/files/products/' + obj[i].Product.image + '" alt="' + obj[i].Product.name + '"></a>' +
			'<div class="caption" style="display: none;">' +
				'<div class="galeria_thumb_specs">' +
					obj[i].Product.name + '.<br/>$' + obj[i].Product.price +
				'</div>' +
					'<a href="/products/detail/' + obj[i].Product.id + '">Ver producto</a>' +
					'<a onclick="deleteFromWishlist(' + obj[i].Product.id + ');">Eliminar de Wishlist</a>' +
				'</div>' +
					'<a href="/products/detail/' + obj[i].Product.id + '" class="thumb_click"></a>' +
				'</div>' +
			'</div>';
	}

	$('#productsResults').empty()
		.append(result);
}