<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1"> 
   <?php foreach($videos as $video):?>
   <url> 
     <loc>http://www.jolatefri.com<?php echo $video->getUrlShow();?></loc>
     <video:video>
       <video:thumbnail_loc>http://www.jolatefri.com/uploads/thumb-video/<?php echo $video->getThumbnail();?></video:thumbnail_loc> 
       <video:title><?php echo $video->getTitle();?></video:title>
       <video:description><![CDATA[<?php echo strip_tags($video->getDescription(ESC_RAW));?>]]></video:description>
       <video:content_loc><?php echo $video->getcode();?></video:content_loc>
       <video:player_loc allow_embed="yes" autoplay="ap=1">
         <![CDATA[http://www.jolatefri.com/JLTPlayer.swf?videourl=<?php echo $video->getcode();?>&imgurl=http://www.jolatefri.com/uploads/thumb-video/<?php echo $video->getThumbnail();?>&permalink=http://www.jolatefri.com<?php echo $video->getUrlShow();?>&title=<?php echo $video->getTitle();?>]]>
       </video:player_loc>
       <video:live>no</video:live>
       <video:view_count><?php echo $video->getNbVue() ?></video:view_count>    
       <video:tag><?php echo $video->getCategory() ?></video:tag> 
       <video:tag>buzz</video:tag> 
       <video:tag>humour</video:tag> 
       <video:category><?php echo $video->getCategory() ?></video:category>
       <video:family_friendly>yes</video:family_friendly>   
       <video:uploader info="http://www.jolatefri.com<?php echo $video->getUsers()->getUrlShow() ?>"><?php echo $video->getUsers()->getUsername() ?>
         </video:uploader>
     </video:video> 
   </url> 
   <?php endforeach;?>
</urlset>