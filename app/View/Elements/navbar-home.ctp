<div class="navbar navbar-inverse navbar-default" role="navigation">
	<div class="container container_header">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="navbar-brand"><a href="/"><img src="/img/stylebooth_logo.png" alt="Stylebooth" style="position:inherit; z-index:9999; margin-top:0; margin-left:inherit;"></a></div>
		</div>
		<div class="navbar-collapse collapse" >
			<ul class="nav navbar-nav" >
				<li><a href="/blogdemoda">BLOG</a></li>
				<li><a href="/tiendasderopa">TIENDAS</a></li>
				<li><a href="/productosyaccesoriosdemoda" id="header_btngaleria">GALERÍA</a></li>
				<?php if (isset($logged_user)) { ?>
					<li><a href="/mi_booth/<?php echo $logged_user["id"]; ?>">MI BOOTH</a></li>
				<?php } else { ?>
					<li><a id="signin_btn">SIGN IN</a></li>
				<?php } ?>
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