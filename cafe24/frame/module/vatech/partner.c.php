<?php
/**
 * Business Partners list
 * 
 * @version 1
 */
class Partner {
	protected $code_key ;
	protected $country ;
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
	 * $country
	 * 
	 * @param string $country 국가코드
	 */
	function setCountry($country)
	{
		$this->country = $country;
	}
	
	/**
	 * 설정된 리스트 반환
	 * 페이징 없음
	 * 
	 * @return array idx => $row
	 */
	function getList()
	{
		$stmt = db()->prepare($this->_list());
		if( !empty($this->code_key) ) 
			$stmt->bindValue (':code_key', $this->code_key);
		if( !empty($this->country) ) 
			$stmt->bindValue (':country', $this->country);
		
		stmtExecute($stmt);
		$c = $this->getCount();
		$ret = array();
		$codeKey = Code::getCode('partners') ;
		while( $r = $stmt->fetch(pdo::FETCH_ASSOC)){
			$r['no'] = $c-- ;
			$r['code_name'] = $codeKey[$r['code_key']]['code_value'] ;
			$r['part_contact_mail_arr'] = explode(',', $r['part_contact_mail']) ;
			foreach( $r['part_contact_mail_arr'] as $k => $v )
				$r['part_contact_mail_arr'][$k] = trim($v);

			$ret[$r['part_idx']] = $r;
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
					
		$q = 'SELECT COUNT(*) as cnt FROM '._db_vatech_part_;
		$stmt = db()->prepare($q);
		stmtExecute($stmt);
		
		return $stmt->fetchColumn();
	}
	
	/**
	 * 리스트용 query 반환
	 * 
	 * @param string $orderby sub_idx DESC
	 * @return string list 용 select query return
	 */
	function _list()
	{
		$w = array() ;
		if( !empty($this->code_key) ) $w[] = ' code_key = :code_key';
		if( !empty($this->country) ) $w[] = ' part_country = :country';
		if( count($w) >= 1 ) $w = ' WHERE '.implode(' AND ' , $w) ;
		
		
		$q = 'SELECT * FROM '._db_vatech_part_.' '.$w.' ORDER BY part_country, part_clinic';
		return $q ;
	}
}

/**
 * Business Partners row
 * 
 * @version 1
 */
class PartnerRow {
	protected $part_idx;
			
	function __construct($part_idx) {
		$this->setSubIdx($part_idx);
	}
	
	/**
	 * sub_idx 설정
	 * 
	 * @param int $sub_idx idx
	 */
	function setSubIdx($part_idx)
	{
		$this->part_idx = $part_idx;
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
		if(!is_numeric($row['part_idx'])) return ;
		
		if(is_file($_SERVER['DOCUMENT_ROOT'].$row['part_country_img']))
			unlink($_SERVER['DOCUMENT_ROOT'].$row['part_country_img']);
		if(is_file($_SERVER['DOCUMENT_ROOT'].$row['part_clinic_img']))
			unlink($_SERVER['DOCUMENT_ROOT'].$row['part_clinic_img']);
			
		$q = 'DELETE FROM '._db_vatech_part_.' WHERE part_idx = '.$row['part_idx'];
		db()->exec_($q);
	}
	
