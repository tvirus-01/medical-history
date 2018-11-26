<?php
$pdf_name = $_GET['pdf'];
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $pdf_name ?></title>
</head>
<body>
	<embed src="pdf/<?php echo $pdf_name; ?>" width="100%" height="1000px" type='application/pdf'>
</body>
</html>