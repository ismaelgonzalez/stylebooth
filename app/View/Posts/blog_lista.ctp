<h1>Stylebooth Blog</h1>
<div class="row" align="left">
	<div class="col-md-9">
		<?php if (!empty($main['Post']['image'])) { ?>
		<span class="thumbnail">
			<img src="/files/posts/<?php echo $main['Post']['image']; ?>" alt="<?php echo $main['Post']['title']; ?>"/>
		</span>
		<?php } ?>
		<h3><?php echo $main['Post']['title']; ?></h3>
		<h6><?php echo date('d M, Y', strtotime($main['Post']['post_date'])); ?></h6>
		<h5><?php echo $main['Post']['post']; ?></h5>

		<br />
		<h4>Comentarios:</h4>
		<?php if (!empty($logged_user)) { ?>
		<div class="row" style="margin-bottom: 15px;">
			<form id="frmPostComment" role="form" method="post">
				<div class="media" align="left">
					<a class="pull-left thumbnail col-sm-2" href="#">
						<?php if (!empty($logged_user['image'])) { ?>
						<img class="media-object" src="/files/users/<?php echo $logged_user['image']; ?>" alt="<?php echo $logged_user['first_name'] . ' ' . $logged_user['last_name']; ?>">
						<?php } else { ?>
						<img class="media-object" src="/files/users/user.jpg" alt="...">
						<?php } ?>
					</a>
					<div class="media-body">
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
			<div class="media" align="left">
				<a class="pull-left thumbnail col-sm-2" href="#">
					<?php echo $this->element('user_name', array('get_image' => true, 'id' => $c['user_id'])); ?>
				</a>
				<div class="media-body">
					<h5 class="media-heading">
						<?php echo $this->element('user_name', array('get_full_name' => true, 'id' => $c['user_id'])); ?>
						 - <?php echo date('d M, Y', strtotime($c['comment_date'])); ?></h5>
					<h6><?php echo $c['comment']; ?></h6>
					<?php if ($logged_user['role'] == 'admin') { ?>
					<p><a href="#row_comments" onclick="delComment(<?php echo $c['id'] . ',' . $main['Post']['id']; ?>)"><small>Borrar Comentario</small></a></p>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="col-md-3" align="left">
		Ultimas Publicaciones:
		<?php foreach($posts as $p) { ?>
		<br /><br /><a href="/blogs/lista/<?php echo $p['Post']['id']; ?>"><?php echo $p['Post']['title']; ?></a>
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
				result += '<div class="media" align="left">'
					+ '<a class="pull-left thumbnail col-sm-2" href="#">';
				if (obj[i].User.image != null) {
					result += '<img class="media-object" src="/files/users/' + obj[i].User.image + '" alt="usuario de stylebooth">'
				} else {
					result += '<img class="media-object" src="/files/users/user.jpg" alt="usuario anonimo de stylebooth">'
				}
				result += '</a>'
					+ '<div class="media-body">'
					+ '<h5 class="media-heading">' + obj[i].User.first_name + ' ' + obj[i].User.last_name + ' - ' + $comment_date.ddmmyyyy() + '</h5>'
					+ '<h6 >' + obj[i].PostComment.comment + '</h6>'
					<?php if ($logged_user['role'] == 'admin') { ?>
					+ '<p><a href="#row_comments" onclick="delComment(' + obj[i].PostComment.id + ',' + obj[i].PostComment.post_id + ')"><small>Borrar Comentario</small></a></p>'
					<?php } ?>
					+ '</div>'
					+ '</div>';
			}

			$('#PostCommentComment').val('');

			$comments_div
				.empty()
				.fadeIn('slow')
				.append(result);
		}
	</script>