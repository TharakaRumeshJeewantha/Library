<?php
	require_once('db/db_connection.php');
	
	$errors = array();

	$id=$_GET['id'];
	
	$bk_no=$_POST['bk_no'];
	$bk_category_no=$_POST['bk_category_no'];
	$bk_name=$_POST['bk_name'];
	$bk_edition=$_POST['bk_edition'];
	$bk_author=$_POST['bk_author'];
	$bk_publisher=$_POST['bk_publisher'];
	$bk_cost=$_POST['bk_cost'];
	$bk_qty=$_POST['bk_qty'];
	$page=$_POST['page'];
	$year=$_POST['year'];
	
	mysqli_query($db,"update tbl_books set bk_no='$bk_no', bk_category_no='$bk_category_no', bk_name='$bk_name', bk_edition='$bk_edition', bk_author='$bk_author', bk_publisher='$bk_publisher', bk_cost='$bk_cost', bk_qty='$bk_qty', bk_available='$bk_qty', year='$year', page='$page' where bid='$id'");
	header('location:update_books.php');

?>