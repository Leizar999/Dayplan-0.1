<?php
	class DayplanDAO {
		private $dayplan;

		public function __construct($dayplan){
			$this->dayplan = $dayplan;
		}

		public static function getDayplan($login, $role, $department){
			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();


			if($role == "admin"){
				$sql = "SELECT * FROM dayplan WHERE login = '$login';";
			} else {
				$sql = "SELECT * FROM dayplan WHERE login = '$login' AND department = '$department';";
			}
			
			$result = $bbdd->consult($sql);

			return $result;
		}

		public static function getDayplans($role, $department){
			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();

			$sql = "SELECT * FROM dayplan WHERE department = '$department' ORDER BY dateplan;";

			$result = $bbdd->consult($sql);
			$dayplan = new Dayplan();

			return $result;
		}

		public static function getDayplansToday($role, $department){
			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();

			$date1 = date("d/m/Y 00:00:00");
			$date2 = date("d/m/Y 23:59:59");

			$sql = "SELECT * FROM dayplan WHERE department = '$department' AND dateplan > '$date1' AND dateplan < '$date2';";

			$result = $bbdd->consult($sql);

			return $result;
		}

		public static function getUserToday($user){
			$exist = array();

			$exist[0] = false;

			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();

			$date1 = date("d/m/Y 00:00:00");
			$date2 = date("d/m/Y 23:59:59");

			$sql = "SELECT * FROM dayplan WHERE login = '$user' AND dateplan > '$date1' AND dateplan < '$date2';";
			$result = $bbdd->consult($sql);
			$result2 = $bbdd->consult($sql);
			$dayplan = new Dayplan();

			$exist[1] = $result2;

			if($row = mysqli_fetch_array($result) > 0){
				$exist[0] = true;
			}

			return $exist;
		}

		public static function getUserLast($user){
			$exist = array();

			$exist[0] = false;

			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();

			$sql = "SELECT * FROM dayplans WHERE login = '$user' ORDER BY id DESC LIMIT 1;";
			$result = $bbdd->consult($sql);
			$result2 = $bbdd->consult($sql);
			$dayplan = new Dayplan();

			$exist[1] = $result2;

			if($row = mysqli_fetch_array($result) > 0){
				$exist[0] = true;
			}

			return $exist;
		}

		public static function totalDayplans($role, $department){
			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();

			if($role == "admin"){
				$sql = "SELECT COUNT(*) AS dayplans FROM dayplan;";
			} else {
				$sql = "SELECT COUNT(*) AS dayplans FROM dayplan WHERE department = '$department';";
			}

			$result = $bbdd->consult($sql);

			return $result;
		}


		public static function countDayplans($role, $department){
			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();

			$date1 = date("d/m/Y 00:00:00");
			$date2 = date("d/m/Y 23:59:59");

			if($role == "admin"){
				$sql = "SELECT COUNT(*) AS dayplans FROM dayplan WHERE dateplan > '$date1' AND dateplan < '$date2';";
			} else {
				$sql = "SELECT COUNT(*) AS dayplans FROM dayplan WHERE department = '$department' AND dateplan > '$date1' AND dateplan < '$date2';";
			}

			$result = $bbdd->consult($sql);

			return $result;
		}

		public static function notSentDayplans($role, $department){
			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();

			$date1 = date("d/m/Y 00:00:00");
			$date2 = date("d/m/Y 23:59:59");

			if($role == "admin"){
				$sql = "SELECT DISTINCT * FROM users WHERE login NOT IN (SELECT DISTINCT login FROM dayplan WHERE dateplan > '$date1' AND dateplan < '$date2');";
			} else {
				$sql = "SELECT DISTINCT * FROM users WHERE login NOT IN (SELECT DISTINCT login FROM dayplan WHERE dateplan > '$date1' AND dateplan < '$date2') AND department = '$department';";
			}

			$result = $bbdd->consult($sql);

			return $result;
		}

		public function insertDayplan(){
			$valid = false;
			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();
			$sql = "INSERT INTO dayplans (login, texteditor, dateplan) VALUES ('" . $this->dayplan->getLogin() . "', '" . $this->dayplan->getText() . "', '" . $this->dayplan->getDate() . "')";

			$result = $bbdd->consult($sql);

			if($sql){
				$valid = true;
			}

			return $valid;
		}

		public function insertComment($id, $comment){
			$valid = false;
			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();
			$sql = "UPDATE dayplans SET comments = '$comment' WHERE id = '$id';";
			$result = $bbdd->consult($sql);

			if($sql){
				$valid = true;
			}

			return $valid;
		}

		public function deleteDayplan($login){
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

		public function updateDayplan($login, $text){
			$valid = false;
			$bbdd = DB::getInstance();
			$bbdd->stablishUTF8();
			$sql = "SELECT id FROM dayplans WHERE login = '$login' ORDER BY id DESC LIMIT 1;";

			$first = $bbdd->consult($sql);
			$second = $bbdd->fetch($first);
			$id = $second["id"];

			$sql2 = "UPDATE dayplans SET texteditor = '$text', dateplan = '" . $this->dayplan->getDate() . "' WHERE id = '$id';";

			$result = $bbdd->consult($sql2);

			if($sql2){
				$valid = true;
			}

			return $valid;
		}
	}
?>