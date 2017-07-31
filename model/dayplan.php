<?php
    class Dayplan {
        private $login;
        private $texteditor;
        private $dateplan;

        //DEFAULT CONSTRUCTOR
        public function __construct(){
            $this->login = "";
            $this->texteditor = "";
            $this->dateplan = "";
        }

        //SETTERS
        public function setLogin($login){
            $this->login = $login;
        }
        public function setText($texteditor){
            $this->texteditor = $texteditor;
        }
        public function setDate($dateplan){
            $this->dateplan = $dateplan;
        }

        //GETTERS
        public function getLogin(){
            return $this->login;
        }
        public function getText(){
            return $this->texteditor;
        }
        public function getDate(){
            return $this->dateplan;
        }
    }
?>