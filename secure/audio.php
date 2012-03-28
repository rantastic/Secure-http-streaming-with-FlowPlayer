<?php

//This file goes in a subfolder named 'secure'
//The .htaccess file redirects all requests to the secure folder for mp3s to this file, so they will have to go through this script to grab the mp3.
//This file checks a hash from the current timestamp upon hitting the play button and flowplayers token.
//If everything matches up, it allows a 2 second window from the timestamp to grab the file.
//The idea is that the user will not be able to calculate the hash...
//They would need to know how its salted (with the streamname and the timestamp and flowplayer secure token).
//And even if they do, they will need to calculate what it will be within 2 seconds of hitting the play button.
//This can also be used for video (flv|mp4) content.  Must add extensions to the .htaccess file.
//And header information to this file.  See the commented section below 

$hash = $_GET['h'];
$streamname = $_GET['v'];
$timestamp = $_GET['t'];
$current = time();
$token = 'sn983pjcnhupclavsnda';
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