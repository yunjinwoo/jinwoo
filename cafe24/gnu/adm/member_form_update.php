<?
$sub_menu = "200100";
include_once("./_common.php");

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], "w");

$sql_common = " mb_name         = '$mb_name',
                mb_nick         = '$mb_nick',
                mb_email        = '$mb_email',
                mb_homepage     = '$mb_homepage',
                mb_tel          = '$mb_tel',
                mb_hp           = '$mb_hp',
                mb_zip1         = '$mb_zip1',
                mb_zip2         = '$mb_zip2',
                mb_addr1        = '$mb_addr1',
                mb_addr2        = '$mb_addr2',
                mb_birth        = '$mb_birth',
                mb_sex          = '$mb_sex',
                mb_signature    = '$mb_signature',
                mb_leave_date   = '$mb_leave_date',
                mb_intercept_date='$mb_intercept_date',
                mb_memo         = '$mb_memo',
                mb_mailling     = '$mb_mailling',
                mb_sms          = '$mb_sms',
                mb_open         = '$mb_open',
                mb_profile      = '$mb_profile',
                mb_level        = '$mb_level',
                mb_1            = '$mb_1',
                mb_2            = '$mb_2',
                mb_3            = '$mb_3',
                mb_4            = '$mb_4',
                mb_5            = '$mb_5',
                mb_6            = '$mb_6',
                mb_7            = '$mb_7',
                mb_8            = '$mb_8',
                mb_9            = '$mb_9',
                mb_10           = '$mb_10' ";

if ($w == "")
{
    $mb = get_member($mb_id);
    if ($mb[mb_id])
        alert("이미 존재하는 회원입니다.\\n\\nＩＤ : $mb[mb_id]\\n\\n이름 : $mb[mb_name]\\n\\n별명 : $mb[mb_nick]\\n\\n메일 : $mb[mb_email]");

    if ($mb[mb_nick] == $mb_nick)
        alert("이미 존재하는 별명입니다.\\n\\nＩＤ : $mb[mb_id]\\n\\n이름 : $mb[mb_name]\\n\\n별명 : $mb[mb_nick]\\n\\n메일 : $mb[mb_email]");

    if ($mb[mb_email] == $mb_email)
        alert("이미 존재하는 E-mail 입니다.\\n\\nＩＤ : $mb[mb_id]\\n\\n이름 : $mb[mb_name]\\n\\n별명 : $mb[mb_nick]\\n\\n메일 : $mb[mb_email]");

    sql_query(" insert into $g4[member_table] set mb_id = '$mb_id', mb_password = '".sql_password($mb_password)."', mb_datetime = '$g4[time_ymdhis]', mb_ip = '$_SERVER[REMOTE_ADDR]', mb_email_certify = '$g4[time_ymdhis]', $sql_common  ");
}
else if ($w == "u")
{
    $mb = get_member($mb_id);
    if (!$mb[mb_id])
        alert("존재하지 않는 회원자료입니다.");

    if ($is_admin != "super" && $mb[mb_level] >= $member[mb_level])
        alert("자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.");

    $mb_dir = substr($mb_id,0,2);

    // 회원 아이콘 삭제
    if ($del_mb_icon)
        @unlink("$g4[path]/data/member/$mb_dir/$mb_id.gif");

    // 아이콘 업로드
    if (is_uploaded_file($_FILES[mb_icon][tmp_name])) {
        if (!preg_match("/(\.gif)$/i", $_FILES[mb_icon][name])) {
            alert($_FILES[mb_icon][name] . '은(는) gif 파일이 아닙니다.');
        }

        if (preg_match("/(\.gif)$/i", $_FILES[mb_icon][name])) {
            @mkdir("$g4[path]/data/member/$mb_dir", 0707);
            @chmod("$g4[path]/data/member/$mb_dir", 0707);

            $dest_path = "$g4[path]/data/member/$mb_dir/$mb_id.gif";

            move_uploaded_file($_FILES[mb_icon][tmp_name], $dest_path);
            chmod($dest_path, 0606);

            if (file_exists($dest_path)) {
                $size = getimagesize($dest_path);
                // 아이콘의 폭 또는 높이가 설정값 보다 크다면 이미 업로드 된 아이콘 삭제
                if ($size[0] > $config[cf_member_icon_width] || $size[1] > $config[cf_member_icon_height]) {
                    @unlink($dest_path);
                }
            }
        }
    }

    if ($mb_password)
        $sql_password = " , mb_password = '".sql_password($mb_password)."' ";
    else
        $sql_password = "";

    if ($passive_certify)
        $sql_certify = " , mb_email_certify = '$g4[time_ymdhis]' ";
    else
        $sql_certify = "";

    $sql = " update $g4[member_table]
                set $sql_common
                    $sql_password
                    $sql_certify
              where mb_id = '$mb_id' ";
    sql_query($sql);
}
else
    alert("제대로 된 값이 넘어오지 않았습니다.");

goto_url("./member_form.php?$qstr&w=u&mb_id=$mb_id");
?>
