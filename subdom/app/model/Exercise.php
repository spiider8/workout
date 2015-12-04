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
	

	/**
	 * TODO: udelat nekolikd metod
	 * 1) vracet jenom uzivatelovi cviky
	 * 2) vracet vsechny (pro pridani do treninku)
	 * 3) vracet mix obou
	 * ........mozna jeste dalsi
	 */

	public function getAll($userId = false)
	{
		$row = $this->database->table($this->table);
		if ($userId) {
			$row = $row->where('user_id = ? OR user_id IS NULL', $userId);
		}
		else {
			$row = $row->where('user_id IS NULL');
		}

		return $row->order('name');
	}

	public function getExerciseByUser($userId)
	{
		return $this->database->table($this->table)->where('user_id', $userId)->fetchAll();
	}

	public function delete($exerciseId) {
		return $this->database->table($this->table)->where('id', $exerciseId)->delete();
	}

	public function addExercise($data) {
		return $this->database->table($this->table)->insert($data);
	}

	
}