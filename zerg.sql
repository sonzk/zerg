-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2018-10-29 13:59:35
-- 服务器版本： 5.6.38
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zerg`
--

-- --------------------------------------------------------

--
-- 表的结构 `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT 'Banner名称，通常作为标识',
  `description` varchar(255) DEFAULT NULL COMMENT 'Banner描述',
  `delete_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='banner管理表';

--
-- 转存表中的数据 `banner`
--

INSERT INTO `banner` (`id`, `name`, `description`, `delete_time`, `update_time`) VALUES
(1, '首页置顶', '首页轮播图', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `banner_item`
--

CREATE TABLE `banner_item` (
  `id` int(11) NOT NULL,
  `img_id` int(11) NOT NULL COMMENT '外键，关联image表',
  `key_word` varchar(100) NOT NULL COMMENT '执行关键字，根据不同的type含义不同',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '跳转类型，可能导向商品，可能导向专题，可能导向其他。0，无导向；1：导向商品;2:导向专题',
  `list_order` int(10) NOT NULL DEFAULT '0',
  `delete_time` int(11) DEFAULT NULL,
  `banner_id` int(11) NOT NULL COMMENT '外键，关联banner表',
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='banner子项表';

--
-- 转存表中的数据 `banner_item`
--

INSERT INTO `banner_item` (`id`, `img_id`, `key_word`, `type`, `list_order`, `delete_time`, `banner_id`, `update_time`) VALUES
(1, 65, '6', 1, 0, NULL, 1, NULL),
(2, 84, '25', 1, 1, NULL, 1, NULL),
(3, 3, '11', 1, 0, NULL, 1, NULL),
(5, 1, '10', 1, 2, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `topic_img_id` int(11) DEFAULT NULL COMMENT '外键，关联image表',
  `list_order` int(11) NOT NULL DEFAULT '0',
  `delete_time` int(11) DEFAULT '0',
  `description` varchar(100) DEFAULT NULL COMMENT '描述',
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商品类目';

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `name`, `topic_img_id`, `list_order`, `delete_time`, `description`, `update_time`) VALUES
(2, '果类', 6, 1, 0, NULL, NULL),
(3, '蔬菜', 89, 2, 0, NULL, NULL),
(4, '炒货', 7, 0, 0, NULL, NULL),
(5, '点心', 4, 0, 0, NULL, NULL),
(6, '粗茶', 8, 0, 0, NULL, NULL),
(7, '淡饭', 9, 0, 0, NULL, NULL),
(8, '鲜果', 87, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL COMMENT '图片路径',
  `from` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 来自本地，2 来自公网',
  `delete_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='图片总表';

--
-- 转存表中的数据 `image`
--

