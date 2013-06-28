<?
include_once("./_common.php");

if ($is_admin != "super")
    alert("최고관리자만 변환 가능합니다", "$g4[bbs_path]/login.php?url=".urlencode($_SERVER[PHP_SELF]));

if (!$source || !$target)
    alert("그누보드3 와 그누보드4 게시판 두개 모두 선택하여 주십시오.");

$tmp_source = "gb_write_" . $source;
$tmp_target = $g4[write_prefix] . $target;

$notice = "";
$cr = "";
$comment = -1;

$category = array();
$sql = " select ca_id, ca_name from {$tmp_source}_cat order by ca_id ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $category[$row[ca_id]] = $row[ca_name];
}

$sql = " select * from $tmp_source ";
$result = sql_query($sql);
// 원본 자료가 있을 경우에만 타켓 테이블 내용 삭제
if (mysql_num_rows($result))
{
    sql_query(" delete from $tmp_target ");
    sql_query(" delete from $g4[board_file_table] where bo_table = '$target' ");
}

echo "$tmp_source → $tmp_target 변환중 ...<br>";
flush();
for ($i=0; $row=sql_fetch_array($result); $i++) 
{
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

    $bf_no = 0;
    if ($row[wr_file1]) {
        //@copy("$source_file/$source/$row[wr_file1]", "$g4[path]/data/file/$target/$row[wr_file1]");
        //@chmod("$g4[path]/data/file/$target/$row[wr_file1]", 0606);

        $sql3 = " insert into $g4[board_file_table]
                     set bo_table = '$target',
                         wr_id = '$row[wr_id]',
                         bf_no = '$bf_no',
                         bf_source = '".addslashes($row[wr_file1_source])."',
                         bf_file = '".addslashes($row[wr_file1])."',
                         bf_download = '$row[wr_file1_download]' ";

        sql_query($sql3);

        $bf_no++;
    }

    if ($row[wr_file2]) {
        //@copy("$source_file/$source/$row[wr_file2]", "$g4[path]/data/file/$target/$row[wr_file2]");
        //@chmod("$g4[path]/data/file/$target/$row[wr_file2]", 0606);
    
        $sql3 = " insert into $g4[board_file_table]
                     set bo_table = '$target',
                         wr_id = '$row[wr_id]',
                         bf_no = '$bf_no',
                         bf_source = '".addslashes($row[wr_file2_source])."',
                         bf_file = '".addslashes($row[wr_file2])."',
                         bf_download = '$row[wr_file2_download]' ";

        sql_query($sql3);
    }

    echo "□";

    $k=$i+1;
    if ($k%50==0) 
    {
        echo "<br>"; 
        flush();
    }
}

echo "<br>총 {$i}건 변환 완료.";
flush();


$category_list = $bar = "";
for ($i=1; $i<=count($category); $i++) 
{
    $category_list .= $bar . $category[$i];
    $bar = "|";
}

sql_query(" update $g4[board_table] set bo_notice = '$notice', bo_category_list = '$category_list' where bo_table = '$target' ");
?>

<p><a href='./g3_board_multi.php'>게시판 멀티로 이동</a>
