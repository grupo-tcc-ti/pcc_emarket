use emarket;
-- INSERT INTO `emarket`.`usuarios` (`nome`, `email`, `senha`) VALUES ('admin', 'admin@gmail.com', md5('12345678Abcd@'));
-- IN SERT INTO `emarket`.`usuarios` (`nome`, `email`, `senha`) VALUES ('admin_teste', 'admin_teste@gmail.com', md5('12345678Abcd@'));
-- INSERT INTO `emarket`.`usuarios` (`nome`, `email`, `senha`) VALUES ('gabs', 'gabs@gmail.com', md5('12345678Abcd@'));
-- INSERT INTO `emarket`.`usuarios` (`nome`, `email`, `senha`) VALUES ('gabs_teste', 'gabs_teste@gmail.com', md5('12345678Abcd@'));

INSERT INTO `emarket`.`usuarios` (`nome`, `email`, `senha`, `user_type`, `codCliente`, `codAdmin`, `salario`, `admissao`, `demissao`, `telefone`, `cpf`,
`rg`, `cnpj`, `ie`, `cep`, `estado`, `cidade`, `logradouro`, `numero`, `complemento`)
-- '72987654', 'Rua das Palmeiras, Monte das Oliveiras, Lote 10, Casa 7, Sem Complemento'
-- Admins starts --
VALUES
('admin', 'admin@email.com', md5('1234'), 'admin',
0, FLOOR(5 + RAND()*(100-1)), NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Gabs', 'gabs@email.com', md5('1234'), 'admin',
0, FLOOR(5 + RAND()*(100-1)), NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('admin_teste', 'gabs@email.com', md5('1234'), 'admin',
0, FLOOR(5 + RAND()*(100-1)), NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
-- Admins ends --

-- Clientes starts --
('cliente', 'cliente@email.com', md5('1234'), 'cliente',
-- FLOOR(5 + RAND()*(100-1)), 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
40, 0, NULL, NULL, NULL, 6198765432, 16829267706, 400551676, NULL, NULL, '72987654', 'DF', 'Monte das Oliveiras', 'Rua das Palmeiras - Lote 10', 7, 'Sem Complemento'),
('cliente_gabs', 'cliente_gabs@email.com', md5('1234'), 'cliente',
86, 0, NULL, NULL, NULL, 6198765432, 16829267706, 400551676, NULL, NULL, '72987654', 'DF', 'Monte das Oliveiras', 'Rua das Palmeiras - Lote 10', 7, 'Sem Complemento'),
('cliente_teste', 'cliente_teste@email.com', md5('1234'), 'cliente',
7, 0, NULL, NULL, NULL, 6198765432, 16829267706, 400551676, NULL, NULL, '72987654', 'DF', 'Monte das Oliveiras', 'Rua das Palmeiras - Lote 10', 7, 'Sem Complemento');
-- Clientes ends --

-- INSERT INTO `emarket`.`usuarios` (`nome`, `email`, `senha`, `user_type`, `codCliente`, `codAdmin`, `salario`, `admissao`, `demissao`, `telefone`, `cpf`,
-- `rg`, `cnpj`, `ie`, `cep`, `estado`, `cidade`, `logradouro`, `numero`, `complemento`)
-- values ('cliente_teste', 'cliente_teste@email.com', md5('1234'), 'cliente',
-- 7, 0, NULL, NULL, NULL, 6198765432, NULL, NULL, NULL, NULL, '72987654', 'DF', 'Monte das Oliveiras', 'Rua das Palmeiras - Lote 10', 7, 'Sem Complemento');

-- INSERT INTO `emarket`.`produtos` (`codProduto` , `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'LG NanoCell 75 Series 43 polegadas Alexa Smart TV 4K integrada (3840 x 2160), taxa de atualiza&ccedil;&atilde;o 60Hz, Ultra HD 4K, Active HDR, HDR10, HLG (43NANO75UPA, 2021)', ' \r\n Visor nano 4k de verdade: d&ecirc; vida aos seus programas favoritos com NanoCell vibrante. Veja a imagem natural e realista com Nano Color aprimorada por um bilh&atilde;o de cores ricas. Dimens&otilde;es da TV sem suporte (L x A x P)-96,8 x 56,3 x 5,8 cm\r\n Processador Quad Core 4K: Nosso processador Quad Core 4K oferece uma experi&ecirc;ncia de visualiza&ccedil;&atilde;o suave e n&iacute;tida com maior contraste, cor e preto. Fonte de alimenta&ccedil;&atilde;o (tens&atilde;o, Hz): CA 100~240V 50-60Hz, consumo de energia: 55W\r\n Experi&ecirc;ncia em cinema dom&eacute;stico: veja e sinta que voc&ecirc; est&aacute; em a&ccedil;&atilde;o com Active HDR. Veja os filmes exatamente como os diretores pretendem com o Modo Filmmaker. E com acesso integrado aos canais Netflix, Prime Video, Apple TV Plus, Disney Plus e LG, seu conte&uacute;do favorito est&aacute; ao seu alcance.\r\n Melhor jogo: experimente jogos em NanoCell. O Game Optimizer d&aacute; a voc&ecirc; acesso mais f&aacute;cil a todas as suas configura&ccedil;&otilde;es de jogo e voc&ecirc; ter&aacute; o modo autom&aacute;tico de baixa lat&ecirc;ncia mais HGiG para uma imagem detalhada do jogo.\r\n Auxiliar do Google e Alex embutido: n&atilde;o h&aacute; necessidade de um dispositivo extra &ndash; basta pedir m&uacute;sica, clima, not&iacute;cias, sua lista de compras da Amazon e muito mais. Al&eacute;m disso, controle convenientemente sua casa conectada e dispositivos inteligentes.\r\n ', '499', '../image/produtos_teste/smarttv1.jpg,../image/produtos_teste/smarttv2.jpg,../image/produtos_teste/smarttv3.jpg,../image/produtos_teste/smarttv4.jpg,../image/produtos_teste/smarttv5.jpg,../image/produtos_teste/smarttv6.jpg,../image/produtos_teste/smarttv7.jpg');
-- INSERT INTO `emarket`.`produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'SAMSUNG Smartwatch Galaxy Watch 4 40 mm com monitor ECG para sa&uacute;de, fitness, corrida, ciclos de sono, detec&ccedil;&atilde;o de quedas GPS, Bluetooth, vers&atilde;o dos EUA, SM-R860NZDAXAA, our', ' Prepare-se para esmagar seus objetivos de bem-estar com leituras corporais diretamente no seu pulso\r\nMelhor sono come&ccedil;a aqui: Acorde com sensa&ccedil;&atilde;o de atualiza&ccedil;&atilde;o e recarregado com rastreamento avan&ccedil;ado de sono; Quando voc&ecirc; for para a cama, seu rastreador de sono Galaxy Watch4 come&ccedil;a a monitorar seu sono e falar 2 n&iacute;veis continuamente\r\nSeja inteligente sobre o seu cora&ccedil;&atilde;o: Cuide do seu cora&ccedil;&atilde;o com um monitoramento preciso por ECG e fique de olho na poss&iacute;vel fibrila&ccedil;&atilde;o atrial, uma forma comum de ritmo card&iacute;aco irregular; compartilhe leituras personalizadas com seu m&eacute;dico usando o aplicativo Samsung Health Monitor em seu telefone Galaxy compat&iacute;vel\r\nFa&ccedil;a todas as combina&ccedil;&otilde;es de treino: aproveite ao m&aacute;ximo cada sess&atilde;o de exerc&iacute;cios com rastreamento avan&ccedil;ado de treino que reconhece 6 atividades populares, de corrida a remo e nata&ccedil;&atilde;o, automaticamente em apenas 3 minutos; mantenha-se motivado conectando-se a sess&otilde;es de treinamento ao vivo por meio de seu smartphone ou a desafios de grupo din&acirc;mico com seus amigos ', '114', '../image/produtos_teste/smartwatch1.jpg,../image/produtos_teste/smartwatch2.jpg,../image/produtos_teste/smartwatch3.jpg,../image/produtos_teste/smartwatch4.jpg,../image/produtos_teste/smartwatch5.jpg,../image/produtos_teste/smartwatch6.jpg,../image/produtos_teste/smartwatch7.jpg,../image/produtos_teste/smartwatch8.jpg');

INSERT INTO `emarket`.pedidos 
(`codPedido`, `tipoEntrega`, `totalProduto`, `totalPreco`, `dataEnvio`, `dataEntrega`, `statusPagamento`, `fk_usuarios_codUsuario`, `fk_usuarios_codCliente`) 
VALUES 
(NULL, 'Correríos', 'tv (1) - smartphone (1) - smartwatch (2)', '5123.45', '2022-10-21', NULL, 'Pago', 4, 40),
(NULL, 'Correríos', 'tv (1) - smartphone (1) - smartwatch (2)', '5123.45', '2022-10-21', NULL, 'Pendente', 5, 86),
(NULL, 'Correríos', 'tv (1) - smartphone (1) - smartwatch (2)', '5123.45', '2022-10-21', NULL, 'Cancelado', 6, 7);

INSERT INTO `produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Processador AMD Ryzen 9 5900 3.7GHz (4.8GHz Turbo)', '', '2.699', '../image/produtos/ryzen-5900.jpg');
INSERT INTO `produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Placa Mãe BioStar AMD AM4, mATX, DDR4, Chipset B550', '', '389', '../image/produtos/placa-mae-biostar-b550mh.webp');
INSERT INTO `produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Processador Intel Core i5 10400KF 2.90GHz (4.30GHz Turbo)', '', '1.699', '../image/produtos/processador-intel-core-i5-10400f-.jpg');
INSERT INTO `produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Placa Mãe AsRock Intel LGA 1700, mATX, DDR4, Chipset H610', '', '679', '../image/produtos/placa-mae-asrock-h610m.jpg');
INSERT INTO `produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Processador AMD Ryzen 7 5800 3.4GHz (4.5GHz Turbo)', '', '2.489', '../image/produtos/processador-amd-ryzen-7-5800x3djpg.jpg');
INSERT INTO `produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Placa Mãe MSI AMD AM4, mATX, DDR4, Chipset B550', '', '1.099', '../image/produtos/placa-mae-msi-b550-.jpg');
INSERT INTO `produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Processador Intel Core i7 10700KF 3.80GHz (5.10GHz Turbo)', '', '2.839', '../image/produtos/processador-intel-core-i7-10700k-3.jpg');
INSERT INTO `produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Placa Mãe Gigabyte AMD AM4, mATX, DDR4, Chipset A520M', '', '999', '../image/produtos/placa-mae-gigabyte-amd-a520m.webp');
INSERT INTO `produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Placa de Vídeo Gigabyte Geforce RTX 3080 VISION OC, LHR, 10GB, GDDR6X, DLSS, Ray Tracing', '', '7.999', '../image/produtos/placa-de-video-gigabyte-geforce-rtx-3080-.webp');
INSERT INTO `produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Placa de Vídeo PowerColor Radeon RX 6600, LHR, 8GB, GDDR6, FSR, Ray Tracing', '', '1.869', '../image/produtos/placa-de-video-powercolor-radeon-rx-6600-8gb-gddr6.jpg');
INSERT INTO `produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Placa de Vídeo MSI Geforce RTX 3060 GAMING OC, LHR, 12GB, GDDR6X, DLSS, Ray Tracing', '', '2.399', '../image/produtos/placa-de-video-msi-geforce-rtx-3060-ventus.jpg');
INSERT INTO `produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Placa de Vídeo MSI Geforce GTX 1660 SUPER GAMING, LHR, 6GB, GDDR6, 192bit, 912V3V198Z', '', '1.699', '../image/produtos/placa-de-video-msi-nvidia-geforce-gtx-1660-super.jpg');
INSERT INTO `produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Computador Gamer T-BRUXO / RTX 3060TI / I5 8600K / 16GB DDR4 / SSD 240GB', '', '6.999', '../image/produtos/17-min.jpg');
INSERT INTO `produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Computador Gamer T-PRICE / RTX 3080 / I7 10700K / 24GB DDR4 / SSD 500GB', '', '13.399', '../image/produtos/18-min.jpg');
INSERT INTO `produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Computador Gamer T-GIRL / GTX 1070 / I5 9600K / 8GB DDR4 / SSD 240GB', '', '4.199', '../image/produtos/2-min.jpg');
INSERT INTO `produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`) VALUES (NULL, 'Computador Gamer T-BASICO / GTX 1050 / I5 3470 / 8GB DDR3 / HD 500GB', '', '2.199', '../image/produtos/8u-min.jpg');

-- INSERT INTO `produtos` (`codProduto`, `nome`, `descricao`, `preco`, `image`)
-- VALUES 
-- (NULL, 'Pc Gamer Jilsu / AMD 3000G / 8GB DDR4 / GeForce GT 1030 / SSD 240GB ', 'Super m&aacute;quina criada em colabora&ccedil;&atilde;o do nosso parceiro &quot;Lucas Ziemlich&quot;, vai rodar seus jogos tranquilamente, Fortnite, Minecraft, CS:GO, Dota 2, LoL, GTA RP, entre outros! O Computador Gamer Jilsu se encaixa perfeitamente para voc&ecirc; que est&aacute; come&ccedil;ando a entrar nesse mundo gamer. Voc&ecirc; tamb&eacute;m que quer se tornar um youtuber esse computador vai atender todas as suas necessidades iniciais. &Eacute; comprar esperar chegar, ligar na tomada e sair jogando sem problemas. Qualquer duvida n&atilde;o deixe de nos procurar. Precisa de acess&oacute;rios e perif&eacute;ricos ou quer adiciona mais mem&oacute;ria, SSD ou cooler? confira nossa pagina de PE&Ccedil;AS E ACESS&Oacute;RIOS e escolha o que voc&ecirc; preferir!\r\n\r\nAcompanha: Cabo de for&ccedil;a, caixas, manuais e acess&oacute;rios das pe&ccedil;as utilizadas na montagem.\r\n\r\nTodas as m&aacute;quinas v&atilde;o com Windows 10 Home (TRIAL). Ap&oacute;s o per&iacute;odo de TRIAL aparecer&aacute; uma notifica&ccedil;&atilde;o de ativa&ccedil;&atilde;o, voc&ecirc; poder&aacute; continuar utilizando o seu Pc normalmente. Para adquirir uma licen&ccedil;a basta acessar o site da Microsoft ou revendedores autorizados.\r\n\r\nGarantia total: S&atilde;o 12 meses (contra defeitos de fabrica&ccedil;&atilde;o), 3 meses referentes &agrave; garantia legal, seguindo os termos do artigo 26, II, do C&oacute;digo de Defesa do Consumidor + 9 meses de garantia fornecida pelo fabricante.\r\n', '2568.43', '../image/produtos_teste/4-min.jpg'),
-- (NULL, 'Pc Gamer Ice / Ryzen 5 5600G / 8GB DDR4 / SSD 240GB ', 'Acompanha: Cabo de for&ccedil;a, caixas, manuais e acess&oacute;rios das pe&ccedil;as utilizadas na montagem.\r\n\r\nTodas as m&aacute;quinas v&atilde;o com Windows 10 (TRIAL) Instalado. Ap&oacute;s o per&iacute;odo de TRIAL aparecer&aacute; uma notifica&ccedil;&atilde;o de ativa&ccedil;&atilde;o, mas voc&ecirc; poder&aacute; continuar utilizando. Para adquirir uma licen&ccedil;a basta acessar o site da Microsoft ou revendedores autorizados.\r\n\r\nGarantia total: 12 meses (contra defeitos de fabrica&ccedil;&atilde;o), 3 meses referentes &agrave; garantia legal, nos termos do artigo 26, II, do C&oacute;digo de Defesa do Consumidor + 9 meses de garantia do fabricante.\r\n\r\nImagens do produto s&atilde;o meramente ilustrativas.\r\nEspecifica&ccedil;&otilde;es t&eacute;cnicas sujeito &agrave; altera&ccedil;&otilde;es sem aviso pr&eacute;vio.\r\nIMPORTANTE: De acordo Art. 754 C&oacute;digo Civil, no ato da entrega, confira o(s) produto(s) e no caso de avarias no transporte, registre a ocorr&ecirc;ncia no documento de entrega; reclama&ccedil;&otilde;es posteriores n&atilde;o ser&atilde;o aceitas.', '2661.23', '../image/produtos_teste/5-min.jpg'),
-- (NULL, 'Pc Gamer o Loko / I3 10100F / 8GB DDR4 / GeForce GT 1030 / SSD 240GB', 'Qualquer duvida n&atilde;o deixe de nos procurar. Precisa de acess&oacute;rios e perif&eacute;ricos ou quer adiciona mais mem&oacute;ria, SSD ou cooler? confira nossa pagina de PE&Ccedil;AS E ACESS&Oacute;RIOS e escolha o que voc&ecirc; preferir!\r\n\r\nAcompanha: Cabo de for&ccedil;a, caixas, manuais e acess&oacute;rios das pe&ccedil;as utilizadas na montagem.\r\n\r\nTodas as m&aacute;quinas v&atilde;o com Windows 10 (TRIAL) Instalado. Ap&oacute;s o per&iacute;odo de TRIAL aparecer&aacute; uma notifica&ccedil;&atilde;o de ativa&ccedil;&atilde;o, mas voc&ecirc; poder&aacute; continuar utilizando. Para adquirir uma licen&ccedil;a basta acessar o site da Microsoft ou revendedores autorizados.\r\n\r\nGarantia total: 12 meses (contra defeitos de fabrica&ccedil;&atilde;o), 3 meses referentes &agrave; garantia legal, nos termos do artigo 26, II, do C&oacute;digo de Defesa do Consumidor + 9 meses de garantia do fabricante.\r\n\r\nImagens do produto s&atilde;o meramente ilustrativas.\r\nEspecifica&ccedil;&otilde;es t&eacute;cnicas sujeito &agrave; altera&ccedil;&otilde;es sem aviso pr&eacute;vio.\r\nIMPORTANTE: De acordo Art. 754 C&oacute;digo Civil, no ato da entrega, confira o(s) produto(s) e no caso de avarias no transporte, registre a ocorr&ecirc;ncia no documento de entrega; reclama&ccedil;&otilde;es posteriores n&atilde;o ser&atilde;o aceitas.', '3008.65', '../image/produtos_teste/6-min.jpg'),
-- (NULL, 'Pc Gamer Caju Completo / Intel I3 10100F / RX 550 4GB / 8GB DDR4 / SSD 240GB / Monitor 19 LED / Teclado e Mouse / Headset', 'Super m&aacute;quina criada com a colabora&ccedil;&atilde;o da nossa Parceira Caju , ira rodar seus jogos tranquilamente, Heartstone, Minecraft, CS:GO, Dota 2, LoL, GTA V, entre outros! O Computador GAMER Caju se encaixa perfeitamente para voc&ecirc; que est&aacute; come&ccedil;ando a entrar nesse mundo gamer. Voc&ecirc; tamb&eacute;m que quer se tornar um youtuber esse computador vai atender todas as suas necessidades iniciais. &Eacute; comprar esperar chegar, ligar na tomada e sair jogando sem problemas.\r\n\r\nAcompanha: Cabo de for&ccedil;a, caixas, manuais e acess&oacute;rios das pe&ccedil;as utilizadas na montagem.\r\n\r\nTodas as m&aacute;quinas v&atilde;o com Windows 10 (TRIAL) Instalado. Ap&oacute;s o per&iacute;odo de TRIAL aparecer&aacute; uma notifica&ccedil;&atilde;o de ativa&ccedil;&atilde;o, mas voc&ecirc; poder&aacute; continuar utilizando. Para adquirir uma licen&ccedil;a basta acessar o site da Microsoft ou revendedores autorizados.\r\n\r\nGarantia total: 12 meses (contra defeitos de fabrica&ccedil;&atilde;o), 3 meses referentes &agrave; garantia legal, nos termos do artigo 26, II, do C&oacute;digo de Defesa do Consumidor + 9 meses de garantia do fabricante.\r\n\r\nImagens do produto s&atilde;o meramente ilustrativas.\r\nEspecifica&ccedil;&otilde;es t&eacute;cnicas sujeito &agrave; altera&ccedil;&otilde;es sem aviso pr&eacute;vio.\r\nIMPORTANTE: De acordo Art. 754 C&oacute;digo Civil, no ato da entrega, confira o(s) produto(s) e no caso de avarias no transporte, registre a ocor', '4055.01', '../image/produtos_teste/kit-completo-caju_640x640+fill_ffffff.jpg'),
-- (NULL, 'Pc Gamer Rose / AMD 3000G / 8GB DDR4 / SSD 240GB ', 'O Computador Rose se encaixa perfeitamente para voc&ecirc; que est&aacute; procurando uma maquina para trabalho e entretenimento com um custo baixo. Ideal para jogos mais leves como Minecraft, Roblox, Free Fire(Bluestacks), LOL, The sims, Valorant, CS:GO entre outros... &Eacute; comprar, esperar e ligar na tomada e sair usando sem problemas. Precisa de acess&oacute;rios ou perif&eacute;ricos? confira nossa pagina de PE&Ccedil;AS E ACESS&Oacute;RIOS e escolha o que voc&ecirc; preferir! Gostou da configura&ccedil;&atilde;o mas quer trocar o modelo do gabinete? Quer acrescentar mais mem&oacute;ria ou adicionar uma placa de v&iacute;deo? Acesse o MONTE SEU PC e use essa configura&ccedil;&atilde;o de base e altere o que voc&ecirc; desejar.\r\n\r\nAcompanha: Cabo de for&ccedil;a, caixas, manuais e acess&oacute;rios das pe&ccedil;as utilizadas na montagem.\r\n\r\nTodas as m&aacute;quinas v&atilde;o com Windows 10 Home (TRIAL) instalado. Ap&oacute;s o per&iacute;odo de TRIAL aparecer&aacute; uma notifica&ccedil;&atilde;o de ativa&ccedil;&atilde;o, mas voc&ecirc; poder&aacute; continuar utilizando. Para adquirir uma licen&ccedil;a basta acessar o site da Microsoft ou revendedores autorizados.\r\n\r\nGarantia total: S&atilde;o 12 meses (contra defeitos de fabrica&ccedil;&atilde;o), 3 meses referentes &agrave; garantia legal, seguindo os termos do artigo 26, II, do C&oacute;digo de Defesa do Consumidor + 9 meses de garantia fornecida pelo fabricante.', '1869.26', '../image/produtos_teste/2-min.jpg'),
-- (NULL, ' Pc Gamer Caju / I3 10100F / RX 550 4GB / 8GB DDR4 / SSD 240GB ', 'Super m&aacute;quina criada com a colabora&ccedil;&atilde;o da nossa Parceira CAJU, ira rodar seus jogos tranquilamente, Minecraft, The sims 4, Dota 2, LoL, entre outros! O Computador GAMER CAJU se encaixa perfeitamente para voc&ecirc; que est&aacute; come&ccedil;ando a entrar nesse mundo gamer. Voc&ecirc; tamb&eacute;m que quer se tornar um youtuber esse computador vai atender todas as suas necessidades iniciais. &Eacute; comprar esperar chegar, ligar na tomada e sair jogando sem problemas. Qualquer duvida n&atilde;o deixe de nos procurar. Precisa de acess&oacute;rios e perif&eacute;ricos ou quer adicionar mais mem&oacute;ria, SSD ou cooler? confira nossa pagina de PE&Ccedil;AS E ACESS&Oacute;RIOS e escolha o que voc&ecirc; preferir! Gostou da configura&ccedil;&atilde;o mas quer trocar o modelo do gabinete? Quer mudar a placa de v&iacute;deo? Acesse o MONTE SEU PC e use essa configura&ccedil;&atilde;o de base e altere o que voc&ecirc; desejar.\r\n\r\nAcompanha: Cabo de for&ccedil;a, caixas, manuais e acess&oacute;rios das pe&ccedil;as utilizadas na montagem.\r\n\r\nTodas as m&aacute;quinas v&atilde;o com Windows 10 (TRIAL) Instalado. Ap&oacute;s o per&iacute;odo de TRIAL aparecer&aacute; uma notifica&ccedil;&atilde;o de ativa&ccedil;&atilde;o, mas voc&ecirc; poder&aacute; continuar utilizando. Para adquirir uma licen&ccedil;a basta acessar o site da Microsoft ou revendedores autorizados.\r\n\r\nGarantia total: 12 meses (contra defeitos de fabrica&ccedil;&atilde;o), 3 meses referentes &a', '3167.43', '../image/produtos_teste/7-min.jpg'),
-- (NULL, 'Pc Gamer FREE FIRE / AMD 3000G / 8GB DDR4 / SSD 120GB ', 'Pc Gamer pronto para voc&ecirc; jogar Free Fire com toda qualidade que precisa por um super pre&ccedil;o! \r\n\r\nAcompanha: Cabo de for&ccedil;a, caixas, manuais e acess&oacute;rios das pe&ccedil;as utilizadas na montagem.\r\n\r\nTodas as m&aacute;quinas v&atilde;o com Windows 10 (TRIAL) Instalado. Ap&oacute;s o per&iacute;odo de TRIAL aparecer&aacute; uma notifica&ccedil;&atilde;o de ativa&ccedil;&atilde;o, mas voc&ecirc; poder&aacute; continuar utilizando. Para adquirir uma licen&ccedil;a basta acessar o site da Microsoft ou revendedores autorizados.\r\n\r\nGarantia total: 12 meses (contra defeitos de fabrica&ccedil;&atilde;o), 3 meses referentes &agrave; garantia legal, nos termos do artigo 26, II, do C&oacute;digo de Defesa do Consumidor + 9 meses de garantia do fabricante.\r\n\r\nImagens do produto s&atilde;o meramente ilustrativas.\r\nEspecifica&ccedil;&otilde;es t&eacute;cnicas sujeito &agrave; altera&ccedil;&otilde;es sem aviso pr&eacute;vio.\r\nIMPORTANTE: De acordo Art. 754 C&oacute;digo Civil, no ato da entrega, confira o(s) produto(s) e no caso de avarias no transporte, registre a ocorr&ecirc;ncia no documento de entrega; reclama&ccedil;&otilde;es posteriores n&atilde;o ser&atilde;o aceitas.', '1779.22', '../image/produtos_teste/rbaobmjmdu5acbnnandmsv2lasaogdjeyl3x_640x640+fill_ffffff.webp');



