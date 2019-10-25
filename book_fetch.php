<!-- Delete -->
    <div class="modal fade" id="del<?php echo $book['bid'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$del=mysqli_query($db,"select * from tbl_books where bid='".$book['bid']."'");
					$drow=mysqli_fetch_array($del);
				?>
				<div class="container-fluid">
					<h5><center>Are you sure? you want to delete '<strong><?php echo $drow['bk_name']; ?>' </strong> book from list?</center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <a href="book_delete.php?id=<?php echo $book['bid']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                </div>
				
            </div>
        </div>
    </div>
<!-- /.modal -->

<!-- Edit -->
    <div class="modal fade" id="edit<?php echo $book['bid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Modify Book Details</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$edit=mysqli_query($db,"select * from tbl_books where bid='".$book['bid']."'");
					$erow=mysqli_fetch_array($edit);
				?>
				<div class="container-fluid">
				<form method="POST" action="book_edit.php?id=<?php echo $erow['bid']; ?>">

					<!-- /////////////////////// -->
					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Book No</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" name="bk_no"  value="<?php echo $erow['bk_no']; ?>" id="w1-bno" required>
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-4 control-label">Book Category</label>
								<div class="col-sm-6">
									<select id="category" name="bk_category_no" class="form-control  input-sm" required>
										<option value="<?php echo $erow['bk_category_no']; ?>"><?php echo $erow['bk_category_no']; ?></option>
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

					<!-- /////////////////////// -->

					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Book Name</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" name="bk_name" value="<?php echo $erow['bk_name']; ?>" id="w1-bno" required>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-4 control-label">Edition</label>
						<div class="col-sm-6">
							<select id="edition" name="bk_edition" class="form-control input-sm" required>
								<option value="<?php echo $erow['bk_edition']; ?>"><?php echo $erow['bk_edition']; ?></option>
								<option value="i">i</option>
								<option value="ii">ii</option>
								<option value="iii">iii</option>
								<option value="iv">iv</option>
								<option value="v">v</option>
								<option value="vi">vi</option>
								<option value="vii">vii</option>
								<option value="viii">viii</option>
								<option value="ix">ix</option>
							</select>
							<label class="error" for="grade"></label>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Author</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" name="bk_author" value="<?php echo $erow['bk_author']; ?>" id="w1-bno" required>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Publisher</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" name="bk_publisher" value="<?php echo $erow['bk_publisher']; ?>" id="w1-bno" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Published Year</label>
						<div class="col-sm-6">
							<input type="number" class="form-control input-sm" name="year" minlength="4" maxlength="4" min="2000" max="2019" value="<?php echo $erow['year']; ?>" id="w1-bno">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Pages</label>
						<div class="col-sm-6">
							<input type="number" class="form-control input-sm" name="page" minlength="1" maxlength="3" value="<?php echo $erow['page']; ?>" id="w1-bno" required>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Cost</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" name="bk_cost" value="<?php echo $erow['bk_cost']; ?>" id="w1-bno" required>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-4 control-label" for="w1-bno">Quantity</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm"  name="bk_qty"  value="<?php echo $erow['bk_qty']; ?>" id="w1-bno" required>
						</div>
					</div>

					
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-check"></span> Update </button>
                </div>

				</form>
            </div>
        </div>
    </div>
<!-- /.modal -->