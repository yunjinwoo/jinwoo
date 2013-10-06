<?php 
require_once './_default.php';
require_once _PATH_lib_.'/Validator.c.php';
load('vatech'); // 01 type

addPrintTitle('회사정보 관리');

if( !_LEVEL_16_ ){
	exitJs(_MSG_LEVEL_ERROR_, 'main.php');
}

$data = array() ;
$viewNo = G::get('view') ;

function cssTag($href)
{
	return '<link rel="stylesheet" type="text/css" href="'.$href.'" />';
}
function jsTag($src)
{
	return '<script type="text/javascript" src="'.$src.'"></script>';
}
switch ($viewNo){
	
	case '06-1' : // About VATECH Global
		$viewNo = '06-1'; 
		load('editorFile');
		load('vatech');
		
		addPrintTitle('VATECH Networks');
		add_head_tag(jsTag('../js/networks.js'));
		$data['lnb_index'] = 19 ;
		
		$Networks = new Networks;
		$data['list_cnt'] = $Networks->getCount();
		$NetworksRow = new NetworksRow(G::get('network_idx'));
		
		if(G::get('delete') == 'on' ){
			$NetworksRow->delete ();
			h_location('?view=06');
		}	
		
		$aPost = G::postArr('v');
		if(count($aPost)>=4){
			$NetworksRow->save($aPost);
		//	h_location('?view=06');
		}
		
		$data['data_row'] = $NetworksRow->row();
		
	break ;
	
	case '06' : // About VATECH Global
		$viewNo = '06'; 
		load('editorFile');
		load('pageMake');
		require_once _PATH_lib_.'/html.c.php';
		
		add_head_tag(jsTag('../js/networks.js'));
		
		addPrintTitle('VATECH Networks');
		$data['lnb_index'] = 19 ;
		$PageMake = new PageMake('info_net') ;
		
		$aPost = G::postArr('p') ;
		if( isset($aPost['page_text'])){
			$PageMake->setPageText($aPost['page_text']) ;
			h_location('?view=06') ;
		}
		
		$data['data_row'] = $PageMake->getPageRow();
		
		$Netword = new Networks;
		$data['data_list'] = $Netword->getList();
	break ;
	case '05' : // Business Partners
		addPrintTitle('Business Partners');
		$data['title'] = '' ;
		$data['lnb_index'] = 18 ;
		
		$data['code_list'] = Code::getCode('partners');
		$PartnerRow = new PartnerRow(G::get('part_idx')) ;
		
		$aPost = G::postArr('v');
		if(count($aPost) >= 1 ){
			$idx = $PartnerRow->save ($aPost);
			h_location('?view=04');
		}
		
		$data['data_row'] = $PartnerRow->row();
	break;
	case '04' : // Business Partners
		addPrintTitle('Business Partners');
		$data['lnb_index'] = 18 ;
		$Partner = new Partner(G::get('code_key'));
		$data['data_list'] = $Partner->getList();
		
		$nDelIdx = G::get('del_idx');
		if(is_numeric($nDelIdx)){
			$PartnerRow = new PartnerRow($nDelIdx) ;
			$PartnerRow->delete();
			h_location('?view=04');
		}
		$data['code_list'] = Code::getCode('partners');
	break;
	case '03' : // Overseas Subsidiary
		addPrintTitle('Overseas Subsidiary');
		$data['lnb_index'] = 17 ;
		
		$data['code_list'] = Code::getCode('subsidiary');
		$SubsidiaryRow = new SubsidiaryRow(G::get('sub_idx')) ;
		
		$aPost = G::postArr('v');
		if(count($aPost) >= 1 ){
			$idx = $SubsidiaryRow->save ($aPost);
			h_location('?view=02');
		}
		
		$data['data_row'] = $SubsidiaryRow->row();
	break;
	case '02' : // Overseas Subsidiary
		load('editorFile');
		load('pageMake');
		addPrintTitle('Overseas Subsidiary');
		$data['lnb_index'] = 17 ;
		
		$Subsidiary = new Subsidiary(G::get('code_key'));
		$data['data_list'] = $Subsidiary->getList();
		
		$nDelIdx = G::get('del_idx');
		if(is_numeric($nDelIdx)){
			$SubsidiaryRow = new SubsidiaryRow($nDelIdx) ;
			$SubsidiaryRow->delete();
			h_location('?view=02');
		}
		
		$PageMake = new PageMake('info_overseas') ;
		
		$aPost = G::postArr('p') ;
		if( isset($aPost['page_text'])){
			$PageMake->setPageText($aPost['page_text']) ;
			h_location('?view=02') ;
		}
		
		$data['data_row'] = $PageMake->getPageRow();
		
		$data['code_list'] = Code::getCode('subsidiary');
	break;
	case '01' : // About VATECH Global
	default :
		$viewNo = '01'; 
		load('editorFile');
		load('pageMake');
		addPrintTitle('About Vatech Global');
		$data['lnb_index'] = 16 ;
		$PageMake = new PageMake('info') ;
		
		$aPost = G::postArr('p') ;
		if( isset($aPost['page_text'])){
			$PageMake->setPageText($aPost['page_text']) ;
			h_location('?view=01') ;
		}
		
		$data['data_row'] = $PageMake->getPageRow();
	break ;
}


layoutAdmin( a_path('info_'.$viewNo) , $data ) ;