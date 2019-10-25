<?php

require_once('db/db_connection.php');



	$teacher_list = '';

	$query_t = "SELECT * FROM tbl_teachers";
	$teachers = mysqli_query($db, $query_t);

	if ($teachers) {
		while ($teacher = mysqli_fetch_assoc($teachers)) {
						
			$teacher_list .=	"<optgroup label='{$teacher['t_grade']} - {$teacher['t_class']}'>";
			$teacher_list .=	"<option value='{$teacher['t_fname']} {$teacher['t_lname']}'>{$teacher['t_fname']} {$teacher['t_lname']} ({$teacher['t_grade']} - {$teacher['t_class']})</option>";
			$teacher_list .=	"</optgroup>";
		
		}
	} else {
		echo "Database Query Failed";
	}


	$author_list = '';

	$query_a = "SELECT distinct(bk_author) FROM tbl_books";
	$authors = mysqli_query($db, $query_a);

	if ($authors) {
		while ($author = mysqli_fetch_assoc($authors)) {
						
			$author_list .=	"<optgroup label=''>";
			$author_list .=	"<option value='{$author['bk_author']}'>{$author['bk_author']}</option>";
			$author_list .=	"</optgroup>";
		
		}
	} else {
		echo "Database Query Failed";
	}

		$publisher_list = '';

	$query_p = "SELECT distinct(bk_publisher) FROM tbl_books";
	$publishers = mysqli_query($db, $query_p);

	if ($publishers) {
		while ($publisher = mysqli_fetch_assoc($publishers)) {
						
			$publisher_list .=	"<optgroup label=''>";
			$publisher_list .=	"<option value='{$publisher['bk_publisher']}'>{$publisher['bk_publisher']}</option>";
			$publisher_list .=	"</optgroup>";
		
		}
	} else {
		echo "Database Query Failed";
	}




	$student_list = '';

	$query1 = "SELECT * FROM tbl_students s, tbl_transactions t WHERE s.std_reg_no = t.std_no";
	$students = mysqli_query($db, $query1);

	if ($students) {
		while ($student = mysqli_fetch_assoc($students)) {
						
			$student_list .=	"<optgroup label='{$student['std_grade']} - {$student['std_class']}'>";
			$student_list .=	"<option value='{$student['std_reg_no']}'>{$student['std_reg_no']} . {$student['std_fname']} {$student['std_lname']}</option>";
			$student_list .=	"</optgroup>";
		
		}
	} else {
		echo "Database Query Failed";
	}


	$book_list = '';

	$query2 = "SELECT * FROM tbl_books b, tbl_transactions t WHERE t.bk_no = b.bk_no";
	$books = mysqli_query($db, $query2);

	if ($books) {
		while ($book = mysqli_fetch_assoc($books)) {
						
			$book_list .=	"<optgroup label='{$book['bk_category_no']}'>";
			$book_list .=	"<option value='{$book['bk_no']}'>{$book['bk_no']} . {$book['bk_name']} ({$book['bk_edition']})</option>";
			$book_list .=	"</optgroup>";
		
		}
	} else {
		echo "Database Query Failed";
	}



