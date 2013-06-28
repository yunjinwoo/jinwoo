<?
/*******************************************************************************
** 공통 변수, 상수, 코드
*******************************************************************************/
error_reporting(E_ALL ^ E_NOTICE);

// 보안설정이나 프레임이 달라도 쿠키가 통하도록 설정
header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');

if (!isset($set_time_limit)) $set_time_limit = 0;
@set_time_limit($set_time_limit);

// 짧은 환경변수를 지원하지 않는다면
if (isset($HTTP_POST_VARS) && !isset($_POST)) {
	$_POST   = &$HTTP_POST_VARS;
	$_GET    = &$HTTP_GET_VARS;
	$_SERVER = &$HTTP_SERVER_VARS;
	$_COOKIE = &$HTTP_COOKIE_VARS;
	$_ENV    = &$HTTP_ENV_VARS;
	$_FILES  = &$HTTP_POST_FILES;

    if (!isset($_SESSION))
		$_SESSION = &$HTTP_SESSION_VARS;
}

//
// phpBB2 참고
// php.ini 의 magic_quotes_gpc 값이 FALSE 인 경우 addslashes() 적용
// SQL Injection 등으로 부터 보호
//
if( !get_magic_quotes_gpc() )
{
	if( is_array($_GET) )
	{
		while( list($k, $v) = each($_GET) )
		{
			if( is_array($_GET[$k]) )
			{
				while( list($k2, $v2) = each($_GET[$k]) )
				{
					$_GET[$k][$k2] = addslashes($v2);
				}
				@reset($_GET[$k]);
			}
			else
			{
				$_GET[$k] = addslashes($v);
			}
		}
		@reset($_GET);
	}

	if( is_array($_POST) )
	{
		while( list($k, $v) = each($_POST) )
		{
			if( is_array($_POST[$k]) )
			{
				while( list($k2, $v2) = each($_POST[$k]) )
				{
					$_POST[$k][$k2] = addslashes($v2);
				}
				@reset($_POST[$k]);
			}
			else
			{
				$_POST[$k] = addslashes($v);
			}
		}
		@reset($_POST);
	}

	if( is_array($_COOKIE) )
	{
		while( list($k, $v) = each($_COOKIE) )
		{
			if( is_array($_COOKIE[$k]) )
			{
				while( list($k2, $v2) = each($_COOKIE[$k]) )
				{
					$_COOKIE[$k][$k2] = addslashes($v2);
				}
				@reset($_COOKIE[$k]);
			}
			else
			{
				$_COOKIE[$k] = addslashes($v);
			}
		}
		@reset($_COOKIE);
	}
}


// PHP 4.1.0 부터 지원됨
// php.ini 의 register_globals=off 일 경우
@extract($_GET);
@extract($_POST);
@extract($_SERVER); 

// 완두콩님이 알려주신 보안관련 오류 수정
// $member 에 값을 직접 넘길 수 있음
$config = array();
$member = array();
$board  = array();
$group  = array();
$g4     = array();

// index.php 가 있는곳의 상대경로
// php 인젝션 ( 임의로 변수조작으로 인한 리모트공격) 취약점에 대비한 코드
// prosper 님께서 알려주셨습니다.
if (!$g4_path || preg_match("/:\/\//", $g4_path))
    die("<meta http-equiv='content-type' content='text/html; charset=$g4[charset]'><script language='JavaScript'> alert('잘못된 방법으로 변수가 정의되었습니다.'); </script>");    
//if (!$g4_path) $g4_path = ".";
$g4['path'] = $g4_path;

// 경로의 오류를 없애기 위해 $g4_path 변수는 해제
unset($g4_path);

// 내가 쓰던 함수들...

//$add_path = $g4['path'].'/../add' ;
//include_once($add_path."/_default.php");  
/**

include_once("$g4[path]/../PHP/function/default.php");  // 내가 쓰던 함수들...

**/

