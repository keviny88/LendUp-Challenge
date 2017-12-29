-- Kevin Yin
-- LendUp Challenge

CREATE DATABASE IF NOT EXISTS `fizzbuzz`;
USE `fizzbuzz`;
DROP TABLE calls;

-- Table for Calls
CREATE TABLE `calls` (
	id INTEGER not null auto_increment,
    phone varchar(25) not null,
    call_date datetime,
    fizz_num integer,
    hours INTEGER, 
    minutes INTEGER,
    seconds INTEGER,
    PRIMARY KEY(id)
);
    


