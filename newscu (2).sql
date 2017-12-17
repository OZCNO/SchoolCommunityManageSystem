-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-09-27 15:59:37
-- 服务器版本： 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newscu`
--

-- --------------------------------------------------------

--
-- 表的结构 `activity_apply`
--

CREATE TABLE `activity_apply` (
  `aNO` int(10) UNSIGNED NOT NULL,
  `sName` varchar(30) NOT NULL COMMENT '社团名称',
  `applicantName` varchar(10) NOT NULL COMMENT '申报人名称',
  `aName` varchar(10) NOT NULL COMMENT '活动名称',
  `date_of_activity` datetime NOT NULL COMMENT '活动时间',
  `aType` varchar(30) NOT NULL COMMENT '活动形式',
  `aPlace` varchar(50) NOT NULL COMMENT '活动地点',
  `aPerson` varchar(20) NOT NULL COMMENT '活动对象',
  `aTel` varchar(11) NOT NULL COMMENT '联系方式',
  `ahName` varchar(10) DEFAULT NULL COMMENT '活动跟进人',
  `aeName` varchar(11) DEFAULT NULL COMMENT '活动评估人',
  `isBrand` enum('是','否') NOT NULL DEFAULT '是' COMMENT '是否为品牌活动',
  `aSummary` text NOT NULL COMMENT '活动简介',
  `date_of_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '申报/提交日期',
  `review` int(1) NOT NULL DEFAULT '0' COMMENT '是否审核'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `activity_apply`
--

INSERT INTO `activity_apply` (`aNO`, `sName`, `applicantName`, `aName`, `date_of_activity`, `aType`, `aPlace`, `aPerson`, `aTel`, `ahName`, `aeName`, `isBrand`, `aSummary`, `date_of_entry`, `review`) VALUES
(1, '武术协会', '龟仙人', '天下第一武道大会', '2016-12-12 19:00:00', '晚会形式', '7栋301 ', '全体会员', '15119991597', NULL, NULL, '否', '简介简介简介简介简介天下第一武道大会', '2017-07-03 13:27:39', 1),
(6, '武术协会', '李小龙', 'WWE', '2016-12-14 19:30:00', '打擂形式', '青年广场 ', '全体会员', '15113561597', NULL, NULL, '是', '简介简介简介简介简介哈哈哈哈哈哈', '2016-12-09 12:38:30', 1),
(13, '武术协会', '李刚', '武术表演', '2016-12-23 19:10:00', '表演', '青年广场', '全体学生', '18694284906', NULL, NULL, '是', '精彩的武术表演 23号19:10不见不散', '2017-06-05 07:28:25', 1),
(14, '武术协会', '李四光', '武术表演', '2016-12-06 16:00:00', '表演', '青年广场', '全体学生', '18738928999', NULL, NULL, '', '表演', '2017-06-05 07:28:30', 2),
(18, '武术协会', '林多', '社团嘉年华', '2016-12-23 19:00:00', '表演', '青年广场', '全体学生', '18747478383', NULL, NULL, '是', '社团嘉年华', '2016-12-09 13:06:45', 0),
(23, '武术协会', '王朗', '武动乾坤', '2016-12-09 18:00:00', '表演', '青年广场', '全体会员', '18584783848', NULL, NULL, '是', '武动乾坤', '2016-12-09 13:36:07', 0),
(24, '出雲音乐协会', 'jds', 'j;lsd;s', '2017-07-06 00:00:00', 'j;ldfsl', 'jd;fsgj', 'jdsl;f', 'jsd;gf;a', NULL, NULL, '是', 'j;fdsj', '2017-07-03 13:55:39', 0),
(25, '大学生职业生涯规划研究协会', 'wang', 'fjl;dsa', '2017-07-04 00:00:00', 'jl;asdfjl;', 'jl;safd', 'j;lasd', ';jlfjsdl;a', NULL, NULL, '是', 'j;lsdl;jkfl;', '2017-07-18 12:30:29', 0);

-- --------------------------------------------------------

--
-- 表的结构 `concern`
--

