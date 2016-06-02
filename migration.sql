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
