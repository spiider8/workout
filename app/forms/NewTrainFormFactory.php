<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Forms\Container;


class NewTrainFormFactory extends Nette\Object
{
	
	/**
	 * @return Form
	 */
	public function create($database)
	{
		$form = new Form;
		$form->addText('name', 'Name')
				->setRequired('Please enter name of train.');
		$form->addText('date', 'Date')
				->setDefaultValue(date('d.m.Y'));
				
				
		$i = 1;
		
		$form->addDynamic('blocks', function (Container $block) use (&$i, $database) {
				
				$exercises = $database->table('exercises')->order('name')->fetchPairs('id', 'name');	
				$block->addSelect('exercise', 'Exercise', $exercises);

				$block->addCheckbox('ledder', 'Ledder')
						->addCondition(FORM::EQUAL, TRUE)
		        			->toggle('ledderFrom-' . $i)->toggle('ledderTo-' . $i);
				
				$block->addCheckbox('moreWeight', 'More weight')
						->addCondition(FORM::EQUAL, TRUE)
		        			->toggle('moreWeightValue-' . $i);
						
				$block->addText('ledderFrom', 'From');
				$block->addText('ledderTo', 'To');

				$block->addText('moreWeightValue', 'Weight');		

				$block->addText('sets', 'Count of sets')
						->addConditionOn($block['ledder'], FORM::EQUAL, FALSE)
							->toggle('sets');
				$block->addText('reps', 'Count of reps')
						->addConditionOn($block['ledder'], FORM::EQUAL, FALSE)
							->toggle('reps');
				$block->addText('rest', 'Rest');

				$block->addSelect('unitRest', 'Rest unit', array(
						'min',
						's',
					));
				$block->addSelect('unitMoreWeight', 'Weight unit', array(
						'Kg',
						'Lb',
					));
				$block->addSubmit('remove', 'Remove')->addRemoveOnClick()->setAttribute('class', 'ajax');
				$i++;
    	}, 1);

		$form['blocks']->addSubmit('add', 'Next block')->setValidationScope(FALSE)
		    ->addCreateOnClick(TRUE);
		
		$form->addSubmit('save', 'Save');

		$form->onSuccess[] = array($this, 'formSucceeded');
		
		return $form;
	}

	public function formSucceeded(Form $form, $values)
	{
		dump($values);exit;
	}

}
