<?php
require_once _PATH_module_.'/product/productItemList.c.php' ;

class ProductItemListMobile extends ProductItemList{
	function __construct() {
		;
	}
	
	function setMobileCategory($code)
	{
		$this->where = ' WHERE category_code = '.$code;
	}
	
	function getList($page)
	{	
		
		$startNum = ($page-1)*$this->list_size ;
		$q = '
			SELECT * FROM '._db_product_item_mobeil_.'
				'.$this->where.'
			ORDER BY product_name 
			LIMIT '.$startNum.', '.$this->list_size.'
		' ; 
		
		$stmt = db()->prepare($q) ;
		
		stmtExecute($stmt) ;
		
		
		$category_list = Code::getCode('mobile_category_code');
		
		$ret = array() ;
		$no = $this->getCount() - $startNum ;
		while($r = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$r['no'] = $no-- ;
			$r['category_name']			= $category_list[$r['category_code']]['code_value'];
			$ret[$r['product_mobile_idx']] = $r ;
		}
		
		return $ret ;
	}
	
	
	function getCount()
	{
		if( $this->listCnt < 0 ){
			$q = 'SELECT count(*) as cnt FROM '._db_product_item_mobeil_.$this->where ;
			$stmt = db()->prepare($q);
			stmtExecute($stmt) ;
			$r = $stmt->fetch(PDO::FETCH_ASSOC) ;
			
			$this->listCnt = A::number($r, 'cnt') ;
		}
			
		return $this->listCnt ;
	}
	
	
	function getCodeAllList($code)
	{
		$q = '
			SELECT * FROM '._db_product_item_mobeil_.'
			WHERE category_code = :category_code
			ORDER BY product_name ' ; 
		
		$stmt = db()->prepare($q) ;
		$stmt->bindValue(':category_code', $code, PDO::PARAM_INT);
		
		stmtExecute($stmt) ;
		$ret = array() ;
		while($r = $stmt->fetch(PDO::FETCH_ASSOC))
			$ret[$r['product_mobile_idx']] = $r ;
		
		return $ret ;
	}
}
