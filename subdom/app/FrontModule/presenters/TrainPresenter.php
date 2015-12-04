<?php

namespace FrontModule;

use Nette;
use App\Model;
use App\Forms\NewTrainFormFactory;


class TrainPresenter extends SecuredPresenter
{
    /** @var NewTrainFormFactory @inject */
	public $factory;

    /**
	 * Tovarna pro formular pridani formulare
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentNewTrainForm()
	{
		$form = $this->factory->create($this->exercise, $this->train, $this->block, $this->trainItem, $this);
		$form->onSuccess[] = function ($form) {
			$this->getPresenter()->flashMessage('Train was added', 'success');
			$form->getPresenter()->redirect('list');
		};
		return $form;
	}

	public function renderDefault()
	{
		$this->template->lastTrain = $this->train->getLastTrainByUser($this->user->getId());

		$this->template->weekly = $this->train->getStatisticsPeriod($this->user->getId(), '1 WEEK');
		$this->template->monthly = $this->train->getStatisticsPeriod($this->user->getId(), '1 MONTH');
		$this->template->total = $this->train->getStatisticsTotal($this->user->getId());

	}

	public function renderList()
	{
		$this->template->trains = $this->train->getTrainsByUser($this->user->getId());
	}

	public function actionDelete($trainId)
	{
		if ($this->train->deleteTrain($trainId)) {
			$this->flashMessage('Train was deleted', 'success');
		}
		else {
			$this->flashMessage('Train was not deleted', 'error');
		}
		$this->redirect('list');
	}

	public function getSumExerciseByTrain($trainId)
	{
		return $this->train->getSumExerciseByTrain($trainId);
	}

}
