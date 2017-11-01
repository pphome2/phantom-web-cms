<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo("$PORTAL_NAME") ?></title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
	</head>
	<body>

	<div id="Kezdőlap"></div>

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<nav class="fixed-nav-bar">
						<div id="menu" class="menu">
							<a class="sitename" href="../public/index.php"><?php echo("$PORTAL_NAME"); ?></a>
							<ul class="menu-items">
							<?php
								$link="?content=";
								$menu=admin_menu();
								$db=count($menu);
								$db=5;
								for($i=0;$i<$db;$i++){
									$l2=$link.change_name($menu[$i]);
									echo("<li><a href=$l2>$menu[$i]</a></li>");
								}
							?>
							</ul>
						</div>
					</nav>
				</div>
			</header>

			<div class=content_box>
			<br /><br /><br /><h1>Adminisztrációs oldal</h1>
			<?php
				$cont=get_sublink("content");
				$v=normal_dirname($cont);
				$CONTENT_CONTAINER_OPEN="";
				$CONTENT_CONTAINER_END="";
				control_admin($cont,$menu);
			?>
			</div>

		<center><font size=-1>
		<div class="copyright">
			<br />
			<br />
			<?php $img="$DIR_TEMPLATE/$TEMPLATE/webstarthely_logo.png";echo("<img src=$img width=250px>"); ?>
			<br />
			<?php
				echo("$COPYRIGHT $PORTAL_NAME - $PORTAL_DEV");
				$link="?content=Login";
				if ($LOGGED_IN_USER){
					$l=$_COOKIE["gusername"];
					echo(" - <a href=$link style=\"color:grey;\">[ Kijelentkezés - $l ]</a> - ");
					$link2="../admin";
					if ($USER_ADMIN){
						echo("<a href=$link2 target=_blank style=\"color:grey;\">[ Adminisztráció ]</a>");
					}
					if ($USER_EDITOR or $USER_ADMIN){
						echo(" - <a href=\"../public/index.php?content=Admin\">[ Hibabejelentések kezelése ]</a> - ");
					}
				}else{
					echo("<a href=$link style=\"color:grey;\">[ Bejelentkezés ]</a>");
				}
			?>
			<br />
			<br />
		</div>
	</div>


	</body>
</html>
