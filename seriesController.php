<?php

	/**************
	Controlador.
	Se recogen las tareas que se han de realizar usando el modelo y las vistas.
	En este caso, la instancia de esta clase se hace en index.php, el cual
	actúa como punto de entrada inicial y su función es la de instanciar la clase
	del controlador para ir ejecutando la tarea en cada momento.

	El método exe es el encargado de ejecutar las tareas, las cuales se encuentran implementadas
	en métodos. Por ejemplo, la task 'start' ejecuta el método 'start()'.

	La implementación relativa a la lógica, análisis de URLs, DOM, o lo que requiera
	cierta complejidad y que no esté relacionada estrictamente con control no debería 
	implementarse aquí.

	La mecánica básica es por cada tarea, operar con el modelo y luego invocar una vista.
	***************/

	include_once "seriesMaster.php";
	include_once "seriesView.php";


	class seriesController {

		function __construct(){		
		}

		public function exe($task){
			switch ($task){				
				case 'start':			$this->start();break;
				case 'serverList':		$this->serverList();break;
				case 'seriesList':		//$this->seriesList($params['url']);break;
				case 'chapterList':
				case 'selectChapter':
				case 'play':
				default : echo '<p>Task '.$task. ' no implementada</p>'; $this->start();
			}
		}

		public function start(){
			$view = new seriesView();
			$view->display('start');
		}

		public function serverList() {
			$model = new seriesMaster();
			$aServers=$model->serverList();
			$view = new seriesView();
			$view->display('serverList',$aServers);
		}

		public function seriesList() {}
		public function chapterList() {}
		public function selectChapter(){}
	}

?>