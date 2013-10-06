<?php

/**
 * 코드로 저장된 데이타 가져오기 <br />
 * DB : my_vatech_code 테이블 이용<br />
 * 싱글톤 방법
 *
 * @author 윤진우
 */
class Code {
	static $codeGroup = array() ;
	
	/**
	 * code_name 리스트 가져오기
	 * 
	 * @return array code_key => row
	 */
	static function getCodeNameList()
	{
		
	}
	
	/**
	 * code_name 으로 저장된 데이타 가져오기
	 * 
	 * @param string code_name 값
	 * @return array code_key => row
	 */
	static function getCode($code)
	{
		if( isset(self::$codeGroup[$code]) ) return self::$codeGroup[$code];
		
		$q = '
			SELECT * FROM '._db_vatech_code_.'
			WHERE code_name = :code_name 
			ORDER BY code_sort ' ;
		$stmt = db()->prepare($q);
		$stmt->bindValue(':code_name', $code);
		
		stmtExecute($stmt);
		$a = array();
		while($r = $stmt->fetch(pdo::FETCH_ASSOC))
			$a[$r['code_key']] = $r ;
		
		self::$codeGroup[$code] = $a ;		
		return self::$codeGroup[$code] ;
	}
	
	/**
	 * code_name 으로 저장된 데이타 가져오기
	 * 
	 * @param string code_name 값
	 * @return array code_key => row
	 */
	static function getCodeKV($code,$field="code_value")
	{
		if( isset(self::$codeGroup[$code.'_kv']) ) return self::$codeGroup[$code.'_kv'];
		
		$q = '
			SELECT code_key,'.$field.' FROM '._db_vatech_code_.'
			WHERE code_name = :code_name 
			ORDER BY code_sort ' ;
		$stmt = db()->prepare($q);
		$stmt->bindValue(':code_name', $code);
		
		stmtExecute($stmt);
		$a = array();
		while($r = $stmt->fetch(pdo::FETCH_ASSOC))
			$a[$r['code_key']] = $r[$field] ;
		
		self::$codeGroup[$code.'_kv'] = $a ;		
		return self::$codeGroup[$code.'_kv'] ;
	}
	
	/**
	 * code_name 으로 저장된 데이타 가져오기
	 * 
	 * @param string code_name 값
	 * @return string code_value
	 */
	static function getCodeStr($code,$field="code_value")
	{
		if( isset(self::$codeGroup[$code.'_'.$field]) ) return self::$codeGroup[$code.'_'.$field];
		
		$q = '
			SELECT code_key,'.$field.' FROM '._db_vatech_code_.'
			WHERE code_name = :code_name 
			ORDER BY code_sort LIMIT 1' ;
		$stmt = db()->prepare($q);
		$stmt->bindValue(':code_name', $code);
		
		stmtExecute($stmt);
		$r = $stmt->fetch(PDO::FETCH_ASSOC);
		
		self::$codeGroup[$code.'_'.$field] = $r[$field] ;		
		return self::$codeGroup[$code.'_'.$field] ;
	}
	
	/**
	 * code_name 으로 데이타 저장하기
	 * 
	 * @param string code_name 값
	 * @param string code_value 값
	 */
	static function setCodeStr($code_name,$code_value)
	{
		$q = '
			UPDATE '._db_vatech_code_.'
				SET code_value = :code_value
			WHERE code_name = :code_name 
			AND code_key = 1 LIMIT 1' ;
		
		
		$stmt = db()->prepare($q);
		$stmt->bindValue(':code_name', $code_name);
		$stmt->bindValue(':code_value', $code_value);
		
		stmtExecute($stmt);
	}
}
