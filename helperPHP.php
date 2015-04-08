<?php
if(!function_exists('isValidIP')){
	function isValidIP($ip){
		if(filter_var($ip, FILTER_VALIDATE_IP))
			return true;
		else
			return false;
	}
}

if(!function_exists('isDevelopment')){
	function isDevelopment(){
		$serverName = $_SERVER['SERVER_NAME'];
		if($serverName==="localhost" || isValidIP($serverName))
			return true;
		else
			return false;
	}
}

if(!function_exists('uasortCallback')){
	function uasortCallback($name1,$name2){
		$patterns = array(
			'a' => '(á|à|â|ä|Á|À|Â|Ä)',
			'e' => '(é|è|ê|ë|É|È|Ê|Ë)',
			'i' => '(í|ì|î|ï|Í|Ì|Î|Ï)',
			'o' => '(ó|ò|ô|ö|Ó|Ò|Ô|Ö)',
			'u' => '(ú|ù|û|ü|Ú|Ù|Û|Ü)',
			'n' => '(ñ|Ñ)'
			);          
		$name1 = preg_replace(array_values($patterns), array_keys($patterns), $name1['name']);
		$name2  = preg_replace(array_values($patterns), array_keys($patterns), $name2['name']);
		return strcasecmp($name1, $name2);
	}
}

if(!function_exists('textCut')){
	function textCut($text,$long=25){
		if(strlen($text) < $long){
			return $text;
		}else{
			return mb_substr($text,0,$long)."...";
		}	
	}
}

if(!function_exists('removeComments')){
	function removeComments($text){
		$text = str_replace('<!--','',$text);
		$text = str_replace('&lt;!--','',$text);
		$text = str_replace('-->','',$text);
		$text = str_replace('--&gt;','',$text);
		$text 	=preg_replace('/\n{2,}/',''.PHP_EOL,$text);
		return $text;
	}
}

if(!function_exists('cleanUTF8')){
	function cleanUTF8($string){

		$string = trim($string);

		$string = str_replace(
			array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
			$string
			);

		$string = str_replace(
			array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
			$string
			);

		$string = str_replace(
			array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
			$string
			);

		$string = str_replace(
			array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
			$string
			);

		$string = str_replace(
			array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
			$string
			);

		$string = str_replace(
			array('ñ', 'Ñ', 'ç', 'Ç'),
			array('n', 'N', 'c', 'C',),
			$string
			);

		$string = str_replace(
			array("\\", "¨", "º", "-", "~",
				"#", "@", "|", "!", "\"",
				"·", "$", "%", "&", "/",
				"(", ")", "?", "'", "¡",
				"¿", "[", "^", "`", "]",
				"+", "}", "{", "¨", "´",
				">", "< ", ";", ",", ":",
				".", " "),
			'',
			$string
			);


		return $string;
	}
}

if(!function_exists('cleanAll')){
	function cleanAll($texto){
		$texto = str_replace("¿","",$texto);
		$texto = str_replace("¡","",$texto);
		$texto = str_replace("-","",$texto);
		$texto = str_replace("–","",$texto);
		$texto = str_replace("—","",$texto);
		
		$texto= preg_replace("/[^\w ÀÁÂÃÄÅĀĄĂÆÇĆČĈĊĎĐÈÉÊËĒĘĚĔĖĜĞĠĢĤĦÌÍÎÏĪĨĬĮİĲĴĶŁĽĹĻĿÑŃŇŅŊÒÓÔÕÖØŌŐŎŒŔŘŖŚŠŞŜȘŤŢŦȚÙÚÛÜŪŮŰŬŨŲŴÝŶŸŹŽŻàáâãäåæçèéêëìíîïñòóôõöøùúûüýÿœšß]/","",$texto);
		$texto = str_replace(" ","",$texto);
		return $texto;
	}
}

if(!function_exists('setDateSpanish')){
	function setDateSpanish($EnglishDate){
		return date("d-m-Y",strtotime($EnglishDate));
	}
}
if(!function_exists('resizeImage')){
	function resizeImage($ruta1,$ruta2,$ancho,$alto) 
	{ 
    # se obtene la dimension y tipo de imagen 
		$datos=getimagesize ($ruta1); 

    $ancho_orig = $datos[0]; # Anchura de la imagen original 
    $alto_orig = $datos[1];    # Altura de la imagen original 
    $tipo = $datos[2]; 

    if ($tipo==1){ # GIF 
    	if (function_exists("imagecreatefromgif")) 
    		$img = imagecreatefromgif($ruta1); 
    	else 
    		return false; 
    } 
    else if ($tipo==2){ # JPG 
    	if (function_exists("imagecreatefromjpeg")) 
    		$img = imagecreatefromjpeg($ruta1); 
    	else 
    		return false; 
    } 
    else if ($tipo==3){ # PNG 
    	if (function_exists("imagecreatefrompng")) 
    		$img = imagecreatefrompng($ruta1); 
    	else 
    		return false; 
    } 

    # Se calculan las nuevas dimensiones de la imagen 
    if ($ancho_orig>$alto_orig) 
    { 
    	$ancho_dest=$ancho; 
    	$alto_dest=($ancho_dest/$ancho_orig)*$alto_orig; 
    } 
    else 
    { 
    	$alto_dest=$alto; 
    	$ancho_dest=($alto_dest/$alto_orig)*$ancho_orig; 
    } 

    // imagecreatetruecolor, solo estan en G.D. 2.0.1 con PHP 4.0.6+ 
    $img2=@imagecreatetruecolor($ancho_dest,$alto_dest) or $img2=imagecreate($ancho_dest,$alto_dest); 

    // Redimensionar 
    // imagecopyresampled, solo estan en G.D. 2.0.1 con PHP 4.0.6+ 
    @imagecopyresampled($img2,$img,0,0,0,0,$ancho_dest,$alto_dest,$ancho_orig,$alto_orig) or imagecopyresized($img2,$img,0,0,0,0,$ancho_dest,$alto_dest,$ancho_orig,$alto_orig); 

    // Crear fichero nuevo, según extensión. 
    if ($tipo==1) // GIF 
    if (function_exists("imagegif")) 
    	imagegif($img2, $ruta2); 
    else 
    	return false; 

    if ($tipo==2) // JPG 
    if (function_exists("imagejpeg")) 
    	imagejpeg($img2, $ruta2); 
    else 
    	return false; 

    if ($tipo==3)  // PNG 
    if (function_exists("imagepng")) 
    	imagepng($img2, $ruta2); 
    else 
    	return false; 

    return true; 
}
}

/*Fin del archivo*/