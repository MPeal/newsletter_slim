<?php

namespace Newsletter\VO;

use \Newsletter\VO\BaseObject;

class Subscriber extends BaseObject
{
	/** @var string */
	public $name;
	/** @var string */
	public $email;
	/** @var DateTime */
	public $signup_date;

	/**
 	* @param array $data
 	*/
	public function __construct(array $data)
	{
		parent::setProperty($data);
	}
}