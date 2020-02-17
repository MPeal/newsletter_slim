<?php

namespace Newsletter\DAO;

use Newsletter\DAO\BaseDAO;
use PDO;
use Newsletter\VO\Subscriber;

class NewsLetterDAO extends BaseDAO
{
	/**
 	* @param PDO $connection
 	*/
	public function __construct(PDO $connection)
	{
		parent::__construct($connection);
	}

	/**
 	* @param string $name
 	* @param string $email
 	*/
	public function submitSignup(string $name, string $email)
	{
		$stmt = $this->connection->prepare("INSERT INTO `newsletter_subscribers` (name, email, signup_date)
				VALUES (?, ?, date(NOW()))");
		$stmt->execute([
			$name,
			$email
		]);
	}

	/**
 	* @return Subscriber[]
 	*/
	public function getSubscribers(): iterable
	{
		$subs = [];
		$sql = "SELECT name, email, signup_date FROM `newsletter_subscribers` ORDER BY `signup_date` DESC";
		$result = $this->connection->query($sql);
		foreach ($result as $sub) {
			$sub = new Subscriber($sub);
			$subs[] = $sub;
		}

		return $subs;
	}
}