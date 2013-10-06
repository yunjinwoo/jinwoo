<?php


class productMenuMobile {
	protected $db_product_menu_mobile = _db_product_menu_mobile_ ;
	protected $aList = array() ;
	
	function __construct() {
		;
	}
	
	function getList($code)
	{
		if( isset($this->aList[$code]) && is_array($this->aList[$code]) )
			return $this->aList[$code] ;
		
		$q = '
			SELECT * FROM '.$this->db_product_menu_mobile.'
			ORDER BY category_code asc, menu_mobile_idx asc 
		';
		
		$stmt = db()->prepare($q);
		stmtExecute($stmt);
		
		$category_list = Code::getCode('mobile_category_code');
		while($r=$stmt->fetch(PDO::FETCH_ASSOC)){
			$r['category_name'] = $category_list[$r['category_code']]['code_value'];
			$this->aList[$r['category_code']][$r['menu_mobile_idx']] = $r ;
		}
		
		if( isset($this->aList[$code]) && is_array($this->aList[$code]) )
			return $this->aList[$code] ;
		else
			return array();
	}
	
	function save($row)
	{
		$q = '
			UPDATE '.$this->db_product_menu_mobile.'
			SET
				image_path = :image_path
			,	image_alt = :image_alt
			,	link_str = :link_str
			WHERE
				menu_mobile_idx = :menu_mobile_idx
		' ;
		
		$stmt = db()->prepare($q);
		$stmt->bindValue(':image_path'	, $row['image_path']);
		$stmt->bindValue(':image_alt'	, $row['image_alt']);
		$stmt->bindValue(':link_str'		, $row['link_str']);
		$stmt->bindValue(':menu_mobile_idx', $row['menu_mobile_idx'], PDO::PARAM_INT);
		
		stmtExecute($stmt);
	}
	
	function row($product_menu_idx)
	{
		$q = '
			SELECT * FROM '.$this->db_product_menu_mobile.'
			WHERE menu_mobile_idx = :menu_mobile_idx
			' ;
		$stmt = db()->prepare($q);
		$stmt->bindValue(':menu_mobile_idx', $product_menu_idx, PDO::PARAM_INT);
		
		stmtExecute($stmt);
		
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	function deleteEmpty($product_menu_idx)
	{
		$row = $this->row($product_menu_idx);
		$file = _PATH_.'/'.$row['image_path'];
		if( is_file($file) )
			unlink($file);
		
		$row = array(
			'image_path'=>'',
			'image_alt'=>'',
			'link_str'=>'',
			'menu_mobile_idx'=>$product_menu_idx
		);
		
		$this->save($row);
	}
}

?>
