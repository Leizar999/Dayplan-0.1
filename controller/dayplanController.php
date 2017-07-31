<?php 
	class DayplanController {
		private $dayplan;

		public function __construct($dayplan){
			$this->dayplan = $dayplan;
		}

		public function readComplete($login, $texteditor, $dateplan){
			$this->dayplan->setLogin($login);
			$this->dayplan->setText($texteditor);
			$this->dayplan->setDate($dateplan);
		}
	}
?>