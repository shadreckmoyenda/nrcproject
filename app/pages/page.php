<?php
 
	$section 	= $URL[1] ?? "home";
	$action 	= $URL[2] ?? null;
	$id 		= $URL[3] ?? null;


	switch ($section) {

		case 'home':
		require page('home');
		break;

		case 'process':
		require page('process');
		break;
 
		default:
		require page('404');
		break;
	}


	
 
