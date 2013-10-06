<?php

class GreenPartner {
	protected $cnt = -1 ;
			
	function __construct() {
	}
	function getList()
	{
		$stmt = db()->prepare($this->_list());
		stmtExecute($stmt);
		$c = $this->getCount();
		$ret = array();
		while( $r = $stmt->fetch(pdo::FETCH_ASSOC)){
			$r['no'] = $c-- ;
			$ret[$r['part_idx']] = $r;
		}
		return $ret;
	}
	
	function getCount()
	{
		if( $this->cnt >= 0 ) return $this->cnt;
					
		$q = 'SELECT COUNT(*) as cnt FROM '._db_vatech_green_;
		$stmt = db()->prepare($q);
		stmtExecute($stmt);
		
		return $stmt->fetchColumn();
	}
	
	function _list()
	{
		$w = '';
		$q = 'SELECT * FROM '._db_vatech_green_.' '.$w.' ORDER BY part_idx DESC';
		return $q ;
	}
}


class GreenPartnerRow {
	protected $part_idx;
			
	function __construct($part_idx) {
		$this->setSubIdx($part_idx);
	}
	function setSubIdx($part_idx)
	{
		$this->part_idx = $part_idx;
	}
	
	function delete()
	{
		$row = $this->row();
		if(!is_numeric($row['part_idx'])) return ;
		
		if(is_file($_SERVER['DOCUMENT_ROOT'].$row['part_country_img']))
			unlink($_SERVER['DOCUMENT_ROOT'].$row['part_country_img']);
		if(is_file($_SERVER['DOCUMENT_ROOT'].$row['part_clinic_img']))
			unlink($_SERVER['DOCUMENT_ROOT'].$row['part_clinic_img']);
			
		$q = 'DELETE FROM '._db_vatech_green_.' WHERE part_idx = '.$row['part_idx'];
		db()->exec_($q);
	}
	
	function row()
	{
		if( !is_numeric($this->part_idx) || $this->part_idx < 0 ) return array() ;
		
		$stmt = db()->prepare($this->_row());		
		$stmt->bindValue(':part_idx', $this->part_idx, PDO::PARAM_INT);
		
		stmtExecute($stmt);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	function _row()
	{
		$q = '
			SELECT * FROM '._db_vatech_green_.'
			WHERE part_idx = :part_idx
			' ;
		return $q ;
	}
	
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
		
		$path		= _PATH_data_.'/vatech/green' ;
		$webpath	= _WEB_PATH_DATA_.'/vatech/green' ;
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
	
	function _insert()
	{
		$q = '
			INSERT INTO '._db_vatech_green_.'
			SET
				`part_country`			= :part_country
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
	
			
	function _update()
	{
		$q = '
			UPDATE '._db_vatech_green_.'
			SET
				`part_country`			= :part_country
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
