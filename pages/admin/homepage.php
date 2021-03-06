<?php

	$allUsers = 0;
	$allLoggedInUsers = 0;
	$allCompanies = 0;
	$allLoggedInCompanies = 0;
	$allJobsOffered = 0;

	global $database;

	$allUsers = $database->count('users');
	$allLoggedInUsers = $database->count('user_sessions');
	$allCompanies = $database->count('companies');
	$allLoggedInCompanies = $database->count('company_sessions');
	$allJobsOffered = $database->count('jobs');
?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>Some stats</h2>
		</div>
		<div class="col-sm-6">
			<h3>Number of all users:<?=$allUsers?></h3>
			<h3>Number of logged in users:<?=$allLoggedInUsers?></h3>
		</div>
		<div class="col-sm-6">
			<h3>Number of all users:<?=$allCompanies?></h3>
			<h3>Number of logged in users:<?=$allLoggedInCompanies?></h3>
			<h3>Number of all jobs:<?=$allJobsOffered?></h3>
		</div>
	</div>
</div>
