<?php
define( '_SQL_PRODUCT_CATEGORY_SELECT_' , '
	SELECT * FROM '._db_category_product_.' 
	WHERE category_idx = :category_idx
	ORDER BY category_idx asc
' ) ;

define( '_SQL_PRODUCT_CATEGORY_INSERT_' , '
	INSERT INTO '._db_category_product_.' 
	SET 
		category_idx = :category_idx
	,	cate_proc_parent_idx = :cate_proc_parent_idx
	,	cate_proc_name = :cate_proc_name
	,	use_y_n = :use_y_n
	,	reg_date = :reg_date
' ) ;

class ProductCategory {
	function getList($cate_idx)
	{
		$q = _SQL_PRODUCT_CATEGORY_SELECT_ ;
		$sttm = db()->prepare($q) ;
		$sttm->bindValue(':category_idx', $cate_idx, PDO::PARAM_INT);
		
		stmtExecute($sttm);
		
		return $sttm->fetchAll(PDO::FETCH_ASSOC) ;
	}
	
	function insert($category_idx,$cate_proc_parent_idx,$cate_proc_name,$use_y_n)
	{		
		switch ($use_y_n)
		{
			case 'N' : break ;
			case 'Y' : default : $use_y_n = 'Y' ;
		}
		
		// 바텍에서는 안쓰는 category_product 테이블 키
		if( !is_numeric($cate_proc_parent_idx) )
			$cate_proc_parent_idx = 0 ;
		
		$q = _SQL_PRODUCT_CATEGORY_INSERT_ ;
		$sttm = db()->prepare($q) ;
		$sttm->bindValue(':category_idx',			$category_idx, PDO::PARAM_INT);
		$sttm->bindValue(':cate_proc_parent_idx',	$cate_proc_parent_idx, PDO::PARAM_INT);
		$sttm->bindValue(':cate_proc_name',			$cate_proc_name);
		$sttm->bindValue(':use_y_n',				$use_y_n);
		$sttm->bindValue(':reg_date', date('Y-m-d H:i:s'), PDO::PARAM_INT);
		
		stmtExecute($sttm);
		
		return db()->lastInsertId() ;
	}
}
