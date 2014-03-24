<?php
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

	//echo $this->Html->css('cake.generic');
	echo $this->Html->css('bootstrap.min');
	echo $this->Html->css('bootstrap-theme.min');
	echo $this->Html->css('jquery-ui-1.10.4.custom.min');
	echo $this->Html->css('admin');

	echo $this->Html->script('jquery-1.11.0.min');
	echo $this->Html->script('jquery-ui-1.10.4.custom.min');
	echo $this->Html->script('bootstrap.min');

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>
<body>
<!-- HEADER -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/admin">Stylebooth Admin</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/">Volver a Stylebooth</a></li>
				<li><a href="/admin">Dashboard</a></li>
				<li><a href="/users/edit/<?php echo $logged_user['id']; ?>">Hola <?php echo $logged_user['first_name'] . ' ' . $logged_user['last_name']; ?></a></li>
				<li><a href="/users/logout">Salir</a></li>
			</ul>
		</div>
	</div>
</div>
<!-- HEADER -->

<div class="container-fluid">
	<div class="row">
		<!-- SIDEBAR -->
		<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li <?php if ($this->params['controller'] == 'stylebooth') { echo "class='active'"; } ?>><a href="/stylebooth/dashboard">Dashboard</a></li>
				<li <?php if ($this->params['controller'] == 'banners') { echo "class='active'"; } ?>><a href="/banners">Banners</a></li>
				<li <?php if ($this->params['controller'] == 'coupons') { echo "class='active'"; } ?>><a href="/coupons">Cupones</a></li>
				<li <?php if ($this->params['controller'] == 'outfits') { echo "class='active'"; } ?>><a href="/outfits">Outfits</a></li>
				<li <?php if ($this->params['controller'] == 'posts' && lcfirst($type) == 'b') { echo "class='active'"; } ?>><a href="/blogs/index/b">Blogs</a></li>
				<li <?php if ($this->params['controller'] == 'posts' && lcfirst($type) == 'n') { echo "class='active'"; } ?>><a href="/noticias/index/n">Noticias</a></li>
				<li <?php if ($this->params['controller'] == 'products') { echo "class='active'"; } ?>><a href="/products">Productos</a></li>
				<li <?php if ($this->params['controller'] == 'stores') { echo "class='active'"; } ?>><a href="/stores">Tiendas</a></li>
				<li <?php if ($this->params['controller'] == 'users') { echo "class='active'"; } ?>><a href="/users">Usuarios</a></li>
			</ul>
		</div>
		<!-- SIDEBAR -->

		<!-- CONTENT -->
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<?php echo $this->Session->flash('auth'); ?>
			<?php echo $this->Session->flash(); ?>
			<h1 class="page-header"><?php echo $pageHeader; ?></h1>

			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $sectionTitle; ?>
				</div>
				<div class="panel-body">
					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
		</div>
		<!-- CONTENT -->
	</div>
</div>
</body>
</html>
