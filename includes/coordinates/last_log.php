 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
		border-bottom: 2px solid #e5e5e5;
		margin: 35px 0 0 0;
	}
	.last_log_date{
		width: 100%;
		height: auto;
		min-height: 250px;
		border-bottom: 2px solid #e5e5e5;
		margin: 35px 0 0 0;
	}
	.last_log_value{
		width: 100%;
		height: auto;
		min-height: 300px;
		border-bottom: 2px solid #e5e5e5;
		margin: 35px 0 0 0;
	}
	.last_log_comment{
		width: 100%;
		height: auto;
		min-height: 250px;
		border-bottom: 2px solid #e5e5e5;
		margin: 35px 0 0 0;
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
	.date_to_value_btn{
		    width: 100%;
		    background-color: #fff;
		    border: 1px solid #5b6470;
		    color: #5b6470;
		    margin: 10px 10px 0 0;
	}
	.date_to_value_btn:hover {
		background-color: #5b6470;
		color: #fff;
	}
	.value_show_field{
				    
		      width: 100%;
		    background-color: #5b6470;
		    border: 0;
		    margin: 10px 10px 0 0;
		    text-align: center;
		    color: #fff;
		    height: 35px;
		    font-size: 20px;
		    cursor: inherit;
	}
	.value_show_field:hover {
		background-color: #fff;
		color: #5b6470;
		border: 1px solid #5b6470;
	}
	.Comment_sav_btn:hover {

		background-color: #fff;
		color: #5b6470;
	}
	.Comment_box{
		width: 370px;
	    height: 120px;
	    margin: 0 30px 0 35px;
	}

	.Comment_box2{
		width: 370px;
	    height: auto;
	    min-height: 60px;
	    margin: 0 30px 0 35px;	
	}
	
	.Comment_sav_btn{

      	margin: 20px 0 0 35px;
	    width: 80px;
	    /* background-color: #222; */
	    border: 1px solid #ddd;
	    box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
	    background-color: #5b6470;
	    color: #9aa0ac;
	    outline: 0;
	    transition: 50ms border-color ease-in-out;
	    cursor: pointer;
	    border-radius: 5px;

	}

	.vew_pic{
		width: auto;
		height: 65px;
		border-bottom: 1px solid grey;
		text-align: center;
		padding: 15px 0;
	}

	.link_to_pic{
		text-decoration: none;
   		 color: #5b6470;
	}

	.link_to_pic:hover {
		color: #222;
	}

	.sec_div{
		width: auto;
		height: 150px;
		border-bottom: 1px solid grey;
		text-align: center;
		/*padding: 15px 0;*/
	}
</style>

<script type="text/javascript">
	
</script>

<?php
global $wpdb;
$bkly_wp = $wpdb->prefix;
$appointment_id = $_POST['last_log_appid'];

if (isset($_POST['log_sav'])) {
	$value_to_sav = $_POST['sav_value'];
	$log_id = $_POST['log_id'];

	$sav_res = $wpdb->query("UPDATE `".$bkly_wp."ab_medicalhistory` SET  `main_value` = '".$value_to_sav."' WHERE `".$bkly_wp."ab_medicalhistory`.`id` = ".$log_id." ");
}
if (isset($_POST['log_dlt'])) {

	$dlt_id = $_POST['value_id'];
	$dlt_res = $wpdb->query("DELETE FROM `".$bkly_wp."ab_medicalhistory` WHERE `".$bkly_wp."ab_medicalhistory`.`id` = '".$dlt_id."' ");

	if ($dlt_res) {
		//nothing
	}
}
$date_result = $wpdb->get_results("SELECT issue_date FROM ".$bkly_wp."ab_medicalhistory WHERE appointment_id='".$appointment_id."' GROUP BY issue_date HAVING COUNT(id) > 0");


	$date = $_POST['date_to_value'];

	$value_result =	$wpdb->get_results("SELECT main_value, x_value, y_value, id FROM ".$bkly_wp."ab_medicalhistory WHERE issue_date = '".$date."' AND appointment_id = '".$appointment_id."' " );

	$value = $_POST['value_to_comm'];

	$Comment_result = $wpdb->get_results("SELECT comment, id FROM ".$bkly_wp."ab_medicalhistory_comments WHERE ".$bkly_wp."ab_medicalhistory_comments.date = '".$date."' AND ".$bkly_wp."ab_medicalhistory_comments.appointment_id = '".$appointment_id."' ");

	if (isset($_POST['Comment_sav'])) {
	$comm = $_POST['Comment'];
	$comment_sav = $wpdb->get_row("INSERT INTO `".$bkly_wp."ab_medicalhistory_comments` (`id`, `appointment_id`, `comment`, `date`) VALUES (NULL, '".$appointment_id."', '".$comm."', '".$date."')");
	}

	if (isset($_POST['Comment_updt'])) {
	$comm = $_POST['Comment'];
	$comm_id = $_POST['comm_id'];
	$comment_sav = $wpdb->get_row("UPDATE `".$bkly_wp."ab_medicalhistory_comments` SET `comment` = '".$comm."' WHERE `".$bkly_wp."ab_medicalhistory_comments`.`id` = ".$comm_id." ");
	}
?>


<div class="container">

	<div class="mark_img" >
<?php
		if (isset($_POST['date_to_value']) or isset($_POST['clkbl_valu'])) {
			foreach ($value_result as $mark) {
				 $y = $mark->y_value;
				 $x = $mark->x_value;
				 $top = $y - 13;
				 $left = $x - 15;
?>
			
			<form action="#" method="post">
				<input type="hidden" name="value_id" value="<?php echo $mark->id; ?>">
				<input type="hidden" name="date_to_value" value="<?php echo $date ?>">
				<input type="hidden" name="last_log_appid" value="<?php echo $appointment_id ?>">
				<input type="hidden" name="y_val" value="<?php echo $top ?>">
				<input type="hidden" name="x_val" value="<?php echo $left ?>">
				<input type="submit" name="clkbl_valu" class="mark_val" style="margin: <?php echo $top.'px 0 0 '.$left.'px'; ?>; background-color: transparent; border: 0; " value="<?php echo $mark->main_value; ?>" >
			</form>


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
		<?php if (isset($_POST['clkbl_valu'])) {
		?>
			<h1 class="last_log_head">Last Log <br><span style="font-size: 20px; background-color: #222; color: #fff; padding: 2px 10px;"><?php echo $_POST['clkbl_valu']; ?></span> </h1>
		<?php
		} 
		else{
			echo '<h1 class="last_log_head">Last Log</h1>';
		}
		?>
		<div class="last_log_date">
			<?php
				if (!empty($date_result)) {
					foreach ($date_result as $row) {
			?>
					<form action="" method="post">
						<input type="hidden" name="last_log_appid" value="<?php echo $appointment_id ?>">
						<input type="submit" name="date_to_value" class="date_to_value_btn" value="<?php echo $row->issue_date; ?>">
					</form>
			<?php			
					}
				}
				else{
					echo '<h1> There is no log right now </h1>';
				}
			?>
		</div>

<?php
	if (isset($_POST['date_to_value'])) {

			?>
				<div class="vew_pic">
					<?php
						if (isset($_POST['copy'])) {
						echo '<p>Data copied now press one of the time slot to refresh</p>';
					}
					?>
					<form action="" method="post">
						<input type="hidden" name="date_to_value" value="<?php echo $date ?>">
						<input type="hidden" name="last_log_appid" value="<?php echo $appointment_id ?>">
						<span style="font-weight: bold;">
							Select a  date to copy data
						<input type="date" name="copy_date" required="required" >
						</span>
						<input type="hidden" name="copy_id" value="<?php echo $appointment_id ?>">
						<input type="submit" name="copy" class="log_btn_btn" value="COPY" style="margin: 0 0 0 10px;">
					</form>
				</div>
			<?php

				if (isset($_POST['copy'])) {
					$copy_sql = "SELECT * FROM ".$bkly_wp."ab_medicalhistory WHERE issue_date = '".$_POST['date_to_value']."' AND appointment_id = '".$_POST['copy_id']."' ";
					$copy_res = $wpdb->get_results($copy_sql);

					foreach ($copy_res as $key) {
						$appointment_id = $key->appointment_id;
						$x_value = $key->x_value;
						$y_value = $key->y_value;
						$main_value = $key->main_value;
						$issue_date = $_POST['copy_date'];
						$picture = $key->picture;
							// echo $x_value;
							// echo "</br>";
							// echo $issue_date;
						$copy_sql2 = "INSERT INTO `".$bkly_wp."ab_medicalhistory` (`id`, `appointment_id`, `x_value`, `y_value`, `main_value`, `issue_date`, `picture`) VALUES (NULL, '".$appointment_id."', '".$x_value."', '".$y_value."', '".$main_value."', '".$issue_date."', '".$picture."')";

						$copy_res2 =  $wpdb->get_row($copy_sql2);
						$query_to_save->code;
					}
				}

		$wpdb->query("CREATE TABLE IF NOT EXISTS `".$bkly_wp."ab_medicalhistory_uploads`(
						`id` int(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
						  `cus_id` varchar(200) NOT NULL,
						  `time_slot` date NOT NULL,
						  `pdf` varchar(200) NOT NULL
						) ENGINE=InnoDB DEFAULT CHARSET=latin1; ");


		if (isset($_POST['up_submit'])) {
				
			$cus_id = $_POST['last_log_appid'];
			$date_to_up = $_POST['date_to_value'];
			$pdf_nm = $_FILES['up_pdf']['name'];

			$up_ins_sql = "INSERT INTO `".$bkly_wp."ab_medicalhistory_uploads` (`id`, `cus_id`, `time_slot`, `pdf`) VALUES (NULL, '$cus_id', '$date_to_up', '$pdf_nm')";

			$up_ins_res = $wpdb->get_row($up_ins_sql);
			$query_to_save->code;

			$action_dir =  plugin_dir_path( __FILE__ ).'pdf/'.basename($pdf_nm);
			move_uploaded_file($_FILES['up_pdf']['tmp_name'], $action_dir);
		}

		$up_sql = "SELECT * FROM `".$bkly_wp."ab_medicalhistory_uploads` WHERE time_slot = '".$_POST['date_to_value']."' AND cus_id = '".$_POST['last_log_appid']."' ";
		$up_res = $wpdb->get_results($up_sql);
		//echo $wpdb->num_rows;

		if (empty($up_res)) {
?>
		<div class="sec_div">
			<p style="width: 462px; height: 30px; border-bottom: 1px solid #a9a9a9; font-size: 16px; font-weight: bold; padding: 0 24px;">PDF</p>
			<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="date_to_value" value="<?php echo $_POST['date_to_value']; ?>">
				<input type="hidden" name="last_log_appid" value="<?php echo $_POST['last_log_appid']; ?>">
				<input type="file" name="up_pdf" style="margin: 20px 0 0 190px;" accept=".pdf">
				<input type="submit" name="up_submit" class="log_btn_btn" value="upload pdf">
			</form>
		</div>
<?php
		}
		else{
			foreach ($up_res as $key) {
				?>
					<div class="vew_pic">
						<a href="<?php echo plugin_dir_url( __FILE__ ).'pdf.php?pdf='.$key->pdf; ?>" target="blank" class="link_to_pic" >View PDF</a>
					</div>	
				<?php
			}
		}
	}
		if (isset($_POST['clkbl_valu'])) {

			$sql = "SELECT picture FROM `".$bkly_wp."ab_medicalhistory` WHERE id = '".$_POST['value_id']."' ";

			$pic_res = $wpdb->get_results($sql);
			foreach ($pic_res as $key) {
			
			if (!empty($key->picture)) {
?>
			<div class="vew_pic">
				<a href="<?php echo plugin_dir_url( __FILE__ ).'picture/'.$key->picture ; ?>" target="blank" class="link_to_pic" >View Picture</a>
			</div>
<?php
			}
		  }	
		}
?>
<?php
	if (isset($_POST['clkbl_valu'])) {
?>
	<div style="margin: 0 0 15px 0;" >
			<table>
				<tr>
					<td>
					<form action="" method="post">	
						<input type="submit" name="log_edit" value="EDIT" class="log_btn_btn">
						<input type="hidden" name="date_to_value_edt" value="<?php echo $date; ?>">
						<input type="hidden" name="value_id" value="<?php echo $_POST['value_id']; ?>">
						<input type="hidden" name="clkbl_valu" value="<?php echo $_POST['clkbl_valu']; ?>">
						<input type="hidden" name="y_val" value="<?php echo $_POST['y_val']; ?>">
						<input type="hidden" name="x_val" value="<?php echo $_POST['x_val']; ?>">
						<input type="hidden" name="new_log_appid" value="<?php echo $appointment_id ?>">
						<input type="hidden" name="last_log_appid" value="<?php echo $appointment_id ?>">
					</form>	
					</td>

					<td>
					<form action="" method="post">	
						<input type="submit" name="log_dlt" value="DELETE" class="log_btn_btn">
						<input type="hidden" name="date_to_value_edt" value="<?php echo $date; ?>">
						<input type="hidden" name="value_id" value="<?php echo $_POST['value_id']; ?>">
						<input type="hidden" name="clkbl_valu" value="<?php echo $_POST['clkbl_valu']; ?>">
						<input type="hidden" name="new_log_appid" value="<?php echo $appointment_id ?>">
						<input type="hidden" name="last_log_appid" value="<?php echo $appointment_id ?>">
					</form>	
					</td>

					<td>
					<form action="" method="post">	
						<input type="submit" name="btn_new_log" value="NEW" class="log_btn_btn">
						<input type="hidden" name="date_to_value_edt" value="<?php echo $date; ?>">
						<input type="hidden" name="value_id" value="<?php echo $_POST['value_id']; ?>">
						<input type="hidden" name="clkbl_valu" value="<?php echo $_POST['clkbl_valu']; ?>">
						<input type="hidden" name="new_log_appid" value="<?php echo $appointment_id ?>">
						<input type="hidden" name="last_log_appid" value="<?php echo $appointment_id ?>">
					</form>	
					</td>

					<td>
					<form action="" method="post">	
						<input type="submit" name="log_back" value="HOME" class="log_btn_btn">
					</form>	
					</td>
				</tr>
			</table>
		</div>	
<?php 	}   ?>

		<?php
		if (isset($_POST['date_to_value'])) {
	?>
		<div class="last_log_comment">
			<p style="width: 462px; height: 30px; border-bottom: 1px solid #a9a9a9; font-size: 16px; font-weight: bold; padding: 0 24px;">Comments</p> 
				<?php
				if (isset($_POST['date_to_value'])) {
					if (!empty($Comment_result)) {
						foreach ($Comment_result as $row) {
			?>
				<form action="" method="post">
					<textarea rows="4" cols="50" name="Comment" class="Comment_box2" maxlength="10"><?php echo $row->comment; ?></textarea>
					<input type="hidden" name="date_to_value" value="<?php echo $date; ?>">
					<input type="hidden" name="last_log_appid" value="<?php echo $appointment_id; ?>">
					<input type="hidden" name="comm_id" value="<?php echo $row->id; ?>">
					<input type="submit" name="Comment_updt" class="Comment_sav_btn" value="UPDATE">
				</form>
			<?php			
					}
				}
				else{
			?>
				<form action="" method="post">	
					<textarea rows="4" cols="50" name="Comment" class="Comment_box" placeholder="Add Comment" maxlength="200"></textarea>
					<input type="hidden" name="date_to_value" value="<?php echo $date; ?>">
					<input type="hidden" name="last_log_appid" value="<?php echo $appointment_id; ?>">
					<input type="submit" name="Comment_sav" class="Comment_sav_btn" value="SAVE">
				</form>	
			<?php		
				}

				}
			?>
		</div>

			<?php 	}   ?>
	</div>
</div>
    