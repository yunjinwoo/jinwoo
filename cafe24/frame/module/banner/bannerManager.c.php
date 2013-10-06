<?php
define( '_SQL_BANNER_SELECT_' , '
	SELECT * FROM '._db_banner_.' 
	WHERE banner_type = :banner_type
	ORDER BY banner_sort asc
' ) ;

$__banner_type = 'gnb' ;
define( '_SQL_BANNER_GNB_SELECT_' , "
SELECT *
FROM (
	SELECT 'Imaging Systems' AS banner_name, '1' AS data_sort, '".$__banner_type."' AS banner_type UNION
	SELECT 'Software', '2', '".$__banner_type."' UNION
	SELECT 'Media center', '3', '".$__banner_type."' UNION
	SELECT 'companymy', '4', '".$__banner_type."'
) a LEFT JOIN "._db_banner_."  b 
ON a.banner_type = b.banner_type AND a.data_sort = b.banner_sort
ORDER BY a.data_sort " ) ;

$__banner_type = 'main_visual' ;
define( '_SQL_BANNER_MAIN_VISUAL_SELECT_' , "
SELECT *
FROM (
	SELECT 'image 1' AS banner_name, '1' AS data_sort, '".$__banner_type."' AS banner_type UNION
	SELECT 'image 2', '2', '".$__banner_type."' UNION
	SELECT 'image 3', '3', '".$__banner_type."' UNION
	SELECT 'image 4', '4', '".$__banner_type."' UNION
	SELECT 'image 5', '5', '".$__banner_type."'
) a LEFT JOIN "._db_banner_."  b 
ON a.banner_type = b.banner_type AND a.data_sort = b.banner_sort
ORDER BY a.data_sort " ) ;

$__banner_type = 'main' ;
define( '_SQL_BANNER_MAIN_SELECT_' , "
SELECT *
FROM (
	SELECT '3D Img Systems' AS banner_name, '1' AS data_sort, '".$__banner_type."' AS banner_type UNION
	SELECT '2D Img Systems', '2', '".$__banner_type."' UNION
	SELECT 'Intra-oral img System', '3', '".$__banner_type."' UNION
	SELECT '3D software', '4', '".$__banner_type."'UNION
	SELECT '2D software', '5', '".$__banner_type."'
) a LEFT JOIN "._db_banner_."  b 
ON a.banner_type = b.banner_type AND a.data_sort = b.banner_sort
ORDER BY a.data_sort " ) ;

$__banner_type = 'overview_1' ;
define( '_SQL_BANNER_OVERVIEW_1_SELECT_' , "
SELECT *
FROM (
	SELECT 'image 1' AS banner_name, '1' AS data_sort, '".$__banner_type."' AS banner_type UNION
	SELECT 'image 2', '2', '".$__banner_type."' UNION
	SELECT 'image 3', '3', '".$__banner_type."' UNION
	SELECT 'image 4', '4', '".$__banner_type."' 
) a LEFT JOIN "._db_banner_."  b 
ON a.banner_type = b.banner_type AND a.data_sort = b.banner_sort
ORDER BY a.data_sort " ) ;

$__banner_type = 'overview_2' ;
define( '_SQL_BANNER_OVERVIEW_2_SELECT_' , "
SELECT *
FROM (
	SELECT 'image 1' AS banner_name, '1' AS data_sort, '".$__banner_type."' AS banner_type UNION
	SELECT 'image 2', '2', '".$__banner_type."' UNION
	SELECT 'image 3', '3', '".$__banner_type."' UNION
	SELECT 'image 4', '4', '".$__banner_type."' 
) a LEFT JOIN "._db_banner_."  b 
ON a.banner_type = b.banner_type AND a.data_sort = b.banner_sort
ORDER BY a.data_sort " ) ;

define( '_SQL_BANNER_INSERT_' , '
INSERT INTO '._db_banner_.' 
SET	`banner_type`	= :banner_type
,	`banner_sort`	= :banner_sort
,	`banner_src`	= :banner_src
,	`banner_alt`	= :banner_alt
,	`banner_link`	= :banner_link
,	`banner_text`	= :banner_text
,	`link_type`		= :link_type
,	`reg_date`		= :reg_date ') ;

define( '_SQL_BANNER_UPDATE_' , '
UPDATE '._db_banner_.' 
SET	`banner_type`	= :banner_type
,	`banner_sort`	= :banner_sort
,	`banner_src`	= :banner_src
,	`banner_alt`	= :banner_alt
,	`banner_link`	= :banner_link
,	`banner_text`	= :banner_text
,	`link_type`		= :link_type
WHERE banner_idx = :banner_idx') ;


define( '_SQL_BANNER_SELECT_ROW_' , '
	SELECT * FROM '._db_banner_.'
	WHERE banner_idx = :banner_idx '  ) ;

define( '_SQL_BANNER_SELECT_ROW_SORT_MAX_' , '
	SELECT max(banner_sort) as banner_sort FROM '._db_banner_.'
	WHERE banner_type = :banner_type '  ) ;

define( '_SQL_BANNER_UPDATE_UPDOWN_' , '
	UPDATE '._db_banner_.'
	SET banner_sort = :update_banner_sort
	WHERE banner_type = :banner_type
	AND   banner_sort = :banner_sort'  ) ;


define( '_SQL_BANNER_DELETE_ROW_' , '
	DELETE FROM '._db_banner_.'
	WHERE banner_idx = :banner_idx '  ) ;

define( '_SQL_BANNER_UPDATE_SORT_STEP_' , '
	UPDATE '._db_banner_.'
	SET banner_sort = banner_sort - 1
	WHERE banner_type = :banner_type
	AND   banner_sort >= :banner_sort'  ) ;


/**
 * 이곳저곳에서 사용이 많은 베너 클래스
 * 
 * @version 1
 */
class BannerManager {
	private $bannerType ;
	function __construct($bannerType = '') {
		$this->setType($bannerType) ;
	}
	
	/**
	 * 베너 구분값 설정
	 * 
	 * @param string $type 
	 * @return void
	 */
	function setType( $type )
	{
		$this->bannerType = $type ;
	}
		
	/**
	 * GNB 베너 가져오기
	 * BannerManager->getList 사용
	 * 
	 * @return array BannerManager->getList
	 */
	function getGnbList()
	{
		return $this->getList(_SQL_BANNER_GNB_SELECT_) ;
	}
	
	/**
	 * 메인비주얼 베너 가져오기
	 * BannerManager->getList 사용
	 * 디비 필드 + 추가 데이타
	 * link_type_checked
	 * banner_link_replace
	 * 
	 * @return array BannerManager->getList
	 */
	function getMainVisualList()
	{
		$a = $this->getList(_SQL_BANNER_MAIN_VISUAL_SELECT_) ;
		foreach( $a as $k => $v )
		{
			if( $v['link_type'] == 'youtube' ){
				$v['link_type_checked'] = ' checked="checked" ' ;
				$v['banner_link_replace'] = F::youtube($v['banner_link']);
			}else{
				$v['banner_link_replace'] = $v['banner_link'] ; // F::str($v['banner_link'],"#") ;
			}
				
			$a[$k] = $v ;
		}
		
		return  $a ;
	}
	
	/**
	 * 모바일 메인 베너 가져오기
	 * BannerManager->getList 사용
	 * 디비 필드 + 추가 데이타
	 * link_type_checked
	 * banner_link_replace
	 * 
	 * @return array BannerManager->getList
	 */
	function getMainMobileList()
	{
		$q = "
SELECT *
FROM (
	SELECT 'image 1' AS banner_name, '1' AS data_sort, 'mobile_main' AS banner_type UNION
	SELECT 'image 2', '2', 'mobile_main' UNION
	SELECT 'image 3', '3', 'mobile_main' UNION
	SELECT 'image 4', '4', 'mobile_main' UNION
	SELECT 'image 5', '5', 'mobile_main'
) a LEFT JOIN "._db_banner_."  b 
ON a.banner_type = b.banner_type AND a.data_sort = b.banner_sort
ORDER BY a.data_sort "  ;
		$stmt = db()->prepare($q) ;
		stmtExecute( $stmt ) ;
		
		$ret = array() ;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC) ) 
			$ret[$row['data_sort']] = $row ;
		
		return $ret ;
	}
	
	/**
	 * Main 베너 가져오기
	 * BannerManager->getList 사용
	 * 
	 * @return array BannerManager->getList
	 */
	function getMainList()
	{
		return $this->getList(_SQL_BANNER_MAIN_SELECT_) ;
	}
	
	/**
	 * Overview1 베너 가져오기 상품 종류1
	 * BannerManager->getList 사용
	 * 
	 * @return array BannerManager->getList
	 */
	function getOverview1List()
	{
		return $this->getList(_SQL_BANNER_OVERVIEW_1_SELECT_) ;
	}
	
	/**
	 * Overview2 베너 가져오기 상품 종류2
	 * BannerManager->getList 사용
	 * 
	 * @return array BannerManager->getList
	 */
	function getOverview2List()
	{
		return $this->getList(_SQL_BANNER_OVERVIEW_2_SELECT_) ;
	}
	
	/**
	 * Banner 베너 가져오기
	 * BannerManager->getList 사용
	 * 
	 * @param string $bannerType 베너 구분명
	 * @return array BannerManager->getList
	 */
	function getBannerList($bannerType='')
	{
		return $this->getList(_SQL_BANNER_SELECT_, array(':banner_type'=>$bannerType)) ;
	}
	
	/**
	 * 베너 가져오기 기본!
	 * 
	 * @param string $q 쿼리문
	 * @param array() bind 할 배열
	 * @return array fetch(PDO::FETCH_ASSOC)  $row['banner_sort'] => $row
	 */
	function getList($q, $aParam= array())
	{
		$stmt = db()->prepare($q) ;
		stmtExecute( $stmt , $aParam) ;
		
		$ret = array() ;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC) ) 
			$ret[$row['banner_sort']] = $row ;
		
		return $ret ;
	}
	
	/**
	 * 베너정보 저장하기
	 * 
	 * 
	 * @param string $type 베너구분명
	 * @param string $sort 출력순서
	 * @param string $src 이미지 경로 웹 상의 절대경로
	 * @param string $alt 이미지 alt
	 * @param string $link 링크내용
	 * @param string $linkType 링크 구분 (image or youtube ....)
	 * @param [string $text 베너 내용]
	 * @param [string $idx 베너idx 수정용]
	 * @return array fetch(PDO::FETCH_ASSOC)  $row['banner_sort'] => $row
	 */
	function saveBanner($type, $sort, $src, $alt, $link, $linkType, $text = '' , $idx = '' )
	{
		$idx = F::number($idx,0) ; 
					
		if( $idx > 0 ){
			$stmt = db()->prepare(_SQL_BANNER_UPDATE_) ;
			
			$stmt->bindValue(':banner_idx', $idx , PDO::PARAM_INT);
		}else{
			$stmt = db()->prepare(_SQL_BANNER_INSERT_) ;
			
			$stmt->bindValue(':reg_date', date('Y-m-d H:i:s') );
		}
			
		$stmt->bindValue(':banner_type'	, $type );
		$stmt->bindValue(':banner_sort'	, $sort , PDO::PARAM_INT);
		$stmt->bindValue(':banner_src'	, $src );
		$stmt->bindValue(':banner_alt'	, $alt );
		$stmt->bindValue(':banner_link'	, $link );
		$stmt->bindValue(':banner_text'	, $text );
		$stmt->bindValue(':link_type'	, $linkType );
		
		stmtExecute( $stmt ) ;
		
		return $stmt->rowCount() ;
	}
	
	/**
	 * 베너 삭제
	 * 
	 * @param int $idx 베너 번호
	 * @return int 삭제된 row 갯수
	 */
	function delete($idx)
	{
		$bannerIdx = F::number($idx,0) ; 
					
		if( $bannerIdx < 0 ) return ;
		
		
		$row = $this->row($bannerIdx);
		if( !is_numeric($row->banner_idx) ) return ;
		
		if( $row->banner_sort == 1 && $step == -1 ) return ;

		$sttm2 = db()->prepare(_SQL_BANNER_DELETE_ROW_) ;
		$sttm2->bindValue(':banner_idx', $bannerIdx, PDO::PARAM_INT) ;
		stmtExecute($sttm2);
		@unlink( $_SERVER['DOCUMENT_ROOT'].$row->banner_src ) ;
		
		
		$sttm3 = db()->prepare(_SQL_BANNER_UPDATE_SORT_STEP_) ;
		$sttm3->bindValue(':banner_sort', $row->banner_sort, PDO::PARAM_INT) ;
		$sttm3->bindValue(':banner_type' , $row->banner_type) ;
		stmtExecute($sttm3);
				
		return $sttm2->rowCount() ;
	}
	
	/**
	 * 파일 업로드 후 saveBanner 실행한다.
	 * 
	 * @param string $sType 베너 구분
	 * @param string $name 링크 구분
	 * @param string $post_prx 같은 페이지일때 사용된다.
	 * @return int 저장된 row 갯수
	 */
	function fileUpload_GLOBAL($sType,$linkType='image',$post_prx = '')
	{
		$cnt = 0 ;
		if( count($_POST) <= 0 ) return $cnt ;
		
		foreach( $_POST['banner_src'.$post_prx] as $k => $v )
		{
			$sort	= $k ;
			if( empty($sort) ) $sort = 1 ;
			
			$src	= $_POST['banner_src'.$post_prx][$k] ;
			$alt	= $_POST['banner_alt'.$post_prx][$k] ;
			$link	= $_POST['banner_link'.$post_prx][$k] ;
			$idx	= $_POST['banner_idx'.$post_prx][$k] ;
			$text			= isset($_POST['banner_text'.$post_prx][$k]) ? $_POST['banner_text'.$post_prx][$k] : '' ;
			$linkTypeTmp	= isset($_POST['link_type'.$post_prx][$k]) ? $_POST['link_type'.$post_prx][$k] : $linkType ;
			
			if(is_uploaded_file($_FILES['file'.$post_prx]['tmp_name'][$k]))
			{
				$aName = explode('.',$_FILES['file'.$post_prx]['name'][$k]) ;
				$tmpname = $_FILES['file'.$post_prx]['tmp_name'][$k] ;
				
				$src =  _WEB_PATH_DATA_.'/banner/'.$sType.$k.'.'.$aName[1] ;
				$filename =  _PATH_data_.'/banner/'.$sType.$k.'.'.$aName[1] ;
				
				if( is_file( $f = $_SERVER['DOCUMENT_ROOT'].$_POST['banner_src'.$post_prx][$k] ) )
					unlink( $f ) ;
				move_uploaded_file($tmpname, $filename);
			}
			
			
			$cnt += $this->saveBanner($sType, $sort, $src, $alt, $link, $linkTypeTmp, $text, $idx) ;
		}
		
		return $cnt ;
	}
		
	/**
	 * 베너번호를 토대로 같은 그룹중 해당 번호의 값을 1 올린다.
	 * 
	 * @param int $bannerIdx 베너 번호
	 * @return bool $this->sortUpdate
	 */
	function sortUp($bannerIdx)
	{
		$this->sortUpdate($bannerIdx, -1);
	}
	
	
	/**
	 * 베너번호를 토대로 같은 그룹중 해당 번호의 값을 1 내린다.
	 * 
	 * 
	 * @param int $bannerIdx 베너 번호
	 * @return bool $this->sortUpdate
	 */
	function sortDown($bannerIdx)
	{
		$this->sortUpdate($bannerIdx, 1);
	}
	
	/**
	 * 베너번호를 토대로 같은 그룹중 해당 번호의 값을 1, -1 한다.
	 * 
	 * @param int $bannerIdx 베너 번호
	 * @param int $step 1 or -1
	 * @return bool true or false 
	 */
	private function sortUpdate($bannerIdx, $step)
	{
		db()->beginTransaction() ;
		
		try{

			$row = $this->row($bannerIdx);
			if( !is_numeric($row->banner_idx) ) return ;
			if( $row->banner_sort == 1 && $step == -1 ) return ;
			
			$sttm3 = db()->prepare(_SQL_BANNER_SELECT_ROW_SORT_MAX_) ;
			$sttm3->bindValue(':banner_type' , $row->banner_type) ;
			stmtExecute($sttm3);
			
			if( $row->banner_sort == $sttm3->fetch(PDO::FETCH_OBJ)->banner_sort && $step == 1 ) return ;

			$sttm2 = db()->prepare(_SQL_BANNER_UPDATE_UPDOWN_) ;
			$sttm2->bindValue(':update_banner_sort'	, - 1,PDO::PARAM_INT) ;
			$sttm2->bindValue(':banner_type'		, $row->banner_type) ;
			$sttm2->bindValue(':banner_sort'		, $row->banner_sort,PDO::PARAM_INT) ;
			$sttm2->execute() ;
		
			$sttm2->bindValue(':update_banner_sort'	, $row->banner_sort,PDO::PARAM_INT) ;
			$sttm2->bindValue(':banner_type'		, $row->banner_type) ;
			$sttm2->bindValue(':banner_sort'		, $row->banner_sort+$step,PDO::PARAM_INT) ;
			$sttm2->execute() ;
			
			$sttm2->bindValue(':update_banner_sort'	, $row->banner_sort+$step,PDO::PARAM_INT) ;
			$sttm2->bindValue(':banner_type'		, $row->banner_type) ;
			$sttm2->bindValue(':banner_sort'		, -1,PDO::PARAM_INT) ;
			$sttm2->execute() ;

			db()->commit();
			
			$ret = true ;
		}catch(Exception $e) {
			db()->rollBack();
			$ret = false ;
			
			$this->log = $e->getMessage();
		}
		return $ret ;
	}
	
	/**
	 * 베너 idx 로 row 가져오기
	 * 
	 * @return array fetch($fetch = PDO::FETCH_OBJ);
	 */
	function row($bannerIdx,$fetch = PDO::FETCH_OBJ)
	{
		$sttm = db()->prepare(_SQL_BANNER_SELECT_ROW_) ;
		$sttm->bindValue(':banner_idx', $bannerIdx, PDO::PARAM_INT) ;

		stmtExecute($sttm);
		return $sttm->fetch($fetch) ;
	}
}

