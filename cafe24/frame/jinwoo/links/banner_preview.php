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


$sType = G::get('type') ;
$sFix = G::get('prx') ;

$aList = array() ;
foreach( $_POST['banner_src'] as $k => $v )
{
	$a = array(
		'banner_src' => G::postArrFind('banner_src'.$sFix,$k)
	,	'banner_name' => G::postArrFind('banner_name'.$sFix,$k)
	,	'banner_alt' => G::postArrFind('banner_alt'.$sFix,$k)
	,	'banner_link' => G::postArrFind('banner_link'.$sFix,$k)
	) ;
	$aList[$k] = $a ;
}

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

