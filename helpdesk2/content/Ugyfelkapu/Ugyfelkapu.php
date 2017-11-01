<div class=content_box>
<section id="three" class="wrapper align-center">
<div class="inner">
<h3><b>Hibabejelentések kezelése</b></h3>
<br />

<?php
if (logged()){
	$n=get_user_name();
	$szsz=hd_partner_get();
	if ($szsz==""){
	    $szsz2=" - ";
	}else{
	    $szsz2=$szsz;
	}
	echo("<b>$n</b> bejelentkezve. Ügyfél/szerződés száma: $szsz2");
?>
	<center>
	<form action="" method=post enctype=multipart/form-data>
	<br /><br />
	<input type=hidden name="logout" id="logout" value="logout">
	<input id=submit type=submit name=subm value=Kijelentkezés>
	</form>
	<br /><br />
	<br /><br />
	</center>

<?php
	$link="?content=Ugyfelkapu";
	echo("<b>Az Ön által bejelentett hibák:</b><br /><br />");
	hd_datatable_partner($link,"buttonx",$szsz);
	echo("<br /><br /><br /><br />");

}else{ 

?>

	<br /><br />
	<br /><br />
	<center>
	<img src="../content/Login/login.png">
	</center>
	<br /><br />
	<center>
	<form action="" method=post enctype=multipart/form-data>
	Felhasználónév:
	<br /><br />
	<input type=text name="username" id="username">
	<br /><br />
	Jelszó:
	<br /><br />
	<input type=password name="password" id="password">
	<br /><br />
	<br /><br />
	<input id=submit type=submit name=subm value=Bejelentkezés>
	</form>
	</center>

<?php

}


?>

<br /><br />
<img src="../content/Login/login.png">
<br /><br />
</div>
</section>
<br /><br />