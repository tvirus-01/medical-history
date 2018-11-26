<!DOCTYPE html>
<html>
<head>
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
<style type="text/css">

    .bkly_header{
    	color: #ccc;
		background: #23282d;
    	padding: 0 0 5px 15px;
		width: 98%;
	}
	.bkly_tbl_div{
		width: 98%;
		background-color: #fff;
		margin: 40px 0 0 -5px;
		box-shadow: 0 0 2px 1px #23282d;
	}
	.bkly_top_bar{
		width: 100%;
		height: 70px;
		border-bottom: 1px solid#23282d;
	}
	.bkly_tbl_main{
		width: 100%;
		background-color: #F5F7FB;
		padding: 20px 0 20px 0 ;
	}
	.bkly_tbl{
		width: 95%;
		margin: 0px auto;
		background-color: #fff;
		border-top: 1px solid #dee2e6;
	}
	.bkly_tbl_rw1{
		
	}
	.bkly_th{
		border-bottom: 1px solid #dee2e6;
		padding-top: .5rem;
		padding-bottom: .5rem;
		color: #9aa0ac;
		text-transform: uppercase;
		font-size: 13px;
		font-weight: 400;
		width: 15px;
		text-align: center;
	}
</style>

</head>
<body>
<?php global $wpdb; ?>

		<div class="wrap">
        	
        	<h1 class="bkly_header" style="padding: 10px 0 10px 20px;">
        		<?= esc_html(get_admin_page_title()); ?>
        			
        	</h1>
        
		</div>
<?php
		if (isset($_POST['btn_new_log'])) {
			include ('coordinates/new_log.php');			
		}
		 elseif (isset($_POST['btn_last_log'])) {
		 	include('coordinates/last_log.php');
		 }
		 elseif (isset($_POST['date_to_value'])) {
		 	include('coordinates/last_log.php');
		 }
		 elseif (isset($_POST['value_to_comm'])) {
		 	include('coordinates/last_log.php');
		 }
		 elseif (isset($_POST['log_edit'])) {
		 	include('coordinates/edit_log.php');
		 }
		 elseif (isset($_POST['date_to_value_dlt'])) {
		 	include('coordinates/dlt_log.php');
		 }
		 elseif (isset($_POST['clkbl_valu'])) {
		 	include('coordinates/last_log.php');
		 }
		 elseif (isset($_POST['log_sav'])) {
		 	include('coordinates/last_log.php');
		 }
		 elseif (isset($_POST['log_dlt'])) {
		 	include('coordinates/last_log.php');
		 }
		 elseif (isset($_POST['sav_new_log'])) {
			include ('coordinates/new_log.php');
		 }
		 elseif (isset($_POST['Comment_sav'])) {
		 	include('coordinates/last_log.php');
		 }
		 elseif (isset($_POST['Comment_updt'])) {
		 	include('coordinates/last_log.php');
		 }
		 elseif (isset($_POST['copy'])) {
		 	include('coordinates/last_log.php');
		 }
		 else{
?>
			<div class="bkly_tbl_div">
			<div class="bkly_top_bar">
				<?php include ('top-bar.php'); ?>
			</div>
			<div class="bkly_tbl_main">

				<table class="bkly_tbl">
					<tr class="bkly_tbl_rw1">

						<th class="bkly_th"> No. </th>
						<th class="bkly_th"> Employee </th>
						<th class="bkly_th"> Customer Name </th>
						<th class="bkly_th"> Customer Phone </th>
						<th class="bkly_th"> Customer E-mail </th>
						<th class="bkly_th"> Service </th>
						<th class="bkly_th"> Appointment Date </th>
						<th class="bkly_th"> Duration </th>
						<th class="bkly_th"> Status </th>
						<th class="bkly_th"> History </th>
						<th class="bkly_th"> Action </th>

					</tr>

					<?php 
						if (isset($_POST['sbmt_sts'])) {
							include('filter_status.php');
						}
						elseif (isset($_POST['sbmt_dat'])) {
							include('filter_date.php');
						}
						elseif (isset($_POST['sbmt_serch'])) {
							include('search.php');
						}
						else{
							include('history_data.php');
						}
					 ?>
				</table>
			</div>
		</div>
<?php			
		}
?>
</body>
</html>