<?php

 #
 # PHPPortal
 #
 # info: main folder copyright file
 #
 #

function system_message($line){
	echo("<br /><hr /><br /><br /><b>$line</b></br /><hr /><br />");
}


function system_xmessage(){
	global $SYSTEM_MESSAGE;

	echo("<br /><hr /><br /><br /><b>$SYSTEM_MESSAGE</b></br /><hr /><br />");
}


function id(){
	$idcode="";

	$idcode=date('YmdHis').strval(rand(1000,9999));
	return($idcode);
}


function date_id(){
	$idcode="";

	$idcode=date('Ymd');
	return($idcode);
}


function date_time_id(){
	$idcode="";

	$idcode=date('Y.m.d H.i');
	return($idcode);
}


function id_to_date($d){
	if ($d<>""){
		$out=substr($d,0,4).".".substr($d,4,2).".".substr($d,6,2).". ";
		$out=$out.substr($d,8,2).":".substr($d,10,2).".".substr($d,12,2)." - ";
		$out=$out.substr($d,14,4);
	}else{
		$out="";
	}
	return($out);
}


function id_to_onlydate($d){
	if ($d<>""){
		$out=substr($d,0,4).".".substr($d,4,2).".".substr($d,6,2).". ";
		$out=$out.substr($d,8,2).":".substr($d,10,2);
	}else{
		$out="";
	}
	return($out);
}



function valid_input($data) {
  $data=trim($data);
  $data=stripslashes($data);
  $data=htmlspecialchars($data);
  return($data);
}


function get_page_name(){
	global $PAGE_NAME,$GETDATA;

	$ret="";
	$ret=get_sublink($PAGE_NAME);
	if ($ret<>""){
		$GETDATA=TRUE;
	}
	return($ret);
}


function show_file($file){
	global $DIR_TEMPLATE, $TEMPLATE;

	$sub=substr($file,0,1);
	if (($sub<>".")and($sub<>"/")){
		$file="$DIR_TEMPLATE/$TEMPLATE/$file";
	}
	if (file_exists($file)){
		$f=file_get_contents($file);
		echo($f);
	}
}


function show_file_php($file){
	global $DIR_TEMPLATE, $TEMPLATE;

	$sub=substr($file,0,1);
	if (($sub<>".")and($sub<>"/")){
		$file="$DIR_TEMPLATE/$TEMPLATE/$file";
	}
	$ret=TRUE;
	if (file_exists($file)){
		$f=file_get_contents($file);
		if (strlen($f)>1){
			$p=strpos($f,"<form");
			$p2=strpos($f,"<textarea");
			if (($p==0)and($p2==0)){
				echo($f);
				#include($file);
				$ret=TRUE;
			}else{
				$ret=FALSE;
			}
		}else{
			$ret=TRUE;
		}
	}
	return($ret);
}


function include_phpfile($file){
	global $DIR_TEMPLATE, $TEMPLATE;

	$sub=substr($file,0,1);
	if (($sub<>".")and($sub<>"/")){
		$file="$DIR_TEMPLATE/$TEMPLATE/$file";
	}
	if (file_exists($file)){
		include($file);
	}
}


function include_cssfile($file){
	global $DIR_TEMPLATE, $TEMPLATE;

	$sub=substr($file,0,1);
	if (($sub<>".")and($sub<>"/")){
		$file="$DIR_TEMPLATE/$TEMPLATE/$file";
	}
	if (file_exists($file)){
		echo("<style>");
		include($file);
		echo("/<style>");
	}
}



function form_protect(&$a1,&$a2,&$a3){
	$ret=FALSE;
	if (($a1+$a2)==$a3){
		$ret=TRUE;
	}
	$a1=rand(0,20);
	$a2=rand(0,20);
	$a3=$a1+$a2;
	return($ret);
}



function get_page_pos(){
	$ret=$_SERVER[REQUEST_URI];
	$c=strpos($ret,'#');
	$ret=substr($ret,$c);
	return($ret);
}



function get_table_page($key){
	$ret="";
	$ret=get_sublink($key);
	if ($ret==""){
		$ret="1";
	}
	return($ret);
}


function change_link($xlink,$xkey,$xdata){
	global $REQUEST_DATA,$INDEX_FILE;

	$l2=$INDEX_FILE."?";
	$first=TRUE;
	$found=FALSE;
	foreach($REQUEST_DATA as $key => $value){
		if (!$first){
			$l2=$l2."&";
		}else{
			$first=FALSE;
		}
		if ($key==$xkey){
			$l2=$l2.$key."=".$xdata;
			$found=TRUE;
		}else{
			$l2=$l2.$key."=".valid_input($value);
		}
	}
	if (!$found){
		$l2=$l2."&".$xkey."=".$xdata;
	}
	return($l2);
}


function get_sublink($code){
	global $REQUEST_DATA;

	if (isset($REQUEST_DATA["$code"])){
		$ret=valid_input($REQUEST_DATA["$code"]);
	}else{
		$ret="";
	}
	return($ret);
}


function get_postdata($code){
	global $REQUEST_DATA_POST;

	if (isset($REQUEST_DATA_POST["$code"])){
		$ret=valid_input($REQUEST_DATA_POST["$code"]);
	}else{
		$ret="";
	}
	return($ret);
}


function show_sys_mail(){
	global $PORTAL_ADMIN_MAIL;

	return($PORTAL_ADMIN_MAIL);
}



function save_file($name,$data){
	$ret=FALSE;
	if ($name<>""){
		if (file_exists($name)){
			rename($name,$name.".old");
		}
        $file=fopen($name,"x+");
        if (is_array($data)){
			$db=count($data);
			for($i=0;$i<$db;$i++){
				fwrite($file, $data[$i]);
				fwrite($file, "\n");
			}
		}else{
			fwrite($file, $data);
		}
        fclose($file);
        $ret=TRUE;
	}
	return($ret);
}



function set_cookie($name,$data,$min){
	setcookie($name,$data,time()+$min,"/");
}



function get_cookie($name){
	$ret="";
	if (isset($_COOKIE[$name])){
		$ret=$_COOKIE[$name];
	}
	return($ret);
}



function del_cookie($name){
	if (isset($_COOKIE[$name])){
		unset($_COOKIE[$name]);
	}
	setcookie($name,"",time()-10,"/");
}



?>
