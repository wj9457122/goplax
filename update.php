<?php

/* REMOVE LINE BELOW TO ENABLE THIS SCRIPT */
die("This file is disabled by default for security reasons. To update, edit the file /update.php and remove this line. Then re-visit this page in browser. Please check <a href='version.php'>version.php</a> first to see if you need an update.");



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
GLOBAL $config, $_CWD;
$_CWD = dirname(__FILE__);
include $_CWD . "/config.php";
include $_CWD . "/functions.php";

$download = file_put_contents($_CWD."/package.zip", fopen("http://cpabuild.com/public/package/update.php?api_key=".$config['api_key'], 'r'));
if(!$download){
	die("Failed to download new package. This could be a permission error. Please download and install manually from the members area");
}
$zip = new ZipArchive;
$res = $zip->open($_CWD."/package.zip");
if(!$res){
	die("Failed to open zip archive.");
}
$success=$zip->extractTo($_CWD);
$zip->close();
if($success){
	unlink($_CWD."/package.zip");
	die("Success! Please check <a href='version.php'>click here</a> to check your version.");
}
else{
	die("Failed to extract new package. This is a permissions issue. Please update manually or run chmod 777 on folder. New package has been placed in ".$_CWD."/package.zip.");
}
