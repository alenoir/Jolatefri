<?php

session_start ();

ini_set ( 'display_errors', 'off' );

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
echo $titre;
?>" />
	echo $descriptionhead;
	?>" />
<?php
echo $image_source;
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
echo $titre;
?></title>
echo $css_style;
?>" rel="stylesheet" type="text/css" />
<?php

if (isset ( $_COOKIE ['membre'] )) 

{
	
	$_SESSION ['pseudo'] = $_COOKIE ['membre'];

}

$pseudo = $_SESSION ['pseudo'];

if (isset ( $_SESSION ['pseudo'] )) 

{
	
	$cnx = mysql_connect ( "mysql5-15", "jolatefr", "8163264" );
	
	mysql_select_db ( "jolatefr" );
	
	$membretimestamp = time ();
	
	$repvisitemembre = mysql_query ( "SELECT (ID) FROM membre_connecte WHERE pseudo = '$pseudo' " );
	
	$visitemembre = mysql_fetch_array ( $repvisitemembre );
	
	if (empty ( $visitemembre ['ID'] )) 

	{
		
		mysql_query ( "INSERT INTO membre_connecte VALUES('', '$membretimestamp', '$pseudo')" );
	
	} 

	else 

	{
		
		mysql_query ( "UPDATE membre_connecte SET timestamp = $membretimestamp WHERE pseudo ='" . $pseudo . "'" );
	
	}
	
	mysql_close ();

}

if (isset ( $_SESSION ['pseudo'] )) 

{
	
	$cnx = mysql_connect ( "mysql5-15", "jolatefr", "8163264" );
	
	mysql_select_db ( "jolatefr" );
	
	$reponseavatar = mysql_query ( "SELECT * FROM membres WHERE pseudo = '" . $_SESSION ['pseudo'] . "'" );
	
	mysql_close ();

}

$cnx = mysql_connect ( "mysql5-15", "jolatefr", "8163264" );

mysql_select_db ( "jolatefr" );

$repclassement = mysql_query ( "SELECT * FROM membres ORDER BY points_frites DESC LIMIT 0,6" );

$repnb_frite_jour = mysql_query ( "SELECT COUNT (*) FROM frites" );

mysql_close ();

include ("page.php");
$tab_bann = array("bannjolatefri.png", "banniere_vtz.png");
$bann_choix = $tab_bann[array_rand($tab_bann)]
?>
<body>

			<?
			
			if (! isset ( $_COOKIE ['membre'] )) 

			{
				?>
			<form method="post" action="recherche_video.php" name="form2">
			<?
			}
			?>
		</div>
		
		<?php
		
		if ($_SERVER ['SCRIPT_NAME'] != '/traitement_connexion_membre.php') 

		{
			
			if (isset ( $_SESSION ['pseudo'] )) 

			{
				?>
			<div id="menu_membre">
				echo $_SESSION ['pseudo'];
				?>">Mon
				echo $_SESSION ['pseudo'];
				?> | <a
			<?php
			
			} 

			else 

			{
				?>
			<div id="menu_membre">
			<?php
			
			}
		
		}
		
		?>
			<ul id="menu_deroulant">
	
<?

if ($_SERVER ['SCRIPT_NAME'] != '/traitement_connexion_membre.php') 

{
	
	if (isset ( $_SESSION ['pseudo'] )) 

	{
		
		echo "<p class=\"titre\">" . $_SESSION ['pseudo'] . "</p>";
		
		$donneesavatar = mysql_fetch_array ( $reponseavatar );
		
		?>
	<table class="table_profil">
		if (empty ( $donneesavatar ['avatar'] )) {
			echo "<img src=\"img/avatar/invite.png\" width=\"100px\" class=\"avatar_img\">";
		} 

		else {
			echo "<img src=\"img/avatar/" . $donneesavatar ['avatar'] . "\" width=\"100px\" class=\"avatar_img\">";
		}
		?></td>
				 		menuprofil();
						setInterval('menuprofil()', 10300);
                </script></td>
	<?
	
	} 

	else 

	{
		
		echo "<p class=\"titre\">Invité</p>";
		
		?>
	<table class="table_profil">
	<?
	
	}

}

if ($_SERVER ['SCRIPT_NAME'] != '/statistic.php') 

{
	
	?>
	
	<p class="titre">Classement</p>
		<?php
	
	$position = 1;
	
	while ( $classement = mysql_fetch_array ( $repclassement ) ) 

	{
		
		if ($classement ['pseudo'] != "jolatefri") 

		{
			
			$membre = $classement ['pseudo'];
			
			switch ($position) 

			{
				
				case 1 :
					
					echo "<p class=\"titre_classement\">1ère place !</p>";
					
					break;
				
				case 2 :
					
					echo "<p class=\"titre_classement\">2ème place !</p>";
					
					break;
				
				case 3 :
					
					echo "<p class=\"titre_classement\">3ème place !</p>";
					
					break;
				
				case 4 :
					
					echo "<p class=\"titre_classement\">4ème place !</p>";
					
					break;
				
				case 5 :
					
					echo "<p class=\"titre_classement\">5ème place !</p>";
					
					break;
			
			}
			
			$cnx = mysql_connect ( "mysql5-15", "jolatefr", "8163264" );
			
			mysql_select_db ( "jolatefr" );
			
			$repinfomembre = mysql_query ( "SELECT * FROM membres WHERE pseudo = '" . $membre . "'" );
			
			$infosmembre = mysql_fetch_array ( $repinfomembre );
			
			mysql_close ();
			
			echo "<table class=\"classement\"><tr><td class=\"utilisateur_com\"><img src=\"img/avatar/" . $infosmembre ['avatar'] . "\" width=50px ></td><td class=\"utilisateur_com\"><ol><li><a href=\"fiche_membre.php?pseudo=" . $infosmembre ['pseudo'] . "\">" . $infosmembre ['pseudo'] . "</a></li><li>" . $infosmembre ['points_frites'] . " frites</li></ol></td></tr></table>";
			
			$position ++;
		
		}
	
	}

}

