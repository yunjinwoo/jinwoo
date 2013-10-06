<?php
load('product');
load('board');

/**
 *	  BoardList 상속
 * 문의 하기 
 * 필수 모듈
 * load('board');    
 * load('product');
 * define('_db_contact_us_', _db_fix_.'contact_us') ; 
 *
 * @author 윤진우
 */
class Contact extends BoardList {
	protected $aSubWhere = array();
			
	function __construct() {
		parent::__construct(_db_contact_us_);
	}
	
	
	/**
	 * WHERE 문에 bit 연산을 추가<br />
	 * customer_bit 필드 : code::contant_customer
	 * 
	 * @param int 
	 */
	function setCustomer($cust_bit)
	{
		if(is_numeric($cust_bit) )
			$this->aSubWhere['customer_bit'] = ' customer_bit & '.$cust_bit ;
	}
	
	/**
	 * WHERE 문에 bit 연산을 추가<br />
	 * purpose_bit 필드 : code::contant_purpose
	 * 
	 * @param int 
	 */
	function setPurpose($purp_bit)
	{
		if(is_numeric($purp_bit) )
			$this->aSubWhere['purpose_bit'] = ' purpose_bit & '.$purp_bit ;
		
	}
	
	
	/**
	 * WHERE 문에 country 조건 추가<br />
	 * country 필드 : code::country
	 * 
	 * @param string 
	 */
	function setCountry($country)
	{
		if(!empty($country) )
			$this->aSubWhere['country'] = ' country = \''.$country.'\'' ;
	}
	
	/**
	 * setCustomer, setPurpose, setCountry 에서 설정된
	 * 정보로 AND 로 붙여 반환
	 * 
	 * @return string AND ....
	 */
	function getSubWhere()
	{
		$str = '' ;
		if( count($this->aSubWhere) >= 1 )
			$str = ' AND '.implode( ' AND ', $this->aSubWhere) ;
		
		return $str ;
	}
	
	/**
	 * setCustomer, setPurpose, setCountry 에서 설정된
	 * 정보로 AND 로 붙여 반환
	 * 
	 * @return string AND ....
	 */
	function getList($page=1)
	{
		
		$startNum = ($page-1)*$this->list_size ;
		
		$q = '
			SELECT * FROM 
			(
				SELECT * FROM '.$this->board_table.'
				'.$this->getWhere().$this->getSubWhere().'
				ORDER BY us_idx DESC
				LIMIT '.$startNum.','.$this->list_size .'
			) a LEFT JOIN '._db_product_menu_.' b 
			ON
			b.menu_idx = a.product_menu_idx
		';
		
		$stmt = db()->prepare($q) ;
		foreach( $this->aKeyword as $k => $v ){
			$stmt->bindValue(":$k", "%$v%");
		}
		stmtExecute($stmt);
		
		$ret = array();
		$no = $this->getCount() - $startNum ;
		while($r = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$r['no'] = $no-- ;
			$ret[$r['us_idx']] = $this->replace($r) ;
		}
		
		return $ret ;
	}
	
	function getCountry()
	{
		$q = '
			SELECT DISTINCT country FROM '.$this->board_table.'
			ORDER BY country
		';
		
		$stmt = db()->prepare($q) ;
		
		stmtExecute($stmt);
		
		return $stmt->fetchAll(PDO::FETCH_ASSOC) ;
	}
	
	function delete($us_idx)
	{
		$row = $this->row($us_idx);
		if( is_file($_SERVER['DOCUMENT_ROOT'].$row['file_path']) )
			unlink($_SERVER['DOCUMENT_ROOT'].$row['file_path']);
		
		$q = 'DELETE FROM '.$this->board_table.' 
			WHERE us_idx = :us_idx' ;
		
		$stmt = db()->prepare($q) ;
		$stmt->bindValue(':us_idx', $us_idx, PDO::PARAM_INT);
		
		stmtExecute($stmt);
	}
	
	function row($us_idx)
	{
		$q = 'SELECT * FROM '.$this->board_table.'
			WHERE us_idx = :us_idx' ;
		
		$stmt = db()->prepare($q) ;
		$stmt->bindValue(':us_idx', $us_idx, PDO::PARAM_INT);
		
		stmtExecute($stmt);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if(is_numeric($row['product_menu_idx']))
		{
			$Product = new ProductMenu();
			$a = $Product->getMenuIdxInfo($row['product_menu_idx']);
			$row['menu_name'] = $a['menu_name'];
			$row['parent_menu_name'] = $a['parent_menu_name'];
		}
			
		return $row;
	}
	
	function save($aRow)
	{
		$stmt = db()->prepare($this->_insert());
		$stmt->bindValue(':customer_bit',array_sum($aRow['customer']), PDO::PARAM_INT);
		$stmt->bindValue(':country',$aRow['country']);
		$stmt->bindValue(':name',$aRow['name']);
		$stmt->bindValue(':phone',$aRow['phone']);
		$stmt->bindValue(':email',$aRow['mail1'].'@'.$aRow['mail2']);
		$stmt->bindValue(':purpose_bit',array_sum($aRow['purpose']), PDO::PARAM_INT);
		$stmt->bindValue(':product_menu_idx',$aRow['product_menu_idx'], PDO::PARAM_INT);
		$stmt->bindValue(':title',$aRow['title']);
		$stmt->bindValue(':text',$aRow['text']);
		$stmt->bindValue(':reg_date',date('Y-m-d H:i:s'));
		
		$file_name = $file_path = '' ;
		if(is_uploaded_file($_FILES['file']['tmp_name']))
		{
			$aName = explode('.',$_FILES['file']['name']) ;
			$tmpname = $_FILES['file']['tmp_name'] ;
				
			$filename =  microtime(true).rand(1,1000).'.'.$aName[1] ;
			$src =  _WEB_PATH_DATA_.'/vatech/contact/'.$filename ;
			$filepath =  _PATH_data_.'/vatech/contact/'.$filename ;
				
			move_uploaded_file($tmpname, $filepath);
			$file_name = $_FILES['file']['name'];
			$file_path = $src;
		}
		$stmt->bindValue(':file_name',$file_name);
		$stmt->bindValue(':file_path',$file_path);
		
		stmtExecute($stmt);
	}
	
	function _insert()
	{
		$q = ' 
			INSERT INTO '.$this->board_table.'
			SET
				`customer_bit`		= :customer_bit
			,	`country`			= :country
			,	`name`				= :name
			,	`phone`				= :phone
			,	`email`				= :email
			,	`purpose_bit`		= :purpose_bit
			,	`product_menu_idx`	= :product_menu_idx
			,	`title`				= :title
			,	`text`				= :text
			,	`reg_date`			= :reg_date
			,	`file_path`			= :file_path
			,	`file_name`			= :file_name
		';
		
		return $q;
	}
}

?>
