<?php

class Login_Model_Roles
{
	protected $_id;
	protected $_role;
	protected $_idparent;

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
		$this->_id = (int) $id;
		return $this;
	}

	public function getId()
	{
		return $this->_id;
	}

	public function setRole($role)
	{
		$this->_role = (string) $role;
		return $this;
	}

	public function getRole()
	{
		return $this->_role;
	}

	public function setIdparent($idparent)
	{
		$this->_idparent = (int) $idparent;
		return $this;
	}

	public function getIdparent()
	{
		return $this->_idparent;
	}

}