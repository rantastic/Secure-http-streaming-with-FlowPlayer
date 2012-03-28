<?php

$hash = $_GET['h'];
$streamname = $_GET['v'];
$timestamp = $_GET['t'];
$current = time();
$token = 'sn983pjcnhupclavsnda'; //flowplayers default token, can be compiled with another personal token for added security 
$checkhash = md5($token . '/' . $streamname . $timestamp);

if (($current - $timestamp) <= 2 && ($checkhash == $hash)) {
	
	$fsize = filesize($streamname);
	header('Content-Disposition: inline; filename="' . $streamname . '"');
	
	/* if other file types are needed add switch and content type headers (remember to remove hardcoded audio/mpeg
	
	switch (strrchr($streamname, '.') {
		case '.mp4':
			header('Content-Type: video/mp4');
			break;
		case '.flv':
			header('Content-Type: video/x-flv');
			break;
		
	*/  
	
	header("Content-Type: audio/mpeg");
	header('Content-Length: ' . $fsize);
	header("Content-Type: audio/mpeg");
	header('X-Pad: avoid browser bug');
	header('Cache-Control: no-cache');
	readfile($streamname);
	exit;
	
}

else {
	
	header('Location: /secure');
	
}

?>