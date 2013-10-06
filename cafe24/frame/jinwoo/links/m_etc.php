<?php 
/**
 * PC-mobile 타이틀 구분용
 */
define('_IS_MOBILE_', true);
require_once './_default.php';

$data = array() ;
$viewNo = G::get('view') ;


load('editorFile');
load('pageMake');

switch ($viewNo){
	case '02' : // About VATECH Global
		
if( !_LEVEL_512_ ){
	exitJs(_MSG_LEVEL_ERROR_, 'main.php');
}
		$include_path = 'inquiry'; 
		addPrintTitle('Contact us');
		$data['lnb_index'] = 6 ;
		$PageMake = new PageMake('m_contact_us') ;
		
		$aPost = G::postArr('p') ;
		if( isset($aPost['page_text'])){
			$PageMake->setPageText($aPost['page_text']) ;
			h_location('?view=01') ;
		}
		
		$data['data_row'] = $PageMake->getPageRow();
	break ;
	
	case '01' :
	default :
			
if( !_LEVEL_256_ ){
	exitJs(_MSG_LEVEL_ERROR_, 'main.php');
}

	$include_path = 'company'; 
	addPrintTitle('회사 관리');
	$data['lnb_index'] = 5 ;
	
	$PageMake = new PageMake('m_company') ;
	
	$aPost = G::postArr('p') ;
	if( isset($aPost['page_text'])){
		$PageMake->setPageText($aPost['page_text']) ;
		h_location('?view=02') ;
	}
	
	$data['data_row'] = $PageMake->getPageRow();
		
		
	break ;
}

layoutMoblieAdmin( a_m_path($include_path) , $data ) ;