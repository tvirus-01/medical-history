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

		border-radius: 5px 5px 5px 5px;

		margin: -4px 0 0 5px;
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
			width: 100px;
		    background-color: #fff;
		    border: 1px solid #222;
		    color: #222;
		    margin: 5px 10px 10px 10px;
	}
	
	
</style>

<script type="text/javascript">
	function point_it(event) {
            pos_x = event.offsetX ? (event.offsetX) : event.pageX - document.getElementById("pointer_div").offsetLeft;
            pos_y = event.offsetY ? (event.offsetY) : event.pageY - document.getElementById("pointer_div").offsetTop;
            document.pointform.form_x.value = pos_x;
            document.pointform.form_y.value = pos_y;
      		  }
</script>

<?php
global $wpdb;
$bkly_wp = $wpdb->prefix;
 $appointment_id = $_POST['last_log_appid'];
 $value_id = $_POST['value_id'];

$date_result = $wpdb->get_results("SELECT issue_date FROM ".$bkly_wp."ab_medicalhistory WHERE appointment_id='".$appointment_id."' GROUP BY issue_date HAVING COUNT(id) > 0");


	 $date = $_POST['date_to_value_edt'];

	$value_result =	$wpdb->get_results("SELECT main_value, x_value, y_value, id FROM ".$bkly_wp."ab_medicalhistory WHERE id = '".$value_id."' " );

?>


<div class="container">

	<img src="<?php echo plugin_dir_url( __FILE__ ).'picture.png'; ?>" class="mark_img" id="pointer_div" onclick="point_it(event)" >

	

	<div class="content">
		<h1 class="last_log_head">Edit Log</h1>

		<div class="last_log_value">
			<p style="width: 462px; height: 30px; border-bottom: 1px solid #a9a9a9; font-size: 16px; font-weight: bold; padding: 0 24px;">Value</p> 
			<?php
				if (!empty($value_result)) {
					foreach ($value_result as $row) {
			?>

			<form name="pointform" style="margin: 40px 0 0 0;" id="save_data" action="" method="post" enctype="multipart/form-data" >
						<input type="hidden" name="last_log_appid" value="<?php echo $appointment_id ?>">
						<input type="hidden" name="date_to_value" value="<?php echo $date ?>">
						<input type="hidden" name="log_id" value="<?php echo $value_id ?>">
		<table id="dynamic_field">
			<tr>
			
				<td>
					
        			<input type="text" name="sav_value" class="edit_value" value="<?php echo $row->main_value; ?>" required="required" id="value" />

				</td>
    			<td>
					<input type="submit" name="log_sav" value="SAVE" class="log_sav_btn">
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
    