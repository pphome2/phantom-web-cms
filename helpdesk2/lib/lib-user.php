<?php

 #
 # PHPPortal
 #
 # info: main folder copyright file
 #
 #



function logged(){
	global $LOGGED_IN_USER,$REQUEST_DATA_POST;

	return($LOGGED_IN_USER);
}



function login(){
	global $LOGGED_IN_USER,$LOGIN_TIME;

	$LOGGED_IN_USER=FALSE;
	$logout=get_postdata("logout");
	#$logout=$_POST["logout"];
	if ($logout<>""){
		#set_cookie("gusername","",time()-1,"/");
		#set_cookie("gpassword","",time()-1,"/");
		login_out();
		echo("<script type=\"text/javascript\">location.href='../public/index.php';</script>");
	}else{
		load_users();
		$new=TRUE;
		$loginpage=FALSE;
		$usernamex=get_postdata("username");
		$passwordx=get_postdata("password");
		if (($usernamex=="")and($passwordx=="")){
			$usernamex=get_cookie("gusername");
			$passwordx=get_cookie("gpassword");
			$new=FALSE;
		}else{
			$loginpage=TRUE;
		}
		if (($usernamex<>"")and($passwordx<>"")){
			if ($new){
				$passwordx=md5($passwordx);
			}
			set_cookie("gusername",$usernamex,$LOGIN_TIME);
			set_cookie("gpassword",$passwordx,$LOGIN_TIME);
			if (logincheck($usernamex,$passwordx)){
				$LOGGED_IN_USER=TRUE;
				if ($new){
					#set_cookie("gusername",$usernamex,$LOGIN_TIME);
					#set_cookie("gpassword",$passwordx,$LOGIN_TIME);
					#header("Refresh:0");
				}
			}else{
			}

		}
		if ($loginpage){
			echo("<script type=\"text/javascript\">location.href='../public/index.php';</script>");
		}
	}
	#return($LOGGED_IN_USER);
}



function logincheck($user,$pass){
	global $USERS_LINES,$USERS_SEPARATOR,$ROLE_ADMIN,$ROLE_EDITOR,$USER_ADMIN,$USER_EDITOR;

	$ret=FALSE;
	$db=count($USERS_LINES);
	for($i=0;$i<$db;$i++){
		$l=explode($USERS_SEPARATOR,$USERS_LINES[$i]);
		if (($l[0]==$user)and($l[1]==$pass)){
			$i=$db;
			$ret=TRUE;
			$role=$l[2];
			if ($role==$ROLE_EDITOR){
				$USER_EDITOR=TRUE;
			}
			if ($role==$ROLE_ADMIN){
				$USER_ADMIN=TRUE;
			}
		}
	}
	return($ret);
}


function load_users(){
	global $USERS_LINES,$USERS_CHANGE,$DIR_CONFIG,$USERS_FILE;

	$file=$DIR_CONFIG."/".$USERS_FILE;
	if (file_exists($file)){
		$t=file_get_contents($file);
		$USERS_LINES=json_decode($t,true);
		$USERS_CHANGE=FALSE;
	}
}


function new_user($name,$pass,$role){
	global $USERS_LINES,$USERS_CHANGE,$ROLE_NORIGHT,$USERS_SEPARATOR;

	if ($role==""){
		$role=$ROLE_NORIGHT;
	}
	if ($name<>""){
		$c=count($USERS_LINES);
		$pass=md5($pass);
		$USERS_LINES[$c]=$name.$USERS_SEPARATOR.$pass.$USERS_SEPARATOR.$role;
		$USERS_CHANGE=TRUE;
	}
}


function del_user($name,$pass){
	global $USERS_LINES,$USERS_CHANGE,$ROLE_NORIGHT,$USERS_SEPARATOR;

	if ($name<>""){
		$c=count($USERS_LINES);
		$i=0;
		while ($i<$c){
			$l=explode($USERS_SEPARATOR,$USERS_LINES[$i]);
			if (($l[0]==$name)and($l[1]==$pass)){
				$USERS_LINES[$i]="";
				$USERS_CHANGE=TRUE;
				$i=$c;
			}
		}
	}
}


function write_users(){
	global $USERS_LINES,$USERS_CHANGE,$USERS_FILE,$DIR_CONFIG;

	if ($USERS_CHANGE){
		$file=$DIR_CONFIG."/".$USERS_FILE;
		$i=0;
		if (file_exists($file)){
			$t=json_encode($USERS_LINES);
			file_put_contents($file,$t);
		}
		$USERS_CHANGE=FALSE;
	}
}


function get_user_name(){
	$ret=get_cookie("gusername");
	return($ret);
}


function get_user_pwd(){
	$ret=get_cookie("gpassword");
	return($ret);
}


function login_out(){
	global $LOGGED_IN_USER;

	del_cookie("gusername");
	del_cookie("gpassword");
	header("Refresh:0");
	$LOGGED_IN_USER=FALSE;
}



function i_admin(){
	global $PORTAL_ADMIN_NAME,$PORTAL_ADMIN_PASSWORD,$PORTAL_ADMIN_PASSWORD_MD5;

	$ret="";
	$lu=vget_sublink("luser");
	$lp=get_sublink("lpass");
	if ($PORTAL_ADMIN_PASSWORD_MD5){
		if (strlen($lp)<30){
			$lp2=md5($lp);
		}else{
			$lp2=$lp;
		}
	}else{
		$lp2=$lp;
	}
	if (($lu==$PORTAL_ADMIN_NAME)and($lp2==$PORTAL_ADMIN_PASSWORD)){
		$ret="luser=".$lu."&lpass=".$lp2."&";
	}
	return($ret);
}


?>
