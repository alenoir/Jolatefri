<?php
// auto-generated by sfViewConfigHandler
// date: 2012/03/15 10:12:24
$response = $this->context->getResponse();


  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());



  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'friteuse_layout' ? false : 'friteuse_layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', 'La friteuse de Jolatefri !', false, false);
  $response->addMeta('description', 'Partagez vos liens, photos et vidéos sur la friteuse de Jolatefri.com.', false, false);
  $response->addMeta('language', 'fr', false, false);
  $response->addMeta('robots', 'index, follow', false, false);

  $response->addStylesheet('friteuse.css', '', array ());
  $response->addStylesheet('lib/sticky.min.css', '', array ());
  $response->addStylesheet('mTip.css', '', array ());
  $response->addStylesheet('zocial.css', '', array ());
  $response->addStylesheet('sticky.min.css', '', array ());
  $response->addJavascript('lib/jquery.min.js', '', array ());
  $response->addJavascript('lib/jquery.validate.min.js', '', array ());
  $response->addJavascript('lib/shadowbox.js', '', array ());
  $response->addJavascript('main.js', '', array ());
  $response->addJavascript('/ckeditor/ckeditor.js', '', array ());
  $response->addJavascript('mTip-v1.0.1.js', '', array ());
  $response->addJavascript('jwplayer.js', '', array ());
  $response->addJavascript('lib/pagescroller.min.js', '', array ());
  $response->addJavascript('lib/sticky.min.js', '', array ());


