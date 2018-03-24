<?php

 #
 # Helpdesk
 #
 # info: main folder copyright file
 #
 #



function hd_formdata(){
	global $REQUEST_DATA;

	if ($REQUEST_DATA["fname"]<>""){
		$id=id();
		$fname=valid_input($REQUEST_DATA["fname"]);
		$lname=valid_input($REQUEST_DATA["lname"]);
		$address=valid_input($REQUEST_DATA["address"]);
		$city=valid_input($REQUEST_DATA["city"]);
	}

	if ($lname<>""){
		$sqlinsert="insert into nevek value (
						\"$id\",
						\"$lname\",
						\"$fname\",
						\"$address\",
						\"$city\")";
		echo($sqlinsert);
		sql_run_command($sqlinsert);
	}
}


function hd_formdata_in(){
	$ret="";
	if (count($_POST)>0){
		$sid=id();
		$sname=valid_input(get_postdata("tname"));
		$susz=valid_input(get_postdata("tusz"));
		$stsz=valid_input(get_postdata("ttsz"));
		$smail=valid_input(get_postdata("tmail"));
		$smess=valid_input(get_postdata("tmess"));
		$sstat="Új bejelentés";
		$swork="";
		$shour=0;
		$skm=0;
		$sdat="";
		$sell=valid_input(get_postdata("tell"));
		$sell2=valid_input(get_postdata("tell2"));
		if ($sell==$sell2){
			$ret=$sid;
		}else{
			$ret="-";
		}
		$sizeret=strlen($ret);
		if ($sizeret>10){
			if ((($sname<>"")and($smess<>""))and
				(($stsz<>"")or($smail<>""))){
				$sqlinsert="insert into tickets value (
								\"$sid\",
								\"$sname\",
								\"$susz\",
								\"$stsz\",
								\"$smail\",
								\"$smess\",
								\"$sstat\",
								\"$swork\",
								\"$shour\",
								\"$skm\",
								\"$sdat\")";
				sql_run_command($sqlinsert);
			}else{
				$ret="-";
			}
		}
	}
	return($ret);
}


function hd_new_partner(){
	$ret="";
	if (count($_POST)>0){
		$new=FALSE;
		$sid=valid_input(get_postdata("pid"));
		if (sid==""){
			$sid=id();
			$new=TRUE;
		}
		$sname=valid_input(get_postdata("pname"));
		$spw=valid_input(get_postdata("ppw"));
		$sszsz=valid_input(get_postdata("pszsz"));
		$stn=valid_input(get_postdata("ptn"));
		$saddr=valid_input(get_postdata("paddr"));
		$stsz=valid_input(get_postdata("ptsz"));
		$smail=valid_input(get_postdata("pmail"));
		#$sell=valid_input(get_postdata("tell"));
		#$sell2=valid_input(get_postdata("tell2"));
		#if ($sell==$sell2){
			$ret=$sid;
		#}else{
		#	$ret="-";
		#}
		$sizeret=strlen($ret);
		if ($sizeret>10){
			if (($sname<>"")and($spw<>"")and
				($sszsz<>"")and($smail<>"")and
				($stn<>"")){
				if ($new){
					$sqlinsert="insert into partner value (
								\"$sid\",
								\"$sname\",
								\"$spw\",
								\"$sszsz\",
								\"$stn\",
								\"$saddr\",
								\"$stsz\",
								\"$smail\")";
					sql_run_command($sqlinsert);
					$c=count($USERS_LINES);
					new_user($sname,$spass,"");
				}else{
					$sqlinsert="update partner set
								pid=\"$sid\",
								pname=\"$sname\",
								ppw=\"$spw\",
								pszsz=\"$sszsz\",
								ptn=\"$stn\",
								paddr=\"$saddr\",
								ptsz=\"$stsz\",
								pmail=\"$smail\" where pid=\"$sid\" ";
					sql_run_command($sqlinsert);
				}
			}else{
				$ret="-";
			}
		}
	}
	return($ret);
}


