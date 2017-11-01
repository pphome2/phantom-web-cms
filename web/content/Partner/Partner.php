<div class=content_box>
<br /><br />
<br /><br />
<br /><br />
<div class="inner">
	<center><h3><b>Partnerek kezelése</b></h3></center>
</div>
<br /><br />
<?php

if (logged()){
}

global $USER_ADMIN;

if ($USER_ADMIN){
	$code=hd_new_partner();
	if ($code<>""){
		echo("<b>Új partner felvétele megtörtént.</b><br /><br />");
	}
	$link="?content=Partner&id=";
	$dellink="?content=Partner&del=";
	$code=hd_partner_del();
	if ($code<>""){
		echo("<b>Partner törölve.</b><br /><br />");
	}
	hd_partnertable($link,$dellink,"buttonx");
	$data=array("","","","","","","","");
	$readonly="";
	$id=get_sublink("id");
	if ($id<>""){
		$data=hd_partner_get_alldata_id($id);
		$readonly="readonly";
	}
}

?>
<div class=content_box>
<div class=content_box>
	<br /><br />
	<br /><br />
	<b>Új partner felvétele</b>
	<br /><br />
	<center>
	<form action="" method=post enctype=multipart/form-data>
	<input type=hidden name="pid" id="pid" value="<?php echo($data[0]); ?>">
	Felhasználónév:
	<br /><br />
	<input type=text name="pname" id="pname" value="<?php echo($data[1]); ?>" <?php echo($readonly); ?> >
	<br /><br />
	Jelszó:
	<br /><br />
	<input type=password name="ppw" id="ppw" value="<?php echo($data[2]); ?>" <?php echo($readonly); ?> >
	<br /><br />
	Szerződés száma:
	<br /><br />
	<input type=text name="pszsz" id="pszsz" value="<?php echo($data[3]); ?>">
	<br /><br />
	Teljes név:
	<br /><br />
	<input type=text name="ptn" id="ptn" value="<?php echo($data[4]); ?>">
	<br /><br />
	Postázási cím:
	<br /><br />
	<input type=text name="paddr" id="paddr" value="<?php echo($data[5]); ?>">
	<br /><br />
	Telefonszám:
	<br /><br />
	<input type=text name="ptsz" id="ptsz" value="<?php echo($data[6]); ?>">
	<br /><br />
	E-mail cím:
	<br /><br />
	<input type=text name="pmail" id="pmail" value="<?php echo($data[7]); ?>">
	<br /><br />
	<br /><br />
	<input id=submit type=submit name=subm value=Mentés>
	</form>
	<br /><br />

	<a href="?content=Partner" class="button">Mezők törlése</a
</div>
</div>

<br /><br />
</div>
<br /><br />