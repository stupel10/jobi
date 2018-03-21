<?php

$jobs = get_user_assigned_jobs($user->id);

?>
<div class="page-header">
	<h1>
		THESE ARE ALL JOBS, YOU SCANNED
	</h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<?php
			if( $jobs == false) {
				echo "<br><h3 style='color:red;'>You dont have any Jobs scanned yet! Go scan it!";
			}else {
		?>
		<ul class="list-group">
			<?php
				foreach ( $jobs AS $job ) {
					echo '<li class="list-group-item">' .
						 '<h4>' . $job["title"] . '</h4>' .
						 '<p>' . $job["text"] . '</p>' .
						 '<div class="tools pull-right">' .
						 '<a href="javascript:void(0)" onclick="deleteUserJob(' . $job['id'] . ')" class="btn btn-danger delete">DELETE</a>' .
						 '</div>' .
						 '</li>';
				}
			}
			?>
		</ul>
	</div>
</div>
