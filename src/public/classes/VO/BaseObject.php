<?php

namespace Newsletter\VO;

class BaseObject
{
	/**
 	* @param array $data
 	*/
	public function __construct(array $data)
	{
		$this->setProperty($data);
	}

	/**
 	* @param array $data
 	*/
	protected function setProperty(array $data)
	{
		foreach ($data as $key => $value) {
			if (property_exists($this, $key)) {
				$this->{$key} = $value;
			}
		}
	}
}
