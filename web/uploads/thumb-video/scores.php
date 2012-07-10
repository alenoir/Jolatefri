<?php
session_start();
$cnx = mysql_connect("mysql5-15", "jolatefr", "8163264");
mysql_select_db("jolatefr");

$mdp = "jetman";

if(isset($_GET['del']) && $_SESSION['admin']) {
	$query = "DELETE FROM scores WHERE id = \"".$_GET['del']."\"";
	if($send = mysql_query($query)) {
		echo 'Score supprim&eacute; de la base de donn&eacute;es';
	}
	else { echo "Erreur dans la suppression du score"; }
}
if(isset($_GET['desactive']) && $_SESSION['admin']) {
	$query = "UPDATE scores SET active = 'false' WHERE id = \"".$_GET['desactive']."\"";
	if($send = mysql_query($query)) {
		echo 'Score d&eacute;sactiv&eacute; <a href="scores.php?active='.$_GET['desactive'].'" class="cancel">(annuler)</a>';
	}
	else { echo "Erreur dans la d&eacute;sactivation du score"; }
}
if(isset($_GET['active']) && $_SESSION['admin']) {
	$query = "UPDATE scores SET active = 'true' WHERE id = \"".$_GET['active']."\"";
	if($send = mysql_query($query)) {
		echo 'Score activ&eacute; <a href="scores.php?del='.$_GET['active'].'" class="cancel">(annuler)</a>';
	}
	else { echo "Erreur dans l'activation du score"; }
}

if(isset($_GET['add'], $_POST['nom'], $_POST['score']) && $_SESSION['admin'] && $_POST['nom'] != '' && $_POST['score'] != '') {
	$query = "INSERT INTO scores (nom_joueur, score, date, active) VALUES(\"".$_POST['nom']."\", \"".$_POST['score']."\", NOW(), 'true')";
	if($send = mysql_query($query)) {
		//echo "Score ajout&eacute;";
	}
	else { echo "Erreur dans l'ajout"; }
}

if(isset($_GET['viewAll'])) {
	if($_GET['viewAll'] == 1) {
		$_SESSION['viewAll'] = true;
	}
	else {
		$_SESSION['viewAll'] = false;
	}
}

if(isset($_GET['connect'])) {
	if($_POST['mdp'] == $mdp) {
		$_SESSION['admin'] = true;
	}
	else {
		$_SESSION['admin'] = false;
	}
}
if(isset($_GET['deco'])) {
	$_SESSION['admin'] = false;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>HighScore Jet Le Pirate</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<META NAME="TITLE" CONTENT="Jetpirate">
	<META NAME="DESCRIPTION" CONTENT="Jetprate, le pirate de l'eau delà !">
	<META NAME="KEYWORDS" CONTENT="pirate jeu flash eau delà jetpirate src as3">
	<META NAME="SUBJECT" CONTENT="Jeux Flash">
	<META NAME="CATEGORY" CONTENT="Jeu">
	<META NAME="AUTHOR" CONTENT="Jolatefri">
	<META NAME="REPLY-TO" CONTENT="lenoirantoine@free.fr">
	<META NAME="REVISIT-AFTER" CONTENT="15 DAYS">
	<META NAME="LANGUAGE" CONTENT="FR">
	<META NAME="COPYRIGHT" CONTENT="jolatefri 2009">
	<META NAME="ROBOTS" CONTENT="All">
	<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CHACHE">
	<META HTTP-EQUIV="REFRESH" CONTENT="Non">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
</head>
<body>
<div id="nav">
<div id="entete">

</div>
<div id="contenu">
		<div>
	<?php if(!$_SESSION['admin']) { ?>
	<form method="POST" action="scores.php?connect=">
		Mot de passe : <input type="password" name="mdp" />
		<input type="submit" value="Se connecter" />
	</form>
	<?php } else { echo '<a href="scores.php?deco=">Se d&eacute;connecter</a><br />'; }
	
	if($_SESSION['viewAll']) { ?><a href="scores.php?viewAll=0">Voir seulement les scores actifs</a><?php } else { ?><a href="scores.php?viewAll=1">Voir tous les scores enregistr&eacute;s</a><?php } ?>
		<table cellspacing="20">
		<tr>
			<th>Joueur</th>
			<th>Score</th>
			<?php if($_SESSION['viewAll']) { ?><th>Actif ?</th><?php } ?>
			<?php if($_SESSION['admin']) { ?><th>Supprimer</th><?php } ?>
		</tr>
		<?php
		if($_SESSION['viewAll']) {
			$query = mysql_query("SELECT * FROM scores ORDER BY score DESC");
		}
		else {
			$query = mysql_query("SELECT * FROM scores WHERE active = 'true' ORDER BY score DESC");
		}
		$i = 1;
		
		while($score = mysql_fetch_array($query)) {
		?>
		<tr>
			<td><?php 
				if($i==1) { echo '<img src="gold.png" /> '; } elseif($i==2) { echo '<img src="silver.png" /> '; } elseif($i==3) { echo '<img src="bronze.png" /> '; }
				echo $score['nom_joueur']; ?></td>
			<td style="text-align:right"><?php echo $score['score']; ?></td>
			<?php if($_SESSION['viewAll']) { if($score['active'] == "true") { echo "<td style=\"text-align:center\"><a href=\"scores.php?desactive=".$score['id']."\">Oui</a></td>"; } else { echo "<td style=\"text-align:center\"><a href=\"scores.php?active=".$score['id']."\">Non</a></td>"; } } ?>
			<?php if($_SESSION['admin']) {
				 ?><td style="text-align:center"><a href="scores.php?del=<?php echo $score['id']; ?>">X</a></td><?php
			} ?>
		</tr>
		<?php
		$i++;
		
		}
		
		if($_SESSION['admin']) { ?>
		<form method="POST" action="scores.php?add=">
		<tr>
			<td>Nom du joueur : <input type="text" name="nom" /></td>
			<td>Score : <input type="text" name="score" size="6" /></td>
			<?php if($_SESSION['viewAll']) { ?><td style="text-align:center">Oui</td><?php } ?>
			<td style="text-align:center"><input type="submit" value="Ajouter" /></td>
		</tr>
		</form>
		<?php } ?>
		</table>
	</div>
</div>
<div id="pied">
<b>© Julien Chadourne | Benjamin Diolez | Pierre-Alexandre Dupuy | Olivier Gilquin | Antoine Lenoir | Thibaud Mishler | Yohan Spychala 2009</b>
</div>
</div>

</body>
</html>