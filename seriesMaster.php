<?php

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
		
		
		function getInnerHTML($Node)
		{
			$Body = $Node->ownerDocument->documentElement->firstChild->firstChild;
			$Document = new DOMDocument();    
			$Document->appendChild($Document->importNode($Body,true));
			return $Document->saveHTML();
		}
		function printDomElement($element)
		{
			$newdoc = new DOMDocument();
			$cloned = $element->cloneNode(TRUE);
			$newdoc->appendChild($newdoc->importNode($cloned,TRUE));
			return $newdoc->saveHTML();
		}

		/**
		*	Devuelve lista de series
		*/
		function seriesList($url){
		
			libxml_use_internal_errors(true); //?
			
			
			//$string = 'show_list';
			//if(stristr($html, $string) === FALSE) {
			//			echo 'No existe show list';
			//			return;
			//}
			
			//search for filters
			$links_array = array();
			
			//-- rellenamos links_array con los links asociados 
			// a cada entrada de la clasificación alfabetica de series --//
			//-- para las series que empiezan por A sería /lista_series/A 
			// para las que empiezan con B /lista_series/B etc...--//
			
			$classname="dictionary";
			$classnamelist="dictionary-list";
			$html=$this->getPage('http://'.$url);
			$doc = new DOMDocument();

			@$doc->loadHTML($html);

			//-- los diferentes links para obtener las listas de series que empiezan 
			// por cada una de las letras se encuentran en el elemento filters de la pagina principal--//
			$nodes_dictionary=$doc->getElementById( "filters" );
			if ($nodes_dictionary == NULL)
			{
				echo "no hay indice de series";
				return;
			}

			//-- Recorremos dicho elemento (filters) y rellenamos  el array con los links--//
			
			$childNodes = $nodes_dictionary->childNodes;
			
			$nueva_pagina = "";
			for ($i = 1; $i < $childNodes->length; $i++) 
			{
				$node_dict = $childNodes->item($i);
				if ($node_dict->nodeType == XML_TEXT_NODE) 
				{
					//-- los nodos tipo texto los obviamos, ahora se muestran pero solo por saber que tienen--//
					echo $this->printDomElement($node_dict);
				}
				else
				{
					$link = $node_dict->childNodes->item(0);
					//echo $this->printDomElement($link);
					//-- En el atributo href del item 0 de los nodos hijos del filters tenemos el link --//
					$dir=$link->getAttribute('href');
					array_push($links_array, $dir);
					
				}
	
			} 
						

			//-- Recorremos los diferentes links y vamos obteniendo la lista de series para cada letra del alfabeto --//
			for ($j=0;$j<count($links_array);$j++)
			{
				echo "<BR>".'http://'.$url.$links_array[$j]."<BR>";
				$html_new=$this->getPage('http://'.$url.$links_array[$j]);
				$doc_new = new DOMDocument();
				@$doc_new->loadHTML($html_new);	
				
				//-- El elemento que contiene la lista de series para la letra que se está procesando es list-container --//
				$list_series=$doc_new->getElementById( "list-container" );
				
				if ($list_series == NULL)
				{
					echo "no hay ";
					return;
				}
			
				$childNodes = $list_series->childNodes;
			
				for ($k = 1; $k < $childNodes->length; $k++) 
				{
					$node_dict = $childNodes->item($k);
					if ($node_dict->nodeType <> XML_TEXT_NODE) 
					{	
						echo $this->printDomElement($node_dict). "<BR>";
						
						// el item 0 es un texto no un nodo
						$link = $node_dict->childNodes->item(1);
						
						$serie_link=$link->getAttribute('href');
						$serie_name=$link->getAttribute('title');
						
					}
			    }
				
			
			}
				
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
