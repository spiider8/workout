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
				->setRequired('Please enter name of train.')
				->setDefaultValue(date('d.m.Y'));

		$i = 1;
		
		$form->addDynamic('blocks', function (Container $block) use (&$i, $database) {
				
				$j = 1;
				$block->addDynamic('exercises', function (Container $exercise) use (&$j, $database) {
					
					$exercisesList = $database->table('exercises')->order('name')->fetchPairs('id', 'name');
					
					$exercise->addSelect('exercise', 'Exercise', $exercisesList);
					$exercise->addCheckbox('ledder', 'Ledder')
						->addCondition(FORM::EQUAL, TRUE)
							->toggle('ledderFrom-' . $j)->toggle('ledderTo-' . $j);
				
					$exercise->addCheckbox('moreWeight', 'More weight')
							->addCondition(FORM::EQUAL, TRUE)
								->toggle('moreWeightValue-' . $j);
							
					$exercise->addText('ledderFrom', 'From');
					$exercise->addText('ledderTo', 'To');

					$exercise->addText('moreWeightValue', 'Weight');		

					$exercise->addText('sets', 'Count of sets')
							->addConditionOn($exercise['ledder'], FORM::EQUAL, FALSE)
								->toggle('sets');
					$exercise->addText('reps', 'Count of reps')
							->addConditionOn($exercise['ledder'], FORM::EQUAL, FALSE)
								->toggle('reps');
					$exercise->addText('rest', 'Rest');

					$exercise->addSelect('unitRest', 'Rest unit', array(
							'min',
							's',
						));
					$exercise->addSelect('unitMoreWeight', 'Weight unit', array(
							'Kg',
							'Lb',
						))
							->addConditionOn($exercise['moreWeight'], FORM::EQUAL, TRUE)
								->toggle('unitMoreWeight-' . $j);
					
					$exercise->addSubmit('remove', 'Remove exercise')->addRemoveOnClick()->setAttribute('class', 'ajax');
					$j++;
				}, 1);	

				$block->addSubmit('remove', 'Remove block')->addRemoveOnClick()->setAttribute('class', 'ajax');
				$i++;

				$block['exercises']->addSubmit('add', 'Add exercise')->setValidationScope(FALSE)
					->addCreateOnClick(TRUE);
    	}, 1);

		$form['blocks']->addSubmit('add', 'Add block')->setValidationScope(FALSE)
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
