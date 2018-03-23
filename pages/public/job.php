<?php
if( !isset($_GET['job_id']) || empty($_GET['job_id']) ) {
	flash()->error('No job_id in url!');
	redirect('/'); // TODO: nefunguje redirect!
}else{
	$job_id = $_GET['job_id'];
	$job = get_job( $job_id );
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
	</div>
</div>