<?php

	$master = new seriesMaster();
	$task=$_REQUEST['task'];		//tarea a realizar
	$url=$_REQUEST['url'];			//url
	$indice=$_REQUEST['indice'];	// ID de indice a buscar en el DOM
	
	if (!is_null($_REQUEST['task'])) 
		$master->exe($_REQUEST['task'],$_REQUEST);
	else die('Task no definida');
		
	class seriesMaster {
	
			var $estado = array('indice'=>'',
								'temporada'=>'',
								'capitulos'=>'');
	
		
			var $servers=array(
							array(
								'name'=>'Series Yonkis',
								'url'=>'www.seriesyonkis.com',
								'indice'=>'filters'
							),
							array(
								'name'=>'Series Pepito',
								'url'=>'www.seriespepito.com',
								'indice'=>'lista_letras'
							)
						);
	
		/**
		*	Al instanciarse la clase se ejecutarán una serie de métodos
		*	en función de los parámetros de url
		*/
		public function exe($task,$params){
		
			switch ($task){
				case 'serverList':	echo $this->serverList();break;
				case 'seriesList':	echo $this->seriesList($params['url']);break;
				case 'chapterList':
				case 'selectChapter':
				case 'play':
				default : echo '<p>Task '.$task. ' no implementada</p>';
				include "index.html";
			}
		}
		
		/**
		*	Devuelve lista de servidores
		*/
		function serverList(){		
			$html=null;			
			if (!empty($this->servers)){				
				$html='<ul>';				
				foreach ($this->servers as $s){
					//armamos la siguiente url parametrizada a pedir
					$href_url='seriesMaster.php?task=seriesList&url='.$s['url'].'&indice='.$this->getIndiceID($s['url']);
					$html.='<li><a href="'.$href_url.'">';
					$html.=$s['name'].'</a></li>';
				}
				$html.='</ul>';
			}
			return $html;
			
		}
		
		/**
		*	Devuelve lista de servidores
		*/
		function seriesList($url){
			$html=$this->getPage('http://'.$url);
			$doc = new DOMDocument();
			@$doc->loadHTML($html);		//para evitar visualizar warnings... revisarlo
			//http://stackoverflow.com/questions/2818759/how-do-i-display-a-domelement	
			/*	$newdoc = new DOMDocument;
				$node = $newdoc->importNode($node, true);
				$newdoc->appendChild($node);
				$html = $newdoc->saveHTML();
			no terminaba de tirar. Después de dar mil vueltas:
			http://www.php.net/manual/es/domnode.c14n.php
			C14N: canoniza nodos a una cadena.... canoniza... ¡toma ya!
			*/
			echo "indice".$this->getIndiceID($url);
			$doc=$doc->getElementById($this->getIndiceID($url));
			return $doc->C14N();
		}
		
		/**
		*	Devuelve lista de capítulos
		*/
		function chapterList(){
		}
		
		/**
		*	Devuelve lista de servidores
		*/
		function play(){
		}
		
		/**
		 * Pasando de reinventar ruedas por el momento...
		 * http://www.webmaster-talk.com/php-forum/120410-using-php-to-get-external-file.html
		 * Fetch the specified page source, even if fopen_url_wrapper is disabled
		 * For that purpose, we use the curl wrapper. It should work everywhere
		 * 
		 * @param String $url The url to fetch
		 * @return String The page source code
		 */
		function getPage($url="http://www.example.com/"){
		 $ch = curl_init();
		 curl_setopt($ch,CURLOPT_URL, $url);
		 curl_setopt($ch,CURLOPT_FRESH_CONNECT,TRUE);
		 curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
		 curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
		 curl_setopt($ch,CURLOPT_REFERER,'http://www.google.com/');
		 curl_setopt($ch,CURLOPT_TIMEOUT,10);
		 $html=curl_exec($ch);
		 if($html==false){
		  $m=curl_error(($ch));
		  error_log($m);
		 }
		 curl_close($ch);
		 return $html;
		}
		
		/**
		*	Devuelve el ID del indice de series, según el proveedor
		*/
		function getIndiceID($url){
		echo $url;
			foreach ($this->servers as $s) {
				if ($s['url']==$url) return $s['indice'];
			}
			die('No se pudo encontrar el ID del índice de series');
		}
		
	
	}	

?>
