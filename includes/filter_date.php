<?php
	$date = $_POST['date'];
	
?>
	<head>
 	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style type="text/css">
	.bkly_data_td{
		text-align: center;
	    font-size: 15px;
	    color: #222;
	}

	.bkly_data_btn{
		background-color: #5b6470;
		border: 1px solid #5b6470;
		height: 30px;
		color: #9aa0ac;
		cursor: pointer;
		border-radius: 5px;
	}

	.bkly_data_btn:hover {
		background-color: #fff;
		color: #5b6470;
	}
	.bkly_sorry{
		width: 100%;
	    text-align: center;
	    font-size: 30px;
	}
</style>
 	</head>
<?php

	global $wpdb;
	$bkly_tp = $wpdb->prefix;

	$bkly_data_query ="SELECT ".$bkly_tp."ab_appointments.id AS appointmentId, ".$bkly_tp."ab_appointments.end_date AS endDate, ".$bkly_tp."ab_customers.id AS customerId, ".$bkly_tp."ab_customers.full_name AS customerFullNm, ".$bkly_tp."ab_customers.phone AS cusPhn, ".$bkly_tp."ab_customers.email AS cusMail, ".$bkly_tp."ab_customer_appointments.customer_id AS cusId, ".$bkly_tp."ab_customer_appointments.appointment_id AS appoinTId, ".$bkly_tp."ab_customer_appointments.status AS appoinTSts, ".$bkly_tp."ab_services.title AS serviceTitle, ".$bkly_tp."ab_staff.full_name AS staffNam, ".$bkly_tp."ab_services.duration  AS duraTION 
		FROM ".$bkly_tp."ab_customers, ".$bkly_tp."ab_appointments, ".$bkly_tp."ab_customer_appointments, ".$bkly_tp."ab_services, ".$bkly_tp."ab_staff
		WHERE ".$bkly_tp."ab_appointments.id = ".$bkly_tp."ab_customer_appointments.appointment_id AND ".$bkly_tp."ab_customers.id = ".$bkly_tp."ab_customer_appointments.customer_id AND ".$bkly_tp."ab_appointments.service_id = ".$bkly_tp."ab_services.id AND ".$bkly_tp."ab_appointments.staff_id = ".$bkly_tp."ab_staff.id AND ".$bkly_tp."ab_appointments.end_date LIKE '%$date%' ";

	$bkly_data_result_2 = "";	
		
	$bkly_data_result = $wpdb->get_results($bkly_data_query);
	
	if (!empty($bkly_data_result)) {
			foreach ($bkly_data_result as $row) {
?>
				<tr>
					<td class="bkly_data_td"> 
						<?php echo $row->appointmentId; ?> 
					</td>
					<td class="bkly_data_td"> <?php echo $row->staffNam; ?> </td>
					<td class="bkly_data_td"> <?php echo $row->customerFullNm; ?> </td>
					<td class="bkly_data_td"> <?php echo $row->cusPhn; ?> </td>
					<td class="bkly_data_td"> <?php echo $row->cusMail; ?> </td>
					<td class="bkly_data_td"> <?php echo $row->serviceTitle; ?> </td>
					<td class="bkly_data_td"> <?php echo $row->endDate; ?> </td>
					<td class="bkly_data_td"> <?php $sec = $row->duraTION;
								$min = $sec/60;
								echo $min.' min' ; ?> </td>
					<td class="bkly_data_td"> <?php echo $row->appoinTSts; ?> </td>
					<td class="bkly_data_td"> 
						<form action="" method="post">
							<input type="hidden" name="last_log_appid" value="<?php echo $row->cusId ?>">
							<input type="submit" name="btn_last_log" value="Last Log" class="bkly_data_btn">
						</form> 
					</td>
					<td class="bkly_data_td"> 
						<form action="" method="post">
							<input type="hidden" name="new_log_appid" value="<?php echo $row->cusId ?>">
							<input type="submit" name="btn_new_log" value="New Log" class="bkly_data_btn">
						</form> 
					</td>
				</tr>
<?php			
			}
		}
		else{
			echo '<h1 class="bkly_sorry"> Sorry! no result </h1>';
		}
?>