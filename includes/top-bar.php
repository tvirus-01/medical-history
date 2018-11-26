<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
	.bkly_search_bar{
		width: 345px;
		height: 35px;
		border-radius: 3px;
	}
	.bkly_search_submit{
		height: 35px;

		border: 1px solid #ddd;

		box-shadow: inset 0 1px 2px rgba(0,0,0,.07);

		background-color: #5b6470;

		color: #9aa0ac;

		outline: 0;

		transition: 50ms border-color ease-in-out;

		margin: 0 0 0 -5px;

		cursor: pointer;

		border-radius: 0 5px 5px 0;
	}
	.bkly_search_submit:hover {
		background-color: #fff;
		color: #5b6470;
	}

	.bkly_search_date{
		height: 35px;
		border-radius: 3px 0 0 3px;
	}

	.bkly_date_submit{
		height: 35px;

		border: 1px solid #ddd;

		box-shadow: inset 0 1px 2px rgba(0,0,0,.07);

		background-color: #5b6470;

		color: #9aa0ac;

		outline: 0;

		transition: 50ms border-color ease-in-out;

		margin: 0 0 0 -5px;

		cursor: pointer;

		border-radius: 0 5px 5px 0;
	}
	.bkly_date_submit:hover {
		background-color: #fff;
		color: #5b6470;
	}
</style>
</head>
<body>

	<?php

		global $wpdb;
		$bkly_tp = $wpdb->prefix;

		$bkly_employee_sql ="SELECT * FROM ".$bkly_tp."ab_staff";		
		//echo admin_url();
	?>

	<form style="float: left; margin: 15px 0 0 25px;" method="post" action="admin.php?page=medical-history">
		<input type="date" name="date" class="bkly_search_date" required="required">
		<input type="submit" name="sbmt_dat" class="bkly_date_submit" value="Filter By Date">
	</form>

	<form style="float: left; margin: 15px 0 0 25px;"  method="post" 
			action="">
		<select style="margin: -2px 0 0 0px; height: 35px; border-radius: 3px 0 0 3px;" required="required" name="status">
			<option>status</option>
			<option>pending</option>
			<option>approved</option>
			<option>cancelled</option>
			<option>rejected</option>
		</select>
		<input type="submit" name="sbmt_sts" class="bkly_date_submit" value="Filter">
	</form>

	<?php
		if (isset($_POST['sbmt_dat']) or $_POST['sbmt_sts']) {
	?>
			<form style="float: left; margin: 15px 0 0 25px;" method="post" action="">
				<input type="submit" name="sbmt_emp" class="bkly_date_submit" value="Resset Filter" style="
				border-radius: 5px;">
			</form>
	
	<?php		
		}
	?>
	<form style="float: right; margin: 15px 30px 0 0;"  method="post" 
			action="">
		<input type="text" name="srch" class="bkly_search_bar" required="required" placeholder="Search by customer name, phone or employee name">
		<input type="submit" name="sbmt_serch" class="bkly_search_submit" value="search">
	</form>
</body>
</html>
