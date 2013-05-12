<!DOCTYPE html>
<html>
	<head>
		<title>SeriesApp2</title>
	</head>
	<body>	

	<?php
	include_once "seriesController.php";
		$task=$_GET['task'];
		$controller=new seriesController();
		$controller->exe('serverList');
	?>
	</body>
</html>
