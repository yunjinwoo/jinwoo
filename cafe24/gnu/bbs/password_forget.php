<?
include_once("./_common.php");

if ($member[mb_id]) 
{
    echo <<<HEREDOC
    <script language="javascript">
        alert("이미 로그인중입니다.");
        window.close();
        opener.document.location.reload();
    </script>
HEREDOC;
    exit;
}

$g4[title] = "회원아이디/패스워드 찾기";
include_once("$g4[path]/head.sub.php");

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$member_skin_path/password_forget.skin.php");

include_once("$g4[path]/tail.program.php");
?>
