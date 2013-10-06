<?php
define( '_SQL_CATEGORY_SELECT_' , '
	SELECT * FROM '._db_category_.' 
	WHERE category_type = :category_type
	ORDER BY category_idx asc
' ) ;
/**
 * @@@ 추후 작업
 * 관리에 대한걸 만들어야 한다.
 *
 * @author Administrator
 */
class Category {
	//put your code here
	
	function getProductCode()
	{
		$stmt = db()->prepare(_SQL_CATEGORY_SELECT_) ;
		$stmt->bindValue(':category_type', 'product' );
		
		stmtExecute( $stmt ) ;
		
		$ret = array() ;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC) ) 
			$ret[$row['category_idx']] = $row ;
		
		
		return $ret ;
	}
}
