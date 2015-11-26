<?php

namespace App\Model;

class Exercise extends BaseModel
{
	private $table = 'exercises';

	/**
	 * Vrati seznam cviku, bud vsechny nebo vsechny + soukrome od uzivatele
	 * @param  int $userId ID uzivatele
	 * @return array
	 */
	public function getAll($userId)
	{
		$row = $this->database->table($this->table);
		if ($userId) {
			$row = $row->where('user_id = ? OR user_id IS NULL', $userId);
		}
		else {
			$row = $row->where('user_id IS NULL');
		}

		return $row->order('name')->fetchPairs('id', 'name');
	}



	
}