include_once("$g4[path]/lib/constant.php");  // 상수 정의
include_once("$g4[path]/config.php");  // 설정 파일
include_once("$g4[path]/lib/common.lib.php"); // 공통 라이브러리

// config.php 가 있는곳의 웹경로
if (!$g4['url']) 
{
    $g4['url'] = 'http://' . $_SERVER['HTTP_HOST'];
    $dir = dirname($HTTP_SERVER_VARS["PHP_SELF"]);
    if (!file_exists("config.php"))
        $dir = dirname($dir);
    $cnt = substr_count($g4['path'], "..");
    for ($i=2; $i<=$cnt; $i++) 
        $dir = dirname($dir);
    $g4['url'] .= $dir;
}
// \ 를 / 롤 변경
$g4['url'] = strtr($g4['url'], "\\", "/");
// url 의 끝에 있는 / 를 삭제한다.
$g4['url'] = preg_replace("/\/$/", "", $g4['url']);

//==============================================================================
// 공통
//==============================================================================
$dirname = dirname(__FILE__).'/';
$dbconfig_file = "dbconfig.php";
if (file_exists("$g4[path]/$dbconfig_file")) 
{
    if (is_dir("$g4[path]/install")) die("<meta http-equiv='content-type' content='text/html; charset=$g4[charset]'><script language='JavaScript'> alert('install 디렉토리를 삭제하여야 정상 실행됩니다.'); </script>");

    include_once("$g4[path]/$dbconfig_file");
    $connect_db = sql_connect($mysql_host, $mysql_user, $mysql_password);
    $select_db = sql_select_db($mysql_db, $connect_db);
    if (!$select_db) 
        die("<meta http-equiv='content-type' content='text/html; charset=$g4[charset]'><script language='JavaScript'> alert('DB 접속 오류'); </script>");
} 
else 
{
    echo "<meta http-equiv='content-type' content='text/html; charset=$g4[charset]'>";
    echo <<<HEREDOC
    <script language="JavaScript">
    alert("DB 설정 파일이 존재하지 않습니다.\\n\\n프로그램 설치 후 실행하시기 바랍니다.");
    location.href = "./install/";
    </script>
HEREDOC;
    exit;
}
unset($my); // DB 설정값을 클리어 해줍니다.

//print_r2($GLOBALS);

//-------------------------------------------
// SESSION 설정
//-------------------------------------------
ini_set("session.use_trans_sid", 0);    // PHPSESSID를 자동으로 넘기지 않음
ini_set("url_rewriter.tags",""); // 링크에 PHPSESSID가 따라다니는것을 무력화함 (해뜰녘님께서 알려주셨습니다.)

session_save_path("{$g4['path']}/data/session");

if (isset($SESSION_CACHE_LIMITER)) 
    @session_cache_limiter($SESSION_CACHE_LIMITER);
else 
    @session_cache_limiter("no-cache, must-revalidate");

//==============================================================================
// 공용 변수
//==============================================================================
// 기본환경설정
// 기본적으로 사용하는 필드만 얻은 후 상황에 따라 필드를 추가로 얻음
$config = sql_fetch(" select * from $g4[config_table] ");

ini_set("session.cache_expire", 180); // 세션 캐쉬 보관시간 (분)
ini_set("session.gc_maxlifetime", 1440); // session data의 gabage collection 존재 기간을 지정 (초)

session_set_cookie_params(0, "/");
ini_set("session.cookie_domain", $g4['cookie_domain']); 

@session_start();

// 4.00.03 : [보안관련] PHPSESSID 가 틀리면 로그아웃한다.
if ($_REQUEST['PHPSESSID'] && $_REQUEST['PHPSESSID'] != session_id())
    goto_url("{$g4['bbs_path']}/logout.php");

