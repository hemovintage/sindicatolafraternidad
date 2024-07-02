<?
/*  Funciones utiles */

function ld($var){
    $html  = '<div onclick="$(\'#debugger\').toggle()">(+)</div>';
    $html .= '<pre id="debugger" style="display:none;width:520px;">';
    $html .= print_r($var,true);
    $html .= '</pre>';

    return $html;
}

function format_size($size, $round = 0) {
    $sizes = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    for ($i=0; $size > 1024 && $i < count($sizes) - 1; $i++) $size /= 1024;
    return round($size,$round). " " . $sizes[$i];
} 

function getExtension($ft) {
	return substr($ft,strpos($ft,".")+1,4);
}

function phpDateToMySQL($fecha) {
	if($fecha != '') {
		$diafinal = substr($fecha,0,2);
		$mesfinal = substr($fecha,3,2);
		$anofinal = substr($fecha,6,4);				
		
		$fechafinal = $anofinal . "-" . $mesfinal . "-" . $diafinal;
	} else {
		$fechafinal = '';
	}
			
	return $fechafinal;
}

function mySQLdateToPhp($fecha) {
	if($fecha != '') {
			$diafinal = substr($fecha,8,2);
			$mesfinal = substr($fecha,5,2);
			$anofinal = substr($fecha,0,4);				
			$fechafinal = $diafinal . "-" . $mesfinal . "-" . $anofinal;
	} 
	else 	$fechafinal = '';
	
	return $fechafinal;
}

function convierteMeses($mes) {
	switch($mes) {
		case "January": 	case "1" : 		case "01" : $mes = "Enero"; break;
		case "February": 	case "2": 		case "02" : $mes = "Febrero"; break;
		case "March":		case "3" : 		case "03" : $mes = "Marzo"; break;
		case "April":		case "4" : 		case "04" : $mes = "Abril"; break;
		case "May":			case "5" : 		case "05" : $mes = "Mayo"; break;
		case "June":		case "6" : 		case "06" : $mes = "Junio"; break;
		case "July":		case "7" : 		case "07" : $mes = "Julio"; break;		
		case "August":		case "8" : 		case "08" : $mes = "Agosto"; break;				
		case "September":	case "9" : 		case "09" : $mes = "Septiembre"; break;				
		case "October":		case "10" : 	case "10" : $mes = "Octubre"; break;				
		case "November":	case "11" : 	case "11" : $mes = "Noviembre"; break;		
		case "December":	case "12" : 	case "12" : $mes = "Diciembre"; break;												
	}
	
	return $mes;
}

function convierteDias($dia) {
	switch($dia) {
		case "sunday" : $dia = "Domingo"; break;
		case "monday" : $dia = "Lunes"; break;
		case "tuesday" : $dia = "Martes"; break;
		case "wednesday" : $dia = "Miercoles"; break;
		case "thursday" : $dia = "Jueves"; break;
		case "friday" : $dia = "Viernes"; break;
		case "saturday" : $dia = "Sabado"; break;		
	}
	
	return $dia;
}

function limit_string($cadena,$limite)
{
   if (strlen($cadena) > $limite)
	{
		$cadena = explode('<rup>',wordwrap( $cadena, $limite,'<rup>'));
	    return $cadena[0]." ...";
	}
	else return $cadena;
}


function encrypt($string, $key) { 
	$result = ''; 
	for($i=0; $i<strlen($string); $i++) { 
		$char = substr($string, $i, 1); 
		$keychar = substr($key, ($i % strlen($key))-64, 1); 
		$char = chr(ord($char)+ord($keychar)); 
		$result.=$char; 
	} 

	return base64_encode($result); 
}

function decrypt($string, $key) { 
	$result = ''; 
	$string = base64_decode($string); 

	for($i=0; $i<strlen($string); $i++) { 
		$char = substr($string, $i, 1); 
		$keychar = substr($key, ($i % strlen($key))-64, 1); 
		$char = chr(ord($char)-ord($keychar)); 
		$result.=$char; 
	} 
	return $result; 
}

function getURLSeo($str) {
	$arrAcento = array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ","ü"); 
	$arrSinAcento = array("a","e","i","o","u","n","A","E","I","O","U","N","u");

	$str = str_replace($arrAcento,$arrSinAcento,$str);
	return strtr( preg_replace("/[^A-Za-z\d\_\-\ ]/i","",$str) ," ", "-" );
}

function removetildes($str){
	$arrAcento = array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ","ü"); 
	$arrSinAcento = array("a","e","i","o","u","n","A","E","I","O","U","N","u");

	$str = str_replace($arrAcento,$arrSinAcento,utf8_decode($str)); //str_replace no entiende utf8 y no tenemos mbstring

	return utf8_encode($str);
}

