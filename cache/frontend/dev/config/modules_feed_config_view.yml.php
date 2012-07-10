<?php
// auto-generated by sfViewConfigHandler
// date: 2012/03/13 13:11:22
$response = $this->context->getResponse();


  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());



  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', 'Jolatefri : toujours plus de vidéos buzz, humour et fun du web', false, false);
  $response->addMeta('description', 'Vidéos humour, vidéos buzz les plus recentes. Retrouvez une sélection des vidéos humour et vidéos buzz les plus marrantes du web. Tout est présent sur jolatefri.com pour passer du bon temps et découvrir les buzz du web ! Jolatefri : toujours plus de vidéos !', false, false);
  $response->addMeta('language', 'fr', false, false);
  $response->addMeta('robots', 'index, follow', false, false);

  $response->addStylesheet('main.css', '', array ());
  $response->addStylesheet('shadowbox.css', '', array ());
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


