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
<!--<div id="container">
	<div id="header">
		show navbar here
	</div>
	<div id="content">
		<?php //echo $this->Session->flash(); ?>

		<?php //echo $this->fetch('content'); ?>
	</div>
	<div id="footer">
		footer stuff here
	</div>
</div>    -->
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
			<a class="navbar-brand" href="#">Stylebooth</a>
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
				<li class="active"><a href="#">Dashboard</a></li>
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
			<?php echo $this->fetch('content'); ?>
			<h1 class="page-header">Dashboard</h1>

			<div class="row placeholders">

			</div>

			<h2 class="sub-header">Section title</h2>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
					<tr>
						<th>#</th>
						<th>Header</th>
						<th>Header</th>
						<th>Header</th>
						<th>Header</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>1,001</td>
						<td>Lorem</td>
						<td>ipsum</td>
						<td>dolor</td>
						<td>sit</td>
					</tr>
					<tr>
						<td>1,002</td>
						<td>amet</td>
						<td>consectetur</td>
						<td>adipiscing</td>
						<td>elit</td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- CONTENT -->
	</div>
</div>
</body>
</html>
