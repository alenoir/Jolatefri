<td colspan="13">
  <?php echo __('%%id%% - %%title%% - %%description%% - %%thumbnail%% - %%code%% - %%nbVue%% - %%nbCommentaire%% - %%mode%% - %%is_activated%% - %%category_id%% - %%user_id%% - %%created_at%% - %%updated_at%%', array('%%id%%' => link_to($video->getId(), 'video_edit', $video), '%%title%%' => $video->getTitle(), '%%description%%' => $video->getDescription(), '%%thumbnail%%' => $video->getThumbnail(), '%%code%%' => $video->getCode(), '%%nbVue%%' => $video->getNbVue(), '%%nbCommentaire%%' => $video->getNbCommentaire(), '%%mode%%' => $video->getMode(), '%%is_activated%%' => get_partial('video/list_field_boolean', array('value' => $video->getIsActivated())), '%%category_id%%' => $video->getCategoryId(), '%%user_id%%' => $video->getUserId(), '%%created_at%%' => false !== strtotime($video->getCreatedAt()) ? format_date($video->getCreatedAt(), "f") : '&nbsp;', '%%updated_at%%' => false !== strtotime($video->getUpdatedAt()) ? format_date($video->getUpdatedAt(), "f") : '&nbsp;'), 'messages') ?>
</td>
