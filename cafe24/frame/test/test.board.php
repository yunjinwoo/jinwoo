<?php
require_once '../_define.php';
require_once _PATH_lib_.'/Validator.c.php';
require_once _PATH_.'/editor/editor.f.php';
load('board'); 
/*
		$data['title'] = 'News' ;
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
		}*/


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

$data['data_list'] = $BoardList->getList($page) ;
pre( $data['data_list'] );