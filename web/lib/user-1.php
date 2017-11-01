<?php

 #
 # PHPPortal
 #
 # info: main folder copyright file
 #
 #


function table_pager($tpage,$tmaxrow,$urli,$class){
	global $ROW_PER_TABLE_PAGE;

	if ($tmaxrow>$ROW_PER_TABLE_PAGE){
		$allpage=$tmaxrow/$ROW_PER_TABLE_PAGE;
		if ($allpage%1>0){
			$allpage=ceil($allpage);
		}else{
			$allpage=ceil($allpage)-1;
		}
		$link=change_link($urli,"tp",1);
		echo("<a href=$link><div class=$class> << </div></a>");
		if ($tpage>1){
			$link=change_link($urli,"tp",$tpage-1);
		}
		echo("<a href=$link><div class=$class> < </div></a>");
		if ($allpage>10){
			$ok=TRUE;
			if ($tpage-5<1){
				$i=1;
				$ig=10;
				$ok=FALSE;
			}
			if ($tpage+5>$allpage){
				$i=$allpage-9;
				$ig=$allpage;
				$ok=FALSE;
			}
			if ($ok){
				$i=$tpage-4;
				$ig=$tpage+5;
			}
		}else{
			$i=1;
			$ig=$allpage;
		}
		if ($i>1){
			echo(" ... ");
		}
		while ($i<=$ig){
			$link=change_link($urli,"tp",$i);
			echo("<a href=$link><div class=$class>");
			if ($i==$tpage){
				echo("<b>$i</b>");
			}else{
				echo("$i");
			}
			echo("</div></a>");
			$i++;
		}
		if ($ig<$allpage){
			echo(" ... ");
		}
		if ($tpage<$allpage){
			$link=change_link($urli,"tp",$tpage+1);
		}else{
			$link=change_link($urli,"tp",$allpage);
		}
		echo("<a href=$link><div class=$class> > </div></a>");
		$link=change_link($urli,"tp",$allpage);
		echo("<a href=$link><div class=$class> >> </div></a>");
	}

}


function contactform_to_mail($fd,$fdc,$message,$method){
	global $GETDATA,$SMTP_TO,$PORTAL_ADMIN_MAIL,$PHPMAIL,$PORTAL_NAME,$REQUEST_DATA,$REQUEST_DATA_POST;

	if ($method=="get"){
		$dataarray=$REQUEST_DATA;
	}else{
		$dataarray=$REQUEST_DATA_POST;
	}
	$ret="";
	$p1=count($fd);
	$p2=count($fdc);
	$messin=FALSE;
	$mess="";
	$data=FALSE;
	if ($p1>=2){
		if ($message<>""){
			$mess=valid_input($message);
			$messin=TRUE;
		}
		$data=TRUE;
		$i=0;
		while ($i<$p1){
			$c=$fd[$i];
			if (isset($dataarray["$c"])){
				$m=valid_input($dataarray["$c"]);
			}else{
				$m="";
			}
			if (($m<>"")and($m<>$message)){
				if ($mess<>""){
					$mess=$mess."<br /><br />".$m;
				}else{
					$mess=$m;
				}
			}
			if ($m==""){
				$data=FALSE;
			}
			$i++;
		}
		if ($mess==""){
			$data=FALSE;
		}
	}
	$ell=FALSE;
	if ($p2>1){
		if (isset($dataarray["$fdc[0]"])){
			$c1=valid_input($dataarray["$fdc[0]"]);
		}else{
			$c1="";
		}
		if (isset($dataarray["$fdc[1]"])){
			$c2=valid_input($dataarray["$fdc[1]"]);
		}else{
			$c2="";
		}
		if (($c1==$c2)and($c1<>"")){
			$ell=TRUE;
		}
	}else{
		$data=FALSE;
	}
	if (($data)and($ell)){
		if ($PHPMAIL){
			mail($SMTP_TO,$PORTAL_NAME,$mess);
		}else{
			smtp_mail_sendto($SMTP_TO,$mess);
		}
		$ret="1";
	}else{
		if ($mess==""){
			$ret="4";
		}else{
			if (!$data){
				if ($messin){
					$ret="4";
				}else{
					$ret="2";
				}
			}else{
				if (!$ell){
					$ret="3";
				}
			}
		}
	}
	return($ret);
}


function dir_icon_show($dir,$dir2,$iconimage,$icontitle,$colnum){
	global $INDEX_FILE;

	if (is_dir($dir)){
		echo("<center><table width=90% text-align=center border=0px>");
		$cdir=scandir("$dir");
		$col=0;
		foreach ($cdir as $key => $value){
			if (!in_array($value,array(".","..",".htaccess",$INDEX_FILE))){
				if ($col>=$colnum){
					echo("</tr>");
					$col=0;
				}
				if ($col==0){
					echo("<tr>");
				}
				echo("<td align=center>");
				$link="?content=$dir2/$value";
				echo("<a href=$link><img src=$dir/$value/$iconimage><br />");
				if (file_exists("$dir/$value/$icontitle")){
					show_file("$dir/$value/$icontitle");
				}else{
					$v=normal_dirname($value);
					echo("$v");
				}
				echo("</a><br />");
				echo("</td>");
				$col++;
			}
		}
		echo("</table>");
	}

}



