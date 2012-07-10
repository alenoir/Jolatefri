<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta property="fb:app_id" content="138964119509027"/>

  	<?php if (has_slot('meta_facebook')): ?>
		<?php include_slot('meta_facebook') ?>
	<?php endif; ?>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
	<link rel="alternate" type="application/rss+xml" href="http://feeds.feedburner.com/jolatefri" title="Jolatefri : toujours plus de vid�os">
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!--[if lte IE 7]>
		<script src="js/IE8.js" type="text/javascript"></script><![endif]-->
	<!--[if lt IE 7]>

	<link rel="stylesheet" type="text/css" media="all" href="css/ie6.css"/><![endif]-->
	
	<!-- analytics google -->
	
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-8934420-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
	
	
	<!-- /analytics google -->
	<meta name="viewport" content="width=1280" />

	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>
<body itemscope itemtype="http://schema.org/Product" class="<?php echo sfContext::getInstance()->getRouting()->getCurrentRouteName();?>">
<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) {return;}
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/fr_FR/all.js#appId=138964119509027&xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<?php include_partial('global/flashes');?>

  	<?php include_partial('global/header');?>
  	
  	<div id="nav">
  		
  		<?php include_component('video', 'slideShowLanding');?>
  		<div id="share-wrapper" style="display:none;"></div>
  		<?php include_partial('global/big-sidebar');?>
  		<?php echo $sf_content ?>
  		
  		<div style="clear:both;"></div>
  	</div>
  	<?php include_partial('global/footer');?>
  	
<div class="fb-social-bar" data-href="http://www.jolatefri.com" data-action="recommend" data-side="left"></div>

  </body>
</html>
