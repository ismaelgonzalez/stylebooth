<h1>Noticias</h1>
<div class="media" align="left">
	<?php if (!empty($noticia['Post']['image'])) { ?>
	<div class="thumbnail">
		<img class="media-object" src="/files/posts/<?php echo $noticia['Post']['image']; ?>" alt="<?php echo $noticia['Post']['title']; ?>" height="300">
	</div>
	<?php } ?>
	<div class="media-body">
		<h4 class="media-heading"><?php echo $noticia['Post']['title']; ?>. <?php echo date('d M, Y', strtotime($noticia['Post']['post_date'])); ?></h4>
		<blockquote>
			<p>
				<?php echo $noticia['Post']['blurb']; ?>
			</p>
		</blockquote>
		<?php echo $noticia['Post']['post']; ?>
	</div>
</div>
<ul class="pager">
	<li><a href="/noticias/lista">Regresar</a></li>
</ul>