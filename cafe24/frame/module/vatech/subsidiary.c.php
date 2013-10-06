<?php
/**
 * Overseas Subsidiary list
 * 
 * @version 1
 */
class Subsidiary {
	protected $code_key ;
	protected $cnt = -1 ;
			
	function __construct($code_key="") {
		$this->setCodeKey($code_key);
	}
	
	/**
	 * $code_key
	 * 
	 * @param string $code_key 코드값 설정
	 */
	function setCodeKey($code_key)
	{
		$this->code_key = $code_key;
	}
	
	/**
	 * 설정된 리스트 반환
	 * 페이징 없음
	 * 
	 * @param string $orderby sub_idx DESC
	 * @return array idx => $row
	 */
	function getList($orderby = ' sub_idx DESC')
	{
		$stmt = db()->prepare($this->_list($orderby));
		if( !empty($this->code_key) ) 
			$stmt->bindValue (':code_key', $this->code_key);
		stmtExecute($stmt);
		$c = $this->getCount();
		$ret = array();
		$codeKey = Code::getCode('subsidiary') ;
		while( $r = $stmt->fetch(pdo::FETCH_ASSOC)){
			$r['no'] = $c-- ;
			$r['code_name'] = $codeKey[$r['code_key']]['code_value'] ;
			$ret[$r['sub_idx']] = $r;
		}
		return $ret;
	}
	
	/**
	 * 카운트 값 반환
	 * 
	 * @return int count(*) 
	 */
	function getCount()
	{
		if( $this->cnt >= 0 ) return $this->cnt;
				
		$q = 'SELECT COUNT(*) as cnt FROM '._db_vatech_sub_;
		if( !empty($this->code_key) ) {
			$q .= ' WHERE code_key = :code_key';
			$stmt = db()->prepare($q);
			
			$stmt->bindValue (':code_key', $this->code_key);
		}else{
			$stmt = db()->prepare($q);
		}
		
		stmtExecute($stmt);
		
		return $stmt->fetchColumn();
	}
	
	/**
	 * 리스트용 query 반환
	 * 
	 * @param string $orderby sub_idx DESC
	 * @return string list 용 select query return
	 */
	function _list($orderby='sub_idx DESC')
	{
		$w = '';
		if( !empty($this->code_key) ) $w = 'WHERE code_key = :code_key';
		$q = 'SELECT * FROM '._db_vatech_sub_.' '.$w.' ORDER BY '.$orderby;
		return $q ;
	}
}

/**
 * Overseas Subsidiary row
 * 
 * @version 1
 */
class SubsidiaryRow {
	protected $sub_idx;
			
	function __construct($sub_idx) {
		$this->setSubIdx($sub_idx);
	}
	
	/**
	 * sub_idx 설정
	 * 
	 * @param int $sub_idx idx
	 */
	function setSubIdx($sub_idx)
	{
		$this->sub_idx = $sub_idx;
	}
	
	/**
	 * 설정된 idx 의 row 를 찾아
	 * 업로드된 파일을 지우고
	 * table row 를 삭제한다.
	 * 
	 */
	function delete()
	{
		$row = $this->row();
		if(!is_numeric($row['sub_idx'])) return ;
		
		if(is_file($_SERVER['DOCUMENT_ROOT'].$row['sub_img']))
			unlink($_SERVER['DOCUMENT_ROOT'].$row['sub_img']);
		
		$q = 'DELETE FROM '._db_vatech_sub_.' WHERE sub_idx = '.$row['sub_idx'];
		db()->exec_($q);
	}
	
