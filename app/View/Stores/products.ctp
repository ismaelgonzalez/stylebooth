<h3><?php echo $store['Store']['name']; ?></h3>
	<?php
		$has_http = strstr($store['Store']['url'], 'http://');
		if (!$has_http) {
			$url = 'http://' . $store['Store']['url'];
		} else {
			$url = $store['Store']['url'];
		}

		if (!empty($store['Store']['redes_sociales'])) {
			$rs_has_http = strstr($store['Store']['redes_sociales'], 'http://');
			if (!$rs_has_http) {
				$redes_sociales = 'http://' . $store['Store']['redes_sociales'];
			} else {
				$redes_sociales = $store['Store']['redes_sociales'];
			}
		} else {
			$redes_sociales = '';
		}

	?>
<div class="row" align="left">
	<div class="col-md-4">
			<span class="thumbnail">
		<img src="/files/stores/<?php echo $store['Store']['image']; ?>" alt="<?php echo $store['Store']['name']; ?>"/>
		<input type="hidden" id="store_id" value="<?php echo $store['Store']['id']; ?>">
		<input type="hidden" id="store_name" value="<?php echo $store['Store']['name']; ?>">
		</span>
	</div>
	<div class="col-md-8" align="left">
		<h5><b><?php echo $store['Store']['name']; ?></b></h5>
		<?php echo $this->element('store_address', array('store_address' => $store['StoreAddress'][0])); ?>
		<h5><a href="<?php echo $url; ?>"  target="_blank"><?php echo $url; ?></a> </h5>
		<?php if (!empty($redes_sociales)) { ?>
		<h6>Redes Sociales:<br><a href="<?php echo $redes_sociales; ?>"  target="_blank"><?php echo $redes_sociales; ?></a></h6>
		<?php } ?>
		<?php echo $store['Store']['google_maps']; ?>
		<br />
	</div>
</div>
<h4><b>Productos de la Tienda</b></h4>
<!-- Single button -->
<div class="row">
	<div class="btn-group">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			<span class="selection"> Todos los Productos </span><span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu">
			<?php echo $this->element('products_category'); ?>
		</ul>
	</div>
</div>
<br />
<div id="productsResults" class="row">
	<?php
	foreach ($products as $p) {
		?>
		<div class="col-md-4">
			<div class="thumbnail products-thumb">
				<a href="/products/detail/<?php echo $p['Product']['id']; ?>"> <img style="min-height:210px;height:210px;" src="/files/products/<?php echo $p['Product']['image']; ?>" alt="<?php echo $p['Product']['name']; ?>"></a>
				<div class="caption">
					<h5><b><?php echo $p['Product']['name']; ?></b></h5>
					<h5><?php echo $store['Store']['name']; ?></h5>
					<h5>$<?php echo $p['Product']['price']; ?></h5>
					<?php echo $this->element('coupons', array('product_id' => $p['Product']['id'])); ?>
				</div>
			</div>
		</div>
		<?php } ?>
</div>
<ul class="pager">
	<li><a href="/filter4">Anterior</a></li>
</ul>
<script type="text/javascript">
	$(function() {
		$(".dropdown-menu li a").click(function(event){
			event.preventDefault();
			$(this).parents(".btn-group").find('.selection').text($(this).text());
			$(this).parents(".btn-group").find('.selection').val($(this).text());
			$text = $(this).text();
			$id = $('#store_id').val();
			console.log($text + ' ' + $id);
			$.ajax({
				type: 'post',
				url: '/products/getProductsByStore/' + $id + '/' + $text,
				success: function(html) {
					filterProducts(html);
				}
			});
		});
	});

	function filterProducts(html) {
		var obj = JSON.parse(html);
		var result = "";
		var name_store = "";
		$name_store = $('#store_name').val();
		for (i=0; i<obj.length; i++) {
			result += '<div class="col-md-4">'
				+ '<div class="thumbnail">'
				+ '<a href="/products/detail/' + obj[i].Product.id + '"> <img style="min-height:210px;height:210px;" src="/files/products/' + obj[i].Product.image + '" alt="' + obj[i].Product.name + '"></a>'
				+ '<div class="caption">'
				+ '<h5><b>' + obj[i].Product.name + '</b></h5>'
				+ '<h5>' + $name_store + '</h5>'
				+ '<h5>$' + obj[i].Product.price + '</h5>';
			if (obj[i].Coupon.length > 0){
				result += '<h5><a href="/products/detail/' + obj[i].Product.id + '">Ve Por Tu Cupon!</a></h5>';
			}
			result += '</div>'
				+ '</div>'
				+ '</div>';
		}

		$('#productsResults').empty()
			.append(result);
	}
</script>