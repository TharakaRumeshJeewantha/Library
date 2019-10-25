<?php
	require_once('db/db_connection.php');
	$id=$_GET['id'];
	mysqli_query($db,"delete from tbl_books where bid='$id'");
	header('location:update_books.php');

?>