<?php

namespace Geffest\Todo;


class Task
{
	protected $pdo;
	protected $userID;

	function __construct()
	{
		$this->pdo = DB::getInstance()->getPDO();
		$this->userID = Main::getInstance()->getUserID();

		$this->removeOldTasks();
	}

	public function add($name = "")
	{
		if (empty($name)) return false;

		$stmt = $this->pdo->prepare("INSERT INTO `tasks` (`added_at`, `name`, `user_id`) VALUES (NOW(), :name, {$this->userID})");
		$stmt->bindParam(':name', $name);

		return $stmt->execute();
	}

	public function finish($id)
	{
		if (empty($id)) return false;

		$stmt = $this->pdo->prepare("UPDATE `tasks` SET `finished` = 1, `finished_at` = NOW() WHERE `id` = {$id} AND `user_id` = {$this->userID}");

		return $stmt->execute();
	}

	public function edit($id, $name)
	{
		if (empty($id) || empty($name)) return false;

		$stmt = $this->pdo->prepare("UPDATE `tasks` SET `name` = :name WHERE `id` = {$id} AND `user_id` = {$this->userID}");

		$stmt->bindParam(':name', $name);

		return $stmt->execute();
	}

	public function remove($id)
	{
		$this->pdo->query("DELETE FROM `tasks` WHERE `id` = {$id} AND `user_id` = {$this->userID}");
	}

	public function get()
	{
		$stmt = $this->pdo->query("SELECT * FROM `tasks` WHERE `user_id` = '{$this->userID}'");
		$arTasks = [];

		while ($row = $stmt->fetch()) {
			$arTasks[] = $row;
		}

		return $arTasks;
	}

	public function removeOldTasks()
	{
		$this->pdo->query("DELETE FROM `tasks` WHERE `user_id` = '{$this->userID}' AND `finished_at` <= NOW() - INTERVAL 1 HOUR");
	}

}