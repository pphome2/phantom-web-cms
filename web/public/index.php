<?php

 #
 # PHPPortal
 #
 # info: main folder copyright file
 #
 #


	if (file_exists("../lib/main.php")){
		include("../lib/main.php");
		if ($LOAD_OK){
			main();
			$page=get_page_name();
			if ($page==""){
				$page=$INDEX_FILE;
				include("$DIR_TEMPLATE/$TEMPLATE/$page");
			}else{
				include("$DIR_CONTENT/$page/$INDEX_FILE");
			}
			main_page_end();
		}
	}else{
		if (file_exists("error.php")){
			include("error.php");
		}else{
		    echo("Rendszerhiba...");
		}
	}
	if (!$LOAD_OK){
		if (file_exists("error.php")){
			include("error.php");
		}else{
		    echo("Rendszerhiba...");
		}
	}
?>
