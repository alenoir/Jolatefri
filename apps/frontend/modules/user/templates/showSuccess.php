<?php include_partial('user/header', array('user' => $user));?>
<?php include_partial('global/user_sidebar');?>
<div id="wrapper-content-user" class="block">
	<ul id="menu">
		<li>
			<a href="#" id="post">
				Posts
			</a>
		</li>
	</ul>
	<div id="content-user">
		<?php include_partial('user/user_posts', array('pager' => $pager));?>
	</div>

</div>


