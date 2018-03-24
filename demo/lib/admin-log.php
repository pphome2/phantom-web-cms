<?php

 #
 # PHPPortal
 #
 # info: main folder copyright file
 #
 #



function admin_log($add){
    global $DIR_LOG,$ADMIN_SITE;

    if (!$ADMIN_SITE){
		no_admin_right();
    }else{
		$file=get_postdata('file');
		$l=language("Adminisztráció");
		echo("<br /><br /><b>$l: $add</b><br /><br /><br />");
		#$file=$DIR_TEMPLATE."/".$SITE_TEMPLATE."/".$INDEX_FILE;

		$l=language("Log fájl");
		$l2=language("Választ");

		echo("<fieldset style=\"display:snone;text-align:left;\"><legend>$l</legend><center>");
		echo("<br /><form action=\"\" method=\"post\" enctype=\"multipart/form-data\">");
		$cdir=scandir($DIR_LOG);
		echo("<select name=file id=file style=\"width:300px;\">");
		$db=count($cdir);
		for($i=0;$i<$db;$i++){
			if (substr($cdir[$i],0,1)<>"."){
				if ($cdir[$i]==$file){
					echo("<option value=$cdir[$i] selected>$cdir[$i]</option>");
				}else{
					echo("<option value=$cdir[$i]>$cdir[$i]</option>");
				}
			}
		}
		echo("</select> ");
		echo("<input id=\"submit\" type=\"submit\" name=\"gomb\" value=\"$l2\" style=\"width:200px;\">");
		echo("</form>");
		echo("</center></fieldset>");
		echo("<br /><br />");
		echo("<fieldset style=\"display:snone;text-align:left;\"><legend>$l: $file</legend><center>");
		echo("<textarea name=\"i\" rows=\"30\" cols=\"110\" maxlenght=200>");
		if ($file<>""){
			$file=$DIR_LOG."/".$file;
			if (file_exists($file)){
				include($file);
			}
		}else{
		}
		echo("</textarea>");
		echo("</center></fieldset>");
		echo("<br /><br />");
    }

}



?>
