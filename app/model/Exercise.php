<?php

namespace App\Model;

class Exercise extends BaseModel
{
	private $table = 'exercises';

	/**
	 * Vrati vsechny sloupecky
     * @return \Nette\Database\Table\Selection
     */
	public function getAll(){
		return $this->database->table($this->table);
	}

	
}