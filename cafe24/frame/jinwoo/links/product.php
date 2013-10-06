<?php 
require_once './_default.php';
require_once _PATH_lib_.'/Validator.c.php';
load('category'); // 01 type
load('product'); 
load('banner'); // 02 type

addPrintTitle('제품 관리');

if( !_LEVEL_4_ ){
	exitJs(_MSG_LEVEL_ERROR_, 'main.php');
}


$data = array() ;
$viewNo = G::get('view') ;
switch ($viewNo){
	case '03' : 
		addPrintTitle('제품 아이콘 관리');
		$data['lnb_index'] = 10 ;
		$data['banner_type'] = 'product_icon' ;
		$banner = new BannerManager() ;
		
		$sSort = G::get('sort') ;
		$banner_idx = G::get('banner_idx') ;
		if(!empty($sSort) && is_numeric($banner_idx)) {
			switch ($sSort){
				case 'up' : $banner->sortUp($banner_idx) ;		break ;
				case 'down' : $banner->sortDown($banner_idx) ;	break ;			
			}
			h_location ('?view=03') ;
		}
		
		$cnt = $banner->fileUpload_GLOBAL($data['banner_type']) ;
		if( $cnt > 0 ) h_location ('?view=03') ;
		
		$delete_banner_idx = G::get('del_idx') ;
		if(is_numeric($delete_banner_idx)){
			$banner->delete($delete_banner_idx);
			h_location ('?view=03') ;
		}
			
		
		$aList = $banner->getBannerList($data['banner_type']) ;		
		$data['data_list'] = $aList ;
	break ;
	case '02' : 
		load('editorFile');
		load('vatech');
		addPrintTitle('제품 등록');
		
		$cate_idx = G::get('cate_idx');
		$menu_idx = G::get('menu_idx');
		$item_idx = G::get('item_idx');
		
		$data['cate_idx'] = $cate_idx ;
		$data['menu_idx'] = $menu_idx ;
		$data['item_idx'] = $item_idx ;
				
		$data['lnb_index'] = 9 ;
		
		$Category = new Category ;
		$aCateList = $Category->getProductCode() ;	
		
		$data['category_list'] = $aCateList ;
		$nItemIdx = F::number(G::get('item_idx')) ;
		$ProductItemRow = new ProductItemRow($nItemIdx) ;
		
		$aPost = G::postArr('p') ;
		if( count($aPost) >= 1 )
		{
			$delFile = G::postArr('del_file');
			foreach($delFile as $k => $v )
			{
				if( $v == 'on')
				{					
					$path = $_SERVER['DOCUMENT_ROOT'].'/'.$aPost[$k];
					if(is_file($path)) unlink($path);

					$aPost[$k] = '';
				}
			}
			
			$item_idx = $ProductItemRow->save($aPost) ;
			h_location('?view=02&item_idx='.$item_idx.'&menu_idx='.$menu_idx.'&cate_idx='.$cate_idx) ;
		}

		$nDeleteItemIdx = G::get('del_item_idx');
		if( is_numeric($nDeleteItemIdx) )
		{
			$ProductItemRow = new ProductItemRow($nDeleteItemIdx);
			$ProductItemRow->delete();
			h_location('?view=01');
		}
		
		$data['code_data'] = Code::getCode('product');
		$data['data_row'] = $ProductItemRow->row() ;
		
	break ;
	case '01' : default:
		$viewNo = '01' ;
		addPrintTitle('제품 목록');
		$data['lnb_index'] = 8 ;
		
		$Category = new Category ;		
		$data['category_list'] = $Category->getProductCode() ;
		
		$cateIdx = G::get('cate_idx');
		$findIdx = G::get('find_idx');
		if(is_numeric($cateIdx))
		{
			$ProductMenu = new ProductMenu($cateIdx) ;
			$tmp = $ProductMenu->getMenuList();
			
			
			if( count($tmp) >= 1 )
			{
				$str = chr(13).'<option value="">선택</option>' ;
				foreach( $tmp as $row ){
					$selected = $findIdx == $row['menu_idx'] ? 'selected="selected"' : '' ;
					$str .= chr(13).'<option value="'.$row['menu_idx'].'" '.$selected.'>'.$row['menu_name'].'</option>' ;
				}
			}
			$data['product_menu_str'] = $str;
		}
		
		
		$ProductList = new ProductItemList ;
		if(is_numeric($cateIdx)){ $ProductList->setCateIdxWhere($cateIdx) ;}
		if(is_numeric($findIdx)){ $ProductList->setFindIdxWhere($findIdx) ;}		
		
		$page = F::number(G::get('page'), 1) ;
		$data['page'] = $page ;
		$data['page_size'] = $ProductList->getInfoPageSize() ;
		$data['total_cnt'] = $ProductList->getCount();
		$data['total_page_count'] = ceil($data['total_cnt']/$ProductList->getInfoListSize()) ;
		
		
		$data['data_list'] = $ProductList->getList($page) ;
		
	break ;
}



layoutAdmin( a_path('product_'.$viewNo) , $data ) ;