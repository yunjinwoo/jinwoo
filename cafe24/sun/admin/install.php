-- phpMyAdmin SQL Dump
-- version 2.11.5.1
-- http://www.phpmyadmin.net
--
-- 호스트: localhost
-- 처리한 시간: 12-09-13 14:47 
-- 서버 버전: 5.1.45
-- PHP 버전: 5.2.9p2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 데이터베이스: `aofurakswja2`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `add_board_comment`
--

CREATE TABLE IF NOT EXISTS `add_board_comment` (
  `comment_idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `board_idx` int(10) unsigned NOT NULL DEFAULT '0',
  `board_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `is_lock` char(1) CHARACTER SET utf8 NOT NULL DEFAULT 'N' COMMENT '작성자만 확인:Y,N',
  `write_name` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `userid` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `passwd` varchar(55) CHARACTER SET utf8 NOT NULL COMMENT '비밀번호(md5)',
  `comment` text CHARACTER SET utf8 NOT NULL,
  `write_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `comment_idx` (`comment_idx`)
) ENGINE=MyISAM DEFAULT CHARSET=euckr AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `add_board_data`
--

CREATE TABLE IF NOT EXISTS `add_board_data` (
  `board_idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `board_id` varchar(50) NOT NULL COMMENT '게시판코드',
  `user_id` varchar(50) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `idx_group` int(11) DEFAULT NULL,
  `dep_step` float unsigned DEFAULT '100',
  `passwd` varchar(20) NOT NULL DEFAULT '',
  `category` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL,
  `write_name` varchar(30) NOT NULL DEFAULT '',
  `subject` varchar(255) DEFAULT NULL,
  `homepage` varchar(30) NOT NULL,
  `content` text,
  `islock` char(1) NOT NULL DEFAULT 'n',
  `rcount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '조회수',
  `recom` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '댓글수??',
  `write_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `stauts` char(1) NOT NULL DEFAULT '1' COMMENT '1-정상,2-삭제,3-그외',
  PRIMARY KEY (`board_idx`),
  KEY `board_id` (`board_id`),
  KEY `user_id` (`user_id`),
  KEY `stauts` (`stauts`),
  KEY `idx_group` (`idx_group`),
  KEY `dep_step` (`dep_step`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `add_board_set`
--

CREATE TABLE IF NOT EXISTS `add_board_set` (
  `board_id` varchar(50) NOT NULL COMMENT '게시판아이디',
  `board_name` varchar(50) NOT NULL COMMENT '게시판이름',
  `page_size` tinyint(3) unsigned NOT NULL COMMENT '페이지 출력갯수',
  `board_type` enum('free','qa','poll') NOT NULL DEFAULT 'free' COMMENT '게시판 기능 구분',
  `board_skin` varchar(30) NOT NULL COMMENT '게시판스킨',
  `is_use_file` enum('Y','N') DEFAULT 'N',
  `is_use_secret` enum('Y','N','A') DEFAULT 'N',
  `category` text NOT NULL COMMENT '카테고리',
  `level_admin` tinyint(3) unsigned NOT NULL COMMENT '레벨-관리자',
  `level_write` tinyint(3) unsigned NOT NULL COMMENT '레벨-쓰기',
  `level_view` tinyint(3) unsigned NOT NULL COMMENT '레벨-보기',
  `level_comment` tinyint(3) unsigned NOT NULL COMMENT '레벨-댓글',
  `img_new_hour` int(10) unsigned NOT NULL DEFAULT '48' COMMENT 'New 이미지 출력 시간',
  `img_hot_cnt` int(10) unsigned NOT NULL DEFAULT '40' COMMENT 'Hot 이미지 출력 조건(조회수)',
  `list_count` int(10) unsigned NOT NULL DEFAULT '15' COMMENT '리스트 출력 갯수',
  UNIQUE KEY `board_id` (`board_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='게시판 설정 정보';

-- --------------------------------------------------------

--
-- 테이블 구조 `add_log`
--

CREATE TABLE IF NOT EXISTS `add_log` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_host` varchar(10) NOT NULL DEFAULT 'web' COMMENT 'web, mobile',
  `session_id` varchar(100) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `page` varchar(200) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idx`),
  KEY `session_id` (`session_id`),
  KEY `time` (`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `add_log_page`
--

CREATE TABLE IF NOT EXISTS `add_log_page` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_idx` int(10) unsigned NOT NULL,
  `page` varchar(200) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `stay_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idx`),
  KEY `log_idx` (`log_idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 테이블 구조 `add_log_refer`
--

CREATE TABLE IF NOT EXISTS `add_log_refer` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_idx` int(10) unsigned NOT NULL,
  `page_idx` int(10) unsigned NOT NULL,
  `domain` varchar(50) NOT NULL,
  `refer` varchar(200) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idx`),
  KEY `log_idx` (`log_idx`,`page_idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;




INSERT INTO `add_board_set` (`board_id`, `board_name`, `page_size`, `board_type`, `board_skin`, `is_use_file`, `is_use_secret`, `category`, `level_admin`, `level_write`, `level_view`, `level_comment`, `img_new_hour`, `img_hot_cnt`, `list_count`) VALUES
('notice', '공지사항', 10, 'free', 'basic', 'Y', 'Y', '', 9, 9, 0, 9, 24, 100, 10);