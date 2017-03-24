CREATE DATABASE `bi_test` CHARACTER SET utf8;
CREATE USER 'bi_test'@'localhost' IDENTIFIED BY '123456';
GRANT ALL PRIVILEGES ON `bi_test`.* TO 'bi_test'@'localhost';
flush privileges;
