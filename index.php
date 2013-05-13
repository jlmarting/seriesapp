<?php
	include_once "seriesController.php";
		$controller=new seriesController();
		$task=$_POST['task'];
		//comprobación de parámetros por url
		//por ejemplo, por links parametrizados
		if(empty($task)) {
			$task=$_REQUEST['task'];
			$param=$_REQUEST['param'];
			$controller->param($param);			
		}
		
		$controller->exe($task);
?>
