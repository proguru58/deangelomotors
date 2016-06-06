/*---INITIAL---*/
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL,
  `limit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

CREATE TABLE `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

/*---2016-06-02---*/
CREATE TABLE `photoshoot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `counter` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

DELIMITER $$

DROP TRIGGER IF EXISTS LIVE_COUNTER_BY_UPDATE_TRIGGER $$
CREATE TRIGGER LIVE_COUNTER_BY_UPDATE_TRIGGER
	AFTER UPDATE ON users FOR EACH ROW
BEGIN
    UPDATE photoshoot
        SET photoshoot.counter = (SELECT SUM(`limit`)
                              FROM users 
                             )
    WHERE id = 1;
END; $$

DROP TRIGGER IF EXISTS LIVE_COUNTER_BY_INSERT_TRIGGER $$
CREATE TRIGGER LIVE_COUNTER_BY_INSERT_TRIGGER
	AFTER INSERT ON users FOR EACH ROW
BEGIN
    UPDATE photoshoot
        SET photoshoot.counter = (SELECT SUM(`limit`)
                              FROM users 
                             )
    WHERE id = 1;
END; $$

DROP TRIGGER IF EXISTS LIVE_COUNTER_BY_DELETE_TRIGGER $$
CREATE TRIGGER LIVE_COUNTER_BY_DELETE_TRIGGER
	AFTER DELETE ON users FOR EACH ROW
BEGIN
    UPDATE photoshoot
        SET photoshoot.counter = (SELECT SUM(`limit`)
                              FROM users 
                             )
    WHERE id = 1;
END; $$

DELIMITER ;

/*---2016-06-06---*/
CREATE TABLE `ci_cookies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cookie_id` varchar(255) DEFAULT NULL,
  `netid` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `orig_page_requested` varchar(120) DEFAULT NULL,
  `php_session_id` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_address` varchar(255) DEFAULT NULL,
  `adminname` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
