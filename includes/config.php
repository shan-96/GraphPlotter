<?php
ob_start();
session_start();

define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','12345');
define('DBNAME','graphs');

$db = new PDO("mysql:host=".DBHOST.";port=3306;dbname=".DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

require_once("classes/class.password2.php");

require_once("classes/class.user2.php");

require_once("classes/class.dataset.php");

require_once("classes/class.valueset.php");

require_once("classes/class.graph_db.php");

require_once("classes/class.csv.php");


$user2= new user2($db);

$dataset = new dataset($db);

$valueset = new valueset($db);

$graph_db = new graph_db($db);

$csv = new csv($db);

date_default_timezone_set('Asia/Kolkata');

function sanitize($string){
	$string = ($string);
	return $string;
}

function secondsToTime($seconds){
	$seconds = (int)$seconds;
	if($seconds < 60){
		return "just now";
	}
	if($seconds >= 60 && $seconds < 3600){
		$seconds = round($seconds/60);
		return $seconds." minutes ago";
	}
	if($seconds >=3600 && $seconds < 86400){
		$seconds = round($seconds/3600);
		return $seconds." hours ago";
	}
	if($seconds >=86400){
		$seconds = round($seconds/86400);
		return $seconds." days ago";
	}
}

?>