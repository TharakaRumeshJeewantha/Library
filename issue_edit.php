<?php
	require_once('db/db_connection.php');
	
	$id=$_GET['id'];
	
	$bk_no=$_POST['bk_no'];
	$std_no=$_POST['std_no'];

	
	mysqli_query($db,"update tbl_transactions set bk_no='$bk_no', std_no='$std_no' where tid='$id'");
	header('location:update_issue.php');

?>