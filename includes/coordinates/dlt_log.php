<meta name="viewport" content="width=device-width, initial-scale=1">

<style type="text/css">
	.container{
		width: 100%;
		margin: 20px auto;
	}
	.mark_img{
		width: 550px;

		height: 700px;

		float: left;

		border: 1px solid #222;

		background-image: url('<?php echo plugin_dir_url( __FILE__ ).'picture.png'; ?>');
	}
	.content{
		width: 490px;
		float: left;
		height: auto;
		border:1px solid;
		background-color: #fff;
	}
	.last_log_head{
		width: 488px;
		text-align: center;
		border-bottom: 3px solid;
	}
	.last_log_date{
		width: 100%;
		height: 300px;
		border-bottom: 3px solid;
	}
	.last_log_value{
		width: 100%;
	}
	.last_log_comment{
		width: 100%;
		height: 200px;
		border-bottom: 3px solid;
	}
	.log_btn_btn{
		width: 110px;

		height: 35px;

		border: 1px solid #ddd;

		box-shadow: inset 0 1px 2px rgba(0,0,0,.07);

		background-color: #5b6470;

		color: #9aa0ac;

		outline: 0;

		transition: 50ms border-color ease-in-out;

		cursor: pointer;

		border-radius: 5px;

		margin: 25px 0 0 10px;
	}
	.log_btn_btn:hover {
		background-color: #fff;
		color: #5b6470;
	}
	.log_sav_btn{
		width: 100px;
		height: 28px;
		border: 1px solid #ddd;

		box-shadow: inset 0 1px 2px rgba(0,0,0,.07);

		background-color: #5b6470;

		color: #9aa0ac;

		outline: 0;

		transition: 50ms border-color ease-in-out;

		cursor: pointer;

		border-radius: 0px 5px 5px 0;

		margin: 0 0 0 0;
	}
	.log_sav_btn:hover {
		background-color: #fff;
		color: #5b6470;
	}
	.date_to_value_btn{
		    width: 100%;
		    background-color: #fff;
		    border: 1px solid #5b6470;
		    color: #5b6470;
		    margin: 10px 0 0 0;
	}
	.date_to_value_btn:hover {
		background-color: #5b6470;
		color: #fff;
	}

	.edit_value{
			width: 350px;
		    background-color: #fff;
		    border: 1px solid #5b6470;
		    color: #222;
		    margin: 5px 10px 10px 10px;
		    text-align: center;
	}
	
	
</style>

<script type="text/javascript">
	
</script>

<?php
global $wpdb;
$bkly_wp = $wpdb->prefix;
$appointment_id = $_POST['last_log_appid'];

$date_result = $wpdb->get_results("SELECT issue_date FROM ".$bkly_wp."ab_medicalhistory WHERE appointment_id='".$appointment_id."' GROUP BY issue_date HAVING COUNT(id) > 0");


	$date = $_POST['date_to_value_dlt'];

	$value_result =	$wpdb->get_results("SELECT main_value, x_value, y_value, id FROM ".$bkly_wp."ab_medicalhistory WHERE issue_date = '".$date."' AND appointment_id = '".$appointment_id."' " );

	
	$value = $_POST['value_to_comm'];

	$Comment_result = $wpdb->get_results("SELECT log_comment, main_value, x_value, y_value FROM ".$bkly_wp."ab_medicalhistory WHERE main_value = '".$value."' AND appointment_id = '".$appointment_id."' ");

?>


<div class="container">

	<div class="mark_img" >
<?php
		if (isset($_POST['date_to_value_dlt'])) {
			foreach ($value_result as $mark) {
				 $top = $mark->y_value;
				 $left = $mark->x_value;
?>
			<p class="mark_val" style="margin: <?php echo $top.'px 0 0 '.$left.'px'; ?>;"><?php echo $mark->main_value; ?></p>
<?php				
			}
?>
			<style type="text/css">
				.mark_val{
					font-weight: bold;
					color: #5b6470;
					cursor: default;
					position: absolute
				}
				.mark_val:hover {
					color: #222;
				}
			</style>
<?php
		}
?>		
	</div>

	<div class="content">
		<h1 class="last_log_head">Delete Log</h1>
		<div class="last_log_date">
			<?php
				if (!empty($date_result)) {
					foreach ($date_result as $row) {
			?>
					<form action="" method="post">
						<input type="hidden" name="last_log_appid" value="<?php echo $appointment_id ?>">
						<input type="submit" name="date_to_value_dlt" class="date_to_value_btn" value="<?php echo $row->issue_date; ?>">
					</form>
			<?php			
					}
				}
				else{
					echo '<h1> There is no log right now </h1>';
				}
			?>
		</div>

		<div class="last_log_value">
			<p style="width: 462px; height: 30px; border-bottom: 1px solid #a9a9a9; font-size: 16px; font-weight: bold; padding: 0 24px;">Values</p> 
			<?php
				if (!empty($value_result)) {
					foreach ($value_result as $row) {
			?>
					<form action="" method="post">
						<input type="hidden" name="last_log_appid" value="<?php echo $appointment_id ?>">
						<input type="hidden" name="date_to_value" value="<?php echo $date ?>">
						<input type="hidden" name="log_id_dlt" value="<?php echo $row->id ?>">
						<table>
							<tr>
								<td class="edit_value">
									<?php echo $row->main_value; ?><!-- <input type="text"  value=""> -->
								</td>
								<td>
									<input type="submit" name="log_dlt_plz" value="DELETE" class="log_sav_btn">
								</td>
							</tr>
						</table>
					</form>	
				
			<?php
					}
				}

			?>
			<form action="" method="post">
			<table>
				<tr>

					<td>
						<input type="submit" name="log_back" value="HOME" class="log_btn_btn">
					</td>
				</tr>
			</table>
		</form>
		</div>
		

		<!-- <div class="last_log_comment">
			<p style="width: 462px; height: 30px; border-bottom: 1px solid #a9a9a9; font-size: 16px; font-weight: bold; padding: 0 24px;">Comments</p> 
				<?php
			// 	if (!empty($Comment_result)) {
			// 		foreach ($Comment_result as $row) {
			// ?>
			// 		<p style="font-size: large; font-weight: bold; margin: 0 0 0 30px;"><?php echo $row->log_comment; ?></p>
			// <?php			
			// 		}
			// 	}
			?>
		</div> -->
	</div>
</div>
    