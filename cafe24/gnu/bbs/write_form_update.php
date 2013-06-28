<?
$g4[title] = $wr_subject . "글입력";
include_once("./_common.php");

//@include_once("$board_skin_path/write_update.head.skin.php");

/*
echo '<pre>' ;
print_r($_POST) ;
echo '</pre>' ;
exit;


Array
(
    [null] => 
    [w] => u
    [bo_table] => b_2_2
    [wr_id] => 2
    [sca] => 
    [sfl] => 
    [stx] => 
    [spt] => 
    [sst] => 
    [sod] => 
    [page] => 
    [html] => html1
    [wr_subject] => 명문학교에서 현지학생들과 함께하는
    [wr_content] => 
명문학교에서 현지학생들과 함께하는
.명문학교에서 현지학생들과 함께하는
명문학교에서 현지학생들과 함께하는
명문학교에서 현지학생들과 함께하는
명문학교에서 현지학생들과 함께하는
    [wr_link1] => 
    [wr_link2] => 
)



Array
(
    [null] => 
    [w] => 
    [bo_table] => b_6
    [wr_id] => 
    [sca] => 
    [sfl] => 
    [stx] => 
    [spt] => 
    [sst] => 
    [sod] => 
    [page] => 
    [_F] => Array
        (
            [country] => 호주
            [school] => 학교명
            [course] => 어학연수
            [sedate] => 개시일종료일
            [haul] => 16주
            [q1] => 0:있다
            [q1_info] => ㅁㄶㄻㄶ
ㅎ
ㅁㄶ
ㅁㄴ
ㅎ
ㅁㄶ
            [q2_info] => 알레르기가 있다면 구체적으로 기입해 주세요 
알레르기가 있다면 구체적으로 기입해 주세요 
알레르기가 있다면 구체적으로 기입해 주세요 
알레르기가 있다면 구체적으로 기입해 주세요 
            [q3_info] => 취미/관심분야
취미/관심분야
취미/관심분야
취미/관심분야
            [protector_name] => 성함성함
            [protector_rel] => 관계관계
            [protector_phone] => Array
                (
                    [0] => 연락처
                    [1] => 연락처
                    [2] => 연락처
                )

            [bank_name] => 입금자명
            [q4_info] => 못먹는 음식
            [q5_info] => 타 요구/참고사항 
        )

)
*/

include_once("$g4[path]/lib/trackback.lib.php");
$upload_max_filesize = ini_get('upload_max_filesize');

if (empty($_POST))
    alert("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\n\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=$upload_max_filesize\\n\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");

// 리퍼러 체크
//referer_check();

$w = $_POST["w"];

$notice_array = explode("\n", trim($board[bo_notice]));

if ($w == "u" || $w == "r") {
    $wr = get_write($write_table, $wr_id);
    if (!$wr[wr_id])
        alert("글이 존재하지 않습니다.\\n\\n글이 삭제되었거나 이동하였을 수 있습니다."); 
}

// 외부에서 글을 등록할 수 있는 버그가 존재하므로 비밀글은 사용일 경우에만 가능해야 함
if (!$is_admin && !$board[bo_use_secret] && $secret)
	alert("비밀글 미사용 게시판 이므로 비밀글로 등록할 수 없습니다.");

