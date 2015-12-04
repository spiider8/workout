<?php

namespace FrontModule;

use \Nette;
use \App\Model;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends \Nette\Application\UI\Presenter
{
	/** @var \App\Model\Exercise @inject */
	public $exercise;

	/** @var \App\Model\Train @inject */
	public $train;

	/** @var \App\Model\Block @inject */
	public $block;

	/** @var \App\Model\TrainItem @inject */
	public $trainItem;
}
