<?php

class ProductItemRow {
	
	protected $db_product_item = _db_product_item_;
	protected $db_product_menu = _db_product_menu_;
			
			
	protected $product_menu_idx ;
	
	function __construct($product_menu_idx) {
		$this->product_menu_idx = $product_menu_idx ;
		if(! is_numeric($this->product_menu_idx) )
			debug(_MSG_ERROR_.' $this->product_menu_idx ') ;
	}
	
	function row() {
		
		$stmt = db()->prepare($this->_row()) ;
		$stmt->bindValue(':product_menu_idx',$this->product_menu_idx,PDO::PARAM_INT) ;
		
		stmtExecute($stmt) ;
		
		if( $row = $stmt->fetch(PDO::FETCH_ASSOC) )
			return $this->replace ($row) ;
		else 
			return array();
	}
	
	function replace($row) 
	{
		
		return $row ;
	}
	
	function _row()
	{
		$q = '
			SELECT *
				, a.menu_name
				, a.menu_idx
				, b.menu_name as parent_menu_name
				, b.menu_idx as parent_menu_idx 
			FROM '.$this->db_product_item.' i
			JOIN '.$this->db_product_menu.' a 
		ON  i.product_menu_idx = a.menu_idx 
		JOIN '.$this->db_product_menu.' b
		ON a.menu_sub_group = b.menu_idx
		WHERE i.product_menu_idx = :product_menu_idx' ;
		
		return $q ;
	}
	
	/**
	 * 상품정보 삭제 
	 * 상품메뉴 삭제시 상품도 같이 삭제된다.
	 * 
	 * 검색후 이미지 삭제하고 row 삭제
	 * 
	 */
	function delete()
	{
		$a = $this->row();
		
		$aImgField = array('overview', 'overview_foot', 'item', 'item_over', 'highlight_1', 'highlight_2', 'highlight_3', 'highlight_4' );
		foreach( $aImgField as $v )
		{
			$path = $_SERVER['DOCUMENT_ROOT'].$a[$v];
			if( is_file($path) )
				unlink($path) ;
		}
		
		$q = '
			DELETE FROM '.$this->db_product_item.'
			WHERE product_menu_idx = :product_menu_idx' ;
		
		$stmt = db()->prepare($q);
		$stmt->bindValue(':product_menu_idx', $this->product_menu_idx, PDO::PARAM_INT);
		
		stmtExecute($stmt);
	}
	
