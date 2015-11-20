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
	 * Tovartna pro formular pridani formulare
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentNewTrainForm()
	{
		$form = $this->factory->create($this->exercise, $this->train, $this->block, $this->trainItem, $this->user);
		$form->onSuccess[] = function ($form) {
			$this->getPresenter()->flashMessage('Train was added', 'success');
			$form->getPresenter()->redirect('this');
		};
		return $form;
	}

	public function renderDefault()
	{
		$this->template->lastTrain = $this->train->getLastTrainByUser($this->user->getId());
		/*foreach($lastTrain->related('blocks.train_id') as $block) {
			echo $block->id;
		}
		exit;
		$lastBlocks = $this->block->getBlocksByTrain($lastTrain->id);
		foreach ($lastBlocks as $block) {
			$lastTrainItems[$block->id] = $this->trainItem->getItemsByBlock($block->id);
		}
		
		foreach ($lastTrainItems as $item) {
			echo $item['block_id'] . '-';
		}
		exit;*/
	}

}
