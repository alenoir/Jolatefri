<?php
// auto-generated by sfViewConfigHandler
// date: 2012/03/30 01:43:34
$response = $this->context->getResponse();

if ($this->actionName.$this->viewName == 'facebookSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'showSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}

if ($templateName.$this->viewName == 'facebookSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else
  {
    $this->setDecoratorTemplate('' == 'layout_facebook' ? false : 'layout_facebook'.$this->getExtension());
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
}
else if ($templateName.$this->viewName == 'showSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else
  {
    $this->setDecoratorTemplate('' == 'layout_video' ? false : 'layout_video'.$this->getExtension());
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
}
else
{
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
}
