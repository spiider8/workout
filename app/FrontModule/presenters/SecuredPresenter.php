<?php

namespace FrontModule;

class SecuredPresenter extends BasePresenter
{
    public function startup()
    {
        parent::startup();
        $page = trim($this->presenter->name . ':' . $this->presenter->action);
        
        if (!$this->getUser()->isLoggedIn() && $page != 'Front:Train:view') {
        	$this->redirect('Sign:in');
        }
		
    }
}