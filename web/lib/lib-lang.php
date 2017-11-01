<?php

 #
 # PHPPortal
 #
 # info: main folder copyright file
 #
 #



function name_to_dir($n){
	$n=str_replace(' ','_',$n);
	$n=str_replace('\'','(',$n);
	return($n);
}



function dir_to_name($n){
	$n=str_replace('_',' ',$n);
	$n=str_replace('(','\'',$n);
	return($n);
}


function normal_dirname($name){
	$v=str_replace('_',' ',$name);
	$v=str_replace('.','\'',$v);
	$v=str_replace('o:','ö',$v);
	$v=str_replace('u:','ü',$v);
	$v=str_replace('o=','ő',$v);
	$v=str_replace('u=','ű',$v);
	$v=str_replace('o-','ó',$v);
	$v=str_replace('u-','ú',$v);
	$v=str_replace('i-','í',$v);
	$v=str_replace('e-','é',$v);
	$v=str_replace('a-','á',$v);
	$v=str_replace('O:','Ö',$v);
	$v=str_replace('U:','Ü',$v);
	$v=str_replace('O=','Ő',$v);
	$v=str_replace('U=','Ű',$v);
	$v=str_replace('O-','Ó',$v);
	$v=str_replace('U-','Ú',$v);
	$v=str_replace('I-','Í',$v);
	$v=str_replace('E-','É',$v);
	$v=str_replace('A-','Á',$v);
	return($v);
}



function normal_file_content($filedata){
	$filed=$filedata;
	$filed=str_replace("&lt;","<",$filed);
	$filed=str_replace("&gt;",">",$filed);
	$filed=str_replace("&quot;","\"",$filed);
	$filed=str_replace("&apos;","\'",$filed);
	$filed=str_replace("&amp;","&",$filed);
	$filed=str_replace("&nbsp;"," ",$filed);
	$filed=str_replace("&ouml;","ö",$filed);
	$filed=str_replace("&uuml;","ü",$filed);
	$filed=str_replace("&oacute;","ó",$filed);
	$filed=str_replace("&ocirc;","ő",$filed);
	$filed=str_replace("&uacute;","ú",$filed);
	$filed=str_replace("&eacute;","é",$filed);
	$filed=str_replace("&aacute;","á",$filed);
	$filed=str_replace("&ucirc;","ű",$filed);
	$filed=str_replace("&iacute;","í",$filed);
	$filed=str_replace("&Ouml;","Ö",$filed);
	$filed=str_replace("&Uuml;","Ü",$filed);
	$filed=str_replace("&Oacute;","Ó",$filed);
	$filed=str_replace("&Ocirc;","Ő",$filed);
	$filed=str_replace("&Uacute;","Ú",$filed);
	$filed=str_replace("&Eacute;","É",$filed);
	$filed=str_replace("&Aacute;","Á",$filed);
	$filed=str_replace("&Ucirc;","Ű",$filed);
	$filed=str_replace("&Iacute;","Í",$filed);
	return($filed);
}


function load_language(){
	global $LANGUAGE_FILE_NAME,$LANGUAGE_LINES,$DIR_CONFIG;

	$file=$DIR_CONFIG."/".$LANGUAGE_FILE_NAME;
	if (file_exists($file)){
		$t=file_get_contents($file);
		$LANGUAGE_LINES=json_decode($t,true);
	}
}



function write_language(){
	global $LANGUAGE_FILE_NAME,$LANGUAGE_LINES,$DIR_CONFIG,$LANGUAGE_CHANGE;

	if ($LANGUAGE_CHANGE){
		$file=$DIR_CONFIG."/".$LANGUAGE_FILE_NAME;
		$i=0;
		$t=json_encode($LANGUAGE_LINES);
		#unlink($file);
		file_put_contents($file,$t);
	}
}



function language($line){
	global $LANGUAGE_LINES,$LANGUAGE_CHANGE;

	$ret=$line;
	if (isset($LANGUAGE_LINES[$line])){
		$ret=$LANGUAGE_LINES[$line];
	}else{
		$LANGUAGE_LINES[$line]=$line;
		$LANGUAGE_CHANGE=TRUE;
		$ret=$line;
	}
	return($ret);
}



function change_name($str){
	$unwanted_array=array(  'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A',  'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
							'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I',  'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
							'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
							'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i',  'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
							'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y',  'þ'=>'b', 'ÿ'=>'y', ' '=>'_');
	$str=strtr($str,$unwanted_array);
	return($str);
}



?>