if ($w == "" || $w == "u") {
    // 김선용 1.00 : 글쓰기 권한과 수정은 별도로 처리되어야 함
    if($w =="u" && $member['mb_id'] && $wr['mb_id'] == $member['mb_id'])
        ;
    else if ($member[mb_level] < $board[bo_write_level]) 
        alert("글을 쓸 권한이 없습니다.");

	// 외부에서 글을 등록할 수 있는 버그가 존재하므로 공지는 관리자만 등록이 가능해야 함
	if (!$is_admin && $notice)
		alert("관리자만 공지할 수 있습니다.");
} 
else if ($w == "r") 
{
    if (in_array((int)$wr_id, $notice_array))
        alert("공지에는 답변 할 수 없습니다.");

    if ($member[mb_level] < $board[bo_reply_level]) 
        alert("글을 답변할 권한이 없습니다.");

    // 게시글 배열 참조
    $reply_array = &$wr;

    // 최대 답변은 테이블에 잡아놓은 wr_reply 사이즈만큼만 가능합니다.
    if (strlen($reply_array[wr_reply]) == 10)
        alert("더 이상 답변하실 수 없습니다.\\n\\n답변은 10단계 까지만 가능합니다.");

    $reply_len = strlen($reply_array[wr_reply]) + 1;
    if ($board[bo_reply_order]) {
        $begin_reply_char = "A";
        $end_reply_char = "Z";
        $reply_number = +1;
        $sql = " select MAX(SUBSTRING(wr_reply, $reply_len, 1)) as reply from $write_table where wr_num = '$reply_array[wr_num]' and SUBSTRING(wr_reply, $reply_len, 1) <> '' ";
    } else {
        $begin_reply_char = "Z";
        $end_reply_char = "A";
        $reply_number = -1;
        $sql = " select MIN(SUBSTRING(wr_reply, $reply_len, 1)) as reply from $write_table where wr_num = '$reply_array[wr_num]' and SUBSTRING(wr_reply, $reply_len, 1) <> '' ";
    }
    if ($reply_array[wr_reply]) $sql .= " and wr_reply like '$reply_array[wr_reply]%' ";
    $row = sql_fetch($sql);

    if (!$row[reply])
        $reply_char = $begin_reply_char;
    else if ($row[reply] == $end_reply_char) // A~Z은 26 입니다.
        alert("더 이상 답변하실 수 없습니다.\\n\\n답변은 26개 까지만 가능합니다.");
    else
        $reply_char = chr(ord($row[reply]) + $reply_number);

    $reply = $reply_array[wr_reply] . $reply_char;
} else 
    alert("w 값이 제대로 넘어오지 않았습니다."); 


if ($w == "" || $w == "r") 
{
    if ($_SESSION["ss_datetime"] >= ($g4[server_time] - $config[cf_delay_sec]) && !$is_admin) 
        alert("너무 빠른 시간내에 게시물을 연속해서 올릴 수 없습니다.");

    set_session("ss_datetime", $g4[server_time]);

    // 동일내용 연속 등록 불가
    $row = sql_fetch(" select MD5(CONCAT(wr_ip, wr_subject, wr_content)) as prev_md5 from $write_table order by wr_id desc limit 1 ");
    $curr_md5 = md5($_SERVER[REMOTE_ADDR].$wr_subject.$wr_content);
    if ($row[prev_md5] == $curr_md5 && !$is_admin)
        alert("동일한 내용을 연속해서 등록할 수 없습니다.");
} 



 $wr_num = get_next_num($write_table);


