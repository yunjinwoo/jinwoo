<?php 
/**
 * PC-mobile 타이틀 구분용
 */
define('_IS_MOBILE_', true);
require_once './_default.php';
require_once _PATH_lib_.'/Validator.c.php';

if( !_LEVEL_128_ ){
	exitJs(_MSG_LEVEL_ERROR_, 'main.php');
}

load('category'); // 01 type
load('product'); 
load('banner'); // 02 type

addPrintTitle('Product 관리');

$viewNo = G::get('view') ;

// view 
$data = array() ;
switch ($viewNo){
	case '03' : 		
		$data['lnb_index'] = 4 ;
		addPrintTitle('제품 등록');
		
		load('editorFile');
		load('vatech');
		
		$cate_idx = G::get('cate_idx');
		$menu_idx = G::get('menu_idx');
		$item_idx = G::get('item_idx');
		
		$data['cate_idx'] = $cate_idx ;
		$data['menu_idx'] = $menu_idx ;
		$data['item_idx'] = $item_idx ;
				
		
		$Category = new Category ;
		$aCateList = $Category->getProductCode() ;			
		$data['category_list'] = $aCateList ;
		
		$nItemIdx = F::number(G::get('item_idx')) ;
		$ProductItemRow = new ProductItemRowMobile($nItemIdx) ;
		
		$aPost = G::postArr('p') ;
		if( count($aPost) >= 1 )
		{
			
			if( G::post('del_file') == 'on' )
			{
				$path = $_SERVER['DOCUMENT_ROOT'].'/'.$aPost['item_img'];
				if(is_file($path)) unlink($path);
				
				$aPost['item_img'] = '';
			}
					
			$item_idx = $ProductItemRow->save($aPost) ;
			h_location('?view=02') ;
		}
		$del_idx = G::get('del_idx') ;
		if(is_numeric($del_idx) )
		{
			$ProductItemRow->delete_mb($del_idx) ;
			h_location('?view=02') ;
		}
		
		$data['code_data'] = Code::getCode('product');
		$data['data_row'] = $ProductItemRow->row() ;
		
		$data['category_list'] = Code::getCode('mobile_category_code');
		
	break ;
	case '02' : 		
		$data['lnb_index'] = 3 ;
		addPrintTitle('제품 목록');
		
		$ProductList = new ProductItemListMobile() ;		
		
		$page = F::number(G::get('page'), 1) ;
		$data['page'] = $page ;
		$data['page_size'] = $ProductList->getInfoPageSize() ;
		$data['total_cnt'] = $ProductList->getCount();
		$data['total_page_count'] = ceil($data['total_cnt']/$ProductList->getInfoListSize()) ;
		
		$cateIdx = G::get('cate_idx');
		if( is_numeric($cateIdx) ){
			$ProductList->setMobileCategory($cateIdx);
		}
		
		
		$data['data_list'] = $ProductList->getList($page) ;
		$data['category_list'] = Code::getCode('mobile_category_code');
		
	break ;
	case '01' :
	default :
		$viewNo = '01' ;
		$data['lnb_index'] = 2 ;
		addPrintTitle('제품 관리');
		
		
		$data['category_list'] = Code::getCode('mobile_category_code');
		
		$ProductList = new ProductItemListMobile() ;
		$ProductMenuMobile = new productMenuMobile;
		for( $i = 1 ; $i < 5 ; $i++ )
		{
			$tmp = $ProductMenuMobile->getList($i);
			
			$data['data_'.$i.'_list'] = $tmp ;			
			$data['data_'.$i.'_url'] = $ProductList->getCodeAllList($i) ; ;
		}
		
		
		$aPost = G::postArr('product_mobile_idx');
		if( count($aPost) >= 12 )
		{
			$path = _PATH_data_.'/banner' ;
			$webpath = _WEB_PATH_DATA_.'/banner' ;

			foreach( $aPost as $k => $v )
			{
				$row = array() ;
				$row['image_path'] = G::postArrFind('image_path', $k);
				$row['image_alt'] = G::postArrFind('image_alt', $k);
				$row['link_str'] = G::postArrFind('link_str', $k);
				$row['image_path'] = G::postArrFind('image_path', $k);
				$row['menu_mobile_idx'] = $k;
				
				if( is_uploaded_file($_FILES['file']['tmp_name'][$k]) )
				{
					$tmp_name = $_FILES['file']['tmp_name'][$k] ;
					
					$name = $_FILES['file']['name'][$k] ;
					$size = $_FILES['file']['size'][$k] ;
					$type = $_FILES['file']['type'][$k] ;
					
					$a = explode('.',$name) ;
					$ext = array_pop($a) ;
					$filename =  'mobile_list_'.$k.'.'.$ext ;

					if(is_file($path.'/'.$filename))
						unlink($path.'/'.$filename);

					move_uploaded_file($tmp_name, $path.'/'.$filename);
					$row['image_path'] = $webpath.'/'.$filename ;
				}
				
				$ProductMenuMobile->save($row);
			}
			h_location('?view=01');
		}
		
		$del_product_idx = G::get('del_product_idx');
		if(is_numeric($del_product_idx))
		{
			$ProductMenuMobile->deleteEmpty($del_product_idx);
			h_location('?view=01');
		}
	break ;
}

layoutMoblieAdmin( a_m_path('product_'.$viewNo) , $data ) ;


