
		<!-- Three -->
			<div id="Hibabejelentés"></div>
			<section id="three" class="wrapper align-center">
				<div class="inner">
					<h3><b>Hibabejelentések kezelése</b></h3>
					<?php
						global $USER_ADMIN,$USER_EDITOR;
						if ($USER_EDITOR or $USER_ADMIN){
							$data=array("","","","","","","","","","","",);
							$link="?content=Admin4&code=";
							$dellink="?content=Admin&del=";
							$link2="?content=Admin";
							hd_deldata();
					?>
					<form id="error" action="?content=Admin" method="post" accept-charset="UTF-8">
						<input name="content" id="content" type="hidden" value="Admin" >
						<input name="code" id="code" type="hidden" value="<?php echo("$data[0]"); ?>" >
						<div class="field half first">
							<label for="xdat">Dátum</label><br />
							<input name="xdat" id="xdat" type="text" placeholder="Például: 20170117 (az azonosító eleje)" value="" >
						</div>
						<div class="field half">
							<label for="xceg">Cégnév</label><br />
							<input name="xceg" id="xceg" type="text" placeholder="Cégnév" value="" >
						</div>
						<ul class="actions">
							<li><input value="Szűrés" class="button" type="submit"></li>
						</ul>
					</form>
					<br /><br />
					<?php
							hd_datatable_in($link,$dellink,"buttonx");
							echo("<br /><br /><br /><br />");
							echo("<a href=?content=Partner class=button>Partnerek</a>");
						}else{
					?>
					<br /><br />
					<br /><br />
					<br /><br />
					<br /><br />
					<br /><br />
					<br /><br />
					<br /><br />Nincs jogosultsága a hibák kezeléséhez...
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
		$code=hd_deldata();
		if ($code<>""){
			if (strlen($code)>10){
				echo("<div class=modal id=modal-one aria-hidden=true>");
				echo("<div class=modal-dialog>");
				echo("	<div class=modal-header>");
				echo("		<h2>Üzenet</h2>");
				echo("		<a href=index.php class=btn-close aria-hidden=true>×</a>");
				echo("	</div>");
				echo("	<div class=modal-body>");
				echo("		<p>Azonosító: ".$code." <br /><br />Bejelentés törölve...</p>");
				echo("	</div>");
				echo("	<div class=modal-footer> <a href=\"$link2\" class=btn>Bezár</a>");
				echo("	</div>");
				echo("</div>");
				echo("</div>");
			}
		}
	?>
	</body>
</html>
