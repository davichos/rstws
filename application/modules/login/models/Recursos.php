<?php

class Login_Model_Recursos
{
	protected $_id;
	protected $_idparent;
	protected $_idtype;
	protected $_nombre;
	protected $_resource;
	protected $_descripcion;

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

	public function setIdparent($idparent)
	{
		$this->_idparent = (int) $idparent;
		return $this;
	}

	public function getIdparent()
	{
		return $this->_idparent;
	}

	public function setIdtype($idtype)
	{
		$this->_idtype = (int) $idtype;
		return $this;
	}

	public function getIdtype()
	{
		return $this->_idtype;
	}

	public function setNombre($nombre)
	{
		$this->_nombre = (string) $nombre;
		return $this;
	}

	public function getNombre()
	{
		return $this->_nombre;
	}

	public function setResource($resource)
	{
		$this->_resource = (string) $resource;
		return $this;
	}

	public function getResource()
	{
		return $this->_resource;
	}

	public function setDescripcion($descripcion)
	{
		$this->_descripcion = (string) $descripcion;
		return $this;
	}

	public function getDescripcion()
	{
		return $this->_descripcion;
	}

}

