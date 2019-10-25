<?php

require_once('db/db_connection.php');

if (isset($_POST['search'])) {

   $Name = $_POST['search'];

   $Query = "SELECT * FROM tbl_transactions t, tbl_books b, tbl_students s WHERE s.std_reg_no = t.std_no AND b.bk_no = t.bk_no AND t.t_status = 'no' AND t.std_no = '$Name' LIMIT 1";

   $ExecQuery = MySQLi_query($db, $Query);

   echo '
<ul>
   ';

   while ($Result = MySQLi_fetch_array($ExecQuery)) {
       ?>

   	<div class="form-group">
	<label class="col-sm-4 control-label" for="issuedDate">Book No</label>
	<div class="col-md-4 control-label">
	<div class="input-group">
		<span class="input-group-addon">
			<i class="fa  fa-book"></i>
		</span>
	<input class="form-control input-sm" value="<?php echo $Result['bk_no'] ?>" name="bk_no" id="bk_no" type="text" placeholder="Book No"  readonly="readonly">
	</div>
	</div>
	</div>

	<br>	

	<div class="form-group">
	<label class="col-sm-4 control-label" for="issuedDate">Issued Date</label>
	<div class="col-md-4 control-label">
	<div class="input-group">
		<span class="input-group-addon">
			<i class="fa  fa-calendar"></i>
		</span>
	<input class="form-control input-sm" value="<?php echo $Result['bk_issued_date'] ?>" id="issuedDate" type="text" placeholder="Issued Date" readonly="readonly">
	<input class="form-control" value="<?php echo $Result['tid'] ?>" id="tid" type="hidden" name="tid" placeholder="Issued Date" readonly="readonly">
	</div>
	</div>
	</div>

	<br>
						
	<div class="form-group">
	<label class="col-sm-4 control-label" for="returnDate">Should Return Date</label>
	<div class="col-md-4 control-label">
	<div class="input-group">
		<span class="input-group-addon">
			<i class="fa  fa-key"></i>
		</span>
	<input type="text" value="<?php echo $Result['bk_should_return_date'] ?>" id="returnDate" class="form-control input-sm" readonly="readonly">
	</div>
	</div>
	</div>

	<br>

	<div class="form-group">
	<label class="col-sm-4 control-label" for="returnedDate">Returned Date</label>
	<div class="col-sm-4 control-label">
	<div class="input-group">
		<span class="input-group-addon">
			<i class="fa  fa-key"></i>
		</span>
	<input type="text" value="<?php echo date("Y-m-d"); ?>" id="returnedDate" name="returned" class="form-control input-sm" readonly="readonly">
	</div>
	</div>
	</div>
	<br>

	<?php
	if (date_create($Result['bk_should_return_date'])<date_create(date("Y-m-d"))) {
	?>
	<div class="form-group">
	<label class="col-md-4 control-label" for="returnedDate">Delay</label>
	<div class="col-md-6">
	<h2 style="color: red"> <?php $date1=date_create($Result['bk_should_return_date']); $date2=date_create(date("Y-m-d")); $diff=date_diff($date1,$date2); echo $diff->format("%R%a days"); ?> </h2> 
	</div>
	</div>
	<br>
	<?php
	}
	else {
	?>
	<div class="form-group">
	<label class="col-md-4 control-label" for="returnedDate">Days More to Go</label>
	<div class="col-md-6">
	<h2 style="color: green"> <?php $date1=date_create($Result['bk_should_return_date']); $date2=date_create(date("Y-m-d")); $diff=date_diff($date1,$date2); echo $diff->format("%R%a days"); ?> </h2> 
	</div>
	</div>
	<br>
	<?php
	}
	?>



													<div class="form-group">
														<div class="col-md-6"></div>
														<div class="col-md-6">
															<div class="checkbox-custom">
																<input type="checkbox" name="terms" id="w1-terms" required>
																<label for="w1-terms">I agree to the terms of service</label>
															</div>
														</div>
													</div>

													<br>


	<hr>
	<div class="form-group">
	<div style="text-align: center;" class="col-md-12">
	<button type="submit" name="submit" class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-share "></i> Returned </button>
	</div>
	</div>

   <?php
}}

?>