function get_dir_first($dir){
	global $INDEX_FILE;

	$ret="";
	if (is_dir($dir)){
		$cdir=scandir($dir);
		foreach ($cdir as $key => $value){
			if (!in_array($value,array(".","..",".htaccess",$INDEX_FILE))){
				if ($ret==""){
					$ret=$value;
				}
			}
		}
	}
	return($ret);
}




function menu_generate($contentname,$menu,$menu_div,$link,$activeclass,&$divclass,$aktmenu,$specdiv,$specdivend,&$menuname){
	$ret="";
	$content=get_sublink($contentname);
	if ($content==""){
		$content=$menu[$aktmenu];
	}
	$menudb=count($menu);
	for($i=0;$i<$menudb;$i++){
		$act="-";
		if ($content==change_name($menu[$i])){
			$act=$activeclass;
			$divclass=$menu_div[$i];
			$menuname=$menu[$i];
		}
		$cont=substr($menu[$i],1,strlen($menu[$i]));
		$p=strpos($content,$cont);
		if ($p>0){
			$act=$activeclass;
			$menuname=$menu[$i];
		}
		$l=change_name($menu[$i]);
		$link2=$link.$l;
		echo("$specdiv<a href=$link2 class=$act >$menu[$i]</a>$specdivend");
	}
	$ret=$content;
	return($ret);
}



function file_edit_form($file,$pname,$site,$button,$title,$err){
	if ($title<>""){
		echo("<b>$title: $file</b><br />");
	}
	echo("<br /><center>");
	echo("<form id=\"fileedit\" action=\"\" method=\"post\" accept-charset=\"UTF-8\">");
	echo("<input name=\"$pname\" type=\"hidden\" value=\"$site\" >");
	echo("<input name=\"file\" type=\"hidden\" value=\"$file\" >");
	echo("<textarea name=\"filedata\" id=\"filedata\" rows=\"40\" cols=\"90\" maxlenght=200>");
	$ok=show_file_php($file);
	if (!$ok){
		echo("$err");
	}
	echo("</textarea>");
	echo("<br /><br />");
	echo("<input id=\"submit\" type=\"submit\" name=\"submit\" value=\"$button\">");
	echo("</form>");
	echo("</center>");
}



function file_edit_form_editor($file,$pname,$site,$button,$title,$err){
	if ($title<>""){
		echo("<b>$title: $file</b><br />");
	}
	echo("<br /><center>");
	echo("<form id=\"fileedit\" action=\"\" method=\"post\" accept-charset=\"UTF-8\">");
	echo("<input name=\"$pname\" type=\"hidden\" value=\"$site\" >");
	echo("<input name=\"file\" type=\"hidden\" value=\"$file\" >");
	echo("<textarea name=\"filedataeditor\" id=\"filedataeditor\" rows=\"40\" cols=\"90\" maxlenght=200>");
	$ok=show_file_php($file);
	if (!$ok){
		echo("$err");
	}
	echo("</textarea>");
	echo("<br /><br />");
	echo("<input id=\"submit\" type=\"submit\" name=\"submit\" value=\"$button\">");
	echo("</form>");
	echo("</center>");
}


function post_data_save_file($name,$data){
	$ret=FALSE;
	$filename=get_postdata($name);
	$filedata=get_postdata($data);
	if (($filedata<>"")and($filename<>"")){
		$filedata=normal_file_content($filedata);
		$db=strlen($filedata);
		if (file_exists($filename)){
			rename($filename,$filename.".old");

		}
        $file=fopen($filename,"x+");
        fwrite($file, $filedata);
        fclose($file);
        $ret=TRUE;
	}
	return($ret);
}


function post_create_dir($defdir,$dirn){
	$ret=FALSE;
	$dirname=get_postdata($defdir);
	if ($dirname<>""){
		if (substr($dirname,strlen($dirname),1)<>"/"){
			$dirname=$dirname."/";
		}
	}
	$dirname=$dirname.get_postdata($dirn);
	if ($dirname<>""){
		$dirname=change_name($dirname);
		if (mkdir($dirname,0777)){
			$ret=TRUE;
		}
	}
	return($ret);
}



function post_create_link($dir,$dirn){
	$ret=FALSE;
	$dirname=get_postdata('defdir');
	if ($dirname<>""){
		if (substr($dirname,strlen($dirname),1)<>"/"){
			$dirname=$dirname."/";
		}
	}
	$dirname=$dirname.get_postdata($dirn);
	if ($dirname<>""){
		$dirname=change_name($dirname);
		if (symlink($dir,$dirname)){
			$ret=TRUE;
		}
	}
	return($ret);
}


