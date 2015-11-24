<?php

namespace FrontModule;

use Nette;
use App\Model;


class ExercisePresenter extends SecuredPresenter
{
    
	/**
	 * Tovartna pro formular pridani formulare
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentNewExerciseForm()
	{
		$form = $this->factory->create();
		$form->onSuccess[] = function ($form) {
			$this->getPresenter()->flashMessage('Exercise was added', 'success');
			$form->getPresenter()->redirect('list');
		};
		return $form;
	}

	public function renderDefault()
	{
		
	}

	public function renderList()
	{
		
	}

	public function actionDelete($trainId)
	{
		
	}

}
