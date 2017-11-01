<font size=-1>
				<?php
					global $USER_ADMIN,$USER_EDITOR;
					if ($USER_ADMIN or $USER_EDITOR){
						$data=array("","","","","","","","","","","",);						$dataline="code";
						$datadel="del";
						$data=hd_datatable_row_in($dataline,$datadel);
						$link=$link."&page=admin.php&code=";

				?>
					<center><h1>Megrendelőlap</h1></center>
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
								<td colspan=2>Hibaleírás: <br /><br /><?php echo("$data[5]"); ?><br /><br /></td>
							</tr>
							<tr>
								<td>A vállalási feltételeket ismerem és elfogadom.<br />Megrendelő aláírása: <br /><br /><br /><br /><br /><br /></td>
								<td>Átvevő aláírása: <br /><br /></td>
							</tr>
						</table>
						<br />
						<table class="m">
							<tr>
								<td colspan=2>
									<center><u>Vállalási feltételek</u></center><br /><br />
									<font size=-1>
									<p>
										<?php show_file("../content/Feltetelek/feltetelek.txt"); ?>
									</p>
									</font>
								</td>
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
					<br /><br />Nincs jogosultsága megrendelőlapot nyomtatni...
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


