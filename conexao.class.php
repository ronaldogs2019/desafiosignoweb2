<?php

class Database {
	private static $conn;	

	public static function init(){
		$username = "root";
		$password = "";

		try {
			self::$conn = new PDO('mysql:host=localhost;dbname=signo_web', $username, $password);
		}catch(PDOException $e){
			echo $e->getCode().'::'.$e->getMessage();
		}
		return self::$conn;
	}
}
?>