function post_delete_dir($dirn){
	$ret=FALSE;
	$dir=get_postdata($dirn);
	if (is_dir($dir)){
		$objects=scandir($dir);
		foreach($objects as $object){
			if ($object!="."&&$object!=".."){
				if (filetype($dir."/".$object)=="dir"){
					post_delete_dir($dir."/".$object);
				}else{
					$ret=unlink($dir."/".$object);
				}
			}
		}
		$ret=rmdir($dir);
	}
	return($ret);
}


function post_delete_file($dirn,$filen){
	$ret=FALSE;
	if (($dirn<>"")and($filen<>"")){
		$dir=get_postdata($dirn);
		if ($dir<>""){
			$file=$dir."/".get_postdata($filen);
			if ((!is_dir($file))and(file_exists($file))){
				$ret=unlink($file);
			}
		}
	}
	return($ret);
}


function minus_dir($dir){
	while ((!is_dir($dir))and(strlen($dir)>0)){
		$dir=substr($dir,0,strlen($dir)-1);
	}
	if (substr($dir,strlen($dir)-1,1)=="/"){
		$dir=substr($dir,0,strlen($dir)-1);
	}
	return($dir);
}


function post_upload_image($dir,$field,$submit,$prename){
	$ret=FALSE;
	if (isset($_FILES[$field])){
		$target_file=basename($_FILES[$field]["name"]);
		$target_file=name_to_dir($target_file);
		$dir=name_to_dir($dir);
		if ($target_file<>""){
			if ($prename<>""){
				$target_file=$dir."/".$prename.$target_file;
			}else{
				$target_file=$dir."/".$target_file;
			}
			$imagetype=pathinfo($target_file,PATHINFO_EXTENSION);
			if(get_postdata($submit)<>"") {
				$check=getimagesize($_FILES[$field]["tmp_name"]);
				if($check){
					$ret=TRUE;
				} else {
					$ret=FALSE;
				}
			}
			if (file_exists($target_file)){
			}
			if ($_FILES[$field]["size"]>5000000){
				$ret=FALSE;
			}
			if ($imagetype!="jpg"
				&& $imagetype!="png"
				&& $imagetype!="jpeg"
				&& $imagetype!="gif") {
				$ret=FALSE;
			}
			if ($ret){
				if (move_uploaded_file($_FILES[$field]["tmp_name"],$target_file)){
					$ret=TRUE;
				} else {
					$ret=FALSE;
				}
			}
		}
	}
	return($ret);
}


function post_upload_file($dir,$field,$submit){
	$target_file=basename($_FILES[$field]["name"]);
	$target_file=name_to_dir($target_file);
	$dir=name_to_dir($dir);
	$ret=FALSE;
	if ($target_file<>""){
		$target_file=$dir."/".$target_file;
		$imagetype=pathinfo($target_file,PATHINFO_EXTENSION);
		if(get_postdata($submit)<>"") {
			$ret=TRUE;
		}
		if (file_exists($target_file)){
		}
		if ($_FILES[$field]["size"]>10000000){
			$ret=FALSE;
		}
		if ($ret){
			if (move_uploaded_file($_FILES[$field]["tmp_name"],$target_file)){
				$ret=TRUE;
			} else {
				$ret=FALSE;
			}
		}
	}
	return($ret);
}


function show_file_in_box($file,$divopen,$divend){
	echo($divopen);
	include($file);
	echo("<br /><br />");
	echo("<br /><br />");
	echo($divend);
}


function show_file_in_box_php($file,$divopen,$divend){
	echo($divopen);
	//include($file);
	show_file_php($file);
	echo("<br /><br />");
	echo("<br /><br />");
	echo($divend);
}




function dir_show($dir,$dir2,$link){
	if (is_dir($dir)){
		echo("<center><table width=100% text-align=center border=0px>");
		$cdir=scandir("$dir");
		$first="";
		echo("<tr>");
		echo("<td width=30% align=left valign=top>");
		echo("");
		foreach ($cdir as $key => $value){
			if (!in_array($value,array(".","..",".htaccess","index.php"))){
				if ($first==""){
					$first=$value;
				}
				$l2=$link.$value;
				echo("<a href=$l2>");
				$v=str_replace('_',' ',$value);
				$v=str_replace('+','\' ',$v);
				echo("$v");
				echo("</a><br />");
			}
		}
		echo("</td>");
		$akt=get_sublink("dir");
		if ($akt==""){
			$akt=$first;
		}
		echo("<td align=left valign=top>");
		include("$dir/$akt/index.php");
		echo("</td>");
		echo("</table>");
	}

}



?>
