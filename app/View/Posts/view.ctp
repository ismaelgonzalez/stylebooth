<div class="row titles">
	<h1>BLOG</h1>
</div>
<div class="row blog">
	<div class="col-md-12" align="center">
		<div class="row">
			<div class="row" align="left">
				<div class="col-md-9">
					<h3><?php echo $main['Post']['title']; ?></h3>
					<p>
					<div class="datos"><img src="/img/blog_date.png" alt="Fecha"><?php echo date('d M, Y', strtotime($main['Post']['post_date'])); ?></div>
					<div class="datos"><img src="/img//blog_views.png" alt="Views"> <?php echo $main['Post']['num_views']; ?> vistas</div>
					<div class="datos"><a href="#comentarios"><img src="/img/blog_comments.png" alt="Comments"> <?php echo sizeof($main['PostComment']); ?> comentarios</a></div>

					<?php if (!empty($main['Post']['image'])) { ?>
						<p class="img">
							<img  class="col-md-12 toggle_inline_image inline_image constrained_image" src="/files/posts/<?php echo $main['Post']['image']; ?>" alt="<?php echo $main['Post']['title']; ?>"/>
						</p>
					<?php } ?>

					<?php echo $main['Post']['post']; ?>

					<a id="comentarios"></a>
					<h3>Comentarios:</h3>
					<?php if (!empty($logged_user)) { ?>
						<div class="row" style="margin-bottom: 15px;">
							<form id="frmPostComment" role="form" method="post">
								<div class="form-group">
									<div class="col-md-2">
										<?php if (!empty($logged_user['image'])) { ?>
											<img class="img-thumbnail" src="/files/users/<?php echo $logged_user['image']; ?>" alt="<?php echo $logged_user['first_name'] . ' ' . $logged_user['last_name']; ?>">
										<?php } else { ?>
											<img class="img-thumbnail" src="/files/users/user.jpg" alt="...">
										<?php } ?>
									</div>
									<div class="col-md-10">
										<h5 class="media-heading"><textarea class="form-control" placeholder="text" name="data[PostComment][comment]" id="PostCommentComment"></textarea> </h5>
										<input type="hidden" name="data[PostComment][post_id]" id="PostCommentPostId" value="<?php echo $main['Post']['id']; ?>">
										<input type="hidden" name="data[PostComment][user_id]" id="PostCommentUserId" value="<?php echo $logged_user['id']; ?>">
										<button id="btnAddComment" type="button" class="btn btn-default">Comentar</button>
									</div>
								</div>
							</form>
						</div>
					<?php } ?>
					<div class="row comments">
						<?php foreach ($main['PostComment'] as $c) { ?>
							<div class="row">
								<div class="col-md-2">
									<?php echo $this->element('user_name', array('get_image' => true, 'id' => $c['user_id'])); ?>
								</div>
								<div class="col-md-10">
									<h5 class="media-heading">
										<small>
											<?php echo $this->element('user_name', array('get_full_name' => true, 'id' => $c['user_id'])); ?>
											- <?php echo date('d M, Y', strtotime($c['comment_date'])); ?>
										</small>
									</h5>
									<h6><?php echo $c['comment']; ?></h6>
									<?php if ($logged_user['role'] == 'admin') { ?>
										<p><a class="btn btn-danger link-button" href="#row_comments" onclick="delComment(<?php echo $c['id'] . ',' . $main['Post']['id']; ?>)">Borrar Comentario <i class="icon-trash icon-large"></i></a></p>
									<?php } ?>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-3" align="left">
					<div class="blog_right">
						<a href="/users/register"><img src="/img/banner_registrate.jpg" alt="¡Regístrate!" border="0" /></a>
						<h5>Ultimas Publicaciones:</h5>
						<?php foreach($posts as $p) { ?>
							<p><a href="/blogdemoda/<?php echo $p['Post']['id']; ?>/<?php echo $p['Post']['slug']; ?>"><?php echo $p['Post']['title']; ?></a></p>
						<?php } ?>

						<ul class="pager" style="font-size: 10px;">
							<?php
							if ($this->Paginator->hasPrev()) {
								echo $this->Paginator->prev(__('Anterior'), array('tag' => 'li'));
							}
							if ($this->Paginator->hasNext()) {
								echo $this->Paginator->Next(__('Siguiente'), array('tag' => 'li'));
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('#btnAddComment').click(function(){
			var $user_id      = $('#PostCommentUserId').val();
			var $post_id      = $('#PostCommentPostId').val();
			var $comment      = $('#PostCommentComment').val();

			if ($comment == ''){
				alert('Necesitas escribir un comentario antes de dar click en comentar.');
				return false;
			}

			$.ajax({
				type: 'post',
				url: '/posts/addComment',
				data: 'user_id=' + $user_id + "&post_id=" + $post_id + "&comment=" + $comment,
				success: function(html) {
					setComments(html);
				}
			})

		});
	});

	Date.prototype.ddmmyyyy = function() {
		var yyyy = this.getFullYear().toString();
		var mm = (this.getMonth()+1).toString();
		var dd = this.getDate().toString();

		return (dd[1]?dd:"0"+dd[0]) + "-" + (mm[1]?mm:"0"+mm[0]) + yyyy;
	}

	function delComment(comment_id, post_id){
		$.ajax({
			type: 'post',
			url: '/posts/delComment/' + comment_id + '/' + post_id,
			success: function(html) {
				setComments(html);
			}
		});
	}

	function setComments(json){
		var obj = JSON.parse(json);
		var result = '';
		var $comments_div = $('.comments');

		for (i=0; i<obj.length; i++) {
			var $comment_date = new Date(obj[i].PostComment.comment_date);
			result += '<div class="row">'
			+ '<div class="col-md-2">';
			if (obj[i].User.image != null) {
				result += '<img class="img-thumbnail" src="/files/users/' + obj[i].User.image + '" alt="usuario de stylebooth">';
			} else {
				result += '<img class="img-thumbnail" src="/files/users/user.jpg" alt="usuario anonimo de stylebooth">';
			}
			result += '</div>'
			+ '<div class="col-md-10">'
			+ '<h5 class="media-heading">'
			+ '<small>'
			+ obj[i].User.first_name + ' ' + obj[i].User.last_name + ' - ' + $comment_date.ddmmyyyy()
			+ '</small>'
			+ '</h5>'
			+ '<h6>' + obj[i].PostComment.comment + '</h6>'
			<?php if ($logged_user['role'] == 'admin') { ?>
			+ '<p><a class="btn btn-danger link-button" href="#row_comments" onclick="delComment(' + obj[i].PostComment.id + ',' + obj[i].PostComment.post_id + ')">Borrar Comentario <i class="icon-trash icon-large"></i></a></p>'
			<?php } ?>
			+ '</div>'
			+ '</div>'
		}

		$('#PostCommentComment').val('');

		$comments_div
			.empty()
			.fadeIn('slow')
			.append(result);
	}
</script>