<?php
	include "common.php";		
	$dbh = Db::db_connect();
	$ref=$_REQUEST['ref'];	
	$data= Clicks::addClicks($dbh, $ref);	
	?>