CREATE TABLE `concern` (
  `Username` char(11) NOT NULL,
  `sNO` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='关注';

--
-- 转存表中的数据 `concern`
--

INSERT INTO `concern` (`Username`, `sNO`) VALUES
('151541137', 1),
('151541137', 3);

-- --------------------------------------------------------

--
-- 表的结构 `goodsinfo`
--

CREATE TABLE `goodsinfo` (
  `goodsId` int(3) NOT NULL,
  `goodsName` varchar(50) NOT NULL,
  `goodsPrice` float NOT NULL,
  `goodsType` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `index_video`
--

CREATE TABLE `index_video` (
  `videoID` int(2) NOT NULL,
  `videoName` varchar(50) CHARACTER SET latin1 NOT NULL,
  `videoDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `index_video`
--

INSERT INTO `index_video` (`videoID`, `videoName`, `videoDate`) VALUES
(1, 'video1.mp4\r\n                                      ', '2016-11-10 22:11:30');

-- --------------------------------------------------------

--
-- 表的结构 `msg_feedback`
--

CREATE TABLE `msg_feedback` (
  `msg_id` int(11) NOT NULL COMMENT '自增长id',
  `msg_title` varchar(100) NOT NULL COMMENT '反馈的标题',
  `msg_content` text NOT NULL COMMENT '反馈的内容',
  `msg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '反馈提交的时间',
  `msg_who` varchar(9) NOT NULL COMMENT '谁反馈的，学号9位',
  `msg_flag` bit(1) NOT NULL DEFAULT b'1' COMMENT '判断是回复还是反馈'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='信息反馈的表';

--
-- 转存表中的数据 `msg_feedback`
--

INSERT INTO `msg_feedback` (`msg_id`, `msg_title`, `msg_content`, `msg_date`, `msg_who`, `msg_flag`) VALUES
(1, '这么系统太烂了', '你们这个系统做的太烂了，我要投诉！！！', '2017-07-17 17:40:15', '151543243', b'1'),
(8, 'fdsajk', 'fdjklajfs', '2017-08-10 20:58:14', '151543243', b'0'),
(6, 'INF', '·节流阀似懂非懂', '2017-07-17 21:20:02', '151543243', b'1'),
(7, '哈哈', '京东方', '2017-07-17 21:26:35', '151543243', b'0');

-- --------------------------------------------------------

--
-- 表的结构 `scu_activity`
--

CREATE TABLE `scu_activity` (
  `aNo` int(4) NOT NULL,
  `aName` varchar(60) NOT NULL,
  `hName` varchar(30) NOT NULL,
  `location` enum('轮播图','公告') NOT NULL DEFAULT '公告',
  `category` enum('热门活动','火热进行','往期回顾') NOT NULL DEFAULT '热门活动',
  `date_of_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aContent` text NOT NULL,
  `aImg` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `scu_activity`
--

INSERT INTO `scu_activity` (`aNo`, `aName`, `hName`, `location`, `category`, `date_of_entry`, `aContent`, `aImg`) VALUES
(26, '大创', '大王', '轮播图', '热门活动', '2017-09-14 10:48:35', '<p><img src="/SCU/web/img/images/upload/20170914/1505386108518446.jpg" title="1505386108518446.jpg" alt="12.jpg"/>呵呵呵</p>', '/SCU/web/img/images/upload/20170914/1505386108518446.jpg'),
(28, '软件设计大赛', '大王', '轮播图', '热门活动', '2017-09-14 12:11:49', '<p><img src="/SCU/web/img/images/upload/20170914/1505391106484193.jpg" title="1505391106484193.jpg" alt="48.jpg"/></p>', '/SCU/web/img/images/upload/20170914/1505391106484193.jpg'),
(29, '活动1', '大王', '公告', '热门活动', '2017-09-14 12:13:20', '<p><img src="/SCU/web/img/images/upload/20170914/1505391198118298.jpg" title="1505391198118298.jpg" alt="45.jpg"/></p>', '/SCU/web/img/images/upload/20170914/1505391198118298.jpg'),
(30, '活动2', '大王', '公告', '热门活动', '2017-09-14 12:13:42', '<p><img src="/SCU/web/img/images/upload/20170914/1505391220915458.jpg" title="1505391220915458.jpg" alt="78.jpg"/></p>', '/SCU/web/img/images/upload/20170914/1505391220915458.jpg'),
(31, '活动3', '大王', '公告', '往期回顾', '2017-09-14 12:14:13', '<p><img src="/SCU/web/img/images/upload/20170914/1505393411137021.jpg" title="1505393411137021.jpg" alt="36.jpg" width="396" height="536"/>没有图片</p>', '/SCU/web/img/images/upload/20170914/1505393411137021.jpg'),
(32, '活动4', '大王', '公告', '火热进行', '2017-09-14 12:14:39', '<p><img src="/SCU/web/img/images/upload/20170914/1505393386101172.jpg" title="1505393386101172.jpg" alt="gh.jpg" width="944" height="427"/>也没有图片<br/></p>', '/SCU/web/img/images/upload/20170914/1505393386101172.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `scu_manager`
--

CREATE TABLE `scu_manager` (
  `ID` int(2) NOT NULL COMMENT '自增长ID',
  `username` varchar(30) NOT NULL COMMENT '校社联管理员用户名',
  `salt` varchar(50) NOT NULL COMMENT '校社联管理员密码盐',
  `password` varchar(50) NOT NULL COMMENT '校社联管理员密码',
  `realname` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `department` varchar(60) NOT NULL,
  `major` varchar(60) NOT NULL,
  `work` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='校社联管理员表';

--
-- 转存表中的数据 `scu_manager`
--

INSERT INTO `scu_manager` (`ID`, `username`, `salt`, `password`, `realname`, `phone`, `department`, `major`, `work`) VALUES
(1, 'admin', '0be5272b5c73f7be4156606ef8a622a2', '30199d4118664f35f0acf1b44b610f01', '固定账号', '不能被删除', '互联网金融与信息工程系', '计算机科学与技术', 'admin'),
(13, 'wang', '1085059a390ba61e7a63a23bfe65232c', 'b136267a05271f0bc9f63adb8e31cb45', '王紫玉', '123456789', '互联网系', '计科', '校长');

-- --------------------------------------------------------

--
-- 表的结构 `scu_member`
--

CREATE TABLE `scu_member` (
  `ID` int(4) NOT NULL COMMENT '自增长id',
  `realname` varchar(50) NOT NULL COMMENT '姓名',
  `username` varchar(30) NOT NULL COMMENT '用户名即学号',
  `department` varchar(50) NOT NULL COMMENT '所属部门',
  `job` varchar(50) NOT NULL COMMENT '所任职位',
  `phone` varchar(20) DEFAULT NULL COMMENT '手机号',
  `dorm` varchar(50) NOT NULL COMMENT '宿舍',
  `dname` varchar(50) NOT NULL COMMENT '系别',
  `major` varchar(30) NOT NULL COMMENT '专业',
  `class` varchar(30) NOT NULL COMMENT '班级',
  `wechat` varchar(30) DEFAULT NULL COMMENT '微信'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='校社联成员表';

--
-- 转存表中的数据 `scu_member`
--

INSERT INTO `scu_member` (`ID`, `realname`, `username`, `department`, `job`, `phone`, `dorm`, `dname`, `major`, `class`, `wechat`) VALUES
(19, '洪三', '1654612345', '办公室', '干事', NULL, '6#706', '互联网系', '信管', '1', ''),
(20, '静茹', '456123', '外联部', '干事', '123456789', '5#402', '互联网系', '信管', '1', ''),
(24, '李四', '151541125', '会员服务部', '干事', NULL, '2#402', '互联网系', '信管', '1', ''),
(21, '成荫', '78914a56', '外联部', '副部长', NULL, '19#502', '互联网系', '电商', '4', ''),
(22, '万三', '151546467', '文娱部', '干事', '14714694014', '6#705', '互联网系', '计科', '2', ''),
(23, '张格', '151546647', '人力资源部', '副部长', '14714694104', '6#602', '互联网系', '计科', '1', ''),
(17, '李四', '141543243', '财务监控部', '干事', NULL, '11#502', '会计系', '财管', '1', ''),
(18, '王紫玉', '151511111', '人力资源部', '部长', '13242849450', '2222', '互联网系', '计科', '2', 'fdsasf'),
(14, '王族托云', '151543243', '人力资源部', '部长', NULL, '6#705', '互联网', '计科', '2', ''),
(15, '小明', '15141324', '宣传策划部', '干事', NULL, '6#706', '互联网系', '计科', '1', ''),
(34, '呵呵', '13456789123', '宣传策划部', '干事', NULL, '6#705', '互联网系', '计科', '1', ''),
(26, '小智', '151543230', '网络信息部', '副部长', NULL, '7#607', '互联网系', '计科', '2', '');

-- --------------------------------------------------------

--
-- 表的结构 `sno_comment`
--

CREATE TABLE `sno_comment` (
  `topic_id` int(10) UNSIGNED NOT NULL,
  `sNO` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sno_comment`
--

INSERT INTO `sno_comment` (`topic_id`, `sNO`) VALUES
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3);

-- --------------------------------------------------------

--
-- 表的结构 `societyinfo`
--

CREATE TABLE `societyinfo` (
  `sNO` int(10) UNSIGNED NOT NULL,
  `sName` varchar(20) NOT NULL,
  `sUsername` varchar(16) NOT NULL,
  `sPassword` varchar(60) NOT NULL,
  `sSalt` varchar(50) NOT NULL,
  `sLogo` varchar(20) NOT NULL,
  `sSummary` varchar(500) NOT NULL,
  `sImg` varchar(50) NOT NULL,
  `hName` varchar(10) NOT NULL COMMENT '负责人姓名',
  `hTel` varchar(11) NOT NULL COMMENT '负责人联系方式',
  `sCost` bit(1) NOT NULL DEFAULT b'0' COMMENT '干事是否有收会费',
  `sType` enum('学术科技类','体育健身类','文娱文化类','综合实践类') NOT NULL DEFAULT '学术科技类' COMMENT '社团类型',
  `sFounder` varchar(20) NOT NULL,
  `date_of_found` datetime NOT NULL,
  `tName` varchar(50) NOT NULL,
  `tTel` varchar(15) NOT NULL,
  `nhName` varchar(20) NOT NULL,
  `nhTel` varchar(15) NOT NULL,
  `fhName` varchar(20) NOT NULL,
  `fhTel` varchar(15) NOT NULL,
  `joinCondition` varchar(50) NOT NULL,
  `vNum` char(4) NOT NULL,
  `sGlory` text NOT NULL,
  `sAim` text NOT NULL,
  `date_of_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `societyinfo`
--

INSERT INTO `societyinfo` (`sNO`, `sName`, `sUsername`, `sPassword`, `sSalt`, `sLogo`, `sSummary`, `sImg`, `hName`, `hTel`, `sCost`, `sType`, `sFounder`, `date_of_found`, `tName`, `tTel`, `nhName`, `nhTel`, `fhName`, `fhTel`, `joinCondition`, `vNum`, `sGlory`, `sAim`, `date_of_entry`) VALUES
(2, '大学生职业生涯规划研究协会', 'zhixie123', 'a19026d1cefdad7c295e0c2eb1761e22', '6e95ac073ce20fb354d2904e564dc015', 'zxlogo.jpg', '大学生职业生涯规划研究协会', 'zximg.jpg', '道明寺', '13556099899', b'1', '综合实践类', '王紫玉', '2016-12-22 00:00:00', '桂若楠', '45678912310', '奶茶', '4564798732113', 'dfas', '78956431', '学习好', '100', '阿凡达福多富多三', '地方撒发生我的萨顶顶孤鸿寡鹄', '2017-09-14 10:34:55'),
(3, '出雲音乐协会', 'chuyun123', '39c856366260d4fb5fd1b63c7a3e2a31', '5fd6c1369facd7d17a92fdf1e65a12ff', 'cylogo.jpg', '广金音乐文化传播第一平台', 'cyimg.jpg', '张四', '18746379382', b'1', '文娱文化类', '赵六', '1992-08-09 00:00:00', '周杰伦', '13727777777', '周杰', '13727777787', '周伦', '13727778777', '会员费20', '70', '广金音乐文化传播第一平台', '致力于打造广金音乐文化传播第一平台', '2017-07-18 12:53:32');

-- --------------------------------------------------------

--
-- 表的结构 `society_evaluate`
--

CREATE TABLE `society_evaluate` (
  `topic_id` int(10) NOT NULL,
  `content` text NOT NULL,
  `date_of_entry` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `society_evaluate`
--

INSERT INTO `society_evaluate` (`topic_id`, `content`, `date_of_entry`) VALUES
(1, 'hahahaha', '2017-09-20 04:21:22'),
(2, 'text', '2017-09-20 05:56:00'),
(3, 'text 2', '2017-09-20 05:56:49'),
(4, 'hello!', '2017-09-20 05:59:48'),
(5, '你好', '2017-09-24 05:24:13');

-- --------------------------------------------------------

--
-- 表的结构 `society_reg`
--

CREATE TABLE `society_reg` (
  `sNO` int(10) UNSIGNED NOT NULL,
  `sName` varchar(10) NOT NULL,
  `sType` varchar(10) NOT NULL,
  `sFounder` varchar(10) NOT NULL,
  `date_of_found` datetime NOT NULL,
  `date_of_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tName` varchar(20) NOT NULL,
  `tTel` varchar(11) NOT NULL,
  `nhName` varchar(10) NOT NULL,
  `nhTel` varchar(11) NOT NULL,
  `fhName` varchar(20) NOT NULL,
  `fhTel` varchar(11) NOT NULL,
  `joinCondition` varchar(50) NOT NULL,
  `vNum` char(4) NOT NULL,
  `sAim` text NOT NULL,
  `sSummary` text NOT NULL,
  `sGlory` text,
  `review` int(1) NOT NULL DEFAULT '0',
  `remark` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `society_reg`
--

INSERT INTO `society_reg` (`sNO`, `sName`, `sType`, `sFounder`, `date_of_found`, `date_of_entry`, `tName`, `tTel`, `nhName`, `nhTel`, `fhName`, `fhTel`, `joinCondition`, `vNum`, `sAim`, `sSummary`, `sGlory`, `review`, `remark`) VALUES
(1, '武术协会', '文艺类', '李小龙', '2005-01-02 00:00:00', '2016-10-29 05:22:45', '甄子丹', '18688358185', '光头强', '15626136089', '张益达', '12345678910', '会员费20元', '120', '武', '广金最能打的协会', '2016优秀社团', 2, NULL),
(2, '创业者协会', '综合实践类', '李云龙', '2004-03-03 00:00:00', '2015-12-31 16:00:00', '麦克雷', '13345678901', '葫芦娃', '13242983753', '特朗普', '15999999999', '会员费25', '61', '创业创业创业', '创业者大家庭', '2008年优秀社团', 1, NULL),
(4, '商学会', '综合实践类', '雷锋', '2013-08-22 00:00:00', '2016-11-20 06:33:15', '林磊', '13293847527', '张三丰', '18688888888', '夸父', '15999344399', '无', '47', '鬼知道什么宗旨', '简介我也不知道啊 随便写一点凑个字数135463u6ijrthedgdfgafhadhfd', '没有', 2, NULL),
(5, '武术协会', '文艺类', '李小龙', '2005-01-02 00:00:00', '2016-10-28 21:22:45', '甄子丹', '18688358185', '光头强', '15626136089', '张益达', '12345678910', '会员费20元', '120', '武', '广金最能打的协会', '2016优秀社团', 1, NULL),
(7, '创业者协会', '综合实践类', '李云龙', '2004-03-03 00:00:00', '2015-12-31 08:00:00', '麦克雷', '13345678901', '葫芦娃', '13242983753', '特朗普', '15999999999', '会员费25', '61', '创业创业创业', '创业者大家庭', '2008年优秀社团', 1, NULL),
(8, '武术协会', '文艺类', '李小龙', '2005-01-02 00:00:00', '2016-11-30 08:20:24', '甄子丹', '18688358185', '光头强', '15626136089', '张益达', '12345678910', '会员费20元', '120', 'hhh', 'hhh ', 'hhh ', 2, NULL),
(9, '武术协会', '文艺类', '李小龙', '2005-01-02 00:00:00', '2016-11-30 08:20:53', '甄子丹', '18688358185', '光头强', '15626136089', '张益达', '12345678910', '会员费20元', '120', 'hhh', 'hhh							\r\n						', 'hhh							\r\n						', 0, NULL),
(10, '商学会', '综合实践类', '雷锋', '2013-08-22 00:00:00', '2016-11-19 22:33:15', '林磊', '13293847527', '张三丰', '18688888888', '夸父', '15999344399', '无', '47', '鬼知道什么宗旨', '简介我也不知道啊 随便写一点凑个字数135463u6ijrthedgdfgafhadhfd', '没有', 0, NULL),
(11, '武术协会', '文艺类', '李小龙', '2005-01-02 00:00:00', '2016-11-30 00:20:24', '甄子丹', '18688358185', '光头强', '15626136089', '张益达', '12345678910', '会员费20元', '120', 'hhh', 'hhh ', 'hhh ', 1, NULL),
(12, '武术协会', '文艺类', '李小龙', '2005-01-02 00:00:00', '2016-11-30 00:20:53', '甄子丹', '18688358185', '光头强', '15626136089', '张益达', '12345678910', '会员费20元', '120', 'hhh', 'hhh							\r\n						', 'hhh							\r\n						', 2, NULL),
(13, '武术协会', '文艺类', '李云龙', '2010-01-02 00:00:00', '2016-12-08 13:23:21', '孙', '13566573892', '林', '13926365653', '哈', '18374729305', '20', '30', '没有', '没有							\r\n						', '没有							\r\n						', 0, NULL),
(24, '武术协会', '', '', '0000-00-00 00:00:00', '2016-12-09 13:30:41', '', '', '', '', '', '', '', '', '', '								\r\n							', '								\r\n							', 1, NULL),
(25, '武术协会', '', '李小龙', '2013-12-18 00:00:00', '2016-12-10 02:03:52', '李小龙', '18688738958', '李小龙', '18688738958', '李小龙', '18688738958', '会员费20', '90', '武术协会', '武术协会			', '武术协会								\r\n							', 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `source_img`
--

CREATE TABLE `source_img` (
  `imgID` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(50) NOT NULL,
  `imgDesc` varchar(30) DEFAULT NULL,
  `imgRelease` bit(1) NOT NULL DEFAULT b'0',
  `date_of_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `source_img`
--

INSERT INTO `source_img` (`imgID`, `imgName`, `imgDesc`, `imgRelease`, `date_of_entry`) VALUES
(6, 'as.jpg', '图片1', b'1', '2016-12-07 05:30:22'),
(7, 'gh.jpg', '图片2', b'1', '2016-12-07 05:30:30'),
(8, 'jh.jpg', '图片3', b'1', '2016-12-07 05:30:37'),
(9, 'ty.jpg', '图片4', b'1', '2016-12-07 05:30:43'),
(10, '45.jpg', NULL, b'1', '2016-11-23 12:10:47'),
(12, '36.jpg', NULL, b'1', '2016-11-23 12:12:15'),
(13, '34.jpg', NULL, b'0', '2016-11-27 13:28:00'),
(15, '12.jpg', NULL, b'0', '2016-11-27 13:52:20'),
(16, '25.jpg', NULL, b'0', '2016-11-27 13:52:27'),
(17, '33.jpg', NULL, b'0', '2016-11-27 13:52:34'),
(18, '48.jpg', NULL, b'0', '2016-11-27 13:52:49');

-- --------------------------------------------------------

--
-- 表的结构 `source_notice`
--

CREATE TABLE `source_notice` (
  `noticID` int(10) UNSIGNED NOT NULL,
  `noticTitle` varchar(15) NOT NULL,
  `noticContent` varchar(1500) NOT NULL,
  `date_of_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `noticRelease` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `userinfo`
--

CREATE TABLE `userinfo` (
  `username` varchar(9) NOT NULL,
  `password` varchar(60) NOT NULL,
  `salt` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `name` varchar(20) NOT NULL,
  `dept` varchar(20) NOT NULL,
  `major` varchar(7) NOT NULL,
  `sex` varchar(3) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `wechat` varchar(25) NOT NULL,
  `portrait` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `userinfo`
--

INSERT INTO `userinfo` (`username`, `password`, `salt`, `email`, `name`, `dept`, `major`, `sex`, `tel`, `wechat`, `portrait`) VALUES
('151541128', 'aa2d9d11fa8d51ea38886e135de025f7', '9ae3e295d641dd15fc46eebe1ed8fae8', 'dfs@qq.com', '李四', '互联网金融与信息工程系', '15154', '女', '18688378593', 'fhfksdk', NULL),
('151541137', 'c4f29b1f306ee25e0f123c0bb6f9c657', '7c4ee48c0387b4ff23ae8c62d3d5f63d', '522013042@qq.com', '林家宇', '互联网金融与信息工程系', '151541', '男', '18688358185', 'yu522013042', './img/images/portrait/151541137.jpg'),
('151541177', '4f90f22eb604ee78f820088663ff8864', '0694de793c97b1da61b69b9bb9790b29', 'fswewe@qq.com', '张三', '互联网金融与信息工程系', '15154', '男', '18788788888', 'dsfjskdff', NULL),
('151541181', 'c1f90420b8fc01b0ea37bd43bdb70b61', '294766ce95c54b8cca28cf9147400812', 'jdfkdsf@qq.com', '赵一', '互联网金融与信息工程系', '15154', '男', '13726493848', 'hfjksdfks', NULL),
('151541189', 'a4740c247c6cc5fee0770760850b42d6', 'bce1f91d31b9bafe822ec28aa2e0f0af', 'dfsf@qq.com', '王二', '互联网金融与信息工程系', '151541', '女', '13777777777', 'ggg4555', NULL),
('151541191', '79a63387dd9ce76d6fb9f7d36d014fb4', '1b162c2fa26ee3f8c742d306026fe951', 'r2rew@qq.com', '啊啊啊', '互联网金融与信息工程系', '15154', '女', '18688356256', 'fdsfsf', NULL),
('151541199', '1075fa627c6130706578348cce0dc088', '4ff72ed4137729a22d686bb354ea2c92', '998@163.com', '孙悟空', '互联网金融与信息工程系', '151541', '男', '13345678910', 'ldld111', NULL),
('151541277', '806587e7bdb7cf432f59820c3cec43d2', 'c45da727f7bf08b1b8ddfc98c4930735', '888@163.com', '黄月英', '互联网金融与信息工程系', '15154', '女', '15623656478', 'iiii888', NULL),
('151543242', '95924c928a24d8d4d111066e6e910850', '3ac574c7ed1b38830ef73e4aae0452ad', '1655564660@qq.com', '王紫玉', '互联网金融与信息工程系', '15154', '男', '13242849450', 'w1655564660', NULL),
('151543243', 'd175351d8df47f8dd487f88b92e92850', '4a3a3965a19f723598002e74074e53a1', '1655564@qq.com', '万达', '互联网金融与信息工程系', '1515432', '男', '13242849450', 'dsafsdafsaf', './img/images/portrait/151543243.jpg'),
('151543244', 'b803e3cede1f3490a41861ba0a8b7ea7', '1f5b0a36032414f8876a05d4ce37b1ae', '1655564660@qq.com', '古一', '互联网金融与信息工程系', '1515432', '男', '13242849450', 'w1655564660', NULL),
('151543245', '1de45d23e425778b8b4d6df626569c92', 'cfb3775798c23142f9260d4767ef85ae', '1655564660@qq.com', '八神', '互联网金融与信息工程系', '1515432', '男', '13242849451', 'w165fds', NULL),
('151543246', 'aaf1b2f013a2d56e5980dafa1c1fd91c', '30a1a63b2aafc9781055de05580cb475', '1655564660@qq.com', '王紫玉', '互联网金融与信息工程系', '1515432', '男', '13242849450', 'w1655564660', NULL),
('151543247', '8510a93b66dcc28309e40454adea219c', '9ef377b52519fad12d1c41988baebff5', '16555564661@qq.com', '玉紫王', '互联网金融与信息工程系', '15154', '男', '13242849450', '1655564660', NULL),
('151543248', '5ea8a7f0b40e6794f16be902aa88b7a5', '263461ea351b6a5eb2f155e16862b693', '1655564660@qq.com', '郝帅', '互联网金融与信息工程系', '15154', '男', '13242849450', '1655564660', NULL),
('161543243', 'bb3ac334b36073ebe141ac223804a501', 'a4834161c207edd46fff1597f48a87c6', '1655564660@QQ.com', '大王', '互联网系', '15154', '男', '13242849450', '1655564660', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user_comment`
--

CREATE TABLE `user_comment` (
  `username` varchar(9) NOT NULL,
  `topic_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_comment`
--

INSERT INTO `user_comment` (`username`, `topic_id`) VALUES
('151541137', 1),
('151541137', 2),
('151541137', 3),
('151541137', 4),
('151541137', 5);

-- --------------------------------------------------------

--
-- 表的结构 `user_sno`
--

CREATE TABLE `user_sno` (
  `Username` char(11) NOT NULL,
  `sNO` int(10) UNSIGNED NOT NULL,
  `review` int(1) NOT NULL DEFAULT '0',
  `date_of_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `smRemark` varchar(30) NOT NULL DEFAULT '无'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_sno`
--

INSERT INTO `user_sno` (`Username`, `sNO`, `review`, `date_of_entry`, `smRemark`) VALUES
('151541128', 1, 0, '2016-12-09 14:08:49', '无'),
('151541137', 1, 1, '2016-12-09 14:09:04', '无'),
('151541137', 2, 1, '2017-07-03 07:13:01', ''),
('151541137', 3, 1, '2017-07-03 07:13:01', '无'),
('151541177', 1, 1, '2016-12-09 14:09:04', '无'),
('151541181', 1, 1, '2016-12-09 14:10:31', '无'),
('151541189', 1, 1, '2016-12-09 13:41:40', '无'),
('151541277', 1, 1, '2016-12-09 14:10:07', '无'),
('151543244', 1, 1, '2016-12-09 14:10:51', '无'),
('151543245', 1, 1, '2016-12-09 13:41:47', '无'),
('151543246', 1, 0, '2016-12-09 13:41:17', '无'),
('151543247', 1, 1, '2016-12-09 09:47:08', '无'),
('151543248', 1, 1, '2016-12-09 13:40:44', '无');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_apply`
--
ALTER TABLE `activity_apply`
  ADD PRIMARY KEY (`aNO`);

--
-- Indexes for table `concern`
--
ALTER TABLE `concern`
  ADD PRIMARY KEY (`Username`,`sNO`);

--
-- Indexes for table `goodsinfo`
--
ALTER TABLE `goodsinfo`
  ADD PRIMARY KEY (`goodsId`);

--
-- Indexes for table `index_video`
--
ALTER TABLE `index_video`
  ADD PRIMARY KEY (`videoID`),
  ADD UNIQUE KEY `videoName` (`videoName`);

--
-- Indexes for table `msg_feedback`
--
ALTER TABLE `msg_feedback`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `scu_activity`
--
ALTER TABLE `scu_activity`
  ADD PRIMARY KEY (`aNo`);

--
-- Indexes for table `scu_manager`
--
ALTER TABLE `scu_manager`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `scu_member`
--
ALTER TABLE `scu_member`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `fds` (`username`),
  ADD UNIQUE KEY `hfg` (`phone`);

--
-- Indexes for table `sno_comment`
--
ALTER TABLE `sno_comment`
  ADD PRIMARY KEY (`topic_id`,`sNO`);

--
-- Indexes for table `societyinfo`
--
ALTER TABLE `societyinfo`
  ADD PRIMARY KEY (`sNO`),
  ADD UNIQUE KEY `sName` (`sName`);

--
-- Indexes for table `society_evaluate`
--
ALTER TABLE `society_evaluate`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `society_reg`
--
ALTER TABLE `society_reg`
  ADD PRIMARY KEY (`sNO`);

--
-- Indexes for table `source_img`
--
ALTER TABLE `source_img`
  ADD PRIMARY KEY (`imgID`);

--
-- Indexes for table `source_notice`
--
ALTER TABLE `source_notice`
  ADD PRIMARY KEY (`noticID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `user_comment`
--
ALTER TABLE `user_comment`
  ADD PRIMARY KEY (`username`,`topic_id`);

--
-- Indexes for table `user_sno`
--
ALTER TABLE `user_sno`
  ADD PRIMARY KEY (`Username`,`sNO`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `activity_apply`
--
ALTER TABLE `activity_apply`
  MODIFY `aNO` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- 使用表AUTO_INCREMENT `index_video`
--
ALTER TABLE `index_video`
  MODIFY `videoID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `msg_feedback`
--
ALTER TABLE `msg_feedback`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增长id', AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `scu_activity`
--
ALTER TABLE `scu_activity`
  MODIFY `aNo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- 使用表AUTO_INCREMENT `scu_manager`
--
ALTER TABLE `scu_manager`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT COMMENT '自增长ID', AUTO_INCREMENT=15;
--
-- 使用表AUTO_INCREMENT `scu_member`
--
ALTER TABLE `scu_member`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT COMMENT '自增长id', AUTO_INCREMENT=37;
--
-- 使用表AUTO_INCREMENT `societyinfo`
--
ALTER TABLE `societyinfo`
  MODIFY `sNO` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `society_evaluate`
--
ALTER TABLE `society_evaluate`
  MODIFY `topic_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `society_reg`
--
ALTER TABLE `society_reg`
  MODIFY `sNO` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- 使用表AUTO_INCREMENT `source_img`
--
ALTER TABLE `source_img`
  MODIFY `imgID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- 使用表AUTO_INCREMENT `source_notice`
--
ALTER TABLE `source_notice`
  MODIFY `noticID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
