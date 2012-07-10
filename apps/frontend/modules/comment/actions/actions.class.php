<?php

/**
 * comment actions.
 *
 * @package    jolatefri
 * @subpackage comment
 * @author     Antoine Lenoir
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class commentActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->comments = Doctrine_Core::getTable('comment')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new commentForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new commentForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($comment = Doctrine_Core::getTable('comment')->find(array($request->getParameter('id'))), sprintf('Object comment does not exist (%s).', $request->getParameter('id')));
    $this->form = new commentForm($comment);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($comment = Doctrine_Core::getTable('comment')->find(array($request->getParameter('id'))), sprintf('Object comment does not exist (%s).', $request->getParameter('id')));
    $this->form = new commentForm($comment);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($comment = Doctrine_Core::getTable('comment')->find(array($request->getParameter('id'))), sprintf('Object comment does not exist (%s).', $request->getParameter('id')));
    $comment->delete();

    $this->redirect('comment/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $comment = $form->save();

      $this->redirect('comment/edit?id='.$comment->getId());
    }
  }
}
