<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Forms\Container;


class NewTrainFormFactory extends Nette\Object
{
	
	private $exerciseModel;

	private $user;

	/**
	 * Form pro pridani noveho cviku
	 * @param
	 * @return Form
	 */
	public function create($exerciseModel, $user)
	{
		$this->exerciseModel = $exerciseModel;
		$this->user = $user;
		
		$form = new Form;
		$form->addText('name', 'Name')
				->setReuired();
		$form->addTextArea('description', 'Description');
		
		$form->addSubmit('saveExercise', 'Save')->setAttribute('class', 'box');

		$form->onSuccess[] = array($this, 'formSucceeded');
		
		return $form;
	}

	public function formSucceeded(Form $form, $values)
	{
		$exerciseData = array(
				'user_id' => $this->user->getId(),
				'name' => $values->name,
				'description' => date('Y-m-d H:i:s'),
			);

		$id = $this->exerciseModel->addExercise($exercisesData);
		

	}

}
