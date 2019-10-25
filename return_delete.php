<?php
	require_once('db/db_connection.php');
	$id=$_GET['id'];
	mysqli_query($db,"delete from tbl_transactions where tid='$id'");
	header('location:update_return.php');

?>