<?php
	/**********************
		Modelo.
		Es la clase base y piedra angular del desarrollo. Contiene la lógica principal.
		Esta clase implementa métodos que se analizan y extraen información.
		La propiedad servers recoge un array de datos de los servidores a analizar.
		Esta propiedad se usa a modo de CONSTANTE y sirve de guía para el análisis.
		Por cada server, se guarda esta información.

		'name'		: 	nombre del servidor
		'url'		:	url del sitio
		'indice'	:	id del DOM donde está la lista de índice de cappítulos
		
		Esta estructura seguramente no será válida, dado que no es lo suficientemente
		general como para todos los sitios. En el caso de seriespepito, no podemos
		acceder por ID al nodo del DOM de la lista que mencionábamos.
		Además a medida que se continúe con el desarrollo, serán necesarios más índices
		para tener la información necesaria de cada server para su análisis.
	**************************/

	

	class seriesMaster {
			
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
		*	Devuelve lista de servidores
		*/
		function serverList(){		
			return $this->servers;			
		}
		
		/**
		*	Devuelve lista de servidores
		*/
		function seriesList($url){
			$html=$this->getPage('http://'.$url);
			$doc = new DOMDocument();
			@$doc->loadHTML($html);		//para evitar visualizar warnings... revisarlo
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
