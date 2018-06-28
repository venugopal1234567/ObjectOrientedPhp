<?php
 
   /**
    * 
    */
   class Database
   {
   	private $host = 'localhost';
   	private $pass = 'mysql';
   	private $usr = 'root';
   	private $dbname = 'myblog';

   	private $dbh;
   	private $err;
   	private $stmt;

   	public function __construct(){
   		$dns = 'mysql:host='.$this->host.';dbname='.$this->dbname;
   		//set options
   		$options = array(

            PDO::ATTR_PERSISTENT  => true,
            PDO::ATTR_ERRMODE   => PDO::ERRMODE_EXCEPTION
   		);

   		try {
   			$this->dbh = new PDO($dns , $this->usr,$this->pass, $options);
   			
   		} catch (PDOEception $e) {
   			$this->error = $e->getMessage();
   			
   		}
   	}

      public function query($query){
         $this->smt = $this->dbh->prepare($query);
      }
       public function bind($parm, $value, $type = null)
      {
         # code...
         if(is_null($true)){
            switch (true) {
               case is_int($value):
                  # code...
                  $type = PDO::PARAM_INT;
                  break;
               case is_null($value):
                  $type = PDO::PARAM_NULL;
                  break;
               default:
                   $type = PDO::PARAM_STR;
            }

      }
      $this->smt->bindValue($parm, $value, $type);
         }
   public function execute(){
      return $this->smt->execute();
   }
   public function lastInsertId(){
     return $this->dbh->lastInsertId();
   }
   public function result(){
      $this->execute();
      return $this->smt->fetchAll(PDO::FETCH_ASSOC);
   }
}

?>