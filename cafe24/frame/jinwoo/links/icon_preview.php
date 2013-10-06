<?php 
require_once './_default.php';
load('banner'); 

$banner = new BannerManager() ;
$data['banner_type'] = 'product_icon' ;
$aBannerList = $banner->getBannerList($data['banner_type']) ;
$index = G::get('icon');
$aIndex = !empty($index) ? explode(',',$index) : array() ;

$myIcon = array() ;
foreach( $aBannerList as $k=>$row)
{
	if( in_array($row['banner_idx'],$aIndex) )
	{
		$myIcon[$row['banner_idx']] = $row ;
		unset($aBannerList[$k]);
	}
}

$icon_sort = array() ;
if( count($aIndex)>=1 )
	foreach($aIndex as $k => $v)
		if( isset($myIcon[$v]) )
			$icon_sort[$k+1] = $myIcon[$v] ;

$data['product_icon_list'] = $icon_sort;
$data['data_list'] = $aBannerList;

if( $_SERVER['REMOTE_ADDR'] == '192.168.0.26' ) 
layoutAdminContents( a_path('product_02_popup_test') , $data) ;
else
layoutAdminContents( a_path('product_02_popup') , $data) ;

