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
			<a class="navbar-brand" href="/">Stylebooth Admin</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">Dashboard</a></li>
				<li><a href="#">Profile</a></li>
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
				<li class="active"><a href="/">Dashboard</a></li>
				<li><a href="/banners">Banners</a></li>
				<li><a href="#">Cupones</a></li>
				<li><a href="#">Outfits</a></li>
				<li><a href="#">Blogs</a></li>
				<li><a href="#">Noticias</a></li>
				<li><a href="#">Productos</a></li>
				<li><a href="#">Tiendas</a></li>
				<li><a href="#">Usuarios</a></li>
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
