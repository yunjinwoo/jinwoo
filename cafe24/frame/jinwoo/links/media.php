<?php 
require_once './_default.php';
require_once _PATH_lib_.'/Validator.c.php';
require_once _PATH_.'/editor/editor.f.php';
load('board'); 
load('vatech'); 

addPrintTitle('Media Center 관리');

if( !_LEVEL_4_ ){
	exitJs(_MSG_LEVEL_ERROR_, 'main.php');
}


$data = array() ;
$viewNo = G::get('view') ;
switch ($viewNo){
	case '09' :
		addPrintTitle('Socail Media(Youtube)');
		$data['lnb_index'] = 13 ;
		
		$fileIdx = G::get('file_idx') ;
		if(is_numeric($fileIdx) && $fileIdx > 0 )
			BoardFile::download ($fileIdx) ;
		
		$boardIdx = G::get('board_idx') ;		
		$aPostBoard = G::postArr('b') ;
		
		$BoardRow = new YoutubeBoardRow($boardIdx) ;
		if( count($aPostBoard) >= 1 )
		{
			$BoardRow->save($aPostBoard) ;
			h_location('?view=08') ;
		}
		
		$file_list = $BoardRow->rowFileList() ;
		$row = $BoardRow->row() ;
		$row['board_date'] = F::datetime(A::str($row,'board_date'),'Y-m-d H:i:s') ;
		
		$data['data_row'] = $row ;
		foreach($file_list as $k => $v )
		{
			if( $v['board_sub_name'] == 'pdf' ) {
				$data['data_file_pdf'] = $v ;
			}else{
				$data['is_file_data'] = true ;
				$data['data_file_list'][$k] = $v ;
			}
		}
	break ;
	case '08' :
		addPrintTitle('Socail Media(Youtube)');
		$data['lnb_index'] = 13 ;
		
		
		$BoardList = new YoutubeBoardList() ;
		$field = G::get('field') ;
		$keyword = G::get('keyword') ;
		if( !empty($keyword) && !empty($field) )
		{
			$data['keyword'] = $keyword ;
			switch ($field) {
				case  'title' : 
				$data['field_selected_title'] = ' selected="selected"' ;
					$BoardList->setSearch('board_title', $keyword) ;
				break ;
				case  'text' : 
				$data['field_selected_text'] = ' selected="selected"' ;
					$BoardList->setSearch('board_text', $keyword) ;				
				break ;
				case  'all' : 
				$data['field_selected_all'] = ' selected="selected"' ;
					$BoardList->setSearch('board_title', $keyword) ;
					$BoardList->setSearch('board_text', $keyword) ;				
				break ;
			}
		}
		
		$page = F::number(G::get('page'), 1) ;
		$data['page'] = $page ;
		$data['page_size'] = $BoardList->getInfoPageSize() ;
		$data['total_page_count'] = ceil($BoardList->getCount()/$BoardList->getInfoListSize()) ;
		
		$aList = $BoardList->getList($page) ;
		$del_idx = G::get('del_idx') ;
		if(is_numeric($del_idx))
		{
			$BoardRow = new YoutubeBoardRow($del_idx) ;
			$BoardRow->delete() ;
			h_location('?view=08') ;
		}
		
		$data['total_cnt'] = number_format($BoardList->getCount()) ;
		$data['data_list'] = $aList ;
	break ;
	case '07' :
		addPrintTitle('Testimonial');
		$data['lnb_index'] = 15 ;
		$fileIdx = G::get('file_idx') ;
		if(is_numeric($fileIdx) && $fileIdx > 0 )
			BoardFile::download ($fileIdx) ;
		
		$boardIdx = G::get('board_idx') ;		
		$aPostBoard = G::postArr('b') ;
		
		$BoardRow = new TestimonialBoardRow($boardIdx) ;
		if( count($aPostBoard) >= 1 )
		{
			$BoardRow->save($aPostBoard) ;
			h_location('?view=06') ;
		}
		
		$file_list = $BoardRow->rowFileList() ;
		$row = $BoardRow->row() ;
		$row['board_date'] = F::datetime(A::str($row,'board_date'),'Y-m-d H:i:s') ;
		
		$data['data_row'] = $row ;
		foreach($file_list as $k => $v )
		{
			if( $v['board_sub_name'] == 'pdf' )	{
				$data['data_file_pdf'] = $v ;
			}else{
				$data['is_file_data'] = true ;
				$data['data_file_list'][$k] = $v ;
			}
		}
	break ;
	case '06' : 
		addPrintTitle('Testimonial');
		$data['lnb_index'] = 15 ;
		
		
		$BoardList = new TestimoniaBoardList() ;
		$field = G::get('field') ;
		$keyword = G::get('keyword') ;
		if( !empty($keyword) && !empty($field) )
		{
			$data['keyword'] = $keyword ;
			switch ($field) {
				case  'title' : 
				$data['field_selected_title'] = ' selected="selected"' ;
					$BoardList->setSearch('board_title', $keyword) ;
				break ;
				case  'text' : 
				$data['field_selected_text'] = ' selected="selected"' ;
					$BoardList->setSearch('board_text', $keyword) ;				
				break ;
				case  'all' : 
				$data['field_selected_all'] = ' selected="selected"' ;
					$BoardList->setSearch('board_title', $keyword) ;
					$BoardList->setSearch('board_text', $keyword) ;				
				break ;
			}
		}
		
		$page = F::number(G::get('page'), 1) ;
		$data['page'] = $page ;
		$data['page_size'] = $BoardList->getInfoPageSize() ;
		$data['total_page_count'] = ceil($BoardList->getCount()/$BoardList->getInfoListSize()) ;
		
		$aList = $BoardList->getList($page) ;
		
		$del_idx = G::get('del_idx') ;
		if(is_numeric($del_idx))
		{
			$BoardRow = new TestimonialBoardRow($del_idx) ;
			$BoardRow->delete() ;
			h_location('?view=06') ;
		}
		
		$data['total_cnt'] = number_format($BoardList->getCount()) ;
		$data['data_list'] = $aList ;
	break ;
	case '05_01' : 
		addPrintTitle('Green Clinic Members');
		$data['lnb_index'] = 14 ;
		
		$PartnerRow = new GreenPartnerRow(G::get('part_idx')) ;
		
		$aPost = G::postArr('v');
		if(count($aPost) >= 1 ){
			$idx = $PartnerRow->save ($aPost);
			h_location('?view=05');
		}
		
		$data['data_row'] = $PartnerRow->row();
		
	break ;
	case '05' : 
		addPrintTitle('Green Clinic Members');
		$data['lnb_index'] = 14 ;
		
		$Partner = new GreenPartner();
		$data['data_list'] = $Partner->getList();
		
		$nDelIdx = G::get('del_idx');
		if(is_numeric($nDelIdx)){
			$PartnerRow = new GreenPartnerRow($nDelIdx) ;
			$PartnerRow->delete();
			h_location('?view=05');
		}
		
	break ;
	case '04' :
		addPrintTitle('Event');
		$data['lnb_index'] = 12 ;
		$fileIdx = G::get('file_idx') ;
		if(is_numeric($fileIdx) && $fileIdx > 0 )
			BoardFile::download ($fileIdx) ;
		
		$boardIdx = G::get('board_idx') ;		
		$aPostBoard = G::postArr('b') ;
		
		$BoardRow = new EventBoardRow($boardIdx) ;
		if( count($aPostBoard) >= 1 )
		{
			$BoardRow->save($aPostBoard) ;
			h_location('?view=03') ;
		}
		
		$file_list = $BoardRow->rowFileList() ;
		$row = $BoardRow->row() ;
		$row['board_date'] = F::datetime(A::str($row,'board_date'),'Y-m-d H:i:s') ;
		$row['board_start_date'] = F::date(A::str($row,'board_start_date'),'Y-m-d') ;
		$row['board_end_date'] = F::date(A::str($row,'board_end_date'),'Y-m-d',4) ;
		
		$data['data_row'] = $row ;
		$data['country_list'] = Code::getCode('country');
		
		foreach($file_list as $k => $v )
		{
			if( $v['board_sub_name'] == 'prev' ) {
				$data['data_file_pdf'] = $v ;
				unset($file_list[$k]);
			}else{
				$data['is_file_data'] = true ;
				$data['data_file_list'][$k] = $v ;
			}
		}
		$data['data_file_list'] = $file_list ;
		
	break ;
	case '03' :
		addPrintTitle('Event');
		$data['lnb_index'] = 12 ;
		
		console.log( print_r($data['data_main_list'], true ));
		
		$BoardList = new EventBoardList() ;
		$field = G::get('field') ;
		$keyword = G::get('keyword') ;
		if( !empty($keyword) && !empty($field) )
		{
			$data['keyword'] = $keyword ;
			switch ($field) {
				case  'title' : 
				$data['field_selected_title'] = ' selected="selected"' ;
					$BoardList->setSearch('board_title', $keyword) ;
				break ;
				case  'text' : 
				$data['field_selected_text'] = ' selected="selected"' ;
					$BoardList->setSearch('board_text', $keyword) ;				
				break ;
				case  'all' : 
				$data['field_selected_all'] = ' selected="selected"' ;
					$BoardList->setSearch('board_title', $keyword) ;
					$BoardList->setSearch('board_text', $keyword) ;				
				break ;
			}
		}
		
		$page = F::number(G::get('page'), 1) ;
		$data['page'] = $page ;
		$data['page_size'] = $BoardList->getInfoPageSize() ;
		$data['total_page_count'] = ceil($BoardList->getCount()/$BoardList->getInfoListSize()) ;
		
		$aList = $BoardList->getList($page) ;
		
		$del_idx = G::get('del_idx') ;
		if(is_numeric($del_idx))
		{
			$BoardRow = new EventBoardRow($del_idx) ;
			$BoardRow->delete() ;
			h_location('?view=03') ;
		}		
		
		$data['total_cnt'] = number_format($BoardList->getCount()) ;
		$data['data_list'] = $aList ;
	break ;
	case '02' :
		addPrintTitle('News');
		$data['lnb_index'] = 11 ;
		$fileIdx = G::get('file_idx') ;
		if(is_numeric($fileIdx) && $fileIdx > 0 )
			BoardFile::download ($fileIdx) ;
		
		$boardIdx = G::get('board_idx') ;		
		$aPostBoard = G::postArr('b') ;
		
		$BoardRow = new NewsBoardRow($boardIdx) ;
		
		if( count($aPostBoard) >= 1 )
		{
			$BoardRow->save($aPostBoard) ;
			h_location('?view=01') ;
		}
		
		$file_list = $BoardRow->rowFileList() ;
		$row = $BoardRow->row() ;
		$row['board_date'] = F::datetime(A::str($row,'board_date'),'Y-m-d H:i:s') ;
		
		$data['data_row'] = $row ;
		$data['data_file_list'] = $file_list ;
	break ;
	case '01' : default:
		$viewNo = '01' ;
		addPrintTitle('News');
		$data['lnb_index'] = 11 ;
		
		$BoardList = new NewsBoardList() ;
		$field = G::get('field') ;
		$keyword = G::get('keyword') ;
		if( !empty($keyword) && !empty($field) )
		{
			$data['keyword'] = $keyword ;
			switch ($field) {
				case  'title' : 
				$data['field_selected_title'] = ' selected="selected"' ;
					$BoardList->setSearch('board_title', $keyword) ;
				break ;
				case  'text' : 
				$data['field_selected_text'] = ' selected="selected"' ;
					$BoardList->setSearch('board_text', $keyword) ;				
				break ;
				case  'all' : 
				$data['field_selected_all'] = ' selected="selected"' ;
					$BoardList->setSearch('board_title', $keyword) ;
					$BoardList->setSearch('board_text', $keyword) ;				
				break ;
			}
		}


		$page = F::number(G::get('page'), 1) ;
		$data['page'] = $page ;
		$data['page_size'] = $BoardList->getInfoPageSize() ;
		$data['total_page_count'] = ceil($BoardList->getCount()/$BoardList->getInfoListSize()) ;
		
		$aList = $BoardList->getList($page) ;
		
		$del_idx = G::get('del_idx') ;
		if(is_numeric($del_idx))
		{
			$BoardRow = new NewsBoardRow($del_idx) ;
			$BoardRow->delete() ;
			h_location('?view=01') ;
		}
		
		$data['total_cnt'] = number_format($BoardList->getCount()) ;
		$data['data_list'] = $aList ;
		$data['notice_list'] = $BoardList->getNoticeList($page) ;
	break ;
}

$data['view'] = $viewNo ;


layoutAdmin( a_path('media_'.$viewNo) , $data ) ;