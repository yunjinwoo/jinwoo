<?php

require_once './_default.php';

$sAction = G::get('action') ;

switch($sAction)
{
	case 'product_menu' :
		load('product') ;
		
		$find = G::get('find') ;
		
		$cateIdx = F::number(G::get('cate_idx'),0) ;
		$menuIdx = F::number(G::get('menu_idx'),0) ;
		$findIdx = F::number(G::get('find_idx'),0) ;
		$ProductMenu = new ProductMenu($cateIdx,$menuIdx) ;
		
		if( $find == 'sub')
			$data = $ProductMenu->getSubMenuList() ;
		else if( $find == 'group' )
			$data = $ProductMenu->getFindMenuGroup($cateIdx);
		else
			$data = $ProductMenu->getMenuList() ;
		
		$str = '' ;
		if( count($data) >= 1 )
		{
			$str = chr(13).'<option value="">('.count($data).')--------------------</option>' ;
			foreach( $data as $row ){
				$selected = $findIdx == $row['menu_idx'] ? 'selected="selected"' : '' ;
				$str .= chr(13).'<option value="'.$row['menu_idx'].'" '.$selected.'>'.$row['menu_name'].'</option>' ;
			}
		}
		echo $str ;
	break ;
	
	
	case 'banner' :
		load('banner') ;
		$banner_idx = F::number(G::get('banner_idx'),0) ;
		if( $banner_idx <= 0 ) return '';
		
		$BannerManager = new BannerManager() ;
		$row = $BannerManager->row($banner_idx);
		echo json_encode($row);
	break ;
}
		