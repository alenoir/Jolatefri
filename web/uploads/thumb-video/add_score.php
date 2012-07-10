<?php
$cnx = mysql_connect("mysql5-15", "jolatefr", "8163264");
mysql_select_db("jolatefr");
if(isset($_POST['score'], $_POST['nom'])) {
	$score = $_POST['score'];
	$nom = $_POST['nom'];
	$ip = $_SERVER["REMOTE_ADDR"];
	$query = "INSERT INTO scores (nom_joueur, score, date, ip, active) VALUES(\"".$nom."\", \"".$score."\", NOW(), \"".$ip."\" , \"true\")";
	
	if(mysql_query($query)) echo "true";
	else echo "false";
}
else echo 'false';
?>