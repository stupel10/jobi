<?php

require_once '_inc/config.php';

$company = get_company_from_POST();
if( ! $company ) show_404();

include_once "_partials/header.php";

?>

<div class="page-header">
	<h1>HOMEPAGE FOR COMPANY: <?php echo $company['name'] ?></h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<h3>About this company:</h3>
		<p>
			NAME: <?php echo $company['name']?><br>
		</p>
	</div>
	<div class="col-sm-6">
		<h3>Jobs you afford:</h3>
		<ul class="list-group">
			<?php

			global $database;
			$company_jobs = $database->select("jobs",
											['id','title','text'],
											['company_id' => $company['id']]);

			foreach ($company_jobs as $job){
				echo '<li class="list-group-item">'.
					 'TITLE: '.$job['title'].
					 '<br>'.
					 'TEXT: '.$job['text'].
					 '</li>';
			}
			?>
		</ul>
		<br>
	</div>
	<form action="_inc/add_job.php" method="GET" class="col-sm-6" id="add-job-form">
		<p class="form-group">
			<input type="hidden" class="form-control" name="company_id" value="<?php echo $company['id'];?>">
			<input type="text" name="title" class="form-control" placeholder="JOB TITLE">
			<textarea name="text" id="" cols="30" rows="10" class="form-control"placeholder="JOB TEXT"></textarea>
		</p>
		<p class="form-group">
			<input type="submit" class="btn btn-primary" value="SUBMIT JOB">
		</p>
	</form>
</div>
<?php include_once "_partials/footer.php" ?>

