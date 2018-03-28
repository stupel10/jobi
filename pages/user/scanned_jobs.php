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
				foreach ( $jobs AS $job ) { ?>
					<li class="list-group-item">
						<h4><?=$job["title"]?></h4>
						<!--<p>--><?//=$job["text"]?><!--</p>-->
						<div class="tools pull-right">
							<a href="/public/job?id=<?=$job['id']?>" class="btn btn-primary"><i class="fa fa-info"></i></a>
							<a href="/user/send_cv_to_job?id=<?=$job['id']?>" class="btn btn-success"><i class="far fa-share-square"></i></a>
							<a href="javascript:void(0)" onclick="deleteUserJob(<?=$job['id']?>)" class="btn btn-danger delete"><i class="far fa-trash-alt"></i></a>
						</div>
					</li>
					<?php
				}
			}
			?>
		</ul>
	</div>
</div>