$ca_name = $protector_name ;
$wr_option = 'html1' ;
$wr_subject = $member[mb_name]." ".$_F[protector_name] ;
$mb_id = $member[mb_id] ;


 $sql = "   set wr_num = '$wr_num',
                    wr_reply = '$wr_reply',
                    wr_comment = 0,
                    ca_name = '$ca_name',
                    wr_option = 'html1',
                    wr_subject = '$wr_subject',
                    wr_content = '$wr_content',
                    mb_id = '$member[mb_id]',
                    wr_name = '$wr_name',
                    wr_email = '$wr_email',
                    wr_homepage = '$wr_homepage',
                    wr_datetime = '$g4[time_ymdhis]',
                    wr_last = '$g4[time_ymdhis]',
                    wr_ip = '$_SERVER[REMOTE_ADDR]'"	 ;
  $sql .= '	,		country=\''.$_F['country'].'\'' ;
  $sql .= '	,		school=\''.$_F['school'].'\'' ;
  $sql .= '	,		course=\''.$_F['course'].'\'' ;
  $sql .= '	,		sedate=\''.$_F['sedate'].'\'' ;
  $sql .= '	,		haul=\''.$_F['haul'].'\'' ;
  $sql .= '	,		q1=\''.$_F['q1'].'\'' ;
  $sql .= '	,		q1_info=\''.$_F['q1_info'].'\'' ;
  $sql .= '	,		q2_info=\''.$_F['q2_info'].'\'' ;
  $sql .= '	,		q3_info=\''.$_F['q3_info'].'\'' ;
  $sql .= '	,		protector_name=\''.$_F['protector_name'].'\'' ;
  $sql .= '	,		protector_rel=\''.$_F['protector_rel'].'\'' ;
  $sql .= '	,		protector_phone_1=\''.$_F['protector_phone'][0].'\'' ;
  $sql .= '	,		protector_phone_2=\''.$_F['protector_phone'][1].'\'' ;
  $sql .= '	,		protector_phone_3=\''.$_F['protector_phone'][2].'\'' ;
  $sql .= '	,		bank_name=\''.$_F['bank_name'].'\'' ;
  $sql .= '	,		q4_info=\''.$_F['q4_info'].'\'' ;
  $sql .= '	,		q5_info=\''.$_F['q5_info'].'\'' ;

if( $w == 'u' )
{
  $sql = " update $write_table ".$sql.' where wr_id='.$wr_id ; 
   sql_query($sql);
}else{
  $sql = " insert into $write_table ".$sql ;

    sql_query($sql);
    $wr_id = mysql_insert_id();

	// 부모 아이디에 UPDATE
    sql_query(" update $write_table set wr_parent = '$wr_id' where wr_id = '$wr_id' ");

    // 새글 INSERT
    //sql_query(" insert into $g4[board_new_table] ( bo_table, wr_id, wr_parent, bn_datetime ) values ( '$bo_table', '$wr_id', '$wr_id', '$g4[time_ymdhis]' ) ");
    sql_query(" insert into $g4[board_new_table] ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( '$bo_table', '$wr_id', '$wr_id', '$g4[time_ymdhis]', '$member[mb_id]' ) ");

    // 게시글 1 증가
    sql_query("update $g4[board_table] set bo_count_write = bo_count_write + 1 where bo_table = '$bo_table'");
}

				
  

if( empty($wr_id) )
{
	alert("신청에 실패 했습니다. 관리자에게 문의해 주세요") ;
}

/**
create table g4_write_b_6_form
	wr_id int unsignde not null default 0 
,	country varchar(20) not null default ''
,	school varchar(40)  not null default ''
,	course varchar(40)  not null default ''
,	sedate varchar(40)  not null default ''
,	haul varchar(10)  not null default ''
,	q1 varchar(10)  not null default ''
,	q1_info text not null default ''
,	q2_info text not null default ''
,	q3_info text not null default ''
,	protector_name varchar(40)  not null default ''
,	protector_rel varchar(10)  not null default ''
,	protector_phone_1 varchar(10)  not null default ''
,	protector_phone_2 varchar(10)  not null default ''
,	protector_phone_3 varchar(10)  not null default ''
,	bank_name varchar(60)  not null default ''
,	q4_info text not null default ''
,	q5_info text not null default ''
, index(wr_id)
*/

$formLine = '#CC899F' ;
$tdBg1    = '#F2E8EA' ;
$tdBg2    = '#efefef' ;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE>sending.... </TITLE>
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="">
  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="">
 </HEAD>

 <BODY>
  

<?php echo $wr_option?>

