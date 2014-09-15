<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		Stylebooth:
		Stylebooth	</title>
	<link href="favicon.ico" type="image/x-icon" rel="icon" />
	<link href="favicon.ico" type="image/x-icon" rel="shortcut icon" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.10.4.custom.min.css" />
	<link rel="stylesheet" type="text/css" href="css/stylebooth.css" />
	<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/carousel.js"></script>
	<script type="text/javascript" src="js/stylebooth.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Muli:300,400' rel='stylesheet' type='text/css'>
	<!--<link rel="stylesheet" type="text/css" href="css/carousel.css" />-->
	<link rel='icon' href='favicon.ico'>
	<!--<link rel="stylesheet" href="stylebooth.css">-->
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>
<body >
<div class="navbar navbar-inverse navbar-default" role="navigation" style=" margin-bottom: 0;">
	<div class="container container_header">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/"><img src="/img/stylebooth_logo.png" /></a>
		</div>
		<div class="navbar-collapse collapse" >
			<ul class="nav navbar-nav" >
				<li><a href="/blogs/lista/">BLOG</a></li>
				<li><a href="/stores/lista">TIENDAS</a></li>
				<li><a href="/products/lista" id="header_btngaleria">GALERÍA</a></li>
				<li><a id="signin_btn">SIGN IN</a></li>
			</ul>
			<div id="singin_form">
				<form class="navbar-form navbar-right" role="form" action="/users/login" id="UserLoginForm" method="post">
					<div class="form-group">
						<input placeholder="Email" class="form-control" style="font-size: 10px;" size="20" name="data[User][email]" type="email" id="UserEmail" required="required">
					</div>
					<div class="form-group">
						<input type="password" placeholder="Password" class="form-control" style="font-size: 10px;" size="20" name="data[User][password]" id="UserPassword" required="required">
					</div>
					<button type="submit" class="btn" style="font-size: 10px;">Sign in</button>
					<div class="form-group" style="color: #FFFFFF; font-size: 10px;" >
						¿No tienes cuenta? <a href="/users/register">Regístrate</a>
						<br><a href="/users/forgotPassword">¿Olvidaste tu contraseña?</a>
						<!--<br />Entrar con faceook <div class="fb-login-button" data-max-rows="1" data-size="icon" data-show-faces="false" data-auto-logout-link="false"></div>-->
					</div>
				</form>
			</div>
		</div><!--/.nav-collapse -->
	</div>
</div>
<div class="container containertop">
<div class="row slider">
	<div id="fader" class="holder">
		<div id="carousel_viewer"></div>
		<div id="carousel_items">
			<img src="files/carousel/home_banner01.jpg" alt="1" />
			<img src="files/carousel/home_banner02.jpg" alt="2" />
			<img src="files/carousel/home_banner01.jpg" alt="3" />
			<img src="files/carousel/home_banner02.jpg" alt="4" />
		</div>
		<div id="carousel_btn" class="btn_slider"></div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			carousel.init({target:'fader',type:'fade'});
		});
	</script>
