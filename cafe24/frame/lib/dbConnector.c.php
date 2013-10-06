<?php
class dbConnector extends PDO
{	
	function getStatement( $sql )
	{
		return $this->prepare($sql) ;
	}
	
	function getList( $sql , $executeArr = array() )
	{
		$stm = $this->getStatement($sql) ;
		
		$stm->execute($executeArr);
		return $stm->fetchAll();		
	}
	
	function exec_($q)
	{
		$startTime = microtime(true) ;
		$stmt = db()->prepare($q);
		stmtExecute($stmt);
	}
	
	// http://www.php.net/manual/en/pdo.begintransaction.php#109753
    protected $transactionCounter = 0; 
    function beginTransaction() 
    { 
        if(!$this->transactionCounter++) 
            return parent::beginTransaction(); 
       return $this->transactionCounter >= 0; 
    } 

    function commit() 
    { 
       if(!--$this->transactionCounter) 
           return parent::commit(); 
       return $this->transactionCounter >= 0; 
    } 

    function rollback() 
    { 
        if($this->transactionCounter >= 0) 
        { 
            $this->transactionCounter = 0; 
            return parent::rollback(); 
        } 
        $this->transactionCounter = 0; 
        return false; 
    } 
	
}

function db()
{
	global $_DB_CONNECTOR ;
	return $_DB_CONNECTOR ;
}

function stmtExecute( &$stmt , $aParam = array() )
{
	if( count($aParam) >= 1 )
		$stmt->execute($aParam) ;
	else
		$stmt->execute() ;
	
	if( $stmt->errorCode() != '00000' )
	{
		console::$logCnt = 3;
		console::error( print_r( $stmt->errorInfo() , true ) );
		die('DB ERROR!') ;
		$stmt->debugDumpParams ();
	}
}
