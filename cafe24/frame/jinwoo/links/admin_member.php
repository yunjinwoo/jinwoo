<?php 
require_once './_default.php';
require_once _PATH_lib_.'/Validator.c.php';

addPrintTitle('관리자 설정');
if( !_LEVEL_1_ ){
	exitJs(_MSG_LEVEL_ERROR_, 'main.php');
}

$viewNo = G::get('view') ;
$actionCode = G::get('act') ;

$admin = new AdminMember ;
$Session = new SessionAdmin ;

// action
switch ($actionCode){
	case 'delete' :
		$deleteId = G::get('id') ;
		if( $deleteId == $Session->getUserid() )
			exitJs (_MSG_MEMBER_ERROR_DELETE_ ,'admin_member.php') ;
		$n = $admin->delete($deleteId) ;
		h_location('admin_member.php') ;
	break ;
	case 'insert' :
		$data = G::postArr('ad') ;
		if( count($data) <= 1 )
			break ;
		
		if( isset($data['admin_owner']) && is_array($data['admin_owner']) )
			$data['admin_owner'] = array_sum($data['admin_owner']) ;
		else
			$data['admin_owner'] = 0 ;
		
		$valid = array(
			'admin_id' => Validator::$required
		,	'admin_pw' => Validator::$required
		,	'admin_name' => Validator::$required
		) ;
		$Validator= new Validator ;
		if( !$Validator->check($data, $valid) )
		{
			echo $Validator->getLog() ;
		}else{
			$aRow = $admin->getRowId($data['admin_id']) ;
			if( empty($aRow['admin_id']) )
				$newIdx = $admin->insert($data) ;
			else 
				$admin->update($data) ;
			
			
			h_location('admin_member.php') ;
		}
	break;
}
// action end



// view 
$data = array() ;
$data['lnb_index'] = 0 ;

switch ($viewNo){
	case '04' : // IP 관리
		addPrintTitle('접속 IP 설정');
		$data['lnb_index'] = 1 ;
		
		$AccessIp = new AccessIp() ;
		$insertInfo = '' ;
		$insertIp = G::post('ip');
		$deleteIp = G::get('ip');
		
		if( !empty($insertIp) ) $AccessIp->insert ($insertIp, $insertInfo) ;
		if( !empty($deleteIp) ) $AccessIp->delete ($deleteIp) ;
		
		$aList = $AccessIp->getList() ;
		$data['data'] = $aList ;
				
	break;
	case '03' : 
	case '02' : // 운영자 등록 수정
		addPrintTitle('운영자 설정 등록');
		$adminId = G::get('id') ;		
		$data['btnName'] = '등록' ;	
		
		if( !empty($adminId) )
		{
			$row = $admin->getRowId($adminId) ;
			
			// 권한 추가될경우에를 대비해서??
			if( $row['admin_owner'] & 1 )	$row['admin_owner1'] = 'checked="checked"' ;
			for( $i = 1 ; $i < 15 ; $i++ ){
				$a = pow(2, $i) ;
				if( $row['admin_owner'] & $a )	$row['admin_owner'.$a] = 'checked="checked"' ;
			}
			
			$data['data'] = $row ;
			$data['btnName'] = '수정' ;
			
		}
		
		$aPost = G::postArr('ad');
		if( count($aPost) >= 1 )
		{
			if( !empty($adminId) )
				$admin->update($aPost) ;
			else
				$admin->insert($aPost);
		}
		
			
	break;
	case '01' : // 운영자 리스트
	default :
		addPrintTitle('운영자 설정');
		$viewNo = '01' ;
		
		$page = F::number(G::get('page'), 1) ;
		$data['page'] = $page ;
		$data['page_size'] = 5 ;
		$data['total_page_count'] = ceil($admin->getCount()/$admin->list_size) ;
		
		$rowList = $admin->getList() ;
		
		$data['data'] = $rowList ;
	break ;
}

layoutAdmin( a_path('admin_'.$viewNo) , $data ) ;


