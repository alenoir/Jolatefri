<?php
$images = $_GET['path'];
$file = '../uploads/thumb-video/'.$images;
$dessus = "../images/play.png";

$widthDest = 130;
$heightDest = 97;


// type de l'image
$size = getimagesize($file);

	switch ($size[2]) {
		// Image files
		case 2:
			$header = "image/jpeg";
			header('Content-Type: ' . $header . ';');
			$image_src = imagecreatefromjpeg($file);
			break;
		case 3:
			$header = "image/png";
			header('Content-Type: ' . $header . ';');
			$image_src = imagecreatefrompng($file);
			break;
		case 1:
			$header = "image/gif";
			header('Content-Type: ' . $header . ';');
			$image_src = imagecreatefromgif($file);
			break;
		default :
			$header = "image/jpeg";
			header('Content-Type: ' . $header . ';');
			$image_src = imagecreatefromjpeg($file);
			break;
	}	  
	// on ouvre la source   
	$src_largeur = imagesx($image_src);  
	$src_hauteur = imagesy($image_src);  
	  
	// création de l'image de destination  
	if( isset( $proportion ) )
	{
		$coeff = $src_largeur/$widthDest;
		$widthNewImage = $widthDest;//on garde la largeure
		$heightDest = $heightNewImage = $src_hauteur/$coeff;//on applique la hauteur
		if( $heightDest > 500 )
		{
			$heightDest = 500;
		}
		
		$image_dest = imagecreatetruecolor($widthDest, $heightDest);
	} 
	else
	{
		$image_dest = imagecreatetruecolor($widthDest, $heightDest);
	}
	 
	$color = "FFFFFF";//Blanc...
	$rouge = hexdec(substr($color,0,2)); //conversion du canal rouge
	$vert = hexdec(substr($color,2,4)); //conversion du canal vert
	$bleu = hexdec(substr($color,4,6)); //conversion du canal bleu
	$couleur = imagecolorallocate($image_dest,$rouge,$vert,$bleu);//transformation de la couleur
	imagefill($image_dest,0,0,$couleur); //application de la couleur à ml'image de fond (pour les images transparentes)
	
	// rapport
	$rapport = $heightDest/$widthDest;
	$rapportSource = $src_hauteur/$src_largeur;
	 
	if( isset( $proportion ) )
	{
		imagecopyresampled($image_dest, $image_src, 0, 0, 0, 0, $widthNewImage, $heightNewImage, $src_largeur, $src_hauteur);
	} 
	elseif($rapport < $rapportSource)
	{//si l'image est plus haute
		
		$widthNewImage = $widthDest;//on garde la largeure
		$heightNewImage = ceil($widthNewImage*$rapportSource);//on applique la hauteur
		
		$dest_y_image = ($heightDest-$heightNewImage)/2;
		
		imagecopyresampled($image_dest, $image_src, 0, $dest_y_image, 0, 0, $widthNewImage, $heightNewImage, $src_largeur, $src_hauteur);
	}
	elseif($rapport > $rapportSource)
	{
		$widthNewImage = ceil($heightDest/$rapportSource);//on garde la largeure
		$heightNewImage = $heightDest;//on applique la hauteur
		
		$dest_x_image = ($widthDest-$widthNewImage)/2;
		
		imagecopyresampled($image_dest, $image_src, $dest_x_image, 0, 0, 0, $widthNewImage, $heightNewImage, $src_largeur, $src_hauteur);
	}
	else
	{
		imagecopyresampled($image_dest, $image_src, 0, 0, 0, 0, $widthDest, $heightDest, $src_largeur, $src_hauteur);//on applique les transformations
	}

$source = imagecreatefrompng($dessus);

$details_src = getimagesize($dessus); //on récupère les dimensions de l'image source

/* on utilise ceci pour calculer l'endroit où on va commencer */
/* à copier. on choisit en bas de l'image : calcul de la      */
/* différence de la hauteur de l'image de destination et de   */
/* l'image source.                                            */
$y = imagesy($image_dest)-imagesy($source);

imagecopymerge($image_dest,$source, 0, $y, 0, 0, $details_src[0],$details_src[1],100); //on copie l'image






imagepng($image_dest);
imagedestroy($image_dest);
imagedestroy($image_src);
