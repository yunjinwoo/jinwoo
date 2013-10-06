<?php
class dbConnector extends mysqli
{
	static private $db = null ;
	
	function __construct() {
		self::$db = new mysqli('mysql:host='._DB_HOST_.';dbname='._DB_NAME_, _DB_USER_, _DB_PASS_);
	}
	
	static function getStatement( $sql )
	{
		return $this->prepare($sql) ;
	}
	
	static function getList( $sql , $executeArr = array() )
	{
		$stm = self::getStatement($sql) ;
		
		$stm->execute($$executeArr);
		return $stm->fetchAll();		
	}
}

$dbConnector = new dbConnector ;
