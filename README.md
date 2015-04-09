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
Utilizando parametro 'productionName'
```
<?php 
	$productionName = 'misitio';//no incluye extension del dominio (.com|.cl|etc) o en su defecto dirección ip
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
Utilizando parametro 'long'
```
<?php 
	$textoOriginal	=	"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.";
	$textoCortado	=	textCut($textoOriginal,10);
	echo $textoCortado;
	//Salida = Lorem ipsu...
 ?>
```
***