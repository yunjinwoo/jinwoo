<?
include_once("./_common.php");

if ($is_admin != "super")
    alert("최고관리자만 변환 가능합니다", "$g4[bbs_path]/login.php?url=".urlencode($_SERVER[PHP_SELF]));

$g4[title] = "답사기 게시판 변환 : 그누보드3 -> 그누보드4";
include_once("$g4[path]/head.sub.php");

$tmp_source = "gb_write_" . $source;
$tmp_source_file = $tmp_source . "_file";
$tmp_target = $g4[write_prefix] . $target;

$notice = "";
$cr = "";
$comment = -1;

if ($_POST[proc]) {
    $category = array();
    $sql = " select ca_id, ca_name from {$tmp_source}_cat order by ca_id ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $category[$row[ca_id]] = $row[ca_name];
    }

    $sql = " select * from $tmp_source ";
    $result = sql_query($sql);
    // 자료가 있을 경우에만 타켓 테이블 내용 삭제
    if (mysql_num_rows($result))
    {
        sql_query(" delete from $tmp_target ");
        sql_query(" delete from $g4[board_file_table] where bo_table = '$target' ");
    }
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        /*
        if ($row[wr_notice]) {
            $notice .= "$cr$row[wr_id]";
            $cr = "\n";
        }
        */

        $html = "";
        if ($row[wr_html])
            $html = ",html{$row[wr_html]}";
        $secret = "";
        if ($row[wr_secret])
            $secret = ",secret";
        $recv_email = "";
        if ($row[wr_recv_email])
            $mail = ",mail";
        $sql2 = " insert into $tmp_target
                     set wr_id = '$row[wr_id]',
                         ca_name = '{$category[$row[ca_id]]}',
                         wr_option = '$html,$secret,$mail',
                         wr_num = '$row[wr_num]',
                         wr_reply = '$row[wr_reply]',
                         wr_parent = '$row[wr_parent_id]',
                         wr_subject = '".addslashes($row[wr_subject])."',
                         wr_content = '".addslashes($row[wr_content])."',
                         wr_link1 = '$row[wr_link1]',
                         wr_link2 = '$row[wr_link2]',
                         wr_link1_hit = '$row[wr_link1_hit]',
                         wr_link2_hit = '$row[wr_link2_hit]',
                         wr_hit = '$row[wr_hit]',
                         wr_good = '$row[wr_good]',
                         wr_nogood = '$row[wr_nogood]',
                         mb_id = '$row[mb_id]',
                         wr_password = '$row[wr_passwd]',
                         wr_name = '".addslashes($row[wr_name])."',
                         wr_email = '$row[wr_email]',
                         wr_homepage = '$row[wr_homepage]',
                         wr_datetime = '$row[wr_datetime]',
                         wr_ip = '$row[wr_ip]',
                         wr_1 = '$row[wr_1]',
                         wr_2 = '$row[wr_2]',
                         wr_3 = '$row[wr_3]',
                         wr_4 = '$row[wr_4]',
                         wr_5 = '$row[wr_5]',
                         wr_6 = '$row[wr_6]',
                         wr_7 = '$row[wr_7]',
                         wr_8 = '$row[wr_8]',
                         wr_9 = '$row[wr_9]',
                         wr_10 = '$row[wr_10]' ";
        if ($row[wr_comment] == 0)
        {
            $sql2 .= " , wr_comment = '$row[wr_commentcnt]' ";
            $sql2 .= " , wr_is_comment = 0 ";
        }
        else
        {
            $sql2 .= " , wr_comment = '$comment' ";
            $sql2 .= " , wr_is_comment = 1 ";
            $comment--;
        }
        sql_query($sql2);

        // 답사기 사진 복사
        $rich_content = "";
        $bf_no = 0;
        $sql3 = " select * from $tmp_source_file where wr_id = '$row[wr_id]' order by wf_id ";
        $result3 = sql_query($sql3);
        while ($row3=sql_fetch_array($result3)) {
            $image_file = substr("00000".$row3[wr_id],-5) . "_" . substr("000".$row3[wf_id],-3) . ".jpg";
            if (file_exists("$source_file/$source/$image_file")) {
                $sql4 = " insert into $g4[board_file_table]
                             set bo_table = '$target',
                                 wr_id = '$row[wr_id]',
                                 bf_no = '$bf_no',
                                 bf_source = '".addslashes($image_file)."',
                                 bf_file = '".addslashes($image_file)."',
                                 bf_download = '0' ";

                sql_query($sql4);
                // 파일이 많다면 주석처리 하세요. 시작 (파일은 그냥 복사하셔도 됩니다.)
                //@copy("$source_file/$source/$image_file", "$g4[path]/data/file/$target/$image_file");
                //@chmod("$g4[path]/data/file/$target/$image_file", 0606);
                // 파일이 많다면 주석처리 하세요. 끝
                $rich_content .= "\{이미지:{$bf_no}\}\n".addslashes($row3[wf_cont])."\n\n";
                $bf_no++;    
            }
        }

        if ($rich_content) {
            $sql5 = " update $tmp_target
                         set wr_content = '$rich_content'
                       where wr_id = '$row[wr_id]' ";
            sql_query($sql5);
        }
    }

    $category_list = $bar = "";
    for ($i=1; $i<=count($category); $i++) {
        $category_list .= $bar . $category[$i];
        $bar = "|";
    }

    //sql_query(" update $g4[board_table] set bo_notice = '$notice', bo_category_list = '$category_list' where bo_table = '$target' ");

    echo <<<HEREDOC
    <script language="JavaScript">
        alert("변환 하였습니다.");
    </script>
HEREDOC;
}
?>

<br>
<br>
<br>
<table align=center>
<form name=f method=post action="javascript:f_submit(document.f);" autocomplete="off">
<input type=hidden name=proc value=1>
<tr>
	<td height=50 align=center><strong><?=$g4[title]?></strong></td>
</tr>
<tr>
	<td height=30>그누보드3 = 원본 , 그누보드4 = 복사본</td>
</tr>
<tr>
	<td height=30>그누보드3 게시판명 : <input type=text name=source value="<?=$source?>" required></td>
</tr>
<tr>
	<td height=30>파&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;일&nbsp; 디렉토리 : <input type=text name=source_file value="<?=$source_file?>" required> 절대경로</td>
</tr>
<tr>
	<td height=10><hr></td>
</tr>
<tr>
	<td height=30>포&nbsp;&nbsp;에&nbsp;&nbsp;버&nbsp; 게시판명 : <input type=text name=target value="<?=$target?>" required></td>
</tr>
<tr>
	<td height=30>원본과 복사본은 같은 DB 내에 있다고 가정합니다.</td>
</tr>
<tr>
	<td align=center height=60><br><input name=trans type=submit value=" 변환하기 "> <input type=button value="메뉴" onclick="location.href='./';"></td>
</tr>
<tr>
	<td height=30><b>변환후 <a href="<?=$g4[admin_path]?>/board_form.php?w=u&bo_table=<?=$target?>" target=_blank>관리자화면</a>에서 카운트조정에 체크한 후 확인 버튼을 클릭하십시오.</b></td>
</tr>
</form>
</table>

<script language="JavaScript">
function f_submit(f)
{
    f.trans.value = " 변환중... ";
    f.trans.disabled = true;
    f.action = "";
    f.submit();
}
</script>

<?
include_once("$g4[path]/tail.sub.php");
?>
