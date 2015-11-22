<?php

namespace App\Model;

class Train extends BaseModel
{
	private $table = 'trains';

	/**
	 * Pridani noveho treninku
	 * @param array $data
	 * @return
	 */
	public function addTrain($data)
	{
		return $this->database->table($this->table)->insert($data);
	}

	public function getLastTrainByUser($userId)
	{
		return $this->database->table($this->table)->where('user_id', $userId)->order('dateCreated DESC')->limit(1)->fetch();
	}

	public function getTrainsByUser($userId)
	{
		return $this->database->table($this->table)->where('user_id', $userId)->order('dateCreated DESC')->fetchAll();
	}

	public function deleteTrain($trainId)
	{
		return $this->database->table($this->table)->where('id', $trainId)->delete();
	}
}