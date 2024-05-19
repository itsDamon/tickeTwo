DROP DATABASE IF EXISTS `ticketwo`;
CREATE DATABASE IF NOT EXISTS `ticketwo`;
USE `ticketwo`;
CREATE TABLE authors
(
    `author_id`  INT         NOT NULL AUTO_INCREMENT,
    `stage_name` VARCHAR(30) NOT NULL,
    `biography`  TEXT        NOT NULL,
    PRIMARY KEY (author_id)
);
CREATE TABLE `users`
(
    `user_id`   INT          NOT NULL AUTO_INCREMENT,
    `name`      VARCHAR(30)  NOT NULL,
    `surname`   VARCHAR(30)  NOT NULL,
    `username`  VARCHAR(30)  NOT NULL UNIQUE,
    `password`  VARCHAR(255) NOT NULL,
    `birthdate` DATE         NOT NULL,
    PRIMARY KEY (user_id)
);

CREATE TABLE `locations`
(
    `location_id`   INT          NOT NULL,
    `location_name` VARCHAR(30)  NOT NULL,
    `address`       VARCHAR(255) NOT NULL,
    `city`          VARCHAR(30)  NOT NULL,
    `country`       VARCHAR(30)  NOT NULL,
    available_seats INT          NOT NULL,
    PRIMARY KEY (location_id)
);

CREATE TABLE `events`
(
    `event_id`          INT                                NOT NULL AUTO_INCREMENT,
    `event_name`        VARCHAR(30)                        NOT NULL,
    `event_description` VARCHAR(255)                       NOT NULL,
    `date`              TIMESTAMP                          NOT NULL,
    `over_eighteen`     BOOL                               NOT NULL,
    `location_id`       INT                                NOT NULL,
    `author_id`         INT                                NOT NULL,
    `type`              ENUM ('CONCERT','THEATRE','SPORT') NOT NULL,
    `price`             FLOAT                              not null,
    FOREIGN KEY (`author_id`) REFERENCES authors (author_id),
    FOREIGN KEY (`location_id`) REFERENCES locations (location_id),
    PRIMARY KEY (`event_id`)
);

CREATE TABLE `tickets`
(
    `id`       INT NOT NULL AUTO_INCREMENT,
    `user_id`  INT NOT NULL,
    `event_id` INT NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES users (user_id),
    FOREIGN KEY (`event_id`) REFERENCES events (event_id),
    PRIMARY KEY (`id`)
);



INSERT INTO `locations` (location_id, location_name, address, city, country, available_seats)
VALUES (1, 'Unipol Forum', 'Via Giuseppe di Vittorio, 6', 'Milan', 'Italy', 300),
       (3, 'Ippodromo SNAI', 'Piazzale dello Sport, 16', 'Milan', 'Italy', 500),
       (2, 'Stadio San Siro', 'Piazzale Angelo Moratti', 'Milan', 'Italy', 600),
       (4, 'Circo Massimo', 'Via del Circo Massimo', 'Rome', 'Italy', 1000),
       (5, 'Autodromo Nazionale di Monza', 'Viale di Vedano,5', 'Monza', 'Italy', 200),
       (6, 'Teatro Manzoni', 'Via Alessandro Manzoni, 40', 'Milan', 'Italy', 850);

INSERT INTO authors (author_id, `stage_name`, `biography`)
VALUES (1, 'Metallica', 'Metal band'),
       (2, 'Nirvana', 'The best band ever existed'),
       (3, 'System of a Down', 'A Nu Metal Band'),
       (9, 'Korn', ' 90s Nu metal band '),
       (4, 'Slipknot', 'They hate people '),
       (5, 'Caparezza', 'Famous italian singer'),
       (6, 'Andrea Pucci', 'A famous italian cabaretist from milan'),
       (7, 'Rammstein', 'The greatest german metal band'),
       (8, 'F1', 'Follow the formula 1 everywhere it goes');
INSERT INTO `events` (event_name, event_description, date, over_eighteen, location_id, author_id, type, price)
VALUES
    #Concerto dei Metallica
    ('Sick New World', 'Metallica concert', '2024-05-29', false, (SELECT location_id
                                                                  FROM locations
                                                                  WHERE locations.location_name LIKE 'Ippodromo SNAI'),
     (SELECT authors.author_id
      FROM authors
      WHERE stage_name LIKE 'Metallica'), 'CONCERT', 40.60),

    #Concerto di Mario
    ('Mario', 'Mario concert', '2024-8-30', false, (SELECT location_id
                                                    FROM locations
                                                    WHERE locations.location_name LIKE 'Unipol Forum'),
     (SELECT authors.author_id
      FROM authors
      WHERE stage_name LIKE 'Nirvana'), 'CONCERT', 50.44),

    #Formula 1
    ('Formula 1', 'Formula 1 at Monza National Racetrack', '2024-06-30', false,
     (select locations.location_id from locations where locations.location_name like 'Autodromo Nazionale di Monza'),
     (select authors.author_id from authors where authors.stage_name like 'F1'), 'SPORT', 10.50),

    #Pucci show
    ('Il meglio del peggio', 'Cabaret show of Andrea Pucci', '2024-09-21', true,
     (select locations.location_id from locations where locations.location_name like 'Teatro Manzoni'),
     (select authors.author_id from authors where authors.stage_name like 'Andrea Pucci'), 'THEATRE', 15.22);

