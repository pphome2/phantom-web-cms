<?php

 #
 # PHPPortal
 #
 # info: main folder copyright file
 #
 #




function admin_design($add){
    global $ADMIN_SITE,$DIR_TEMPLATE,$SITE_TEMPLATE,$INDEX_FILE,$DEFAULT_CSS;

    if (!$ADMIN_SITE){
		no_admin_right();
    }else{
		if (post_data_save_file("file","filedata")){
			echo("<b><font color=red>File saved.</font></b><br /><br />");
		}
		$l=language("Adminisztráció");
		echo("<br /><br /><b>$l: $add</b><br /><br /><br />");
		$file=$DIR_TEMPLATE."/".$SITE_TEMPLATE."/".$INDEX_FILE;
		$l=language("Megjelenés");
		$l2=language("Mentés");
		echo("<fieldset style=\"display:snone;text-align:left;\"><legend>$l: $file</legend><center>");
		file_edit_form($file,"content","Design",$l2,"","");
		echo("</center></fieldset>");
		echo("<br /><br />");
		$file=$DIR_TEMPLATE."/".$SITE_TEMPLATE."/css/".$DEFAULT_CSS;
		echo("<fieldset style=\"display:snone;text-align:left;\"><legend>$l: $file</legend><center>");
		file_edit_form($file,"content","Design",$l2,"","");
		echo("</center></fieldset>");
    }

}


function admin_config($add){
    global $ADMIN_SITE,$DIR_CONFIG;

    if (!$ADMIN_SITE){
		no_admin_right();
    }else{
		if (post_data_save_file("file","filedata")){
			$l=language("Fálj mentve.");
			echo("<b><font color=red>$l</font></b><br /><br />");
		}
		$l=language("Adminisztráció");
		echo("<br /><br /><b>$l: $add</b><br /><br /><br />");
		$file="$DIR_CONFIG/config.php";
		$l=language("Beállítások");
		echo("<fieldset style=\"display:snone;text-align:left;\"><legend>$l: $file</legend><center>");
		$l=language("Mentés");
		file_edit_form($file,"content","","$l","","");
		echo("</center></fieldset>");
    }

}

?>

