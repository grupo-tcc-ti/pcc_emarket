use emarket;
INSERT INTO `emarket`.`usuarios` (`nome`, `email`, `senha`) VALUES ('admin', 'admin@gmail.com', SHA1('12345678Abcd@'));
INSERT INTO `emarket`.`admins` (`nome`, `senha`) VALUES ('admin', SHA1('1234')), ('Gabs', SHA1('1234'));