function resize($img,$maxWidth,$maxHeight, $newfilename,$extension){ 

    list($oWidth,$oHeight,$image_type) = getimagesize($img);
    
	 if($oHeight>$oWidth){
	 	$thumb_height=$maxHeight;
		$thumb_width=round(($thumb_height*$oWidth)/$oHeight);
	 }else{
	 	$thumb_width=$maxWidth;
		$thumb_height=round(($thumb_width*$oHeight)/$oWidth);
	 }
	 
    switch($image_type){
        case 1: $im = imagecreatefromgif($img); 	break;
        case 2: $im = imagecreatefromjpeg($img);  	break;
        case 3: $im = imagecreatefrompng($img); 	break;
    }
    
    $newImg = imagecreatetruecolor($thumb_width, $thumb_height);
    
    if(($image_type==1) || ($image_type==3)){
        imagealphablending($newImg, false);
        imagesavealpha($newImg,true);
        $transparent=imagecolorallocatealpha($newImg,255,255,255,127);
        imagefilledrectangle($newImg,0,0,$thumb_width,$thumb_height,$transparent);
    }
	 
    imagecopyresampled($newImg,$im,0,0,0,0,$thumb_width,$thumb_height,$oWidth,$oHeight);
    
    switch ($image_type){
        case 1: imagegif ($newImg,$newfilename,100); break;
        case 2: imagejpeg($newImg,$newfilename,100); break;
        case 3: imagepng ($newImg,$newfilename,100); break;
    }
	 
    return $newfilename;
}

function clearString($str) {
	for ($i = 0; $i <= strlen($str); $i++) {
		$c = substr($str, $i, 1); $a = ord($c);
		if (($a >= 65 and $a <= 90) or ($a >= 97 and $a <= 122) or $a == 32 or is_numeric($c)) $r .= $c;
	}
	return $r;
}

/* funciones utiles para paypal */

function parsePayPalResponse($response)
{
	$newdata = array();
	
	if(!empty($response))
	{
		$rlines = explode('&',$response);
		
		foreach($rlines as $rline)
		{
			$rvals = explode('=',$rline);
			
			if(count($rvals) == 2)
			{
				$newdata[rawurldecode($rvals[0])] = rawurldecode($rvals[1]);
			}
		}
	}
	
	return $newdata;
}

/* funciones de proceso descarga */ 

function createBuyMeLink($ip,$pid,$uid,$isbn)
{
	return PATH_CMS.'/ws/buyMe.php?user='.CMS_USER.'&password='.CMS_PASW.'&ip='.$ip.'&contentId='.$pid.'&userId='.$uid.'&isrc='.$isbn.'&typeLink=movie';			
}

function createGetMeLink($id,$filename,$size)
{
	return PATH_CMS.'/ws/getMe.php?buyId='.$id.'&name='.$filename.'&size='.$size;
}

function formatTrackName($str) 
{
	$arrAcento = array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ","ü","Ü","'",'"'); 
	$arrSinAcento = array("a","e","i","o","u","n","A","E","I","O","U","N","u","U"," "," ");
	$str = str_replace($arrAcento,$arrSinAcento,$str);
    $str = substr($str,0,120);	
	return strtr(preg_replace("/[^A-Za-z\d\_\-\ ]/i","",$str) ," ", "_" );
}

function formatPriceCaption($pricenumber,$pricecaption)
{
	if($pricenumber > 0)
	{
		$str = '$'.$pricecaption;
	}
	else
	{
		$str = 'Gratis';
	}
	
	return $str;
}


function object2array($object) { 
		if (is_array($object)){ 
			foreach($object as $key => $value) {
				$return[$key] = object2array($value);
			}
		} else { 
			if(is_string($object)){
				$var = $object;
				$return=$object;
			}else{
				$var = @get_object_vars($object);
				if ($var){
					foreach($var as $key => $value){
		            	$return[$key] = ($key && !$value) ? NULL: object2array($value);
		            }
				}	
			}
		}
		return ($return) ? $return:null;
}

function buildDownloadButton($thisformat,$thislink)
{
	$str = '';
	
	if(!empty($thislink))
	{	
		switch($thisformat)
		{
			case 'pdf':
				$str = '<li><a href="'.$thislink.'">Archivo PDF</a></li>';
				break;
				
			case 'epub':
				$str = '<li><a href="'.$thislink.'">Archivo EPUB</a></li>';
				break;
				
			case 'mp3':
				$str = '<li><a href="'.$thislink.'">Archivo MP3</a></li>';
				break;
				
			case 'wma':
				$str = '<li><a href="'.$thislink.'">Archivo WMA</a></li>';
				break;
		}
	}
	
	return $str;
}

function buildLinkDisp($thisformat)
{
	$str = '';
	
	switch($thisformat)
	{
		case 'pdf':
			$str = '<a href="javascript:void(0);" style="cursor:default;" class="formato-pdf">PDF</a>';
			break;
			
		case 'epub':
			$str = '<a href="javascript:void(0);" style="cursor:default;" class="formato-epub">EPUB</a>';
			break;
			
		case 'mp3':
			$str = '<a href="javascript:void(0);" style="cursor:default;" class="formato-mp3">MP3</a>';		
			break;
			
		case 'wma':
			$str = '<a href="javascript:void(0);" style="cursor:default;" class="formato-wma">WMA</a>';
			break;
	}
	
	return $str;
}
?>