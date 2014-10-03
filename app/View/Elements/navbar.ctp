<div class="navbar navbar-inverse navbar-default" role="navigation" style="margin-bottom: 0;">
	<div class="container container_header">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/"><img src="/img/stylebooth_logo.png" alt="Stylebooth"/></a>
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