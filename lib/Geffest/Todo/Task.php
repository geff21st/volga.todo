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
	}

	public function add($name = "")
	{
		if (empty($name)) return false;

		$stmt = $this->pdo->prepare("INSERT INTO `tasks` (`added_at`, `name`, `user_id`) VALUES (NOW(), :name, {$this->userID})");
		$stmt->bindParam(':name', $name);

		return $stmt->execute();
	}

	public function edit()
	{
		$pdo = DB::getInstance()->getPDO();

	}

	public function remove()
	{
		$pdo = DB::getInstance()->getPDO();
	}

	public function get()
	{
		$stmt = $this->pdo->query("SELECT * FROM `tasks` WHERE `user_id` = '{$this->userID}'");

		echo "<pre>";

		while ($row = $stmt->fetch()) {
			print_r($row);
		}

	}
}