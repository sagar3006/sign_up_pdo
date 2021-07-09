<?php
// Database class for connecting to database using mysql driver and PDO
class Database {
	private $server_name;
	private $dbname;
	private $username;
	private $password;

	function connect() {
		$this->server_name 	= "localhost";
		$this->dbname 		= "sign_up_pdo";
		$this->username 	= "root";
		$this->password 	= "";

		try {
        	$db = new PDO('mysql:host='.$this->server_name.';dbname='.$this->dbname.'', $this->username, $this->password);
        	return $db;
	    } catch (PDOException $e) {
	        return "Connection Failed: " . $e->getMessage();
	        die();
	    }
	}
}
?>