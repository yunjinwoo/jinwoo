<?php
include_once '_default.php';
include_once 'BoardSet.c.php';
include_once 'BtnSetter.c.php';
if(!isset($UseingSession) && $UseingSession->level!='9')
	die( 'admin login' ) ;
#####################################################
$aBoardGroup = $aBoardRowData = array() ;
$BoardSet = new BoardSet() ;

$aBoardGroup = $BoardSet->getSetList() ;

$sBoardId = $_GET['board_id'] ;
if( !empty($sBoardId) )
{
	$BoardSetRow = BoardSetRow::singleton() ;
	$BoardSetRow->setRow($aBoardGroup[$sBoardId]) ;
}
//$BoardSetRow = new BoardSetRow ;

$aBoardSkins = array(
	'basic',
	'free'
) ;

$aBoardType = array(
	'free' // , 'qa' , 'poll'
) ;
$aLevelType = array(
	'9' => '관리자'
,	'2' => '회원'
,	'0' => '비회원'
) ;
$aIsUseFileType = array(
	'Y' => '사용'
,	'N' => '사용안함'
) ;
$aIsUseSecretType = array(
	'Y' => '사용'
,	'N' => '사용안함'
,	'A' => '게시물전체 잠금사용'
) ;

$sOptionBoardType	= optionMake( $aBoardType ,		$BoardSetRow->board_type , 'vv' ) ;
$sOptionBoardSkin	= optionMake( $aBoardSkins ,	$BoardSetRow->board_skin , 'vv' ) ;
$sOptionLevelWrite	= optionMake( $aLevelType ,		$BoardSetRow->level_write , 'kv' ) ;
$sOptionLevelView	= optionMake( $aLevelType ,		$BoardSetRow->level_view , 'kv' ) ;
$sOptionLevelComment = optionMake( $aLevelType ,	$BoardSetRow->level_comment , 'kv' ) ;


$sOptionIsUseFile = optionMake( $aIsUseFileType ,	$BoardSetRow->is_use_file , 'kv' ) ;
$sOptionIsUseSercet = optionMake( $aIsUseSecretType , $BoardSetRow->is_use_secret , 'kv' ) ;