	/**
	 * 설정된 idx 의 row 를 찾아 반환
	 * 
	 * @return array fetch_assoc
	 */
	function row()
	{
		if( !is_numeric($this->part_idx) || $this->part_idx < 0 ) return array() ;
		
		$stmt = db()->prepare($this->_row());		
		$stmt->bindValue(':part_idx', $this->part_idx, PDO::PARAM_INT);
		
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
			SELECT * FROM '._db_vatech_part_.'
			WHERE part_idx = :part_idx
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
		$old_file = array('part_country_img_file','part_clinic_img_file') ;
		
		if( !is_numeric($this->part_idx) || $this->part_idx < 0 ){
			$stmt = db()->prepare($this->_insert());
			$stmt->bindValue(':reg_date', date('Y-m-d H:i:s'));
		}else{
			$data_row = $this->row();
			$old_file['part_country_img'] = $data_row['part_country_img'];
			$old_file['part_clinic_img'] = $data_row['part_clinic_img'];
			$stmt = db()->prepare($this->_update());
			$stmt->bindValue(':part_idx', $this->part_idx, PDO::PARAM_INT);
		}
		
		$stmt->bindValue(':code_key',			A::str($row,'code_key'));
		$stmt->bindValue(':part_country',		A::str($row,'part_country'));
		$stmt->bindValue(':part_country_img',	A::str($row,'part_country_img'));
		$stmt->bindValue(':part_country_alt',	A::str($row,'part_country_alt'));
		$stmt->bindValue(':part_clinic',		A::str($row,'part_clinic'));
		$stmt->bindValue(':part_clinic_img',	A::str($row,'part_clinic_img'));
		$stmt->bindValue(':part_clinic_alt',	A::str($row,'part_clinic_alt'));
		$stmt->bindValue(':part_location',		A::str($row,'part_location'));
		$stmt->bindValue(':part_web_site',		A::str($row,'part_web_site'));
		$stmt->bindValue(':part_contact_mail',	A::str($row,'part_contact_mail'));
		$stmt->bindValue(':part_contact_tel',	A::str($row,'part_contact_tel'));
		$stmt->bindValue(':part_contact_fax',	A::str($row,'part_contact_fax'));
		
		$path		= _PATH_data_.'/vatech/partner' ;
		$webpath	= _WEB_PATH_DATA_.'/vatech/partner' ;
		foreach($_FILES['file']['tmp_name'] as $k => $tmp_name)
		{
			$name = $_FILES['file']['name'][$k];
			$type = $_FILES['file']['type'][$k];
			if(strpos($type, 'image')===false) continue ;
			if(is_uploaded_file($tmp_name))
			{
				$a = explode('.',$name) ;
				$ext = array_pop($a) ;
				$filename =  microtime(true).rand(1,1000).'.'.$ext ;

				if(is_file($_SERVER['DOCUMENT_ROOT'].$old_file[$k]))
					unlink($_SERVER['DOCUMENT_ROOT'].$old_file[$k]);
				
				move_uploaded_file($tmp_name, $path.'/'.$filename);				
				$move_file_path = $webpath.'/'.$filename ;
				$stmt->bindValue(':'.$k,	$move_file_path);
			}
		}
		stmtExecute($stmt) ;
		if( !is_numeric($this->part_idx) || $this->part_idx < 0 )
			$this->part_idx = db()->lastInsertId ();
		
		return $this->part_idx;
				
	}
	
	/**
	 * insert query string 
	 * 
	 * @return string insert query string 
	 */
	function _insert()
	{
		$q = '
			INSERT INTO '._db_vatech_part_.'
			SET
				`code_name`		= \'partner\'
			,	`code_key`		= :code_key
			,	`part_country`			= :part_country
			,	`part_country_img`		= :part_country_img
			,	`part_country_alt`		= :part_country_alt
			,	`part_clinic`			= :part_clinic
			,	`part_clinic_img`		= :part_clinic_img
			,	`part_clinic_alt`		= :part_clinic_alt
			,	`part_location`			= :part_location
			,	`part_web_site`			= :part_web_site
			,	`part_contact_mail`		= :part_contact_mail
			,	`part_contact_tel`		= :part_contact_tel
			,	`part_contact_fax`		= :part_contact_fax
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
			UPDATE '._db_vatech_part_.'
			SET
				`code_key`		= :code_key
			,	`part_country`			= :part_country
			,	`part_country_img`		= :part_country_img
			,	`part_country_alt`		= :part_country_alt
			,	`part_clinic`			= :part_clinic
			,	`part_clinic_img`		= :part_clinic_img
			,	`part_clinic_alt`		= :part_clinic_alt
			,	`part_location`			= :part_location
			,	`part_web_site`			= :part_web_site
			,	`part_contact_mail`		= :part_contact_mail
			,	`part_contact_tel`		= :part_contact_tel
			,	`part_contact_fax`		= :part_contact_fax
			WHERE part_idx = :part_idx
			' ;
		return $q;
	}
}
