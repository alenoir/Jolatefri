<div id="small-sidebar-wrapper">
	<nav id="small-sidebar">
		<div id="share">
			<ul>
				<li id="facebook-btn">
					<a target="_blank" href="http://www.facebook.com/Jolatefri.video">Facebook</a>
				</li>
				<li id="twitter-btn">
					<a target="_blank" href="http://twitter.com/#!/jolatefri">Twitter</a>
				</li>
				<li id="rss-btn">
					<a type="application/rss+xml" target="_blank" href="http://feeds.feedburner.com/jolatefri">RSS</a>
				</li>
			</ul>
		</div>
		<?php if (has_slot('partage-video')): ?>
			<div id="partage-sidebar">
				<center>
					<?php include_slot('partage-video') ?>
				</center>
			
			</div>
		<?php endif; ?>
		<?php include_component('category', 'listSidebar');?>
	</nav>
</div>
	