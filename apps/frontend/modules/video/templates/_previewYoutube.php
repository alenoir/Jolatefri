<?php 
if($wrongUrl)
{
	echo 'Mauvaise url';
}
else
{
	echo '<object width="421" height="313"><param name="movie" value="http://www.youtube.com/v/'.$code.'&hl=fr_FR&fs=1&"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$code.'&hl=fr_FR&fs=1&" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="421" height="313"></embed></object>';
	
}
?>