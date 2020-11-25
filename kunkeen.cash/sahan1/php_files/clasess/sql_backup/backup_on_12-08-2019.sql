

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `total_cash_in` double NOT NULL,
  `total_cash_out` double NOT NULL,
  `current_ksh_balance` double NOT NULL,
  `total_dollar_in` double NOT NULL,
  `total_dollar_out` double NOT NULL,
  `current_dollar_balance` double NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `delete_status` double NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;


INSERT INTO customers VALUES
("20","100","1000","-900","600","800","-200","Name 100","076655555566","0"),
("21","900000","0","900000","0","0","0","name 100","","0");




CREATE TABLE `open_cash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount_ksh` double NOT NULL,
  `amount_dollar` double NOT NULL,
  `ksh_rate` double NOT NULL,
  `dollar_rate` double NOT NULL,
  `delete_status` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


INSERT INTO open_cash VALUES
("3","-900","-200","0","0","0","2019-08-09"),
("4","40000","2000","0","103","0","2019-08-10"),
("5","145000","0","0","103","0","2019-08-11");




CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pw_last_changed` date NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company_reg_session_id` varchar(200) NOT NULL,
  `current_lang` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO settings VALUES
("0","ahsa","test","d886ab1df2a26b2f97350f0e3ad0206a1546/>][7987^^&)51","2019-08-11","","05555555","test@email.com","","en");




CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `cash_in` double NOT NULL,
  `cash_out` double NOT NULL,
  `cash_balance` double NOT NULL,
  `dollar_in` double NOT NULL,
  `dollar_out` double NOT NULL,
  `dollar_balance` double NOT NULL,
  `date` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `delete_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;


INSERT INTO transactions VALUES
("43","20","100","1000","-900","600","800","-200","2019-08-10","Hfhjhjjnn test","0"),
("44","21","900000","0","900000","0","0","0","2019-08-11","","0");


