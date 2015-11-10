<?php

namespace FrontModule;

abstract class SecuredPresenter extends BasePresenter
{
    public function startup()
    {
        parent::startup();

        if (!$this->getUser()->isLoggedIn()) {
			$this->error('This page does not exist or you have no permission for this page', 
					\Nette\Http\IResponse::S404_NOT_FOUND);
        }
		
    }
}