<form name="fwrite" method="post" action="./write_update.php" enctype="multipart/form-data" style="margin:0px;">
<input type=hidden name=null> 
<input type=hidden name=w        value="u">
<input type=hidden name=bo_table value="<?php echo $bo_table?>">
<input type=hidden name=wr_id    value="<?php echo $wr_id?>">
<input type=hidden name=sca      value="<?php echo $sca?>">
<input type=hidden name=sfl      value="<?php echo $sfl?>">
<input type=hidden name=stx      value="<?php echo $stx?>">
<input type=hidden name=spt      value="<?php echo $spt?>">
<input type=hidden name=sst      value="<?php echo $sst?>">
<input type=hidden name=sod      value="<?php echo $sod?>">
<input type=hidden name=page     value="<?php echo $page?>">
<input type=hidden name=wr_name value="<?php echo $wr_name?>">
<input type=hidden name=wr_password <?php echo $password_required?>>
<input type=hidden name=wr_email value="<?php echo $wr_email?>">

<input type=hidden name=wr_homepage value="<?php echo $wr_homepage?>">
<input type=hidden name=html value="<?php echo $wr_option?>">
<input type=hidden name=wr_subject value="<?php echo $wr_subject?>">
<input type=hidden name=ca_name value="<?php echo $ca_name?>">

