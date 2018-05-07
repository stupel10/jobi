<?php
	global $database;

	$allLogs = $database->select('logs','*');
?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>LOGS</h2>
		</div>
		<div class="col-sm-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Time</th>
						<th>role</th>
						<th>profile ID</th>
						<th>log</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($allLogs as $one){ ?>
				<tr>
					<td><?=$one['id']?></td>
					<td><?=$one['dt']?></td>
					<td><?=$one['role']?></td>
					<td><?=$one['profile_id']?></td>
					<td style="max-width: 600px"><?=htmlspecialchars(trim(strip_tags($one['log'])))?></td>
				</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
