<?php

namespace FrontModule;

use Nette;
use App\Model;
use App\Forms\NewExerciseFormFactory;


class ExercisePresenter extends SecuredPresenter
{
    
	/** @var NewExerciseFormFactory @inject */
	public $factory;

	/**
	 * Tovarna pro formular pridani formulare
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentNewExerciseForm()
	{
		$form = $this->factory->create($this->exercise, $this->user->getId());
		$form->onSuccess[] = function ($form) {
			$this->getPresenter()->flashMessage('Exercise was added', 'success');
			$form->getPresenter()->redirect('default');
		};
		return $form;
	}

	public function renderDefault()
	{
		//$this->template->exercisesAll = $this->exercise->getAll();
		$this->template->exercisesUser = $this->exercise->getExerciseByUser($this->user->getId());
	}

	public function renderList()
	{
		
	}

	public function actionDelete($id)
	{
		if ($id > 0) {
			if ($this->exercise->delete($id)) {
				$this->flashMessage('Exercise was deleted', 'success');
			}
			else {
				$this->flashMessage('Exercise was not deleted', 'error');	
			}

		}
		else {
			$this->flashMessage('ID of exercise was not found', 'info');
		}
		$this->redirect('default');
	}

}
