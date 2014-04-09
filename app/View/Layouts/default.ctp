<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Stylebooth');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('jquery-ui-1.10.4.custom.min');
		echo $this->Html->css('stylebooth');

		echo $this->Html->script('jquery-1.11.0.min');
		echo $this->Html->script('jquery-ui-1.10.4.custom.min');
		echo $this->Html->script('bootstrap.min');

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
				<li><a href="/noticias/lista/">Noticias</a></li>
				<li><a href="/blogs/lista/">Blog</a></li>
				<li><a href="/stores/lista">Tiendas</a></li>
			</ul>
			<?php if (!empty($logged_user['id'])) { ?>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="/users/profile/<?php echo $logged_user['id']; ?>">Hola <?php echo $logged_user['first_name'] . ' ' . $logged_user['last_name']; ?></a>
					</li>
					<?php if ($logged_user['role'] == 'admin') { ?>
					<li><a href="/admin">Ir al Admin</a></li>
					<?php } ?>
					<li>
						<a href="/users/logout">Salir</a>
					</li>
				</ul>
			<?php } else { ?>
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
					¿No tiene cuenta? <a href="/users/register">Regístrese</a>
					<br />Entrar con faceook <div class="fb-login-button" data-max-rows="1" data-size="icon" data-show-faces="false" data-auto-logout-link="false"></div>
				</div>
			</form>
			<?php } ?>
		</div><!--/.nav-collapse -->
	</div>
</div>

<div class="container" style="background-color: #FFFFFF;">
	<div class="row">
		<div id="bannerLeft" class="col-md-2"><br /><?php echo $this->element('banner', array('type' => 'L')); ?></div>
		<div class="col-md-8" align="center">
			<div id="bannerTop"><?php echo $this->element('banner', array('type' => 'U')); ?></div>
			<div class="row">
				<p><?php echo $this->Session->flash(); ?></p>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		<div class="col-md-2"  id="banner2" ><br /><div id="bannerRight"><?php echo $this->element('banner', array('type' => 'R')); ?></div>
		</div>
	</div>
	<div class="container" style="background-color: #FFFFFF;">
		<div class="row" align="center">
			<div class="col-md-12">
				<div id="bannerBottom"><?php echo $this->element('banner', array('type' => 'D')); ?></div>
				<h5><a href="#">Nosotros</a> &nbsp;&nbsp; <a href="#">Misión</a> &nbsp;&nbsp;<a href="#">Anunciate</a> &nbsp;&nbsp;<a href="#">Contacto</a></h5>
				<h6>Stylebooth <?php echo date('Y'); ?></h6>
			</div>
		</div>
	</div>
	<!-- Facebooklogin thing -->
	<div id="fb-root"></div>
	<script type="text/javascript">
		(function(a){jQuery.browser.mobile=/android|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(ad|hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|tablet|treo|up\.(browser|link)|vodafone|wap|webos|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);
		if(jQuery.browser.mobile)
		{
			document.getElementById("bannerTop").innerHTML = "";
			document.getElementById("banner2").innerHTML = "";
			document.getElementById("bannerLeft").innerHTML = "";
			document.getElementById("bannerBottom").innerHTML = "";
		}
	</script>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=1420689908181928";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<!-- end facebook login -->
</body>
</html>