// QUERY_STRING
$qstr = "";
/*
if (isset($bo_table))   $qstr .= 'bo_table=' . urlencode($bo_table);
if (isset($wr_id))      $qstr .= '&wr_id=' . urlencode($wr_id);
*/
if (isset($sca))  $qstr .= '&sca=' . urlencode($sca);
if (isset($sfl))  $qstr .= '&sfl=' . urlencode($sfl); // search field (검색 필드)
if (isset($stx))  $qstr .= '&stx=' . urlencode($stx); // search text (검색어)
if (isset($sst))  $qstr .= '&sst=' . urlencode($sst); // search sort (검색 정렬 필드)
if (isset($sod))  $qstr .= '&sod=' . urlencode($sod); // search order (검색 오름, 내림차순)
if (isset($sop))  $qstr .= '&sop=' . urlencode($sop); // search operator (검색 or, and 오퍼레이터)
if (isset($spt))  $qstr .= '&spt=' . urlencode($spt); // search part (검색 파트[구간])
if (isset($page)) $qstr .= '&page=' . urlencode($page);

// URL ENCODING
if (isset($url)) 
    $urlencode = urlencode($url);
else 
    //$urlencode = urlencode($_SERVER[REQUEST_URI]);
    $urlencode = $_SERVER['REQUEST_URI'];
//===================================

/* 코드 위치 수정 (최하단으로 내림)
// common.php 파일을 수정할 필요가 없도록 확장합니다.
$tmp = dir("$g4[path]/extend");
while ($entry = $tmp->read()) {
    // php 파일만 include 함
    if (preg_match("/(\.php)$/i", $entry)) 
        include_once("$g4[path]/extend/$entry");
}
*/


// 자동로그인 부분에서 첫로그인에 포인트 부여하던것을 로그인중일때로 변경하면서 코드도 대폭 수정하였습니다.
if ($_SESSION['ss_mb_id']) // 로그인중이라면
{
    $member = get_member($_SESSION['ss_mb_id']);

    // 오늘 처음 로그인 이라면
    if (substr($member['mb_today_login'], 0, 10) != $g4['time_ymd'])
    {
        // 첫 로그인 포인트 지급
        insert_point($member['mb_id'], $config['cf_login_point'], "{$g4['time_ymd']} 첫로그인", "@login", $member['mb_id'], $g4['time_ymd']);

        // 오늘의 로그인이 될 수도 있으며 마지막 로그인일 수도 있음
        // 해당 회원의 접근일시와 IP 를 저장
        $sql = " update {$g4['member_table']} set mb_today_login = '{$g4['time_ymdhis']}', mb_login_ip = '{$_SERVER['REMOTE_ADDR']}' where mb_id = '{$member['mb_id']}' ";
        sql_query($sql);
    }
} 
else 
{
    // 자동로그인 ---------------------------------------
    // 회원아이디가 쿠키에 저장되어 있다면 (3.27)
    if ($tmp_mb_id = get_cookie("ck_mb_id")) 
    {
        // 최고관리자는 자동로그인 금지
        if ($tmp_mb_id != $config['cf_admin']) 
        {
            $sql = " select mb_password, mb_intercept_date, mb_leave_date, mb_email_certify
                       from {$g4['member_table']} where mb_id = '$tmp_mb_id' ";
            $row = sql_fetch($sql);
            $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $row['mb_password']);
            // 쿠키에 저장된 키와 같다면
            $tmp_key = get_cookie("ck_auto");
            if ($tmp_key == $key && $tmp_key) 
            {
                // 차단, 탈퇴가 아니고 메일인증이 사용이면서 인증을 받았다면
                if ($row['mb_intercept_date'] == "" && 
                    $row['mb_leave_date'] == "" && 
                    (!$config['cf_use_email_certify'] || preg_match('/[1-9]/', $row['mb_email_certify'])) )
                {
                    // 세션에 회원아이디를 저장하여 로그인으로 간주
                    set_session("ss_mb_id", $tmp_mb_id);

                    // 페이지를 재실행
                    echo "<script language='javascript'> window.location.reload(); </script>";
                    exit;
                }
            }
            // $row 배열변수 해제
            unset($row);
        }
    }
    // 자동로그인 end ---------------------------------------
}

