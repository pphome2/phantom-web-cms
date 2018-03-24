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
			$ADMIN_SITE=TRUE;
			$SITE_TEMPLATE=$TEMPLATE;
			$TEMPLATE=$ADMIN_TEMPLATE;
			$ACTIVE_PLUGINS=$ACTIVE_ADMIN_PLUGINS;
			$ACTIVE_PLUGINS_PAGE_END=$ACTIVE_ADMIN_PLUGINS_PAGE_END;
			main_admin();
			main();
			include("$DIR_TEMPLATE/$ADMIN_TEMPLATE/index.php");
			main_page_end();
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