</div>
<div class="row" id="js-home-styles">
	<div align="center">
		<div id="bannerTop"></div>
		<div class="row">
			<p></p>
			<h1>SELECCIONA TU ESTILO<br/>¨¨¨¨¨¨¨¨¨¨¨¨¨</h1>
			<form id="frmStyle" method="post" role="form">
				<div class="row">
					<div class="col-md-3">
						<div class="style_videos">
							<a onclick="setFilter1(1)">
								<video autoplay loop poster="/img/stylebooth_logo.png">
									<source src="files/styles/casualsunday.mp4" type="video/mp4">
									<source src="files/styles/casualsunday.webm" type="video/webm">
								</video>
								<img src="files/styles/home_style_casual.png" alt="Casual Sunday"/>
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="style_videos">
							<a onclick="setFilter1(2)">
								<video autoplay loop poster="/img/stylebooth_logo.png">
									<source src="files/styles/romanticallypoetic.mp4" type="video/mp4">
									<source src="files/styles/romanticallypoetic.webm" type="video/webm">
								</video>
								<img src="files/styles/home_style_romantic.png" alt="Romantically Poetic"/>
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="style_videos">
							<a onclick="setFilter1(3)">
								<video autoplay loop poster="/img/stylebooth_logo.png">
									<source src="files/styles/rockinfeeling.mp4" type="video/mp4">
									<source src="files/styles/rockinfeeling.webm" type="video/webm">
								</video>
								<img src="files/styles/home_style_rockin.png" alt="Rockin' Feeling"/>
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="style_videos">
							<a onclick="setFilter1(4)">
								<video autoplay loop poster="/img/stylebooth_logo.png">
									<source src="files/styles/urbanstatement.mp4" type="video/mp4">
									<source src="files/styles/urbanstatement.webm" type="video/webm">
								</video>
								<img src="files/styles/home_style_urban.png" alt="Urban Statement"/>
							</a>
						</div>
					</div>
				</div>
				<input id="style_id" name="style_id" type="hidden" value="">
			</form>
			<!--h3><a href="/products/lista">Ver todos los productos</a></h3-->
			<script type="text/javascript">
				function setFilter1(style_id) {
					$('#style_id').val(style_id);
					console.log($('#style_id').val());

					//$('#frmStyle').attr('action', '/filter1')
					//	.submit();
					//TODO: submit chosen style with ajax

					$('#js-home-styles').fadeout('slow');
					$('#js-home-medidas').fadein('slow');
				}
			</script>
		</div>
	</div>
</div>
<div class="row" align="center" id="js-home-medidas">
	<div class="col-md-12 style_medidas">
		<div class="col-md-4"><img src="/img/home_medidas.jpg"/>
		</div>
		<div class="col-md-8">
			<p></p>
			<form id="frmFilter1" method="post" role="form">
				<h3>Selecciona tu Presupuesto</h3>
				<div class="btn-group " data-toggle="buttons" >
					<label class="btn btn-default">
						<input type="radio" name="budget" class='budget' value="500"> $500
					</label>
					<label class="btn btn-default">
						<input type="radio" name="budget" class='budget' value="800"> $800 MXN
					</label>
					<label class="btn btn-default">
						<input type="radio" name="budget" class='budget' value="1000"> $1000 MXN
					</label>
					<label class="btn btn-default">
						<input type="radio" name="budget" class='budget' value="1500"> $1500 MXN
					</label>
					<label class="btn btn-default">
						<input type="radio" name="budget" class='budget' value="2000"> $2000 MXN
					</label>
					<label class="btn btn-default">
						<input type="radio" name="budget" class='budget' value="2001"> Cualquier presupuesto
					</label>
				</div>
				<h3>Selecciona tu talla</h3>
				<div class="btn-group " data-toggle="buttons" >
					<label class="btn btn-default">
						<input type="radio" name="size" class='size' value="chica"> Chica
					</label>
					<label class="btn btn-default">
						<input type="radio" name="size" class='size' value="mediana"> Mediana
					</label>
					<label class="btn btn-default">
						<input type="radio" name="size" class='size' value="grande"> Grande
					</label>
					<label class="btn btn-default">
						<input type="radio" name="size" class='size' value="extra grande"> Extra Grande
					</label>
					<label class="btn btn-default">
						<input type="radio" name="size" class='size' value="cualquier talla"> Cualquier talla
					</label>
				</div>
				<br /><br />
				<h3>Selecciona tu talla en calzado</h3>
				<div class="btn-group " data-toggle="buttons" >
					<label class="btn btn-default">
						<input type="radio" name="foot_size" class='foot_size' value="3"> 3
					</label>
					<label class="btn btn-default">
						<input type="radio" name="foot_size" class='foot_size' value="3.5"> 3.5
					</label>
					<label class="btn btn-default">
						<input type="radio" name="foot_size" class='foot_size' value="4"> 4
					</label>
					<label class="btn btn-default">
						<input type="radio" name="foot_size" class='foot_size' value="4.5"> 4.5
					</label>
					<label class="btn btn-default">
						<input type="radio" name="foot_size" class='foot_size' value="5"> 5
					</label>
					<label class="btn btn-default">
						<input type="radio" name="foot_size" class='foot_size' value="5.5"> 5.5
					</label>
					<label class="btn btn-default">
						<input type="radio" name="foot_size" class='foot_size' value="6"> 6
					</label>
					<label class="btn btn-default">
						<input type="radio" name="foot_size" class='foot_size' value="6.5"> 6.5
					</label>
					<label class="btn btn-default">
						<input type="radio" name="foot_size" class='foot_size' value="7"> 7
					</label>
					<label class="btn btn-default">
						<input type="radio" name="foot_size" class='foot_size' value="7.5"> 7.5
					</label>
					<label class="btn btn-default">
						<input type="radio" name="foot_size" class='foot_size' value="cualquier talla calzado"> Cualquiera
					</label>
				</div>
				<ul class="pager">
					<li><a href="/" id="home_estilo_back">Anterior <<</a></li> |
					<li><a id="filter1Continue" href="#">>> Siguiente</a></li>
				</ul>
			</form>

			<script type="text/javascript">
				$(function() {
					$("#filter1Continue").click(function() {
						$budget    = $(".budget:checked").val();
						$size      = $(".size:checked").val();
						$foot_size = $(".foot_size:checked").val();

						if ($budget == '') {
							$budget = '2001';
						}
						if ($size == '') {
							$size = 'cualquier talla';
						}
						if ($foot_size == '') {
							$foot_size = 'cualquier talla calzado';
						}
						var action = "/filter2";

						$("#frmFilter1").attr('action', action)
							.submit();
					});
				});
			</script>
		</div>
	</div>
