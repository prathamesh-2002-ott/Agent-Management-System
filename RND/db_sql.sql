--
-- Table structure for table `menu` - Original
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` INT(11) NOT NULL AUTO_INCREMENT,
  `menu_name` VARCHAR(255) NOT NULL,
  `parent_id` INT(11) NOT NULL DEFAULT '0' COMMENT '0 if menu is root level or menuid if this is child on any menu',
  `link` VARCHAR(255) NOT NULL,
  `status` ENUM('0','1') NOT NULL DEFAULT '1' COMMENT '0 for disabled menu or 1 for enabled menu',
  PRIMARY KEY (`menu_id`)
) ENGINE=INNODB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `parent_id`, `link`, `status`) VALUES
(1, 'Home', 0, '#home', '1'),
(2, 'Web development', 0, '#web-dev', '1'),
(3, 'WordPress Development', 0, '#wp-dev', '1'),
(4, 'About w3school.info', 0, '#w3school-info', '1'),
(5, 'AWS ADMIN', 2, '#', '1'),
(6, 'PHP', 2, '#', '1'),
(7, 'Javascript', 2, '#', '1'),
(8, 'Elastic Ip', 5, '#electic-ip', '1'),
(9, 'Load balacing', 5, '#load-balancing', '1'),
(10, 'Cluster Indexes', 5, '#cluster-indexes', '1'),
(11, 'Rds Db setup', 5, '#rds-db', '1'),
(12, 'Framework Development', 6, '#', '1'),
(13, 'Ecommerce Development', 6, '#', '1'),
(14, 'Cms Development', 6, '#', '1'),
(21, 'News & Media', 6, '#', '1'),
(22, 'Codeigniter', 12, '#codeigniter', '1'),
(23, 'Cake', 12, '#cake-dev', '1'),
(24, 'Opencart', 13, '#opencart', '1'),
(25, 'Magento', 13, '#magento', '1'),
(26, 'Wordpress', 14, '#wordpress-dev', '1'),
(27, 'Joomla', 14, '#joomla-dev', '1'),
(28, 'Drupal', 14, '#drupal-dev', '1'),
(29, 'Ajax', 7, '#ajax-dev', '1'),
(30, 'Jquery', 7, '#jquery-dev', '1'),
(31, 'Themes', 3, '#theme-dev', '1'),
(32, 'Plugins', 3, '#plugin-dev', '1'),
(33, 'Custom Post Types', 3, '#', '1'),
(34, 'Options', 3, '#wp-options', '1'),
(35, 'Testimonials', 33, '#testimonial-dev', '1'),
(36, 'Portfolios', 33, '#portfolio-dev', '1');
--