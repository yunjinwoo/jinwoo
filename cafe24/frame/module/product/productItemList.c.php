<?php

class ProductItemList {
	protected $page_size = 5 ;
	protected $list_size = 15 ;
	protected $listCnt = -1 ;
	protected $where = '' ;
	protected $aMenuIdx = '' ;
			
	function getInfoPageSize(){ return $this->page_size;}
	function getInfoListSize(){ return $this->list_size;}
			
	function __construct() {
		;
	}
	
	
	function setCateIdxWhere($cate_idx)
	{
		$q = '
			SELECT menu_idx FROM '._db_product_menu_.'
			WHERE 
				menu_group = :menu_group
			';
		$stmt = db()->prepare($q);
		$stmt->bindValue(':menu_group', $cate_idx , PDO::PARAM_INT);
		
		stmtExecute($stmt);
		while($r = $stmt->fetch(PDO::FETCH_ASSOC))
			$this->aMenuIdx[$r['menu_idx']] = $r['menu_idx'];
		
		$this->where = ' AND product_menu_idx IN ( '.implode(',', $this->aMenuIdx).') ';
		
	}
	function setFindIdxWhere($menu_sub_group)
	{
		$q = '
			SELECT menu_idx FROM '._db_product_menu_.'
			WHERE 
				menu_sub_group = :menu_sub_group
			';
		$stmt = db()->prepare($q);
		$stmt->bindValue(':menu_sub_group', $menu_sub_group , PDO::PARAM_INT);
		
		stmtExecute($stmt);
		$this->aMenuIdx = array();
		while($r = $stmt->fetch(PDO::FETCH_ASSOC))
			$this->aMenuIdx[$r['menu_idx']] = $r['menu_idx'];
		
		$this->where = ' AND product_menu_idx IN ( '.implode(',', $this->aMenuIdx).') ';
	}
	
	function bindWhere()
	{
		
	}

	function getList($page)
	{	
		$startNum = ($page-1)*$this->list_size ;
		$stmt = db()->prepare($this->_list($startNum)) ;
		
		stmtExecute($stmt) ;
				
		$ProductMenu = new ProductMenu ;
		$aMenuList = $ProductMenu->getUseMenuList() ;
		
		$ret = array() ;
		$no = $this->getCount() - $startNum ;
		while($r = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			if( isset($aMenuList[$r['menu_sub_group']]) ){
				$category_name = $aMenuList[$r['menu_sub_group']]['category_name'];
				$menu_sub_group_name = $aMenuList[$r['menu_sub_group']]['menu_name'];
			}else{
				$category_name = '미노출';
				$menu_sub_group_name = '미노출';
			}
			$r['no'] = $no-- ;
			$r['category_name']			= $category_name;
			$r['menu_sub_group_name']	= $menu_sub_group_name;
			$ret[$r['product_menu_idx']] = $r ;
		}
		
		return $ret ;
	}
	
	function getUseList($menu_sub_group)
	{
		$stmt = db()->prepare($this->_uselist());
		$stmt->bindValue(':menu_sub_group',$menu_sub_group,PDO::PARAM_INT);
		
		stmtExecute($stmt) ;
		$ProductMenu = new ProductMenu ;
		$aMenuList = $ProductMenu->getUseMenuList() ;
		
		$ret = array() ;
		while($r = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$r['category_name']			= $aMenuList[$r['menu_sub_group']]['category_name'];
			$r['menu_sub_group_name']	= $aMenuList[$r['menu_sub_group']]['menu_name'];
			$ret[$r['product_menu_idx']] = $r ;
		}
		
		return $ret ;
	}
	
	
	function getAllUseList()
	{
		$stmt = db()->prepare($this->_alluselist());
		
		stmtExecute($stmt) ;
		$ProductMenu = new ProductMenu ;
		$aMenuList = $ProductMenu->getUseMenuList() ;
		
		$ret = array() ;
		while($r = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			if( isset($aMenuList[$r['menu_sub_group']]['category_name']) )
				$r['category_name']			= $aMenuList[$r['menu_sub_group']]['category_name'];
			if( isset($aMenuList[$r['menu_sub_group']]['menu_name']) )
				$r['menu_sub_group_name']	= $aMenuList[$r['menu_sub_group']]['menu_name'];
			$ret[$r['product_menu_idx']] = $r ;
		}
		
		return $ret ;
	}
	
	
	function _list($startNum)
	{
		$q = '
			SELECT * FROM 
			(
				SELECT * FROM '._db_product_item_.' 
				WHERE 1=1 '.$this->where.'
				ORDER BY product_menu_idx asc
				LIMIT '.$startNum.', '.$this->list_size.'
			) a 
			LEFT JOIN 
				'._db_product_menu_.' b
			ON 
				a.product_menu_idx = b.menu_idx
			ORDER BY 
				menu_name 
			' ; // b.menu_group, menu_sort
		
		return $q ;
	}
	
	
	
	function _uselist()
	{
		$q = '
			SELECT * FROM 
			(
				SELECT * FROM '._db_product_item_.' 
				ORDER BY product_menu_idx asc
			) a 
			LEFT JOIN 
				'._db_product_menu_.' b
			ON 
				a.product_menu_idx = b.menu_idx
			WHERE b.use_y_n = \'Y\'
			AND menu_sub_group = :menu_sub_group
			ORDER BY 
				b.menu_group, menu_sort
			' ;
		
		return $q ;
	}
	
	function _alluselist()
	{
		$q = '
			SELECT * FROM 
			(
				SELECT * FROM '._db_product_item_.' 
				ORDER BY product_menu_idx asc
			) a 
			LEFT JOIN 
				'._db_product_menu_.' b
			ON 
				a.product_menu_idx = b.menu_idx
			ORDER BY rand()
			' ;
		
		return $q ;
	}
	
	
	function getCount()
	{
		if( $this->listCnt < 0 ){
			$q = 'SELECT count(*) as cnt FROM '._db_product_item_.' 
				WHERE 1=1 '.$this->where.'
				ORDER BY product_menu_idx asc' ;
			$stmt = db()->prepare($q);
			stmtExecute($stmt) ;
			$r = $stmt->fetch(PDO::FETCH_ASSOC) ;
			
			$this->listCnt = A::number($r, 'cnt') ;
		}
			
		return $this->listCnt ;
	}
}
