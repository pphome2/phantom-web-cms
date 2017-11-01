<?php

 #
 # PHPPortal
 #
 # info: main folder copyright file
 #
 #



$DIR_CONFIG="../config";
$DIR_LIB="../lib";
$DIR_INCLUDE="../include";
$DIR_IMAGES="../images";
$DIR_PLUGINS="../plugins";
$DIR_TEMPLATE="../template";
$DIR_CONTENT="../content";
$DIR_LOG="../log";

$SYSTEM_FILES=array("$DIR_CONFIG/config.php",
					"$DIR_LIB/mysql.php",
					"$DIR_LIB/smtp.php",
					"$DIR_LIB/user-1.php",
					"$DIR_LIB/user-2.php",
					"$DIR_LIB/lib-1.php",
					"$DIR_LIB/lib-2.php",
					"$DIR_LIB/lib-lang.php",
					"$DIR_LIB/lib-user.php");

$SYSTEM_ADMIN_FILES=array("$DIR_LIB/admin.php",
				"$DIR_LIB/admin-cont.php",
				"$DIR_LIB/admin-ot.php",
				"$DIR_LIB/admin-log.php",
				"$DIR_LIB/admin-user.php");

$ACTIVE_PLUGINS=array("Helpdesk","slimbox","modalbox");
$ACTIVE_PLUGINS_PAGE_END=array("slimbox2","modalbox2");

$ACTIVE_ADMIN_PLUGINS=array("Helpdesk","slimbox","editor");
$ACTIVE_ADMIN_PLUGINS_PAGE_END=array("slimbox2","editor2",);

$ADMIN_TEMPLATE="ad";

# mail form send data to other site
$MAILGATE="#";

# inside variable initilaized - no change!

$MAIN_JS=FALSE;
$LOAD_OK=FALSE;
$SYSTEM_MESSAGE="";
$SITE_TEMPLATE="";
$MYSQL_RESULT;
$MYSQL_LINK;
$REQUEST_DATA=array();
$REQUEST_DATA_POST=array();
$CONTENT_CONTAINER_OPEN="";
$CONTENT_CONTAINER_END="";

$LANGUAGE_TITLE="en";
$LANGUAGE_TITLE_ADMIN="en";
$LANGUAGE_AVAIL_LANG=array();
#$LANGUAGE_AVAIL_LANG=array("hu","en");

$LANGUAGE_LINES=array();
$LANGUAGE_CHANGE=FALSE;
$LANGUAGE_FILE_NAME="lang.";

$USERS_FILE="users";
$USERS_CHANGE=FALSE;
$USERS_ROLE=array("Felhasználó","Szerkesztő","Adminisztrátor");
$ROLE_EDITOR="Szerkesztő";
$ROLE_ADMIN="Adminisztrátor";
$USERS_LINES=array("admin;21232f297a57a5a743894a0e4a801fc3;$ROLE_ADMIN");
$USERS_SEPARATOR=";";
$USER_EDITOR=FALSE;
$USER_ADMIN=FALSE;
$EDIT_IN_PAGE=TRUE;
$EDIT_IN_PAGE_LINK="";
$LOGIN_TIME="10000";
$LOGIN_CONTENT="Login";

$COOKIE_AGE=10000;

$GETDATA=FALSE;
$ROW_PER_TABLE_PAGE=50;

$ADMIN_SITE=FALSE;

$PAGE_NAME="page";
$INDEX_FILE="index.php";
$INDEX_CSS_FILE="index.css";
$DEFAULT_CSS="default.css";

$SYSTEM_MENU=array();
$SYSTEM_MENU_PLUGIN=array();
$SYSTEM_MENU_PLUGIN_FUNC=array();

$LOGGED_IN_USER=FALSE;

$FREELIC=TRUE;
$LICFILE="lic";
$VALID="20170519";


?>
