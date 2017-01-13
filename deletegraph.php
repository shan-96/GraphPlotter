<?php 
require_once ('header.php') ;
if (isset ($_GET['gid'])){
	$gid=$_GET['gid'];
	//$graph=$graph_db->details($gid);
		if(!$graph_db->isPresent($uid,$gid))
			header('Location: index.php');
	$graph_db->delete($gid);
}
header ('Location: index.php');
?>
