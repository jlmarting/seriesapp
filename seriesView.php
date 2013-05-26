<?php
	/****************
	Vista(s).
	Se implementan métodos relativos a la visualización (pantallas o como se
	quiera llamar). Además también se realiza el paso de parámetros entre
	las diferentes vistas.
	
	Contiene una única propiedad, que es $html, el código html que será visualizado
	mediante la función display.

	La mecánica de esta clase es definir la información html en cada función.
	El método display se encarga de asociar el parámetro de la vista a invocar
	pasada por el controlador, con el método que corresponda.
	Además se genera un formulario para pasar por POST los parámetros
	(antes se hacía por url).
	El parámetro obligatorio a pasar es task. De otra forma, se volvería a la vista
	de inicio por defecto.
	Un ejemplo de paso de este parámetro sería
		<input type="text" name="task" value="serverList"/>
	Lo que se hace es decir al controlador que se ejecute la task 'serverList'
	Por otro lado, el action del formulario es 'index.php', de no ser así no funcionaría
	ya que index.php es el que actúa como punto de entrada al controlador, que a su vez
	se encarga de controlar la app.
	***********************/


class seriesView {

	var $html;

	function display($view,$param=null){
		switch($view){
			case 'start': 				$this->start();break;
			case 'serverList':			$this->serverList($param);break;
			case 'seriesList':			$this->seriesList($param);break;
			case 'chapterList':			$this->chapterList($param);break;
			case 'chapterServerList': 	$this->chapterServerList($param);break;
			case 'player':				$this->player($param);break;
				# code...
				break;
			default  	:			$this->error();
		}
		echo $this->html;		
	}



	function DEBUG($desc,$var) {
		echo '<pre>['.$desc.']<br/>';
		print_r($var);echo '</pre>';
	}



	function error() {
		$html='No se encontró nada de nada...<br/>
		<a href="index.php"> Volver </a>';
	}



	function start(){
		$html='
		<!DOCTYPE html>
		<html>
		<head>
		 <meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>SeriesApp2</title>
		</head>
		<body>	
			<h3>Series App2</h3>
			<p>Pulse "Empezar" para ver los proveedores de vídeo disponibles</p>
			<form id="formView" action="index.php" method="post">
			<input type="hidden" name="task" value="serverList"/>
			<input type="submit" value="Empezar"/> 
			</form>
		</body>
		</html>';
		$this->html=$html;
	}



	function serverList($aServers){
		if(empty($aServers)) {
			$this->error();
		}
		else{
			$html = '<form id="formView" action="index.php" method="post">';
			$html.= '<select name="server">';
			foreach ($aServers as $s){
				$html.='<option value="'.$s['url'].'">'.$s['name'].'</option>';
				$html.=$s['name'].'</a></li>';
			}
			$html.='<input type="submit" value="Ver series"/>'; 
			$html.='<input type="hidden" name="task" value="seriesList"/>';
			$html.='</select></form>';
		}
		$this->html=$html;
	}



	function seriesList($aSeries){
		if(empty($aSeries)) {
			$this->error();
		}
		else{
			//$this->DEBUG('aSeries',$aSeries);die();
			$html = '';
			foreach ($aSeries as $indexGroup){
				foreach ($indexGroup as $k=>$serie) {
					if ($k==0)	$html.='<h3>'.$serie.'</h3><ul>';
					else $html.='<li>'.trim($serie).'</li>';					
				}
				$html.='</ul>';
			}
			$html.='<input type="hidden" name="task" value="chapterList"/>';
			$html.='</select></form>';
		}
		$this->html=$html;
	}

	
	function chapterList($aChapters){
	//echo '<pre>';print_r($aChapters);die;
	if(empty($aChapters)) {
			$this->error();
		}
		else{
			//$this->DEBUG('aSeries',$aSeries);die();
			$html = '';
			foreach ($aChapters as $season){
				$html.='<ul>';
				foreach ($season as $k=>$chapter) {
					$html.='<li>'.trim($chapter).'</li>';					
				}
				$html.='</ul>';
			}
			//$html.='<input type="hidden" name="task" value="chapterList"/>';
			//$html.='</select></form>';
		}
		$this->html=$html;
	}
	
	function chapterServerList($aChapterServers){
			//$this->DEBUG('aChapterServers',$aChapterServers);
			$html = '<form action="index.php" method="post"><ul>';
			foreach ($aChapterServers as $aChapter){
				$html.= '<li><button type="submit" name="param" value='.$aChapter['url'].'>'
						.$aChapter['srv']
						.'</button></li>';									
			}
			$html.='</ul><input type="hidden" name="task" value="playChapter"/>';
			$html.='</form>';
		
		$this->html=$html;
	}

	

	function player($url){
		//cadena de prueba de streamcloud
				
		if (!isset($url)){
		$url="http%3A%2F%2Fcdn5.streamcloud.eu%3A443%2Fq3v74jz5h2oax3ptx22indhl6wodvnn62en76wvehijuozfzrvy3jgp3gy%2Fvideo.mp4";
		}
		
		$url=urldecode($url);
		echo 'Fuente del vídeo:   [ '.$url.' ]<br/>';
		$html='
		<html>
		    <head>
	           <title>Web video player (con video.js)</title>
	            <meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
	   			<link href="http://vjs.zencdn.net/c/video-js.css" rel="stylesheet">
		       <script src="http://vjs.zencdn.net/c/video.js"></script>
    		</head>
			<body>
			<p>En desarrollo. Para probar: index.php?task=player&ampparam=url.del.video/fichero.mp4</p>
		 	<p>Si no se indica param, se tratará de usar una url definida en código</p>
			<video id="example_video_1" 
				class="video-js vjs-default-skin" controls width="896" height="504"
      			preload="auto" data-setup="{}">
 				<source type="video/mp4" src="'. $url.'">
			</video>
		</body>
		</html>';
		$this->html=$html;
	}	
	
}
?>
