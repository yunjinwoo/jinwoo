<?php 
require_once './_default.php';
require_once _PATH_lib_.'/Validator.c.php';
load('vatech'); // 01 type

if( !_LEVEL_32_ ){
	exitJs(_MSG_LEVEL_ERROR_, 'main.php');
}

$data = array() ;
$viewNo = G::get('view') ;

switch ($viewNo){
	case '03' : // About VATECH Global
		$viewNo = '03'; 
		$include_path = 'info_07'; 
		load('editorFile');
		load('pageMake');
		addPrintTitle('Privacy Policy');
		$data['lnb_index'] = 20 ;
		$PageMake = new PageMake('primary_info') ;
		
		$aPost = G::postArr('p') ;
		if( isset($aPost['page_text'])){
			$PageMake->setPageText($aPost['page_text']) ;
			h_location('?view=03') ;
		}
		
		$data['data_row'] = $PageMake->getPageRow();
	break ;
	
	case '02' : // About VATECH Global
		$include_path = 'inquiry_02'; 
		addPrintTitle('문의 관리');
		$data['lnb_index'] = 21 ;
		
		$us_idx = G::get('us_idx');
		
		$data['customer'] = G::get('customer');
		$data['purpose'] = G::get('purpose');
		$data['country'] = G::get('country');
		
		
		$data['customer_list'] = Code::getCode('contant_customer');
		$data['purpose_list'] = Code::getCode('contant_purpose');
		
		$Contact = new Contact();
		$data['data_row'] = $Contact->row($us_idx) ;
		
		$tmp = array() ;
		foreach( $data['customer_list'] as $bit_key => $bit_r )
			if( $bit_key & $data['data_row']['customer_bit'] )
				$tmp[] = $bit_r['code_value'] ;
		$data['data_row']['customer'] = implode( ', ', $tmp) ;

		$tmp = array() ;
		foreach( $data['purpose_list'] as $bit_key => $bit_r )
			if( $bit_key & $data['data_row']['purpose_bit'] )
				$tmp[] = $bit_r['code_value'] ;
		$data['data_row']['purpose'] = implode( ', ', $tmp) ;
	break ;
	case '01' : // About VATECH Global
	default :
		$include_path = 'inquiry_01'; 
		addPrintTitle('문의 관리');
		$data['lnb_index'] = 21 ;
		
		$data['customer'] = G::get('customer');
		$data['purpose'] = G::get('purpose');
		$data['country'] = G::get('country');
		
		$data['keyword'] = G::get('keyword');
		
		
		
		$Contact = new Contact();
		$del_idx = G::get('del_idx');
		if( is_numeric($del_idx) )
		{
			$Contact->delete($del_idx);
			h_location('?');
		}
		
		$Contact->setCustomer($data['customer']) ;
		$Contact->setPurpose($data['purpose']) ;
		$Contact->setCountry($data['country']) ;
		
		$data['customer_list'] = Code::getCodeKV('contant_customer');
		$data['purpose_list'] = Code::getCodeKV('contant_purpose');
		
		if( ($customer = array_search($data['keyword'], $data['customer_list'])) === false )
			$Contact->setCustomer($customer) ;
		if( ($purpose = array_search($data['keyword'], $data['purpose_list'])) === false )
			$Contact->setPurpose($purpose) ;
		if( !empty($data['keyword']) )
		{
			$Contact->setSearch('name', $data['keyword']);
			$Contact->setSearch('phone', $data['keyword']);
			$Contact->setSearch('email', $data['keyword']);
			$Contact->setSearch('title', $data['keyword']);
			$Contact->setSearch('text', $data['keyword']);
		}
		
		
		$data['list_count'] = number_format($Contact->getCount());
		
		$page = F::number(G::get('page'), 1) ;
		$data['page'] = $page ;
		$data['page_size'] = $Contact->getInfoPageSize() ;
		$data['total_page_count'] = ceil($Contact->getCount()/$Contact->getInfoListSize()) ;
		
		$data['data_list'] = $Contact->getList($page) ;
		foreach($data['data_list'] as $k => $r )
		{
			$tmp = array() ;
			foreach( $data['customer_list'] as $bit_key => $bit_r )
				if( $bit_key & $r['customer_bit'] )
					$tmp[] = $bit_r ;
			$r['customer'] = implode( '<br />', $tmp) ;
			
			$tmp = array() ;
			foreach( $data['purpose_list'] as $bit_key => $bit_r )
				if( $bit_key & $r['purpose_bit'] )
					$tmp[] = $bit_r ;
			$r['purpose'] = implode( '<br />', $tmp) ;
			
			$data['data_list'][$k] = $r ;
		}
		
		$data['country_list'] = $Contact->getCountry();
	break ;
}


layoutAdmin( a_path($include_path) , $data ) ;