<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
	echo $this->Html->meta('icon');
	echo $this->Html->css('bootstrap.min');
	echo $this->Html->css('bootstrap-theme.min');
	echo $this->Html->css('jquery-ui-1.10.4.custom.min');
	echo $this->Html->css('stylebooth');

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
	<link href='http://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
	<link rel='icon' href='favicon.ico'>
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>
<body>
<div class="navbar navbar-inverse navbar-default" role="navigation" style=" margin-bottom: 0;">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/" style="height: 95px;"><img src="/stylebooth.png"  /></a>
		</div>
		<div class="navbar-collapse collapse" >
			<ul class="nav navbar-nav" >
				<li  ><br /><br /><a href="/noticias/lista/n">Noticias</a></li>
				<li><br /><br /><a href="/blogs/lista/b">Blog</a></li>
				<li><br /><br /><a href="/stores/lista">Tiendas</a></li>
			</ul>
			<form class="navbar-form navbar-right" role="form" action="/users/login" id="UserLoginForm" method="post">
				<br /><br />
				<div class="form-group">
					<input placeholder="Email" class="form-control" style="font-size: 10px;" size="15" name="data[User][email]" type="email" id="UserEmail" required="required">
				</div>
				<div class="form-group">
					<input type="password" placeholder="Password" class="form-control" style="font-size: 10px;" size="15" name="data[User][password]" id="UserPassword" required="required">
				</div>
				<button type="submit" class="btn" style="font-size: 10px;">Sign in</button>
				<div class="form-group" style="color: #FFFFFF; font-size: 10px;" >
					¿No tiene cuenta? <a href="#">Regístrese</a>
					<br />Entrar con faceook <div class="fb-login-button" data-max-rows="1" data-size="icon" data-show-faces="false" data-auto-logout-link="false"></div>
				</div>
			</form>
		</div><!--/.nav-collapse -->
	</div>
</div>

<div class="container" style="background-color: #FFFFFF;">
	<div class="row">
		<div id="bannerLeft" class="col-md-2"><br /><?php $this->Banner->getBanner($bannerLeft); ?></div>
		<div class="col-md-8" align="center">
			<div id="bannerTop"><?php $this->Banner->getBanner($bannerTop); ?></div>
			<div class="row">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		<div class="col-md-2"  id="banner2" >
			<br /><br /><br /><br /><br /><br /><br /><br /><br />
			<a href="#" style="text-decoration: underline; font-size: 14px;">
				Registrate aqui para obtener cupones de descuentos en los resultados de tus productos</a>
			<br /><br /> O Entra con faceook
			<div class="fb-login-button" data-max-rows="1" data-size="icon" data-show-faces="false" data-auto-logout-link="false"></div>
			<br /><br />
		</div>
		</div>
	</div>
	<div class="container" style="background-color: #FFFFFF;">
		<div class="row" align="center">
			<div class="col-md-12">
				<div id="bannerBottom"><?php $this->Banner->getBanner($bannerDown); ?></div>
				<h5><a href="#">Nosotros</a> &nbsp;&nbsp; <a href="#">Misión</a> &nbsp;&nbsp;<a href="#">Anunciate</a> &nbsp;&nbsp;<a href="#">Contacto</a></h5>
				<h6>Stylebooth <?php echo date('Y'); ?></h6>
			</div>
		</div>
	</div>
	<?php
	echo $this->Html->script('jquery-1.11.0.min');
	echo $this->Html->script('jquery-ui-1.10.4.custom.min');
	echo $this->Html->script('bootstrap.min');
	?>
	<!-- Facebooklogin thing -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=217858254898594";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<!-- end facebook login -->
</body>
</html>