function hd_formdata_partchange(){
	$ret="";
	$errid=valid_input(get_postdata("partcode"));
	$partid=valid_input(get_postdata("partnev"));
	$datah=hd_datatable_row_in2($errid);
	$datap=hd_partner_get_alldata_id($partid);
	$sid=$errid;
	$sname=$datap[4];
	$susz=$datap[3];
	$stsz=$datap[6];
	$smail=$datap[7];
	$smess=$datah[5];
	$sstat=$datah[6];
	$swork=$datah[7];
	$shour=$datah[8];
	$skm=$datah[9];
	$sdat=$datah[10];
	$ret=$sid;
	$sizeret=strlen($ret);
	if ($sizeret>10){
		$sqlinsert="update tickets set
						tid=\"$sid\",
						tname=\"$sname\",
						tusz=\"$susz\",
						ttsz=\"$stsz\",
						tmail=\"$smail\",
						tmess=\"$smess\",
						tstat=\"$sstat\",
						twork=\"$swork\",
						thour=\"$shour\",
						tkm=\"$skm\",
						tdat=\"$sdat\" where tid=\"$sid\" ";
		sql_run_command($sqlinsert);
	}
	return($ret);
}



function hd_formdata_change(){
	global $PORTAL_NAME;

	$ret="";
	$sid=valid_input(get_postdata("tid"));
	$sname=valid_input(get_postdata("tname"));
	$susz=valid_input(get_postdata("tusz"));
	$stsz=valid_input(get_postdata("ttsz"));
	$smail=valid_input(get_postdata("tmail"));
	$smess=valid_input(get_postdata("tmess"));
	$sstat=valid_input(get_postdata("tstat"));
	$swork=valid_input(get_postdata("twork"));
	$shour=valid_input(get_postdata("thour"));
	$skm=valid_input(get_postdata("tkm"));
	$sdat=valid_input(get_postdata("tdat"));
	$stomail=valid_input(get_postdata("ttomail"));
	$ret=$sid;
	$sizeret=strlen($ret);
	if ($sizeret>10){
		$sqlinsert="update tickets set
						tid=\"$sid\",
						tname=\"$sname\",
						tusz=\"$susz\",
						ttsz=\"$stsz\",
						tmail=\"$smail\",
						tmess=\"$smess\",
						tstat=\"$sstat\",
						twork=\"$swork\",
						thour=\"$shour\",
						tkm=\"$skm\",
						tdat=\"$sdat\" where tid=\"$sid\" ";
		sql_run_command($sqlinsert);
		if (strlen($stomail)>0){
			$mess="<html>";
			$mess=$mess."<body>";
			$mess=$mess."Tisztelt Ügyfelünk!<br /><br />";
			$mess=$mess."Értesítjük, hogy a $sid azonosítójú hiba állapota megváltozott.<br />";
			$mess=$mess."Állapot: $sstat<br /><br />";
			$mess=$mess."Üdvözlettel:<br />$PORTAL_NAME";
			$mess=$mess."</body>";
			$mess=$mess."</html>";
			hd_formdata_to_mail_2($mess);
		}
	}
	return($ret);
}


function hd_formdata_to_mail_2($mess){
	global $SMTP_TO,$PHPMAIL,$PORTAL_NAME;


	if ($PHPMAIL){
		mail($SMTP_TO,$PORTAL_NAME,$mess);
	}else{
		smtp_mail_sendto($SMTP_TO,$mess);
	}
}


function hd_formdata_to_mail(){
	global $GETDATA,$SMTP_TO,$PORTAL_ADMIN_MAIL,$PHPMAIL,$PORTAL_NAME;

	$ret="";
	$pcount=count($_POST);
	$name="";
	$email="";
	$mess="";
	if ($pcount>2){
		$id=id();
		$name=valid_input(get_postdata("fname"));
		$email=valid_input(get_postdata("email"));
		$mess=valid_input(get_postdata("message"));
		$ell=valid_input(get_postdata("kell"));
		$ell2=valid_input(get_postdata("kell2"));
		if (($name<>"")and($email<>"")and($mess<>"")and($ell==$ell2)){
			if ($PHPMAIL){
				$mess="Feladó: ".$name." - ".$email." - ".$mess;
				mail($SMTP_TO,$PORTAL_NAME,$mess);
			}else{
				$mess="Feladó: ".$name." - ".$email." <br /><br />".$mess;
				smtp_mail_sendto($SMTP_TO,$mess);
			}
			$ret="123456";
		}else{
			$ret="-";
		}
	}
	return($ret);
}



function hd_deldata(){
	$ret="";
	$del=valid_input(get_sublink("del"));
	if ($del<>""){
		$ret=$del;
		$sqlcomm="delete from tickets where tid=\"".$del."\"";
		sql_run_command($sqlcomm);
	}
	return($ret);
}



