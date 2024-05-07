DROP DATABASE IF EXISTS `ticketwo`;
CREATE DATABASE IF NOT EXISTS `ticketwo`;
USE `ticketwo`;

CREATE TABLE `user`
(
    `id`       INT                    NOT NULL AUTO_INCREMENT,
    `name`     VARCHAR(30)            NOT NULL,
    `surname`  VARCHAR(30)            NOT NULL,
    `username` VARCHAR(30)            NOT NULL UNIQUE,
    `password` VARCHAR(40)            NOT NULL,
    `role`     ENUM ('admin', 'user') NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `location`
(
    `id`               INT          NOT NULL AUTO_INCREMENT,
    `name`             VARCHAR(30)  NOT NULL,
    `address`          VARCHAR(255) NOT NULL,
    `city`             VARCHAR(30)  NOT NULL,
    `country`          VARCHAR(30)  NOT NULL,
    `available_places` INT          NOT NULL,
    PRIMARY KEY (`id`)
);


CREATE TABLE `event`
(
    `id`          INT          NOT NULL AUTO_INCREMENT,
    `name`        VARCHAR(30)  NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `date`        TIMESTAMP    NOT NULL,
    `location_id` INT          NOT NULL,
    FOREIGN KEY (`location_id`) REFERENCES location (`id`),
    PRIMARY KEY (`id`)
);

CREATE TABLE `ticket`
(
    `id`       INT NOT NULL AUTO_INCREMENT,
    `user_id`  INT NOT NULL,
    `event_id` INT NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES user (`id`),
    FOREIGN KEY (`event_id`) REFERENCES event (`id`),
    PRIMARY KEY (`id`)
);