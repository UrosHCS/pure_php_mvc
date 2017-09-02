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
(1, 'jack', '$2y$10$hB4gQjraxuSK3d30w4/C.eISESig81vvUF6BzA4fdiL.ScGa6qtXG'),
(2, 'jane', '$2y$10$hB4gQjraxuSK3d30w4/C.eISESig81vvUF6BzA4fdiL.ScGa6qtXG'),
(3, 'uros', '$2y$10$hB4gQjraxuSK3d30w4/C.eISESig81vvUF6BzA4fdiL.ScGa6qtXG');

UPDATE `user`
SET `username` = 'john'
WHERE `id` = 1;