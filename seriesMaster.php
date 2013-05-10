<?php
	
	$msg = "<p>Este seria el script que contacta con el servidor";
	$msg.= "Debe recibir  por url el paramero de la tarea a realizar</p>";
	echo $msg;
	$task=$_REQUEST['task'];
	switch ($task){
		case 'seriesList':	
		case 'chapterList':
		case 'selectChapter':
		case 'play':
		default : echo '<p>Task '.$task. ' no implementada</p>';
			echo '<a href="index.html"> Start </a>';
	}

?>
