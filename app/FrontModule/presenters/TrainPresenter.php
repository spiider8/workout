<?php

namespace FrontModule;

use Nette;
use App\Model;
use App\Forms\NewTrainFormFactory;


class TrainPresenter extends SecuredPresenter
{
	/** @var Nette\Database\Context */
    private $database;

    /** @var NewTrainFormFactory @inject */
	public $factory;

    public function __construct(Nette\Database\Context $database)
    {
    	$this->database = $database;
    }

    /**
	 * New train form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentNewTrainForm()
	{
		$form = $this->factory->create($this->database);
		$form->onSuccess[] = function ($form) {
			$form->getPresenter()->redirect('this');
		};
		return $form;
	}

	public function renderDefault()
	{
		
	}

}
