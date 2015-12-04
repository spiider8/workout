<?php

namespace FrontModule;

class SecuredPresenter extends BasePresenter
{
    public function startup()
    {
        parent::startup();

        if (!$this->getUser()->isLoggedIn()) {
        	$this->redirect('Sign:in');
        }
		
    }
}