INSERT INTO `image` (`id`, `url`, `from`, `delete_time`, `update_time`) VALUES
(1, '/banner-1a.png', 1, 0, NULL),
(2, '/banner-2a.png', 1, 0, NULL),
(3, '/banner-3a.png', 1, 0, NULL),
(4, '/category-cake.png', 1, 0, NULL),
(5, '/category-vg.png', 1, 0, NULL),
(6, '/category-dryfruit.png', 1, 0, NULL),
(7, '/category-fry-a.png', 1, 0, NULL),
(8, '/category-tea.png', 1, 0, NULL),
(9, '/category-rice.png', 1, 0, NULL),
(10, '/product-dryfruit@1.png', 1, 0, NULL),
(13, '/product-vg@1.png', 1, 0, NULL),
(14, '/product-rice@6.png', 1, 0, NULL),
(16, '/1@theme.png', 1, 0, NULL),
(17, '/2@theme.png', 1, 0, NULL),
(18, '/3@theme.png', 1, 0, NULL),
(19, '/detail-1@1-dryfruit.png', 1, 0, NULL),
(20, '/detail-2@1-dryfruit.png', 1, 0, NULL),
(21, '/detail-3@1-dryfruit.png', 1, 0, NULL),
(22, '/detail-4@1-dryfruit.png', 1, 0, NULL),
(23, '/detail-5@1-dryfruit.png', 1, 0, NULL),
(24, '/detail-6@1-dryfruit.png', 1, 0, NULL),
(25, '/detail-7@1-dryfruit.png', 1, 0, NULL),
(26, '/detail-8@1-dryfruit.png', 1, 0, NULL),
(27, '/detail-9@1-dryfruit.png', 1, 0, NULL),
(28, '/detail-11@1-dryfruit.png', 1, 0, NULL),
(29, '/detail-10@1-dryfruit.png', 1, 0, NULL),
(31, '/product-rice@1.png', 1, 0, NULL),
(32, '/product-tea@1.png', 1, 0, NULL),
(33, '/product-dryfruit@2.png', 1, 0, NULL),
(36, '/product-dryfruit@3.png', 1, 0, NULL),
(37, '/product-dryfruit@4.png', 1, 0, NULL),
(38, '/product-dryfruit@5.png', 1, 0, NULL),
(39, '/product-dryfruit-a@6.png', 1, 0, NULL),
(40, '/product-dryfruit@7.png', 1, 0, NULL),
(41, '/product-rice@2.png', 1, 0, NULL),
(42, '/product-rice@3.png', 1, 0, NULL),
(43, '/product-rice@4.png', 1, 0, NULL),
(44, '/product-fry@1.png', 1, 0, NULL),
(45, '/product-fry@2.png', 1, 0, NULL),
(46, '/product-fry@3.png', 1, 0, NULL),
(47, '/product-tea@2.png', 1, 0, NULL),
(48, '/product-tea@3.png', 1, 0, NULL),
(49, '/1@theme-head.png', 1, 0, NULL),
(50, '/2@theme-head.png', 1, 0, NULL),
(51, '/3@theme-head.png', 1, 0, NULL),
(52, '/product-cake@1.png', 1, 0, NULL),
(53, '/product-cake@2.png', 1, 0, NULL),
(54, '/product-cake-a@3.png', 1, 0, NULL),
(55, '/product-cake-a@4.png', 1, 0, NULL),
(56, '/product-dryfruit@8.png', 1, 0, NULL),
(57, '/product-fry@4.png', 1, 0, NULL),
(58, '/product-fry@5.png', 1, 0, NULL),
(59, '/product-rice@5.png', 1, 0, NULL),
(60, '/product-rice@7.png', 1, 0, NULL),
(62, '/detail-12@1-dryfruit.png', 1, 0, NULL),
(63, '/detail-13@1-dryfruit.png', 1, 0, NULL),
(65, '/banner-4a.png', 1, 0, NULL),
(66, '/product-vg@4.png', 1, 0, NULL),
(67, '/product-vg@5.png', 1, 0, NULL),
(68, '/product-vg@2.png', 1, 0, NULL),
(69, '/product-vg@3.png', 1, 0, NULL),
(70, '/20180601/1a4a719998b7e04831204d9fd2fa7a4b.jpg', 1, 1, NULL),
(71, '/20180601/05ce510c8aa2b9cf6e41f1e9a336784f.jpg', 1, 1, NULL),
(72, '/20180601/750e1c91c48682f7bee4d427be250733.jpg', 1, 1, NULL),
(73, '/20180601/c83f5ad6b595393a603956df275e3076.jpg', 1, 1, NULL),
(74, '/20180601/3997bf74d69ba4c41812883b57537d73.jpg', 1, 1, NULL),
(75, '/20180601/f38ae6461335080cee509fdf3a61dd9d.jpg', 1, 1, NULL),
(76, '/20180602/a24ec84bd4fc93f3c36e33b9ea1c4a27.jpg', 1, 0, NULL),
(77, '/20180602/0fc1421af0385f51ccaeddac3fbaf8d5.jpg', 1, 0, NULL),
(78, '/20180602/78c83b42bacfc5a4d4c05f8b7dcec7a0.png', 1, 0, NULL),
(79, '/20180602/b1009009a33703e9e7689ba526c9deb8.png', 1, 1, NULL),
(81, '/20180603/779bffd2661b8c5cf8fa0c2bf91e2040.png', 1, 0, NULL),
(82, '/20180603/b8ed8e13cd3a86bc94442828a7071ab6.png', 1, 0, NULL),
(83, '/20180603/6f6769e6f75973a9a3dbabc3c9ded066.png', 1, 0, NULL),
(84, '/20180603/721691c6a875e233951c0d72f371ef90.png', 1, 0, NULL),
(85, '/20180603/ff643ca1030c69282e8ac728a99627a1.png', 1, 0, NULL),
(86, '/20180603/7ffa673bfa1c87533c2a297dde0ee4d5.png', 1, 0, NULL),
(87, '/20180603/b5a038e7f5873769e6c1d8699c903d22.png', 1, 0, NULL),
(88, '/20180603/3488fceb8dcb60d85e83cc5ffc24f779.png', 1, 0, NULL),
(89, '/20180603/d913d3858cf192fb948bd9d3946f2f4a.png', 1, 0, NULL),
(90, '/20180603/38f2a8b9850a5b51dc76b1cdbcf95167.png', 1, 0, NULL),
(91, '/20180603/6a5fa8bac6788a397562b804f65bf48a.png', 1, 0, NULL),
(92, '/20180603/3f0ebdbadb879d18728cc2f0bae359db.png', 1, 0, NULL),
(93, '/20180603/82c05dc05585969de3b9cdd5c46032d2.png', 1, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `order_no` varchar(20) NOT NULL COMMENT '订单号',
  `user_id` int(11) NOT NULL COMMENT '外键，用户id，注意并不是openid',
  `delete_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `total_price` decimal(6,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:未支付， 2：已支付，3：已发货 , 4: 已支付，但库存不足',
  `snap_img` varchar(255) DEFAULT NULL COMMENT '订单快照图片',
  `snap_name` varchar(80) DEFAULT NULL COMMENT '订单快照名称',
  `total_count` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) DEFAULT NULL,
  `delivery_time` int(11) NOT NULL DEFAULT '0',
  `snap_items` text COMMENT '订单其他信息快照（json)',
  `snap_address` varchar(500) DEFAULT NULL COMMENT '地址快照',
  `prepay_id` varchar(100) DEFAULT NULL COMMENT '订单微信支付的预订单id（用于发送模板消息）',
  `express_no` varchar(50) DEFAULT NULL,
  `express_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `order`
--

INSERT INTO `order` (`id`, `order_no`, `user_id`, `delete_time`, `create_time`, `total_price`, `status`, `snap_img`, `snap_name`, `total_count`, `update_time`, `delivery_time`, `snap_items`, `snap_address`, `prepay_id`, `express_no`, `express_name`) VALUES
(1, 'A519189477879941', 7, NULL, 1526718947, '0.11', 3, 'http://z.com/images/product-dryfruit@2.png', '春生龙眼 500克等', 11, 1526914438, 0, '[{\"id\":6,\"name\":\"\\u5c0f\\u7ea2\\u7684\\u732a\\u8033\\u6735 120\\u514b\",\"haveStock\":true,\"count\":6,\"totalPrice\":\"0.06\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-cake@2.png\"},{\"id\":5,\"name\":\"\\u6625\\u751f\\u9f99\\u773c 500\\u514b\",\"haveStock\":true,\"count\":5,\"totalPrice\":\"0.05\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-dryfruit@2.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(2, 'A519207336733830', 7, NULL, 1526720733, '0.01', 1, 'http://z.com/images/product-tea@1.png', '红袖枸杞 6克*3袋', 1, 1526720733, 0, '[{\"id\":4,\"name\":\"\\u7ea2\\u8896\\u67b8\\u675e 6\\u514b*3\\u888b\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-tea@1.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(3, 'A519208263271477', 7, NULL, 1526720826, '0.01', 1, 'http://z.com/images/product-rice@1.png', '素米 327克', 1, 1526720826, 0, '[{\"id\":3,\"name\":\"\\u7d20\\u7c73 327\\u514b\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-rice@1.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(4, 'A519209545438728', 7, NULL, 1526720954, '0.03', 1, 'http://z.com/images/product-vg@2.png', '泥蒿 半斤', 3, 1526720954, 0, '[{\"id\":7,\"name\":\"\\u6ce5\\u84bf \\u534a\\u65a4\",\"haveStock\":true,\"count\":3,\"totalPrice\":\"0.03\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-vg@2.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(5, 'A519213302491987', 7, NULL, 1526721330, '0.02', 1, 'http://z.com/images/product-cake@2.png', '小红的猪耳朵 120克', 2, 1526721330, 0, '[{\"id\":6,\"name\":\"\\u5c0f\\u7ea2\\u7684\\u732a\\u8033\\u6735 120\\u514b\",\"haveStock\":true,\"count\":2,\"totalPrice\":\"0.02\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-cake@2.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(6, 'A519224680818323', 7, NULL, 1526722468, '0.01', 1, 'http://z.com/images/product-rice@1.png', '素米 327克', 1, 1526722468, 0, '[{\"id\":3,\"name\":\"\\u7d20\\u7c73 327\\u514b\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-rice@1.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(7, 'A519225066774562', 7, NULL, 1526722506, '0.04', 1, 'http://z.com/images/product-vg@2.png', '泥蒿 半斤', 4, 1526722506, 0, '[{\"id\":7,\"name\":\"\\u6ce5\\u84bf \\u534a\\u65a4\",\"haveStock\":true,\"count\":4,\"totalPrice\":\"0.04\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-vg@2.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(8, 'A519228146578172', 7, NULL, 1526722814, '0.01', 1, 'http://z.com/images/product-dryfruit@5.png', '万紫千凤梨 300克', 1, 1526722814, 0, '[{\"id\":10,\"name\":\"\\u4e07\\u7d2b\\u5343\\u51e4\\u68a8 300\\u514b\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-dryfruit@5.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(9, 'A519233064418943', 7, NULL, 1526723306, '0.04', 1, 'http://z.com/images/product-dryfruit@3.png', '夏日芒果 3个', 4, 1526723306, 0, '[{\"id\":8,\"name\":\"\\u590f\\u65e5\\u8292\\u679c 3\\u4e2a\",\"haveStock\":true,\"count\":4,\"totalPrice\":\"0.04\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-dryfruit@3.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(10, 'A519234211205139', 7, NULL, 1526723421, '0.03', 1, 'http://z.com/images/product-dryfruit@3.png', '夏日芒果 3个', 3, 1526723421, 0, '[{\"id\":8,\"name\":\"\\u590f\\u65e5\\u8292\\u679c 3\\u4e2a\",\"haveStock\":true,\"count\":3,\"totalPrice\":\"0.03\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-dryfruit@3.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(11, 'A519234504451114', 7, NULL, 1526723450, '0.01', 1, 'http://z.com/images/product-vg@2.png', '泥蒿 半斤', 1, 1526723450, 0, '[{\"id\":7,\"name\":\"\\u6ce5\\u84bf \\u534a\\u65a4\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-vg@2.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(12, 'A519238864693872', 7, NULL, 1526723886, '0.06', 1, 'http://z.com/images/product-rice@3.png', '芝麻 50克等', 6, 1526723886, 0, '[{\"id\":14,\"name\":\"\\u829d\\u9ebb 50\\u514b\",\"haveStock\":true,\"count\":3,\"totalPrice\":\"0.03\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-rice@3.png\"},{\"id\":15,\"name\":\"\\u7334\\u5934\\u83c7 370\\u514b\",\"haveStock\":true,\"count\":3,\"totalPrice\":\"0.03\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-rice@4.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(13, 'A519242190755240', 7, NULL, 1526724219, '0.03', 1, 'http://z.com/images/product-vg@2.png', '泥蒿 半斤', 3, 1526724219, 0, '[{\"id\":7,\"name\":\"\\u6ce5\\u84bf \\u534a\\u65a4\",\"haveStock\":true,\"count\":3,\"totalPrice\":\"0.03\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-vg@2.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(14, 'A519251011601324', 7, NULL, 1526725101, '0.04', 1, 'http://z.com/images/product-rice@1.png', '素米 327克', 4, 1526725101, 0, '[{\"id\":3,\"name\":\"\\u7d20\\u7c73 327\\u514b\",\"haveStock\":true,\"count\":4,\"totalPrice\":\"0.04\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-rice@1.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(15, 'A519251407722426', 7, NULL, 1526725140, '0.01', 1, 'http://z.com/images/product-dryfruit@5.png', '万紫千凤梨 300克', 1, 1526725140, 0, '[{\"id\":10,\"name\":\"\\u4e07\\u7d2b\\u5343\\u51e4\\u68a8 300\\u514b\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-dryfruit@5.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(16, 'A519252470834644', 7, NULL, 1526725247, '0.03', 1, 'http://z.com/images/product-tea@1.png', '红袖枸杞 6克*3袋', 3, 1526725247, 0, '[{\"id\":4,\"name\":\"\\u7ea2\\u8896\\u67b8\\u675e 6\\u514b*3\\u888b\",\"haveStock\":true,\"count\":3,\"totalPrice\":\"0.03\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-tea@1.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(17, 'A519252924169383', 7, NULL, 1526725292, '0.02', 1, 'http://z.com/images/product-dryfruit@2.png', '春生龙眼 500克', 2, 1526725292, 0, '[{\"id\":5,\"name\":\"\\u6625\\u751f\\u9f99\\u773c 500\\u514b\",\"haveStock\":true,\"count\":2,\"totalPrice\":\"0.02\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-dryfruit@2.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(18, 'A519253086706565', 7, NULL, 1526725308, '0.03', 1, 'http://z.com/images/product-vg@2.png', '泥蒿 半斤', 3, 1526725308, 0, '[{\"id\":7,\"name\":\"\\u6ce5\\u84bf \\u534a\\u65a4\",\"haveStock\":true,\"count\":3,\"totalPrice\":\"0.03\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-vg@2.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(19, 'A519253297238419', 7, NULL, 1526725329, '0.02', 1, 'http://z.com/images/product-cake@2.png', '小红的猪耳朵 120克', 2, 1526725329, 0, '[{\"id\":6,\"name\":\"\\u5c0f\\u7ea2\\u7684\\u732a\\u8033\\u6735 120\\u514b\",\"haveStock\":true,\"count\":2,\"totalPrice\":\"0.02\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-cake@2.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(20, 'A519255286337794', 7, NULL, 1526725528, '0.02', 1, 'http://z.com/images/product-dryfruit@2.png', '春生龙眼 500克', 2, 1526725528, 0, '[{\"id\":5,\"name\":\"\\u6625\\u751f\\u9f99\\u773c 500\\u514b\",\"haveStock\":true,\"count\":2,\"totalPrice\":\"0.02\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-dryfruit@2.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(21, 'A519285546683499', 7, NULL, 1526728554, '0.01', 1, 'http://z.com/images/product-dryfruit@2.png', '春生龙眼 500克', 1, 1526728554, 0, '[{\"id\":5,\"name\":\"\\u6625\\u751f\\u9f99\\u773c 500\\u514b\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-dryfruit@2.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(22, 'A519427014130492', 7, NULL, 1526742701, '0.01', 1, 'http://z.com/images/product-dryfruit@3.png', '夏日芒果 3个', 1, 1526742701, 0, '[{\"id\":8,\"name\":\"\\u590f\\u65e5\\u8292\\u679c 3\\u4e2a\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-dryfruit@3.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(23, 'A519430144546261', 7, NULL, 1526743014, '0.01', 1, 'http://z.com/images/product-rice@1.png', '素米 327克', 1, 1526743014, 0, '[{\"id\":3,\"name\":\"\\u7d20\\u7c73 327\\u514b\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-rice@1.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(24, 'A519430410813776', 7, NULL, 1526743041, '0.01', 1, 'http://z.com/images/product-dryfruit@2.png', '春生龙眼 500克', 1, 1526743041, 0, '[{\"id\":5,\"name\":\"\\u6625\\u751f\\u9f99\\u773c 500\\u514b\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-dryfruit@2.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(25, 'A519430911882411', 7, NULL, 1526743091, '0.03', 1, 'http://z.com/images/product-dryfruit@5.png', '万紫千凤梨 300克', 3, 1526743091, 0, '[{\"id\":10,\"name\":\"\\u4e07\\u7d2b\\u5343\\u51e4\\u68a8 300\\u514b\",\"haveStock\":true,\"count\":3,\"totalPrice\":\"0.03\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-dryfruit@5.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(26, 'A519436360401559', 7, NULL, 1526743636, '0.01', 1, 'http://z.com/images/product-rice@1.png', '素米 327克', 1, 1526743636, 0, '[{\"id\":3,\"name\":\"\\u7d20\\u7c73 327\\u514b\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-rice@1.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(27, 'A519440393592132', 7, NULL, 1526744039, '0.02', 1, 'http://z.com/images/product-vg@2.png', '泥蒿 半斤', 2, 1526744039, 0, '[{\"id\":7,\"name\":\"\\u6ce5\\u84bf \\u534a\\u65a4\",\"haveStock\":true,\"count\":2,\"totalPrice\":\"0.02\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-vg@2.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(28, 'A519441951993445', 7, NULL, 1526744195, '0.02', 1, 'http://z.com/images/product-dryfruit@3.png', '夏日芒果 3个', 2, 1526744195, 0, '[{\"id\":8,\"name\":\"\\u590f\\u65e5\\u8292\\u679c 3\\u4e2a\",\"haveStock\":true,\"count\":2,\"totalPrice\":\"0.02\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-dryfruit@3.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(29, 'A519442251758647', 7, NULL, 1526744225, '0.01', 1, 'http://z.com/images/product-dryfruit@3.png', '夏日芒果 3个', 1, 1526744225, 0, '[{\"id\":8,\"name\":\"\\u590f\\u65e5\\u8292\\u679c 3\\u4e2a\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-dryfruit@3.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(30, 'A519442667940208', 7, NULL, 1526744266, '0.01', 3, 'http://z.com/images/product-dryfruit@2.png', '春生龙眼 500克', 1, 1526913830, 0, '[{\"id\":5,\"name\":\"\\u6625\\u751f\\u9f99\\u773c 500\\u514b\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-dryfruit@2.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(31, 'A520464594126296', 7, NULL, 1526746459, '0.01', 1, 'http://z.com/images/product-rice@1.png', '素米 327克', 1, 1526746459, 0, '[{\"id\":3,\"name\":\"\\u7d20\\u7c73 327\\u514b\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-rice@1.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(32, 'A520465000047067', 7, NULL, 1526746500, '0.01', 1, 'http://z.com/images/product-dryfruit@3.png', '夏日芒果 3个', 1, 1526746500, 0, '[{\"id\":8,\"name\":\"\\u590f\\u65e5\\u8292\\u679c 3\\u4e2a\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-dryfruit@3.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(33, 'A520480053829744', 7, NULL, 1526748005, '0.02', 1, 'http://z.com/images/product-tea@1.png', '红袖枸杞 6克*3袋', 2, 1526748005, 0, '[{\"id\":4,\"name\":\"\\u7ea2\\u8896\\u67b8\\u675e 6\\u514b*3\\u888b\",\"haveStock\":true,\"count\":2,\"totalPrice\":\"0.02\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-tea@1.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(34, 'A522773745185957', 7, NULL, 1526977374, '0.01', 1, 'http://z.com/images/product-cake@2.png', '小红的猪耳朵 120克', 1, 1526977374, 0, '[{\"id\":6,\"name\":\"\\u5c0f\\u7ea2\\u7684\\u732a\\u8033\\u6735 120\\u514b\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-cake@2.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '', ''),
(35, 'A522773801805753', 7, NULL, 1526977380, '0.01', 3, 'http://z.com/images/product-cake@2.png', '小红的猪耳朵 120克', 1, 1528096367, 1528096367, '[{\"id\":6,\"name\":\"\\u5c0f\\u7ea2\\u7684\\u732a\\u8033\\u6735 120\\u514b\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-cake@2.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '211122133', '顺丰'),
(36, 'A522773921250579', 7, NULL, 1526977392, '0.01', 3, 'http://z.com/images/product-cake@2.png', '小红的猪耳朵 120克', 1, 1528084584, 1528084584, '[{\"id\":6,\"name\":\"\\u5c0f\\u7ea2\\u7684\\u732a\\u8033\\u6735 120\\u514b\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/product-cake@2.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, '1121221', '顺丰'),
(37, 'A606809002189645', 7, NULL, 1528280900, '0.01', 1, 'http://z.com/images/20180602/78c83b42bacfc5a4d4c05f8b7dcec7a0.png', '梨花带雨 3个', 1, 1528280900, 0, '[{\"id\":2,\"name\":\"\\u68a8\\u82b1\\u5e26\\u96e8 3\\u4e2a\",\"haveStock\":true,\"count\":1,\"totalPrice\":\"0.01\",\"price\":\"0.01\",\"main_img_url\":\"http:\\/\\/z.com\\/images\\/20180602\\/78c83b42bacfc5a4d4c05f8b7dcec7a0.png\"}]', '{\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"020-81167888\",\"province\":\"\\u5e7f\\u4e1c\\u7701\",\"city\":\"\\u5e7f\\u5dde\\u5e02\",\"county\":\"\\u6d77\\u73e0\\u533a\",\"detail\":\"\\u65b0\\u6e2f\\u4e2d\\u8def397\\u53f7\",\"user_id\":7}', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int(11) NOT NULL COMMENT '联合主键，订单id',
  `product_id` int(11) NOT NULL COMMENT '联合主键，商品id',
  `count` int(11) NOT NULL COMMENT '商品数量',
  `delete_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `order_product`
--

INSERT INTO `order_product` (`order_id`, `product_id`, `count`, `delete_time`, `update_time`) VALUES
(37, 2, 1, 0, 0),
(3, 3, 1, NULL, NULL),
(6, 3, 1, NULL, NULL),
(14, 3, 4, NULL, NULL),
(23, 3, 1, NULL, NULL),
(26, 3, 1, NULL, NULL),
(31, 3, 1, NULL, NULL),
(2, 4, 1, NULL, NULL),
(16, 4, 3, NULL, NULL),
(33, 4, 2, NULL, NULL),
(1, 5, 5, NULL, NULL),
(17, 5, 2, NULL, NULL),
(20, 5, 2, NULL, NULL),
(21, 5, 1, NULL, NULL),
(24, 5, 1, NULL, NULL),
(30, 5, 1, NULL, NULL),
(1, 6, 6, NULL, NULL),
(5, 6, 2, NULL, NULL),
(19, 6, 2, NULL, NULL),
(34, 6, 1, NULL, NULL),
(35, 6, 1, NULL, NULL),
(36, 6, 1, NULL, NULL),
(4, 7, 3, NULL, NULL),
(7, 7, 4, NULL, NULL),
(11, 7, 1, NULL, NULL),
(13, 7, 3, NULL, NULL),
(18, 7, 3, NULL, NULL),
(27, 7, 2, NULL, NULL),
(9, 8, 4, NULL, NULL),
(10, 8, 3, NULL, NULL),
(22, 8, 1, NULL, NULL),
(28, 8, 2, NULL, NULL),
(29, 8, 1, NULL, NULL),
(32, 8, 1, NULL, NULL),
(8, 10, 1, NULL, NULL),
(15, 10, 1, NULL, NULL),
(25, 10, 3, NULL, NULL),
(12, 14, 3, NULL, NULL),
(12, 15, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL COMMENT '商品名称',
  `price` decimal(6,2) NOT NULL COMMENT '价格,单位：分',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存量',
  `delete_time` int(11) DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  `main_img_url` varchar(255) DEFAULT NULL COMMENT '主图ID号，这是一个反范式设计，有一定的冗余',
  `from` tinyint(4) NOT NULL DEFAULT '1' COMMENT '图片来自 1 本地 ，2公网',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL,
  `summary` varchar(50) DEFAULT NULL COMMENT '摘要',
  `img_id` int(11) DEFAULT NULL COMMENT '图片外键'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `stock`, `delete_time`, `category_id`, `main_img_url`, `from`, `create_time`, `update_time`, `summary`, `img_id`) VALUES
(1, '芹菜 半斤', '0.01', 0, 1, 3, '/product-vg@1.png', 1, NULL, NULL, NULL, 13),
(2, '梨花带雨 3个', '0.01', 100, 0, 2, '/20180602/78c83b42bacfc5a4d4c05f8b7dcec7a0.png', 1, NULL, 1527961814, NULL, 78),
(3, '素米 327克', '0.01', 996, 0, 7, '/product-rice@1.png', 1, NULL, 1527959314, NULL, 31),
(4, '红袖枸杞 6克*3袋', '0.01', 998, 0, 6, '/product-tea@1.png', 1, NULL, NULL, NULL, 32),
(5, '春生龙眼 500克', '0.01', 995, 0, 2, '/product-dryfruit@2.png', 1, NULL, NULL, NULL, 33),
(6, '小红的猪耳朵 120克', '0.01', 997, 0, 5, '/product-cake@2.png', 1, NULL, NULL, NULL, 53),
(7, '泥蒿 半斤', '0.01', 998, 0, 3, '/product-vg@2.png', 1, NULL, 1528010827, NULL, 68),
(8, '夏日芒果 3个', '0.01', 995, 0, 2, '/product-dryfruit@3.png', 1, NULL, NULL, NULL, 36),
(9, '冬木红枣 500克', '0.01', 996, 0, 2, '/product-dryfruit@4.png', 1, NULL, NULL, NULL, 37),
(10, '万紫千凤梨 300克', '0.01', 996, 0, 2, '/product-dryfruit@5.png', 1, NULL, NULL, NULL, 38),
(11, '贵妃笑 100克', '0.01', 994, 0, 2, '/product-dryfruit-a@6.png', 1, NULL, NULL, NULL, 39),
(12, '珍奇异果 3个', '0.01', 999, 0, 2, '/product-dryfruit@7.png', 1, NULL, NULL, NULL, 40),
(13, '绿豆 125克', '0.01', 999, 0, 7, '/product-rice@2.png', 1, NULL, NULL, NULL, 41),
(14, '芝麻 50克', '0.01', 999, 0, 7, '/product-rice@3.png', 1, NULL, NULL, NULL, 42),
(15, '猴头菇 370克', '0.01', 999, 0, 7, '/product-rice@4.png', 1, NULL, NULL, NULL, 43),
(16, '西红柿 1斤', '0.01', 999, 0, 3, '/product-vg@3.png', 1, NULL, NULL, NULL, 69),
(17, '油炸花生 300克', '0.01', 999, 0, 4, '/product-fry@1.png', 1, NULL, NULL, NULL, 44),
(18, '春泥西瓜子 128克', '0.01', 997, 0, 4, '/product-fry@2.png', 1, NULL, NULL, NULL, 45),
(19, '碧水葵花籽 128克', '0.01', 999, 0, 4, '/product-fry@3.png', 1, NULL, NULL, NULL, 46),
(20, '碧螺春 12克*3袋', '0.01', 999, 0, 6, '/product-tea@2.png', 1, NULL, NULL, NULL, 47),
(21, '西湖龙井 8克*3袋', '0.01', 998, 0, 6, '/product-tea@3.png', 1, NULL, NULL, NULL, 48),
(22, '梅兰清花糕 1个', '0.01', 997, 0, 5, '/product-cake-a@3.png', 1, NULL, NULL, NULL, 54),
(23, '清凉薄荷糕 1个', '0.01', 998, 0, 5, '/product-cake-a@4.png', 1, NULL, NULL, NULL, 55),
(25, '小明的妙脆角 120克', '0.01', 999, 0, 5, '/product-cake@1.png', 1, NULL, NULL, NULL, 52),
(26, '红衣青瓜 混搭160克', '0.01', 999, 0, 2, '/product-dryfruit@8.png', 1, NULL, NULL, NULL, 56),
(27, '锈色瓜子 100克', '0.01', 998, 0, 4, '/product-fry@4.png', 1, NULL, NULL, NULL, 57),
(28, '春泥花生 200克', '0.01', 999, 0, 4, '/product-fry@5.png', 1, NULL, NULL, NULL, 58),
(29, '冰心鸡蛋 2个', '0.01', 999, 0, 7, '/product-rice@5.png', 1, NULL, NULL, NULL, 59),
(30, '八宝莲子 200克', '0.01', 999, 0, 7, '/product-rice@6.png', 1, NULL, NULL, NULL, 14),
(31, '深涧木耳 78克', '0.01', 999, 0, 7, '/product-rice@7.png', 1, NULL, NULL, NULL, 60),
(32, '土豆 半斤', '0.01', 999, 0, 3, '/product-vg@4.png', 1, NULL, NULL, NULL, 66),
(33, '青椒 半斤', '0.01', 999, 0, 3, '/product-vg@5.png', 1, NULL, NULL, NULL, 67),
(34, '芒果干', '100.11', 11, 1, 2, '/20180602/9efb9a008d3e90ed7c7d562dd64765b3.png', 1, 1527944391, 1527944391, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) NOT NULL,
  `img_id` int(11) NOT NULL COMMENT '外键，关联图片表',
  `delete_time` int(11) DEFAULT '0' COMMENT '状态，主要表示是否删除，也可以扩展其他状态',
  `order` int(11) NOT NULL DEFAULT '0' COMMENT '图片排序序号',
  `product_id` int(11) NOT NULL COMMENT '商品id，外键'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `product_image`
--

INSERT INTO `product_image` (`id`, `img_id`, `delete_time`, `order`, `product_id`) VALUES
(4, 19, 0, 1, 11),
(5, 20, 0, 2, 11),
(6, 21, 0, 3, 11),
(7, 22, 0, 4, 11),
(8, 23, 0, 5, 11),
(9, 24, 0, 6, 11),
(10, 25, 0, 7, 11),
(11, 26, 0, 8, 11),
(12, 27, 0, 9, 11),
(13, 28, 0, 11, 11),
(14, 29, 0, 10, 11),
(18, 62, 0, 12, 11),
(19, 63, 0, 13, 11),
(20, 70, 1, 0, 11),
(21, 71, 1, 0, 11),
(22, 72, 1, 0, 11),
(23, 73, 1, 0, 11),
(24, 74, 1, 0, 11),
(25, 75, 1, 0, 11),
(26, 79, 1, 0, 2);

-- --------------------------------------------------------

--
-- 表的结构 `product_property`
--

CREATE TABLE `product_property` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT '' COMMENT '详情属性名称',
  `detail` varchar(255) NOT NULL COMMENT '详情属性',
  `product_id` int(11) NOT NULL COMMENT '商品id，外键',
  `delete_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `product_property`
--

INSERT INTO `product_property` (`id`, `name`, `detail`, `product_id`, `delete_time`, `update_time`) VALUES
(1, '品名', '杨梅', 11, NULL, NULL),
(2, '口味', '青梅味 雪梨味 黄桃味 菠萝味', 11, NULL, NULL),
(3, '产地', '火星', 11, NULL, NULL),
(4, '保质期', '180天', 11, NULL, NULL),
(7, '净含量', '100g', 2, NULL, NULL),
(8, '保质期', '10天', 2, NULL, NULL),
(9, '品名', '香梨', 2, NULL, NULL),
(10, '产地', '福建', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '专题名称',
  `description` varchar(255) DEFAULT NULL COMMENT '专题描述',
  `topic_img_id` int(11) NOT NULL COMMENT '主题图，外键',
  `delete_time` int(11) DEFAULT NULL,
  `head_img_id` int(11) NOT NULL COMMENT '专题列表页，头图',
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='主题信息表';

--
-- 转存表中的数据 `theme`
--

INSERT INTO `theme` (`id`, `name`, `description`, `topic_img_id`, `delete_time`, `head_img_id`, `update_time`) VALUES
(1, '专题栏位一', '美味水果世界', 91, NULL, 93, NULL),
(2, '专题栏位二', '新品推荐', 17, NULL, 50, NULL),
(3, '专题栏位三', '做个干物女', 18, NULL, 18, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `theme_product`
--

CREATE TABLE `theme_product` (
  `theme_id` int(11) NOT NULL COMMENT '主题外键',
  `product_id` int(11) NOT NULL COMMENT '商品外键'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='主题所包含的商品';

--
-- 转存表中的数据 `theme_product`
--

INSERT INTO `theme_product` (`theme_id`, `product_id`) VALUES
(1, 2),
(1, 3),
(1, 5),
(1, 8),
(1, 9),
(1, 10),
(1, 12),
(2, 1),
(2, 2),
(2, 3),
(2, 5),
(2, 6),
(2, 16),
(2, 33),
(3, 15),
(3, 18),
(3, 19),
(3, 27),
(3, 30),
(3, 31);

-- --------------------------------------------------------

--
-- 表的结构 `third_app`
--

CREATE TABLE `third_app` (
  `id` int(11) NOT NULL,
  `app_id` varchar(64) NOT NULL COMMENT '应用app_id',
  `app_secret` varchar(64) NOT NULL COMMENT '应用secret',
  `app_description` varchar(100) DEFAULT NULL COMMENT '应用程序描述',
  `scope` varchar(20) NOT NULL COMMENT '应用权限',
  `scope_description` varchar(100) DEFAULT NULL COMMENT '权限描述',
  `delete_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='访问API的各应用账号密码表';

--
-- 转存表中的数据 `third_app`
--

INSERT INTO `third_app` (`id`, `app_id`, `app_secret`, `app_description`, `scope`, `scope_description`, `delete_time`, `update_time`) VALUES
(1, 'aa6950639', 'aa', 'CMS', '32', 'Super', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `extend` varchar(255) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL COMMENT '注册时间',
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `openid`, `nickname`, `extend`, `delete_time`, `create_time`, `update_time`) VALUES
(6, 'ohhED0dGLjceozS7JgqguUTX_2hI', NULL, NULL, NULL, NULL, NULL),
(7, 'oElD94wdbIm6MjQb5Ii4hsoO4pMo', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL COMMENT '收获人姓名',
  `mobile` varchar(20) NOT NULL COMMENT '手机号',
  `province` varchar(20) DEFAULT NULL COMMENT '省',
  `city` varchar(20) DEFAULT NULL COMMENT '市',
  `county` varchar(20) DEFAULT NULL COMMENT '区',
  `detail` varchar(100) DEFAULT NULL COMMENT '详细地址',
  `delete_time` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL COMMENT '外键',
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `user_address`
--

INSERT INTO `user_address` (`id`, `name`, `mobile`, `province`, `city`, `county`, `detail`, `delete_time`, `user_id`, `update_time`) VALUES
(2, 'luopeng', '18782933565', '四川123456', '西昌123', '凉山州', '详细地址', NULL, 6, NULL),
(8, '张三', '020-81167888', '广东省', '广州市', '海珠区', '新港中路397号', NULL, 7, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_item`
--
ALTER TABLE `banner_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_no` (`order_no`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`product_id`,`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_property`
--
ALTER TABLE `product_property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme_product`
--
ALTER TABLE `theme_product`
  ADD PRIMARY KEY (`theme_id`,`product_id`);

--
-- Indexes for table `third_app`
--
ALTER TABLE `third_app`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `openid` (`openid`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `banner_item`
--
ALTER TABLE `banner_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- 使用表AUTO_INCREMENT `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- 使用表AUTO_INCREMENT `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- 使用表AUTO_INCREMENT `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 使用表AUTO_INCREMENT `product_property`
--
ALTER TABLE `product_property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `third_app`
--
ALTER TABLE `third_app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
