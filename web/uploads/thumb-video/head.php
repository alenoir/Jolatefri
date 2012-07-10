<?php

session_start ();

ini_set ( 'display_errors', 'off' );

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><head><meta http-equiv="Content-Language" content="fr" /><meta http-equiv="Content-Script-Type" content="text/javascript" /><meta name="Title" lang="fr" content="<?php
echo $titre;
?>" /><meta name="Identifier-url" content="http://www.jolatefri.com" /><meta name="Description" lang="fr"	content="<?php
	echo $descriptionhead;
	?>" /><meta name="Abstract" content="Site de vidéo diverseset variés" /><meta name="keywords" lang="fr" content="<?php echo $mot_cle_head;?>" /><meta name="Category" content="humour video" /><meta name="Date-Creation-yyyymmdd" content="20090101" /><meta name="Date-Revision-yyyymmdd" content="20090222" /><meta name="Author" lang="fr" content="Jolatefri" /><meta name="Reply-to" content="admin@jolatefri.com" /><meta name="Publisher" content="Jolatefri" /><meta name="Copyright" content="©Copyright : Jolatefri" /><meta name="Location" content="Bordeaux" /><meta name="Distribution" content="Global" /><meta name="Rating" content="General" /><meta name="Robots" content="index, follow" /><meta name="Revisit-After" content="1 days" /><meta name="verify-v1"	content="dm2Obq9X1VL9qW4udamTt2s3CUzRsKq1CdZ3v9ut+d4=" />
<?php
echo $image_source;
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title><?php
echo $titre;
?></title><link rel="alternate" type="application/rss+xml"	href="http://www.jolatefri.com/jolatefri_rss.xml" title="Jolatefri" /><link href="<?php
echo $css_style;
?>" rel="stylesheet" type="text/css" /><!--[if IE]> <link href="style_video_ie.css" rel="stylesheet" type="text/css"> <![endif]--><link href="style_jolatefri.css" rel="stylesheet" type="text/css" /><link href="style_formulaire.css" rel="stylesheet" type="text/css" /><link rel="icon" type="image/png" href="img/favicon.png" /><SCRIPT language="JavaScript" src="jolatefri_js.js"></script><script type="text/javascript"	src="http://www.jolatefri.com/ajax/jquery-1.3.2.min.js"></script></head>
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
<body><div id="mail"></div><div id="ombre"><div id="entete" style="background-image: url(img/<?php echo $bann_choix;?>);"><div id="logo_titre"><div class="lien_bann"><a href="index.php"></a></div>

			<?
			
			if (! isset ( $_COOKIE ['membre'] )) 

			{
				?>
			<form method="post" action="recherche_video.php" name="form2"><p><input name="recherche" type="text" id="recherche" size="12"	maxlength="30" value="Recherche" id="recherche"	onFocus="javascript: effacer('Recherche', 'recherche');"	onBlur="javascript: reecrire('Recherche', 'recherche');" /> <input	type="submit" value="Ok" /></p></form>
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
			<div id="menu_membre"><p><a href="fiche_membre.php?pseudo=<?
				echo $_SESSION ['pseudo'];
				?>">MonCompte</a></p><p>Bienvenue <?php
				echo $_SESSION ['pseudo'];
				?> | <a	href="deconnexion.php">Deconnexion</a></p><form method="post" action="recherche_video.php" name="form2"><p><input name="recherche" type="text" id="recherche" size="12"	maxlength="30" id="recherche" value="Recherche"	onFocus="javascript: effacer('Recherche', 'recherche');"	onBlur="javascript: reecrire('Recherche', 'recherche');" /> <input	type="submit" value="Ok" /></p></form></div>
			<?php
			
			} 

			else 

			{
				?>
			<div id="menu_membre"><p>Mon Compte<br /><form method="post" action="traitement_connexion_membre.php"	name="form1"><input name="pseudo" type="text" id="pseudo" size="12"	maxlength="30" id="pseudo" value="Pseudo"	onFocus="javascript: effacer('Pseudo', 'pseudo');"	onBlur="javascript: reecrire('Pseudo', 'pseudo');" /> <input	type="password" name="password" id="pass" size="12" maxlength="30"	value="Pass" id="password"	onFocus="javascript: effacer('Pass', 'pass');"	onBlur="javascript: reecrire('Pass', 'pass');" /><br /><label>Se souvenir de moi ?</label><input type="checkbox"	name="souvenir" /> <input type="submit" value="Ok" /><br /><a href="inscription.php">Pas encore inscrit ?</a></form></p></div>
			<?php
			
			}
		
		}
		
		?>
			<ul id="menu_deroulant">	<li><a href="index.php?classement=recente&categorie=video">Vidéos</a></li>	<li><a href="index.php?classement=recente&categorie=image">Images</a></li>	<li><a href="index.php?classement=recente&categorie=jeux">Jeux</a></li>	<li><a href="index.php?classement=recente&categorie=site">Sites</a></li></ul></div><div id="contenu"><div id="col_gauche">
	
