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
	function isDevelopment($productionName=null){
		$serverName = $_SERVER['SERVER_NAME'];
		
		if($productionName!=null && $productionName === $serverName){
			define('ENVIRONMENT','production');
			return false;	
		}

		if($serverName==="localhost" || isValidIP($serverName)){
			define('ENVIRONMENT','development');
			return true;
		}else{
			define('ENVIRONMENT','production');
			return false;
		}
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
		$text = preg_replace('/\n{2,}/',''.PHP_EOL,$text);
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
		
		$texto = preg_replace("/[^\w ÀÁÂÃÄÅĀĄĂÆÇĆČĈĊĎĐÈÉÊËĒĘĚĔĖĜĞĠĢĤĦÌÍÎÏĪĨĬĮİĲĴĶŁĽĹĻĿÑŃŇŅŊÒÓÔÕÖØŌŐŎŒŔŘŖŚŠŞŜȘŤŢŦȚÙÚÛÜŪŮŰŬŨŲŴÝŶŸŹŽŻàáâãäåæçèéêëìíîïñòóôõöøùúûüýÿœšß]/","",$texto);
		$texto = str_replace(" ","",$texto);
		return $texto;
	}
}

if(!function_exists('setDateSpanish')){
	function setDateSpanish($EnglishDate,$separator="-"){
		return date("d".$separator."m".$separator."Y",strtotime($EnglishDate));
	}
}

if(!function_exists('getDay')){
	function getDay($date){
		$dias = array(1=>'Lunes',2=>'Martes',3=>'Miercoles',4=>'Jueves',5=>'Viernes',6=>'Sabado',7=>'Domingo');
		return $dias[date('N', strtotime(date($fecha)))];
	}
}

if(!function_exists('isValidDate')){
	function isValidDate($value, $format = 'dd.mm.yyyy'){ 
		if(strlen($value) >= 6 && strlen($format) == 10){ 

			$separator_only = str_replace(array('m','d','y'),'', $format); 
			$separator = $separator_only[0];

			if($separator && strlen($separator_only) == 2){ 
				$regexp = str_replace('mm', '(0?[1-9]|1[0-2])', $format); 
				$regexp = str_replace('dd', '(0?[1-9]|[1-2][0-9]|3[0-1])', $regexp); 
				$regexp = str_replace('yyyy', '(19|20)?[0-9][0-9]', $regexp); 
				$regexp = str_replace($separator, "\\" . $separator, $regexp); 
				if($regexp != $value && preg_match('/'.$regexp.'\z/', $value)){ 

					$arr=explode($separator,$value); 
					$day=$arr[0]; 
					$month=$arr[1]; 
					$year=$arr[2]; 
					if(@checkdate($month, $day, $year)) 
						return true; 
				} 
			} 
		} 
		return false; 
	}
}

if(!function_exists('dateDiff')){
	function dateDiff($date1, $date2){
		$year1	=	date('Y',strtotime($date1));
		$month1	=	date('m',strtotime($date1));
		$day1	=	date('d',strtotime($date1));

		$year2	=	date('Y',strtotime($date2));
		$month2	=	date('m',strtotime($date2));
		$day2	=	date('d',strtotime($date2));

		//calculo timestam de las dos fechas 
		$timestamp1 = mktime(0,0,0,$month1,$day1,$year1);
		$timestamp2 = mktime(4,12,0,$month2,$day2,$year2);

		//resto a una fecha la otra 
		$segundos_diferencia = $timestamp1 - $timestamp2;

		$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
		$dias_diferencia = abs($dias_diferencia);
		$dias_diferencia = round($dias_diferencia);

		return $dias_diferencia;
	}
}

