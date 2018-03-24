<?php

 #
 # PHPPortal
 #
 # info: main folder copyright file
 #
 #

	$old_error_handler=set_error_handler("p_error_handler");
	date_default_timezone_set('Europe/Budapest');


	if (file_exists("../config/system.php")){
		include("../config/system.php");
		$dbfile=count($SYSTEM_FILES);
		$allok=TRUE;
		for($i=0;$i<$dbfile;$i++){
			if ($SYSTEM_FILES[$i]<>""){
				if (file_exists("$SYSTEM_FILES[$i]")){
					include("$SYSTEM_FILES[$i]");
				}else{
				    $allok=FALSE;
				}
			}
		}
		if ($allok){
			$LOAD_OK=TRUE;
		}else{
			echo("<br /><hr /><br /><b>Hiba történt: hiányzik néhány fájl...</b><br /><br /><hr /><br />");
		}
	}else{
		echo("<br /><hr /><br /><b>Hiba történt: hiányzik néhány fájl...</b><br /><br /><hr /><br />");
	}

function main(){
	global	$PORTAL_NAME,
			$PORTAL_ADMIN_NAME,
			$PORTAL_ADMIN_PASSWORD,
			$MYSQL_SERVER,
			$MYSQL_PORT,
			$MYSQL_DATABASE,
			$MYSQL_USER,
			$MYSQL_PASSWORD,
			$MAIN_JS,
			$DIR_INCLUDE,
			$ACTIVE_PLUGINS,
			$DIR_TEMPLATE,
			$TEMPLATE,
			$DIR_PLUGINS,
			$DIR_TEMPLATE,
			$TEMPLATE,
			$TEMPLATE_DIRNAME,
			$REQUEST_DATA,
			$REQUEST_DATA_POST,
			$LOGGED_IN_USER,
			$LANGUAGE_FILE_NAME,
			$LANGUAGE_TITLE,
			$LANGUAGE_AVAIL_LANG,
			$INDEX_FILE,
			$DIR_CONFIG,
			$FREELIC,
			$LICMESSAGE,
			$LICFILE,
			$VALID;


	$REQUEST_DATA_POST=$_POST;
	$REQUEST_DATA=$_GET;
	$today=date("Ymd");
	$lf=$DIR_CONFIG."/".$LICFILE;
	$lic=TRUE;
	if (!$FREELIC){
		if (file_exists($lf)){
			include($lf);;
			if (($VALID+20)<$today){
				$lic=FALSE;
			}
		}else{
			if (($VALID>$today)or(($VALID+20)<$today)){
				$lic=FALSE;
			}
		}
	}
	if ($lic){
		login();
	}else{
		echo("<font size=+2 style=\"color:red;\">$LICMESSAGE Licence expired!</font>");
	}
	if (count($LANGUAGE_AVAIL_LANG)>0){
		$lang=get_sublink("lang");
		if ($lang==""){
			$lang=get_cookie("language");
		}else{
			set_cookie("language",$lang,100000);
		}
		if ($lang<>""){
			$LANGUAGE_TITLE=$lang;
			$INDEX_FILE=$LANGUAGE_TITLE.'_'.$INDEX_FILE;
		}
	}
	$LANGUAGE_FILE_NAME=$LANGUAGE_FILE_NAME.$LANGUAGE_TITLE;
	load_language();
	echo("<style>");
	$cdir=scandir("$DIR_INCLUDE/css");
	foreach ($cdir as $key => $value){
		if (!in_array($value,array(".","..",".htaccess"))){
			include("$DIR_INCLUDE/css/$value");
		}
	}

	$cdir=scandir("$DIR_TEMPLATE/$TEMPLATE/css");
	foreach ($cdir as $key => $value){
		if (!in_array($value,array(".","..",".htaccess"))){
			include("$DIR_TEMPLATE/$TEMPLATE/css/$value");
		}
	}
	echo("</style>");

	echo("<script type=text/javascript>");
	if ($MAIN_JS){
		$xdir="$DIR/INCLUDE/js";
		if (is_dir($xdir)){
			$cdir=scandir($xdir);
			foreach ($cdir as $key => $value){
				if (!in_array($value,array(".","..",".htaccess"))){
					include("$xdir/$value");
				}
			}
		}
	}else{
		if (file_exists("$DIR_INCLUDE/js/main.js")){
			include("$DIR_INCLUDE/js/main.js");
		}
	}
	$xdir="$DIR_TEMPLATE/$TEMPLATE/js";
	if (is_dir($xdir)){
		$cdir=scandir($xdir);
		foreach ($cdir as $key => $value){
			if (!in_array($value,array(".","..",".htaccess"))){
				include("$xdir/$value");
			}
		}
	}
	echo("</script>");

	$db=count($ACTIVE_PLUGINS);
	for($i=0;$i<$db;$i++){
		$dirn="$DIR_PLUGINS/$ACTIVE_PLUGINS[$i]/css";
		if (is_dir($dirn)){
			echo("<style>");
			$cdir=scandir($dirn);
			foreach ($cdir as $key => $value){
				if (!in_array($value,array(".","..",".htaccess"))){
					include("$dirn/$value");
				}
			}
			echo("</style>");
		}

		$dirn="$DIR_PLUGINS/$ACTIVE_PLUGINS[$i]/js";
		if (is_dir($dirn)){
			echo("<script type=text/javascript>");
			$cdir=scandir("$DIR_PLUGINS/$ACTIVE_PLUGINS[$i]/js");
			foreach ($cdir as $key => $value){
				if (!in_array($value,array(".","..",".htaccess"))){
					include("$dirn/$value");
				}
			}
			echo("</script>");
		}

		$dirn="$DIR_PLUGINS/$ACTIVE_PLUGINS[$i]/php";
		if (is_dir($dirn)){
			$cdir=scandir($dirn);
			foreach ($cdir as $key => $value){
				if (!in_array($value,array(".","..",".htaccess"))){
					include("$DIR_PLUGINS/$ACTIVE_PLUGINS[$i]/php/$value");
				}
			}
		}
	}
	$TEMPLATE_DIRNAME=$DIR_TEMPLATE."/".$TEMPLATE;
	#if (isset($_COOKIE["gusername"])){
	#	if ($_COOKIE["gusername"]<>""){
	#		$LOGGED_IN_USER=TRUE;
	#	}
	#}
}



