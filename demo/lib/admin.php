<?php

 #
 # PHPPortal
 #
 # info: main folder copyright file
 #
 #



function no_admin_right(){
	global $DIR_CONTENT,$INDEX_FILE,$LOGIN_CONTENT;

	echo("<br /><br />");
	$l=language("Nincs megfelelő engedélye az oldal eléréséhez.");
	echo("<h3>$l</h3>");
	echo("<br /><br />");
	$file=$DIR_CONTENT."/".$LOGIN_CONTENT."/".$INDEX_FILE;
	include_phpfile($file);
}

function admin_menu(){
	global $SYSTEM_MENU,$SYSTEM_MENU_PLUGIN;

	$l1=language("Oldal");
	$l2=language("Tartalom");
	$l3=language("Megjelenés");
	$l4=language("Beállítások");
	$l5=language("Felhasználók");
	$l6=language("Log");
	$SYSTEM_MENU=array($l1,$l2,$l3,$l4,$l5,$l6);
	$menu=array_merge($SYSTEM_MENU,$SYSTEM_MENU_PLUGIN);
	return($menu);
}



function control_admin($content,$menu){
	global	$ADMIN_SITE,$SYSTEM_MENU_PLUGIN,$SYSTEM_MENU_PLUGIN_FUNC,$LOGGED_IN_USER,$DIR_CONTENT,
			$LOGIN_CONTENT,$INDEX_FILE,$USER_ADMIN,$USER_EDITOR;

	if ((!$ADMIN_SITE)or(!$LOGGED_IN_USER)or((!$USER_ADMIN)and(!$USER_EDITOR))){
		no_admin_right();
		if ($USER_EDITOR){
		}
		if ($USER_ADMIN){
		}
	}else{
		if ($content==$LOGIN_CONTENT){
			$file=$DIR_CONTENT."/".$LOGIN_CONTENT."/".$INDEX_FILE;
			include_phpfile($file);
		}else{
			if ($content==""){
				$content=$menu[1];
			}
			switch ($content) {
				case $menu[0]:
					echo("<script type=\"text/javascript\">location.href='../public/index.php';</script>");
					#echo("<script type=\"text/javascript\">window.open('http://localhost','_blank');</script>");
					break;
				case change_name($menu[1]):
					if (!$USER_ADMIN){
						no_admin_right();
					}else{
						admin_content($menu[1]);
					}
					break;
				case change_name($menu[2]):
					if (!$USER_ADMIN){
						no_admin_right();
					}else{
						admin_design($menu[2]);
					}
					break;
				case change_name($menu[3]):
					if (!$USER_ADMIN){
						no_admin_right();
					}else{
						admin_config($menu[3]);
					}
					break;
				case change_name($menu[4]):
					if (!$USER_ADMIN){
						no_admin_right();
					}else{
						admin_users($menu[4]);
					}
					break;
				case change_name($menu[5]):
					if (!$USER_ADMIN){
						no_admin_right();
					}else{
						admin_log($menu[5]);
					}
					break;
				default:
					$i=0;
					$db=count($SYSTEM_MENU_PLUGIN);
					while(($i<$db)and($content<>change_name($SYSTEM_MENU_PLUGIN[$i]))){
						$i++;
					}
					call_user_func($SYSTEM_MENU_PLUGIN_FUNC[$i]);
					break;
			}
		}
	}
}



?>

