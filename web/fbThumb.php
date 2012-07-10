<?php
//echo $_GET['thumb'];
// on spécifie le type de document que l'on va créer (ici une image au format PNG
header ("Content-type: image/jpeg");
// déclaration des 2 images que je veux supperposer
$fond = $_GET['thumb'];
$dessus = "images/play.png";
// création des espaces pour les images
$imfond = ImageCreatefromjpeg ($fond);
$imdessus = ImageCreatefromjpeg($dessus);
// miniature car je voudrais réduire l'image du dessus afin que par exemple
// l'image de fond fasse 100% mais que l'image du dessus vienne
// recouvrir que par exemple 50%
// sachant qu'elles ont toutes les deux les mêmes dimensions
list($width,$height) = getimagesize($dessus);
$newwidth = $width * 0.5;
$thumb = imagecreatetruecolor($newwidth,$height);
imagecopyresized($thumb,$imdessus,0,0,0,0,$newwidth,$height,$width,$height);
$res = imagecreatefromjpeg($thumb);
@imagecopymerge($fond,$res,0,0,0,0,99,16,50);
// on dessine notre image PNG
Imagejpeg ($fond);
?>
