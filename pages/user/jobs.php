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
		<ul class="list-group">
			<?php

				foreach ( $jobs AS $job ){
					echo '<li class="list-group-item">'.
					     '<h4>'.$job["title"].'</h4>'.
					     '<p>'.$job["text"].'</p>'.
					     '</li>';
				}
			?>
		</ul>
	</div>
</div>
