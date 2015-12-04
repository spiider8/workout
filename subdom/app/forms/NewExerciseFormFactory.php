<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Forms\Container;


class NewExerciseFormFactory extends Nette\Object
{
	
	private $exerciseModel;

	private $userId;

	/**
	 * Form pro pridani noveho cviku
	 * @param
	 * @return Form
	 */
	public function create($exerciseModel, $userId)
	{
		$this->exerciseModel = $exerciseModel;
		$this->userId = $userId;
		
		$form = new Form;
		$form->addText('name', 'Name')
				->setRequired();
		$form->addTextArea('description', 'Description');
		
		$form->addSubmit('saveExercise', 'Save')->setAttribute('class', 'box');

		$form->onSuccess[] = array($this, 'formSucceeded');
		
		return $form;
	}

	public function formSucceeded(Form $form, $values)
	{
		$exerciseData = array(
				'user_id' => $this->userId,
				'name' => $values->name,
				'description' => $values->description,
			);

		$id = $this->exerciseModel->addExercise($exerciseData);
		

	}

}
