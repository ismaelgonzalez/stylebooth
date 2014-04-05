<h3><?php echo $store['Store']['name']; ?></h3>
<div class="row" align="left">
	<div class="col-md-4">
			  <span class="thumbnail">
		  <img src="/files/stores/<?php echo $store['Store']['image']; ?>" alt="<?php echo $store['Store']['name']; ?>"/>
		</span>
	</div>
	<div class="col-md-8" align="left">
		<h5><b><?php echo $store['Store']['name']; ?></b></h5>
		<?php echo $this->element('store_address', array('store_address' => $store['StoreAddress'][0])); ?>
		<a href="<?php echo $store['Store']['url']; ?>"  target="_blank"><?php echo $store['Store']['url']; ?></a> </h5>
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
			<li><a href="#">Todos los Productos</a></li>
			<li><a href="#">Solo Accesorios</a></li>
			<li><a href="#">Solo Calzado</a></li>
		</ul>
	</div>
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
					<h5><?php echo $store['Store']['name']; ?></h5>
					<h5>$<?php echo $p['Product']['price']; ?></h5>
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
			$id = $('#outfitID').val();
			$.ajax({
				type: 'post',
				url: '/products/getProductsByOutfit/' + $id + '/' + $text,
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
		for (i=0; i<obj.Product.length; i++) {
			name_store = $.getStoreName('/stores/getStoreName/' + obj.Product[i].store_id);
			result += '<div class="col-md-4">'
				+ '<div class="thumbnail">'
				+ '<a href="/products/detail/' + obj.Product[i].id + '"> <img style="min-height:210px;height:210px;" src="/files/products/' + obj.Product[i].image + '" alt="' + obj.Product[i].name + '"></a>'
				+ '<div class="caption">'
				+ '<h5><b>' + obj.Product[i].name + '</b></h5>'
				+ '<h5>' + name_store + '</h5>'
				+ '<h5>$' + obj.Product[i].price + '</h5>'
				+ '</div>'
				+ '</div>'
				+ '</div>';
		}

		$('#productsResults').empty()
			.append(result);
	}

	jQuery.extend({
		getStoreName: function(url) {
			var result = null;
			$.ajax({
				url: url,
				type: 'get',
				async: false,
				success: function(data) {
					result = data;
				}
			});
			return result;
		}
	});
</script>