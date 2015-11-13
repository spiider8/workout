<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;


class NewTrainFormFactory extends Nette\Object
{
	
	/**
	 * @return Form
	 */
	public function create($database)
	{
		$form = new Form;
		//vytvorit kontejner pro bloky
		//vymyslet lepsi zadavani noveho treninku
		$form->addText('name', 'Name:')
			->setRequired('Please enter name of train.');
		$form->addText('date', 'Date:')
				->setDefaultValue(date('d.m.Y'));
		$exercises = $database->table('exercises')->order('name')->fetchPairs('id', 'name');	
		$form->addSelect('exercise', 'Exercise:', $exercises);
		$form->addText('sets', 'Count of sets');
		$form->addText('reps', 'Count of reps');
		$form->addSubmit('save', 'Save');

		$form->onSuccess[] = array($this, 'formSucceeded');
		return $form;
	}

	public function formSucceeded(Form $form, $values)
	{
		
	}

}
