<?php
define( '_SQL_ACCESS_IP_SELECT_' , '
	SELECT * FROM '._db_access_ip_.' 
	ORDER BY ip asc
' ) ;
define( '_SQL_ACCESS_IP_SELECT_ROW_' , '
	SELECT * FROM '._db_access_ip_.' 
	WHERE ip LIKE :ip
' ) ;
define( '_SQL_ACCESS_IP_DELETE_' , '
	DELETE FROM '._db_access_ip_.' 
	WHERE ip = :ip
' ) ;

define( '_SQL_ACCESS_IP_INSERT_' , '
	INSERT INTO  '._db_access_ip_.'
	SET 		
		`ip`		= :ip
	,	`ip_info`	= :ip_info
	,	`reg_date`	= :reg_date
' ) ;

/**
 * 관리자 접속 허용 아이피 설정
 * 
 * @version 1
 */
class AccessIp {
	/**
	 * 
	 */
	function __construct() {
		;
	}
	
	/**
	 * 관리자 접속 허용 아이피 저장
	 * 
	 * @param string $ip ip 주소
	 * @param string $ipinfo 추가정보
	 * @return int last_insert_id 값
	 */
	function insert($ip, $ipinfo)
	{
		$aIp = $this->getRow($ip) ;
		if( count($aIp) >= 1 ) return ;
		
		$stmt = db()->prepare(_SQL_ACCESS_IP_INSERT_) ;
		
		$stmt ->bindValue(':ip', $ip);
		$stmt ->bindValue(':ip_info', $ipinfo);
		$stmt ->bindValue(':reg_date', date('Y-m-d H:i:s') , PDO::PARAM_STR);
		
		stmtExecute($stmt) ;
		
		return db()->lastInsertId() ;
	}
	
	
	/**
	 * 관리자 접속 허용 아이피 삭제
	 * 
	 * @param string $ip ip 주소
	 * @return int 삭제된 row 갯수
	 */
	function delete($ip)
	{
		$stmt = db()->prepare(_SQL_ACCESS_IP_DELETE_) ;
		
		$stmt ->bindValue(':ip', $ip);		
		stmtExecute($stmt) ;
		
		return $stmt->rowCount() ;
	}
	
	
	/**
	 * 관리자 접속 허용 아이피 리스트
	 * 
	 * @return array fatchAll PDO::FETCH_ASSOC
	 */
	function getList()
	{
		$sttm = db()->prepare(_SQL_ACCESS_IP_SELECT_) ;
		stmtExecute($sttm);
		
		return $sttm->fetchAll(PDO::FETCH_ASSOC) ;
	}
	
	/**
	 * 관리자 접속 허용 아이피 검색
	 * LIKE 검색 192.168.0.* 같은 형태도 가능하다
	 * 
	 * @param string $ip ip 주소
	 * @return bool true or false
	 */
	function isFind($ip)
	{
		$sttm = db()->prepare(_SQL_ACCESS_IP_SELECT_ROW_);
		$sttm->bindValue(":ip", str_replace('*', '', $ip).'%', PDO::PARAM_STR) ;
		stmtExecute($sttm);
		
		$arr = $sttm->fetch(PDO::FETCH_ASSOC);
		
		return (isset($arr['ip']) && !empty($arr['ip'])) ;
	}
	
	/**
	 * 관리자 접속 허용 아이피 검색 IP 
	 * 단일 검색 =
	 * 
	 * 
	 * @param string $ip ip 주소
	 * @return array fatchAll PDO::FETCH_ASSOC
	 */
	function getRow($ip)
	{
		$sttm = db()->prepare(_SQL_ACCESS_IP_SELECT_ROW_) ;
		$sttm->bindValue(":ip", $ip, PDO::PARAM_STR) ;
		stmtExecute($sttm);
		
		return $sttm->fetchAll(PDO::FETCH_ASSOC) ;
	}
	
}
