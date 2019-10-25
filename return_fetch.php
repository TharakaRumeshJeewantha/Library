<!-- Delete -->
    <div class="modal fade" id="del<?php echo $issuing['tid'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$del=mysqli_query($db,"select * from tbl_transactions where tid='".$issuing['tid']."'");
					$drow=mysqli_fetch_array($del);
				?>
				<div class="container-fluid">
					<h5><center>Are you sure? you want to delete 'TID<strong><?php echo $drow['bk_no']; ?>' </strong> Transaction?</center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <a href="return_delete.php?id=<?php echo $issuing['tid']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                </div>
				
            </div>
        </div>
    </div>
<!-- /.modal -->

<!-- Edit -->
    <div class="modal fade" id="edit<?php echo $issuing['tid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Modify Returning Details</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$edit=mysqli_query($db,"select * from tbl_transactions where tid='".$issuing['tid']."'");
					$erow=mysqli_fetch_array($edit);
				?>
				<div class="container-fluid">
				<form method="POST" action="return_edit.php?id=<?php echo $erow['tid']; ?>">

					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Book No</label>
						<div class="col-sm-8">
							<input type="text" class="form-control input-sm" name="bk_no" value="<?php echo $erow['bk_no']; ?>" id="w1-bno" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Student Enrollment No </label>
						<div class="col-sm-8">
							<input type="text" class="form-control input-sm" name="std_no" value="<?php echo $erow['std_no']; ?>" id="w1-bno" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Issued Date </label>
						<div class="col-sm-8">
							<input type="text" class="form-control input-sm" name="bk_issued_date" value="<?php echo $erow['bk_issued_date']; ?>" id="w1-bno"  readonly="readonly">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Should Return Date </label>
						<div class="col-sm-8">
							<input type="text" class="form-control input-sm" name="bk_should_return_date" value="<?php echo $erow['bk_should_return_date']; ?>" id="w1-bno"  readonly="readonly">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Returned Date </label>
						<div class="col-sm-8">
							<input type="text" class="form-control input-sm" name="bk_returned_date" value="<?php echo $erow['bk_returned_date']; ?>" id="w1-bno"  readonly="readonly">
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