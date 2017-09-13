<?php
class DB_Connect{
	function __construct(){
		$this->connect();
	}
	function connect(){
		include_once 'db_config.php';
		$conn=new mysqli(server,user,passwords,database);
		return $conn;
	}
	function close(){
		$conn->close();
	}
}
?>