<?php
require_once _PATH_module_.'/product/productItemRow.c.php' ;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductItemRowMobile
 *
 * @author Administrator
 */
class ProductItemRowMobile extends ProductItemRow {
	protected $product_mobile_idx ;
			
	function __construct($product_mobile_idx) {
		parent::__construct($product_mobile_idx);
		
		$this->product_mobile_idx = $product_mobile_idx;
		$this->db_product_item = _db_product_item_mobeil_ ;
	}
	
	function row() {
		$q = '	SELECT * FROM '.$this->db_product_item.' WHERE product_mobile_idx = :product_mobile_idx ';
		
		$stmt = db()->prepare($q) ;
		$stmt->bindValue(':product_mobile_idx',$this->product_mobile_idx,PDO::PARAM_INT) ;
		
		stmtExecute($stmt) ;
		
		if( $row = $stmt->fetch(PDO::FETCH_ASSOC) )
			return $this->replace ($row) ;
		else 
			return array();
	}
	
	function save($post){
		
		$row = $this->row() ;
		
		if(!isset($row['product_mobile_idx']))
		{
			$q = '
				INSERT INTO '.$this->db_product_item.'
				SET
					product_name = :item_name
				,	category_code = :category_code
				,	product_menu_idx = :product_menu_idx
				,	item_img = :item_img
				,	item_alt = :item_alt
				,	tab_content_1 = :tab_content_1
				,	editor_session_key = :editor_session_key
				,	reg_date = :reg_date
			' ;
			
			$stmt = db()->prepare($q) ;
			$stmt->bindValue(':reg_date', date('Y-m-d H:i:s')) ;
		}else{
			
			$q = '
				UPDATE '.$this->db_product_item.'
				SET
					product_name = :item_name
				,	category_code = :category_code
				,	product_menu_idx = :product_menu_idx
				,	item_img = :item_img
				,	item_alt = :item_alt
				,	tab_content_1 = :tab_content_1
				,	editor_session_key = :editor_session_key
				WHERE product_mobile_idx = :product_mobile_idx
			' ;

			
			$stmt = db()->prepare($q) ;
			$stmt->bindValue(':product_mobile_idx', $row['product_mobile_idx'],PDO::PARAM_INT) ;
		}
		
		
		$stmt->bindValue(':item_name', A::str($post, 'item_name'));
		$stmt->bindValue(':category_code', A::str($post, 'category_code') ,PDO::PARAM_INT);
		$stmt->bindValue(':product_menu_idx', A::number($post, 'product_menu_idx',0) ,PDO::PARAM_INT);
		$stmt->bindValue(':item_alt', A::str($post, 'item_alt'));
		$stmt->bindValue(':tab_content_1', A::str($post, 'tab_content_1'));
		$stmt->bindValue(':editor_session_key', A::str($post, 'editor_session_key'));
		
		$item_img = A::str($post, 'item_img') ;
		$stmt->bindParam(':item_img', $item_img);
		$path = _PATH_data_.'/product' ;
		$webpath = _WEB_PATH_DATA_.'/product' ;
		foreach($_FILES['file']['tmp_name'] as $k => $tmp_name)
		{
			$name = $_FILES['file']['name'][$k] ;
			$size = $_FILES['file']['size'][$k] ;
			$type = $_FILES['file']['type'][$k] ;
			if(is_uploaded_file($tmp_name))
			{
				$a = explode('.',$name) ;
				$ext = array_pop($a) ;
				$filename =  'mobile_'.microtime(true).rand(1,1000).$k.'.'.$ext ;

				if(isset($row['item_img']) && is_file($_SERVER['DOCUMENT_ROOT'].$row['item_img']))
					unlink($_SERVER['DOCUMENT_ROOT'].$row['item_img']);
				
				move_uploaded_file($tmp_name, $path.'/'.$filename);
				$item_img = $webpath.'/'.$filename ;
			}
		}
		
		stmtExecute($stmt);
	}
	
	
	function delete_mb($del_idx)
	{
		$this->product_mobile_idx = $del_idx;
		$a = $this->row();
		
		$aImgField = array('overview', 'overview_foot', 'item', 'item_over', 'highlight_1', 'highlight_2', 'highlight_3', 'highlight_4' );
		foreach( $aImgField as $v )
		{
			if( !isset($a[$v]) ) continue ;
			
			$path = $_SERVER['DOCUMENT_ROOT'].$a[$v];
			if( is_file($path) )
				unlink($path) ;
		}
		
		$q = '
			DELETE FROM '.$this->db_product_item.'
			WHERE product_mobile_idx = :product_mobile_idx' ;
		
		$stmt = db()->prepare($q);
		$stmt->bindValue(':product_mobile_idx', $this->product_mobile_idx, PDO::PARAM_INT);
		
		stmtExecute($stmt);
	}
}

?>
