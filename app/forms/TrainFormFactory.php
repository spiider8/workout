<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;


class TrainFormFactory extends Nette\Object
{
	
	public function __construct()
	{
		
	}

	/**
	 * @return Form
	 */
	public function create()
	{
		$form = new Form;
		
		$form->addText('name', 'Name:')
			-
			->setRequired('Please enter name of train.');

		$form->addPassword('password', 'Password:')
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
		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}

}
