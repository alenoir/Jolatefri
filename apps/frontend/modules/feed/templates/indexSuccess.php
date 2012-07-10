<?php echo '<?xml version="1.0" encoding="utf-8" ?>';?>
	<rss version="2.0">
	<channel>
	<title>Jolatefri : toujours plus de vidéos !</title>
	<link>http://www.jolatefri.com</link>
	<description><![CDATA[Vidéos humour, buzz et fun du web. Retrouvez une sélection des vidéos les plus marrantes du web. Tout est présent sur jolatefri.com pour passer du bon temps et découvrir les buzz du moment ! Jolatefri : toujours plus de vidéos !]]></description>
	<copyright><![CDATA[© 2012 Jolatefri]]></copyright>
	<language>fr</language>
	<image>
    		<title>Jolatefri</title>
    		<url>http://www.jolatefri.com/images/logo_jolatefri.png</url>
    		<link>http://www.jolatefri.com</link>
	</image>
	<?php foreach($videos as $video):?>
		<item>
			<title><![CDATA[<?php echo $video->getTitle();?>]]></title>
			<link><![CDATA[<?php echo $video->getUrlShow(true);?>]]></link>
			<thumbnail><![CDATA[<?php echo $video->getThumbnail(true);?>]]></thumbnail>
			<pubDate><![CDATA[<?php echo $video->getCreatedAt();?>]]></pubDate>
			<description><![CDATA[<a href="<?php echo $video->getUrlShow(true);?>" ><img src="<?php echo 'http://www.jolatefri.com'.$video->getSrcThumbnail(150, 150);?>" hspace="5" align="left" /></a><?php echo strip_tags($video->getDescription(ESC_RAW));?>]]></description>
			<enclosure url="<?php echo $video->getThumbnail(true);?>" type="image/jpeg" length="1" />
			<guid isPermaLink="true"><![CDATA[<?php echo $video->getUrlShow(true);?>]]></guid>
			<author>Jolatefri</author>
		</item>
	<?php endforeach;?>
	</channel>
</rss>
