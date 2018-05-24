<?php
    //ABSTRACT CLASS MODEL FOR MANIPULATING WITH DATA.
abstract class Model{
	protected $dbCon;			//A VRAIABLE FOR DB CONNECTION HANDLING
	protected $stmt;		//A VARIABLE USED FOR PREPARING STATEMENTS

	//CREATING DB CONNECTION BY USING A CONSTRACTOR, THE CI\ONNECTION WILL WORK ONE AN OBJECT OF THIS CLASS IS CREATED
	public function __construct(){
		try {
				$this->dbCon = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
			}
			catch(PDOEception $e){
				$this->error = $e->getMessage();
			}
	}
	//FUNCTION FOR PREPARING QUERY
	public function query($query){
		$this->stmt = $this->dbCon->prepare($query);
	}

	//CHECKS DATATYPE OF PARAMETERS,AND BINDS THEIR VALUES TO PREPARED QUERY.
	public function bind($param, $value, $type = null){
 		if (is_null($type)) {
  			switch (true) {
    			case is_int($value):
      				$type = PDO::PARAM_INT;
      				break;
    			case is_bool($value):
      				$type = PDO::PARAM_BOOL;
      				break;
    			case is_null($value):
      				$type = PDO::PARAM_NULL;
      				break;
    				default:
      				$type = PDO::PARAM_STR;
  			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}
	//FUNCTION FOR EXECUTING PREPARED STATEMENT
	public function execute(){
		$this->stmt->execute();
	}
	//FUNCTION FOR FETCHING DATABASE RECORDS
	public function resultSet(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	//FUNCTION WHICH RETURNS ID OF LAST INSERTED ROW IN DATABASE.
	public function lastInsertId(){
		return $this->dbCon->lastInsertId();
	}
	//FUNCTION FOR FETCHING SINGLE DATABASE ROW
	public function single(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}
    }

