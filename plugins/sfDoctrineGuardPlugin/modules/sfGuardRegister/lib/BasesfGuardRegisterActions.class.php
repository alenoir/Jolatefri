<?php

class BasesfGuardRegisterActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('notice', 'Vous êtes déjà enregistré et connecté !');
      $this->redirect('@homepage');
    }

    $this->form = new sfGuardRegisterForm();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $user = $this->form->save();
        $this->getUser()->signIn($user);
		$this->getUser()->setFlash('ok', 'Vous faites maintenant parti de la communauté de Jolatefri ! Bonne visite !');
        $this->redirect('@homepage');
      }
    }
  }
}