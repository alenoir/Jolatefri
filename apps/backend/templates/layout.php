<!DOCTYPE html>
<html lang="fr">
  <head>
  	<?php if (has_slot('meta_facebook')): ?>
		<?php include_slot('meta_facebook') ?>
	<?php endif; ?>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
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
	
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>
  </head>
  <body class="<?php echo sfContext::getInstance()->getRouting()->getCurrentRouteName();?>">
	<header>
		<h1>Jolatefri Backend</h1>
	</header>
	<nav id="menu">
		<ul>
			<li>
				<a href="<?php echo url_for('@video');?>">Vidéos</a>
			</li>
			<li>
				<a href="<?php echo url_for('@video_new');?>">Ajouter une vidéos</a>
			</li>
			<li>
				<a href="<?php echo url_for('@friteuse');?>">Friteuse</a>
			</li>
			<li>
				<a href="<?php echo url_for('@friteuse_new');?>">Ajouter à la friteuse</a>
			</li>
			<li>
				<a href="<?php echo url_for('@config');?>">Configurations</a>
			</li>
			
		</ul>
	</nav>
	<div style="clear:both;"></div>
  	<section id="nav-back">
  		<div id="share-wrapper" style="display:none;"></div>

  		<?php echo $sf_content ?>
  		<div style="clear:both;"></div>
  	</section>
  </body>
</html>
