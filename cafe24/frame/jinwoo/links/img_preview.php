<?php 
require_once './_default.php';

// 기존 tmp 파일을 지운다.
$path = _PATH_data_.'/temp/' ;
$d = dir(_PATH_data_.'/temp/') ;
while( false !== ($file = $d->read()) )
{
	$file = $path.'/'.$file ;
	if(is_file($file))
	{
		if( filectime($file) + 3600 < time() )
			unlink($file) ;
	}
}
$d->close();

addPrintTitle(G::get('title'));

$f_src = G::get('f_src') ;
$f_name = G::get('f_name') ;
$f_alt = G::get('f_alt') ;
$f_link = G::get('f_link') ;
$f_action = G::get('f_action') ;

$aList = array() ;
if( $f_name == 'func_mobile_main' ){
	foreach( $_POST[$f_src] as $k => $v )
	{
		$a = array(
			'banner_src' => G::postArrFind($f_src ,$k)
		,	'banner_name' => G::postArrFind($f_name,$k)
		,	'banner_alt' => G::postArrFind($f_alt,$k)
		,	'banner_link' => G::postArrFind($f_link,$k)
		) ;
		$aList[$k] = $a ;
	}

	$data['category_list'] = Code::getCode('mobile_category_code');
	foreach( $aList as $k => $r )
	{
		$aList[$k]['banner_name'] = $data['category_list'][floor($k/5)+1]['code_value'];
	}
}else{
	$post = G::postArr('p');
	
	if( $f_action == 'func_mobile_product' ){
		$aList['item'] = array(
			'banner_src' => A::str($post, $f_src)
		,	'banner_name' => $f_name
		,	'banner_alt' => A::str($post, $f_alt)
		,	'banner_link' => A::str($post, $f_link)
		);
	}else if( $f_action == 'func_product' ){
		$aName = array(
			 'overview' => 'OverView 리스트'
			,'overview_foot' => 'OverView 하단'
			,'item' => '상품메인'
			,'item_over' => '상세하단'
			,'highlight_1' => 'Highlights 1'
			,'highlight_2' => 'Highlights 2'
			,'highlight_3' => 'Highlights 3'
			,'highlight_4' => 'Highlights 4'
		);
		$aField = array(
			 'overview' => array('img' => 'overview_img' ,'alt' => 'overview_alt' )
			,'overview_foot' => array('img' => 'overview_foot_img' ,'alt' => 'overview_foot_alt' )
			,'item' => array('img' => 'item_img' ,'alt' => 'item_alt' )
			,'item_over' => array('img' => 'item_over_img' ,'alt' => 'item_over_alt' )
			,'highlight_1' => array('img' => 'highlight_img_1' ,'alt' => 'highlight_alt_1' )
			,'highlight_2' => array('img' => 'highlight_img_2' ,'alt' => 'highlight_alt_2' )
			,'highlight_3' => array('img' => 'highlight_img_3' ,'alt' => 'highlight_alt_3' )
			,'highlight_4' => array('img' => 'highlight_img_4' ,'alt' => 'highlight_alt_4' )
		);
		
		foreach( $aName as $k => $name )
		{
			$aList[$k] = array(
				'banner_src' =>  A::str($post, $aField[$k]['img'])
			,	'banner_name' => $name
			,	'banner_alt' => A::str($post,  $aField[$k]['alt'])
			,	'banner_link' => ''
			);
		}
	}
}

$sType = microtime(true);
if( is_array( $_FILES ) )
{
	foreach( $_FILES['file']['tmp_name'] as $k => $v ){
		$aName = explode('.',$_FILES['file']['name'][$k]) ;
		$tmpname = $_FILES['file']['tmp_name'][$k] ;
		if(is_uploaded_file($tmpname))
		{
			$webpath =  _WEB_PATH_DATA_.'/temp/'.$sType.$k.'.'.$aName[1] ;
			$filename =  _PATH_data_.'/temp/'.$sType.$k.'.'.$aName[1] ;
			move_uploaded_file($tmpname, $filename);
			
			$aList[$k]['banner_src'] = $webpath ;
		}
	}
}
	
$data = array() ;
$data['data_list'] = $aList ;

layoutAdminContents( a_path('sites_preview') , $data) ;

