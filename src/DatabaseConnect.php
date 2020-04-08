<?php
include '../config/database.php';

class DatabaseConnect
{
	public $con = null;

	private $hostname = null;
	private $username = null;
	private $password = null;

	private $database =  null;

	public $env = null;



	function __construct()
	{
		$this->env = $this->getEnv();

		if($this->env == "local"){
			$this->hostname = LOCAL_HOSTNAME;
			$this->username = LOCAL_USERNAME;
			$this->password = LOCAL_PASSWORD;
			$this->database = LOCAL_DATABASE;

		}

		if($this->env == "production"){
			$this->hostname = PRO_HOSTNAME;
			$this->username = PRO_USERNAME;
			$this->password = PRO_PASSWORD;
			$this->database = PRO_DATABASE;
		}



		if(!$this->con){
			$this->databaseConnect();
		}



	}


	private function databaseConnect()
	{
		try {
			$this->con = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);			
			$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			echo "Connected";
		} catch (Exception $e) {
			echo "connection failed ".$e->getMessage();
		}
	}


	public function getEnv()
	{
		return $_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_ADDR'] == "127.0.0.1" ? "local" : "production";
		
	}
}


$db = new DatabaseConnect();

$con = $db->con;


