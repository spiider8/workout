<?php

namespace App\Model;

class Block extends BaseModel
{
	private $table = 'blocks';

	/**
	 * Pridani noveho bloku
	 * @param array $data
	 * @return
	 */
	public function addBlock($data)
	{
		return $this->database->table($this->table)->insert($data);
	}

	public function getBlocksByTrain($trainId)
	{
		return $this->database->table($this->table)->where('train_id', $trainId);
	}
}