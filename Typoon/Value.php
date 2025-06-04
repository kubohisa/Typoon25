<?php

// https://www.yiiframework.com/doc/guide/2.0/ja/tutorial-core-validators
// https://wepicks.net/phpfunction-filter-filter_input

class Value
{
	/*
		System Functions.
	*/

	private $value;

	private $error;

	public static function set($value): Value
	{
		return new Value($value);
	}

	private function __construct($value)
	{
		$this->value = $value;

		$this->error = array();
		$this->error["SYSTEM"]["error"] = false;
	}

	private function initError($exec)
	{
		$this->error[$exec]["flag"] = false;
	}

	private function setError($exec, $message = "")
	{
		$this->error["SYSTEM"]["error"] = true;
		$this->error[$exec]["flag"] = true;
		$this->error[$exec]["message"] = (string)$message;
	}

	public function getError()
	{
		$this->error["SYSTEM"]["value"] = $this->value;
		// back up.

		return $this->error;
	}

	public function close()
	{
		return $this->getError();
	}

	/*
	
	*/

	public function validate($exec, ...$option)
	{
		$this->initError($exec);

		//
		if ($exec === "in") {
			$exec = "required";
		}
		if ($exec === "notNull") {
			$exec = "required";
		}
		if ($exec === "empty") {
			$exec = "required";
		}
		if ($exec === "same") {
			$exec = "equal";
		}
		if ($exec === "") {
			$exec = "";
		}

		//
		switch ($exec) {
			case "required":
				if (empty($this->value)) {
					$this->setError($exec);
				}
				break;

			//
			case "min":
				if ($this->value < $option[0]) {
					if (empty($option[1])) $option[1] = "";
					$this->setError($exec, $option[1]);
				}
				break;

			case "max":
				if ($this->value > $option[0]) {
					if (empty($option[1])) $option[1] = "";
					$this->setError($exec, $option[1]);
				}
				break;

			case "minmax":
				if ($this->value < $option[0] || $this->value > $option[1]) {
					if (empty($option[2])) $option[2] = "";
					$this->setError($exec, $option[2]);
				}
				break;

			//
			case "lenmax":
				if (mb_strlen($this->value) > $option[0]) {
					if (empty($option[1])) $option[1] = "";
					$this->setError($exec, $option[1]);
				}
				break;

			case "lenmin":
				if (mb_strlen($this->value) < $option[0]) {
					if (empty($option[1])) $option[1] = "";
					$this->setError($exec, $option[1]);
				}
				break;

			case "length":
				if (mb_strlen($this->value) < $option[0] || mb_strlen($this->value) > $option[1]) {
					if (empty($option[2])) $option[2] = "";
					$this->setError($exec, $option[2]);
				}
				break;

			//
			case "alpha":
				if (! preg_match('#\A[a-zA-Z]+\z#', $this->value)) {
					if (empty($option[0])) $option[0] = "";
					$this->setError($exec, $option[0]);
				}
				break;

			case "digit":
				if (! is_numeric($this->value)) {
					if (empty($option[0])) $option[0] = "";
					$this->setError($exec, $option[0]);
				}
				break;

			case "alphanumeric":
				if (! preg_match('#\A[a-zA-Z0-9]+\z#', $this->value)) {
					if (empty($option[0])) $option[0] = "";
					$this->setError($exec, $option[0]);
				}
				break;

			//
			case "equal":
				if ($this->value !== $option[0]) {
					if (empty($option[1])) $option[1] = "";
					$this->setError($exec, $option[1]);
				}
				break;

			//
			case "password":
				if (! preg_match('#\A[a-zA-Z0-9\@\%\+\$\\\/\!\#\^\~\:\.\?\-\_]+\z#', $this->value)) {
					if (empty($option[0])) $option[0] = "";
					$this->setError($exec, $option[0]);
				}
				break;

			case "email":
				if (! filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
					if (empty($option[0])) $option[0] = "";
					$this->setError($exec, $option[0]);
				}
				break;

			case "url":
				if (! preg_match('#\Ahttps?://[\w\:\%\#\$\&\?\(\)\~\.\=\+\-\/\S]+\z#', $this->value)) {
					if (empty($option[0])) $option[0] = "";
					$this->setError($exec, $option[0]);
				}
				break;

			//	Mode AI.	
			case "preg":
				if (! preg_match($option[0], $this->value)) {
					if (empty($option[1])) $option[1] = "";
					$this->setError($exec, $option[1]);
				}
				break;

			case "date":
				if (! preg_match('/^\d{4}-\d{2}-\d{2}$/', $this->value)) {
					if (empty($option[0])) $option[0] = "";
					$this->setError($exec, $option[0]);
				}
				break; // (YYYY-MM-DD 形式)

			case "post":
				if (! preg_match('/^\d{3}-\d{4}$/', $this->value)) {
					if (empty($option[0])) $option[0] = "";
					$this->setError($exec, $option[0]);
				}
				break;

			case "phone":
				if (! preg_match('/^0\d{1,4}-\d{1,4}-\d{4}$/', $this->value)) {
					if (empty($option[0])) $option[0] = "";
					$this->setError($exec, $option[0]);
				}
				break;

			case "card":
				if (! preg_match('/^\d{13,16}$/', $this->value)) {
					if (empty($option[0])) $option[0] = "";
					$this->setError($exec, $option[0]);
				}
				break;


			//
			default:
				$this->setError($exec, "Can't error.");
				break;
		}

		return $this;
	}

	public function delete($exec)
	{
		switch ($exec) {
			case "trim":
				$this->value = preg_replace('#\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z#u', '', $this->value);
				break;

			case "":
				break;
		}

		return $this;
	}

	public function type($exec)
	{
		switch ($exec) {
			case "int":
				$this->value = (int)$this->value;
				break;

			case "float":
				$this->value = (float)$this->value;
				break;

			case "string":
				$this->value = (string)$this->value;
				break;

			case "":
				break;
		}

		return $this;
	}

	public function filter($exec)
	{
		switch ($exec) {
			//
			case "toBr":
				$this->value = preg_replace('/\r\n|\r|\n/', '<br />', $this->value);
				// $this->value = nl2br($this->value);
				break;

			case "htmlEscape":
				$this->value = htmlentities($this->value, ENT_QUOTES);
				break;

			case "deleteTag":
				$this->value = strip_tags($this->value);
				break;

			case "deleteRn":
				$this->value = preg_replace('#[\r\n]+?#u', '', $this->value);
				break;

			case "":
				break;
		}

		return $this;
	}

	public function make($exec)
	{
		switch ($exec) {
			//
			case "time":
				$this->value = time();
				break;

			case "dateNow":
				$this->value = date('Y年m月d日 H時i分s秒', time());
				break;

			case "":
				break;
		}

		return $this;
	}
}
