<?php
	include_once "seriesController.php";
		$controller=new seriesController();
		if(isset($_POST['task'])){	
			$task=$_POST['task'];
		}
		else{
			$task=$_REQUEST['task'];
			$param=$_REQUEST['param'];
			$controller->param($param);			
		}
		
		$controller->exe($task);
?>
