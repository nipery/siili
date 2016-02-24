<?php
	class User  {
  		
		public $id;
	   	public $username;
	   	public $email;
	   	public $password;
	   	public $status;

	   	public function __construct($username,$email,$pass,$status){
	   		$this->username =$username;
	   		$this->email = $email;
	   		$this->password = $pass;
	   		$this->status = $status;
	   	}
	}

?>