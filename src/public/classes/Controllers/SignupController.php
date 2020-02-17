<?php

namespace Newsletter\Controllers;

use Newsletter\DAO\NewsletterDAO;

class SignupController 
{
	/** @var NewsLetterDAO */
	private $NewsLetterDAO;

	/**
 	* @param NewsLetterDAO $NewsLetterDAO
 	*/
	public function __construct(NewsletterDAO $NewsLetterDAO)
	{
		$this->NewsLetterDAO = $NewsLetterDAO;
	}

	/**
 	* @param string $name
 	* @param string $email
 	*/
	public function signupUser(string $name, string $email)
	{
		$this->NewsLetterDAO->submitSignup($name, $email);
	}

	/**
 	* @return Subscriber[]
 	*/
	public function getSubscribers(): iterable
	{
		return $this->NewsLetterDAO->getSubscribers();
	}
}
