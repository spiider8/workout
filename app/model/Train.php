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

	/**
	 * Seznam cviku a jejich pocet zpetne za dany pocet dni
	 * @param  int $userId Id uzivatele
	 * @param  string $period pocet dni zpetne
	 * @return array
	 */
	public function getStatisticsPeriod($userID, $period)
	{
		return $this->database->query("
			SELECT
				e.name,
				COUNT(i.exercise_id) as exerciseCount,
				SUM(i.sets * i.reps) as setsRepsSum
			FROM trains t,blocks b, trainitems i, exercises e
			WHERE t.id = b.train_id
			AND b.id = i.block_id
			AND i.exercise_id = e.id
			AND date_format(t.dateTrain, '%Y-%m-%d') 
			BETWEEN date_format(date_sub(NOW(), INTERVAL $period), '%Y-%m-%d') 
			AND date_format(NOW(), '%Y-%m-%d')
			AND t.user_id = 5
			GROUP BY (i.exercise_id)
			ORDER BY setsRepsSum DESC
			")->fetchAll();
	}

	/**
	 * Seznam cviku a jejich pocet od pocatku
	 * @param  int $userId Id uzivatele
	 * @return array
	 */
	public function getStatisticsTotal($userId)
	{
		return $this->database->query("
			SELECT
				e.name,
				COUNT(i.exercise_id) as exerciseCount,
				SUM(i.sets * i.reps) as setsRepsSum
			FROM trains t,blocks b, trainitems i, exercises e
			WHERE t.id = b.train_id
			AND b.id = i.block_id
			AND i.exercise_id = e.id
			AND t.user_id = $userId
			GROUP BY (i.exercise_id)
			ORDER BY setsRepsSum DESC
			")->fetchAll();
	}
}