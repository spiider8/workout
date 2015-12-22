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

	public function actionEdit($id)
	{
		$form = $this['newTrainForm'];
		
		if ($form->isSubmitted() && $form->submitted->name == 'saveTrain') {
			$values = $form->getValues();
			$trainData = array(
				'user_id' => $this->user->getId(),
				'name' => $values->name,
				'dateCreated' => date('Y-m-d H:i:s'),
				'dateTrain' => date('Y-m-d', strtotime(str_replace(' ', '-', $values->dateTrain))),
			);
			$trainId = $this->train->addTrain($trainData);

			foreach($values->blocks as $bkey => $block) {
			
				$blockData = array(
						'train_id' => $trainId,
						'number' => $bkey + 1,
						'blockRest' => $block->blockRest,
						'unitBlockRest' => $block->unitBlockRest,
						'repsOfBlock' => $block->repsOfBlock < 1 ? 1 : $block->repsOfBlock,
					);
				$blockId = $this->block->addBlock($blockData);
				foreach($block->exercises as $ekey => $exercise) {
					$exercisesData = array(
						'block_id' => $blockId,
						'exercise_id' => $exercise->exercise,
						'sets' => $exercise->sets,
						'reps' => $exercise->reps,
						'rest' => $exercise->rest,
						'unitRest' => $exercise->unitRest,
						'ledderFrom' => $exercise->ledderFrom,
						'ledderTo' => $exercise->ledderTo,
						'moreWeightValue' => $exercise->moreWeightValue,
						'unitMoreWeight' => $exercise->unitMoreWeight,
						'hold' => $exercise->hold,
						'unitHold' => $exercise->unitHold,
					);
					$this->trainItem->addItem($exercisesData);
				}
			}
			if ($this->train->deleteTrain($id)) {
				$this->flashMessage('Train was updated', 'success');
			}
			else {
				$this->flashMessage('Train was not updated', 'error');
			}
			
			$this->redirect('list');
		}
		else {
			$blocks = $this->block->getBlocksByTrain($id);
			$i = 0;
			foreach ($blocks as $block) {
        		$items = $this->trainItem->getItemsByBlock($block->id);
        		$form['blocks'][$i]->setValues($block);
        		$j = 0;

        		foreach ($items as $item) {
        			$exercise = $item->exercise;
        			$sets = $item->sets;
        			$reps = $item->exercise;
        			$rest = $item->exercise;
        			$ledderFrom = $item->exercise;
        			$ledderTo = $item->exercise;
        			$weight = $item->exercise;
        			$hold = $item->exercise;
        			$form['blocks'][$i]['exercises'][$j]->setValues($item);
        			$form['blocks'][$i]['exercises'][$j]['exercise']->setValue($item->exercise);
					$j++;
				} 
				$i++;
			}
			
			$train = $this->train->getTrainById($id);
			$form->setValues($train);

			
		}

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

	public function actionView($hash)
	{
		if (!$hash)
			$this->redirect('Sign:in');
		$this->template->train = $this->train->getTrainByHash($hash);
		$this->setLayout(false);
		
		
	}

	public function updateShare($trainId)
	{
		return $this->train->updateShare($trainId);
	}

}
