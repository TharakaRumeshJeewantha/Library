<?php
	require_once('db/db_connection.php');
	
	$id=$_GET['id'];
	
	$reg_no=$_POST['reg_no'];
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$gender=$_POST['gender'];
	$grade=$_POST['grade'];
	$class=$_POST['class'];
	$teacher=$_POST['teacher'];
	
	mysqli_query($db,"update tbl_students set std_fname='$firstname', std_lname='$lastname', std_reg_no='$reg_no', std_gender='$gender', std_grade='$grade', std_class='$class', teacher='$teacher' where sid ='$id'");
	header('location:update_students.php');

?>