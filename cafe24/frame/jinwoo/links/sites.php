<?php 
require_once './_default.php';
require_once _PATH_lib_.'/Validator.c.php';
load('category'); // 01 type
load('product'); 
load('banner'); // 02 type

addPrintTitle('Site 관리');

/*@@@ 추후 작업
삭제는 상품 등록 후 추후에 다시...
키가 문제가 있을꺼다 !!!
 */


if( !_LEVEL_2_ ){
	exitJs(_MSG_LEVEL_ERROR_, 'main.php');
}

function siteHref01($cateIdx='',$menuIdx='',$parent_idx='' )
{
	$str = 'sites.php?view=01' ;
	if(is_numeric($cateIdx)) $str .= '&cate_idx='.$cateIdx;
	if(is_numeric($menuIdx)) $str .= '&menu_idx='.$menuIdx;
	if(is_numeric($parent_idx)) $str .= '&parent_idx='.$parent_idx;
	
	return $str ;
}


$data = array() ;
$viewNo = G::get('view') ;


switch ($viewNo){
	case '06' : 
		addPrintTitle('OverView 상단 관리');
		$data['lnb_index'] = 7 ;
		
		$banner = new BannerManager() ;
		
		$sSort = G::get('sort') ;
		$banner_idx = G::get('banner_idx') ;
		if(!empty($sSort) && is_numeric($banner_idx)) {
			switch ($sSort){
				case 'up' : $banner->sortUp($banner_idx) ;		break ;
				case 'down' : $banner->sortDown($banner_idx) ;	break ;			
			}
			h_location ('?view=06') ;
		}
		
		$data['banner_type1'] = 'overview_1' ;
		$data['data_list1'] = $banner->getOverview1List() ;	
		
		$data['banner_type2'] = 'overview_2' ;
		$data['data_list2'] = $banner->getOverview2List() ;			
		
		if( $banner->fileUpload_GLOBAL($data['banner_type1']) > 0 ) h_location ('?view=06') ;
		if( $banner->fileUpload_GLOBAL($data['banner_type2'],'image',2) > 0 ) h_location ('?view=06') ;
		
		
		$del_banner_idx = G::get('del_banner_idx') ;
		if(is_numeric($del_banner_idx)){
			$banner->delete ($del_banner_idx);
			h_location('?view=06');
		}
			
		
	break;
	case '05' : 
		addPrintTitle('Worldwide VATECH 관리');
		$data['lnb_index'] = 6 ;
		$data['banner_type'] = 'world' ;
		$banner = new BannerManager() ;
		
		$sSort = G::get('sort') ;
		$banner_idx = G::get('banner_idx') ;
		if(!empty($sSort) && is_numeric($banner_idx)) {
			switch ($sSort){
				case 'up' : $banner->sortUp($banner_idx) ;		break ;
				case 'down' : $banner->sortDown($banner_idx) ;	break ;			
			}
			h_location ('?view=05') ;
		}
		
		$cnt = $banner->fileUpload_GLOBAL($data['banner_type']) ;
		if( $cnt > 0 ) h_location ('?view=05') ;
		
		$delete_banner_idx = G::get('del_idx') ;
		if(is_numeric($delete_banner_idx)){
			$banner->delete($delete_banner_idx);
			h_location ('?view=05') ;
		}
			
		
		$aList = $banner->getBannerList($data['banner_type']) ;		
		$data['data_list'] = $aList ;	
	break;
	case '04' : // IP 관리
		addPrintTitle('메인 제품 관리');
		$data['lnb_index'] = 5 ;
		$data['banner_type'] = 'main' ;
		$banner = new BannerManager() ;
		$cnt = $banner->fileUpload_GLOBAL($data['banner_type']) ;
		if( $cnt > 0 )
			h_location ('?view=04') ;
		
		$aList = $banner->getMainList() ;		
		$data['data_list'] = $aList ;	
	break;
	case '03' : 
		addPrintTitle('메인 비주얼 관리');
		$data['lnb_index'] = 4 ;
		$data['banner_type'] = 'main_visual' ; //
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
		if( $cnt > 0 )
			h_location ('?view=03') ;
		
		$aList = $banner->getMainVisualList() ;		
		$data['data_list'] = $aList ;
	break;
	case '02' : 
		addPrintTitle('GNB 이미지 관리');
		$data['lnb_index'] = 3 ;
		$data['banner_type'] = 'gnb' ;
		$banner = new BannerManager() ;
		$cnt = $banner->fileUpload_GLOBAL($data['banner_type']) ;
		if( $cnt > 0 )
			h_location ('?view=02') ;
		
		$aList = $banner->getGnbList() ;		
		$data['data_list'] = $aList ;		
	break;
	case '01' : // 운영자 리스트
	default :
		addPrintTitle('제품 카테고리 관리');
		$data['lnb_index'] = 2 ;

		$cateIdx = F::number(G::get('cate_idx'),0) ;
		$menuIdx = F::number(G::get('menu_idx'),0) ;
		$parentIdx = F::number(G::get('parent_idx'),$menuIdx) ;
		
		$viewNo = '01' ;
		
		$Category = new Category ;
		$aCateList = $Category->getProductCode() ;		
		
		// 카테고리 번호가 없으면 필터링
		if( $cateIdx <= 0 ){
			list($idx , $row ) = each($aCateList) ;
			h_location (siteHref01($idx)) ;
		}
		
		
		// action
		$sSort = G::get('sort') ;
		if(!empty($sSort) && is_numeric($menuIdx))
		{
			switch ($sSort)
			{
				case 'up' : 
					$ProductMenu = new ProductMenu() ;
					$ProductMenu->sortUp($menuIdx) ;
				break ;
				case 'down' : 
					$ProductMenu = new ProductMenu() ;
					$ProductMenu->sortDown($menuIdx) ;
				break ;			
			}
			
			h_location (siteHref01($cateIdx,$menuIdx,$parentIdx)) ;
		}
		$aPostPc = G::postArr('pc') ;
		if( count($aPostPc) >= 1 )
		{
			$nPostIdx = F::number($aPostPc['menu_idx'],0) ;
			if( $nPostIdx <= 0 )// 추가
			{
				db()->beginTransaction() ;
				$ProductCategroy = new ProductCategory;
				$proCateIdx = $ProductCategroy->insert($cateIdx, '처음엔안씀', $aPostPc['cate_proc_name'], $aPostPc['use_y_n']) ;

				$ProductMenu = new ProductMenu() ;
				if( false === ($nPostIdx = $ProductMenu->insert($cateIdx, $parentIdx, $proCateIdx, $aPostPc['cate_proc_name'], $aPostPc['use_y_n']) ) ){
					db()->rollBack() ;
					die(_MSG_DB_ERROR_1_.'['.$ProductMenu->log.']') ;
				}
				
				db()->commit() ;
			}else{
				// 수정
				$ProductMenu = new ProductMenu() ;
				$ProductMenu->update($nPostIdx, $aPostPc['cate_proc_name'], $aPostPc['use_y_n']);
			}
			
			h_location(siteHref01($cateIdx,$nPostIdx,$parentIdx));
		}
		$nDeleteIdx = F::number(G::get('delete'),0) ;
		if( $nDeleteIdx > 0 ) {// 삭제
			$ProductMenu = new ProductMenu() ;
			$ProductMenu->delete($nDeleteIdx);
			
			// 메뉴 삭제시 상품도 삭제된다.
			$ProductItemRow = new ProductItemRow($nDeleteIdx) ;
			$ProductItemRow->delete();
			
			h_location(siteHref01($cateIdx,'',$parentIdx));
		}
		
		// action end 
		
		
		$ProductMenu = new ProductMenu($cateIdx,$parentIdx) ;
		$aMenuList = $ProductMenu->getMenuList() ;
		$aSubMenuList = $ProductMenu->getSubMenuList() ;

		$data['category'] = $aCateList ;
		$data['menu_title'] = $aCateList[$cateIdx]['category_name'] ;
		$data['menu_list'] = $aMenuList ;
		
		$data['menu_sub_title'] = '' ;
		$data['menu_sub_list'] = '' ;
		if( isset($aMenuList[$parentIdx]['menu_name']) )
		{
			$data['menu_sub_title'] = $aMenuList[$parentIdx]['menu_name'] ;
			$data['menu_sub_list'] = $aSubMenuList ;
		}
		
		 
		if( !empty($menuIdx) && isset($aMenuList[$menuIdx]) && is_array($aMenuList[$menuIdx]) )
		{
			if( $aMenuList[$menuIdx]['use_y_n'] == 'Y' ) $aMenuList[$menuIdx]['use_y_n_1checked'] = 'checked="checked"' ;
			if( $aMenuList[$menuIdx]['use_y_n'] == 'N' ) $aMenuList[$menuIdx]['use_y_n_2checked'] = 'checked="checked"' ;
			
			$data['menu_row'] = $aMenuList[$menuIdx] ;
		}else if(isset($aSubMenuList[$menuIdx]) && is_array($aSubMenuList[$menuIdx]) )
		{
			if( $aSubMenuList[$menuIdx]['use_y_n'] == 'Y' ) $aSubMenuList[$menuIdx]['use_y_n_1checked'] = 'checked="checked"' ;
			if( $aSubMenuList[$menuIdx]['use_y_n'] == 'N' ) $aSubMenuList[$menuIdx]['use_y_n_2checked'] = 'checked="checked"' ;
			
			$data['menu_row'] = $aSubMenuList[$menuIdx] ;
		}
		
		$data['cate_idx'] = $cateIdx ;
		$data['menu_idx'] = $menuIdx ;
		$data['parent_idx'] = $parentIdx ;
		
	break ;
}

layoutAdmin( a_path('sites_'.$viewNo) , $data ) ;