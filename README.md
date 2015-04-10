# helperPHP
helperPHP provee de algunas de las funciones comumente utilizadas para el desarrollo de proyectos PHP, que permiten facilitar el trabajo.

***
## ¿Como utilizar?
Muy Simple, solo basta importar el archivo de helperPHP en tu archivo php.
´´´
<?php include('helperPHP.php');?>
´´´

***
## Funciones y metodos incluidas
+ isValidIP
+ isDevelopment
+ uasortCallback
+ textCut
+ removeComments
+ cleanUTF8
+ cleanAll
+ setDateSpanish
+ resizeImage
+ isImage
+ isThumbail
+ get_thumb_name
+ get_nothumb_name

***
## Documentación
***
### isValidIP
Verifica si la ip ingresada es valida o no.

#### isValidIP - Parámetros
+ ip - string - Corresponde a la dirección ip a validar en formato xxx.xxx.xxx.xxx

#### isValidIP - return
+ boolean

#### Utilización
```
<?php 
	$ip = '127.0.0.1';
	if(!isValidIP($ip)){
		die('ip no valida');
	}
 ?>
```
***
### isDevelopment
Verifica el ambiente en el cual se encuentra, desarrollo o producción. Basandose en el servername donde se ejecuta la aplicación retorna true en caso de encontrarse en lo definido como desarrollo y false en caso de encontrarse en lo definido como producción. Además define una constante denominada ENVIRONMENT.

#### isDevelopment - Parámetros
+ productionName (opcional) - string - corresponde al dominio en el cual se encuentra el ambiente de producción

#### isDevelopment - return
+ boolean
+ constante -> define una constante llamada ENVIRONMENT con los valores (production || development) respectivamente.

#### Utilización
```
<?php 
	if(isDevelopment()){
		echo "ambiente de ".ENVIRONMENT;
	}else{
		echo "ambiente de ".ENVIRONMENT;
	}
 ?>
```
Utilizando parámetro 'productionName'
```
<?php 
	$productionName = 'misitio';//no incluye extensión del dominio (.com|.cl|etc) o en su defecto dirección ip
	if(isDevelopment($productionName)){
		echo "estas en el ambiente de ".ENVIRONMENT;
	}else{
		echo "estas en el ambiente de ".ENVIRONMENT;
	}
 ?>
```
***
### textCut
Corta un texto hasta un largo determinado (por defecto 25 caracteres) añadiendo puntos suspensivos al final del corte.

#### textCut - Parámetros
+ text - string - corresponde al texto que desea cortar.
+ long (opcional) - int - largo de caracteres para cortar el texto. Por defecto 25 caracteres.

#### textCut - return
+ string - texto cortado con puntos suspensivos al final.

#### Utilización
```
<?php 
	$textoOriginal	=	"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.";
	$textoCortado	=	textCut($textoOriginal);
	echo $textoCortado;
	//Salida = Lorem ipsum dolor sit ame...
 ?>
```
Utilizando parámetro 'long'
```
<?php 
	$textoOriginal	=	"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.";
	$textoCortado	=	textCut($textoOriginal,10);
	echo $textoCortado;
	//Salida = Lorem ipsu...
 ?>
```
***
### removeComments
Remueve los comentarios html de un texto, retonando el texto sin los comentarios.

#### removeComments - Parámetros
+ text - string - corresponde al texto que desea limpiar.

#### removeComments - return
+ string - texto limpio.

#### Utilización
```
<?php 
	$textoOriginal	=	"<!--Lorem ipsum dolor sit amet,--> consectetuer adipiscing elit. Aenean commodo ligula eget dolor.";
	$textoLimpio	=	removeComments($textoOriginal);
	echo $textoLimpio;
	//Salida = Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
?>
```
***
### cleanUTF8
limpia los caracteres UTF-8 retonando la cadena sin caracteres UTF-8

#### cleanUTF8 - Parámetros
+ text - string - corresponde al texto que desea limpiar.

#### cleanUTF8 - return
+ string - texto limpio.

#### Utilización
```
<?php 
	$textoOriginal	=	"Los procesos ágiles promueven el desarrollo sostenible. Añadiendo un ritmo constante de mejora.";
	$textoLimpio	=	cleanUTF8($textoOriginal);
	echo $textoLimpio;
	//Salida = Los procesos agiles promueven el desarrollo sostenible. Anadiendo un ritmo constante de mejora.
?>
```
***
### setDateSpanish
Transforma la fecha de formato ingles (Y-m-d) a formato español (d-m-Y);

#### setDateSpanish - Parámetros
+ EnglishDate - date - corresponde a la fecha a transformar.
+ separator (opcional) - string - corresponde al separador de fecha por defecto es - .

#### setDateSpanish - return
+ string - fecha en español.

#### Utilización
```
<?php 
	$fechaIngles	= "2015-11-20";
	$fechaEspanol	=	setDateSpanish($fechaIngles);
	echo $fechaEspanol;
	//Salida = 20-11-2015
?>
```
Utilizando parámetro separator
```
<?php 
	$fechaIngles	= "2015-11-20";
	$fechaEspanol	=	setDateSpanish($fechaIngles,"/");
	echo $fechaEspanol;
	//Salida = 20/11/2015
?>
```
***
### getDay
Obtiene el día de la semana de una fecha.

#### getDay - Parámetros
+ date - date - corresponde a la fecha.

#### getDay - return
+ string - día de la semana.

#### Utilización
```
<?php 
	$fecha	= "2015-04-10";
	$dia	=	getDay($fecha);
	echo $dia;
	//Salida = Viernes
?>
```
***
### isValidDate
Verifica si es una fecha Valida.

