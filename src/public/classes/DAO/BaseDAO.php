<?php

namespace Newsletter\DAO;

use PDO;

class BaseDAO
{
	/** @var PDO */
	protected $connection;

	/**
 	* @param PDO $connection
 	*/
	public function __construct(PDO $connection)
	{
		$this->connection = $connection;
	}
}