if( count($_POST) >= 1 )
{
	$BoardSet->updateBoardSet( $_POST['_BF'] ) ;
	JSPrint( 'alert("저장!"); location.replace(location.href); ' ) ;
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
	<title> 게시판 설정 폼 </title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
 </head>

	<body>
		<h3>생성된 게시판</h3>
		
		<ul>
			<li><a href="?">새로추가</a></li>
<?php foreach($aBoardGroup as $board_id => $a ) 
		echo '<li>
				<a href="?board_id='.$a['board_id'].'">'.$a['board_name'].'</a> 
				<!-- <a href="./a_board_simulation.php?board_id='.$a['board_id'].'">[분류별 보기]</a> -->
				<a href="../page/notice.html?board_id='.$a['board_id'].'">[보기]</a>
				<!-- <a href="javascript:alert(\'나중에\');">[삭제]</a> -->
				</li>' ;?>
		</ul>
<script type="text/javascript" src="/common/js/validator.js"></script>
<script type="text/javascript">
<!--
	function checkMemberForm(frm) 
	{
		try{
			if( !Validator.validate(frm) ){
				return false ;
			}
		return true ;
		}catch(e){
			alert('스크립트 오류!!\n 잠시 후 새로고침 후 이용해주세요\n'+e.message);
			return false ;
		}
	}
//-->
</script>

<form method="post" onsubmit="return checkMemberForm(this)">
<input name="regtype" type="hidden" value="insert">
<input name="table" type="hidden" value="<?php echo $stable?>">

<h3>기본설정</h3>
<ul>
	
	<li>
		<dl>
			<dt>게시판아이디</dt>
			<dd>
				<input type="text" name="_BF[<?php echo $BoardSet->f_board_id?>]" title="게시판아이디" class="required"
							value="<?php echo $BoardSetRow->board_id?>" />
			</dd>
		</dl>
	</li>
	<li>
		<dl>
			<dt>게시판제목</dt>
			<dd>
				<input type="text" name="_BF[<?php echo $BoardSet->f_board_name?>]" title="게시판제목" class="required"
							value="<?php echo $BoardSetRow->board_name?>" />
			</dd>
		</dl>
	</li>
	<li>
		<dl>
			<dt>게시판기능</dt>
			<dd>
				<select name="_BF[<?php echo $BoardSet->f_board_type?>]"  title="게시판기능" class="required" >
					<?php echo $sOptionBoardType ; ?>
				</select>
			</dd>
		</dl>
	</li>
	<li>
		<dl>
			<dt>게시판출력형태</dt>
			<dd>
				<select name="_BF[<?php echo $BoardSet->f_board_skin?>]"  title="게시판출력형태" class="required" >
					<?php echo $sOptionBoardSkin ; ?>
				</select>
			</dd>
		</dl>
	</li>
	<li>
		<dl>
			<dt>파일첨부</dt>
			<dd>
				<select name="_BF[<?php echo $BoardSet->f_is_use_file?>]"  title="파일첨부" class="required" >
					<?php echo $sOptionIsUseFile ; ?>
				</select>
			</dd>
		</dl>
	</li>
	<li>
		<dl>
			<dt>비밀글기능</dt>
			<dd>
				<select name="_BF[<?php echo $BoardSet->f_is_use_secret?>]"  title="비밀글기능" class="required" >
					<?php echo $sOptionIsUseSercet ; ?>
				</select>
			</dd>
		</dl>
	</li>
</ul>


<h3>권한설정</h3>
<ul>
	<li>
		<dl>
			<dt>쓰기권한</dt>
			<dd>
				<select name="_BF[<?php echo $BoardSet->f_level_write?>]"  title="쓰기권한" class="required" >
					<?php echo $sOptionLevelWrite ; ?>
				</select>
			</dd>
		</dl>
	</li>
	<li>
		<dl>
			<dt>읽기권한</dt>
			<dd>
				<select name="_BF[<?php echo $BoardSet->f_level_view?>]"  title="읽기권한" class="required" >
					<?php echo $sOptionLevelView ; ?>
				</select>
			</dd>
		</dl>
	</li>
	<li>
		<dl>
			<dt>댓글권한</dt>
			<dd>
				<select name="_BF[<?php echo $BoardSet->f_level_comment?>]"  title="댓글권한" class="required" >
					<?php echo $sOptionLevelComment ; ?>
				</select>
			</dd>
		</dl>
	</li>
</ul>



<h3>화면설정</h3>
<ul>
	<li>
		<dl>
			<dt>New 이미지 출력 시간</dt>
			<dd>
				<input type="text" name="_BF[<?php echo $BoardSet->f_img_new_hour?>]" title="New 이미지 출력 시간" class="required"
							value="<?php echo $BoardSetRow->img_new_hour?>" />
			</dd>
		</dl>
	</li>
	<li>
		<dl>
			<dt>Hot 이미지 출력 조건(조회수)</dt>
			<dd>
				<input type="text" name="_BF[<?php echo $BoardSet->f_img_hot_cnt?>]" title="hot 이미지 출력 조건" class="required"
							value="<?php echo $BoardSetRow->img_hot_cnt?>" />
			</dd>
		</dl>
	</li>
	<li>
		<dl>
			<dt>리스트 출력 갯수</dt>
			<dd>
				<input type="text" name="_BF[<?php echo $BoardSet->f_list_count?>]" title="리스트 출력 갯수" class="required"
							value="<?php echo $BoardSetRow->list_count?>" />
			</dd>
		</dl>
	</li>
	<li>
		<dl>
			<dt>페이지 출력 갯수</dt>
			<dd>
				<input type="text" name="_BF[<?php echo $BoardSet->f_page_size?>]" title="페이지 출력 갯수" class="required"
							value="<?php echo $BoardSetRow->page_size?>" />
			</dd>
		</dl>
	</li>
</ul>


<input type="submit" value=" 저장 ">

</form>


<br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br />