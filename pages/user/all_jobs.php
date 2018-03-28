<?php

if( !isset($_GET['category']) || empty($_GET['category']) ){
	$category = '';
}else{
	$category = $_GET['category'];
}
if( !isset($_GET['area']) || empty($_GET['area']) ){
	$area = '';
}else{
	$area = $_GET['area'];
}
$jobs = get_all_offered_jobs_filtered($category,$area);

?>
<div class="page-header">
	<h1>
		THESE ARE ALL JOBS, THAT ARE OFFERED
	</h1>
</div>
<div class="row filters">
	<div class="col-sm-6">
		<div class="form-group">
			Filter by category:
			<?php include_once 'pages/company/edit_job_categories.php' ?>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			Filter by area:
			<?php include_once 'pages/company/edit_job_area.php' ?>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$('#select_category').val('<?=$category?>');
			$('#select_area').val('<?=$area?>');
		});
		$('.filter_selectbox').on('change',function(){
			var category = $('#select_category').val();
			var area = $('#select_area').val();
			window.location.href = '/user/all_jobs?category='+category+'&area='+area;
		});
	</script>
</div>
<div class="row">
	<div class="col-sm-12">
		<?php
			if( $jobs == false) {
				echo "<br><h3 style='color:red;'>There are no Jobs offered yet! Sorry!";
			}else {
		?>
		<ul class="list-group">
			<?php
				foreach ( $jobs AS $job ) { ?>
					<li class="list-group-item">
						<h4><?=$job["title"]?> - <?=$job["category"]?> in <?=$job["area"]?></h4>
						<!--<p>--><?//=$job["text"]?><!--</p>-->
						<div class="tools pull-right">
							<a href="/public/job?id=<?=$job['id']?>" class="btn btn-primary">DETAIL</a>
							<a href="/user/send_cv_to_job?id=<?=$job['id']?>" class="btn btn-success">SEND CV</a>
							<a href="javascript:void(0)" onclick="deleteUserJob(<?=$job['id']?>)" class="btn btn-danger delete">DELETE</a>
						</div>
					</li>
					<?php
				}
			}
			?>
		</ul>
	</div>
</div>