if (isset($_POST['search'])) {

   $Name = $_POST['search'];

   echo '
<ul>
   ';

   if ($Name == 'te') {
       ?>

<!-- <div class="row">
   	<div class="form-group">
	<label class="col-sm-4 control-label" for="issuedDate">Teachers</label>
	<div class="col-md-4 control-label">
	<div class="input-group">
		<span class="input-group-addon">
			<i class="fa  fa-book"></i>
		</span>
	<input class="form-control input-sm" value="All" name="bk_no" id="bk_no" type="text" placeholder="Book No"  readonly="readonly">
	</div>
	</div>
	</div>
</div> -->


	<hr>
	<div class="form-group">
	<div style="text-align: center;" class="col-md-12">
		<a href='http://localhost:8080/jasperserver/flow.html?_flowId=viewReportFlow&_flowId=viewReportFlow&ParentFolderUri=%2Freports&reportUnit=%2Freports%2FTeachers&standAlone=true' target='_blank'>Click here to Generate Teachers Report </a>
	<!-- <button type="submit" name="submit" class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-share "></i> Report </button> -->
	</div>
	</div>

	<?php
	}
	elseif ($Name == 's') {
	?>

<!-- 	<div class="form-group">
		<label class="col-sm-4 control-label">Gender</label>
		<div class="col-md-4 control-label">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="fa  fa-user-md"></i>
			</span>
			<select id="gender" name="gender" class="form-control input-sm" required>
				<option value="">Choose a Gender</option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			</select>
			<label class="error" for="gender"></label>
		</div>
	</div>
	</div> -->


<!-- <div class="row">
	<div class="form-group">
		<label class="col-sm-4 control-label">Grade & Class</label>
		<div class="col-md-2 control-label">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="fa  fa-graduation-cap"></i>
			</span>
			<select id="grade" name="grade" class="form-control input-sm" required>
				<option value="">Choose a Grade</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
			<label class="error" for="grade"></label>
		</div>
	</div>
	
		<div class="col-md-2 control-label">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="fa  fa-graduation-cap"></i>
			</span>
			<select id="classes" name="classes" class="form-control input-sm" required>
				<option value="">Choose a Class</option>
				<option value="A">A</option>
				<option value="B">B</option>
			</select>
			<label class="error" for="classes"></label>
		</div>
	</div>
	</div>
	</div>

<br> -->
<!-- 
	<div class="form-group">
		<label class="col-sm-4 control-label">Class Teacher Name</label>
		<div class="col-md-4 control-label">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa  fa-qq"></i>
					</span>
			<select name="teacher" data-plugin-selectTwo class="form-control input-sm" style="text-align: left" data-plugin-options='{ "minimumInputLength": 1 }' required>
				<optgroup label="Please Select">
					<option value="">Choose Teacher name</option>
				</optgroup>
				<?php echo $teacher_list; ?>
			</select>
		</div>
	</div>
	</div>



		<div class="row">

	<div class="form-group">
		<label class="col-sm-4 control-label">Books Read Range</label>
		<div class="col-md-2">
			<div data-plugin-spinner data-plugin-options='{ "value":0, "min": 0, "max": 100 }'>
				<div class="input-group" style="width:225px;">
					<input type="text" class="spinner-input form-control" maxlength="3" readonly>
					<div class="spinner-buttons input-group-btn">
						<button type="button" class="btn btn-default spinner-up">
							<i class="fa fa-angle-up"></i>
						</button>
						<button type="button" class="btn btn-default spinner-down">
							<i class="fa fa-angle-down"></i>
						</button>
					</div>
				</div>
			</div>
			<p>
				with <code>max</code> value set to 100
			</p>
		</div> -->

<!-- 		<div class="col-md-2">
			<div data-plugin-spinner data-plugin-options='{ "value":0, "min": 0, "max": 100 }'>
				<div class="input-group" style="width:225px;">
					<input type="text" class="spinner-input form-control" maxlength="3" readonly>
					<div class="spinner-buttons input-group-btn">
						<button type="button" class="btn btn-default spinner-up">
							<i class="fa fa-angle-up"></i>
						</button>
						<button type="button" class="btn btn-default spinner-down">
							<i class="fa fa-angle-down"></i>
						</button>
					</div>
				</div>
			</div>
			<p>
				with <code>max</code> value set to 100
			</p>
		</div>

	</div> -->
		<!-- </div> -->

<!-- 	</div> -->

	


	<hr>
	<div class="form-group">
	<div style="text-align: center;" class="col-md-12">
	<a href='http://localhost:8080/jasperserver/flow.html?_flowId=viewReportFlow&_flowId=viewReportFlow&ParentFolderUri=%2Freports&reportUnit=%2Freports%2FStudents&standAlone=true' target='_blank'>Click here to Generate Students Report </a>
	</div>
	</div>
	

	<?php
	} elseif ($Name == "b") {

	?>

<!-- 		<div class="form-group">
		<label class="col-sm-4 control-label">Category</label>
		<div class="col-md-4 control-label">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="fa  fa-graduation-cap"></i>
			</span>
			<select id="category" name="bk_category_no" class="form-control input-sm" required>
				<option value="">Choose a Category</option>
				<option value="Green">Green</option>
				<option value="Red">Red</option>
				<option value="Orange">Orange</option>
				<option value="White">White</option>
				<option value="Blue">Blue</option>
				<option value="Yellow">Yellow</option>
			</select>
			<label class="error" for="category"></label>
		</div>
	</div>
	</div> -->
	

<!-- 		<div class="form-group">
		<label class="col-sm-4 control-label">Book Author Name</label>
		<div class="col-md-4 control-label">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa  fa-qq"></i>
					</span>
			<select name="author" data-plugin-selectTwo class="form-control input-sm" style="text-align: left" data-plugin-options='{ "minimumInputLength": 1 }' required>
				<optgroup label="Please Select">
					<option value="">Choose Author name</option>
				</optgroup>
				<?php echo $author_list; ?>
			</select>
		</div>
	</div>
	</div> -->

<!-- 			<div class="form-group">
		<label class="col-sm-4 control-label">Book Publisher</label>
		<div class="col-md-4 control-label">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa  fa-qq"></i>
					</span>
			<select name="publisher" data-plugin-selectTwo class="form-control input-sm" style="text-align: left" data-plugin-options='{ "minimumInputLength": 1 }' required>
				<optgroup label="Please Select">
					<option value="">Choose Publisher</option>
				</optgroup>
				<?php echo $publisher_list; ?>
			</select>
		</div>
	</div>
	</div> -->

<!-- 
	<div class="row">

		<div class="form-group">
			<label class="col-sm-4 control-label" for="w1-cost">Book Price Range</label>
			<div class="col-md-2">
			<div class="input-group">
			<input type="number" name="bk_cost1" placeholder="minimum price" class="form-control input-sm" required>
			<span class="input-group-addon btn-default">.00</span>
		</div>
		</div> -->
		<!-- </div> -->

		<!-- <div class="form-group"> -->
			<!-- <label class="col-sm-4 control-label" for="w1-qty"></label> -->
<!-- 			<div class="col-md-2">
			<div class="input-group">
			<input type="number" name="bk_cost2" placeholder="maximum price" class="form-control input-sm" required>
			<span class="input-group-addon btn-default">.00</span>
			</div>
		</div>
	</div> -->
		<!-- </div> -->

<!-- 	</div>
	<br>
	

		<div class="row">

	<div class="form-group">
		<label class="col-sm-4 control-label">Books Quantity Range</label>
		<div class="col-md-2">
			<div data-plugin-spinner data-plugin-options='{ "value":0, "min": 0, "max": 10 }'>
				<div class="input-group" style="width:225px;">
					<input type="text" class="spinner-input form-control" maxlength="3" readonly>
					<div class="spinner-buttons input-group-btn">
						<button type="button" class="btn btn-default spinner-up">
							<i class="fa fa-angle-up"></i>
						</button>
						<button type="button" class="btn btn-default spinner-down">
							<i class="fa fa-angle-down"></i>
						</button>
					</div>
				</div>
			</div>
			<p>
				with <code>max</code> value set to 10
			</p>
		</div>

		<div class="col-md-2">
			<div data-plugin-spinner data-plugin-options='{ "value":0, "min": 0, "max": 10 }'>
				<div class="input-group" style="width:225px;">
					<input type="text" class="spinner-input form-control" maxlength="3" readonly>
					<div class="spinner-buttons input-group-btn">
						<button type="button" class="btn btn-default spinner-up">
							<i class="fa fa-angle-up"></i>
						</button>
						<button type="button" class="btn btn-default spinner-down">
							<i class="fa fa-angle-down"></i>
						</button>
					</div>
				</div>
			</div>
			<p>
				with <code>max</code> value set to 10
			</p>
		</div>

	</div> -->
		<!-- </div> -->
<!-- 
	</div>
	

			<div class="row">

	<div class="form-group">
		<label class="col-sm-4 control-label">Books Available Range</label>
		<div class="col-md-2">
			<div data-plugin-spinner data-plugin-options='{ "value":0, "min": 0, "max": 10 }'>
				<div class="input-group" style="width:225px;">
					<input type="text" class="spinner-input form-control" maxlength="3" readonly>
					<div class="spinner-buttons input-group-btn">
						<button type="button" class="btn btn-default spinner-up">
							<i class="fa fa-angle-up"></i>
						</button>
						<button type="button" class="btn btn-default spinner-down">
							<i class="fa fa-angle-down"></i>
						</button>
					</div>
				</div>
			</div>
			<p>
				with <code>max</code> value set to 10
			</p>
		</div>

		<div class="col-md-2">
			<div data-plugin-spinner data-plugin-options='{ "value":0, "min": 0, "max": 10 }'>
				<div class="input-group" style="width:225px;">
					<input type="text" class="spinner-input form-control" maxlength="3" readonly>
					<div class="spinner-buttons input-group-btn">
						<button type="button" class="btn btn-default spinner-up">
							<i class="fa fa-angle-up"></i>
						</button>
						<button type="button" class="btn btn-default spinner-down">
							<i class="fa fa-angle-down"></i>
						</button>
					</div>
				</div>
			</div>
			<p>
				with <code>max</code> value set to 10
			</p>
		</div>

	</div> -->
		<!-- </div> -->

<!-- 	</div>



			<div class="row">

	<div class="form-group">
		<label class="col-sm-4 control-label">Book Published Year Range</label>
		<div class="col-md-2">
			<div data-plugin-spinner data-plugin-options='{ "value":2015, "min": 2000, "max": 2019 }'>
				<div class="input-group" style="width:225px;">
					<input type="text" class="spinner-input form-control" maxlength="3" readonly>
					<div class="spinner-buttons input-group-btn">
						<button type="button" class="btn btn-default spinner-up">
							<i class="fa fa-angle-up"></i>
						</button>
						<button type="button" class="btn btn-default spinner-down">
							<i class="fa fa-angle-down"></i>
						</button>
					</div>
				</div>
			</div>
			<p>
				with <code>min</code> value set to 2000
			</p>
		</div>

		<div class="col-md-2">
			<div data-plugin-spinner data-plugin-options='{ "value":2015, "min": 2000, "max": 2019 }'>
				<div class="input-group" style="width:225px;">
					<input type="text" class="spinner-input form-control" maxlength="3" readonly>
					<div class="spinner-buttons input-group-btn">
						<button type="button" class="btn btn-default spinner-up">
							<i class="fa fa-angle-up"></i>
						</button>
						<button type="button" class="btn btn-default spinner-down">
							<i class="fa fa-angle-down"></i>
						</button>
					</div>
				</div>
			</div>
			<p>
				with <code>max</code> value set to 2019
			</p>
		</div>

	</div> -->
		<!-- </div> -->

<!-- 	</div>

			<div class="row">

	<div class="form-group">
		<label class="col-sm-4 control-label">Book Page Range</label>
		<div class="col-md-2">
			<div data-plugin-spinner data-plugin-options='{ "value":0, "min": 0, "max": 200 }'>
				<div class="input-group" style="width:225px;">
					<input type="text" class="spinner-input form-control" maxlength="3" readonly>
					<div class="spinner-buttons input-group-btn">
						<button type="button" class="btn btn-default spinner-up">
							<i class="fa fa-angle-up"></i>
						</button>
						<button type="button" class="btn btn-default spinner-down">
							<i class="fa fa-angle-down"></i>
						</button>
					</div>
				</div>
			</div>
			<p>
				with <code>max</code> value set to 200
			</p>
		</div>

		<div class="col-md-2">
			<div data-plugin-spinner data-plugin-options='{ "value":0, "min": 0, "max": 200 }'>
				<div class="input-group" style="width:225px;">
					<input type="text" class="spinner-input form-control" maxlength="3" readonly>
					<div class="spinner-buttons input-group-btn">
						<button type="button" class="btn btn-default spinner-up">
							<i class="fa fa-angle-up"></i>
						</button>
						<button type="button" class="btn btn-default spinner-down">
							<i class="fa fa-angle-down"></i>
						</button>
					</div>
				</div>
			</div>
			<p>
				with <code>max</code> value set to 200
			</p>
		</div>

	</div> -->
		<!-- </div> -->
<!-- 
	</div> -->


	<hr>
	<div class="form-group">
	<div style="text-align: center;" class="col-md-12">
	<a href='http://localhost:8080/jasperserver/flow.html?_flowId=viewReportFlow&_flowId=viewReportFlow&ParentFolderUri=%2Freports&reportUnit=%2Freports%2FAll_Books&standAlone=true' target='_blank'>Click here to Generate Books Report </a>
	</div>
	</div>

	<?php
		
	}

	elseif ($Name == "o") {
	?>


<!-- 		<div class="form-group">
		<label class="col-sm-4 control-label">Reason</label>
		<div class="col-md-3 control-label">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="fa fa-flag"></i>
			</span>
			<select id="reason" name="reason" class="form-control input-sm" required>
				<option value="">Choose a Reason</option>
				<option value="Damage">Damage</option>
				<option value="Dismiss">Dismiss</option>
				<option value="Other">Other</option>
			</select>
			<label class="error" for="reason"></label>
		</div>
	</div>
	</div> -->



	<hr>
	<div class="form-group">
	<div style="text-align: center;" class="col-md-12">
	<a href='http://localhost:8080/jasperserver/flow.html?_flowId=viewReportFlow&_flowId=viewReportFlow&ParentFolderUri=%2Freports&reportUnit=%2Freports%2FRemove_Books&standAlone=true' target='_blank'>Click here to Generate Removed Books Report </a>
	</div>
	</div>

	<?php
	}

	elseif ($Name == "trcu") {
	?>

<!-- 
<div class="row">
		<div class="form-group">
		<label class="col-sm-4 control-label">Grade & Class</label>
		<div class="col-md-2 control-label">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="fa  fa-graduation-cap"></i>
			</span>
			<select id="grade" name="grade" class="form-control input-sm" required>
				<option value="">Choose a Grade</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
			<label class="error" for="grade"></label>
		</div>
	</div>

		<div class="col-md-2 control-label">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="fa  fa-graduation-cap"></i>
			</span>
			<select id="classes" name="classes" class="form-control input-sm" required>
				<option value="">Choose a Class</option>
				<option value="A">A</option>
				<option value="B">B</option>
			</select>
			<label class="error" for="classes"></label>
		</div>
	</div>
	</div>
</div> -->

<!-- <br>



	<div class="form-group">
		<label class="col-sm-4 control-label">Class Teacher Name</label>
		<div class="col-md-4 control-label">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa  fa-qq"></i>
					</span>
			<select name="teacher" data-plugin-selectTwo class="form-control input-sm" style="text-align: left" data-plugin-options='{ "minimumInputLength": 1 }' required>
				<optgroup label="Please Select">
					<option value="">Choose Teacher name</option>
				</optgroup>
				<?php echo $teacher_list; ?>
			</select>
		</div>
	</div>
	</div>


	<div class="form-group">
												<label class="col-sm-4 control-label">Date range</label>
												<div class="col-md-4">
													<div class="input-daterange input-group" data-plugin-datepicker style="width: 470px;">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" class="form-control" name="start">
														<span class="input-group-addon">to</span>
														<input type="text" class="form-control" name="end">
													</div>
												</div>
											</div>
 -->

	<hr>
	<div class="form-group">
	<div style="text-align: center;" class="col-md-12">
	<a href='http://localhost:8080/jasperserver/flow.html?_flowId=viewReportFlow&_flowId=viewReportFlow&ParentFolderUri=%2Freports&reportUnit=%2Freports%2FCustomize_Transaction&standAlone=true' target='_blank'>Click here to Generate Custom Books Transaction Report </a>
	</div>
	</div>

	<?php
	}

	elseif ($Name == "trc") {
	?>


<!-- 	<div class="form-group">
		<label class="col-sm-4 control-label">Student</label>
		<div class="col-md-4 control-label">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa  fa-user"></i>
					</span>
			<select name="std_no" data-plugin-selectTwo class="form-control input-sm" style="text-align: left;"  required data-plugin-options='{ "minimumInputLength": 1 }' required>
				<option value="">Please Select Student</option>
					<?php echo $student_list; ?>
			</select>
		</div>
		</div>
	</div> -->



	<!-- 		<div class="form-group">
				<label class="col-sm-4 control-label" for="w1-book-no">Book</label>
				<div class="col-md-4 control-label">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa  fa-book"></i>
					</span>
			<select name="bk_no" data-plugin-selectTwo class="form-control input-sm" style="text-align: left;"  required data-plugin-options='{ "minimumInputLength": 1 }' required>
				<option value="">Please Select Book</option>
					<?php echo $book_list; ?>
			</select>
				</div>
			</div>
			</div>
	


<div class="row">
		<div class="form-group">
		<label class="col-sm-4 control-label">Grade & Class</label>
		<div class="col-md-2 control-label">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="fa  fa-graduation-cap"></i>
			</span>
			<select id="grade" name="grade" class="form-control input-sm" required>
				<option value="">Choose a Grade</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
			<label class="error" for="grade"></label>
		</div>
	</div>

		<div class="col-md-2 control-label">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="fa  fa-graduation-cap"></i>
			</span>
			<select id="classes" name="classes" class="form-control input-sm" required>
				<option value="">Choose a Class</option>
				<option value="A">A</option>
				<option value="B">B</option>
			</select>
			<label class="error" for="classes"></label>
		</div>
	</div>
	</div>
</div>

<br> -->

<!-- 
			<div class="form-group">
		<label class="col-sm-4 control-label">Book Category</label>
		<div class="col-md-4 control-label">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="fa  fa-graduation-cap"></i>
			</span>
			<select id="category" name="bk_category_no" class="form-control input-sm" required>
				<option value="">Choose a Category</option>
				<option value="Green">Green</option>
				<option value="Red">Red</option>
				<option value="Orange">Orange</option>
				<option value="White">White</option>
				<option value="Blue">Blue</option>
				<option value="Yellow">Yellow</option>
			</select>
			<label class="error" for="category"></label>
		</div>
	</div>
	</div>


		<div class="form-group">
		<label class="col-sm-4 control-label">Book Author Name</label>
		<div class="col-md-4 control-label">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa  fa-qq"></i>
					</span>
			<select name="author" data-plugin-selectTwo class="form-control input-sm" style="text-align: left" data-plugin-options='{ "minimumInputLength": 1 }' required>
				<optgroup label="Please Select">
					<option value="">Choose Author name</option>
				</optgroup>
				<?php echo $author_list; ?>
			</select>
		</div>
	</div>
	</div> -->

<!-- 
	<div class="form-group">
		<label class="col-sm-4 control-label">Class Teacher Name</label>
		<div class="col-md-4 control-label">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa  fa-qq"></i>
					</span>
			<select name="teacher" data-plugin-selectTwo class="form-control input-sm" style="text-align: left" data-plugin-options='{ "minimumInputLength": 1 }' required>
				<optgroup label="Please Select">
					<option value="">Choose Teacher name</option>
				</optgroup>
				<?php echo $teacher_list; ?>
			</select>
		</div>
	</div>
	</div>


	<div class="form-group">
												<label class="col-sm-4 control-label">Date range</label>
												<div class="col-md-4">
													<div class="input-daterange input-group" data-plugin-datepicker style="width: 470px;">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" class="form-control" name="start">
														<span class="input-group-addon">to</span>
														<input type="text" class="form-control" name="end">
													</div>
												</div>
											</div> -->

				


	<hr>
	<div class="form-group">
	<div style="text-align: center;" class="col-md-12">
	<a href='http://localhost:8080/jasperserver/flow.html?_flowId=viewReportFlow&_flowId=viewReportFlow&ParentFolderUri=%2Freports&reportUnit=%2Freports%2FCompleted_Transactions&standAlone=true' target='_blank'>Click here to Generate Completed Books Transaction Report </a>
	</div>
	</div>

	<?php
	}

	elseif ($Name == "tre") {
	?>
<!-- 
			<div class="form-group">
				<label class="col-sm-4 control-label" for="w1-book-no">Book</label>
				<div class="col-md-4 control-label">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa  fa-book"></i>
					</span>
			<select name="bk_no" data-plugin-selectTwo class="form-control input-sm" style="text-align: left;"  required data-plugin-options='{ "minimumInputLength": 1 }' required>
				<option value="">Please Select Book</option>
					<?php echo $book_list; ?>
			</select>
				</div>
			</div>
			</div> -->
	
<!-- 

<div class="row">
		<div class="form-group">
		<label class="col-sm-4 control-label">Grade & Class</label>
		<div class="col-md-2 control-label">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="fa  fa-graduation-cap"></i>
			</span>
			<select id="grade" name="grade" class="form-control input-sm" required>
				<option value="">Choose a Grade</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
			<label class="error" for="grade"></label>
		</div>
	</div> -->

<!-- 		<div class="col-md-2 control-label">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="fa  fa-graduation-cap"></i>
			</span>
			<select id="classes" name="classes" class="form-control input-sm" required>
				<option value="">Choose a Class</option>
				<option value="A">A</option>
				<option value="B">B</option>
			</select>
			<label class="error" for="classes"></label>
		</div>
	</div>
	</div>
</div>

<br>


			<div class="form-group">
		<label class="col-sm-4 control-label">Book Category</label>
		<div class="col-md-4 control-label">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="fa  fa-graduation-cap"></i>
			</span>
			<select id="category" name="bk_category_no" class="form-control input-sm" required>
				<option value="">Choose a Category</option>
				<option value="Green">Green</option>
				<option value="Red">Red</option>
				<option value="Orange">Orange</option>
				<option value="White">White</option>
				<option value="Blue">Blue</option>
				<option value="Yellow">Yellow</option>
			</select>
			<label class="error" for="category"></label>
		</div>
	</div>
	</div>
 -->

<!-- 		<div class="form-group">
		<label class="col-sm-4 control-label">Book Author Name</label>
		<div class="col-md-4 control-label">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa  fa-qq"></i>
					</span>
			<select name="author" data-plugin-selectTwo class="form-control input-sm" style="text-align: left" data-plugin-options='{ "minimumInputLength": 1 }' required>
				<optgroup label="Please Select">
					<option value="">Choose Author name</option>
				</optgroup>
				<?php echo $author_list; ?>
			</select>
		</div>
	</div>
	</div>


	<div class="form-group">
		<label class="col-sm-4 control-label">Class Teacher Name</label>
		<div class="col-md-4 control-label">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa  fa-qq"></i>
					</span>
			<select name="teacher" data-plugin-selectTwo class="form-control input-sm" style="text-align: left" data-plugin-options='{ "minimumInputLength": 1 }' required>
				<optgroup label="Please Select">
					<option value="">Choose Teacher name</option>
				</optgroup>
				<?php echo $teacher_list; ?>
			</select>
		</div>
	</div>
	</div> -->

		<hr>
	<div class="form-group">
	<div style="text-align: center;" class="col-md-12">
	<a href='http://localhost:8080/jasperserver/flow.html?_flowId=viewReportFlow&_flowId=viewReportFlow&ParentFolderUri=%2Freports&reportUnit=%2Freports%2FExpired_Transactions&standAlone=true' target='_blank'>Click here to Generate Expired Books Transaction Report </a>
	</div>
	</div>



	<?php
	}
}

?>

		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="assets/vendor/fuelux/js/spinner.js"></script>
		<script src="assets/vendor/dropzone/dropzone.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
		<script src="assets/vendor/codemirror/lib/codemirror.js"></script>
		<script src="assets/vendor/codemirror/addon/selection/active-line.js"></script>
		<script src="assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
		<script src="assets/vendor/codemirror/mode/javascript/javascript.js"></script>
		<script src="assets/vendor/codemirror/mode/xml/xml.js"></script>
		<script src="assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script src="assets/vendor/codemirror/mode/css/css.js"></script>
		<script src="assets/vendor/summernote/summernote.js"></script>
		<script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
		<script src="assets/vendor/ios7-switch/ios7-switch.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="assets/javascripts/forms/examples.advanced.form.js" /></script>