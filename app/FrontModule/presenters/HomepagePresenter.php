<?php

namespace FrontModule;

use \Nette;
use \App\Model;


class HomepagePresenter extends BasePresenter
{
	/** @var Nette\Database\Context */
    private $database;

    public function __construct(\Nette\Database\Context $database)
    {
        $this->database = $database;
    }

	public function renderDefault()
	{
		$this->template->news = $this->database->table('news')->order('created')->limit(10);
	}

}
