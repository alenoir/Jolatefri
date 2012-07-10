<?php use_helper('I18N', 'Date') ?>
<?php include_partial('video/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Edit Video', array(), 'messages') ?></h1>

  <?php include_partial('video/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('video/form_header', array('video' => $video, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('video/form', array('video' => $video, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('video/form_footer', array('video' => $video, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
