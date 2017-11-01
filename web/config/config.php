<?php

 #
 # PHPPortal
 #
 # info: main folder copyright file
 #
 #

# configuration - need change it

$COPYRIGHT="© 2017. ";

$PORTAL_NAME="Helpdesk2";
$PORTAL_DEV="Webstarthely.hu";
$PORTAL_ADMIN_NAME="p";
$PORTAL_ADMIN_PASSWORD="83878c91171338902e0fe0fb97a8c47a";
# p (generate: echo password -n |md5sum)
$PORTAL_ADMIN_PASSWORD_MD5=TRUE;
$PORTAL_ADMIN_MAIL="webstarthely.hu@gmail.com";
$PORTAL_ADMIN_MAIL2="webstarthely.hu@gmail.com";

$MYSQL_SERVER="localhost";
$MYSQL_PORT="";
$MYSQL_DATABASE="teszt";
$MYSQL_USER="root";
$MYSQL_PASSWORD="DebianLinux";

$SMTP_HOST="ssl://smtp.gmail.com";
$SMTP_SECURE="ssl";
$SMTP_PORT="465";
#$SMTP_PORT="587";
$SMTP_USER="webstarthely.hu@gmail.com";
$SMTP_PASSWORD="Web2015start1hely.hu";
$SMTP_FROM="webstarthely.hu@gmail.com";
$SMTP_DOMAIN="gmail.com";
$SMTP_TO="webstarthely.hu@gmail.com";
$PHPMAIL=FALSE;

$TEMPLATE="helpdesk";

$USERS_MENU=array();

$LICMESSAGE="<br /><br />";

# change in program

$SMTP_SUBJECT=$PORTAL_NAME." - Üzenet";
$SMTP_MESSAGE="";
$SMTP_HEADERS="Content-Type: text/html; charset=UTF-8";


?>
