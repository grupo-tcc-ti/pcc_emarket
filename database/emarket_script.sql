use `emarket`;
INSERT INTO `emarket`.`usuarios` (`nome`, `email`, `senha`, `user_type`, `codCliente`, `codAdmin`, `salario`, `admissao`, `demissao`, `telefone`, `cpf`,
`rg`, `cnpj`, `ie`, `cep`, `estado`, `cidade`, `endereco`, `numero`, `complemento`)
-- Admins --
VALUES
('admin', 'admin@email.com', md5('1234'), 'admin',
0, FLOOR(5 + RAND()*(100-1)), NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
-- Admins ends --

-- Clientes --
('cliente', 'cliente@email.com', md5('1234'), 'cliente',
-- FLOOR(5 + RAND()*(100-1)), 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
40, 0, NULL, NULL, NULL, 6198765432, 16829267706, 400551676, NULL, NULL, '72987654', 'DF', 'Monte das Oliveiras', 'Rua das Palmeiras - Lote 10', 7, 'Sem Complemento');

INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Processador AMD Ryzen 9 5900 3.7GHz (4.8GHz Turbo)', '', '2699', '../image/produtos/ryzen-5900.jpg');
INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Placa Mãe BioStar AMD AM4, mATX, DDR4, Chipset B550', '', '389', '../image/produtos/placa-mae-biostar-b550mh.webp');
INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Processador Intel Core i5 10400KF 2.90GHz (4.30GHz Turbo)', '', '1699', '../image/produtos/processador-intel-core-i5-10400f-.jpg');
INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Placa Mãe AsRock Intel LGA 1700, mATX, DDR4, Chipset H610', '', '679', '../image/produtos/placa-mae-asrock-h610m.jpg');
INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Processador AMD Ryzen 7 5800 3.4GHz (4.5GHz Turbo)', '', '2489', '../image/produtos/processador-amd-ryzen-7-5800x3djpg.jpg');
INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Placa Mãe MSI AMD AM4, mATX, DDR4, Chipset B550', '', '1099', '../image/produtos/placa-mae-msi-b550-.jpg');
INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Processador Intel Core i7 10700KF 3.80GHz (5.10GHz Turbo)', '', '2839', '../image/produtos/processador-intel-core-i7-10700k-3.jpg');
INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Placa Mãe Gigabyte AMD AM4, mATX, DDR4, Chipset A520M', '', '999', '../image/produtos/placa-mae-gigabyte-amd-a520m.webp');
INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Placa de Vídeo Gigabyte Geforce RTX 3080 VISION OC, LHR, 10GB, GDDR6X, DLSS, Ray Tracing', '', '7999', '../image/produtos/placa-de-video-gigabyte-geforce-rtx-3080-.webp');
INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Placa de Vídeo PowerColor Radeon RX 6600, LHR, 8GB, GDDR6, FSR, Ray Tracing', '', '1869', '../image/produtos/placa-de-video-powercolor-radeon-rx-6600-8gb-gddr6.jpg');
INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Placa de Vídeo MSI Geforce RTX 3060 GAMING OC, LHR, 12GB, GDDR6X, DLSS, Ray Tracing', '', '2399', '../image/produtos/placa-de-video-msi-geforce-rtx-3060-ventus.jpg');
INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Placa de Vídeo MSI Geforce GTX 1660 SUPER GAMING, LHR, 6GB, GDDR6, 192bit, 912V3V198Z', '', '1699', '../image/produtos/placa-de-video-msi-nvidia-geforce-gtx-1660-super.jpg');
INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Computador Gamer T-BRUXO / RTX 3060TI / I5 8600K / 16GB DDR4 / SSD 240GB', '', '6999', '../image/produtos/17-min.jpg');
INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Computador Gamer T-PRICE / RTX 3080 / I7 10700K / 24GB DDR4 / SSD 500GB', '', '13399', '../image/produtos/18-min.jpg');
INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Computador Gamer T-GIRL / GTX 1070 / I5 9600K / 8GB DDR4 / SSD 240GB', '', '4199', '../image/produtos/2-min.jpg');
INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Computador Gamer T-BASICO / GTX 1050 / I5 3470 / 8GB DDR3 / HD 500GB', '', '2199', '../image/produtos/8u-min.jpg');
INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `detalhes`, `preco`, `image`) VALUES (NULL, 'Cadeira Gamer Riotoro, Spitfire X1S Plus, RGB, Bluetooth, Alto Falantes, Reclin&aacute;vel, Black, GC-30X1SPLUS', 'As cadeiras de jogo de n&iacute;vel profissional SPITFIRE X1S PLUS s&atilde;o projetadas com ergonomia, complementadas por ilumina&ccedil;&atilde;o RGB PRISM controlada remotamente e alto-falantes Bluetooth. Extremamente f&aacute;cil de configurar e projetado para fornecer o m&aacute;ximo conforto para sess&otilde;es de jogo prolongadas ou uso di&aacute;rio. O SPITFIRE X1S inclui um mecanismo ajust&aacute;vel em altura, poltronas reclin&aacute;veis ​​laterais, apoios de bra&ccedil;os multidirecionais, almofadas remov&iacute;veis de apoio lombar e pesco&ccedil;o. Isso fornece o m&aacute;ximo op&ccedil;&otilde;es de personaliza&ccedil;&atilde;o para garantir que voc&ecirc; obtenha a posi&ccedil;&atilde;o de assento perfeita, experi&ecirc;ncia geral de jogo e o equil&iacute;brio perfeito entre o conforto de jogo desejado e o desempenho esperado durante as sess&otilde;es de jogo mais intensas.', NULL, '2441', '../image/produtos_teste/cadeira-gamer-riotoro-spitfire-x1s-plus-rgb-bluetooth-alto-falantes-reclinavel-black-gc-30x1splus_106602.jpg,../image/produtos_teste/cadeira-gamer-riotoro-spitfire-x1s-plus-rgb-bluetooth-alto-falantes-reclinavel-black-gc-30x1splus_106603.jpg,../image/produtos_teste/cadeira-gamer-riotoro-spitfire-x1s-plus-rgb-bluetooth-alto-falantes-reclinavel-black-gc-30x1splus_106604.jpg');
