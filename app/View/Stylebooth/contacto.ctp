<div class="row">
	<div class="row titles">
		<h1>CONTACTO</h1>
	</div>
</div>
<div class="row site_txts">
	<div class="col-md-9" align="center">
		<div id="bannerTop"></div>
		<div class="row">
			<p style="text-align: justify">
				Si tienes alguna sugerencia, duda o queja, no dudes en enviarnos tus comentarios.
			</p>
			<form action="/contacto" class="form-horizontal" role="form" id="StyleboothContactoForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				<div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>
				<div class="form-group form-name">
					<div class="col-lg-12 ">
						<input name="data[Stylebooth][nombre]" class="form-control" type="text" id="StyleboothNombre" placeholder="Nombre"/>
					</div>
				</div>
				<div class="form-group form-email">
					<div class="col-lg-12">
						<input name="data[Stylebooth][email]" class="form-control" type="email" id="StyleboothEmail" placeholder="E-mail"/>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-12">
						<input name="data[Stylebooth][subject]" class="form-control" type="email" id="StyleboothSubject" placeholder="Tema"/>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-12">
						<textarea name="data[Stylebooth][comentarios]" class="form-control" cols="30" rows="6" id="StyleboothComentarios" placeholder="Comentarios"></textarea>
					</div>
				</div><br/>
				<div class="submit contact_btn">
					<input  formnovalidate="formnovalidate" class="btn btn-warning pull-left" type="submit" value="Enviar"/>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>