<div class="row blog">
	<div class="col-md-12" align="center">
		<div class="row titles">
			<h1>BLOG</h1>
		</div>
		<div class="row" align="left">
			<div class="col-md-9">
				<?php foreach ($posts as $p) { ?>
				<div class="col-md-12 blog-preview">
					<div class="col-md-12 row">
						<h3><?php echo $p['Post']['title']; ?></h3>
						<div class="datos"><img src="/img/blog_date.png" alt="Fecha"><?php echo date('d M, Y', strtotime($p['Post']['post_date'])); ?></div>
						<div class="datos"><img src="/img//blog_views.png" alt="Views"> <?php echo $p['Post']['num_views']; ?> vistas</div>
						<div class="datos"><a href="/blogs/view/<?php echo $p['Post']['id']; ?>#comentarios"><img src="/img/blog_comments.png" alt="Comments"> <?php echo sizeof($p['PostComment']); ?> comentarios</a></div>
					</div>
					<div class="col-md-5 blog_img_thumb">
						<?php if ( !empty($p['Post']['image']) ) { ?>
						<img src="/files/posts/<?php echo $p['Post']['image']; ?>" alt="<?php echo $p['Post']['title']; ?>">
						<?php } else { ?>
						<img src="/files/posts/stylebooth-logo-blog.jpg" alt="<?php echo $p['Post']['title']; ?>">
						<?php } ?>
					</div>
					<div class="col-md-7">
						<p><?php echo $p['Post']['blurb']; ?></p>
						<a href="/blogs/view/<?php echo $p['Post']['id']; ?>" class="blog-mas">Leer más</a>
					</div>
				</div>
				<?php } ?>
				<div class="paging">
				<?php
					echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
					echo $this->Paginator->numbers(array('separator' => ''));
					echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
				?>
				</div>
			</div>
			<div class="col-md-3" align="left">
				<div class="blog_right">
					<a href="/users/register"><img src="/img/banner_registrate.jpg" alt="¡Regístrate!" border="0" /></a>
					<h5>Ultimas Publicaciones:</h5>
					<?php foreach ($posts as $p) { ?>
					<p><a href="/blogs/view/<?php echo $p['Post']['id']; ?>"><?php echo $p['Post']['title']; ?></a></p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>