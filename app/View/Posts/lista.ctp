<div class="row">
	<h1><?php echo $title_for_layout; ?></h1>
	<div class="col-md-10">
		<?php foreach ($posts as $p) { ?>
		<div class="media" align="left">
			<a class="pull-left" href="/noticias/post/<?php echo $p['Post']['id']; ?>">
				<?php if ( !empty($p['Post']['image']) ) { ?>
				<img class="media-object" src="/files/posts/<?php echo $p['Post']['image']; ?>" alt="<?php echo $p['Post']['title']; ?>" width="150">
				<?php } else { ?>
				<img class="media-object" src="/files/posts/news.jpg" alt="..." width="150">
				<?php } ?>

			</a>
			<div class="media-body">
				<h4 class="media-heading"><?php echo $p['Post']['title']; ?>. <?php echo date('d M, Y', strtotime($p['Post']['post_date'])); ?></h4>
				<?php echo $p['Post']['blurb']; ?>...
				<a href="/noticias/post/<?php echo $p['Post']['id']; ?>">Leer mas</a>
			</div>
		</div>
		<br />
		<?php } ?>
		<?php echo $this->paginator->numbers(); ?>
	</div>
	<div class="col-md-2" align="left">
		Notas mas leidas:
		<?php foreach ($top3 as $t3) { ?>
		<br /><br /><a href="/noticias/post/<?php echo $t3['Post']['id']; ?>"><?php echo $t3['Post']['title']; ?></a>
		<?php } ?>
	</div>
</div>
