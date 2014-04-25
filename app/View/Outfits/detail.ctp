<h3><?php echo $outfit['Outfit']['name']; ?></h3>
<div class="row" >
	<div class="col-md-4 col-md-offset-4">
		<div class="thumbnail">
			<img style="min-height:350px;height:350px;" src="/files/outfits/<?php echo $outfit['Outfit']['image']; ?>" alt="<?php echo $outfit['Outfit']['name']; ?>"></a>
			<div class="caption">
				<h5><b><?php echo $outfit['Outfit']['name']; ?>: <?php echo $this->element('outfit_price', array('id' => $outfit['Outfit']['id'])); ?> MXN</b></h5>
			</div>
		</div>
	</div>
	<input type="hidden" id="outfitID" value="<?php echo $outfit['Outfit']['id']; ?>">
</div>
<h4><b>Productos del Outfit</b></h4>
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
	foreach ($outfit['Product'] as $p) {
		?>
		<div class="col-md-4">
			<div class="thumbnail">
				<a href="/products/detail/<?php echo $p['id']; ?>"> <img style="min-height:210px;height:210px;" src="/files/products/<?php echo $p['image']; ?>" alt="<?php echo $p['name']; ?>"></a>
				<div class="caption">
					<h5><b><?php echo $p['name']; ?></b></h5>
					<h5><?php echo $this->element('store_address', array('get_store_name' => true, 'store_id' => $p['store_id'])); ?></h5>
					<h5>$<?php echo $p['price']; ?></h5>
					<?php echo $this->element('coupons', array('product_id' => $p['id'])); ?>
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
				+ '<h5>$' + obj.Product[i].price + '</h5>';
			if (obj.Product[i].Coupon.length > 0){
				result += '<h5><a href="/products/detail/' + obj.Product[i].id + '">Ve Por Tu Cupon!</a></h5>';
			}
			result += '</div>'
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