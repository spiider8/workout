<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;
use App\Model\UserManager;


class SignFormFactory extends Nette\Object
{
	/** @var User */
	private $user;

	private $userModel;

	public function __construct(User $user, UserManager $userModel)
	{
		$this->user = $user;
		$this->userModel = $userModel;
	}


	/**
	 * @return Form
	 */
	public function create()
	{
		$form = new Form;
		$form->addText('username', 'Username')
			->setRequired('Please enter your username.');

		$form->addPassword('password', 'Password')
			->setRequired('Please enter your password.');

		$form->addCheckbox('remember', 'Keep me signed in');

		$form->addSubmit('send', 'Sign in');

		$form->onSuccess[] = array($this, 'formSucceeded');
		return $form;
	}


	public function formSucceeded(Form $form, $values)
	{
		if ($values->remember) {
			$this->user->setExpiration('14 days', FALSE);
		} else {
			$this->user->setExpiration('20 minutes', TRUE);
		}

		try {
			$this->user->login($values->username, $values->password);
			$this->userModel->updateLastLogin($this->user->getId());
		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}

}