function main_admin(){
	global $SYSTEM_ADMIN_FILES,$LANGUAGE_TITLE,$LANGUAGE_TITLE_ADMIN;

	$LANGUAGE_TITLE=$LANGUAGE_TITLE_ADMIN;
	$dbfile=count($SYSTEM_ADMIN_FILES);
	for($i=0;$i<$dbfile;$i++){
		if ($SYSTEM_ADMIN_FILES[$i]<>""){
			if (file_exists("$SYSTEM_ADMIN_FILES[$i]")){
				include("$SYSTEM_ADMIN_FILES[$i]");
			}
		}
	}
}


function main_page_end(){
	global	$DIR_PLUGINS,$ACTIVE_PLUGINS_PAGE_END;

	$db=count($ACTIVE_PLUGINS_PAGE_END);
	for($i=0;$i<$db;$i++){
		$dirn="$DIR_PLUGINS/$ACTIVE_PLUGINS_PAGE_END[$i]/css";
		if (is_dir($dirn)){
			echo("<style>");
			$cdir=scandir($dirn);
			foreach ($cdir as $key => $value){
				if (!in_array($value,array(".","..",".htaccess"))){
					include("$dirn/$value");
				}
			}
			echo("</style>");
		}

		$dirn="$DIR_PLUGINS/$ACTIVE_PLUGINS_PAGE_END[$i]/js";
		if (is_dir($dirn)){
			echo("<script type=text/javascript>");
			$cdir=scandir("$DIR_PLUGINS/$ACTIVE_PLUGINS_PAGE_END[$i]/js");
			foreach ($cdir as $key => $value){
				if (!in_array($value,array(".","..",".htaccess"))){
					include("$dirn/$value");
				}
			}
			echo("</script>");
		}

		$dirn="$DIR_PLUGINS/$ACTIVE_PLUGINS_PAGE_END[$i]/php";
		if (is_dir($dirn)){
			$cdir=scandir($dirn);
			foreach ($cdir as $key => $value){
				if (!in_array($value,array(".","..",".htaccess"))){
					include("$DIR_PLUGINS/$ACTIVE_PLUGINS_PAGE_END[$i]/php/$value");
				}
			}
		}
	}
	write_users();
	write_language();
}



function p_error_handler($errno, $errstr, $errfile, $errline){
	global $PORTAL_ADMIN_MAIL,$PORTAL_DEV_MAIL,$DIR_LOG;

	$logfile=$DIR_LOG."/".date_id();
	$time=date_time_id();
	switch ($errno) {
		case E_USER_ERROR:
		// Send an e-mail to the administrator
		error_log("$time Error: $errstr Fatal error on line $errline in file $errfile \n","1",$PORTAL_DEV_MAIL);
		// Write the error to our log file
		error_log("$time Error: $errstr Fatal error on line $errline in file $errfile \n","3",$logfile);
		break;
	case E_USER_WARNING:
		// Write the error to our log file
		error_log("$time Warning: $errstr Fatal error on line $errline in file $errfile \n","3",$logfile);
		break;
	case E_USER_NOTICE:
		// Write the error to our log file
		error_log("$time Notice: $errstr Fatal error on line $errline in file $errfile \n","3",$logfile);
		break;
	default:
		// Write the error to our log file
		if (substr($errstr,0,20)<>"Cannot modify header"){
			error_log("$time Unknown error [#$errno]: $errstr in $errfile on line $errline \n","3",$logfile);
		}
		break;
	}
	// Don't execute PHP's internal error handler
	return TRUE;
}


?>
