<div class=content_box>
<div class=content_box>
<div class=content_box>
<br /><br />
<br /><br />
<br /><br />
<br /><br />
<center>
<img src="../content/Login/login.png">
</center>
<br /><br />
<br /><br />
<br /><br />
<?php
    if (logged()){
	echo("Sikeres bejelentkezés.");
?>
	<br /><br />
	<br /><br />
	<center>
	<form action="" method=post enctype=multipart/form-data>
	<br /><br />
	<input type=hidden name="logout" id="logout" value="logout">
	<input id=submit type=submit name=subm value=Kijelentkezés>
	</form>
	<br /><br />
	<br /><br />
	<br /><br />

<?php    }else{ ?>

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

<?php } ?>

</div>
</div>
</div>
<br /><br />