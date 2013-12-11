<?php

class Login_Model_Sessionsoap
{
	protected $_id;
	protected $_idsession;
	protected $_user;
	protected $_pass;

	public function __construct(array $options = null)
	{
		if (is_array($options)) {
				$this->setOptions($options);
		}
	}

	public function __set($name, $value)
	{
		$method = 'set' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid Users property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid Users property');
		}
		return $this->$method();
	}

	public function setOptions(array $options)
	{
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
		return $this;
	}

	public function setId($id)
	{
		$this->_id = (string) $id;
		return $this;
	}

	public function getId()
	{
		return $this->_id;
	}

	public function setIdsession($idsession)
	{
		$this->_idsession = (string) $idsession;
		return $this;
	}

	public function getIdsession()
	{
		return $this->_idsession;
	}

	public function setUser($user)
	{
		$this->_user = (string) $user;
		return $this;
	}

	public function getUser()
	{
		return $this->_user;
	}

	public function setPass($pass)
	{
		$this->_pass = (string) $pass;
		return $this;
	}

	public function getPass()
	{
		return $this->_pass;
	}
}

