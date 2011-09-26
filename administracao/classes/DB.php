<?php
class DB {
	private static $instance = null;
	private $dbHost          = "186.202.13.20";
	private $dbDatabase      = "ifbaiano28";
	private $dbUser          = "ifbaiano28";
	private $dbPassword      = "teste123";

	public static function getInstance(){
		if (DB::$instance == null) {
			DB::$instance = new DB();
		}
		return DB::$instance;
	}

	private function DB(){
	}

	public function getdbHost(){
		return $this->dbHost;
	}

	public function setdbHost($newdbHost){
		$this->dbHost = $newdbHost;
	}

	public function getdbDatabase(){
		return $this->dbDatabase;
	}

	public function setdbDatabase($newdbDatabase){
		$this->dbDatabase = $newdbDatabase;
	}

	public function getdbUser(){
		return $this->dbUser;
	}

    public function setdbUser($newdbUser){

        $this->dbUser = $newdbUser;
    }

    public function getdbPassword(){

        return $this->dbPassword;
    }

    public function setdbPassword($newdbPassword){

        $this->dbPassword = $newdbPassword;
    }

    public function getdbConnection(){

        return $this->dbConnection;
    }

    public function setdbConnection($newdbConnection){

        $this->dbConnection = $newdbConnection;
    }

	public function ConectarDB() {
		if ($sock = mysql_connect($this->getdbHost(), $this->getdbUser(), $this->getdbPassword())) {
			if (mysql_select_db($this->getdbDatabase(), $sock)){
				$this->setdbConnection($sock);
				return($sock);
			} else {
				echo("ERRO : mysql_select_db = ".mysql_error()."<BR>\n");
			}
		}
	}

	public function DesconectarDB($sock){
		if (! mysql_close($sock)) {
			die("ERRO : mysql_close = ".mysql_error()."<BR>\n");
		} else {
			$valor = "true";
			return($valor);
		}
	}

	public function ExecutaQueryGenerica($sql) {
		$result = mysql_query($sql);
		return $result;
	}

	public function startTransaction() {
		mysql_query('SET AUTOCOMMIT=0');
		mysql_query('START TRANSACTION');
	}

	public function commitTransaction() {
		mysql_query('COMMIT');
	}

	public function rollbackTransaction() {
		mysql_query('ROLLBACK');
	}
}
