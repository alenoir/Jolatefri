
	<?php 
	$notice = $sf_user->hasFlash('notice');
	if ($sf_user->hasFlash('notice') && $sf_user->getFlash('notice')): ?>
		<script>
		$(document).ready(function()
		  {
		    $.sticky(" <?php echo html_entity_decode($sf_user->getFlash('notice')); ?>");
		  });
		</script>
		<?php $sf_user->setFlash('notice', false);?>
	<?php elseif ($sf_user->hasFlash('ok')): ?>
		<script>
		$(document).ready(function()
		  {
		    $.sticky('<?php echo $sf_user->getFlash('ok'); ?>');
		  });
		</script>
	<?php elseif ($sf_user->hasFlash('error')): ?>
		<script>
		$(document).ready(function()
		  {
		    $.sticky(<?php echo $sf_user->getFlash('error'); ?>);
		  });
		</script>
	<?php endif; ?>


</script>