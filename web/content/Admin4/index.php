		<!-- Three -->
			<div id="Hibabejelentés"></div>
			<section id="three" class="wrapper align-center">
				<div class="inner">
					<h3><b>Hibabejelentés adatai</b></h3>
				<div class="inner">
				<?php
					global $USER_ADMIN,$USER_EDITOR;

					if ($USER_EDITOR or $USER_ADMIN){
						$data=array("","","","","","","","","","","",);
						$link="?content=Admin4&code=";
						$link2="?content=Admin4&code=";
						$link3="?page=Admin2&code=";
						$link4="?page=Admin3&code=";
						$data=hd_datatable_row_in("code","del");
						hd_partner_getall();
						$link=$link."$data[0]";

				?>

					<br /><br />
					<form id="error" action=<?php echo($link); ?> method="post" accept-charset="UTF-8">
						<input name="content" id="content" type="hidden" value="Admin4" >
						<input name="partcode" id="partcode" type="hidden" value="<?php echo("$data[0]"); ?>" >
						<div class="field half first">
							<label for="taz">Hiba partnerhez rendelése</label><br />
							<select name=partnev id=partnev>
							<?php
								$selected="selected";
								$db=sql_result_num();
								for($i=0;$i<$db;$i++){
									$dat=sql_result($i);
									echo("<option value=$dat[0] $selected>$dat[4]  ($dat[5])</option>");
									if ($i>0){
										$selected="";
									}
								}
							?>
							</select>
						</div>
						<ul class="actions">
							<li><input value="Küldés" class="button" type="submit"></li>
						</ul>
					</form>
					<br /><br />
					<form id="error" action=<?php echo($link); ?> method="post" accept-charset="UTF-8">
						<input name="content" id="content" type="hidden" value="Admin4" >
						<input name="code" id="code" type="hidden" value="<?php echo("$data[0]"); ?>" >
						<div class="field half first">
							<label for="taz">Dátum</label><br />
							<input name="taz" id="taz" type="text" placeholder="Dátum" value="<?php $d=id_to_onlydate("$data[0]"); echo($d); ?>" readonly>
						</div>
						<div class="field half">
							<label for="tid">Azonosító</label><br />
							<input name="tid" id="tid" type="text" placeholder="Azonosító" value="<?php echo("$data[0]"); ?>" readonly>
						</div>
						<div class="field half first">
							<label for="tname">Név / cégnév</label><br />
							<input name="tname" id="tname" type="text" placeholder="Név / cégnév" value="<?php echo("$data[1]"); ?>" >
						</div>
						<div class="field half">
							<label for="tusz">Ügyfélszám / szerződés száma</label><br />
							<input name="tusz" id="tusz" type="text" placeholder="Ügyfélszám / szerződés száma" value="<?php echo("$data[2]"); ?>" >
						</div>
						<div class="field half first">
							<label for="ttsz">Telefonszám</label><br />
							<input name="ttsz" id="ttsz" type="text" placeholder="Telefonszám" value="<?php echo("$data[3]"); ?>" >
						</div>
						<div class="field half">
							<label for="tmail">E-mail cím</label><br />
							<input name="tmail" id="tmail" type="email" placeholder="E-mail" value="<?php echo("$data[4]"); ?>" >
						</div>
						<div class="field">
							<label for="tmess">Hibaleírás</label><br />
							<textarea name="tmess" id="tmess" rows="6" placeholder="Hibaleírás"><?php echo("$data[5]"); ?></textarea>
						</div>
						<div class="field">
							<label for="tstat">Javítás állapota</label><br />
							<input name="tstat" id="tstat" type="text" placeholder="Javítás állapota" value="<?php echo("$data[6]"); ?>" >
						</div>
						<div class="field">
							<label for="twork">Javítás leírás</label><br />
							<textarea name="twork" id="twork" rows="6" placeholder="Javítás leírása"><?php echo("$data[7]"); ?></textarea>
						</div>
						<div class="field half first">
							<label for="thour">Munkaidő</label><br />
							<input name="thour" id="thour" type="text" placeholder="Munkaidő" value="<?php echo("$data[8]"); ?>" >
						</div>
						<div class="field half">
							<label for="tkm">Kiszállás (km)</label><br />
							<input name="tkm" id="tkm" type="text" placeholder="Kiszállás (km)" value="<?php echo("$data[9]"); ?>" >
						</div>
						<div class="field">
							<label for="tdat">Javítás befejezésének dátuma</label><br />
							<input name="tdat" id="tdat" type="text" placeholder="<?php $da=date('Y.m.d. G:i');echo("Például: $da"); ?>" value="<?php echo("$data[10]"); ?>" >
						</div>
						<div class="field">
							<input name="ttomail" id="ttomail" type="checkbox" value="email"> Ügyfél kiértesítése (mail).
						</div>
						<ul class="actions">
							<li><input value="Küldés" class="button" type="submit"></li>
						</ul>
					</form>
					<br /><br /><br />
					<ul class="actions">
						<li><a href="<?php $l="".$link3.$data[0]; echo("$l"); ?>">
							<input value="Munkalap" class="button" type="submit"></a>
						</li>
					</ul>
					<br />
					<ul class="actions">
						<li><a href="<?php $l="".$link4.$data[0]; echo("$l"); ?>">
							<input value="Megrendelőlap" class="button" type="submit"></a>
						</li>
					</ul>
				<?php
					}else{
				?>
					<br /><br />
					<br /><br />
					<br /><br />
					<br /><br />
					<br /><br />
					<br /><br />
					<br /><br />Nincs jogosultsága bejelentést javítani...
					<br /><br />
					<br /><br />
					<br /><br />
					<br /><br />
					<br /><br />
					<?php
					    }
					?>
				</div>
			</section>


	<?php
		$code2=hd_formdata_partchange();
		$code=hd_formdata_change();
		if ($code2<>""){
			$code=$code2;
		}
		if ($code<>""){
			echo("<div class=modal id=modal-one aria-hidden=true>");
			echo("<div class=modal-dialog>");
			echo("	<div class=modal-header>");
			echo("		<h2>Üzenet</h2>");
			echo("		<a href=index.php class=btn-close aria-hidden=true>×</a>");
			echo("	</div>");
			echo("	<div class=modal-body>");
			echo("		<p>Azonosító: ".$code." <br /><br />Adatok javítva...</p>");
			echo("	</div>");
			$link2=$link2.$code;
			echo("	<div class=modal-footer> <a href=\"$link2\" class=btn>Bezár</a>");
			echo("	</div>");
			echo("</div>");
			echo("</div>");
		}
	?>
	</body>
</html>

