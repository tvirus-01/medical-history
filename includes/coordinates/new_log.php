<?php

global $wpdb;
$bkly_wp = $wpdb->prefix;

?>

<!DOCTYPE html>
<html>
<head>
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <script src="https://ajax.googleapis.com/ajax/libs/dojo/1.13.0/dojo/dojo.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		  <style type="text/css">
		  	.coord_img{
		  		width: 550px;

				height: 700px;

				margin: 20px 0 0 200px;

				border: 1px solid;
		  	}

		  	.coord_input{
		  		width: 90px;
			    text-align: center;
			    box-shadow: 0px 0px 1px 0px grey;
			    height: 35px;
				margin: 0 0 0 10px;
		  	}
		  	.new_log_head{
		  		color: #23282d;
		    	padding: 0 0 5px 15px;
				width: 98%;
		  	}
		  	.new_log_value{
		  		width: 240px; height: 35px; border-radius: 3px;
				margin: 0 0 0 10px;
		  	}
		  	.new_log_cooment{
		  		width: 340px; height: 35px; border-radius: 3px;
				margin: 0 0 0 10px;
		  	}
		  	.sav_new_log{
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

				margin: 0 0 0 10px;

		  	}
		  	.sav_new_log:hover {
		  		background-color: #fff;
				color: #5b6470;
		  	}

		  	.add_more_log{
		  		background-color: darkslategray;

				color: #fff;

				border: 1px solid darkslategray;

				height: 31px;

				width: 50px;

				border-radius: 5px;

				cursor: pointer;

				margin: 0 0 0 10px;
		  	}
		  	.add_more_log:hover {
		  		background-color: #fff;
		  		color: darkslategray;
		  	}
		  	.remove_log{
		  		height: 30px;
			    background-color: crimson;
			    border: 1px solid crimson;
			    width: 30px;
			    border-radius: 50%;
			    margin: 0 0 0 20px;
			    color: #fff;
			    cursor: pointer;
		  	}

		  	.remove_log:hover {
		  		background-color: #fff;
		  		color:crimson;
		  	}

		  	.mark_img{
				width: 550px;

				height: 700px;

				margin: 20px 0 0 200px;

				float: left;

				border: 1px solid #222;

				background-image: url('<?php echo plugin_dir_url( __FILE__ ).'picture.png'; ?>');
			}

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

		  <script type="text/javascript">
		  	 function point_it(event) {
            pos_x = event.offsetX ? (event.offsetX) : event.pageX - document.getElementById("pointer_div").offsetLeft;
            pos_y = event.offsetY ? (event.offsetY) : event.pageY - document.getElementById("pointer_div").offsetTop;
            document.pointform.form_x.value = pos_x;
            document.pointform.form_y.value = pos_y;
      		  }

      		  // $(document).ready(function(){
      		  // 	var i = 1;
      		  // 	$('#add').click(function(){
      		  // 		i++;
      		  // 		$('#dynamic_field').append('<tr id="row'+i+'"> <td> <input type="text" name="form_x" size="4" class="coord_input" required="required" placeholder="X value" id="client_x" /> </td> <td> <input type="text" name="form_y" size="4" class="coord_input" required="required" placeholder="Y value" id="client_y" /> </td> <td> <input type="text" name="new_log_value" class="new_log_value" placeholder="Enter value" required="required" id="value" /> </td> <td> <input type="text" name="new_log_comment" class="new_log_cooment" placeholder="Add comment" id="comment" /> </td> <td> <button class="remove_log" id="'+i+'" name="remove">X</button> </td> </tr>'); 
      		  // 	});
      		  // 	$(document).on('click', '.remove_log', function(){
      		  // 		var button_id = $(this).attr("id");
      		  // 		$('#row'+button_id+'').remove();
      		  // 	});

      		  // 	$('#submit').click(function(){
      		  // 		$.ajax({
      		  // 			url:"save_log.php",
      		  // 			method:"POST",
      		  // 			data:$('#save_data').serialize(),
      		  // 			success:function(data){
      		  // 				alert(data);
      		  // 				$('#save_data')[0].reset();
      		  // 			}
      		  // 		});
      		  // 	});
      		  // }
      		  // 	);
		  </script>	
