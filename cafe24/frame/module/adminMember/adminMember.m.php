<?php

define( '_SQL_ADMIN_MEMBER_SELECT_' , '
	SELECT * FROM '._db_admin_.' 
	/*WHERE*/
	ORDER BY admin_idx desc
' ) ;
define( '_SQL_ADMIN_MEMBER_SELECT_COUNT_' , '
	SELECT count(*) as cnt FROM '._db_admin_.' 
' ) ;
define( '_SQL_ADMIN_MEMBER_SELECT_ID_' , '
	SELECT * FROM '._db_admin_.' 
	WHERE admin_id = :admin_id
' ) ;

define( '_SQL_ADMIN_MEMBER_DELETE_ID_' , '
	DELETE FROM '._db_admin_.' 
	WHERE admin_id = :admin_id
' ) ;

define( '_SQL_ADMIN_MEMBER_INSERT_' , '
	INSERT INTO  '._db_admin_.'
	SET 		
		`admin_idx`		= null
	,	`admin_id`		= :admin_id
	,	`admin_pw`		= :admin_pw
	,	`admin_name`	= :admin_name
	,	`admin_phone`	= :admin_phone
	,	`admin_level`	= :admin_level
	,	`admin_owner`	= :admin_owner
	,	`reg_date`		= :reg_date
' ) ;

define( '_SQL_ADMIN_MEMBER_UPDATE_' , '
	UPDATE  '._db_admin_.'
	SET 		
		`admin_pw`		= :admin_pw
	,	`admin_name`	= :admin_name
	,	`admin_phone`	= :admin_phone
	,	`admin_level`	= :admin_level
	,	`admin_owner`	= :admin_owner
	,	`reg_date`		= :reg_date
	WHERE 
		`admin_id`		= :admin_id
' ) ;

 /**
  * 관리자 접속 정보
  * 
  * @version 1
  */
class AdminMember {
	public $list_size = 15 ;
	/**
	 * 
	 */
	function __construct() {
		;
	}
	
	
	/**
	 * 관리자 접속 정보 저장
	 * 
	 * @param array $ip admin_id, admin_pw, admin_name, admin_phone, admin_owner
	 * @return int last_insert_id 값
	 */
	function insert($row)
	{
		$stmt = db()->prepare(_SQL_ADMIN_MEMBER_INSERT_) ;
		
		$stmt ->bindValue(':admin_id', $row['admin_id']);
		$stmt ->bindValue(':admin_pw', $row['admin_pw']);
		$stmt ->bindValue(':admin_name', $row['admin_name']);
		$stmt ->bindValue(':admin_phone', $row['admin_phone']);
		$stmt ->bindValue(':admin_level', 0, PDO::PARAM_INT); //$row['admin_level'] // 아직 사용안함
		$stmt ->bindValue(':admin_owner', $row['admin_owner'], PDO::PARAM_INT);
		$stmt ->bindValue(':reg_date', date('Y-m-d H:i:s') , PDO::PARAM_STR);
		
		stmtExecute($stmt) ;
		
		
		return db()->lastInsertId() ;
	}
	
	/**
	 * 관리자 접속 정보 삭제
	 * 
	 * @param string $admin_id 삭제할 아이디
	 * @return int 삭제된 row 갯수
	 */	
	function delete($admin_id)
	{
		$stmt = db()->prepare(_SQL_ADMIN_MEMBER_DELETE_ID_) ;
		
		$stmt ->bindValue(':admin_id', $admin_id);
		
		stmtExecute($stmt) ;
		
		return $stmt->rowCount() ;
	}
	
	/**
	 * 관리자 접속 정보 수정
	 * 
	 * @param array $ip admin_id, admin_pw, admin_name, admin_phone, admin_owner
	 * @return void
	 */
	function update($row)
	{
		$stmt = db()->prepare(_SQL_ADMIN_MEMBER_UPDATE_) ;
		
		$stmt ->bindValue(':admin_id', $row['admin_id']);
		$stmt ->bindValue(':admin_pw', $row['admin_pw']);
		$stmt ->bindValue(':admin_name', $row['admin_name']);
		$stmt ->bindValue(':admin_phone', $row['admin_phone']);
		$stmt ->bindValue(':admin_level', 0, PDO::PARAM_INT); //$row['admin_level'] // 아직 사용안함
		$stmt ->bindValue(':admin_owner', $row['admin_owner'], PDO::PARAM_INT);
		$stmt ->bindValue(':reg_date', date('Y-m-d H:i:s') , PDO::PARAM_STR);
		
		stmtExecute($stmt) ;
	}
	
	/**
	 * 관리자 접속 정보 리스트
	 * 
	 * @param int $page=1 페이지 limit 구하는용
	 * @return array fetch(PDO::FETCH_ASSOC)
	 */	
	function getList($page=1)
	{
		$q = _SQL_ADMIN_MEMBER_SELECT_ ;
		
		$startNum = ($page-1)*$this->list_size ;
		$sttm = db()->prepare($q.' LIMIT '.$startNum.','.$this->list_size  ) ;
		
		stmtExecute($sttm);
		
		$ret = array();
		$no = $this->getCount() - $startNum ;
		while($r = $sttm->fetch(PDO::FETCH_ASSOC))
		{
			$r['no'] = $no-- ;
			$ret[$r['admin_idx']] = $r ;
		}

		return $ret ;
	}
	
	/**
	 * 관리자 접속 정보 COUNT
	 * 
	 * @return int 갯수
	 */	
	function getCount()
	{
		$q = _SQL_ADMIN_MEMBER_SELECT_COUNT_ ;
		$stmt = db()->prepare($q) ;
		stmtExecute($stmt);
		$a = $stmt->fetch(PDO::FETCH_ASSOC) ;
		return $a['cnt'] ;
	}
	
	/**
	 * 관리자 접속 정보 가져오기
	 * 
	 * @param string $admin_id 가져올 id
	 * @return array fetch(PDO::FETCH_ASSOC)
	 */	
	function getRowId( $admin_id )
	{
		$q = _SQL_ADMIN_MEMBER_SELECT_ID_ ;
		$sttm = db()->prepare($q) ;
		$sttm->bindParam(':admin_id', $admin_id, PDO::PARAM_STR) ;
		stmtExecute($sttm);
		
		return $sttm->fetch(PDO::FETCH_ASSOC) ;
	}
}