if(!function_exists('numberToText')){
	function numberToText($number) { 
		// Primero tomamos el numero y le quitamos los caracteres especiales y extras 
		// Dejando solamente el punto "." que separa los decimales 
		// Si encuentra mas de un punto, devuelve error. 
		// NOTA: Para los paises en que el punto y la coma se usan de forma 
		// inversa, solo hay que cambiar la coma por punto en el array de "extras" 
		// y el punto por coma en el explode de $partes 

		$extras= array("/[\$]/","/ /","/,/","/-/"); 
		$limpio=preg_replace($extras,"",$number); 
		$partes=explode(".",$limpio); 
		if (count($partes)>2) { 
			return "Error, el n&uacute;mero no es correcto";
			exit(); 
		} 

		// Ahora explotamos la parte del numero en elementos de un array que 
		// llamaremos $digitos, y contamos los grupos de tres digitos 
		// resultantes 

		$digitos_piezas=chunk_split ($partes[0],1,"#"); 
		$digitos_piezas=substr($digitos_piezas,0,strlen($digitos_piezas)-1); 
		$digitos=explode("#",$digitos_piezas); 
		$todos=count($digitos); 
		$grupos=ceil (count($digitos)/3); 

		// comenzamos a dar formato a cada grupo 

		$unidad = array   ('un','dos','tres','cuatro','cinco','seis','siete','ocho','nueve'); 
		$decenas = array ('diez','once','doce', 'trece','catorce','quince'); 
		$decena = array   ('dieci','veinti','treinta','cuarenta','cincuenta','sesenta','setenta','ochenta','noventa'); 
		$centena = array   ('ciento','doscientos','trescientos','cuatrocientos','quinientos','seiscientos','setecientos','ochocientos','novecientos'); 
		$resto=$todos; 

		for ($i=1; $i<=$grupos; $i++) { 

			// Hacemos el grupo 
			if ($resto>=3) {
				$corte=3;
			} else {
				$corte=$resto;
			}

			$offset=(($i*3)-3)+$corte; 
			$offset=$offset*(-1); 

			// la siguiente seccion es una adaptacion de la contribucion de cofyman y JavierB 

			$num=implode("",array_slice ($digitos,$offset,$corte)); 
			$resultado[$i] = ""; 
			$cen = (int) ($num / 100);              //Cifra de las centenas 
			$doble = $num - ($cen*100);             //Cifras de las decenas y unidades 
			$dec = (int)($num / 10) - ($cen*10);    //Cifra de las decenas 
			$uni = $num - ($dec*10) - ($cen*100);   //Cifra de las unidades 
			if ($cen > 0) { 
				if ($num == 100) $resultado[$i] = "cien";
				else $resultado[$i] = $centena[$cen-1].' ';
			}//end if 
			if ($doble>0) { 
				if ($doble == 20) {
					$resultado[$i] .= " veinte";
				}elseif (($doble < 16) and ($doble>9)) {
					$resultado[$i] .= $decenas[$doble-10];
				}else {
					$resultado[$i] .=' '. $decena[$dec-1];
				}//end if 
				if ($dec>2 and $uni<>0) $resultado[$i] .=' y ';
				if (($uni>0) and ($doble>15) or ($dec==0)) { 
					if ($i==1 && $uni == 1) $resultado[$i].="uno";
					elseif ($i==2 && $num == 1) $resultado[$i].="";
					else $resultado[$i].=$unidad[$uni-1]; 
			   	}
			}

			// Le agregamos la terminacion del grupo 
	    	switch ($i) { 
				case 2: 
				$resultado[$i].= ($resultado[$i]=="") ? "" : " mil "; 
				break; 
				case 3: 
				$resultado[$i].= ($num==1) ? " millón " : " millones "; 
				break; 
			}
	       $resto-=$corte; 
		}

		// Sacamos el resultado (primero invertimos el array) 
		$resultado_inv= array_reverse($resultado, TRUE); 
		$final=""; 
		foreach ($resultado_inv as $parte){ 
			$final.=$parte; 
		}
		return $final; 
	}
}

if(!function_exists('resizeImage')){
	function resizeImage($ruta1,$ruta2,$ancho,$alto){ 
    	# se obtene la dimension y tipo de imagen 
		$datos	=	getimagesize($ruta1); 

	    $ancho_orig	= $datos[0]; # Anchura de la imagen original 
	    $alto_orig	= $datos[1]; # Altura de la imagen original 
	    $tipo 		= $datos[2]; 

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

if(!function_exists('isImage')){
	function isImage($filename){
		$file_parts = pathinfo($filename);
		
		switch(strtolower($file_parts['extension']))
		{
			case "jpg":
			case "png":
			case "gif":
			return TRUE;
			break;

			default:
			return FALSE;
			break;
		}
	}
}

if(!function_exists('isThumbnail')){
	function isThumbnail($filename,$thumbExt="_thumb"){
		return (strpos($filename,$thumbExt) !== FALSE)?TRUE:FALSE;
	}
}

if(!function_exists('get_thumb_name')){
	function get_thumb_name($filename,$thumbExt="_thumb"){
		$file_parts = pathinfo($filename);
		
		$filename	=	$file_parts['filename'];
		$extension	=	$file_parts['extension'];
		
		return $filename.$thumbExt.$extension;
	}
}

if(!function_exists('get_nothumb_name')){
	function get_nothumb_name($filename,$thumbExt="_thumb"){
		return str_replace($thumbExt,'',$filename);
	}
}

if(!function_exists('isValidEmail')){
	function isValidEmail($email){
		if (function_exists('idn_to_ascii') && $atpos = strpos($email, '@')){
			$email = substr($str, 0, ++$atpos).idn_to_ascii(substr($email, $atpos));
		}

		return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
	}
}

if(!function_exists('encrypt')){
	function encrypt($string, $key) {
		$result = '';
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}
		return base64_encode($result);
	}
}

if(!function_exists('decrypt')){
	function decrypt($string, $key) {
		$result = '';
		$string = base64_decode($string);
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;
	}
}

if(!function_exists('encrypt_url')){
	function encrypt_url($string, $key) {
		$result = '';
		$test = "";
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$test[$char]= ord($char)+ord($keychar);
			$result.=$char;
		}
		return urlencode(base64_encode($result));
	}
}

if(!function_exists('decrypt_url')){
	function decrypt_url($string, $key) {
		$result = '';
		$string = base64_decode(urldecode($string));
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;
	}
}

if(!function_exists('passGenerator')){
	function passGenerator($long){
		$longitudPass=$long;
		$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890{}-.,[]";
		$longitudCadena=strlen($cadena);

		$pass = "";
		
		for($i=1 ; $i<=$longitudPass ; $i++){
			$pos=rand(0,$longitudCadena-1);
			$pass .= substr($cadena,$pos,1);
		}
		return $pass;
	}
}
if (!function_exists('dates_diff')) {
    function dates_diff($date1, $date2, $op = 'd'){
        $datetime1 = new DateTime($date1);
        $datetime2 = new DateTime($date2);

        $interval = $datetime1->diff($datetime2);
        if($op == 'd')
            return $interval->d;
        if($op == 'm')
            return $interval->m;
        if($op == 'y')
            return $interval->y;
    }
}
/*Fin del archivo*/
