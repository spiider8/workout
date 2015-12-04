<?php

namespace FrontModule;

use Nette;
use App\Forms\SignFormFactory;
use App\Model\UserManager;


class SignPresenter extends BasePresenter
{
	/** @var SignFormFactory @inject */
	public $factory;

	/** @var \Kdyby\Facebook\Facebook */
    private $facebook;

    /** @var UsersModel */
    private $usersModel;

	public function __construct(\Kdyby\Facebook\Facebook $facebook, UserManager $usersModel)
	{
        parent::__construct();
        $this->facebook = $facebook;
        $this->usersModel = $usersModel;
    }

    /** @return \Kdyby\Facebook\Dialog\LoginDialog */
    protected function createComponentFbLogin()
    {
        $dialog = $this->facebook->createDialog('login');
        /** @var \Kdyby\Facebook\Dialog\LoginDialog $dialog */

        $dialog->onResponse[] = function (\Kdyby\Facebook\Dialog\LoginDialog $dialog) {
            $fb = $dialog->getFacebook();
            if (!$fb->getUser()) {
                $this->flashMessage("Sorry bro, facebook authentication failed.");
                return;
            }

            try {
                $me = $fb->api('/me');
                
                if (!$existing = $this->usersModel->findByFacebookId($fb->getUser())) {
                    $existing = $this->usersModel->registerFromFacebook($fb->getUser(), $me);
                }

                $this->usersModel->updateFacebookAccessToken($fb->getUser(), $fb->getAccessToken());
                $this->usersModel->updateLastLoginFcb($existing->id);
                $this->user->login(new \Nette\Security\Identity($existing->id, $existing->roles, $existing));
                
               

            } catch (\Kdyby\Facebook\FacebookApiException $e) {
            
                \Tracy\Debugger::log($e, 'facebook');
                $this->flashMessage("Sorry bro, facebook authentication failed hard.");
            }

            $this->redirect('Train:');
        };

        return $dialog;
    }

	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = $this->factory->create();
		$form->onSuccess[] = function ($form) {
			$form->getPresenter()->redirect('Homepage:');
		};
		return $form;
	}


	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}

}