	function save($row) {
		$a = $this->row() ;
		
		if(!isset($a['product_menu_idx']))
		{
			$stmt = db()->prepare($this->_insert()) ;
			$stmt->bindValue(':reg_date', date('Y-m-d H:i:s')) ;
		}else{
			$stmt = db()->prepare($this->_update()) ;
		}
		
		$stmt->bindValue(':product_menu_idx'	,$this->product_menu_idx , PDO::PARAM_INT);
		$stmt->bindValue(':overview_alt'		,A::str($row, 'overview_alt') );
		$stmt->bindValue(':overview_foot_alt'	,A::str($row, 'overview_foot_alt') );
		$stmt->bindValue(':item_alt'			,A::str($row, 'item_alt') );
		$stmt->bindValue(':item_over_alt'		,A::str($row, 'item_over_alt') );
		$stmt->bindValue(':highlight_alt_1'		,A::str($row, 'highlight_alt_1') );
		$stmt->bindValue(':highlight_alt_2'		,A::str($row, 'highlight_alt_2') );
		$stmt->bindValue(':highlight_alt_3'		,A::str($row, 'highlight_alt_3') );
		$stmt->bindValue(':highlight_alt_4'		,A::str($row, 'highlight_alt_4') );
		$stmt->bindValue(':icon_index'			,A::str($row, 'icon_index') );
		
		$aImg = array() ;
		$aImg['overview'] = A::str($row, 'overview_img') ;
		$aImg['overview_foot'] = A::str($row, 'overview_foot_img') ;
		$aImg['item'] = A::str($row, 'item_img') ;
		$aImg['item_over'] = A::str($row, 'item_over_img') ;
		$aImg['highlight_1'] = A::str($row, 'highlight_img_1') ;
		$aImg['highlight_2'] = A::str($row, 'highlight_img_2') ;
		$aImg['highlight_3'] = A::str($row, 'highlight_img_3') ;
		$aImg['highlight_4'] = A::str($row, 'highlight_img_4') ;
		
		$stmt->bindParam(':overview_img'		, $aImg['overview'] );
		$stmt->bindParam(':overview_foot_img'	, $aImg['overview_foot'] );
		$stmt->bindParam(':item_img'			, $aImg['item'] );
		$stmt->bindParam(':item_over_img'		, $aImg['item_over'] );
		$stmt->bindParam(':highlight_img_1'		, $aImg['highlight_1'] );
		$stmt->bindParam(':highlight_img_2'		, $aImg['highlight_2'] );
		$stmt->bindParam(':highlight_img_3'		, $aImg['highlight_3'] );
		$stmt->bindParam(':highlight_img_4'		, $aImg['highlight_4'] );
		
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
				$filename =  microtime(true).rand(1,1000).$k.'.'.$ext ;

				if(is_file($_SERVER['DOCUMENT_ROOT'].$aImg[$k]))
					unlink($_SERVER['DOCUMENT_ROOT'].$aImg[$k]);
				
				move_uploaded_file($tmp_name, $path.'/'.$filename);
				// bindParam 이다
				$aImg[$k] = $webpath.'/'.$filename ;
			}
		}
		
		if(isset($row['tab_use_bit']) && is_array($row['tab_use_bit']))
			$stmt->bindValue(':tab_use_bit'			,array_sum($row['tab_use_bit']) , PDO::PARAM_INT);
		else
			$stmt->bindValue(':tab_use_bit'			,0 , PDO::PARAM_INT);
		
		$stmt->bindValue(':tab_content_1'		,A::str($row, 'tab_content_1') );
		$stmt->bindValue(':tab_content_2'		,A::str($row, 'tab_content_2') );
		$stmt->bindValue(':tab_content_4'		,A::str($row, 'tab_content_4') );
		$stmt->bindValue(':tab_content_8'		,A::str($row, 'tab_content_8') );
		$stmt->bindValue(':tab_content_16'		,A::str($row, 'tab_content_16') );
		$stmt->bindValue(':tab_content_32'		,A::str($row, 'tab_content_32') );
		
		$stmt->bindValue(':editor_session_key'	, A::str($row, 'editor_session_key'));
		
		stmtExecute($stmt) ;
		
		if( !is_numeric($this->product_menu_idx) || $this->product_menu_idx < 1) 
			$this->product_menu_idx = db()->lastInsertId() ;
		
		return $this->product_menu_idx ;
	}
	
	function _insert()
	{
		$q = '
			INSERT INTO '.$this->db_product_item.'
			SET
				`product_menu_idx` = :product_menu_idx
			,	`overview_img` = :overview_img
			,	`overview_alt` = :overview_alt
			,	`overview_foot_img` = :overview_foot_img
			,	`overview_foot_alt` = :overview_foot_alt
			,	`item_img` = :item_img
			,	`item_alt` = :item_alt
			,	`item_over_img` = :item_over_img
			,	`item_over_alt` = :item_over_alt
			,	`highlight_img_1` = :highlight_img_1
			,	`highlight_alt_1` = :highlight_alt_1
			,	`highlight_img_2` = :highlight_img_2
			,	`highlight_alt_2` = :highlight_alt_2
			,	`highlight_img_3` = :highlight_img_3
			,	`highlight_alt_3` = :highlight_alt_3
			,	`highlight_img_4` = :highlight_img_4
			,	`highlight_alt_4` = :highlight_alt_4
			,	`icon_index` = :icon_index
			,	`tab_use_bit` = :tab_use_bit
			,	`tab_content_1` = :tab_content_1
			,	`tab_content_2` = :tab_content_2
			,	`tab_content_4` = :tab_content_4
			,	`tab_content_8` = :tab_content_8
			,	`tab_content_16` = :tab_content_16
			,	`tab_content_32` = :tab_content_32
			,	`reg_date` = :reg_date
			,	`editor_session_key` = :editor_session_key
		' ;
		
		return $q ;
	}
	
	
	function _update()
	{
		$q = '
			UPDATE '.$this->db_product_item.'
			SET
				`overview_img` = :overview_img
			,	`overview_alt` = :overview_alt
			,	`overview_foot_img` = :overview_foot_img
			,	`overview_foot_alt` = :overview_foot_alt
			,	`item_img` = :item_img
			,	`item_alt` = :item_alt
			,	`item_over_img` = :item_over_img
			,	`item_over_alt` = :item_over_alt
			,	`highlight_img_1` = :highlight_img_1
			,	`highlight_alt_1` = :highlight_alt_1
			,	`highlight_img_2` = :highlight_img_2
			,	`highlight_alt_2` = :highlight_alt_2
			,	`highlight_img_3` = :highlight_img_3
			,	`highlight_alt_3` = :highlight_alt_3
			,	`highlight_img_4` = :highlight_img_4
			,	`highlight_alt_4` = :highlight_alt_4
			,	`icon_index` = :icon_index
			,	`tab_use_bit` = :tab_use_bit
			,	`tab_content_1` = :tab_content_1
			,	`tab_content_2` = :tab_content_2
			,	`tab_content_4` = :tab_content_4
			,	`tab_content_8` = :tab_content_8
			,	`tab_content_16` = :tab_content_16
			,	`tab_content_32` = :tab_content_32
			,	`editor_session_key` = :editor_session_key
			WHERE product_menu_idx = :product_menu_idx
		' ;
		
		return $q ;
	}
}

