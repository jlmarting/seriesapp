14/05/2013
Se ha modificado index.php para recogida de par�metros por URL cuando existan.  Esto puede ser �til
en el caso de usar links que quieran invocar una task del controlador.
Se ha corregido la funci�n seriesList. Ahora los enlaces indican task y par�metro (url de la serie). 
Se ha implementado la vista de seriesList como un listado ordenado. Los �ltimos enlaces fallan dado que requieren
un tratamiento especial, pero en general el resultado es correcto.
Se ha dejado planteada la task chapterList. Ahora mismo s�lo indica que est� por implementar y muestra los par�metros 
enviados (una url)
En el controlador se ha implementado un m�todo m�s, param, que sirve para asignar un valor a la propiedad param.
Esto es �til para almacenar en el objeto par�metros que puedan ser usados por ciertas task.
Se ha implementado parcialmente el control, modelo y vista de chapterList. Por el momento se visualiza el html
extraído de series yonkis. Se debe seguir trabajando en ella para integrarla adecuadamente en MVC.
Se ha incluido task y vista player, para la reproducción de vídeo. Todavía por implementar.


12/05/2013
Se ha reorganizado el código siguiendo el patrón MVC. De esta forma
se diferencia entre el modelo, las vistas y el control, permitiendo tener 
más orden en el desarrollo.
También se han eliminado ficheros innecesarios.
En cada uno de los ficheros se explica la idea de cada uno, pero de forma
básica podría resumirse así:

index.php 
es el punto de entrada, "activa" el controlador.

seriesMaster.php
se sirve de la lógica del modelo para mostrar las vistas con la informaci�n pertinente.

seriesMaster.php
implementa métodos de análisis de DOM, de generación y selección de datos y cualquier función de proceso que se pudiera necesitar.

seriesView.php
se recogen las vistas de la aplicación. Todo lo que signifique mostrar información se implementa aquí. También se recoge en cada vista la posible información a pasar a otras etapas.

El planteamiento es bastante aproximado y se iré puliendo, pero permite separar el desarrollo e incorporar fácilmente cualquier código en el sitio adecuado.


10/05/2013
Estos son los ficheros basicos de esta nueva version
index.html y seriesApp.js son la parte del cliente.
index.html da la estructura, y seriesApp.js tiene como mision modificar este
documento.
seriesMaster.php tiene que resolver los problemas de comunicacion con el
servidor de series, captar el DOM, extraer informacion, para pasarla a la
parte del cliente. Tambien podria generar el codigo para el player, etc.
Cualquier critica, sugerencia, aportacion, modificacion, sera bienvenida. Yo
diria que incluso aplaudida y todo, fijate... ;)
