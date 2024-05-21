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
) ENGINE=InnoDB AUTO_INCREMENT=349 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO log_acesso VALUES ('281', '', '02:42:13', '2023-11-16', 'Deslogou', ' O Usuário geozan Deslogou ', '');
INSERT INTO log_acesso VALUES ('284', '', '02:52:46', '2023-11-16', 'Deslogou', ' O Usuário geozan Deslogou ', '');
INSERT INTO log_acesso VALUES ('287', '', '02:56:14', '2023-11-16', 'Deslogou', ' O Usuário geozan Deslogou ', '');
INSERT INTO log_acesso VALUES ('288', '', '02:58:06', '2023-11-16', 'Deslogou', ' O Usuário geozan Deslogou ', '');
INSERT INTO log_acesso VALUES ('289', '', '03:06:59', '2023-11-16', 'Deslogou', ' O Usuário geozan Deslogou ', '');
INSERT INTO log_acesso VALUES ('316', '', '03:52:00', '2023-11-16', 'Deslogou', ' O Usuário geozan Deslogou ', '');
INSERT INTO log_acesso VALUES ('324', '', '03:59:48', '2023-11-16', 'Deslogou', ' O Usuário geozan Deslogou ', '');
INSERT INTO log_acesso VALUES ('325', '17032184774', '04:22:01', '2023-11-16', 'Sucesso', 'Logado com Sucesso Respondendo corretamente: Qual seu CEP ?', '147');
INSERT INTO log_acesso VALUES ('326', '17032184774', '04:22:33', '2023-11-16', 'Deslogou', ' O Usuário lucass Deslogou ', '147');
INSERT INTO log_acesso VALUES ('327', '17032184774', '04:23:02', '2023-11-16', 'Sucesso', 'Logado com Sucesso Respondendo corretamente: Qual o nome da sua mae ?', '147');
INSERT INTO log_acesso VALUES ('328', '17032184774', '04:23:12', '2023-11-16', 'Deslogou', ' O Usuário lucass Deslogou ', '147');
INSERT INTO log_acesso VALUES ('329', '', '04:23:43', '2023-11-16', 'Deslogou', ' O Usuário geozan Deslogou ', '');
INSERT INTO log_acesso VALUES ('330', '17158853764', '04:23:58', '2023-11-16', 'Sucesso', 'Logado com Sucesso Respondendo corretamente: Qual sua data de nascimento ?', '148');
INSERT INTO log_acesso VALUES ('331', '17158853764', '04:24:36', '2023-11-16', 'Deslogou', ' O Usuário fatima Deslogou ', '148');
INSERT INTO log_acesso VALUES ('332', '17032184774', '04:24:53', '2023-11-16', 'Sucesso', 'Logado com Sucesso Respondendo corretamente: Qual seu email ?', '147');
INSERT INTO log_acesso VALUES ('333', '17032184774', '04:25:41', '2023-11-16', 'Deslogou', ' O Usuário lucass Deslogou ', '147');
INSERT INTO log_acesso VALUES ('334', '17158853764', '19:17:11', '2023-11-16', 'Sucesso', 'Logado com Sucesso Respondendo corretamente: Qual seu CEP ?', '148');
INSERT INTO log_acesso VALUES ('335', '17158853764', '19:17:48', '2023-11-16', 'Deslogou', ' O Usuário fatima Deslogou ', '148');
INSERT INTO log_acesso VALUES ('336', '17032184774', '19:36:14', '2023-11-16', 'Sucesso', 'Logado com Sucesso Respondendo corretamente: Qual seu email ?', '147');
INSERT INTO log_acesso VALUES ('337', '17032184774', '19:37:34', '2023-11-16', 'Deslogou', ' O Usuário lucass Deslogou ', '147');
INSERT INTO log_acesso VALUES ('338', '17032184774', '12:10:29', '2023-11-18', 'Sucesso', 'Logado com Sucesso Respondendo corretamente: Qual o nome da sua mae ?', '147');
INSERT INTO log_acesso VALUES ('339', '17032184774', '12:11:04', '2023-11-18', 'Deslogou', ' O Usuário lucass Deslogou ', '147');
INSERT INTO log_acesso VALUES ('340', '', '12:13:55', '2023-11-18', 'Deslogou', ' O Usuário geozan Deslogou ', '');
INSERT INTO log_acesso VALUES ('341', '17032184774', '12:53:06', '2023-11-18', 'Sucesso', 'Logado com Sucesso Respondendo corretamente: Qual seu email ?', '147');
INSERT INTO log_acesso VALUES ('342', '', '17:49:44', '2023-11-21', 'Deslogou', ' O Usuário geozan Deslogou ', '');
INSERT INTO log_acesso VALUES ('343', '', '17:50:31', '2023-11-21', 'Deslogou', ' O Usuário  Deslogou ', '');
INSERT INTO log_acesso VALUES ('344', '17032184774', '17:50:47', '2023-11-21', 'Sucesso', 'Logado com Sucesso Respondendo corretamente: Qual seu email ?', '147');
INSERT INTO log_acesso VALUES ('345', '17032184774', '17:50:57', '2023-11-21', 'Deslogou', ' O Usuário lucass Deslogou ', '147');
INSERT INTO log_acesso VALUES ('346', '17032184774', '07:47:49', '2023-11-26', 'Sucesso', 'Logado com Sucesso Respondendo corretamente: Qual seu email ?', '147');
INSERT INTO log_acesso VALUES ('347', '17032184774', '07:47:55', '2023-11-26', 'Deslogou', ' O Usuário lucass Deslogou ', '147');
INSERT INTO log_acesso VALUES ('348', '', '07:48:06', '2023-11-26', 'Deslogou', ' O Usuário geozan Deslogou ', '');
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
  `bairro` varchar(45) DEFAULT NULL,
  `numero` varchar(5) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`usuarios_id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `unique_usuario` (`usuario`),
  KEY `usuarios_ibfk_1` (`perfil_id`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfis` (`perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO usuarios VALUES ('147', 'Lucas sales pires', 'lucas2013sales@hotmail.com', '1998-03-06', 'M', 'idelma sales matos', '17032184774', '(+55) 21-96989-3467', '(+55) 21-2218-6135', '21031690', 'Rua Itambé', '2', 'lucass', '$2y$10$hmizujptEQ3dWUhZipQjy.KC1BJzKfoMO0s4kd0i95LTIjD3pRjaW', 'Ramos', '57', 'RJ');
INSERT INTO usuarios VALUES ('148', 'maria de fatima franco abreu pires', 'fatimarj_2007@hotmail.com', '1995-10-13', 'F', 'NÃO DECLARADO', '17158853764', '(+55) 21-96989-3467', '(+55) 21-2218-6135', '21031690', 'Rua Itambé', '2', 'fatima', '$2y$10$h/rYZK3Xvs.rxF5ZDGT2.uKLOv6VGQr3wWAEpmXvfFbEMQCwygpje', 'Ramos', '57', 'RJ');
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
  `bairro` varchar(60) DEFAULT NULL,
  `numero` varchar(5) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`usuarios_master_id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  KEY `usuarios_master_ibfk_1` (`perfil_id`),
  CONSTRAINT `usuarios_master_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfis` (`perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO usuarios_master VALUES ('1', 'geosanias da silva', 'geosanias@hotmail.com', '1995-10-03', 'M', 'geozania da silva', '17158853764', '(+55) 21 97952-', '(+55) 21 2218-6', '20973120', 'travessa espirito santo', '1', 'geozan', '$2y$10$XF6HDjKljSAVRndWJj8tk.yOR2myrjvgqiqA1USii2UKfb50sh682', '', '', '');
