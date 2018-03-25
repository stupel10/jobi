<?php

	if( !isset($_GET['page']) || empty($_GET['page']) ||
	    !isset($_GET['id']) || empty($_GET['id'])
	){
		redirect('/');
	}
	$page = $_GET['page'];
	$id = $_GET['id'];

	if ( !in_array($page,['job','user','company']) ){
		//echo in_array($page,['job','user','company']);
		redirect('/');
	}

	redirect( '/public/'.$page.'?id='.$id );
