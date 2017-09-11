<?php
	
	class DB {

		private $host;
		private $user;
		private $pass;
		private $bbdd;
		private $conection;
		private static $instance;

		private function __construct(){
			$this->host = "localhost";
			$this->user = "manager";
			$this->pass = "coffeetime";
			$this->bbdd = "dayplan";
			$this->conection = new mysqli($this->host, $this->user, $this->pass, $this->bbdd) or die("Problemas en la conection: " . mysqli_error($this->conection));
			self::$instance = null;
		}

		public static function getInstance(){
			if(is_null(self::$instance)){
				self::$instance = new self;
			}
			return self::$instance;
		}

		public function getConection(){
			return $this->conection;
		}

		public function stablishUTF8(){
			$this->conection->set_charset("utf8") or die("Problemas al cambiar el conjunto de caracteres a UTF-8: " . mysqli_error($this->conection));
		}

		public function consult($query){
			$resultado = $this->conection->query($query) or die("Error en la consulta SQL: " . mysqli_error($this->conection));
			return $resultado;
		}

		public function numRows($result){
			$cuantas = mysqli_num_rows($result);
			return $cuantas;
		}

		public function fetch($result){
			return $result->fetch_assoc();
		}

		public function closeConection(){
			$this->conection->close() or die("Error al cerrar la conexión: " . mysqli_error($this->conection));
			self::$instance = null;
		}

		public function updateError(){
			die('No se pudieron actualizar los datos: ' . mysqli_error($this->conection));
		}

		/**
		Escapa los caracteres especiales de una cadena para usarla en una sentencia SQL, 
		tomando en cuenta el conjunto de caracteres actual de la conexión. Evita inyecciones
		maliciosas de código.

		Para que funcione se debe establecer previamente el conjunto de caracteres a usar.
		*/
		public function clean($text_to_clean){
			return $this->conection->real_escape_string($text_to_clean);
		}

	}

?>