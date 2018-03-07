<?php

	require_once '_inc/config.php';
	$user = get_user();
	if( ! $user ) show_404();

	include_once "_partials/header.php";

?>

<div class="page-header">
		<h1>WELCOME, <?php echo $user['name'] ?></h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<h3>About you:</h3>
		<p>
			NAME: <?php echo $user['name']?><br>
			SURNAME: <?php echo $user['surname']?><br>
			DATE OF BIRTH: <?php echo $user['birthdate']?><br>
			EMAIL: <?php echo $user['email']?>
		</p>
	</div>
	<div class="col-sm-6">
		<h3>Jobs assigned:</h3>
			<ul class="list-group">
				<?php

				$user_jobs = $user['jobs_registered'];
				$user_jobs = explode(",",$user_jobs);

				foreach ($user_jobs as $job_id){
					$job = get_job($job_id);
					$company = get_company($job['company_id']);
					echo '<li class="list-group-item">'.
						 'Company: ' . $company['name'].
						 '<br>'.
						 'TITLE: '. $job['title'].
						 '<br>'.
						 'TEXT: '. $job['text'].
						 '</li>';
				}
				?>
			</ul>
		<br>
	</div>
	<div class="col-sm-6">
		<form method="GET" action="_inc/user/job-qr-scan.php" id="job-qr-scan">
			<p class="form-group">
				<input type="text" class="form-control" name="job_qr_id" placeholder="JOB QR CODE ID"/>
				<input type="hidden" name="user_id" value="<?php echo $user['id']?>">
			</p>
			<p class="form-group">
				<input type="submit" value="FAKE SCAN" class="btn btn-small btn-danger"/>
			</p>
		</form>
		<div>
			<?php require '_inc/user/scan.php'; ?>
		</div>
	</div>
	<div class="col-sm-12">
		<h3>Yours CVs:</h3>
		<ul class="list-group col-sm-6">
			<?php

				$resumes = get_resumes($user['id']);

				foreach ($resumes as $resume){
					echo '<li class="list-group-item">'.
						 'Date created: '.$resume['date_created'].
						 '<br>'.
						 'Text: '.$resume['text'].
						 '</li>';
				}

			?>
		</ul>
	</div>
</div>
<?php include_once "_partials/footer.php" ?>

