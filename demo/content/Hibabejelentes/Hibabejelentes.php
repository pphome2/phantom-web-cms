
		<?php
			global $LOGGED_IN_USER;
			if ($LOGGED_IN_USER){
				$data=hd_partner_get_alldata();
			}else{
				$data=array("","","","","","");
			}
		?>
			<div id="Hibabejelentés"></div>
			<section id="three" class="wrapper align-center">
				<div class="inner">
					<img src="../content/Hibabejelentes/hiba.png"><br /><br /><br />
					<p>
						Kérjük írja le milyen hibát tapasztalt.
						Ügyfélazonosítója, szerződése száma gyorsíthatja az ügyintézést.
					</p>
					<p>
						Az űrlap kitöltése után kap egy azonosítót, ez alapján láthatja
						a bejelentés állapotát és érdeklődhet a hibaelhárítás menetéről.
					<br />
						Az űrlap alatt láthatja a nyitott hibabejelentéseket, azonosító és
						állapot szerint.
					</p>
						A jelölt (*) mezőket kötelező kitölteni.
					<br /><br />
					<form id="error" action="?content=Hibabejelentes" method="post" accept-charset="UTF-8">

						<div class="field half first">
							<label for="tname">Név / cégnév *</label><br />
							<input name="tname" id="tname" type="text" placeholder="Név / cégnév" value="<?php echo($data[4]); ?>" >
						</div>
						<div class="field half">
							<label for="tusz">Ügyfélszám / szerződés száma</label><br />
							<input name="tusz" id="tusz" type="text" placeholder="Ügyfélszám / szerződés száma" value="<?php echo($data[3]); ?>" >
						</div>
						<div class="field half first">
							<label for="ttsz">Telefonszám *</label><br />
							<input name="ttsz" id="ttsz" type="text" placeholder="Telefonszám" value="<?php echo($data[6]); ?>" >
						</div>
						<div class="field half">
							<label for="tmail">E-mail cím *</label><br />
							<input name="tmail" id="tmail" type="email" placeholder="E-mail" value="<?php echo($data[7]); ?>" >
						</div>
						<div class="field">
							<label for="tmess">Hibaleírás *</label><br />
							<textarea name="tmess" id="tmess" rows="6" placeholder="Hibaleírás"></textarea>
						</div>
						<?php form_protect($e1,$e2,$e3) ?>
						<div class="field">
							<label for="tell">Ellenőrzés * - Adja meg a két szám összegét: <?php echo("$e1 és $e2"); ?></label><br />
							<input name="tell" id="tell" type="text" placeholder="Ellenőrző szám">
						</div>
						<input name="tell2" id="tell2" type="hidden" value="<?php echo("$e3"); ?>" >
						<ul class="actions">
							<li><input value="Küldés" class="button" type="submit"></li>
						</ul>
					</form>
			</section>
	<?php
		$code=hd_formdata_in();
		if ($code<>""){
			if (strlen($code)>10){
				echo("<div class=modal id=modal-one aria-hidden=true>");
				echo("<div class=modal-dialog>");
				echo("	<div class=modal-header>");
				echo("		<h2>Üzenet</h2>");
				echo("		<a href=index.php class=btn-close aria-hidden=true>×</a>");
				echo("	</div>");
				echo("	<div class=modal-body>");
				echo("		<p>Bejelentését rögzítettük. <br /><br />Azonosító: ".$code." <br /><br />Hamarosan jelentkezünk...</p>");
				echo("	</div>");
				echo("	<div class=modal-footer> <a href=?content=Folap class=btn>Bezár</a>");
				echo("	</div>");
				echo("</div>");
				echo("</div>");
			}else{
				echo("<div class=modal id=modal-one aria-hidden=true>");
				echo("<div class=modal-dialog>");
				echo("	<div class=modal-header>");
				echo("		<h2>Üzenet</h2>");
				echo("		<a href=index.php class=btn-close aria-hidden=true>×</a>");
				echo("	</div>");
				echo("	<div class=modal-body>");
				echo("		<p>Nem megfelelően kitöltött mezők <br />vagy ellenőrző kód nem jó...</p>");
				echo("	</div>");
				echo("	<div class=modal-footer> <a href=?content=Hibabejelentes class=btn>Bezár</a>");
				echo("	</div>");
				echo("</div>");
				echo("</div>");
			}
		}
	?>