</div>
<div id="brands" class="row">
	<div class="col-md-12" id="stores_banner">
		<img src="files/stores/logo_aguadecoco_small.jpg" alt="DeCoco"/>
		<img src="files/stores/logo_camellia_small.jpg" alt="Camellia"/>
		<img src="files/stores/logo_mink_small.jpg" alt="Mink"/>
		<img src="files/stores/logo_stylebooth_small.jpg" alt="Stylebooth"/>
		<img src="files/stores/logo_stylebooth_small.jpg" alt="Stylebooth"/>
		<img src="files/stores/logo_stylebooth_small.jpg" alt="Stylebooth"/>
	</div>
</div>
<div class="row" id="footer">
	<div class="content">
		<div><a href="/anunciate">Anunciate</a></div>
		<div class="social">
			<a href="#" target="_blank"><img src="/img/footer_instagram.png" border="0" alt="Stylebooth Instagram"/>
				<a href="#" target="_blank"><img src="/img/footer_facebook.png" border="0" alt="Stylebooth Facebook"/>
					<a href="#" target="_blank"><img src="/img/footer_twitter.png" border="0" alt="Stylebooth Twitter"/>
		</div>
		<div><a href="/contacto">Contacto</a></div>
	</div>
	<div class="content"><img src="/img/footer_stylebooth.png" alt="Stylebooth 2014" border="0"/>
	</div>
</div>
</div>


<!-- Intro Ad -->
<div id="popUpAd" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2>Bienvenida a Stylebooth</h2>
			</div>
			<div class="modal-body">
				<p style="font-weight: bold;">¡Obtén cupones de descuento y Asesoría de Imagen <strong>Gratis</strong>!</p>
				<p style="font-size: 16px; color: #ffffff;">¡Regístrate como usuario!</p>
				<p>
					<button style="background: #F92672; color: #ffffff; border: 0px;" onclick="window.open('/users/register', '_parent')">Regístrate Aqui</button>
				</p>
				<p>¿Ya eres usuario? <a href="/users/login">¡Conéctate!</a></p>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Intro Ad -->

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script>
	(function(a){jQuery.browser.mobile=/android|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(ad|hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|tablet|treo|up\.(browser|link)|vodafone|wap|webos|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);
	if(jQuery.browser.mobile)
	{
		document.getElementById("bannerTop").innerHTML = "";
		document.getElementById("bannerLeft").innerHTML = "";
		document.getElementById("bannerRight").innerHTML = "";
		document.getElementById("bannerBottom").innerHTML = "";
	}
	$(function(){
		$('#popUpAd').modal('show');

		$('#popUpAd').on('hidden.bs.modal', function () {
			$.ajax({
				type: 'post',
				url: '/hasSeenPopUpAd',
				success: function(response){

				}
			});
		})
	});
</script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<!-- analytics -->
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-52868902-1', 'auto');
	ga('send', 'pageview');
</script>
<!-- analytics -->
</body>
</html>