<textarea id="wr_content" name="wr_content" class=tx style='display:none;'>

	<table width="100%" border="0" cellspacing="1" cellpadding="0">
	<tr bgcolor="<?php echo $formLine?>">
		<td height="5" colspan="3" ></td>
	</tr>
	<tr>
		<td height="30" bgcolor="<?php echo $tdBg1?>" style="padding-left:10" >나라</td>
		<td height="30" colspan="2" bgcolor="<?php echo $tdBg1?>" style="padding-left:10" >
			<?php echo $_F['country']?>
		</td>
	</tr>
	<tr>
		<td height="30" bgcolor="<?php echo $tdBg2?>" style="padding-left:10">학교명</td>
		<td height="30" colspan="2" bgcolor="<?php echo $tdBg2?>" style="padding-left:10">
			<?php echo $_F['school']?>
		</td>
	</tr>
	<tr>
		<td height="30" bgcolor="<?php echo $tdBg1?>" style="padding-left:10" ><p>Course명</p>	  </td>
		<td height="30" colspan="2" bgcolor="<?php echo $tdBg1?>" style="padding-left:10" >
			<?php echo $_F['course']?>
		</td>
	</tr>
	<tr>
		<td height="30" bgcolor="<?php echo $tdBg2?>" style="padding-left:10">개시일종료일</td>
		<td height="30" colspan="2" bgcolor="<?php echo $tdBg2?>" style="padding-left:10">
			<?php echo $_F['sedate']?>
		</td>
	</tr>
	<tr>
		<td height="30" bgcolor="<?php echo $tdBg1?>" style="padding-left:10" >기간</td>
		<td height="30" colspan="2" bgcolor="<?php echo $tdBg1?>" style="padding-left:10" >
			<?php echo $_F['haul']?>			
		</td>
	</tr>
	<tr bgcolor="<?php echo $formLine?>">
		<td height="5" colspan="3" ></td>
	</tr>
	<tr>
		<td height="30" bgcolor="<?php echo $tdBg1?>" style="padding-left:10" >기타특이사항</td>
		<td height="30" colspan="2" bgcolor="<?php echo $tdBg1?>" style="padding-left:10" >
			일상 생활에 지장을 줄만한 건강상의 문제가 있다
			[<?php echo substr($_F['q1'], 2)?>]
		</td>
	</tr>
	<tr>
		<td height="30" bgcolor="<?php echo $tdBg2?>" style="padding-left:10">&nbsp; </td>
		<td height="30" colspan="2" bgcolor="<?php echo $tdBg2?>" style="padding-left:10;padding-top:10;padding-bottom:10">
			<?php echo $_F['q1_info']?>
		</td>
	</tr>
	<tr>
		<td height="30" bgcolor="<?php echo $tdBg1?>" style="padding-left:10" >&nbsp;</td>
		<td height="30" colspan="2" bgcolor="<?php echo $tdBg1?>" style="padding-left:10" >알레르기가 있다면 구체적으로 기입해 주세요 </td>
	</tr>
	<tr>
		<td height="30" bgcolor="<?php echo $tdBg2?>" style="padding-left:10">&nbsp;</td>
		<td height="30" colspan="2" bgcolor="<?php echo $tdBg2?>" style="padding-left:10;padding-top:10;padding-bottom:10">
			<?php echo $_F['q2_info']?>
		</td>
	</tr>
	<tr>
		<td height="30" bgcolor="<?php echo $tdBg1?>" style="padding-left:10" >취미/관심분야</td>
		<td height="30" colspan="2" bgcolor="<?php echo $tdBg1?>" style="padding-left:10;padding-top:10;padding-bottom:10">
			<?php echo $_F['q3_info']?>
		</td>
	</tr>
	<tr>
		<td rowspan="4" bgcolor="<?php echo $tdBg2?>" style="padding-left:10">보호자 인적사항 </td>
		<td width="13%" height="30" bgcolor="<?php echo $tdBg2?>" style="padding-left:10;padding-top:10;padding-bottom:10">성함</td>
		<td width="66%" bgcolor="<?php echo $tdBg2?>" style="padding-left:10;padding-top:10;padding-bottom:10">
			<span style="padding-left:10">
			<?php echo $_F['protector_name']?>
			</span>
		</td>
	</tr>
	<tr>
		<td height="30" bgcolor="<?php echo $tdBg2?>" style="padding-left:10;padding-top:10;padding-bottom:10">관계</td>
		<td height="30" bgcolor="<?php echo $tdBg2?>" style="padding-left:10;padding-top:10;padding-bottom:10">
			<span style="padding-left:10">
			<?php echo $_F['protector_rel']?>
			</span>
		</td>
	</tr>
	<tr>
		<td height="30" bgcolor="<?php echo $tdBg2?>" style="padding-left:10;padding-top:10;padding-bottom:10">연락처</td>
		<td height="30" bgcolor="<?php echo $tdBg2?>" style="padding-left:10;padding-top:10;padding-bottom:10">
			<span style="padding-left:10">
			<?php echo $_F['protector_phone'][0]?> -
			<?php echo $_F['protector_phone'][1]?> - 
			<?php echo $_F['protector_phone'][2]?>
			</span>
		</td>
	</tr>
	<tr>
		<td height="30" bgcolor="<?php echo $tdBg2?>" style="padding-left:10;padding-top:10;padding-bottom:10">입금자명</td>
		<td height="30" bgcolor="<?php echo $tdBg2?>" style="padding-left:10;padding-top:10;padding-bottom:10">
			<span style="padding-left:10">
			<?php echo $_F['bank_name']?>
			</span>
		</td>
	</tr>
	<tr>
		<td height="30" bgcolor="<?php echo $tdBg1?>" style="padding-left:10">못먹는 음식</td>
		<td height="30" colspan="2" bgcolor="<?php echo $tdBg1?>" style="padding-left:10;padding-top:10;padding-bottom:10">
		<?php echo $_F['q4_info']?>
		</td>
	</tr>
	<tr>
		<td height="30" bgcolor="<?php echo $tdBg2?>" style="padding-left:10" >기타 요구/참고사항 </td>
		<td height="30" colspan="2" bgcolor="<?php echo $tdBg2?>" style="padding-left:10;padding-top:10;padding-bottom:10">
		<?php echo $_F['q5_info']?>			
		</td>
	</tr>
	<tr bgcolor="<?php echo $formLine?>">
		<td height="5" colspan="3" ></td>
	</tr>
	</table>
	</td>
	</tr>
	<TR>
	<TD HEIGHT=5 valign="top" style="padding:5:top"><div align="center">&nbsp;</div></TD>
	</TR>
	</table>
</textarea>
</form>

<script language="javascript">
window.document.body.onload = function(){
 with( document.fwrite )
 {
	action = './write_update.php' ;
	//alert( action ) ;
    submit(); 
 }
}
</script>
 </BODY>
</HTML>