function hd_partner_del(){
	$ret="";
	$del=valid_input(get_sublink("del"));
	if ($del<>""){
		$ret=$del;
		$sqlcomm="delete from partner where pid=\"".$del."\"";
		sql_run_command($sqlcomm);
		$name=get_user_name();
		$pass=get_user_pwd();
		del_user($name,$pass);
	}
	return($ret);
}




function hd_datatable_in($link,$dellink,$buttonclass){
	global $ROW_PER_TABLE_PAGE;

	$lap=get_table_page("tp");
	$ret="";
	$felt="";
	$szdat=get_postdata("xdat");
	$sznev=get_postdata("xceg");
	if ($szdat<>""){
		$felt="where tid like '%$szdat"."%'";
	}
	if ($sznev<>""){
		$felt="where tname like '%$sznev"."%'";
	}
	$sqlcomm="select * from tickets $felt order by tid desc";
	sql_run_command($sqlcomm);
	$db=sql_result_num();
	if ($db>100){
		#$db=100;
	}
	$i=($lap-1)*$ROW_PER_TABLE_PAGE;
	$ig=$i+$ROW_PER_TABLE_PAGE;
	if ($ig>$db){
		$ig=$db;
	}
	if ($ROW_PER_TABLE_PAGE>$db){
		$i=0;
		$ig=$db;
	}
	if ($i==$ig){
		$i--;
	}
	echo("<table>");
	echo("<tr><th>Beérkezés ideje</th><th>Azonosító</th><th>Bejelentő</th><th>Állapot</th>");
	if ($link<>""){
	}
	echo("</tr>");
	echo("<tr>");
	while ($i<$ig){
		$data=sql_result($i);
		if ($data[8]==0){
			echo("<tr>");
			$out=id_to_onlydate($data[0]);
			echo("<td>$out</td>");
			if ($link<>""){
				$l=$link.$data[0];
				echo("<td><a href=$l>$data[0]</a>");
				$d=$dellink.$data[0];
				echo(" - <a href=$d>Töröl</td>");
			}else{
				echo("<td>$data[0]</td>");
			}
			echo("<td>$data[1]</td>");
			if ($data[10]<>""){
				echo("<td>Lezárva</td>");
			}else{
				echo("<td>$data[6]</td>");
			}
			echo("</tr>");
		}
		$i++;
	}
	echo("</table>");
	$l=$link;
	table_pager($lap,$db,$l,$buttonclass);
	return($link);
}


function hd_datatable_partner($link,$buttonclass,$szsz){
	global $ROW_PER_TABLE_PAGE;

	$lap=get_table_page("tp");
	$ret="";
	$felt="";
	if ($szsz<>""){
		$felt="where tusz like '%$szsz"."%'";
	}
	$sqlcomm="select * from tickets $felt order by tid desc";
	sql_run_command($sqlcomm);
	$db=sql_result_num();
	if ($db>100){
		#$db=100;
	}
	$i=($lap-1)*$ROW_PER_TABLE_PAGE;
	$ig=$i+$ROW_PER_TABLE_PAGE;
	if ($ig>$db){
		$ig=$db;
	}
	if ($ROW_PER_TABLE_PAGE>$db){
		$i=0;
		$ig=$db;
	}
	if ($i==$ig){
		$i--;
	}
	echo("<table>");
	echo("<tr><th>Beérkezés ideje</th><th>Hiba</th><th>Állapot</th>");
	if ($link<>""){
	}
	echo("</tr>");
	echo("<tr>");
	while ($i<$ig){
		$data=sql_result($i);
		if ($data[8]==0){
			echo("<tr>");
			$out=id_to_onlydate($data[0]);
			echo("<td>$out</td>");
			echo("<td>$data[5]</td>");
			if ($data[10]<>""){
				echo("<td>Lezárva</td>");
			}else{
				echo("<td>$data[6]</td>");
			}
			echo("</tr>");
		}
		$i++;
	}
	echo("</table>");
	$l=$link;
	table_pager($lap,$db,$l,$buttonclass);
	return($link);
}



