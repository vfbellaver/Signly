-- phpMyAdmin SQL Dump
-- version 4.6.5
-- https://www.phpmyadmin.net/
--
-- Host: mysql.signly.com
-- Generation Time: Aug 11, 2017 at 03:59 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.0


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;



CREATE TABLE `instance` (
  id         INT AUTO_INCREMENT
    PRIMARY KEY,
  `instance` VARCHAR(255) NOT NULL,
  `notes`    TEXT         NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `users_roles` (
  id     INT AUTO_INCREMENT
    PRIMARY KEY,
  `role` VARCHAR(255)
         COLLATE utf8_bin NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

CREATE TABLE `users` (
  id               INT                       AUTO_INCREMENT
    PRIMARY KEY,
  `role_id`        INT(11)          NOT NULL,
  `photo`          VARCHAR(255)
                   COLLATE utf8_bin NOT NULL,
  `first_name`     VARCHAR(50)
                   COLLATE utf8_bin NOT NULL,
  `last_name`      VARCHAR(50)
                   COLLATE utf8_bin NOT NULL,
  `email`          VARCHAR(255)
                   COLLATE utf8_bin NOT NULL,
  `phone`          VARCHAR(50)
                   COLLATE utf8_bin NOT NULL,
  `company`        VARCHAR(50)
                   COLLATE utf8_bin          DEFAULT NULL,
  `about_me`       TEXT COLLATE utf8_bin,
  `password`       TEXT COLLATE utf8_bin,
  `remember_token` TEXT COLLATE utf8_bin,
  `updated_at`     DATETIME                  DEFAULT NULL,
  `created_at`     DATETIME                  DEFAULT NULL,
  `deleted_at`     DATETIME                  DEFAULT NULL,
  `instance_id`    INT(11)          NOT NULL,
  `is_founder`     INT(11)          NOT NULL DEFAULT '0',

  FOREIGN KEY (role_id)
  REFERENCES users_roles(id),

  FOREIGN KEY (instance_id)
  REFERENCES instance(id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

CREATE TABLE `clients` (
  id                INT                       AUTO_INCREMENT
    PRIMARY KEY,
  `first_name`      VARCHAR(50)
                    COLLATE utf8_bin NOT NULL,
  `last_name`       VARCHAR(50)
                    COLLATE utf8_bin NOT NULL,
  `email`           VARCHAR(255)
                    COLLATE utf8_bin NOT NULL,
  `phone1`          VARCHAR(50)
                    COLLATE utf8_bin NOT NULL,
  `phone2`          VARCHAR(50)
                    COLLATE utf8_bin          DEFAULT NULL,
  `fax`             VARCHAR(50)
                    COLLATE utf8_bin          DEFAULT NULL,
  `billing_address` TEXT COLLATE utf8_bin,
  `billing_city`    TEXT COLLATE utf8_bin,
  `billing_state`   TEXT COLLATE utf8_bin,
  `billing_zipcode` TEXT COLLATE utf8_bin,
  `logo`            TEXT COLLATE utf8_bin,
  `contact_name`    VARCHAR(255)
                    COLLATE utf8_bin          DEFAULT NULL,
  `company`         VARCHAR(255)
                    COLLATE utf8_bin          DEFAULT NULL,
  `updated_at`      DATETIME                  DEFAULT NULL,
  `created_at`      DATETIME                  DEFAULT NULL,
  `deleted_at`      DATETIME                  DEFAULT NULL,
  `instance_id`     INT(11)          NOT NULL DEFAULT '0',

  FOREIGN KEY (instance_id)
  REFERENCES instance(id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

CREATE TABLE `proposal` (
  id                INT              AUTO_INCREMENT
    PRIMARY KEY,
  `client_id`       INT(11) NOT NULL,
  `name`            VARCHAR(255)
                    COLLATE utf8_bin DEFAULT NULL,
  `budget`          DECIMAL(10, 0)   DEFAULT NULL,
  `budget_validity` VARCHAR(50)
                    COLLATE utf8_bin DEFAULT NULL,
  `start_date`      DATE             DEFAULT NULL,
  `end_date`        DATE             DEFAULT NULL,
  `map_area_lat`    VARCHAR(255)
                    COLLATE utf8_bin DEFAULT NULL,
  `map_area_long`   VARCHAR(255)
                    COLLATE utf8_bin DEFAULT NULL,
  `hash`            TEXT COLLATE utf8_bin,
  `created_at`      DATETIME         DEFAULT NULL,
  `updated_at`      DATETIME         DEFAULT NULL,
  `deleted_at`      DATETIME         DEFAULT NULL,
  `user_id`         INT(11) NOT NULL,
  `accepted`        INT(11) NOT NULL,
  `booked`          INT(11) NOT NULL DEFAULT '0',
  `instance_id`     INT(11) NOT NULL DEFAULT '0',

  FOREIGN KEY (user_id)
  REFERENCES users (id),

  FOREIGN KEY (client_id)
  REFERENCES clients (id),

  FOREIGN KEY (instance_id)
  REFERENCES instance(id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;


CREATE TABLE `active_proposal` (
  id            INT                AUTO_INCREMENT
    PRIMARY KEY,
  `proposal_id` INT(11)   NOT NULL,
  `created_at`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  DATETIME  NOT NULL,
  `user_id`     INT(11)   NOT NULL,
  `instance_id` INT(11)            DEFAULT '0',

  FOREIGN KEY (proposal_id)
  REFERENCES proposal (id),

  FOREIGN KEY (instance_id)
  REFERENCES instance(id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;


CREATE TABLE `billboard_image` (
  id               INT AUTO_INCREMENT
    PRIMARY KEY,
  `image_name`     VARCHAR(255)
                   COLLATE utf8_bin      NOT NULL,
  `image_location` TEXT COLLATE utf8_bin NOT NULL,
  `created_at`     DATETIME              NOT NULL,
  `updated_at`     DATETIME              NOT NULL,
  `deleted_at`     DATETIME              NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

CREATE TABLE `owners` (
  id                INT                       AUTO_INCREMENT
    PRIMARY KEY,
  `first_name`      VARCHAR(50)
                    COLLATE utf8_bin NOT NULL,
  `last_name`       VARCHAR(50)
                    COLLATE utf8_bin NOT NULL,
  `email`           VARCHAR(255)
                    COLLATE utf8_bin NOT NULL,
  `phone1`          VARCHAR(50)
                    COLLATE utf8_bin NOT NULL,
  `phone2`          VARCHAR(50)
                    COLLATE utf8_bin          DEFAULT NULL,
  `fax`             VARCHAR(50)
                    COLLATE utf8_bin          DEFAULT NULL,
  `billing_address` TEXT COLLATE utf8_bin,
  `billing_city`    TEXT COLLATE utf8_bin,
  `billing_state`   TEXT COLLATE utf8_bin,
  `billing_zipcode` TEXT COLLATE utf8_bin,
  `logo`            TEXT COLLATE utf8_bin,
  `contact_name`    VARCHAR(255)
                    COLLATE utf8_bin          DEFAULT NULL,
  `company`         VARCHAR(255)
                    COLLATE utf8_bin          DEFAULT NULL,
  `updated_at`      DATETIME                  DEFAULT NULL,
  `created_at`      DATETIME                  DEFAULT NULL,
  `deleted_at`      DATETIME                  DEFAULT NULL,
  `instance_id`     INT(11)          NOT NULL DEFAULT '0',

  FOREIGN KEY (instance_id)
  REFERENCES instance(id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

CREATE TABLE `billboard` (
  id                    INT                            AUTO_INCREMENT
    PRIMARY KEY,
  `billboard_id`        VARCHAR(10)
                        COLLATE utf8_bin      NOT NULL,
  `owner_id`            INT(11)               NOT NULL,
  `name`                VARCHAR(50)
                        COLLATE utf8_bin      NOT NULL,
  `description`         TEXT COLLATE utf8_bin NOT NULL,
  `address`             TEXT COLLATE utf8_bin NOT NULL,
  `city`                TEXT COLLATE utf8_bin NOT NULL,
  `state`               TEXT COLLATE utf8_bin NOT NULL,
  `zipcode`             TEXT COLLATE utf8_bin NOT NULL,
  `billboard_image_id`  INT(11)               NOT NULL,
  `rate`                DECIMAL(10, 0)        NOT NULL,
  `digital_driveby`     TEXT COLLATE utf8_bin NOT NULL,
  `lat`                 VARCHAR(100)
                        COLLATE utf8_bin      NOT NULL,
  `lng`                 VARCHAR(100)
                        COLLATE utf8_bin      NOT NULL,
  `hard_cost`           DECIMAL(10, 0)        NOT NULL,
  `monthly_impressions` DECIMAL(10, 0)        NOT NULL,
  `created_at`          DATETIME                       DEFAULT NULL,
  `updated_at`          DATETIME                       DEFAULT NULL,
  `deleted_at`          DATETIME                       DEFAULT NULL,
  `instance_id`         INT(11)               NOT NULL DEFAULT '0',

  FOREIGN KEY (owner_id)
  REFERENCES owners (id),

  FOREIGN KEY (billboard_image_id)
  REFERENCES billboard_image (id),

  FOREIGN KEY (instance_id)
  REFERENCES instance(id)

)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;




CREATE TABLE `billboard_faces` (
  id                    INT                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    AUTO_INCREMENT
    PRIMARY KEY,
  `billboard_id`        INT(11)               NOT NULL,
  `unique_id`           VARCHAR(15)
                        COLLATE utf8_bin NOT NULL,
  `height`              FLOAT            NOT NULL                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   DEFAULT '0',
  `width`               FLOAT            NOT NULL                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   DEFAULT '0',
  `reads`               VARCHAR(50)
                        COLLATE utf8_bin NOT NULL,
  `label`               VARCHAR(50)
                        COLLATE utf8_bin NOT NULL
  COMMENT 'north east sout west custom',
  `digital_driveby`     TEXT COLLATE utf8_bin,
  `sign_type`           INT(11)          NOT NULL                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   DEFAULT '0'
  COMMENT '0 for static 1 for digital',
  `hard_cost`           FLOAT            NOT NULL                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   DEFAULT '0',
  `monthly_impressions` FLOAT            NOT NULL                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   DEFAULT '0',
  `notes`               TEXT COLLATE utf8_bin NOT NULL,
  `max_ads`             INT(11)               NOT NULL,
  `duration`            INT(11)               NOT NULL,
  `photo`               TEXT COLLATE utf8_bin NOT NULL,
  `owner_id`            INT(11)               NOT NULL,
  `instance_id`         INT(11)               NOT NULL,

  FOREIGN KEY (billboard_id)
  REFERENCES billboard (id),

  FOREIGN KEY (owner_id)
  REFERENCES owners (id),

  FOREIGN KEY (instance_id)
  REFERENCES instance(id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin
  COMMENT = 'billboard faces for each billboard view';


CREATE TABLE `active_proposal_billboards` (
  id                   INT              AUTO_INCREMENT
    PRIMARY KEY,
  `active_proposal_id` INT(11) NOT NULL,
  `proposal_id`        INT(11) NOT NULL,
  `billboard_id`       INT(11) NOT NULL,
  `billboard_face_id`  INT(11) NOT NULL,
  `user_id`            INT(11) NOT NULL,
  `proposal_price`     DOUBLE  NOT NULL,
  `instance_id`        INT(11) NOT NULL DEFAULT '0',

  FOREIGN KEY (user_id)
  REFERENCES users (id),

  FOREIGN KEY (active_proposal_id)
  REFERENCES active_proposal (id),

  FOREIGN KEY (billboard_id)
  REFERENCES billboard (id),

  FOREIGN KEY (billboard_face_id)
  REFERENCES billboard_faces (id),

  FOREIGN KEY (proposal_id)
  REFERENCES proposal (id),

  FOREIGN KEY (instance_id)
  REFERENCES instance(id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Table structure for table `client_booking`
--

CREATE TABLE `client_booking` (
  id                  INT                            AUTO_INCREMENT
    PRIMARY KEY,
  `billboard_id` INT(11)                    NOT NULL,
  `billboard_face_id` INT(11) NOT NULL,
  `vendor_id`         INT(11) DEFAULT NULL,
  `client_id`         INT(11) DEFAULT NULL,
  `proposal_id`       INT(11) DEFAULT NULL,
  `description`       TEXT COLLATE utf8_bin,
  `book_start_date`   DATETIME DEFAULT NULL,
  `book_end_date`     DATETIME DEFAULT NULL,
  `set_price`         DECIMAL(10, 0) DEFAULT NULL,
  `billboard_type`    INT(11)        DEFAULT NULL,
  `updated_at`        DATETIME NOT NULL,
  `created_at`        DATETIME NOT NULL,
  `deleted_at`        DATETIME       DEFAULT NULL,
  `user_id`           INT(11)  NOT NULL,
  `photo`             TEXT COLLATE utf8_bin NOT NULL,
  `instance_id`       INT(11)               NOT NULL DEFAULT '0',

  FOREIGN KEY (user_id)
  REFERENCES users (id),

  FOREIGN KEY (proposal_id)
  REFERENCES proposal (id),

  FOREIGN KEY (billboard_id)
  REFERENCES billboard (id),

  FOREIGN KEY (billboard_face_id)
  REFERENCES billboard_faces (id),

  FOREIGN KEY (client_id)
  REFERENCES clients (id),

  FOREIGN KEY (instance_id)
  REFERENCES instance(id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

CREATE TABLE `contract` (
  id              INT AUTO_INCREMENT
    PRIMARY KEY,
  `proposal_id` INT(11)        NOT NULL,
  `title`       VARCHAR(255) NOT NULL,
  `start_date`  DATE         NOT NULL,
  `end_date`    DATE         NOT NULL,
  `email_to`    VARCHAR(255) NOT NULL,
  `email_cc`    VARCHAR(255) NOT NULL,
  `email_subject` VARCHAR(255) NOT NULL,
  `message`       TEXT         NOT NULL,
  `updated_at`    TIMESTAMP    NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at`    DATETIME     NOT NULL,

  FOREIGN KEY (proposal_id)
  REFERENCES proposal (id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `proposal_billboard` (
  id                  INT               AUTO_INCREMENT
    PRIMARY KEY,
  `proposal_id` INT(11)        NOT NULL,
  `billboard_id` INT(11) NOT NULL,
  `billboard_face_id` INT(11) NOT NULL,
  `created_at`        DATETIME NOT NULL,
  `updated_at`        DATETIME NOT NULL,
  `deleted_at`        DATETIME NOT NULL,
  `user_id`           INT(11)  NOT NULL,
  `client_accepted`   INT(11)  NOT NULL,
  `client_rejected`   INT(11)  NOT NULL,
  `proposal_price`    DOUBLE DEFAULT NULL,
  `instance_id`       INT(11)  NOT NULL DEFAULT '0',

  FOREIGN KEY (user_id)
  REFERENCES users (id),

  FOREIGN KEY (proposal_id)
  REFERENCES proposal (id),

  FOREIGN KEY (billboard_id)
  REFERENCES billboard (id),

  FOREIGN KEY (billboard_face_id)
  REFERENCES billboard_faces (id),

  FOREIGN KEY (instance_id)
  REFERENCES instance (id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

CREATE TABLE `proposal_comments` (
  id             INT      AUTO_INCREMENT
    PRIMARY KEY,
  `user_id` INT(11) DEFAULT NULL,
  `proposal_id` INT(11) DEFAULT NULL,
  `client_id`   INT(11) DEFAULT NULL,
  `message`     TEXT         NOT NULL,
  `message_from` VARCHAR(10) NOT NULL,
  `created_at`   DATETIME DEFAULT NULL,
  `updated_at`   DATETIME DEFAULT NULL,
  `deleted_at`   DATETIME DEFAULT NULL,

  FOREIGN KEY (user_id)
  REFERENCES users (id),

  FOREIGN KEY (client_id)
  REFERENCES clients (id),

  FOREIGN KEY (proposal_id)
  REFERENCES proposal (id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `proposal_permissions` (
  id             INT AUTO_INCREMENT
    PRIMARY KEY,
  `user_role_id` INT(11) NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

CREATE TABLE `users_settings` (
  id                    INT AUTO_INCREMENT
    PRIMARY KEY,
  `user_id` INT(11)                   NOT NULL,
  `company_name` VARCHAR(255)
                        COLLATE utf8_bin NOT NULL,
  `posting_cycle` INT(11)         NOT NULL,
  `can_hold`      INT(11)         NOT NULL,
  `release_hold_value` DECIMAL(10, 0) NOT NULL,
  `release_hool_period` INT(11)       NOT NULL,
  `allow_remove`        INT(11)       NOT NULL,
  `created_at`          DATETIME      NOT NULL,
  `updated_at`          DATETIME      NOT NULL,
  `deleted_at`          DATETIME      NOT NULL,

  FOREIGN KEY (user_id)
  REFERENCES users (id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

CREATE TABLE `user_role_permission` (
  id        INT AUTO_INCREMENT
    PRIMARY KEY,
  `user_id` INT(11) NOT NULL,
  `view`    INT(11) NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

CREATE TABLE proposal_settings
(
  id           INT AUTO_INCREMENT
    PRIMARY KEY,
  user_id INT              NOT NULL,
  path_image VARCHAR(50) NULL,
  user_street VARCHAR(100) NULL,
  user_state  VARCHAR(100) NULL,
  user_city   VARCHAR(100) NULL,
  user_zipcode VARCHAR(15) NULL,
  website      VARCHAR(50) NULL
);

CREATE INDEX user_id
  ON proposal_settings (user_id);

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;




INSERT INTO `instance` (`id`, `instance`, `notes`) VALUES
  (1, 'Main Instance', 'Main Instance'),
  (2, 'Kennedy Outdoor', 'Beta-User'),
  (3, 'Circle City Billboards', ''),
  (4, 'Independent Outdoor', '');

INSERT INTO `owners` (`id`, `first_name`, `last_name`, `email`, `phone1`, `phone2`, `fax`, `billing_address`, `billing_city`, `billing_state`, `billing_zipcode`, `logo`, `contact_name`, `company`, `updated_at`, `created_at`, `deleted_at`, `instance_id`) VALUES
  (1, 'John', 'Doe', 'john.doe@test.com', '1234567', '1234567', '1234567', 'test', 'test', 'test', 'test', NULL, NULL, 'J&M Company', NULL, NULL, NULL, 3),
  (2, 'Dave', 'Tomei', 'david@reaganusa.com', '(801) 521-1775', '801-555-5555', '(801) 521-9741', '1775 North Warm Springs Road', 'Salt Lake City', 'UT', '84116', NULL, NULL, 'Reagan', NULL, NULL, NULL, 1),
  (3, 'Matt', 'Reid', 'matt@mammothbillboards.com', '801-898-2420', '801-898-2420', '801-898-2420', '1728 27th ST', 'Ogden', 'UT', '84403', NULL, NULL, 'Mammoth Outdoor', NULL, NULL, NULL, 1),
  (4, 'R.C.', 'Channel', 'kennedyoutdoor9@gmail.com', '740-258-7083', '740-258-7083', '740-258-7083', '9327 Martinsburg Rd', ' St Louisville', 'OH', '43071', NULL, NULL, 'Kennedy Outdoor', NULL, NULL, NULL, 1),
  (5, 'R.C.', 'Kennedy', 'kennedyoutdoor9@gmail.com', '740-258-7083', '740-258-7083', '740-258-7083', '9327 Martinsburg Rd', ' St Louisville', 'OH', '43071', NULL, NULL, 'Kennedy Outdoor', NULL, NULL, NULL, 2),
  (6, 'Eric', 'Lambert', 'eric@independentoutdoor.com', '203-318-9097', '203-318-9097', '203-318-9097', '1, 346 Quinnipiac St.', 'Wallingford', 'CT', '06492', NULL, NULL, 'Independent Outdoor', NULL, NULL, NULL, 4);

INSERT INTO `clients` (`first_name`, `last_name`, `email`, `phone1`, `phone2`, `fax`, `billing_address`, `billing_city`, `billing_state`, `billing_zipcode`, `logo`, `contact_name`, `company`, `updated_at`, `created_at`, `deleted_at`, `instance_id`) VALUES
  ('Michael', 'Spencer', 'michael@sjatty.com', '8017431507', '8017431507', '8017431507', '5664 S Green Street', '5664 S Green Street', '5664 S Green Street', '5664 S Green Street', NULL, NULL, 'Siegfried & Jensen', NULL, NULL, NULL, 1),
  ('Julianna', 'Spencer', ' jewels@mikeandjewels.com', '8012004964', '8012004964', '8012004964', '636 south 500 west', 'Provo', 'UT', '84601', NULL, NULL, 'Jsweetie', NULL, NULL, NULL, 1),
  ('Matt ', 'Reid', 'Matt@mammothbillboards.com', '801 898 2420', 'Same', 'None', '1727 e 27th street', 'Ogden', 'Utah', '84003', NULL, NULL, 'Mammoth Billboards', NULL, NULL, NULL, 1),
  ('John', 'Doe', 'cesar.benedicto.espinosa@gmail.com', '023939959', '4940594509', '495495495', 'test', 'test', 'test', 'test', NULL, NULL, 'ACME Ltd.', NULL, NULL, NULL, 1),
  ('H Le ', 'Spencer', 'hlespencer@yahoo.com', '6262521630', '6262521630', '6262521630', '1683 N. Rocky Rd.', 'Upland', 'California', '91784', NULL, NULL, 'Spencer Dynamics', NULL, NULL, NULL, 1),
  ('Mike', 'Spencer', 'mike@signly.com', '8012004395', '8012004395', '8012004395', '1291 Springfield St', 'Upland', 'CA', '91786', NULL, NULL, 'Signly', NULL, NULL, NULL, 2),
  ('Jared', 'Spencer', 'lemeilleurmec@gmail.com', '6266650927', '6266650927', '6666666666', '9176 Regents Rd. Apt. J', '9176 Regents Rd. Apt. J', '9176 Regents Rd. Apt. J', '9176 Regents Rd. Apt. J', NULL, NULL, 'Jared Spencer', NULL, NULL, NULL, 1),
  ('Test', 'Test', 'Test@TEst.com', '123456789', '123456789', '123456789', '5664 S Green Street', 'Salt Lake City', 'Utah', '84123', NULL, NULL, 'Test', NULL, NULL, NULL, 2),
  ('Ned', 'Siegfried', 'ned@sjatty.com', '8012660999', '8015981218', '8012660999', '5664 S Green Street', 'Salt Lake City', 'UT', '84123', NULL, NULL, 'Siegfried & Jensen', NULL, NULL, NULL, 3),
  ('Jay', 'Kimball', 'jay@jaysradiator.com', '8015468574', '8015468574', '8015468574', '453 Rancho Alegre', 'Covina', 'CA', '91724', NULL, NULL, 'Jay\'s Radioator', NULL, NULL, NULL, 4),
  ('Jenny', 'Ritza', 'ritza@pizza.com', '7859083485', '7859083485', '7859083485', '7859083485', '7859083485', '7859083485', '7859083485', NULL, NULL, 'Ritza\'s Pizza', NULL, NULL, NULL, 4),
  ('Thomas', 'Monson', 'tmonson@lds.org', '8012448578', '8012448578', '8012448578', '8012448578', '8012448578', '8012448578', '8012448578', NULL, NULL, 'LDS Church', NULL, NULL, NULL, 2),
  ('Randall', 'Day', 'rday@byu.edu', '8014224278', '8014224278', '8014224278', '8014224278', '8014224278', '8014224278', '8014224278', NULL, NULL, 'Flourishing Families', NULL, NULL, NULL, 1);

INSERT INTO `users` (`role_id`, `photo`, `first_name`, `last_name`, `email`, `phone`, `company`, `about_me`, `password`, `remember_token`, `updated_at`, `created_at`, `deleted_at`, `instance_id`, `is_founder`) VALUES
  (1, '', 'John', 'Doe', 'cesar.benedicto.espinosa@gmail.com', '', NULL, NULL, '$2a$10$btFdgfVD74eLeYeOzS0JvO0uQZPOywcSQJrOeJ98UsAeroATHKb8W', 'ABdqJGxag4j1Lc5Xuk5AvToZpDRDJ5H0eCTwfHCss5GpIQ5YfMw1rHyUjYsd', '2016-04-12 03:35:02', '2015-02-21 08:29:13', NULL, 4, 1),
  (1, '', 'Michael', 'Spencer', 'mike@mikeandjewels.com', '', NULL, NULL, '$2y$10$dEMsdMd6pc52Sx0NWfdwv.dFEr8cMr8FoQqnIsbEFMhg52jROzdj.', 'jmKGyul0HLiyGxvK3uXJgmy5y0J8wbnyQupcpuWl2AqX4QDU3AD4IUWIQcF7', '2017-08-03 13:27:1', '2015-04-06 16:48:45', NULL, 4, 1),
  (1, '', 'Marian', 'Pop', 'marian@creatiph.com', '', NULL, NULL, '$2y$10$U9dKW2L/eOGrbO8ugHKbiOWtJLvYB8fVSE7p2OfsYWk32w1iZz6B6', NULL, '2015-04-08 18:46:25', '2015-04-08 18:46:25', NULL, 4, 0),
  (1, '', 'Test', 'User', 'test@test.com', '', NULL, NULL, '$2a$10$btFdgfVD74eLeYeOzS0JvO0uQZPOywcSQJrOeJ98UsAeroATHKb8W', 'VXVBU5Jzs5TDyWr6oSsBcYDD3QXD0DJ0dyEAyScgRkuzvwN9mgZPrdzCQmWl', '2016-01-13 00:18:30', NULL, NULL, 1, 0),
  (1, '', 'Juliana', 'Spencer', 'jewels@mikeandjewels.com', '', NULL, NULL, '$2y$10$dEMsdMd6pc52Sx0NWfdwv.dFEr8cMr8FoQqnIsbEFMhg52jROzdj.', NULL, NULL, NULL, NULL, 3, 0),
  (1, '', 'Matt', '', 'matt@mammothbillboards.com', '', NULL, NULL, '$2a$10$qqqGWrz9A.doo1u4w3OKuu8WM5rpxt4VGasE85ND3xXROLjrAS1bW', 'hrmeaqfpdE7dtWGGLLBZ36XnET0sPCJ7kLkn3qEquzhmnqwkp89ncfeh6tA1', '2017-06-01 00:10:25', NULL, NULL, 4, 0),
  (1, '', 'a', 'a', 'fluflux2003@gmail.com', '', NULL, NULL, '$2y$10$ipOfMELulkeR.V8AJlRcv.3mCevzhFLWI4VKjgkTh3lgMRr3ZYpLK', 'XVi7naNeXVIbB5EAi1FHDfQ0e2Jv51KhCCuBDS1W0PYihbwBle4kbKvzg0og', '2016-01-1 13:34:56', '2016-01-1 13:33:49', NULL, 1, 0),
  (1, '', 'H Le', 'Spencer', 'hlespencer@yahoo.com', '', NULL, NULL, '$2y$10$NJAHEmigHsVjoyFOQXI.x.uKR8LLnTtmZ.cInmzta2FzSshct1CUi', NULL, '2016-03-1 01:51:52', '2016-03-1 01:51:52', NULL, 1, 0),
  (1, '', 'Jared', 'Spencer', 'jaredspencer12@gmail.com', '', NULL, NULL, '$2a$06$ZVcdkzjUkyLvMzsqXLT15uWQzv.BUaulrLExJ2AUF7FEn2cUmS4OW', NULL, '2016-05-11 10:41:1', '2016-05-11 10:41:20', NULL, 2, 0),
  (1, '', 'Chase', 'Chase', 'chase@yellowbus.media', '12355556', NULL, NULL, '$2a$06$hkGLDs2U7D3Oj6icxaHkZucQUyGVVflmNIRSmlyL5rgo.XU.hdTf2', NULL, NULL, NULL, NULL, 3, 0),
  (1, '', 'R.C.', 'Kennedy', 'kennedyoutdoor9@gmail.com', '', NULL, NULL, '$2a$06$vADOw4zEYHs4LZYtJ5gqZeq2FNVlg894NIaewgAQHDxo1pYq0q.JW', 'bTdL2YFMpN7xDsx6qyraoqCkPnpYels2pYONWqUI7A14h13pDXbz2ay4BiU0', '2017-07-12 00:18:12', '2017-06-27 00:00:00', NULL, 2, 0),
  (1, '', 'Dave', 'Westburg', 'circlecitybillboards@gmail.com', '', NULL, NULL, '$2a$06$Qkzyhj1cFJ3.UC0lNUgDv.tkdhdAXiUR9niDXXluXscI0u0suxIWy', NULL, '2017-06-27 00:00:00', '2017-06-27 00:00:00', NULL, 2, 0),
  (1, '', 'Michael', 'Spencer', 'jim@mikeandjewels.com', '', NULL, NULL, '$2y$10$sJA8lrac290LS4OlgEm7i.YS3taypI.hXEd7cDxgoHm5vWTkR/aqq', NULL, '2017-06-27 00:00:00', '2017-06-27 00:00:00', NULL, 2, 0),
  (1, '', 'Dave', 'Westburg', 'circlecitybillboards@gmail.com', '', NULL, NULL, '$2y$10$veq8btbWItB0/DcvI9vnBeRA1k.1igUDberCp9KLSCsU8mQu/im4W', NULL, '2017-06-27 00:00:00', '2017-06-27 00:00:00', NULL, 3, 0),
  (1, '', 'Test', 'Test', 'test@test.com', '', NULL, NULL, '$2y$10$dgsinB8.oTsdJfUGUvt4J.gPmZJbiG343iPV8JArRkq/SPu1v3FiC', NULL, '2017-07-04 00:00:00', '2017-07-04 00:00:00', NULL, 1, 0),
  (1, '', 'Eric', 'Lambert', 'eric@independentoutdoor.com', '', NULL, NULL, '$2y$10$Uodmgn.Fd3AGvyUWa9uTZuWyd3cWKzmWJxiBIFiVVT846SCQPg0qu', 'b6TGZRyIKXhg8N8hEUEeJ61RC5Pb87DwF8BDu7sZXNAZAmyzMOzzyQjEGeq2', '2017-07-26 00:41:50', '2017-07-26 00:00:00', NULL, 4, 0);

INSERT INTO `proposal` (`client_id`, `name`, `budget`, `budget_validity`, `start_date`, `end_date`, `map_area_lat`, `map_area_long`, `hash`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `accepted`, `booked`, `instance_id`) VALUES
  (4, 'Sweetie', '1000000', 'Week', '2015-08-10', '2015-08-10', NULL, NULL, 'aea7d19b7890703006e56b16b5fbf4c7', NULL, NULL, NULL, 16, 0, 0, 4),
  (4, 'Matt\'s', '87878', 'Week', '2015-08-04', '2016-04-29', NULL, NULL, 'ceb658eddf71814eea21212deb08deab', NULL, NULL, NULL, 16, 0, 0, 4),
  (1, 'Mike\'s Test Proposal', '50000', 'Month', '2015-11-06', '2016-03-10', NULL, NULL, '063389020202701d6289ca94fa7cbcc8', NULL, NULL, NULL, 16, 0, 0, 4),
  (2, 'Show off to J', '50000', 'Year', '2015-11-09', '2016-11-09', NULL, NULL, '831d11995955ed168c0501b7851dbe2a', NULL, NULL, NULL, 16, 0, 0, 4),
  (1, 'New Boards for Ned', '15000', 'Month', '2015-12-23', '2016-02-29', NULL, NULL, '3bbd474cdb6575d18ae1033e59fc25a4', NULL, NULL, NULL, 16, 0, 0, 4),
  (1, 'tester', '3000', 'Month', '2015-12-1', '2016-03-31', NULL, NULL, '45c48cce2e2d7fbdea1afc51c7c6ad26', NULL, NULL, NULL, 16, 0, 0, 4),
  (4, 'Test User Proposal', '10000', 'Week', '2016-01-04', '2016-01-04', NULL, NULL, '2d5c04770d6d73aceb812574a55eb4d9', NULL, NULL, NULL, 16, 0, 0, 4),
  (4, 'My New Test Proposal', '10000', 'Week', '2016-01-05', '2016-01-05', NULL, NULL, 'c0f54a0eb3ae4302fba56a2d1c3fab19', NULL, NULL, NULL, 16, 0, 0, 4),
  (2, 'Clip Earring Shop', '5000', 'Month', '2016-01-21', '2016-04-21', NULL, NULL, 'd0c0ed84d041a2cc5a1a45d9e6ec67f2', NULL, NULL, NULL, 16, 0, 0, 4),
  (4, 'Test User Proposal', '10000', 'Week', '2016-01-1', '2016-01-1', NULL, NULL, '9bf31c7ff062936a96d3c8bd1f8f2ff3', NULL, NULL, NULL, 16, 0, 0, 4),
  (1, 'My New Test Proposal', '100000', 'Week', '2016-01-01', '2016-02-29', NULL, NULL, 'f45581dce368ecc53386d0ff5058f17b', NULL, NULL, NULL, 16, 0, 0, 4),
  (2, 'My New User Locking Test Proposal', '200000', 'Week', '2016-02-19', '2016-02-19', NULL, NULL, 'a653c6bdba6d477c165ad250add8211f', NULL, NULL, NULL, 7, 0, 0, 2),
  (5, 'signly scrrenshot', '1000', 'Week', '2016-03-1', '2016-03-1', NULL, NULL, 'cc1bd048c5784806a842f453ebe7558d', NULL, NULL, NULL, 9, 0, 0, 1),
  (6, '25 Mar 2016 - Signly', '5000', 'Month', '2016-04-01', '2016-06-30', NULL, NULL, '3416a75f4cea9109507cacd8e2f2aefc', NULL, NULL, NULL, 2, 1, 1, 3),
  (6, '30 Mar 2016 Hoogle Zoo', '5000', 'Month', '2016-09-01', '2016-12-31', NULL, NULL, 'a1d0c6e83f027327d8461063f4ac58a6', NULL, NULL, NULL, 2, 1, 1, 3),
  (1, '22 Apr 2016 - Test', '5000', 'Month', '2016-04-01', '2016-05-31', NULL, NULL, 'f7177163c833dff4b38fc8d2872f1ec6', NULL, NULL, NULL, 2, 1, 1, 3),
  (6, '22 Apr 2016 - Karen Demo', '5000', 'Month', '2016-07-01', '2016-08-31', NULL, NULL, '6c8349cc7260ae62e3b1396831a8398f', NULL, NULL, NULL, 2, 1, 1, 3),
  (7, '26 Apr 2016 - Jared Test', '5000', 'Month', '2016-08-01', '2016-09-30', NULL, NULL, 'd9d4f495e875a2e075a1a4a6e1b9770f', NULL, NULL, NULL, 2, 1, 1, 3),
  (1, '#11 #12 #21 mammoth deal', '1000', 'Week', '2017-02-06', '2017-02-06', NULL, NULL, '5828e13641dba1e5760fc91288615b13', NULL, NULL, NULL, 7, 0, 0, 2),
  (1, 'S&J - Fire Sale', '1000', 'Week', '2017-03-01', '2018-02-28', NULL, NULL, '36ba0baf8dd2683f5fcf44c4194db0b4', NULL, NULL, NULL, 2, 0, 1, 3),
  (1, '11 Mar 2017', '10000', 'Week', '2017-04-01', '2017-06-30', NULL, NULL, '419e886416fa01c05fdea200e3c72818', NULL, NULL, NULL, 2, 1, 1, 3),
  (1, 'demo', '5000', 'Week', '2017-04-22', '2017-04-22', NULL, NULL, '6619530c2aa3d0cf74145acda7e1db0e', NULL, NULL, NULL, 2, 1, 0, 3),
  (1, 'Demo for Lee', '5000', 'Week', '2017-05-01', '2017-07-31', NULL, NULL, 'ab4c0f8f84ec97e90ce1423e70405926', NULL, NULL, NULL, 2, 0, 0, 3),
  (1, 'Demo 3 May', '5000', 'Week', '2017-05-01', '2017-07-31', NULL, NULL, 'af211804fe2ca754621ed78ae97611ab', NULL, NULL, NULL, 2, 0, 0, 3),
  (1, 'May Rotary Posters', '15000', 'Week', '2017-05-1', '2017-06-1', NULL, NULL, 'c93faebac05a730f14451e5cc4274a14', NULL, NULL, NULL, 2, 0, 0, 3),
  (1, 'June Rotary Posters', '3000', 'Week', '2017-06-1', '2017-07-1', NULL, NULL, '7d0b8db5b9761551d858021a989eff97', NULL, NULL, NULL, 2, 0, 0, 3),
  (1, 'June Rotary Posters', '3000', 'Week', '2017-06-1', '2017-07-1', NULL, NULL, 'f97fd948ae91b9e4bd259682ada5b818', NULL, NULL, NULL, 2, 1, 0, 3),
  (1, '6 Jun 2017 - Big Proposal', '30000', 'Week', '2017-06-01', '2017-08-31', NULL, NULL, 'a7759ca8d3748450ee8b8487b6f351e6', NULL, NULL, NULL, 2, 0, 0, 3),
  (1, 'Dave\'s demo', '5000', 'Week', '2017-06-19', '2017-06-19', NULL, NULL, 'd63ed23c053651c706a2b27fcee2232f', NULL, NULL, NULL, 2, 1, 0, 3),
  (1, 'Test', '5000', 'Week', '2017-07-01', '2017-09-30', NULL, NULL, '0b85c9d8b43c1a6af73324d664066140', NULL, NULL, NULL, 2, 1, 0, 3),
  (1, 'RC Demo', '5000', 'Week', '2017-07-01', '2017-09-30', NULL, NULL, '226f6fff4c0b887ee7477870d4729ac9', NULL, NULL, NULL, 2, 1, 0, 3),
  (1, 'adsf', '1000', 'Week', '2017-06-26', '2017-06-26', NULL, NULL, 'fa25bd59362661ae8f54a5f2ad086f57', NULL, NULL, NULL, 2, 0, 0, 3),
  (1, 'Don\'s Demo', '5000', 'Week', '2017-07-01', '2017-09-30', NULL, NULL, '7137f34be9b93a04856053672a0053c6', NULL, NULL, NULL, 2, 0, 0, 3),
  (1, 'Eric Demo', '5000', 'Week', '2017-07-01', '2017-09-30', NULL, NULL, '969fd7534e54fe4d2fb69e0b6b0668bc', NULL, NULL, NULL, 2, 0, 0, 3),
  (1, 'RC\'s Boards', '750', 'Week', '2017-07-12', '2017-07-12', NULL, NULL, 'e4cb0afc1aca321962f24a8330efbd72', NULL, NULL, NULL, 2, 0, 0, 3),
  (1, '17 Jun - Signly', '500', 'Week', '2017-07-17', '2018-06-30', NULL, NULL, '3829f449faf255f3edce7401d85045b7', NULL, NULL, NULL, 16, 0, 0, 4),
  (1, 'Signly', '500', 'Week', '2017-07-18', '2017-07-18', NULL, NULL, 'c284575f12b04a0cc883ff6259dceb14', NULL, NULL, NULL, 16, 0, 0, 4),
  (7, 'demo felipe', '45000', 'Week', '2017-08-04', '2017-08-04', NULL, NULL, 'fbeb20baa82f627e2322a8b9f3e91f85', NULL, NULL, NULL, 16, 0, 0, 4);


INSERT INTO `active_proposal` (`proposal_id`, `created_at`, `updated_at`, `user_id`, `instance_id`) VALUES
  (1, '2016-02-29 09:17:12', '0000-00-00 00:00:00', 16, 4),
  (13, '2016-03-1 03:02:19', '0000-00-00 00:00:00', 9, 1),
  (19, '2017-02-06 18:17:13', '0000-00-00 00:00:00', 7, 2),
  (2, '2017-07-18 02:07:52', '0000-00-00 00:00:00', 16, 4),
  (20, '2017-08-04 22:30:30', '0000-00-00 00:00:00', 2, 3);

INSERT INTO `billboard` (`billboard_id`, `owner_id`, `name`, `description`, `address`, `city`, `state`, `zipcode`, `billboard_image_id`, `rate`, `digital_driveby`, `lat`, `lng`, `hard_cost`, `monthly_impressions`, `created_at`, `updated_at`, `deleted_at`, `instance_id`) VALUES
  ('', 4, 'Centerville (Parrish)', '', '960 N 950 W Centerville, UT 84014', '', '', '', 1, '0', '', '40.928862', '-111.89266900000001', '2150', '155300', NULL, NULL, NULL, 1),
  ('', 3, '3300 South 355 E', '', '3300 South 355 East, Salt Lake City, UT 84115', '', '', '', 1, '0', '', '40.69984970000001', '-111.8809402', '400', '155300', NULL, NULL, NULL, 1),
  ('', 3, '3900 SOUTH Street', '', '3900 South 500 West Salt Lake City, UT 84123', '', '', '', 1, '0', '', '40.6609843', '-111.91647790000002', '900', '52550', NULL, NULL, NULL, 1),
  ('', 3, 'I-1 5000', '', '4892 Commerce Dr Murray, UT 84107', '', '', '', 1, '0', '', '40.6649616', '-111.89993300000003', '3300', '309550', NULL, NULL, NULL, 1),
  ('', 3, 'Ft. Union', '', '6985 De Ville Dr E Cottonwood Heights, UT 84121', '', '', '', 1, '0', '', '40.6242375', '-111.83710050000002', '1500', '78225', NULL, NULL, NULL, 1),
  ('', 3, 'Lindon Digital', '', '426 N Frontage Rd Lindon, UT 84042', '', '', '', 1, '0', '', '40.34491', '-111.75858399999998', '2150', '240200', NULL, NULL, NULL, 1),
  ('', 3, 'I-1 Springville (North)', '', '1575-1699 E 4800 S St Springville, UT 84663', '', '', '', 1, '0', '', '40.1445662', '-111.64375010000003', '800', '67225', NULL, NULL, NULL, 1),
  ('', 3, 'I-1 Springville (South)', '', '792 E 4800 S Spanish Fork, UT 84660', '', '', '', 1, '0', '', '40.143697', '-111.63870199999997', '900', '67225', NULL, NULL, NULL, 1),
  ('', 3, 'I-1 4300 South', '', '4150 Commerce Dr Murray, UT 84107', '', '', '', 1, '0', '', '40.681435', '-111.90031299999998', '3350', '150000', NULL, NULL, NULL, 1),
  ('', 3, '3900 South Digital', '', '411-425 W 3900 S Salt Lake City, UT 84115', '', '', '', 1, '0', '', '40.6866964', '-111.90330169999999', '3000', '304027', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 513 West 24th', '', '513 WEST 24TH ST, Ogden, UT', '', '', '', 1, '0', '', '41.2229845', '-111.99024680000002', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 247 WEST 31ST', '', '247 WEST 31ST, Ogden, UT', '', '', '', 1, '0', '', '41.2082957', '-111.98227559999998', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 1775 WEST RIVERDALE RD', '', '1775 WEST RIVERDALE RD, Roy, UT', '', '', '', 1, '0', '', '41.168823', '-112.0232795', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 1484 NORTH MAIN ST', '', '1484 NORTH MAIN ST, Layton, UT', '', '', '', 1, '0', '', '41.0816443', '-111.99080079999999', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 1801 NORTH BECK ST', '', '1801 NORTH BECK ST, Salt Lake City, UT', '', '', '', 1, '0', '', '40.8062152', '-111.91793039999999', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 6022 SOUTH 1900 WEST', '', '6022 SOUTH 1900 WEST, Roy, UT', '', '', '', 1, '0', '', '41.154271', '-112.02560740000001', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 500 WEST 600 NORTH', '', '500 WEST 600 NORTH, Salt Lake City, UT', '', '', '', 1, '0', '', '40.7824108', '-111.9052206', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 3060 SOUTH REDWOOD RD', '', '3060 SOUTH REDWOOD RD, West Valley, UT', '', '', '', 1, '0', '', '40.7045586', '-111.9394752', '750', '1000000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 204 WEST 2100 SOUTH', '', '204 WEST 2100 SOUTH, Salt Lake City, UT', '', '', '', 1, '0', '', '40.7257561', '-111.89716470000002', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 150 EAST 3900 SOUTH', '', '150 EAST 3900 SOUTH, Millcreek, UT', '', '', '', 1, '0', '', '40.6870621', '-111.8867515', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 5051 SOUTH I-1', '', '5062 Commerce Dr, Murray, UT', '', '', '', 1, '0', '', '40.66164', '-111.90020900000002', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 4100 SOUTH 3900 WEST', '', '4100 SOUTH 3900 WEST, West Valley, UT', '', '', '', 1, '0', '', '40.6740205', '-111.98469239999997', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 7400 SOUTH 900 EAST', '', '7400 SOUTH 900 EAST, Midvale, UT', '', '', '', 1, '0', '', '40.6166251', '-111.86675550000001', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 8290 SOUTH STATE ST', '', '8290 SOUTH STATE ST, Sandy, UT', '', '', '', 1, '0', '', '40.6009319', '-111.89080509999997', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 4571 SOUTH 5600 WEST', '', '4571 SOUTH 5600 WEST, West Valley, UT', '', '', '', 1, '0', '', '40.6711436', '-112.02470340000002', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 59 WEST MAIN ST', '', '59 WEST MAIN ST, American Fork, UT', '', '', '', 1, '0', '', '40.3766001', '-111.80008759999998', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 495 NORTH GENEVA RD', '', '495 NORTH GENEVA RD, Lindon, UT', '', '', '', 1, '0', '', '40.3468362', '-111.74076809999997', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 300 NORTH I-1', '', '1301 400 North, Orem, UT', '', '', '', 1, '0', '', '40.30406259999999', '-111.72657859999998', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 1315 NORTH STATE ST', '', '1315 NORTH STATE ST, Provo, UT', '', '', '', 1, '0', '', '40.2516114', '-111.66885739999998', '750', '100000', NULL, NULL, NULL, 1),
  ('', 2, '30 Sheet - 1004 EAST 1860 SOUTH', '', '1004 EAST 1860 SOUTH, Ironton, UT', '', '', '', 1, '0', '', '40.200392', '-111.62620049999998', '750', '100000', NULL, NULL, NULL, 1),
  ('', 4, '59 WEST MAIN ST', '', '59 WEST MAIN ST, American Fork, UT', '', '', '', 1, '0', '', '40.3766001', '-111.80008759999998', '3500', '180000', NULL, NULL, NULL, 1),
  ('', 5, '6325 Newark Rd.', '', '6325 Newark Rd. Nashport, OH, 43830', '', '', '', 1, '0', '', '40.03128359999999', '-82.10630270000001', '375', '9280', NULL, NULL, NULL, 2),
  ('', 5, '16325 Millersburg Rd.', '', '16325 Millersburg Rd, Danville, OH 43014', '', '', '', 1, '0', '', '40.464829', '-82.206117', '200', '2060', NULL, NULL, NULL, 2),
  ('', 5, '10019 Jacksontown Rd', '', '10019 Jacksontown Rd, Thornville, OH 43076', '', '', '', 1, '0', '', '39.948191', '-82.40675999999996', '400', '9087', NULL, NULL, NULL, 2),
  ('', 5, '10019 Jacksontown Rd #2', '', '10019 Jacksontown Rd, Thornville, OH 43076', '', '', '', 1, '0', '', '39.948191', '-82.40675999999996', '300', '9087', NULL, NULL, NULL, 2),
  ('', 5, '2865 Millersburg Rd', '', '2865 Millersburg Rd, Martinsburg, OH 43037', '', '', '', 1, '0', '', '40.270478', '-82.35977300000002', '150', '3870', '2017-07-12 00:00:00', NULL, NULL, 2),
  ('', 5, '5420 Fallsburg Rd', '', '5420 Fallsburg Rd NE, Newark, OH 43055', '', '', '', 1, '0', '', '40.120396', '-82.34985389999997', '150', '4380', '2017-07-12 00:00:00', NULL, NULL, 2),
  ('', 5, '5357 OH-95', '', '5357 OH-95, Mt Gilead, OH 43338', '', '', '', 1, '0', '', '40.5236244', '-82.7538601', '125', '6380', '2017-07-13 00:00:00', NULL, NULL, 2),
  ('', 5, '7757 State RT 13', '', '7757 State RT 13 Bellville, OH 43338', '', '', '', 1, '0', '', '40.550818', '-82.53906699999999', '150', '4380', '2017-07-13 00:00:00', NULL, NULL, 2),
  ('', 5, '1330 Johnstown Utica Rd.', '', '1330 Johnstown Utica Rd. Utica, OH 43080', '', '', '', 1, '0', '', '40.22707279999999', '-82.52446270000002', '375', '9840', '2017-07-13 00:00:00', NULL, NULL, 2),
  ('', 5, '347 S Main St', '', '347 S Main St, Utica, OH 43080', '', '', '', 1, '0', '', '40.2286307', '-82.45208109999999', '375', '8150', '2017-07-13 00:00:00', NULL, NULL, 2);


INSERT INTO `billboard_faces` (`billboard_id`, `unique_id`, `height`, `width`, `reads`, `label`, `digital_driveby`, `sign_type`, `hard_cost`, `monthly_impressions`, `notes`, `max_ads`, `duration`, `photo`, `owner_id`, `instance_id`) VALUES
  (1, '1', 12, 40, 'right', 'NORTH', '', 0, 2150, 155300, 'I-1 CENTERVILLE NF RR', 0, 0, '8b1c1d45b5e7e51ba846899d047b020a.jpg', 4, 1),
  (2, '2', 12, 40, 'cross', 'SOUTH', '', 0, 2150, 155300, 'I-1 CENTERVILLE SF LR', 0, 0, '3cf55c54363bdcd4b98b7e16071baf9c.jpg', 3, 1),
  (3, '11', 12, 24, 'cross', 'WEST', '', 0, 400, 155300, '3300 S 355 E WF LR', 0, 0, '039ca2b69344659e669bca89781b22e1.jpg', 3, 1),
  (4, '12', 12, 24, 'right', 'EAST', '', 0, 400, 155300, '3300 S 355 E EF RR', 0, 0, '3f1ceaf151157175d230306ccd73b9a8.jpg', 3, 1),
  (5, '13', 12, 30, 'right', 'WEST', '', 0, 900, 52550, '3900 S 500 W WF RR', 0, 0, '57f7487b7b76aa116ebdcc9cec377997.jpg', 3, 1),
  (6, '1', 12, 24, 'cross', 'EAST', '', 0, 900, 52550, '3900 S 500 W EF LR', 0, 0, '6c39a2bf00f1d6b4c6c31b5a4b6616bf.jpg', 3, 1),
  (7, '16', 14, 48, 'right', 'NORTH', '', 0, 3300, 309550, 'I-1 5000 S NF RR', 0, 0, 'fd04e5e04fab8740b4e41ff6abce482a.jpg', 3, 1),
  (8, '1', 14, 48, 'cross', 'SOUTH', '', 0, 3300, 309550, 'I-1 5000 S SF LR', 0, 0, 'cc6730ed59b26e1f8249fba5c54db4a8.jpg', 3, 1),
  (9, '17', 14, 48, 'cross', 'EAST', '', 0, 1500, 78225, '1912 FT UNION EF LR', 0, 0, '591fed5ecfee2e20dceb52158ff42fe6.jpg', 3, 1),
  (10, '18', 14, 48, 'right', 'WEST', '', 0, 1500, 78225, '1912 FT UNION WF RR', 0, 0, '7fb35cd78345d02433dd47f862a2f80f.jpg', 3, 1),
  (11, '19', 14, 48, 'cross', 'NORTH', '', 1, 2150, 240200, 'I-1 Lindon (Digital) NF LR', 7, 8, '4c8fe74976c5f70d0d32cc229f4865fc.jpg', 2, 1),
  (12, '20', 14, 48, 'right', 'SOUTH', '', 1, 2150, 240200, 'I-1 Lindon (Digital) SF RR', 7, 8, '6c84c8fe2fcfb0bfb5b1c38ed36c0b33.jpg', 2, 1),
  (13, '21', 14, 48, 'cross', 'NORTH', '', 0, 800, 67225, 'I-1 N SPRINGVILLE NF LR', 0, 0, '280b525a64a4fdc655f4b600d7a66b73.jpg', 2, 1),
  (14, '22', 14, 48, 'right', 'SOUTH', '', 0, 800, 67225, 'I-1 N SPRINGVILLE SF RR', 0, 0, '5177a0ed77ec46d11fb7cfc975aa3eb5.jpg', 2, 1),
  (15, '23', 14, 48, 'cross', 'NORTH', '', 0, 900, 67225, 'I-1 N SPRINGVILLE NF LR', 0, 0, 'a62c49b37fd94cd945a293ce1d485408.jpg', 2, 1),
  (16, '24', 14, 48, 'right', 'SOUTH', '', 0, 900, 67225, 'I-1 N SPRINGVILLE SF RR', 0, 0, 'fe5f9494ba72bb7f1c4e4b8d8bb37dbb.jpg', 2, 1),
  (17, '37', 14, 48, 'cross', 'NORTH', '', 0, 3350, 150000, 'I-1 4300 S NF LR', 0, 0, 'a33c889cb5d7cb541b9be54452c72b88.jpg', 2, 1),
  (18, '39', 14, 48, 'cross', 'SOUTH', '', 1, 3000, 304027, 'I-1 3900 South (Digital) SF LR', 7, 8, '3fe2bc5fbe581ccf6a2396e2b0aef32f.jpg', 2, 1),
  (19, '69', 10, 20, 'right', 'EAST', '', 0, 750, 100000, '69', 0, 0, '2db92cce3f774b8b4d7595fe20155be6.jpeg', 2, 1),
  (20, '97', 10, 20, 'right', 'EAST', '', 0, 750, 100000, '97', 0, 0, '7723c06dc728b81102c3ddaac042f9b1.jpeg', 2, 1),
  (21, '115', 10, 20, 'right', 'WEST', '', 0, 750, 100000, '115', 0, 0, 'a6fbcf4ce7713e477c125d9383e077e3.jpg', 2, 1),
  (22, '279', 10, 20, 'right', 'SOUTH', '', 0, 750, 100000, '279', 0, 0, '5523842810ffa6597b47753c801a182b.jpg', 2, 1),
  (23, '00326A', 10, 20, 'right', 'NORTH', '', 0, 750, 100000, '00326A', 0, 0, '732e53a00cf337fb0cd31cdefb315333.jpg', 2, 1),
  (24, '285', 10, 20, 'right', 'SOUTH', '', 0, 750, 100000, '285', 0, 0, '86bb220b22a91a2ef0ee8199851c3c50.jpg', 2, 1),
  (25, '426', 10, 20, 'right', 'WEST', '', 0, 750, 100000, '426', 0, 0, '997a674b8d344bf6f9210b3116ae2da0.jpg', 2, 1),
  (26, '498', 10, 20, 'right', 'SOUTH', '', 0, 750, 1000000, '498', 0, 0, '3ddaec3c81c7f8fdf150bb7f36ee989e.jpg', 2, 1),
  (27, '547', 10, 20, 'right', 'EAST', '', 0, 750, 100000, '547', 0, 0, '97f834ceedb5d696379c61ecb20aae7d.jpg', 2, 1),
  (28, '676', 10, 20, 'right', 'WEST', '', 0, 750, 100000, '676', 0, 0, 'cec3d2c8d8d7c496f0f5936db0144c71.jpg', 2, 1),
  (29, '768', 10, 20, 'right', 'SOUTH', '', 0, 750, 100000, '768', 0, 0, '37df0be68b3b075b47ae84addec4f745.jpg', 2, 1),
  (30, '807', 10, 20, 'right', 'EAST', '', 0, 750, 100000, '807', 0, 0, '73dc2f11f5524721d235ae29c7cbec3b.jpg', 2, 1),
  (31, '914', 10, 20, 'right', 'NORTH', '', 0, 750, 100000, '914', 0, 0, 'bbc9393899d0c0ec6005309d309570e9.jpg', 4, 1),
  (32, '929', 10, 20, 'right', 'NORTH', '', 0, 750, 100000, '929', 0, 0, '9196d8045e9fa5e9b65f5aaead32e0ab.jpg', 5, 2),
  (33, '999', 10, 20, 'right', 'NORTH', '', 0, 750, 100000, '999', 0, 0, '18acc8f139577f8a7508fac9a0da02f0.jpg', 5, 2),
  (34, '1011', 10, 20, 'right', 'EAST', '', 0, 750, 100000, '1011', 0, 0, 'cbc51a58a1638b860d7c73ffb67fb0dd.jpg', 5, 2),
  (35, '1030', 10, 20, 'right', 'SOUTH', '', 0, 750, 100000, '1030', 0, 0, '59c2a45dcc4231d7e781877d65dc6c0a.jpg', 5, 2),
  (36, '1041', 10, 20, 'right', 'NORTH', '', 0, 750, 100000, '1041', 0, 0, '8d84039ba3cb57bffe4cb37ba5a3625f.jpg', 5, 2),
  (37, '1099', 10, 20, 'right', 'SOUTH', '', 0, 750, 100000, '1099', 0, 0, '836517606a23025c666fad553c622148.jpg', 5, 2),
  (38, '1166', 10, 20, 'right', 'WEST', '', 0, 750, 100000, '1166', 0, 0, '82c426689a22d67d9a82a1fa3d4864e8.jpg', 5, 2),
  (39, '1', 10, 30, 'right', 'NORTH', '', 0, 3500, 180000, 'On the frontage road.', 0, 0, 'd23ec2141bf516829205be1115c1ee1c.jpg', 5, 2),
  (40, '1', 11, 22, 'right', 'NORTH', '', 0, 375, 9280, '$350 1 year Contract\r\n$375 6 Months Or Less Contract', 0, 0, '65f819db7c3ef715b4e9b35fa3d4010c.png', 5, 2),
  (41, '1-South', 11, 22, 'cross', 'SOUTH', '', 0, 375, 9280, '$350 1 year Contract\r\n$375 6 Months Or Less Contract', 0, 0, '60ab84b01543e91180ee67cf5035b39a.jpg', 5, 2);


INSERT INTO `proposal_billboard` (`proposal_id`, `billboard_id`, `billboard_face_id`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `client_accepted`, `client_rejected`, `proposal_price`, `instance_id`) VALUES
  (1, 1, 1, '2017-08-23 09:59:25', '2017-08-23 09:59:25', '2017-08-23 09:59:25', 16, 1, 0, 20000, 4),
  (1, 2, 2, '2017-08-23 09:59:25', '2017-08-23 09:59:25', '2017-08-23 09:59:25', 16, 1, 0, 15000, 4),
  (3, 3, 3, '2017-08-23 09:59:25', '2017-08-23 09:59:25', '2017-08-23 09:59:25', 16, 1, 0, 30000, 4);


INSERT INTO `client_booking` (`billboard_id`, `billboard_face_id`, `vendor_id`, `client_id`, `proposal_id`, `description`, `book_start_date`, `book_end_date`, `set_price`, `billboard_type`, `updated_at`, `created_at`, `deleted_at`, `user_id`, `photo`, `instance_id`) VALUES
  (1, 1, NULL, NULL, NULL, 'This is a test.', '2016-03-01 12:00:00', '2016-05-31 12:00:00', NULL, NULL, '2016-03-01 12:00:00', '2016-03-01 12:00:00', NULL, 16, '', 4);


INSERT INTO `proposal_comments` (`user_id`, `proposal_id`, `client_id`, `message`, `message_from`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (16, 1, 4, 'Hello! this is a test.', 'client', '2017-08-23 10:11:07', '2017-08-23 10:11:07', '2017-08-25 10:11:23');

INSERT INTO `active_proposal_billboards` (`active_proposal_id`, `proposal_id`, `billboard_id`, `billboard_face_id`, `user_id`, `proposal_price`, `instance_id`) VALUES
  (1, 1, 1, 16, 2, 600, 4)