</head>
<body>
	<h1 class="new_log_head">Add new log</h1>
	<div class="mark_img" id="pointer_div" onclick="point_it(event)">
		<?php
	
		
		$date = $_POST['date_to_value_edt'] ;
		$appointment_id = $_POST['last_log_appid'] ;

		$value_result =	$wpdb->get_results("SELECT main_value, x_value, y_value, id FROM ".$bkly_wp."ab_medicalhistory WHERE issue_date = '".$date."' AND appointment_id = '".$appointment_id."' " );

			foreach ($value_result as $mark) {
				 $y = $mark->y_value;
				 $x = $mark->x_value;
				 $top = $y - 13;
				 $left = $x - 15;
				?>
					<p class="mark_val" style="margin: <?php echo $top.'px 0 0 '.$left.'px'; ?>; background-color: transparent; border: 0; " ><?php echo $mark->main_value; ?></p>
				<?php
			}
	
		?>
	</div><br><br><br>
	<!-- <img src="<?php echo plugin_dir_url( __FILE__ ).'picture.png'; ?>" class="coord_img" id="pointer_div" onclick="point_it(event)" >  -->

	<form name="pointform" style="margin: 40px 0 0 50px;" id="save_data" action="" method="post" enctype="multipart/form-data" >
		<table id="dynamic_field">
			<tr>
				<td>
				    <label>X value</label>
        			<input type="text" name="form_x" size="4" class="coord_input" required="required" value="<?php echo $_POST['form_x']; ?>" id="client_x" />
				</td>
				<td>
                     <label>Y value</label>				    
       				 <input type="text" name="form_y" size="4" class="coord_input" required="required" value="<?php echo $_POST['form_y']; ?>" id="client_y" />
				</td>
				<td>
					<label>Value</label>
        			<input type="text" name="new_log_value" class="new_log_value" value="<?php echo $_POST['new_log_value']; ?>" required="required" id="value" />

				</td>
    			<!-- <td>
    				
    				<button class="add_more_log" id="add" name="add">Add</button>
    			</td> -->
			</tr>
		</table>
		</br></br>

        <input type="hidden" name="new_log_appid" value="<?php echo $_POST['new_log_appid']; ?>" id="appid" >
        <input type="hidden" name="last_log_appid" value="<?php echo $_POST['new_log_appid']; ?>" id="appid" >

        <span>Select a date
       	 <input id="date" type="date" name="date_to_value_edt" required="required" value="<?php echo $date; ?>">
        </span>
<br><br>
		<span>Select a picture
        	<input id="file" type="file" name="new_log_picture" accept="image/*">
        </span>
<br><br>
        <input id="submit" type="submit" name="sav_new_log" class="sav_new_log" value="Save" onclick="savFunction()">
	</form>
	<form action="" method="post">
		<input type="submit" name="submi1001" class="sav_new_log" value="Back To Home" style="margin: 20px 0 0 60px;">
	</form>
</body>
</html>

<?php
if (isset($_POST['sav_new_log'])) {
	$wpdb->query("CREATE TABLE IF NOT EXISTS `".$bkly_wp."ab_medicalhistory`(
						`id` int(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
						  `appointment_id` varchar(50) NOT NULL,
						  `x_value` int(3) NOT NULL,
						  `y_value` int(3) NOT NULL,
						  `main_value` varchar(30) NOT NULL,
						  `issue_date` date NOT NULL,
						  `picture` varchar(200) NOT NULL
						) ENGINE=InnoDB DEFAULT CHARSET=latin1; ");

	$wpdb->query("CREATE TABLE IF NOT EXISTS `".$bkly_wp."ab_medicalhistory_comments`(
						`id` int(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
						  `appointment_id` varchar(50) NOT NULL,
						  `comment` varchar(200) NOT NULL,
						  `date` date NOT NULL
						) ENGINE=InnoDB DEFAULT CHARSET=latin1; ");

	$appointment_id = $_POST['last_log_appid'];
	$client_x = $_POST['form_x'];
	$client_y = $_POST['form_y'];
	$med_value = $_POST['new_log_value'];
	$current_date = $_POST['date_to_value_edt'];
	$picture = $_FILES['new_log_picture']['name'];
	
	$query_to_save = $wpdb->get_row("INSERT INTO `".$bkly_wp."ab_medicalhistory` (`id`, `appointment_id`, `x_value`, `y_value`, `main_value`, `issue_date`, `picture`) VALUES (NULL, '$appointment_id', '$client_x', '$client_y', '$med_value', '$current_date', '$picture')");

	$result = $query_to_save->code;

	$action_dir = plugin_dir_path( __FILE__ ).'picture/'.basename($picture);

	 move_uploaded_file($_FILES['new_log_picture']['tmp_name'], $action_dir) ;

}
?>


