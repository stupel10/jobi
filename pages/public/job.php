<?php
if( !isset($_GET['id']) || empty($_GET['id']) ) {
	flash()->error('No id in url!');
	redirect('/'); // TODO: nefunguje redirect!
}else{
	$job_id = $_GET['id'];
	$job = get_job( $job_id );
	if(!$job){
		flash()->error('Job not found!');
		redirect('/'); // TODO: nefunguje redirect!
	}
	$company = get_company_profile($job['company_id']);
	if(!$company){
		flash()->error('Company not found!');
		redirect('/'); // TODO: nefunguje redirect!
	}
}

?>
<div class="row">
	<div class="col-sm-12">
		<h1><?=$job['title']?></h1>
		<p><?=$job['text']?></p>
		<?php if(isset($job['qr_link'])){?>
			<a href="<?=$job['qr_link']?>">
				<img src="<?=$job['qr_link']?>" alt="qr-job<?=$job['id']?>" style="width:100px;"/>
			</a>
		<?php }?>
		<h3><?=$company['name']?></h3>
	</div>
</div>