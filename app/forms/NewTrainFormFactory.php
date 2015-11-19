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
		
		$blocks = $form->addDynamic('blocks', function (Container $block) use (&$i, $database) {
				
				$j = 1;
				$exercises = $block->addDynamic('exercises', function (Container $exercise) use (&$i, &$j, $database) {
					
					$exercisesList = $database->table('exercises')->order('name')->fetchPairs('id', 'name');
					
					$exercise->addSelect('exercise', 'Exercise', $exercisesList);
					$exercise->addCheckbox('ledder', 'Ledder')
						->addCondition(FORM::EQUAL, TRUE)
							->toggle('ledderFrom-' . $i . '-' . $j)->toggle('ledderTo-' . $i . '-' . $j)
							->toggle('ledderFromLabel-' . $i . '-' . $j)->toggle('ledderToLabel-' . $i . '-' . $j);
				
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
					$exercise->addText('ledderFrom', 'From');
					$exercise->addText('ledderTo', 'To');
					
					$exercise->addCheckbox('moreWeight', 'More weight')
							->addCondition(FORM::EQUAL, TRUE)
								->toggle('moreWeightValue-' . $i . '-' . $j);
					$exercise->addText('moreWeightValue', 'Weight');
					
					$exercise->addSelect('unitMoreWeight', 'Weight unit', array(
							'Kg',
							'Lb',
						))
							->addConditionOn($exercise['moreWeight'], FORM::EQUAL, TRUE)
								->toggle('unitMoreWeight-' . $i . '-' . $j);

					$exercise->addSubmit('removeExercise', '')->addRemoveOnClick()->setAttribute('class', 'ajax box');
					$j++;
				}, 1, TRUE);	
				
				$exercises->addSubmit('addExercise', 'Add exercise')->setValidationScope(FALSE)
					->addCreateOnClick(TRUE)->setAttribute('class', 'ajax box');

				$block->addSubmit('removeBlock', 'Remove block')->addRemoveOnClick()->setAttribute('class', 'ajax box');
				$i++;

				
    	}, 1, TRUE);

		$blocks->addSubmit('addBlock', 'Add block')->setValidationScope(FALSE)
			->addCreateOnClick(TRUE)->setAttribute('class', 'ajax box');
		
		$form->addSubmit('saveTrain', 'Save train')->setAttribute('class', 'ajax box');

		$form->onSuccess[] = array($this, 'formSucceeded');
		
		return $form;
	}

	public function formSucceeded(Form $form, $values)
	{
		dump($values);exit;
	}

}
