<?php

 #
 # PHPPortal
 #
 # info: main folder copyright file
 #
 #




function admin_content($add){
    global $ADMIN_SITE,$INDEX_FILE,$DIR_CONTENT,$CONTENT_CONTAINER_OPEN,$CONTENT_CONTAINER_END;

    if (!$ADMIN_SITE){
		no_admin_right();
    }else{
		$aktdir=get_sublink("dir");
		if ($aktdir==""){
			$aktdir=get_postdata("dir");
			if ($aktdir==""){
				$aktdir=$DIR_CONTENT;
			}
		}
		if (!is_dir($aktdir)){
			$aktdir=minus_dir($aktdir);
		}
		if (post_create_dir("","createdir")){
			$l=language("Mappa létrehozva.");
			echo("<b><font color=red>$l.</font></b><br /><br />");
		}
		if (post_create_link($aktdir,"createlink")){
			$l=language("Link létrehozva.");
			echo("<b><font color=red>$l.</font></b><br /><br />");
		}
		if (post_delete_dir("deletedir")){
			$l=language("Mappa törölve.");
			echo("<b><font color=red>$l</font></b><br /><br />");
			$dirarray=explode("/",$aktdir);
			$aktdir="";
			$db=count($dirarray);
			for($i=0;$i<$db-1;$i++){
				if ($aktdir<>""){
					$aktdir=$aktdir."/";
				}
				$aktdir=$aktdir.$dirarray[$i];
			}
			echo("<script type=\"text/javascript\">location.href='../admin/index.php?content=Content&dir=$aktdir';</script>");
		}
		$dir=get_postdata("dir");
		if (post_upload_image($dir,"fileupload","submit","")){
			$l=language("Kép feltöltve.");
			echo("<b><font color=red>$l</font></b><br /><br />");
		}
		if (post_data_save_file("file","filedataeditor")){
			$l=language("Fájl mentve.");
			echo("<b><font color=red>$l</font></b><br /><br />");
		}
		if (post_data_save_file("file","filedata")){
			$l=language("Fájl mentve.");
			echo("<b><font color=red>$l</font></b><br /><br />");
		}
		if (post_delete_file("dir","deletefile")){
			$l=language("Fájl törölve.");
			echo("<b><font color=red>$l</font></b><br /><br />");
		}
		$l=language("Adminisztráció");
		echo("<br /><br /><b>$l: $add</b><br /><br /><br />");
		$dirarray=explode("/",$aktdir);
		$l=language("Mappa");
		echo("<fieldset style=\"display:snone;text-align:left;\"><legend>$l: $aktdir</legend><center>");
		echo("<br /><br />");
		if (is_dir($aktdir)){
			$l=language("Tartalom");
			$link="?content=$l&dir=";
			echo("<center><table style=\"width:100%;border:0px solid;border-color:blue;\" >");
			echo("<tr>");
			$db=count($dirarray);
			$l=$link."..";
			for($i=1;$i<$db;$i++){
				$l=$l."/".$dirarray[$i];
				echo("<td style=\"vertical-align:top;text-align:center;border:1px solid;border-color:grey;\"><a href=$l>$dirarray[$i]</a></td>");
			}
			$cdir=scandir($aktdir);
			$db=0;
			foreach ($cdir as $key => $value){
				if (!in_array($value,array(".","..",".htaccess"))){
					#echo("$aktdir/$value");
					if (is_dir("$aktdir/$value")){
						if ($db>14){
							echo("</td>");
							$db=0;
						}
						if ($db==0){
							echo("<td style=\"vertical-align:top;text-align:center;border:1px solid;border-color:grey;\">");
						}
						$l=$link.$aktdir."/".$value;
						echo("<a href=$l>$value</a><br />");
						$db++;
					}
				}
			}
			if ($db>0){
				echo("</td>");
			}
			echo("</tr>");
			echo("</table></center>");
		}

		echo("<br /><br /><center>");
		echo("<form action=\"\" method=\"post\" enctype=\"multipart/form-data\">");
		echo("<input name=\"dir\" type=\"hidden\" value=\"$aktdir\" >");
		$l=language("Mappa létrehozása");
		echo("$l: ");
		echo("<input type=\"text\" name=\"createdir\" id=\"createdir\" value=\"$aktdir/\">		");
		$l=language("Létrehozás");
		echo("<input id=\"submit\" type=\"submit\" name=\"subm\" value=\"$l\">");
		echo("</form>");
		if ($aktdir<>$DIR_CONTENT){
			echo("<form action=\"\" method=\"post\" enctype=\"multipart/form-data\">");
			echo("<input name=\"dir\" type=\"hidden\" value=\"$aktdir\" >");
			$l=language("Mappa törlése");
			echo("$l: ");
			echo("<input type=\"text\" name=\"deletedir\" id=\"deletedir\" value=\"$aktdir\">		");
			$l=language("Törlés");
			echo("<input id=\"submit\" type=\"submit\" name=\"subm\" value=\"$l\">");
			echo("</form>");
		}
		echo("</center></fieldset>");
		echo("<br /><br />");
		echo("<br /><br />");


		$file=$aktdir."/".$INDEX_FILE;
		if (!file_exists($file)){
			$db=count($dirarray)-1;
			$file=$aktdir."/".$dirarray[$db].".php";
		}
		$err=language("Fájl nem szerkeszthető a tartalom miatt (form).");
		show_file_in_box_php($file,$CONTENT_CONTAINER_OPEN,$CONTENT_CONTAINER_END,$err);
		echo("<br /><br />");
		//echo("<br /><br />");

		$l=language("Szerkesztés");
		echo("<fieldset style=\"display:snone;text-align:left;\"><legend>$l: $file</legend><center>");
		$l=language("Mentés");
		file_edit_form_editor($file,"content","Config",$l,"",$err);
		echo("</center></fieldset>");
		echo("<br /><br />");
		echo("<br /><br />");

		$file="$aktdir/index.css";
		if (!file_exists($file)){
			$db=count($dirarray)-1;
			$file=$aktdir."/".$dirarray[$db].".css";
		}
		$l=language("Szerkesztés");
		echo("<fieldset style=\"display:snone;text-align:left;\"><legend>$l: $file</legend><center>");
		$l=language("Mentés");
		file_edit_form($file,"content","Config",$l,"",$err);
		echo("</center></fieldset>");

		echo("<br /><br />");
		$l=language("Fájl feltöltés");
		echo("<fieldset style=\"display:snone;text-align:left;\"><legend>$l</legend><center><br />");
		echo("<form action=\"\" method=\"post\" enctype=\"multipart/form-data\">");
		echo("<input name=\"dir\" type=\"hidden\" value=\"$aktdir\" >");
		$l=language("Fájl kiválasztása feltöltéshez");
		echo("$l: ");
		echo("<input type=\"file\" name=\"fileupload\" id=\"fileupload\"> ");
		$l=language("Feltöltés");
		echo("<input id=\"submit\" type=\"submit\" name=\"submit\" value=\"$l\">");
		echo("</form>");
		echo("</center></fieldset>");
		echo("<br /><br />");
		echo("<center>");
		$l=language("Törlés");
		echo("<fieldset name=d id=d style=\"display:snone;text-align:left;\"><legend>$l</legend><center><br />");
		echo("<form action=\"\" method=\"post\" enctype=\"multipart/form-data\">");
		echo("<input name=\"dir\" type=\"hidden\" value=\"$aktdir\" >");
		$l=language("Fájl kiválasztása törléshez");
		echo("$l: <select name=\"deletefile\">");
		if (is_dir($aktdir)){
			$cdir=scandir($aktdir);
		}else{
			$cdir=array();
		}
		$db=0;
		foreach ($cdir as $key => $value){
			if (!in_array($value,array(".","..",".htaccess"))){
				$f=$aktdir."/".$value;
				if (is_file($f)){
					echo("<option value=\"$value\">$value</option>");
				}
			}
		}
		echo("</select>");
		$l=language("Törlés");
		echo(" <input id=\"submit\" type=\"submit\" name=\"submit\" value=\"$l\">");
		echo("</form></center>");
		echo("</fieldset>");
		echo("<br /><br />");
		$l=language("Link létrehozása");
		echo("<fieldset name=d id=d style=\"display:snone;text-align:left;\"><legend>$l</legend><center><br />");
		echo("<form action=\"\" method=\"post\" enctype=\"multipart/form-data\">");
		echo("<input name=\"dir\" type=\"hidden\" value=\"$aktdir\" >");
		echo("<input name=\"dir\" type=\"hidden\" value=\"$aktdir\" >");
		echo("$l: ");
		echo("<input type=\"text\" name=\"createlink\" id=\"createlink\" value=\"$aktdir/\">		");
		$l=language("Létrehozás");
		echo(" <input id=\"submit\" type=\"submit\" name=\"submit\" value=\"$l\">");
		echo("</form></center>");
		echo("</fieldset>");
		echo("<br /><br />");
    }

}



?>

