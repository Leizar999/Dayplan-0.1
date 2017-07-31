<?php
    class User {
        private $login;
        private $pass;
        private $name;
        private $surname;
        private $department;
        private $role;
        private $email;

        //DEFAULT CONSTRUCTOR
        public function __construct(){
            $this->login = "";
            $this->pass = "";
            $this->name = "";
            $this->surname = "";
            $this->department = "";
            $this->role = "";
            $this->email = "";
        }
        //SETTERS
        public function setLogin($login){
            $this->login = $login;
        }
        public function setPass($pass){
            $this->pass = $pass;
        }
        public function setName($name){
            $this->name = $name;
        }
        public function setSurname($surname){
            $this->surname = $surname;
        }
        public function setDepartment($department){
            $this->department = $department;
        }
        public function setRole($role){
            $this->role = $role;
        }
        public function setEmail($email){
            $this->email = $email;
        }

        //GETTERS
        public function getLogin(){
            return $this->login;
        }
        public function getPass(){
            return $this->pass;
        }
        public function getName(){
            return $this->name;
        }
        public function getSurname(){
            return $this->surname;
        }
        public function getDepartment(){
            return $this->department;
        }
        public function getRole(){
            return $this->role;
        }
        public function getEmail(){
            return $this->email;
        }
    }
?>