<font size=-1>
				<?php
					global $USER_EDITOR, $USER_ADMIN;
					if ($USER_EDITOR or $USER_ADMIN){
						$data=array("","","","","","","","","","","",);
						$dataline="code";
						$datadel="del";
						$data=hd_datatable_row_in($dataline,$datadel);
						$link="?content=Admin4&code=";

				?>
					<center><h1>Munkalap</h1></center>
					<br />
					<center>
					<div class="1m">
						<table class="m">
							<tr>
								<td>Bejelentés ideje: <br /><br /><?php $out=id_to_onlydate($data[0]);echo("$out"); ?></td>
								<td>Azonosító: <br /><br /><?php echo("$data[0]"); ?></td>
							</tr>
							<tr>
								<td>Megrendelő: <br /><br /><?php echo("$data[1]"); ?></td>
								<td>Szerződés szám: <br /><br /><?php echo("$data[2]"); ?></td>
							</tr>
							<tr>
								<td>Telefonszám: <br /><br /><?php echo("$data[3]"); ?></td>
								<td>E-mail: <br /><br /><?php echo("$data[4]"); ?></td>
							</tr>
							<tr>
								<td colspan=2>Állapot: <?php echo("$data[6]"); ?></td>
							</tr>
							<tr>
								<td colspan=2>Hibaleírás: <br /><br /><?php echo("$data[5]"); ?><br /><br /></td>
							</tr>
							<tr>
								<td colspan=2>Elvégzett munka (felhasznált anyagok):<br /><br /><?php echo("$data[7]"); ?><br /><br /></td>
							</tr>
							<tr>
								<td>Munkaidő: <?php echo("$data[8]"); ?></td>
								<td>Kiszállás (km): <?php echo("$data[9]"); ?></td>
							</tr>
							<tr>
								<td colspan=2>Munka befejezése: <?php echo("$data[10]"); ?></td>
							</tr>
							<tr>
								<td>Megrendelő aláírása: <br /><br /><br /><br /></td>
								<td>Munkát végző aláírása: <br /><br /><br /><br /></td>
							</tr>
						</table>
					</div>
					</center>

				<?php
					}else{
				?>
					<br /><br />
					<br /><br />
					<br /><br />
					<br /><br />
					<br /><br />
					<br /><br />
					<br /><br />Nincs jogosultsága munkalapot nyomtatni...
					<br /><br />
					<br /><br />
					<br /><br />
					<br /><br />
					<br /><br />
				<?php
					}
				?>

		<!-- Footer -->


	</body>
</html>


