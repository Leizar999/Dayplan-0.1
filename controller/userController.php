<?php 
	class UserController {
		private $user;

		public function __construct($user){
			$this->user = $user;
		}

		public function readLogin($login, $pass){
			$this->user->setLogin($login);
			$this->user->setPass($pass);
		}

		public function readComplete($login, $pass, $name, $surname, $department, $role, $email){
			$this->user->setLogin($login);
			$this->user->setPass($pass);
			$this->user->setName($name);
			$this->user->setSurname($surname);
			$this->user->setDepartment($department);
			$this->user->setRole($role);
			$this->user->setEmail($email);
		}
	}
?>