<h3><?php echo $style['Style']['name']; ?></h3>
<h4><b>Sugerencias de Outfits</b></h4>
<div class="row" >
	<?php
	if (empty($outfits)) {
		echo "<div class='row'>No hay outfits con estas características</div> ";
	} else {
	foreach ($outfits as $o) { ?>
	<div class="col-md-4">
		<div class="thumbnail">
			<a href="/outfits/detail/<?php echo $o['Outfit']['id']; ?>"> <img style="min-height:286px;height:286px;" src="/files/outfits/<?php echo $o['Outfit']['image']; ?>" alt="<?php echo $o['Outfit']['name']; ?>"></a>
			<div class="caption">
				<h5><b><?php echo $o['Outfit']['name']; ?>: <?php echo $this->element('outfit_price', array('id' => $o['Outfit']['id'])); ?> MXN</b></h5>
			</div>
		</div>
	</div>
	<?php } } ?>
</div>
<h4><b>Resultados de Productos</b></h4>
	<?php echo $this->Breadcrumbs->getBreadcrumbs($style['Style']['name'], $this->Session->read('Visit.budget'), $this->Session->read('Visit.size'), $this->Session->read('Visit.foot_size'), $skin['SkinHairType']['name'], $body['BodyType']['name']); ?>
<!-- Single button -->
<div class="btn-group">
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
		<span class="selection"> Todos los Productos </span><span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu">
		<li><a href="#">Todos los Productos</a></li>
		<li><a href="#">Solo Accesorios</a></li>
		<li><a href="#">Solo Calzado</a></li>
	</ul>
</div>
<br />
<div id="productsResults" class="row">
	<?php
	foreach ($products as $p) {
	?>
	<div class="col-md-4">
		<div class="thumbnail">
			<a href="/products/detail/<?php echo $p['Product']['id']; ?>"> <img style="min-height:210px;height:210px;" src="/files/products/<?php echo $p['Product']['image']; ?>" alt="<?php echo $p['Product']['name']; ?>"></a>
			<div class="caption">
				<h5><b><?php echo $p['Product']['name']; ?></b></h5>
				<h5><?php echo $p['Store']['name']; ?></h5>
				<h5>$<?php echo $p['Product']['price']; ?></h5>
			</div>
		</div>
	</div>
	<?php } ?>
</div>
<ul class="pager">
	<li><a href="/filter3">Anterior</a></li>
</ul>
	<script type="text/javascript">
		$(function() {
			$(".dropdown-menu li a").click(function(event){
				event.preventDefault();
				$(this).parents(".btn-group").find('.selection').text($(this).text());
				$(this).parents(".btn-group").find('.selection').val($(this).text());
				$text = $(this).text();
				$.ajax({
					type: 'post',
					url: '/products/getProductsByFilter/' + $text,
					success: function(html) {
						filterProducts(html);
					}
				});
			});
		});

		function filterProducts(html) {
			var obj = JSON.parse(html);
			var result = "";
			for (i=0; i<obj.length; i++) {
				result += '<div class="col-md-4">'
					+ '<div class="thumbnail">'
					+ '<a href="/products/detail/' + obj[i].Product.id + '"> <img style="min-height:210px;height:210px;" src="/files/products/' + obj[i].Product.image + '" alt="' + obj[i].Product.name + '"></a>'
					+ '<div class="caption">'
					+ '<h5><b>' + obj[i].Product.name + '</b></h5>'
					+ '<h5>' + obj[i].Store.name + '</h5>'
					+ '<h5>$' + obj[i].Product.price + '</h5>'
					+ '</div>'
					+ '</div>'
					+ '</div>';
			}

			$('#productsResults').empty()
				.append(result);
		}
	</script>