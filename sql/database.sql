set foreign_key_checks=0;
#SQLDELIMETER
CREATE TABLE `users` (
  `uid` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
#SQLDELIMETER
set foreign_key_checks=1;