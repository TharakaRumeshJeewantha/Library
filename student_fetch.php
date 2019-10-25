<?php

	$edit=mysqli_query($db,"select * from tbl_students where sid='".$student['sid']."'");
	$erow=mysqli_fetch_array($edit);

	echo $erow['std_grade'];

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
?>

<!-- Delete -->
    <div class="modal fade" id="del<?php echo $student['sid'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$del=mysqli_query($db,"select * from tbl_students where sid='".$student['sid']."'");
					$drow=mysqli_fetch_array($del);
				?>
				<div class="container-fluid">
					<h5><center>Are you sure? you want to delete '<strong><?php echo $drow['std_fname']; ?> <?php echo $drow['std_lname']; ?>' </strong> Student from List?</center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <a href="student_delete.php?id=<?php echo $student['sid']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                </div>
				
            </div>
        </div>
    </div>
<!-- /.modal -->

<!-- Edit -->
    <div class="modal fade" id="edit<?php echo $student['sid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Modify Student's Details</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$edit=mysqli_query($db,"select * from tbl_students where sid='".$student['sid']."'");
					$erow=mysqli_fetch_array($edit);
				?>
				<div class="container-fluid">
				<form method="POST" action="student_edit.php?id=<?php echo $erow['sid']; ?>">


					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Enrollment (Reg No) </label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" name="reg_no" value="<?php echo $erow['std_reg_no']; ?>" id="w1-bno" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">First Name </label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" name="firstname" value="<?php echo $erow['std_fname']; ?>" id="w1-bno" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Last Name </label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" name="lastname" value="<?php echo $erow['std_lname']; ?>" id="w1-bno" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Gender</label>
						<div class="col-sm-6">
							<select id="gender" name="gender" class="form-control input-sm" required>
								<option value="<?php echo $erow['std_gender']; ?>"><?php echo $erow['std_gender']; ?></option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
							<label class="error" for="gender"></label>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-4 control-label">Grade</label>
						<div class="col-sm-6">
							<select id="grade" name="grade" class="form-control input-sm" required>
								<option value="<?php echo $erow['std_grade']; ?>"><?php echo $erow['std_grade']; ?></option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
							<label class="error" for="grade"></label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Class</label>
						<div class="col-sm-6">
							<select id="classes" name="class" class="form-control input-sm" required>
								<option value="<?php echo $erow['std_class']; ?>"><?php echo $erow['std_class']; ?></option>
								<option value="A">A</option>
								<option value="B">B</option>
							</select>
							<label class="error" for="classes"></label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Class Teacher Name</label>
						<div class="col-sm-6">
							<select name="teacher" class="form-control input-sm" required data-plugin-selectTwo data-plugin-options='{ "minimumInputLength": 1 }'>
								<optgroup label="Please Select">
									<option value="<?php echo $erow['teacher']; ?>"><?php echo $erow['teacher']; ?></option>
								</optgroup>
								<?php echo $teacher_list; ?>
							</select>
						</div>
					</div>
					
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-check"></span> Save</button>
                </div>
				</form>
            </div>
        </div>
    </div>
<!-- /.modal -->