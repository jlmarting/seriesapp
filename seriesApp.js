/*************************************************************************************
Estas funciones van a ser seguramente innecesarias, ya que al tener un servidor php
resulta más sencillo que este mismo se encarge de servir nuevas páginas en cada una de 
las fases, en lugar de limitarse a enviar un string con la nueva información
a insertar en el DOM. Además se realizan más llamadas y complica la lógica.
**************************************************************************************/


/**
 * Genera la pantalla de incio
 */
function start(){
	sHtml='<a href="seriesMaster.php?task=serverList">Start</a>';
	$('body').append(sHtml);
}

/**
 * [Ca]
 * Envia una lista de servidores en formato de lista y botones con evento onClick
 */
function serverList(){
	alert("A implementar: la lista deberia venir del php");   
	sHtml = '<a href="seriesMaster.php?task=seriesList">';
	sHtml+= 'Ver capitulos de la serie</a>';
	$('body').append(sHtml);
}

/**
 * Cb
 */
function seriesList() {
	alert("Hay que implementar seriesList");
	sHtml = '<a href="seriesMaster.php?task=chapterList">';
	sHtml+= 'Ver capitulos de la serie</a>';
	$('body').append(sHtml);
}

/**
 * Cc
 */
function chapterList() {
	alert("Hay que implementar chapterList");	
	sHtml = '<a href="seriesMaster.php?task=selectChapter&chapter=0">';
	sHtml+= 'Ver capitulo 0</a>';
	$('body').append(sHtml);
}


/**
 * Cd
 */
function playChapter() {
	alert("Hay que implementar playChapter");
	sHtml = '<a href="seriesMaster.php?task=play&chapter=0">Play</a>';
	$('body').append(sHtml);
}