?>
	<p class="titre">Pub</p>
<span class="pub_col_gauche">
<script type="text/javascript"><!--
			google_ad_client = "pub-2988981413237874";
			/* jolatefri */
			google_ad_slot = "4779910924";
			google_ad_width = 120;
			google_ad_height = 600;
			//-->
		</script> <script type="text/javascript"
		</script>
		
		</span></div>
<div id="video_aleatoire"></div>
<div id="contenu_aleatoire"></div>
			<?
			if ($_SERVER ['SCRIPT_NAME'] != '/statistic.php') 

			{
				include ('classement_video.php');
			}
			
			if (isset ( $_SESSION ['pseudo'] )) 

			{
				
				if ($_SERVER ['SCRIPT_NAME'] != '/archive_chat.php') 

				{
					?>
			<h2 class="titre" name="chatform" id="chatform">Chat</h2>
                		afficher();
						setInterval('afficher()', 5000);
                </script>
			<?php
				
				}
				?>
			<ul id="jolatefri_sur_le_web">
				<li><a href="http://www.facebook.com/pages/Jolatefri/188884135106?ref=ts" target="_blank" title="Fan page de Jolatefri su Facebook"><img src="img/facebook.png" alt="facebook jolatefri" width=20px/> Jolatefri sur Facebook</a></li>
				<li><a href="http://twitter.com/jolatefri" target="_blank" title="Suivez Jolatefri sur Twitter"><img src="img/twitter.png" alt="twitter jolatefri" width=20px/> Jolatefri sur Twitter</a></li>
				<li><a href="http://www.dailymotion.com/jolatefri" target="_blank" title="Compte de Jolatefri sur Dailymotion"><img src="img/dailymotion.png" alt="dailymotion jolatefri" width=20px/> Jolatefri sur Dailymotion</a></li>
				<li><a href="http://www.yoolink.fr/people/jolatefri" target="_blank" title="Page public de Jolatefri sur Yoolink"><img src="img/Yoolink-32x32.png" alt="yoolink jolatefri" width=20px/> Jolatefri sur Yoolink</a></li>
				<li><a href="http://delicious.com/jolatefri" target="_blank" title="Page public de Jolatefri sur Delicious"><img src="img/delicious_48x48.png" alt="delicious jolatefri" width=20px/> Jolatefri sur Delicious</a></li>
				<li><a href="http://jolatefri.labrute.fr" target="_blank" title="La brute de Jolatefri"><img src="img/labrute.ico" alt="Jolatefri labrute" width=20px/> Jolatefri sur la Brute</a></li>
				<li><a href="http://jolatefri.miniville.fr" target="_blank" title="La miniville de Jolatefri"><img src="img/miniville.ico" alt="Jolatefri miniville" width=20px/> Jolatefri sur miniville</a></li>
			</ul>
			<h2 class="titre">Nuage de tags</h2>
			<?php
				include ('nuage_tags.php');


			} 

			else 

			{
				?>
			<ul id="jolatefri_sur_le_web">
				<li><a href="http://www.facebook.com/pages/Jolatefri/188884135106?ref=ts" target="_blank" title="Fan page de Jolatefri su Facebook"><img src="img/facebook.png" alt="facebook jolatefri" width=20px/> Jolatefri sur Facebook</a></li>
				<li><a href="http://twitter.com/jolatefri" target="_blank" title="Suivez Jolatefri sur Twitter"><img src="img/twitter.png" alt="twitter jolatefri" width=20px/> Jolatefri sur Twitter</a></li>
				<li><a href="http://www.dailymotion.com/jolatefri" target="_blank" title="Compte de Jolatefri sur Dailymotion"><img src="img/dailymotion.png" alt="dailymotion jolatefri" width=20px/> Jolatefri sur Dailymotion</a></li>
				<li><a href="http://www.yoolink.fr/people/jolatefri" target="_blank" title="Page public de Jolatefri sur Yoolink"><img src="img/Yoolink-32x32.png" alt="yoolink jolatefri" width=20px/> Jolatefri sur Yoolink</a></li>
				<li><a href="http://delicious.com/jolatefri" target="_blank" title="Page public de Jolatefri sur Delicious"><img src="img/delicious_48x48.png" alt="delicious jolatefri" width=20px/> Jolatefri sur Delicious</a></li>
				<li><a href="http://digg.com/users/jolatefr" target="_blank" title="La miniville de Jolatefri"><img src="img/Digg_48x48.png" alt="Jolatefri digg" width=20px/> Jolatefri sur Digg</a></li>
				<li><a href="http://jolatefri.labrute.fr" target="_blank" title="La brute de Jolatefri"><img src="img/labrute.ico" alt="Jolatefri labrute" width=20px/> Jolatefri sur la Brute</a></li>
				<li><a href="http://jolatefri.miniville.fr" target="_blank" title="La miniville de Jolatefri"><img src="img/miniville.ico" alt="Jolatefri miniville" width=20px/> Jolatefri sur miniville</a></li>
			</ul>
			<p class="titre">Pub</p>
<script type="text/javascript"><!--
			google_ad_client = "pub-2988981413237874";
			/* jolatefri */
			google_ad_slot = "4779910924";
			google_ad_width = 120;
			google_ad_height = 600;
			//-->
		</script> <script type="text/javascript"
		</script></span>
			<?
			}
			?>

	</div>