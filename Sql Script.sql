CREATE DATABASE `tvs_task`;
USE `tvs_task`;

CREATE TABLE `accounts` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(75) NOT NULL,
  PRIMARY KEY (`userid`)
);

INSERT INTO `accounts` (`userid`, `username`, `password`) VALUES ('1', 'admin', '$2a$12$WbjgeY171YseuMer.vd95.4RiRt4wnCdrDggGcsZ/jzSltEtpHRKq'); -- Username: admin; Password 123245678

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `mobile` varchar(16) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `date_time` DATETIME DEFAULT NULL,
  `profile_img` varchar(2000) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DELIMITER $$
CREATE PROCEDURE `add_customer`(
IN custname varchar(45),
IN mobile varchar(16),
IN email varchar(255),
IN citem varchar(255),
IN cval varchar(255),
IN cdate_time varchar(45),
IN profilepath varchar(2000)
)
BEGIN
INSERT INTO `customers` (
`name`, 
`mobile`, 
`email`, 
`item`, 
`value`, 
`date_time`,
`profile_img`
)
 VALUES 
 ( 
 custname,
 mobile, 
 email, 
 citem, 
 cval, 
 cdate_time,
 profilepath);
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `delete_customer`(in customerid int)
BEGIN
	update customers set is_deleted = '1' where customer_id = customerid;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `undo_delete_customer`(in customerid int)
BEGIN
	update customers set is_deleted = '0' where customer_id = customerid;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `delete_customer_img`(in customerid int)
BEGIN
	update customers set profile_img = 'null' where customer_id = customerid;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `get_count_filtered_customers`(in search varchar(45))
BEGIN
SELECT count(customer_id) as filteredcount FROM customers  where is_deleted <> 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `get_customer_by_customerid`(IN customerid int)
BEGIN
SELECT * FROM customers
    where customer_id = customerid and is_deleted <> 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `get_customers`(in search varchar(45), in startlimit int, in endlimit int)
BEGIN
	SELECT * FROM customers where is_deleted <> 1
    order by customer_id limit startlimit, endlimit;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `get_total_customers`()
BEGIN
	select count(customer_id) as total from customers  where is_deleted <> 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `get_user_account_by_username`(IN username varchar(45))
BEGIN
	select * from accounts where username = username;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `update_customer`(IN customerid int,
IN customername varchar(45),
IN mobile varchar(16),
IN email varchar(255),
IN citem varchar(255),
IN cval varchar(255),
IN cdate_time varchar(255),
IN profilepath varchar(2000)
)
BEGIN
update `customers` 
set
`name` = customername, 
`mobile` = mobile, 
`email` = email, 
`item` = citem, 
`value` = cval,
`date_time` = cdate_time

  where customer_id = customerid;

if profilepath <> 'null' then 
	update `customers` set
`profile_img` = profilepath
  where customer_id = customerid;

 end if;

END$$
DELIMITER ;