	/**
	 * 설정된 idx 의 row 를 찾아 반환
	 * 
	 * @return array fetch_assoc
	 */
	function row()
	{
		if( !is_numeric($this->sub_idx) || $this->sub_idx < 0 ) return array() ;
		
		$stmt = db()->prepare($this->_row());		
		$stmt->bindValue(':sub_idx', $this->sub_idx, PDO::PARAM_INT);
		
		stmtExecute($stmt);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	/**
	 * select row query string 
	 * 
	 * @return string select row query string 
	 */
	function _row()
	{
		$q = '
			SELECT * FROM '._db_vatech_sub_.'
			WHERE sub_idx = :sub_idx
			' ;
		return $q ;
	}
	
	/**
	 * 전송된 데이타를
	 * 저장 또는 수정한다.
	 * 
	 * @param array post data
	 * @return int table idx
	 */
	function save( $row )
	{
		$old_file = '' ;
		
		if( !is_numeric($this->sub_idx) || $this->sub_idx < 0 ){
			$stmt = db()->prepare($this->_insert());
			$stmt->bindValue(':reg_date', date('Y-m-d H:i:s'));
		}else{
			$data_row = $this->row();
			$old_file = $data_row['sub_img'];
			$stmt = db()->prepare($this->_update());
			$stmt->bindValue(':sub_idx', $this->sub_idx, PDO::PARAM_INT);
		}
		
		$stmt->bindValue(':code_key',		A::str($row,'code_key'));
		$stmt->bindValue(':sub_country',	A::str($row,'sub_country'));
		$stmt->bindValue(':sub_address',	A::str($row,'sub_address'));
		$stmt->bindValue(':sub_tel',		A::str($row,'sub_tel'));
		$stmt->bindValue(':sub_fax',		A::str($row,'sub_fax'));
		$stmt->bindValue(':sub_email',		A::str($row,'sub_email'));
		$stmt->bindValue(':sub_img',		A::str($row,'sub_img'));
		$stmt->bindValue(':sub_alt',		A::str($row,'sub_alt'));
		$stmt->bindValue(':sub_company',		A::str($row,'sub_company'));
		
		$path		= _PATH_data_.'/vatech/subsidiary' ;
		$webpath	= _WEB_PATH_DATA_.'/vatech/subsidiary' ;
		foreach($_FILES['file']['tmp_name'] as $k => $tmp_name)
		{
			$name = $_FILES['file']['name'][$k];
			$size = $_FILES['file']['size'][$k];
			$type = $_FILES['file']['type'][$k];
			if(is_uploaded_file($tmp_name))
			{
				$a = explode('.',$name) ;
				$ext = array_pop($a) ;
				$filename =  microtime(true).rand(1,1000).'.'.$ext ;

				if(is_file($_SERVER['DOCUMENT_ROOT'].$old_file))
					unlink($_SERVER['DOCUMENT_ROOT'].$old_file);
				
				move_uploaded_file($tmp_name, $path.'/'.$filename);				
				$path = $webpath.'/'.$filename ;
				$stmt->bindValue(':sub_img',		$path);
			}
		}
		
		stmtExecute($stmt) ;
		if( !is_numeric($this->sub_idx) || $this->sub_idx < 0 )
			$this->sub_idx = db()->lastInsertId ();
		
		return $this->sub_idx;
				
	}
	
	/**
	 * insert query string 
	 * 
	 * @return string insert query string 
	 */
	function _insert()
	{
		$q = '
			INSERT INTO '._db_vatech_sub_.'
			SET
				`code_name`		= \'subsidiary\'
			,	`code_key`		= :code_key
			,	`sub_country`	= :sub_country
			,	`sub_address`	= :sub_address
			,	`sub_tel`		= :sub_tel
			,	`sub_fax`		= :sub_fax
			,	`sub_email`		= :sub_email
			,	`sub_img`		= :sub_img
			,	`sub_alt`		= :sub_alt
			,	sub_company		= :sub_company
			,	`reg_date`		= :reg_date
			';
		return $q;
	}
	
	/**
	 * update query string 
	 * 
	 * @return string update query string 
	 */
	function _update()
	{
		$q = '
			UPDATE '._db_vatech_sub_.'
			SET
				`code_key`		= :code_key
			,	`sub_country`	= :sub_country
			,	`sub_address`	= :sub_address
			,	`sub_tel`		= :sub_tel
			,	`sub_fax`		= :sub_fax
			,	`sub_email`		= :sub_email
			,	`sub_img`		= :sub_img
			,	`sub_alt`		= :sub_alt
			,	sub_company		= :sub_company
			WHERE sub_idx = :sub_idx
			' ;
		return $q;
	}
}