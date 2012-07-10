<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta property="fb:app_id" content="<?php echo sfconfig::get('app_facebook_app_id');?>"/>

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
	
		<?php include_partial('global/popin_init');?>
	
	<?php if ($sf_user->isAuthenticated() && !$sf_user->getGuardUser()->usernameIsSet()):?>
		
		<script type="text/javascript">
			$(document).ready(function(){
				
				$.ajax({
					url: "<?php echo  url_for('@set_username');?>",
					success: function(data){
						$("#content-popin").html(data);
						$("#wrapper-popin").fadeIn();
						var widthPopin = $("#content-popin").width()/-2;
						var heightPopin = $("#content-popin").height()/-2;
						$("#content-popin").css({'margin-left':widthPopin+'px', 'margin-top':heightPopin+'px'});
						$("#content-popin").fadeIn();
					}
				});

			     
				
				
			});
		</script>
		
	<?php endif;?>

	<?php include_partial('global/facebookInit');?>

	<?php include_partial('global/flashes');?>

  	<?php include_partial('global/header');?>
  	<div id="nav">
  		<div id="share-wrapper" style="display:none;"></div>
  		
  		<?php echo $sf_content ?>
  		<?php include_partial('global/big-sidebar');?>
  		
  		<div style="clear:both;"></div>
  	</div>
  	<?php include_partial('global/footer');?>
  	
  	<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'jolatefri'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
</script>
<div class="fb-social-bar" data-href="http://www.jolatefri.com" data-action="recommend" data-side="left"></div>

  </body>
</html>
