
<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th>ID</th>
			<th>Usuario</th>
			<th>Estilo</th>
			<th>Talla</th>
			<th>Talla de Calzado</th>
			<th>Presupuesto</th>
			<th>Tez y Cabello</th>
			<th>Cuerpo</th>
			<th>Dirección IP</th>
			<th>Fecha</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($stats as $s) { ?>
		<tr>
			<td><?php echo $s['UserStat']['id']; ?></td>
			<td>
				<?php
					if ($s['UserStat']['user_id'] == 0) {
						echo 'Anonimo';
					} else {
						echo $s['User']['first_name'] . ' ' . $s['User']['last_name'];
					}
				?>
			</td>
			<td><?php echo $s['Style']['name']; ?></td>
			<td><?php echo ucwords(str_replace('_', ' ', $s['UserStat']['product_size'])); ?></td>
			<td><?php echo ucwords($s['UserStat']['product_foot_size']); ?></td>
			<td><?php
				$budget = '';
				if (!strstr($s['UserStat']['product_budget'], 'cualquier')) {
					if (strstr($s['UserStat']['product_budget'], 'menos')) {
						$budget = "Menos de $500";
					} elseif (strstr($s['UserStat']['product_budget'], 'mas')) {
						$budget = "Mas de $2000";
					} else {
						$values = split("_", $s['UserStat']['product_budget']);
						$budget = "Entre $" . $values[0] . " a $". $values[1];
					}
				} else {
					$budget = 'Cualquier Presupuesto';
				}
				echo $budget;
				?>
			</td>
			<td><?php echo $s['SkinHairType']['name']; ?></td>
			<td><?php echo $s['BodyType']['name']; ?></td>
			<td><?php echo $s['UserStat']['ip_address']; ?></td>
			<td><?php echo date('d / M / Y', strtotime($s['UserStat']['stat_date'])); ?></td>
		</tr>
			<?php } ?>
		</tbody>
		<tfoot>
		<tr>
			<td colspan="10">
				<?php echo $this->paginator->numbers(); ?>
			</td>
		</tr>
		</tfoot>
	</table>
</div>