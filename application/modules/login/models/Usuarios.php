<?php

class Login_Model_Usuarios
{
	protected $_id;
	protected $_name;
	protected $_username;
	protected $_email;
	protected $_password;
	protected $_usertype;
	protected $_block;
	protected $_sendEmail;
	protected $_gid;
	protected $_registerDate;
	protected $_lastvisitDate;
	protected $_activation;
	protected $_params;
	
	
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
    
	public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }
    
	public function setUsername($username)
    {
        $this->_username = (string) $username;
        return $this;
    }

    public function getUsername()
    {
        return $this->_username;
    }
    
	public function setEmail($email)
    {
        $this->_email = (string) $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->_email;
    }
			    
	public function setPassword($password)
	{
		$this->_password = (string) $password;
        return $this;
	}
	
	public function getPassword()
	{
		return $this->_password;
	}
	
	public function setUsertype($usertype)
	{
		$this->_usertype = (string) $usertype;
        return $this;
	}
	
	public function getUsertype()
	{
		return $this->_usertype;
	}
	
	public function setBlock($block)
	{
		$this->_block = (int) $block;
        return $this;
	}
	
	public function getBlock()
	{
		return $this->_block;
	}
	
	public function setSendmail($sendEmail)
	{
		$this->_sendEmail = (int) $sendEmail;
        return $this;
	}
	
	public function getSendmail()
	{
		return $this->_sendEmail;		
	}
	
	public function setGid($gid)
	{
		$this->_gid = (int) $gid;
        return $this;
	}
	
	public function getGid()
	{
		return $this->_gid;
	}
	
	public function setRegisterdate($registerDate)
	{
		$this->_registerDate = (string) $registerDate;
        return $this;
	}
	
	public function getRegisterdate()
	{
		return $this->_registerDate;
	}
	
	public function setLastvisitdate($lastvisitDate)
	{
		$this->_lastvisitDate = (string) $lastvisitDate;
        return $this;
	}
	
	public function getLastvisitdate()
	{
		return $this->_lastvisitDate;
	}
	
	public function setActivation($activation)
	{
		$this->_activation = (string) $activation;
        return $this;
	}
	
	public function getActivation()
	{
		return $this->_activation;
	}
	
	public function setParams($params)
	{
		$this->_params = (string) $params;
        return $this;
	}
	
	public function getParams()
	{
		return $this->_params;
	}

}
