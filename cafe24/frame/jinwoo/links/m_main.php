<?php 
/**
 * PC-mobile 타이틀 구분용
 */
define('_IS_MOBILE_', true);
require_once './_default.php';
require_once _PATH_lib_.'/Validator.c.php';

if( !_LEVEL_64_ ){
	exitJs(_MSG_LEVEL_ERROR_, 'main.php');
}
load('banner');
addPrintTitle('Main 관리');

$viewNo = G::get('view') ;

// view 
$data = array() ;
switch ($viewNo){
	
	case '02' : 		
		$data['lnb_index'] = 1 ;
		addPrintTitle('Worldwide VATECH 관리');
		$data['banner_type'] = 'mobile_world' ;
		$banner = new BannerManager() ;
		
		$sSort = G::get('sort') ;
		$banner_idx = G::get('banner_idx') ;
		if(!empty($sSort) && is_numeric($banner_idx)) {
			switch ($sSort){
				case 'up' : $banner->sortUp($banner_idx) ;		break ;
				case 'down' : $banner->sortDown($banner_idx) ;	break ;			
			}
			h_location ('?view=02') ;
		}
		
		$cnt = $banner->fileUpload_GLOBAL($data['banner_type']) ;
		if( $cnt > 0 ) h_location ('?view=02') ;
		
		$delete_banner_idx = G::get('del_idx') ;
		if(is_numeric($delete_banner_idx)){
			$banner->delete($delete_banner_idx);
			h_location ('?view=02') ;
		}
			
		
		$aList = $banner->getBannerList($data['banner_type']) ;		
		$data['data_list'] = $aList ;	
		
	break ;
	case '01' :
	default :
		$viewNo = '01' ;
		$data['lnb_index'] = 0 ;
		addPrintTitle('Main 제품 관리');
		
		$data['banner_type'] = 'mobile_main';
		$banner = new BannerManager();
		
		$sSort = G::get('sort');
		$banner_idx = G::get('banner_idx');
		if(!empty($sSort) && is_numeric($banner_idx)) {
			switch ($sSort){
				case 'up' : $banner->sortUp($banner_idx) ;		break ;
				case 'down' : $banner->sortDown($banner_idx) ;	break ;			
			}
			h_location ('?view=01') ;
		}
		
		$cnt = $banner->fileUpload_GLOBAL($data['banner_type']) ;
		if( $cnt > 0 )
			h_location ('?view=01') ;
		
		$del_banner_idx = G::get('del_banner_idx') ;
		if(is_numeric($del_banner_idx)){
			$banner->delete ($del_banner_idx);
			h_location('?view=01');
		}
		
		$ProductList = new ProductItemListMobile;
		$data['data_url'] = array();
		for( $i = 1 ; $i < 5 ; $i++ )
		{
			$tmp = $ProductList->getCodeAllList($i) ; ;
			$data['data_url'] = array_merge($data['data_url'], $tmp);
		}
		
		
		
		$aList = $banner->getMainMobileList() ;		
		$data['data_list'] = $aList ;
	break ;
}

layoutMoblieAdmin( a_m_path('main_'.$viewNo) , $data ) ;


