<?php

 #
 # PHPPortal
 #
 # info: main folder copyright file
 #
 #




function admin_get_users($n,$p,$r){
	global $REQUEST_DATA_POST,$USERS_LINES,$USERS_SEPARATOR,$USERS_CHANGE;

	$na=get_postdata($n);
	$pa=get_postdata($p);
	$ri=get_postdata($r);
	$ret=FALSE;
	if (($na<>"")and($pa<>"")){
		$db=count($USERS_LINES);
		$pa=md5($pa);
		$USERS_LINES[$db]=$na.$USERS_SEPARATOR.$pa.$USERS_SEPARATOR.$ri;
		$USERS_CHANGE=TRUE;
		write_users();
		load_users();
		$ret=TRUE;
	}
	return($ret);
}


function admin_show_users(){
	global $USERS_LINES,$USERS_SEPARATOR;

	$db=count($USERS_LINES);
	if ($db>0){
		$c=get_sublink("content");
		echo("<center><table>");
		$l1=language("Név");
		$l2=language("Szerepkör");
		$l3=language("Töröl");
		$st=" style=\"border:1px solid;text-align:center;\" ";
		echo("<th $st>$l3</th><th $st>$l1</th><th $st>$l2</th>");
		$link="?content=".$c."&del=";
		for($i=0;$i<$db;$i++){
			$l=explode($USERS_SEPARATOR,$USERS_LINES[$i]);
			if ($l[0]<>""){
				echo("<tr>");
				$link2= $link.$l[0];
				echo("<td $st><a href=$link2>$l3</a></td>");
				echo("<td $st>$l[0]</td>");
				$lk=language($l[2]);
				echo("<td $st>$lk</td>");
				echo("</tr>");
			}
		}
		echo("</table></center>");
	}
}


function admin_del_users($cont){
	global $USERS_LINES,$USERS_SEPARATOR,$USERS_CHANGE;

	$db=count($USERS_LINES);
	$c=get_sublink($cont);
	$ret=FALSE;
	if ($c<>""){
		for($i=0;$i<$db;$i++){
			$l=explode($USERS_SEPARATOR,$USERS_LINES[$i]);
			if ($c==$l[0]){
				echo("$c-$l[0]");
				unset($USERS_LINES[$i]);
				$ret=TRUE;
				$USERS_CHANGE=TRUE;
			}
		}
	}
	return($ret);
}



function admin_users($add){
    global $ADMIN_SITE,$INDEX_FILE,$DIR_CONTENT,$CONTENT_CONTAINER_OPEN,$CONTENT_CONTAINER_END,$USERS_ROLE;

    if (!$ADMIN_SITE){
		no_admin_right();
    }else{
		if (admin_get_users("uname","passw","right")){
			$l=language("Felhasználó felvéve.");
			echo("<b><font color=red>$l</font></b><br /><br />");
		}
		if (admin_del_users("del")){
			$l=language("Felhasználó törölve.");
			echo("<b><font color=red>$l</font></b><br /><br />");
		}
		$l=language("Adminisztráció");
		echo("<br /><br /><b>$l: $add</b><br /><br /><br />");
		$l=language("Felhasználók");
		echo("<fieldset style=\"display:snone;text-align:left;\"><legend>$l</legend><center>");
		echo("<br /><br />");
		admin_show_users();
		echo("<br /><br />");
		echo("</center></fieldset>");
		echo("<br /><br />");
		echo("<br /><br />");
		$l=language("Új felhasználó");
		echo("<fieldset style=\"display:snone;text-align:left;\"><legend>$l</legend><center>");
		$c=get_sublink("content");
		$link="?content=".$c;
		echo("<br /><br /><center>");
		echo("<form action=\"$link\" method=\"post\" enctype=\"multipart/form-data\">");
		echo("<input name=\"dir\" type=\"hidden\" value=\"\" >");
		$l=language("Felhasználó");
		echo("$l: ");
		echo("<br /><br />");
		echo("<input type=text name=uname id=uname>");
		echo("<br /><br />");
		$l=language("Jelszó");
		echo("$l: ");
		echo("<br /><br />");
		echo("<input type=password name=passw id=passw>");
		echo("<br /><br />");
		$db=count($USERS_ROLE);
		for($i=0;$i<$db;$i++){
			$l=language($USERS_ROLE[$i]);
			echo("<input type=radio name=right value=$l>$l");
		}
		echo("<br /><br /><br /><br />");
		$l=language("Létrehozás");
		echo("<input id=\"submit\" type=\"submit\" name=\"subm\" value=\"$l\">");
		echo("</form>");
		echo("</center></fieldset>");
		echo("<br /><br />");
    }

}





?>

