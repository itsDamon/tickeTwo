DROP DATABASE IF EXISTS `ticketwo`;
CREATE DATABASE IF NOT EXISTS `ticketwo`;
USE `ticketwo`;

CREATE TABLE `performers`
(
    `id`         INT         NOT NULL AUTO_INCREMENT,
    `stage_name` VARCHAR(30) NOT NULL,
    `biography`  TEXT        NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `users`
(
    `id`        INT          NOT NULL AUTO_INCREMENT,
    `name`      VARCHAR(30)  NOT NULL,
    `surname`   VARCHAR(30)  NOT NULL,
    `username`  VARCHAR(30)  NOT NULL UNIQUE,
    `password`  VARCHAR(255) NOT NULL,
    `birthdate` DATE         NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `locations`
(
    `id`               INT          NOT NULL AUTO_INCREMENT,
    `name`             VARCHAR(30)  NOT NULL,
    `address`          VARCHAR(255) NOT NULL,
    `city`             VARCHAR(30)  NOT NULL,
    `country`          VARCHAR(30)  NOT NULL,
    `available_places` INT          NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `events`
(
    `id`            INT          NOT NULL AUTO_INCREMENT,
    `name`          VARCHAR(30)  NOT NULL,
    `description`   VARCHAR(255) NOT NULL,
    `date`          TIMESTAMP    NOT NULL,
    `over_eighteen` BOOL         NOT NULL,
    `location_id`   INT          NOT NULL,
    `performer_id`  INT          NOT NULL,
    FOREIGN KEY (`performer_id`) REFERENCES performers (`id`),
    FOREIGN KEY (`location_id`) REFERENCES locations (`id`),
    PRIMARY KEY (`id`)
);

CREATE TABLE `tickets`
(
    `id`       INT NOT NULL AUTO_INCREMENT,
    `user_id`  INT NOT NULL,
    `event_id` INT NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES users (`id`),
    FOREIGN KEY (`event_id`) REFERENCES events (`id`),
    PRIMARY KEY (`id`)
);