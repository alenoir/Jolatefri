<td>
	<a href="<?php echo url_for('video_edit', $video) ?>" ?>
		<?php echo image_tag('/uploads/thumb-video/'.$video->getThumbnail(), array('size' => '100x80'));?>
	</a>
</td>
<td class="sf_admin_text sf_admin_list_td_title">
  <?php echo $video->getTitle() ?>
</td>

<td class="sf_admin_text sf_admin_list_td_description">
  <?php echo $video->getDescription() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_code">
  <?php echo $video->getCode() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nbVue">
  <?php echo $video->getNbVue() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_mode">
  <?php echo $video->getMode() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_is_activated">
  <?php echo $video->getIsActivated(); ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_category_id">
  <?php echo $video->getCategory()->getName() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_user_id">
  <?php echo $video->getUsers()->getUsername(); ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($video->getUpdatedAt()) ? format_date($video->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
