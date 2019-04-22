DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users`(
	`id` int(11) NOT NULL AUTO_INCREMENT,
    `email` varchar(254) DEFAULT NULL, 
    `pseudo` varchar(254) DEFAULT NULL,
    `password` varchar(254) DEFAULT NULL,
    `admin` boolean DEFAULT FALSE,
    PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(254) DEFAULT NULL,
    `content` varchar(4064) DEFAULT NULL,
    `extension` varchar(254) DEFAULT NULL,
    PRIMARY KEY(`id`)
);

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) DEFAULT NULL,
    `article_id` int(11) DEFAULT NULL,
    `commentText` varchar(2032),
    PRIMARY KEY(`id`),
    KEY `user_id` (`user_id`),
    KEY `article_id` (`article_id`)
);

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags`(
	`id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(254),
    PRIMARY KEY(`id`)
);

DROP TABLE IF EXISTS `articles_tags`;
CREATE TABLE IF NOT EXISTS `articles_tags`(
	`id` int(11) NOT NULL AUTO_INCREMENT,
    `article_id` int(11) DEFAULT NULL,
    `tag_id` int(11) DEFAULT NULL,
    PRIMARY KEY(`id`),
    KEY `article_id` (`article_id`),
    KEY `tag_id` (`tag_id`)
);