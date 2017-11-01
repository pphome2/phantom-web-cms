		<br />
		<br />
		<br />
		<br />
		<br />
		<!-- Footer -->
			<div id="Kapcsolat"></div>
			<footer id="ffooter" style="text-align:center;">
				<div class="inner">
					<img src="../content/Kapcsolat/email.png"><br /><br />
					<h3>Keressen minket</h3>
					<p>
						Kérjen egyedi árajánlatot. Szakembereink az Ön igényeihez mérten határozzák meg a
						feladatokat, ennek alapján adnak ajánlatot.<br /><br />
						A jelölt (*) mezőket kötelező kitölteni.
					</p>
					<br /><br /><br />
					<form id="kapcsolat" action="?content=Kapcsolat" method="post" accept-charset="UTF-8">
						<div class="field half first">
							<label for="name">Név *</label><br />
							<input name="fname" id="fname" type="text" placeholder="Név">
						</div>
						<div class="field half">
							<label for="email">E-mail cím *</label><br />
							<input name="email" id="email" type="email" placeholder="E-mail">
						</div>
						<div class="field">
							<label for="message">Üzenet *</label><br />
							<textarea name="message" id="message" rows="6" placeholder="Üzenet"></textarea>
						</div>
						<?php form_protect($k1,$k2,$k3) ?>
						<div class="field">
							<label for="kell">Ellenőrzés * - Adja meg a két szám összegét: <?php echo("$k1 és $k2"); ?></label><br />
							<input name="kell" id="kell" type="text" placeholder="Ellenőrző szám">
						</div>
						<input name="kell2" id="kell2" type="hidden" value="<?php echo("$k3"); ?>" >
						<ul class="actions">
							<li><input value="Küldés" class="button" type="submit"></li>
						</ul>
					</form>
				</div>
			</footer>
		<br />
		<br />
		<br />
	<?php
		$code=hd_formdata_to_mail();
		if ($code<>""){
			if (strlen($code)>3){
				echo("<div class=modal id=modal-one aria-hidden=true>");
				echo("<div class=modal-dialog>");
				echo("	<div class=modal-header>");
				echo("		<h2>Üzenet</h2>");
				echo("		<a href=index.php class=btn-close aria-hidden=true>×</a>");
				echo("	</div>");
				echo("	<div class=modal-body>");
				echo("		<p>Köszönjük üzenetét.<br /><br />Hamarosan jelentkezünk...</p>");
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
				echo("	<div class=modal-footer> <a href=?content=Kapcsolat class=btn>Bezár</a>");
				echo("	</div>");
				echo("</div>");
				echo("</div>");
			}
		}
	?>
	</body>
</html>