#### isValidDate - Parámetros
+ date - date - corresponde a la fecha a validar.

#### isValidDate - return
+ boolean

#### Utilización
```
<?php 
	$fecha	= "2015-04-10";
	$dia	=	isValidDate($fecha);
	echo $dia;
?>
```
***
### dateDiff
Calcula los dias de diferencia entre 2 fechas.

#### dateDiff - Parámetros
+ date1 - string(date) - corresponde a la fecha 1.
+ date2 - string(date) - corresponde a la fecha 2.

#### dateDiff - return
+ int - dias de diferencia

#### Utilización
```
<?php 
	$fecha1	= "2015-11-20";
	$fecha2	= "2015-11-14";
	$diferencia	=	dateDiff($fecha1,$fecha2);
	echo $diferencia;
	//Salida : 6
?>
```
***
### numberToText
Converte un número a texto.

#### numberToText - Parámetros
+ number - string(int) - corresponde al número a convertir.

#### numberToText - return
+ string - Número en palabras

#### Utilización
```
<?php 
	$numero	= "127.365";
	$numeroPalabras	=	numberToText($numero);
	echo $numeroPalabras;
	//Salida : ciento veinti y siete mil trecientos sesenta y cinco
?>
```
***
### resizeImage
Redimensiona una imagen a las medidas indicadas

#### resizeImage - Parámetros
+ ruta1 - string - corresponde a la ruta y nombre de la imagen a redimensionar.
+ ruta2 - string - Corresponde a la ruta y nombre de destino de la neuva imagen.
+ ancho - int - Corresponde al ancho de la nueva imagen en pixeles.
+ alto  - int - corresponde al alto de la nueva imagen en pixeles.

#### resizeImage - return
+ boolean

#### Utilización
```
<?php 
	$imgOriginal	= "../img/nuestrafoto.png";
	$imgModificada	= "../img/nuestrafoto_thumb.png";
	if(resizeImage($imgOriginal,$imgModificada,150,150)){
		echo "Imagen redimensionada";
	}else{
		echo "Error al redimensionar";
	}
	
?>
```
***
### isImage
Verifica si la extensión de un  archivo corresponde a una imagen.

#### isImage - Parámetros
+ filename - string - Nombre del archivo.

#### isImage - return
+ boolean

#### Utilización
```
<?php 
	$archivo1	= "nuestrafoto.png";
	$archivo2	= "nuestrotexto.txt";
	if(isImage($archivo2)){
		echo "Es una imagen!";
	}else{
		echo "No es una imagen :(";
	}
	//salida : Es una imagen!
	if(isImage($archivo1)){
		echo "Es una imagen!";
	}else{
		echo "No es una imagen :(";
	}
	//salida : No es una imagen :(
?>
```
***
### isThumbnail
Verifica si la extensión de un  archivo corresponde a una imagen.

#### isThumbnail - Parámetros
+ filename - string - Nombre del archivo.
+ thumbExt (opcional) - string - sufijo utilizado para los thumbnail. Por defecto _thumb.

#### isThumbnail - return
+ boolean

#### Utilización
```
<?php 
	$archivo1	= "nuestrafoto.png";
	$archivo2	= "nuestrafoto_thumb.png";
	if(isThumbnail($archivo1)){
		echo "Es un Thumbnail!";
	}else{
		echo "No es un Thumbnail :(";
	}
	//salida : No es un Thumbnail :(

	if(isThumbnail($archivo2)){
		echo "Es un Thumbnail!";
	}else{
		echo "No es un Thumbnail :(";
	}
	//salida : Es un Thumbnail!
?>
```
***
### get_thumb_name
Obtiene el nombre del thumbnail en base al nombre de la imagen original

#### get_thumb_name - Parámetros
+ filename - string - Nombre del archivo.
+ thumbExt (opcional) - string - sufijo utilizado para los thumbnail. Por defecto _thumb.

#### get_thumb_name - return
+ string - nombre del archivo thumbnail.

#### Utilización
```
<?php 
	$archivo1	= "nuestrafoto.png";
	
	$archivoThumb =	get_thumb_name($archivo1);
	echo $archivoThumb;
	//salida : nuestrafoto_thumb.png
?>
```
Utilizando parámetro thumbExt
```
<?php 
	$archivo1	= "nuestrafoto.png";

	$archivoThumb =	get_thumb_name($archivo1,"_mini");
	echo $archivoThumb;
	//salida : nuestrafoto_mini.png
?>
```
***
### get_nothumb_name
Obtiene el nombre del archivo original de un archivo thumbnail.

#### get_nothumb_name - Parámetros
+ filename - string - Nombre del archivo.
+ thumbExt (opcional) - string - sufijo utilizado para los thumbnail. Por defecto _thumb.

#### get_nothumb_name - return
+ string - nombre del archivo original.

#### Utilización
```
<?php 
	$archivo1	= "nuestrafoto_thumb.png";
	
	$archivoThumb =	get_nothumb_name($archivo1);
	echo $archivoThumb;
	//salida : nuestrafoto.png
?>
```
Utilizando parámetro thumbExt
```
<?php 
	$archivo1	= "nuestrafoto_mini.png";

	$archivoThumb =	get_nothumb_name($archivo1,"_mini");
	echo $archivoThumb;
	//salida : nuestrafoto.png
?>
```
***
### isValidEmail
Obtiene el nombre del archivo original de un archivo thumbnail.

#### isValidEmail - Parámetros
+ email - string - email a validar.

#### isValidEmail - return
+ Boolean

#### Utilización
```
<?php 
	$email	= "hola@correo.cl";
	
	if(isValidEmail($email)){
		echo "Es valido!";
	}
?>
```