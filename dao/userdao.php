<?php
	class UserDAO {
		private $user;

		public function __construct($user){
			$this->user = $user;
		}

		public static function getUser($login){
			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();
			$sql = "SELECT * FROM users WHERE login = '$login';";
			$result = $bbdd->consult($sql);
			$user = new User();

			if($bbdd->numRows($result) > 0){
				$row = $bbdd->fetch($result);
				$user->setLogin($row["login"]);
				$user->setName($row["name"]);
				$user->setSurname($row["surname"]);
				$user->setDepartment($row["department"]);
				$user->setRole($row["role"]);
				$user->setEmail($row["email"]);
			}

			return $user;
		}

		public static function getUsers($role, $department){
			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();

			if($role == "admin"){
				$sql = "SELECT * FROM users;";
			} else {
				$sql = "SELECT * FROM users WHERE department = '$department';";
			}

			$result = $bbdd->consult($sql);
			$user = new User();

			return $result;
		}

		public static function countUsers($role, $department){
			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();

			if($role == "admin"){
				$sql = "SELECT COUNT(*) AS users FROM users;";
			} else {
				$sql = "SELECT COUNT(*) AS users FROM users WHERE department = '$department';";
			}

			$result = $bbdd->consult($sql);
			$user = new User();

			return $result;
		}

		public function checkLogin(){
			$valid = false;
			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();
			$sql = "SELECT * FROM users WHERE BINARY login = '" . $this->user->getLogin() . "' AND BINARY pass = '" . sha1($this->user->getPass()) . "';";
			$result = $bbdd->consult($sql);

			if($bbdd->numRows($result) > 0){
				$valid = true;
			}

			return $valid;
		}

		public function insertUser(){
			$valid = false;
			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();
			$sql = "INSERT INTO users (login, pass, name, surname, department, role, email) VALUES ('" . $this->user->getLogin() . "', '" . sha1($this->user->getPass()) . "', '" . $this->user->getName() . "', '" . $this->user->getSurname() . "', '" . $this->user->getDepartment() . "', '" . $this->user->getRole() . "', '" . $this->user->getEmail() . "')";

			$result = $bbdd->consult($sql);

			if($sql){
				$valid = true;
			}

			return $valid;
		}

		public function deleteUser($login){
			$valid = false;
			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();
			$sql = "DELETE FROM users WHERE login = '$login'";

			$result = $bbdd->consult($sql);

			if($sql){
				$valid = true;
			}

			return $valid;
		}

		public function updateUser($login, $pass, $name, $surname, $department, $role, $email){
			$valid = false;
			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();
			$sql = "UPDATE users SET pass = '" . sha1($pass) . "', name = '$name', surname = '$surname', department = '$department', role = '$role', email = '$email' WHERE login = '$login';";

			$result = $bbdd->consult($sql);

			if($sql){
				$valid = true;
			}

			return $valid;
		}

		public function checkDuplicates($login, $email){
			$valids = array(false, false);

			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();
			$sql = "SELECT login FROM users WHERE login = '$login'";
			$sql2 = "SELECT email FROM users WHERE email = '$email'";
			
			$result = $bbdd->consult($sql);
			$result2 = $bbdd->consult($sql2);

			if($bbdd->numRows($result) > 0){
				$valids[0] = true;
			} elseif($bbdd->numRows($result2) > 0){
				$valids[1] = true;
			}

			return $valids;
		}
	}
?>