<?php
	require_once('db/db_connection.php');
	$id=$_GET['id'];
	mysqli_query($db,"delete from tbl_students where sid='$id'");
	header('location:update_students.php');

?>