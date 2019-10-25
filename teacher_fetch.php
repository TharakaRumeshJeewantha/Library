<?php

	$day_list = '';

	$query_d = "SELECT * FROM tbl_day_time WHERE status <> 'yes'";
	$days = mysqli_query($db, $query_d);

	if ($days) {
		while ($day = mysqli_fetch_assoc($days)) {
						
			$day_list .=	"<option value='{$day['day_time']}'>{$day['day_time']}</option>";
		
		}
	} else {
		echo "Database Query Failed";
	}
?>


<!-- Delete -->
    <div class="modal fade" id="del<?php echo $teacher['t_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$del=mysqli_query($db,"select * from tbl_teachers where t_id='".$teacher['t_id']."'");
					$drow=mysqli_fetch_array($del);
				?>
				<div class="container-fluid">
					<h5><center>Are you sure? you want to delete '<strong><?php echo $drow['t_fname']; ?> <?php echo $drow['t_lname']; ?>' </strong> Teacher from List?</center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <a href="teacher_delete.php?id=<?php echo $teacher['t_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                </div>
				
            </div>
        </div>
    </div>
<!-- /.modal -->

<!-- Edit -->
    <div class="modal fade" id="edit<?php echo $teacher['t_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Modify Teacher's Details</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$edit=mysqli_query($db,"select * from tbl_teachers where t_id='".$teacher['t_id']."'");
					$erow=mysqli_fetch_array($edit);
				?>
				<div class="container-fluid">
				<form method="POST" action="teacher_edit.php?id=<?php echo $erow['t_id']; ?>">

					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">First Name </label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" name="firstname" value="<?php echo $erow['t_fname']; ?>" id="w1-bno" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Last Name </label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" name="lastname" value="<?php echo $erow['t_lname']; ?>" id="w1-bno" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Birthday</label>
						<div class="col-sm-6  control-label">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
								<input type="text" class="form-control input-sm" name="birthday" value="<?php echo $erow['t_birthday']; ?>" id="birthday" data-plugin-datepicker data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" required>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">NIC </label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" name="nic"  data-plugin-masked-input data-input-mask="99-9999-999 (v)" placeholder="xx-xxxx-xx (v)" value="<?php echo $erow['t_nic']; ?>" id="w1-bno" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Phone</label>
						<div class="col-sm-6 control-label">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-phone"></i>
								</span>
								<input id="phone" name="phone" data-plugin-masked-input data-input-mask="(999) 999-9999" placeholder="(xxx) xxx-xxxx" value="<?php echo $erow['t_phone']; ?>" class="form-control input-sm" required>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="profileAddress">Address</label>
						<div class="col-sm-6">
							<textarea class="form-control input-sm" type="text" name="address" rows="3" id="address"  data-plugin-maxlength maxlength="140" required><?php echo $erow['t_address']; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Gender</label>
						<div class="col-sm-6">
							<select id="gender" name="gender" class="form-control input-sm" required>
								<option value="<?php echo $erow['t_gender']; ?>"><?php echo $erow['t_gender']; ?></option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
							<label class="error" for="gender"></label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Subject </label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm"  name="subject" value="<?php echo $erow['t_subject']; ?>" id="w1-bno" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Grade</label>
						<div class="col-sm-6">
							<select id="grade" name="grade" class="form-control input-sm" required>
								<option value="<?php echo $erow['t_grade']; ?>"><?php echo $erow['t_grade']; ?></option>
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
								<option value="<?php echo $erow['t_class']; ?>"><?php echo $erow['t_class']; ?></option>
								<option value="A">A</option>
								<option value="B">B</option>
							</select>
							<label class="error" for="classes"></label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Library Day and Time</label>
						<div class="col-sm-6">
							<select id="days" name="day_time" class="form-control input-sm" required>
								<option value="<?php echo $erow['day_time']; ?>"><?php echo $erow['day_time']; ?></option>
								<?php echo $day_list; ?>
							</select>
							<label class="error" for="day"></label>
						</div>
					</div>

<!-- 					<div class="form-group">
						<label class="col-sm-4 control-label">Library Time Period</label>
						<div class="col-sm-6">
							<select id="periods" name="period" class="form-control input-sm" required>
								<option value="<?php echo $erow['t_period']; ?>"><?php echo $erow['t_period']; ?></option>
								<option value="11 a.m. To 11.30 a.m.">11 a.m. To 11.30 a.m.</option>
								<option value="12 p.m. To 12.30 p.m.">12 p.m. To 12.30 p.m.</option>
							</select>
							<label class="error" for="period"></label>
						</div>
					</div> -->

					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Students </label>
						<div class="col-sm-6">
							<input type="number" maxlength="2" minlength="1" class="form-control input-sm" name="students" value="<?php echo $erow['t_students']; ?>" id="w1-bno" required>
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