<?

if ($_SERVER ['SCRIPT_NAME'] != '/traitement_connexion_membre.php') 

{
	
	if (isset ( $_SESSION ['pseudo'] )) 

	{
		
		echo "<p class=\"titre\">" . $_SESSION ['pseudo'] . "</p>";
		
		$donneesavatar = mysql_fetch_array ( $reponseavatar );
		
		?>
	<table class="table_profil">	<tr>		<td><?
		if (empty ( $donneesavatar ['avatar'] )) {
			echo "<img src=\"img/avatar/invite.png\" width=\"100px\" class=\"avatar_img\">";
		} 

		else {
			echo "<img src=\"img/avatar/" . $donneesavatar ['avatar'] . "\" width=\"100px\" class=\"avatar_img\">";
		}
		?></td>	</tr>	<tr>		<td>		<div id="menu_profil"></div>		<script type="text/javascript">
				 		menuprofil();
						setInterval('menuprofil()', 10300);
                </script></td>	</tr></table>
	<?
	
	} 

	else 

	{
		
		echo "<p class=\"titre\">Invité</p>";
		
		?>
	<table class="table_profil">	<tr>		<td><img src="img/avatar/invite.png" width="100px" class="avatar_img"></td>	</tr>	<tr>		<td>		<p><a href="index.php">Accueil</a></p>		</td>	</tr>	<tr>		<td>		<p><a href="inscription.php">Inscription</a></p>		</td>	</tr>	<tr>		<td>		<p><a href="toutes_les_video.php">Toutes les vidéos</a></p>		</td>	</tr>	<tr>		<td>		<p><a href="http://www.jolatefri.com/jolatefri_rss.xml">Souscrire <img			src="img/rss.gif"></a></p>		</td>	</tr></table>
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
		</script> <script type="text/javascript"	src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>
		
		</span></div><div id="col_droite">
<div id="video_aleatoire"></div>
<div id="contenu_aleatoire"></div><a class="bouton_aleatoire_video" href="" onclick="video_aleatoire(); return false;">Une vidéo au hasard !</a>
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
			<h2 class="titre" name="chatform" id="chatform">Chat</h2><form action="" onsubmit="envoyerchat(); return false;"><input	type="text" size="15" maxlength="100" name="message" id="message"	value="message" onFocus="javascript: effacer('message', 'message');"	onBlur="javascript: reecrire('message', 'message');" /> <input	type="submit" name="submit" value="Envoyer" /></form><div id="chat"></div><a href="archive_chat.php" class="voir_archives">Archives</a> <script	type="text/javascript">
                		afficher();
						setInterval('afficher()', 5000);
                </script>
			<?php
				
				}
				?>			<h2 class="titre">Jolatefri sur le web</h2>
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
				?><h2 class="titre">Jolatefri sur le web</h2>
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
			<p class="titre">Pub</p><span class="pub_col_gauche">
<script type="text/javascript"><!--
			google_ad_client = "pub-2988981413237874";
			/* jolatefri */
			google_ad_slot = "4779910924";
			google_ad_width = 120;
			google_ad_height = 600;
			//-->
		</script> <script type="text/javascript"	src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script></span>
			<?
			}
			?>

	</div>