<?php
	global $database;

	$allUsers = $database->select('companies','*');
?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>COMPANIES</h2>
		</div>
		<div class="col-sm-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Email</th>
						<th>isActive</th>
						<th>created</th>
						<th>active profile ID</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($allUsers as $user){ ?>
				<tr>
					<td><?=$user['id']?></td>
					<td><?=$user['email']?></td>
					<td><?=$user['isactive']?></td>
					<td><?=$user['dt']?></td>
					<td><?=$user['active_profile']?></td>
				</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