function hd_partnertable($link,$dellink,$buttonclass){
	global $ROW_PER_TABLE_PAGE;

	$lap=get_table_page("tp");
	$ret="";
	$sqlcomm="select * from partner";
	sql_run_command($sqlcomm);
	$db=sql_result_num();
	$i=($lap-1)*$ROW_PER_TABLE_PAGE;
	$ig=$i+$ROW_PER_TABLE_PAGE;
	if ($ig>$db){
		$ig=$db;
	}
	if ($ROW_PER_TABLE_PAGE>$db){
		$i=0;
		$ig=$db;
	}
	echo("<table>");
	echo("<tr><th>Azonosító</th><th>Teljes név</th><th>Szerződészám</th>");
	if ($link<>""){
	}
	echo("</tr>");
	echo("<tr>");
	if ($i==$ig){
		$i--;
	}
	while ($i<$ig){
		$data=sql_result($i);
		echo("<tr>");
		if ($link<>""){
			$l=$link.$data[0];
			echo("<td><a href=$l>$data[0]</a>");
			$d=$dellink.$data[0];
			echo(" - <a href=$d>Töröl</a></td>");
		}else{
			echo("$data[0]</td>");
		}
		echo("<td>$data[4]</td>");
		echo("<td>$data[3]</td>");
		echo("</tr>");
		$i++;
	}
	echo("</table>");
	$l=$link;
	table_pager($lap,$db,$l,$buttonclass);
	return($link);
}


function hd_datatable_in2(){
	$ret="";
	$sqlcomm="select * from tickets order by tid desc";
	sql_run_command($sqlcomm);
	$db=sql_result_num();
	if ($db>30){
		$db=30;
	}
	echo("<table>");
	echo("<tr><th>Beérkezés ideje</th><th>Azonosító</th><th>Állapot</th>");
	if ($link<>""){
	}
	echo("</tr>");
	echo("<tr>");
	for($i=0;$i<$db;$i++){
		$data=sql_result($i);
		if ($data[8]==0){
			echo("<tr>");
			$out=id_to_onlydate($data[0]);
			echo("<td>$out</td>");
			echo("<td>$data[0]</td>");
			if ($data[10]<>""){
				echo("<td>Lezárva</td>");
			}else{
				echo("<td>$data[6]</td>");
			}
			echo("</tr>");
		}
	}
	echo("</table>");
	return($ret);
}


function hd_datatable_row_in($code,$del){
	global $GETDATA,$REQUEST_DATA;

	if ($REQUEST_DATA[$code]<>""){
		$c=$REQUEST_DATA[$code];
		$d=$REQUEST_DATA[$del];
		$GETDATA=TRUE;
	}
	if ($d<>""){
		$sqlcomm="delete from tickets where tid=\"".$d."\"";
		sql_run_command($sqlcomm);
	}
	$sqlcomm="select * from tickets where tid=\"".$c."\"";
	sql_run_command($sqlcomm);
	$db=sql_result_num();
	if ($db>0){
		$ret=sql_result(0);
	}else{
		$ret=array("","","","","","","","","","","",);
	}
	return($ret);
}


function hd_datatable_row_in2($c){
	$sqlcomm="select * from tickets where tid=\"".$c."\"";
	sql_run_command($sqlcomm);
	$db=sql_result_num();
	if ($db>0){
		$ret=sql_result(0);
	}else{
		$ret=array("","","","","","","","","","","",);
	}
	return($ret);
}


function hd_partner_get(){
	$c=get_user_name();
	$sqlcomm="select * from partner where pname=\"".$c."\"";
	sql_run_command($sqlcomm);
	$db=sql_result_num();
	$ret="";
	if ($db>0){
		$x=sql_result(0);
		$ret=$x[3];
	}
	return($ret);
}


function hd_partner_get_alldata(){
	$c=get_user_name();
	$sqlcomm="select * from partner where pname=\"".$c."\"";
	sql_run_command($sqlcomm);
	$db=sql_result_num();
	$ret=array();
	if ($db>0){
		$ret=sql_result(0);
	}
	return($ret);
}


function hd_partner_get_alldata_id($id){
	$sqlcomm="select * from partner where pid=\"".$id."\"";
	sql_run_command($sqlcomm);
	$db=sql_result_num();
	$ret=array();
	if ($db>0){
		$ret=sql_result(0);
	}
	return($ret);
}


function hd_partner_getall(){
	$c=get_user_name();
	$sqlcomm="select * from partner";
	sql_run_command($sqlcomm);
	$db=sql_result_num();
	#$ret=array();
	if ($db>0){
		$ret=sql_result_alldata();
	}
	return($ret);
}

?>
