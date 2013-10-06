<?php
/**
 * VATECH Networks list
 * 
 * @version 1
 */
class Networks {
	protected $cnt = -1;
	protected $table_name;
	
	function __construct() {
		;
	}
	function getList()
	{
		$stmt = db()->prepare($this->_list());
		stmtExecute($stmt);
		$c = $this->getCount();
		$ret = array();
		while( $r = $stmt->fetch(pdo::FETCH_ASSOC)){
			$r['no'] = $c-- ;
			$ret[$r['network_idx']] = $r;
		}
		return $ret;
	}
	
	function getCount()
	{
		if( $this->cnt >= 0 ) return $this->cnt;
					
		$q = 'SELECT COUNT(*) as cnt FROM '._db_vatech_networks_;
		$stmt = db()->prepare($q);
		stmtExecute($stmt);
		
		return $stmt->fetchColumn();
	}
	
	function _list()
	{
		$w = '';
		$q = 'SELECT * FROM '._db_vatech_networks_.' '.$w.' ORDER BY network_sort';
		return $q ;
	}
}



/**
 * VATECH Networks row
 * 
 * @version 1
 */
class NetworksRow {
	protected $network_idx;
			
	function __construct($network_idx) {
		$this->setSubIdx($network_idx);
	}
	function setSubIdx($network_idx)
	{
		$this->network_idx = $network_idx;
	}
	
	function delete()
	{
		$row = $this->row();
		if(!is_numeric($row['network_idx'])) return ;
		
		if(is_file($_SERVER['DOCUMENT_ROOT'].$row['network_img']))
			unlink($_SERVER['DOCUMENT_ROOT'].$row['network_img']);
		
		$q = 'DELETE FROM '._db_vatech_networks_.' WHERE network_idx = '.$row['network_idx'];
		db()->exec_($q);
	}
	
	function row()
	{
		if( !is_numeric($this->network_idx) || $this->network_idx < 0 ) return array() ;
		
		$stmt = db()->prepare($this->_row());		
		$stmt->bindValue(':network_idx', $this->network_idx, PDO::PARAM_INT);
		
		stmtExecute($stmt);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	function _row()
	{
		$q = '
			SELECT * FROM '._db_vatech_networks_.'
			WHERE network_idx = :network_idx
			' ;
		return $q ;
	}
	
	function save( $row )
	{
		$old_file = array('network_img') ;
		
		if( !is_numeric($this->network_idx) || $this->network_idx < 0 ){
			$stmt = db()->prepare($this->_insert());
			$stmt->bindValue(':reg_date', date('Y-m-d H:i:s'));
		}else{
			$data_row = $this->row();
			if($data_row['network_sort'] > $row['network_sort'])
			{
				$q = 'UPDATE '._db_vatech_networks_.' 
					SET
						network_sort = network_sort + 1 
					WHERE
						network_idx >= :network_sort_up
					AND network_idx < :network_sort_down
					' ;
			}else{
				$q = 'UPDATE '._db_vatech_networks_.' 
					SET
						network_sort = network_sort - 1 
					WHERE
						network_idx > :network_sort_up
					AND network_idx <= :network_sort_down
					' ;
			}
			$stmt = db()->prepare($q);
			$stmt->bindValue(':network_sort_up', $row['network_sort'], PDO::PARAM_INT);
			$stmt->bindValue(':network_sort_down', $data_row['network_sort'], PDO::PARAM_INT);
			
			$old_file['network_img'] = $data_row['network_img'];
			$stmt = db()->prepare($this->_update());
			$stmt->bindValue(':network_idx', $this->network_idx, PDO::PARAM_INT);
		}
		
		$stmt->bindValue(':network_img',		A::str($row,'network_img'));
		$stmt->bindValue(':network_alt',		A::str($row,'network_alt'));
		$stmt->bindValue(':network_title',		A::str($row,'network_title'));
		$stmt->bindValue(':network_text',		A::str($row,'network_text'));
		$stmt->bindValue(':network_url',		A::str($row,'network_url'));
		$stmt->bindValue(':network_sort',		A::number($row,'network_sort',0), PDO::PARAM_INT);
		
		$path		= _PATH_data_.'/vatech/network' ;
		$webpath	= _WEB_PATH_DATA_.'/vatech/network' ;
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

				if(isset($old_file[$k]) && is_file($_SERVER['DOCUMENT_ROOT'].$old_file[$k]))
					unlink($_SERVER['DOCUMENT_ROOT'].$old_file[$k]);
				
				move_uploaded_file($tmp_name, $path.'/'.$filename);				
				$move_file_path = $webpath.'/'.$filename ;
				$stmt->bindValue(':'.$k,	$move_file_path);
			}
		}
		
		stmtExecute($stmt) ;
		if( !is_numeric($this->network_idx) || $this->network_idx < 0 )
			$this->network_idx = db()->lastInsertId ();
		
		return $this->network_idx;
				
	}
	
	function _insert()
	{
		$q = '
			INSERT INTO '._db_vatech_networks_.'
			SET
				`network_img`		= :network_img
			,	`network_alt`		= :network_alt
			,	`network_title`		= :network_title
			,	`network_text`		= :network_text
			,	`network_url`		= :network_url
			,	`network_sort`		= :network_sort
			,	`reg_date`		= :reg_date
			';
		return $q;
	}
			
	function _update()
	{
		$q = '
			UPDATE '._db_vatech_networks_.'
			SET
				`network_img`		= :network_img
			,	`network_alt`		= :network_alt
			,	`network_title`		= :network_title
			,	`network_text`		= :network_text
			,	`network_url`		= :network_url
			,	`network_sort`		= :network_sort
			WHERE network_idx = :network_idx
			' ;
		return $q;
	}
}