// 첫방문 쿠키
// 1년간 저장
if (!get_cookie("ck_first_call"))     set_cookie("ck_first_call", $g4[server_time], 86400 * 365);
if (!get_cookie("ck_first_referer"))  set_cookie("ck_first_referer", $_SERVER[HTTP_REFERER], 86400 * 365);

// 회원이 아니라면 권한을 방문객 권한으로 함
if (!($member['mb_id'])) 
    $member['mb_level'] = 1;
else
    $member['mb_dir'] = substr($member['mb_id'],0,2);

//$member['mb_level_title'] = $g4['member_level'][$member['mb_level']]; // 권한명

if (isset($bo_table)) {
    $board = sql_fetch(" select * from {$g4['board_table']} where bo_table = '$bo_table' ");
    if ($board['bo_table']) {
        $gr_id = $board['gr_id'];
        $write_table = $g4['write_prefix'] . $bo_table; // 게시판 테이블 전체이름
        //$comment_table = $g4['write_prefix'] . $bo_table . $g4['comment_suffix']; // 코멘트 테이블 전체이름
        if ($wr_id)
            $write = sql_fetch(" select * from $write_table where wr_id = '$wr_id' ");
    }
}

if (isset($gr_id))
    $group = sql_fetch(" select * from {$g4['group_table']} where gr_id = '$gr_id' ");


// 회원, 비회원 구분
$is_member = $is_guest = false;
if ($member['mb_id'])
    $is_member = true;
else
    $is_guest = true;


$is_admin = is_admin($member['mb_id']);
if ($is_admin != "super") {
    // 접근가능 IP
    $cf_possible_ip = trim($config['cf_possible_ip']);
    if ($cf_possible_ip) {
        $is_possible_ip = false;
        $pattern = explode("\n", $cf_possible_ip);
        for ($i=0; $i<count($pattern); $i++) {
            $pattern[$i] = trim($pattern[$i]);
            if (empty($pattern[$i])) 
                continue;

            //$pat = "/({$pattern[$i]})/";
            $pattern[$i] = str_replace(".", "\.", $pattern[$i]);
            $pat = "/^{$pattern[$i]}/";
            $is_possible_ip = preg_match($pat, $_SERVER['REMOTE_ADDR']);
            if ($is_possible_ip) 
                break;
        }
        if (!$is_possible_ip)
            die ("접근이 가능하지 않습니다.");
    }

    // 접근차단 IP
    $is_intercept_ip = false;
    $pattern = explode("\n", trim($config['cf_intercept_ip']));
    for ($i=0; $i<count($pattern); $i++) {
        $pattern[$i] = trim($pattern[$i]);
        if (empty($pattern[$i])) 
            continue;

        $pattern[$i] = str_replace(".", "\.", $pattern[$i]);
        $pat = "/^{$pattern[$i]}/";
        $is_intercept_ip = preg_match($pat, $_SERVER['REMOTE_ADDR']);
        if ($is_intercept_ip) 
            die ("접근 불가합니다.");
    }
}

$board_skin_path = ''; // 
// 스킨경로
if (isset($board['bo_skin']))
    $board_skin_path = "{$g4['path']}/skin/board/{$board['bo_skin']}"; // 게시판 스킨 경로

// 방문자수의 접속을 남김
include_once("{$g4['bbs_path']}/visit_insert.inc.php");


// common.php 파일을 수정할 필요가 없도록 확장합니다.
$tmp = dir("$g4[path]/extend");
while ($entry = $tmp->read()) {
    // php 파일만 include 함
    if (preg_match("/(\.php)$/i", $entry)) 
        include_once("$g4[path]/extend/$entry");
}
?>
