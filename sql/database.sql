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
    `id`            INT          NOT NULL AUTO_INCREMENT,
    `name`          VARCHAR(30)  NOT NULL,
    `address`       VARCHAR(255) NOT NULL,
    `city`          VARCHAR(30)  NOT NULL,
    `country`       VARCHAR(30)  NOT NULL,
    available_seats INT          NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `events`
(
    `id`            INT                                NOT NULL AUTO_INCREMENT,
    `name`          VARCHAR(30)                        NOT NULL,
    `description`   VARCHAR(255)                       NOT NULL,
    `date`          TIMESTAMP                          NOT NULL,
    `over_eighteen` BOOL                               NOT NULL,
    `location_id`   INT                                NOT NULL,
    `performer_id`  INT                                NOT NULL,
    type            ENUM ('CONCERT','THEATRE','SPORT') NOT NULL,
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

INSERT INTO `locations` (name, address, city, country, available_seats)
VALUES ('Unipol Forum', 'Via Giuseppe di Vittorio, 6', 'Milan', 'Italy', 300),
       ('Ippodromo SNAI', 'Piazzale dello Sport, 16', 'Milan', 'Italy', 500),
       ('Stadio San Siro', 'Piazzale Angelo Moratti', 'Milan', 'Italy', 600),
       ('Circo Massimo', 'Via del Circo Massimo', 'Rome', 'Italy', 1000),
       ('Autodromo Nazionale di Monza', 'Viale di Vedano,5', 'Monza', 'Italy', 200),
       ('Teatro Manzoni', 'Via Alessandro Manzoni, 40', 'Milan', 'Italy', 850);

INSERT INTO `performers` (`stage_name`, `biography`)
VALUES ('Metallica', 'Metal band'),
       ('Nirvana', 'The best band ever existed'),
       ('System of a Down', 'A Nu Metal Band'),
       ('Korn', ' 90s Nu metal band '),
       ('Slipknot', 'They hate people '),
       ('Caparezza', 'Famous italian singer'),
       ('Andrea Pucci', 'A famous italian cabaretist from milan'),
       ('Rammstein', 'The greatest german metal band'),
       ('Formula 1', 'Follow the formula 1 everywhere it goes');

INSERT INTO `events` (name, description, date, over_eighteen, location_id, performer_id)
VALUES
    #Concerto dei Metallica
    ('Sick New World', 'Metallica concert', '2024-05-29', false, (SELECT id
                                                                  FROM locations
                                                                  WHERE locations.name LIKE 'Ippodromo SNAI'),
     (SELECT id
      FROM performers
      WHERE stage_name LIKE 'Metallica')),

    #Concerto di Mario
    ('Mario', 'Mario concert', '2024-8-30', false, (SELECT id
                                                    FROM locations
                                                    WHERE locations.name LIKE 'Unipol Forum'),
     (SELECT id
      FROM performers
      WHERE stage_name LIKE 'Nirvana')),

    #Formula 1 insert
    ('Formula 1', 'Formula 1 at Monza National Racetrack', '2024-06-30', false,
     (select locations.id from locations where locations.name like 'Autodromo Nazionale di Monza'),
     (select id from performers where performers.stage_name like 'Formula 1')),

    #Pucci show
    ('Il meglio del peggio', 'Cabaret show of Andrea Pucci', '2024-09-21', true,
     (select locations.id from locations where locations.name like 'Teatro Manzoni'),
     (select id from performers where performers.stage_name like 'Andrea Pucci'));

