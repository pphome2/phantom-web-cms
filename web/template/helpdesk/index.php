<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo("$PORTAL_NAME") ?></title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
	</head>
	<body>
		<div class="contentpage">
		<!-- Header -->
		<header id="header">
			<div class="inner">
				<a href="index.php" class="logo">

				<nav class="fixed-nav-bar">
					<div id="menu" class="menu">
						<a class="sitename" href="index.php"><?php echo("$PORTAL_NAME"); ?></a>
						<ul class="menu-items">
							<li><a href="?content=Folap">Kezdőlap</a></li>
							<li><a href="?content=Hibabejelentes">Hibabejelentés</a></li>
							<?php
								if ($USER_EDITOR or $USER_ADMIN){
									echo("<li><a href=\"?content=Admin\">Hibakezelés</a></li>");
								}
							?>
							<li><a href="?content=Kapcsolat">Kapcsolat</a></li>
							<li><a href="?content=Ugyfelkapu">Ügyfélkapu</a></li>
						</ul>
					</div>
				</nav>
			</div>
		</header>

			<?php
				$CONTENT_CONTAINER_OPEN="";
				$CONTENT_CONTAINER_END="";
				$content=get_sublink("content");
				if ($content==""){
					$content="Folap";
				}
				$file="$DIR_CONTENT/".$content."/".$INDEX_FILE;
				$file2="$DIR_CONTENT/".$content."/".$content.".php";
				$filedir="$DIR_CONTENT/".$content;
				$filecss="$DIR_CONTENT/".$content."/".$INDEX_CSS_FILE;
				include_cssfile($filecss);
				echo("<div class=\"$divclass\">");
				echo("<div class=\"$content\">");
				if (file_exists($file)){
					include_phpfile($file);
				}else{
					if (file_exists($file2)){
						include_phpfile($file2);
					}
				}
				echo("</div>");
				echo("</div>");
			?>

		<center><font size=-1>
			<div class="footer">
				<div class="copyright">
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
								echo(" - <a href=\"?content=Admin\">[ Hibabejelentések kezelése ]</a> - ");
							}
						}else{
							echo("<a href=$link style=\"color:grey;\">[ Bejelentkezés ]</a>");
						}
					?>
				</div>
			</div>
	</div>
	</body>
</html>
