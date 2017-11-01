<?php

 #
 # PHPPortal
 #
 # info: main folder copyright file
 #
 #

global $MYSQL_SERVER,
       $MYSQL_PORT,
       $MYSQL_DATABASE,
       $MYSQL_USER,
       $MYSQL_PASSWORD,
       $MYSQL_LINK,
       $MYSQL_RESULT;



	function sql_server_close(){
		sql_connect_close();
	}


	function sql_server_connect(){
		global 	$MYSQL_SERVER,
				$MYSQL_PORT,
				$MYSQL_DATABASE,
				$MYSQL_USER,
				$MYSQL_PASSWORD,
				$MYSQL_LINK,
				$MYSQL_RESULT;

		$MYSQL_LINK="";
		$MYSQL_LINK=mysqli_connect($MYSQL_SERVER,$MYSQL_USER,$MYSQL_PASSWORD,$MYSQL_DATABASE);
		$sql_error=mysqli_error($MYSQL_LINK);
		if ($sql_error<>""){
		}
	}


	function sql_server_query($sqlcomm){
		global	$MYSQL_LINK,
				$MYSQL_RESULT;

		$MYSQL_RESULT=mysqli_query($MYSQL_LINK,$sqlcomm);
		$sql_error=mysqli_error($MYSQL_LINK);
		if ($sql_error<>""){
			echo("$sql_error");
		}
	}


	function sql_connect_close(){
		global $MYSQL_LINK;

		if ($MYSQL_LINK){
			mysqli_close($MYSQL_LINK);
			$MYSQL_LINK="";
		}
	}


	function sql_run_command($sql_command){
		global 	$MYSQL_SERVER,
				$MYSQL_PORT,
				$MYSQL_DATABASE,
				$MYSQL_USER,
				$MYSQL_PASSWORD,
				$MYSQL_LINK,
				$MYSQL_RESULT;

		sql_server_connect($MYSQL_SERVER,$MYSQL_USER,$MYSQL_PASSWORD,$MYSQL_DATABASE);
		if ($MYSQL_LINK){
			sql_server_query($sql_command);
			sql_server_close();
		}
	}


	function sql_result_num(){
		global $MYSQL_RESULT;

		if ($MYSQL_RESULT){
			$d=mysqli_num_rows($MYSQL_RESULT);
		}else{
			$d=0;
		}
		return($d);
	}


	function sql_result_fields(){
		global $MYSQL_RESULT;

		if ($MYSQL_RESULT){
			$d=mysqli_num_fields($MYSQL_RESULT);
		}else{
			$d=0;
		}
		return($d);
	}


	function sql_result_alldata(){
		global $MYSQL_RESULT;

		$d=$MYSQL_RESULT;
		return($d);
	}


	function sql_result($s){
		global $MYSQL_RESULT;

		if ($MYSQL_RESULT){
			if (mysqli_num_rows($MYSQL_RESULT)>$s){
				#$d=mysqli_result($MYSQL_RESULT,$s,$o);
				$MYSQL_RESULT->data_seek($s);
				$datarow=$MYSQL_RESULT->fetch_array();
			}
		}
		return($datarow);
	}


	function sql_table_search($table,$field,$q){
		global $MYSQL_RESULT;

		if (($table<>"")and($field<>"")and($q<>"")){
			$q=trim($q);
			$sqlcommand="select * from $table where $field like '%$q%';";
			$MYSQL_RESULT=sql_run_command($sqlcommand);
		}
	}


	function sql_result_all($s){
		global $MYSQL_RESULT;

		if (mysqli_num_rows($MYSQL_RESULT)>$s){
			$MYSQL_RESULT->data_seek($s);
			$MYSQL_RESULT=mysqli_fetch_row($MYSQL_RESULT);
		}
	}


	function sql_delete_alldata_table($tn){
		if ($tn<>""){
			$sqlcommand="delete from $tn;";
			sql_run_command($sqlcommand);
		}
	}


	function sql_insert_data_table($to,$tn){
		if ($tn<>""){
		$c=count($to);
		$v=0;
		$sqlcommand="insert into $tn values(";
		while ($v<$c){
			if ($v>0){
			$sqlcommand=$sqlcommand.",";
			}
			$sqlcommand=$sqlcommand.'"'.$to[$v].'"';
			$v++;
		}
		$sqlcommand=$sqlcommand.");";
		sql_run_command($sqlcommand);
		}
	}


	function sql_table_insert_data($table,$data){
		$sqlcommand="insert into $table values (";
		$x=count($data);
		$y=0;
		while($y<$x){
			if ($y<>0){
			$sqlcommand=$sqlcommand.",";
		}
		$sqlcommand=$sqlcommand."\"".$data[$y]."\"";
		$y++;
		}
		$sqlcommand=$sqlcommand.");";
		sql_run_command($sqlcommand);
  }



	function sql_table_update_data($table,$data,$rowname,$fname,$where){
		$sqlcommand="update $table set ";
		$x=count($data);
		$y=0;
		while($y<$x){
			if ($y<>0){
				$sqlcommand=$sqlcommand.",";
			}
		$sqlcommand=$sqlcommand."$rowname[$y]=\"".$data[$y]."\"";
		$y++;
		}
		$sqlcommand=$sqlcommand." where $fname=\"$where\";";
		sql_run_command($sqlcommand);
	}


	function sql_table_delete_data($table,$field,$data){
		$sqlcommand="delete from $table where $field=\"$data\";";
		sql_run_command($sqlcommand);
	}


	function sql_table_select($table,$name,$where,$order,$desc){
		$sqlcommand="select *";
		$sqlcommand=$sqlcommand." from $table ";
		if ($where<>""){
			$sqlcommand=$sqlcommand." where $name=\"$where\" ";
		}
		if ($order<>""){
			$sqlcommand=$sqlcommand." order by $order ";
		}
		if ($desc<>""){
			$sqlcommand=$sqlcommand." desc ";
		}
		$sqlcommand=$sqlcommand.";";
		sql_run_command($sqlcommand);
	}


	function sql_pack_command($sqlresult,$command){
		$x=count($command);
		$y=0;
		while ($y<$x){
			$sqlresult[$y]=$sqlresult[$y].sql_run_command($command[$y]);
			$y++;
		}
	}


	function sql_db_create($db){
		$sqlcommand="create database $db;";
		sql_run_command($sqlcommand);
	}


	function sql_table_create($tname,$tabledata,$tablevar,$mess){
		$sqlcommand="create table $tname (";
		$x=count($tabledata);
		$y=0;
		while ($y<$x){
			$sqlcommand=$sqlcommand."$tabledata[$y] $tablevar[$y], ";
			$y++;
		}
		$sqlcommand=$sqlcommand." unique ($tabledata[0])";
		$sqlcommand=$sqlcommand.");";
		sql_run_command($sqlcommand);
	}


	function sql_db_delete($db){
		$sqlcommand="drop database $db;";
		sql_run_command($sqlcommand);
	}


	function sql_table_delete($tname){
		$sqlcommand="drop table $tname;";
		sql_run_command($db,$sqlcommand);
	}


?>
