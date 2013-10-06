<?php
define( '_SQL_PRODUCT_MENU_SELECT_' , '
	SELECT * FROM '._db_product_menu_.'
	WHERE menu_group = :menu_group 
	AND menu_sub_group = 0 
	ORDER BY menu_sort asc '  ) ;

define( '_SQL_PRODUCT_MENU_SELECT_Y_' , '
	SELECT * FROM '._db_product_menu_.'
	WHERE menu_group = :menu_group 
	AND menu_sub_group = 0 
	AND use_y_n = \'Y\' 
	ORDER BY menu_sort asc '  ) ;

define( '_SQL_PRODUCT_MENU_SUB_SELECT_' , '
	SELECT * FROM '._db_product_menu_.'
	WHERE menu_group = :menu_group 
	AND menu_sub_group = :menu_sub_group
	AND menu_sub_group <> 0
	ORDER BY menu_sort asc '  ) ;

define( '_SQL_PRODUCT_MENU_SELECT_ROW_SORT_MAX_' , '
	SELECT max(menu_sort) as menu_sort FROM '._db_product_menu_.'
	WHERE menu_group = :menu_group 
	AND menu_sub_group = :menu_sub_group'  ) ;

define( '_SQL_PRODUCT_MENU_SELECT_ROW_' , '
	SELECT * FROM '._db_product_menu_.'
	WHERE menu_idx = :menu_idx '  ) ;

define( '_SQL_PRODUCT_MENU_INSERT_' , '
	INSERT INTO '._db_product_menu_.'
	SET menu_group = :menu_group
	,	menu_sort = :menu_sort
	,	menu_sub_group = :menu_sub_group
	,	cate_proc_idx = :cate_proc_idx
	,	menu_name = :menu_name
	,	use_y_n = :use_y_n'  ) ;


define( '_SQL_PRODUCT_MENU_UPDATE_UPDOWN_' , '
	UPDATE '._db_product_menu_.'
	SET menu_sort = :update_menu_sort
	WHERE menu_group = :menu_group
	AND   menu_sub_group = :menu_sub_group
	AND   menu_sort =  :menu_sort'  ) ;


define( '_SQL_PRODUCT_MENU_UPDATE_' , '
	UPDATE '._db_product_menu_.'
	SET menu_name = :menu_name
	,	use_y_n = :use_y_n
	WHERE menu_idx = :menu_idx'  ) ;

define( '_SQL_PRODUCT_MENU_DELET_' , '
	DELETE FROM '._db_product_menu_.'
	WHERE menu_idx = :menu_idx'  ) ;
/**
 * 상품메뉴 카테고리 2개를 구분되는 
 * 프론트 메뉴에 사용되는 용도
 * 다른데서 쓸수있을까??
 * 
 * @author 윤진우
 */
class ProductMenu {
	private $menu_group ;
	private $menu_sub_group ;
	
	public $log = '' ;
	
	function __construct( $menu_group = '' , $menu_sub_group = '' ) {
		$this->setMenuGroup($menu_group);
		$this->setSubMenuGroup($menu_sub_group);
	}
	
	/**
	 * 메뉴그룹 == 카테고리
	 * 
	 * @param int $menu_group [1,2,3,....]
	 */
	function setMenuGroup($menu_group) {
		if(is_numeric($menu_group))
			$this->menu_group=$menu_group;
	}
	
	/**
	 * 서브메뉴그룹 == 상위 메뉴 번호
	 * 
	 * @param int $menu_sub_group [1,2,3,....]
	 */
	function setSubMenuGroup($menu_sub_group) {
		if(is_numeric($menu_sub_group))
			$this->menu_sub_group=$menu_sub_group;
	}
	
	/**
	 * getContactMenuList 에서 사용되는 쿼리문 반환
	 * 
	 * @return string database query string
	 */
	function _getContactMenuList()
	{
		$aWhere = array() ;
		if(is_numeric($this->menu_group)) 
			$aWhere[] = ' menu_group = '.$this->menu_group.' ' ;
		if(is_numeric($this->menu_sub_group)) 
			$aWhere[] = ' menu_sub_group = '.$this->menu_sub_group.' ' ;
		$aWhere[] = ' use_y_n = \'Y\' AND cate_proc_idx <> 0 ' ;
		
		$q = ' 
			SELECT * 
			FROM '._db_product_menu_.' a
			JOIN '._db_category_.' b ON a.menu_group = b.category_idx			
			WHERE '.implode(' AND ' , $aWhere ).'
			ORDER BY menu_group, menu_sub_group, menu_sort ' ;
		
		return $q ;
	}
	
	/**
	 * 상품 메뉴 정보중 사용되어지고 상품 카테고리 테이블(안씀)의
	 * 	 상품 메뉴 정보중 사용되어지고 상품 카테고리 테이블(안씀)의
     *
	 * 
	 *    정보 가  존재한는 것들만 가져온다.
	 * 
	 * @return string database query string
	 */
	function getContactMenuList(){
		$sttm = db()->prepare($this->_getContactMenuList()) ;
		
		stmtExecute($sttm);
		$ret = array() ;
		while( $r = $sttm->fetch(PDO::FETCH_ASSOC) )
			$ret[$r['menu_idx']] = $r ;
		
		return  $ret ;
	}
	
	
	function _getUseMenuList()
	{
		$aWhere = array() ;
		if(is_numeric($this->menu_group)) 
			$aWhere[] = ' menu_group = '.$this->menu_group.' ' ;
		if(is_numeric($this->menu_sub_group)) 
			$aWhere[] = ' menu_sub_group = '.$this->menu_sub_group.' ' ;
		$aWhere[] = ' use_y_n = \'Y\' ' ;
		
		$q = ' 
			SELECT * 
			FROM '._db_product_menu_.' a
			JOIN '._db_category_.' b ON a.menu_group = b.category_idx			
			WHERE '.implode(' AND ' , $aWhere ).'
			ORDER BY menu_group, menu_sub_group, menu_sort ' ;
		
		return $q ;
	}

	function replace($r)
	{
		$r['menu_name'] = F::htmlChar($r['menu_name']);
		return $r ;
	}
	
	function getUseMenuList(){
		$sttm = db()->prepare($this->_getUseMenuList()) ;
		
		stmtExecute($sttm);
		$ret = array() ;
		while( $r = $sttm->fetch(PDO::FETCH_ASSOC) )
			$ret[$r['menu_idx']] = $this->replace($r) ;
		
		return  $ret ;
	}
	
	function getMenuList(){
		$sttm = db()->prepare(_SQL_PRODUCT_MENU_SELECT_) ;
		$sttm->bindValue(':menu_group', $this->menu_group, PDO::PARAM_INT) ;
		
		stmtExecute($sttm);
		$ret = array() ;
		while( $r = $sttm->fetch(PDO::FETCH_ASSOC) )
			$ret[$r['menu_idx']] = $this->replace($r) ;
		
		return  $ret ;
	}
	
	function getMenuListY(){
		$sttm = db()->prepare(_SQL_PRODUCT_MENU_SELECT_Y_) ;
		$sttm->bindValue(':menu_group', $this->menu_group, PDO::PARAM_INT) ;
		
		stmtExecute($sttm);
		$ret = array() ;
		while( $r = $sttm->fetch(PDO::FETCH_ASSOC) )
			$ret[$r['menu_idx']] = $this->replace($r) ;
		
		return  $ret ;
	}
	
	function getFindMenuGroup($menu_group){
		$q = '
			SELECT * FROM '._db_product_menu_.'
			WHERE menu_group = :menu_group 
			AND menu_sub_group <> 0
			AND use_y_n = \'Y\'
			ORDER BY menu_name asc 
		' ;
		$sttm = db()->prepare($q) ;
		$sttm->bindValue(':menu_group', $this->menu_group, PDO::PARAM_INT) ;
		
		stmtExecute($sttm);
		$ret = array() ;
		while( $r = $sttm->fetch(PDO::FETCH_ASSOC) )
			$ret[$r['menu_idx']] = $r ;
		
		return  $ret ;
	}
	
	
	function getSubMenuList(){
		$sttm = db()->prepare(_SQL_PRODUCT_MENU_SUB_SELECT_) ;
		$sttm->bindValue(':menu_group', $this->menu_group, PDO::PARAM_INT) ;
		$sttm->bindValue(':menu_sub_group', $this->menu_sub_group, PDO::PARAM_INT) ;
		
		stmtExecute($sttm);
		$ret = array() ;
		while( $r = $sttm->fetch(PDO::FETCH_ASSOC) )
			$ret[$r['menu_idx']] = $this->replace($r) ;
		
		return $ret ;
	}
	
	function getMenuIdxInfo($menu_idx)
	{
		$q = '
			SELECT	  
				  a.menu_name
				, a.menu_idx
				, b.menu_name as parent_menu_name
				, b.menu_idx as parent_menu_idx 
			FROM '._db_product_menu_.' a 
			JOIN '._db_product_menu_.' b
			ON a.menu_sub_group = b.menu_idx
			WHERE a.menu_idx = :menu_idx';
		
		$sttm = db()->prepare($q) ;
		$sttm->bindValue(':menu_idx', $menu_idx, PDO::PARAM_INT) ;
		stmtExecute($sttm);
		
		return $sttm->fetch(PDO::FETCH_ASSOC) ;
		
	}
	
	function sortUp($menuIdx)
	{
		$this->sortUpdate($menuIdx, -1);
	}
	
	function sortDown($menuIdx)
	{
		$this->sortUpdate($menuIdx, 1);
	}
	
	private function sortUpdate($menuIdx, $step)
	{
		db()->beginTransaction() ;
		
		try{

			$sttm = db()->prepare(_SQL_PRODUCT_MENU_SELECT_ROW_) ;
			$sttm->bindValue(':menu_idx', $menuIdx, PDO::PARAM_INT) ;

			stmtExecute($sttm);
			$row = $sttm->fetch(PDO::FETCH_OBJ) ;
			if( !is_numeric($row->menu_idx) ) return ;
			if( $row->menu_sort == 1 && $step == -1 ) return ;
			
			$sttm3 = db()->prepare(_SQL_PRODUCT_MENU_SELECT_ROW_SORT_MAX_) ;
			$sttm3->bindValue(':menu_group'			, $row->menu_group, PDO::PARAM_INT) ;
			$sttm3->bindValue(':menu_sub_group'		, $row->menu_sub_group, PDO::PARAM_INT) ;
			stmtExecute($sttm3);
			if( $row->menu_sort == $sttm3->fetch(PDO::FETCH_OBJ)->menu_sort ) return ;

			$sttm2 = db()->prepare(_SQL_PRODUCT_MENU_UPDATE_UPDOWN_) ;
			$sttm2->bindValue(':update_menu_sort'	, -1, PDO::PARAM_INT) ;
			$sttm2->bindValue(':menu_group'			, $row->menu_group, PDO::PARAM_INT) ;
			$sttm2->bindValue(':menu_sub_group'		, $row->menu_sub_group, PDO::PARAM_INT) ;
			$sttm2->bindValue(':menu_sort'			, $row->menu_sort, PDO::PARAM_INT) ;
			$sttm2->execute() ;

			$sttm2->bindValue(':update_menu_sort'	, $row->menu_sort, PDO::PARAM_INT) ;
			$sttm2->bindValue(':menu_group'			, $row->menu_group, PDO::PARAM_INT) ;
			$sttm2->bindValue(':menu_sub_group'		, $row->menu_sub_group, PDO::PARAM_INT) ;
			$sttm2->bindValue(':menu_sort'			, $row->menu_sort+$step, PDO::PARAM_INT) ;
			$sttm2->execute() ;

			$sttm2->bindValue(':update_menu_sort'	, $row->menu_sort+$step, PDO::PARAM_INT) ;
			$sttm2->bindValue(':menu_group'			, $row->menu_group, PDO::PARAM_INT) ;
			$sttm2->bindValue(':menu_sub_group'		, $row->menu_sub_group, PDO::PARAM_INT) ;
			$sttm2->bindValue(':menu_sort'			, -1, PDO::PARAM_INT) ;
			$sttm2->execute() ;

			db()->commit();
			
			$ret = true ;
		}catch(Exception $e) {
			db()->rollBack();
			$ret = false ;
			
			$this->log = $e->getMessage();
		}
		return $ret ;
	}
	
	
	function insert( $menu_group , $menu_sub_group , $cate_proc_idx, $menu_name, $use_y_n )
	{
		db()->beginTransaction() ;
			
		try{
			switch ($use_y_n)
			{
				case 'N' : break ;
				case 'Y' : default : $use_y_n = 'Y' ;
			}
			if( !is_numeric($menu_group) ) return false ;
			if( !is_numeric($cate_proc_idx) ) return false ;
			
			
			if( !is_numeric($menu_sub_group) )
				$menu_sub_group = 0 ;


			$sttm = db()->prepare(_SQL_PRODUCT_MENU_SELECT_ROW_SORT_MAX_) ;
			$sttm->bindValue(':menu_group',		$menu_group, PDO::PARAM_INT) ;
			$sttm->bindValue(':menu_sub_group', $menu_sub_group, PDO::PARAM_INT) ;
			stmtExecute($sttm);
			$menu_sort = $sttm->fetch(PDO::FETCH_OBJ)->menu_sort + 1;
			
			$sttm = db()->prepare(_SQL_PRODUCT_MENU_INSERT_) ;
			$sttm->bindValue(':menu_group',		$menu_group, PDO::PARAM_INT) ;
			$sttm->bindValue(':menu_sort',		$menu_sort, PDO::PARAM_INT) ;
			$sttm->bindValue(':menu_sub_group', $menu_sub_group, PDO::PARAM_INT) ;
			$sttm->bindValue(':cate_proc_idx',	$cate_proc_idx, PDO::PARAM_INT) ;
			$sttm->bindValue(':menu_name',		$menu_name ) ;
			$sttm->bindValue(':use_y_n',		$use_y_n ) ;

			stmtExecute($sttm);
			db()->commit();
			
			$ret = db()->lastInsertId() ;
		}catch(Exception $e) {
			db()->rollBack();
			$ret = false ;
			
			$this->log = $e->getMessage();
		}
		
		return $ret ;		
	}
	
	
	function update( $menu_idx, $menu_name, $use_y_n )
	{
		db()->beginTransaction() ;
			
		try{
			switch ($use_y_n)
			{
				case 'N' : break ;
				case 'Y' : default : $use_y_n = 'Y' ;
			}
			
			$sttm = db()->prepare(_SQL_PRODUCT_MENU_UPDATE_) ;
			$sttm->bindValue(':menu_idx',		$menu_idx, PDO::PARAM_INT) ;
			$sttm->bindValue(':menu_name',		$menu_name ) ;
			$sttm->bindValue(':use_y_n',		$use_y_n ) ;
			
			stmtExecute($sttm);
			db()->commit();
			
			$ret = true ;
		}catch(Exception $e) {
			db()->rollBack();
			$ret = false ;
			
			$this->log = $e->getMessage();
		}
		
		return $ret ;		
	}
	
	
	function delete($menu_idx){
		$sttm = db()->prepare(_SQL_PRODUCT_MENU_SELECT_ROW_);
		$sttm->bindValue(':menu_idx', $menu_idx, PDO::PARAM_INT);
		stmtExecute($sttm);
		$o = $sttm->fetch(PDO::FETCH_OBJ);
		if( $o->cate_proc_idx == 0 ) return 0 ;
		
		$stmt = db()->prepare(_SQL_PRODUCT_MENU_DELET_);
		$stmt->bindValue(':menu_idx', $menu_idx, PDO::PARAM_INT);
		
		stmtExecute($stmt);
		return $stmt->rowCount() ;
	}
}
