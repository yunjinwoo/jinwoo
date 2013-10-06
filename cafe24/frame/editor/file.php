<?php
require_once dirname(__FILE__).'/../_define.php';
// 헤더를 바꿔야 한다. // 경로도 프론트로 수정해야한다.
load('editorFile');
addPrintTitle('파일업로드');
require_once '../admin/include/head_login.php';

$key = G::get('key');
if(empty($key)) debug (_MSG_ERROR_.' key 없음') ;

$msg = '' ;
$EditorFile = new EditorFile($key) ;
if( isset($_FILES['upload']) && is_uploaded_file($_FILES['upload']['tmp_name']) )
{
	if(strpos($_FILES['upload']['type'], 'image') !== false )
	{		
		$imgRow = $EditorFile->insert(
					$_FILES['upload']['tmp_name']
				  , $_FILES['upload']['name']
				  , $_FILES['upload']['type']
				  , $_FILES['upload']['size']
				  , G::post('file_alt') ) ;
		
	
		jsPrint('opener.tinymce.execCommand("mceInsertContent",true,"<img src=\"'.$imgRow['file_path'].'\" alt=\"'.$imgRow['file_alt'].'\" />");') ;

		// 삽입전에 닫힌다??
		jsPrint('$(function(){
					self.close();
				});') ;
		//exit; 
	}else{
		$msg = '이미지 형식만 업로드 가능합니다.' ;
	}
}
// 목록 출력은 오바다...
$aList = $EditorFile->getList() ;
?>

<div class="preview">
	<strong><?=$msg?></strong>
	<form name="form1" method="post" enctype="multipart/form-data">
	<input type="file" name="upload" class="validate-image" title="파일"/>
	<br />alt:<input type="text" name="file_alt" class="required" title="alt"/>
	<div class="function_btns3">
		<input type="submit" class="btn btn_em2" value="등록" />
		<a href="javascript:self.close();" class="btn btn_em2">취소</a>
	</div>
	</form>
</div>

<script type="text/javascript" src="../f/js/validator.js"></script>
<script type="text/javascript">
$("div.wrapper").removeClass('login');
document.forms['form1'].onsubmit = function() {
	try{
		return Validator.validate(this);
	} catch(e){
		console.log( e ) ;
		return false ;
	}
} 
</script>
</body>
</html>