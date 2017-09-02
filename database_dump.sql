CREATE DATABASE mvc;

USE mvc;

CREATE TABLE `user` (
    `id` int NOT NULL AUTO_INCREMENT,
    `username` varchar(40) UNIQUE NOT NULL,
    `password` varchar(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (ID)
);

INSERT INTO `user` 
(`id`, `username`, `password`)
VALUES
(1, 'jack', 'admin'),
(2, 'jane', 'admin'),
(3, 'uros', 'admin');

UPDATE `user`
SET `username` = 'john'
WHERE `id` = 1;