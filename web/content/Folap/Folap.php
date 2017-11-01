
		<!-- Banner -->
			<section id="banner">
				<div class="inner">

					<div class="flex ">

						<div>
						</div>
						<div>
							<img src="../content/Folap/hiba.png"><br />
						</div>
						<div>
						</div>
					</div>
					<footer>
						<a href="?content=Hibabejelentes" class="button">Hibabejelentés</a>
					</footer>
					<br />
					<br />
					<br />

					<div class="flex ">
						<div>
							<img src="../content/Folap/fejlesztes.png"><br />
							<h3>Fejlesztés</h3>
						</div>

						<div>
							<img src="../content/Folap/rendszer.png"><br />
							<h3>Rendszerfelügyelet</h3>
						</div>

						<div>
							<img src="../content/Folap/szerviz.png"><br />
							<h3>Szervíz</h3>
						</div>

					</div>

					<footer>
						<a href="?content=Kapcsolat" class="button">Kérjen testreszabott árajánlatot</a>
					</footer>
				</div>
			</section>


		<!-- Three -->
			<div id="Hibabejelentés"></div>
			<section id="three" class="wrapper align-center">
				<div class="inner">
					<img src="../content/Folap/hiba.png"><br /><br />
					<h2>Bejelentett hibák</h2>
				<?php
					echo("<br /><br />");
					$data=hd_datatable_in2();
				?>
			</section>

			<footer id="ffooter">
				<div class="iinner">
					<br /><center>
					<ul class="actions">
						<li><a href="?content=Feltetelek">
							<input value="Feltételek" class="button" type="ssubmit"></a>
						</li>
					</ul>
					<br />
					<ul class="actions">
						<li><a href="?content=Arlista">
							<input value="Árlista" class="button" type="ssubmit"></a>
						</li>
					</ul>
					<br />
				</div>
			</footer>