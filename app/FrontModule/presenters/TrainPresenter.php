<?php

namespace FrontModule;

use Nette;
use App\Model;


class TrainPresenter extends SecuredPresenter
{
	/** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
    	$this->database = $database;
    }

	public function renderDefault()
	{
		
	}

}
