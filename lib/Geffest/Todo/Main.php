<?php

namespace Geffest\Todo;

/**
*
*/
class Main
{
	use Singleton;

	protected $userID;
	protected $sessID;

	function __construct()
	{
		if (!empty($_REQUEST["a"])) {
			$this->sessID = htmlspecialchars($_REQUEST["a"]);
		}

		session_start();

		$this->sessID = session_id();
		$this->authorize($this->sessID);
	}

	protected function authorize()
	{
		$this->getUser();
		session_id($this->sessID);
	}

	protected function getUser()
	{
		$pdo = DB::getInstance()->getPDO();

		$stmt = $pdo->query("SELECT * FROM `users` WHERE `session_id` = '{$this->sessID}'");

		if ($row = $stmt->fetch()) {
			// TODO: дата последнего входа
			$this->userID = $row["id"];
		} else {
			$pdo->query("INSERT INTO `users` (`session_id`) VALUES ('{$this->sessID}')");
			$this->userID = $pdo->lastInsertId();
		}
	}

	public function getUserID()
	{
		return $this->userID;
	}

	public static function printJsonResult($data = [])
	{
		exit(json_encode($data));
	}
}