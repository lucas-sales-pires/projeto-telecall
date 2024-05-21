CREATE TABLE `2fa_perguntas` (
  `pergunta_id` int(11) NOT NULL AUTO_INCREMENT,
  `pergunta` varchar(255) NOT NULL,
  PRIMARY KEY (`pergunta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO 2fa_perguntas VALUES ('1', 'Qual o nome da sua mae ?');
INSERT INTO 2fa_perguntas VALUES ('2', 'Qual seu email ?');
INSERT INTO 2fa_perguntas VALUES ('3', 'Qual sua data de nascimento ?');
INSERT INTO 2fa_perguntas VALUES ('4', 'Qual seu CEP ?');
CREATE TABLE `log_acesso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpf_usuario` varchar(11) DEFAULT NULL,
  `horario_login` time DEFAULT NULL,
  `data_login` date DEFAULT NULL,
  `resultado` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `usuarios_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarios_id` (`usuarios_id`),
  CONSTRAINT `log_acesso_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`usuarios_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO log_acesso VALUES ('4', '17032184774', '05:36:53', '2023-10-25', 'Sucesso', 'Logado com Sucesso Respondendo corretamente: Qual seu email ?', '18');
INSERT INTO log_acesso VALUES ('5', '17032184774', '05:40:42', '2023-10-25', 'Falha', 'Não Logado Respondeu incorretamente: Qual o nome da sua mae ?', '18');
INSERT INTO log_acesso VALUES ('6', '17032184774', '20:41:53', '2023-10-26', 'Falha', 'Não Logado Respondeu incorretamente: Qual sua data de nascimento ?', '18');
INSERT INTO log_acesso VALUES ('7', '17032184774', '20:42:05', '2023-10-26', 'Sucesso', 'Logado com Sucesso Respondendo corretamente: Qual seu email ?', '18');
INSERT INTO log_acesso VALUES ('8', '17032184774', '20:48:22', '2023-10-26', 'Falha', 'Não Logado Respondeu incorretamente: Qual seu CEP ?', '18');
CREATE TABLE `perfis` (
  `perfil_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_perfil` varchar(255) NOT NULL,
  PRIMARY KEY (`perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO perfis VALUES ('1', 'Master');
INSERT INTO perfis VALUES ('2', 'Comum');
CREATE TABLE `usuarios` (
  `usuarios_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nascimento` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `mae` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `celular` varchar(19) NOT NULL,
  `telefone` varchar(18) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `perfil_id` int(11) DEFAULT 2,
  `usuario` varchar(6) NOT NULL,
  `senha` varchar(60) NOT NULL,
  PRIMARY KEY (`usuarios_id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  KEY `usuarios_ibfk_1` (`perfil_id`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfis` (`perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO usuarios VALUES ('18', 'Lucas sales pires', 'lucas2013sales@hotmail.com', '1998-03-06', 'M', 'idelma sales matos', '17032184774', '(+55) 21-96989-3467', '(+55) 21-2218-6135', '20973120', 'Travessa Espírito Santo', '2', 'lucass', '$2y$10$8vWNe0X99Oj6W4DT/A6KZuAvb8qctvYbsb3AyA4avldz8cXIDfA.O');
INSERT INTO usuarios VALUES ('20', 'maria de fatima franco abreu pires', 'fatimarj_2007@hotmail.com', '1995-10-13', 'F', 'maria das graças franco abreu', '17158853764', '(+55) 21-97952-7767', '(+55) 21-2218-6135', '21031690', 'Rua Itambé', '2', 'mariaa', '$2y$10$ctfBLDXBD.5MyckU4fs00./lSlKOPEdKjkCF04rVV47VWc3KEFKLO');
INSERT INTO usuarios VALUES ('23', 'idelma sales matos', 'idelma.sales2014@hotmail.com', '1970-05-02', 'F', 'idelma sales mae', '02192619707', '(+55) 21-98034-8365', '(+55) 21-2218-6135', '20973120', 'Travessa Espírito Santo', '2', 'idelma', '$2y$10$2DyYifHz3ltrPSNpzaix6eRB0GUT4VqCmuMxEx7NnRNT7NorF.xV2');
INSERT INTO usuarios VALUES ('24', 'frederico quico vieira', 'mechamoudefrederico@hotmail.com', '1995-10-13', 'M', 'dona florinda', '17128853764', '(+55) 21-96989-3467', '(+55) 21-2218-6135', '20973120', 'Travessa Espírito Santo', '2', 'quicoo', '$2y$10$WlrffCqk4ktDuHNH0Dhp2uZF6ZVLtHlEsZixDzQukbaq9ARXG/Nhu');
CREATE TABLE `usuarios_master` (
  `usuarios_master_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nascimento` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `mae` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `celular` varchar(19) NOT NULL,
  `telefone` varchar(18) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `perfil_id` int(11) DEFAULT 1,
  `usuario` varchar(6) NOT NULL,
  `senha` varchar(60) NOT NULL,
  PRIMARY KEY (`usuarios_master_id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  KEY `usuarios_master_ibfk_1` (`perfil_id`),
  CONSTRAINT `usuarios_master_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfis` (`perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO usuarios_master VALUES ('1', 'geosanias da silva', 'geosanias@hotmail.com', '1995-10-03', 'M', 'geozania da silva', '17158853764', '(+55) 21 97952-', '(+55) 21 2218-6', '20973120', 'travessa espirito santo', '1', 'geozan', '$2y$10$XF6HDjKljSAVRndWJj8tk.yOR2myrjvgqiqA1USii2UKfb50sh682');
