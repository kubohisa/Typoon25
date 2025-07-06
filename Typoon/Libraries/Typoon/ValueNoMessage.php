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
		$this->error["error"][$exec] = false;
	}

	private function setError($exec)
	{
		$this->error["SYSTEM"]["error"] = true;
		$this->error["error"][$exec] = true;
	}

	private function setErrorNot($exec)
	{
		$this->error["SYSTEM"]["error"] = true;
		$this->error["nothing"][$exec] = true;
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
					$this->setError($exec);
				}
				break;

			case "max":
				if ($this->value > $option[0]) {
					$this->setError($exec);
				}
				break;

			case "minmax":
				if ($this->value < $option[0] || $this->value > $option[1]) {
					$this->setError($exec);
				}
				break;

			//
			case "lenmax":
				if (mb_strlen($this->value) > $option[0]) {
					$this->setError($exec);
				}
				break;

			case "lenmin":
				if (mb_strlen($this->value) < $option[0]) {
					$this->setError($exec);
				}
				break;

			case "length":
				if (mb_strlen($this->value) < $option[0] || mb_strlen($this->value) > $option[1]) {
					$this->setError($exec);
				}
				break;

			//
			case "alpha":
				if (! preg_match('#\A[a-zA-Z]+\z#', $this->value)) {
					$this->setError($exec);
				}
				break;

			case "digit":
				if (! is_numeric($this->value)) {
					$this->setError($exec);
				}
				break;

			case "alphanumeric":
				if (! preg_match('#\A[a-zA-Z0-9]+\z#', $this->value)) {
					$this->setError($exec);
				}
				break;

			//
			case "equal":
				if ($this->value !== $option[0]) {
					$this->setError($exec);
				}
				break;

			//
			case "password":
				if (! preg_match('#\A[a-zA-Z0-9\@\%\+\$\\\/\!\#\^\~\:\.\?\-\_]+\z#', $this->value)) {
					$this->setError($exec);
				}
				break;

			case "email":
				if (! filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
					$this->setError($exec);
				}
				break;

			case "url":
				if (! preg_match('#\Ahttps?://[\w\:\%\#\$\&\?\(\)\~\.\=\+\-\/\S]+\z#', $this->value)) {
					$this->setError($exec);
				}
				break;

			//	Mode AI.	
			case "preg":
				if (! preg_match($option[0], $this->value)) {
					$this->setError($exec, $option[1]);
				}
				break;

			case "date":
				if (! preg_match('/^\d{4}-\d{2}-\d{2}$/', $this->value)) {
					$this->setError($exec);
				}
				break; // (YYYY-MM-DD 形式)

			case "post":
				if (! preg_match('/^\d{3}-\d{4}$/', $this->value)) {
					$this->setError($exec);
				}
				break;

			case "phone":
				if (! preg_match('/^0\d{1,4}-\d{1,4}-\d{4}$/', $this->value)) {
					$this->setError($exec);
				}
				break;

			case "card":
				if (! preg_match('/^\d{13,16}$/', $this->value)) {
					$this->setError($exec);
				}
				break;

			//
			default:
				$this->setErrorNot($exec);
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

			case "trimText":
				$this->value = preg_replace('#^(?:[\p{C}\p{Z}]*\R)+|(?:\R[\p{C}\p{Z}]*$)+#mu', '', $this->value); // Copilit.
				break;

			case "htmlTag":
				$this->value = strip_tags($this->value);
				break;

			case "rn":
				$this->value = preg_replace('#[\r\n]+?#u', '', $this->value);
				break;

			case "":
				break;

			//
			default:
				$this->setErrorNot($exec);
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

			//
			default:
				$this->setErrorNot($exec);
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

			case "lenPost":
				if (strlen($this->value) > 1000) {
					if (empty($option[1])) $option[1] = "";
					$this->setError($exec, $option[1]);

					$this->value = "";
				}
				break; // セキュリティの為のPOSTのデータ長チェック（仮組み）

			case "":
				break;

			//
			default:
				$this->setErrorNot($exec);
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
				$this->value = "";
				break;

			//
			default:
				$this->setErrorNot($exec);
				break;
		}

		return $this->value;
	}
}
