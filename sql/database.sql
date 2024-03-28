set foreign_key_checks=0;
#SQLDELIMETER
CREATE TABLE `users` (
  `uid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `date_password` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
#SQLDELIMETER
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(1023) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
#SQLDELIMETER
CREATE TABLE `users_roles` (
  `user` bigint(20) unsigned NOT NULL,
  `role` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user`,`role`),
  KEY `role` (`role`),
  CONSTRAINT `users_roles_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_roles_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
#SQLDELIMETER
set foreign_key_checks=1;