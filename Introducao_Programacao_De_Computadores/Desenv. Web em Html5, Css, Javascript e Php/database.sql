-- ==============================================================================
-- PROJETO: Sistema de Gestão de Desenvolvedores (DevPoint ADS)
-- DISCIPLINA: Desenvolvimento Web em HTML5, CSS, JavaScript e PHP (2026-2)
-- SCRIPT: database.sql (Compatível com MySQL / MariaDB / phpMyAdmin)
-- ==============================================================================

CREATE DATABASE IF NOT EXISTS `devpoint_ads` 
DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `devpoint_ads`;

CREATE TABLE IF NOT EXISTS `desenvolvedores` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(150) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `cpf` VARCHAR(14) NOT NULL,
    `telefone` VARCHAR(20) NOT NULL,
    `cargo` VARCHAR(60) NOT NULL,
    `nivel` VARCHAR(30) NOT NULL,
    `habilidades` TEXT NULL,
    `bio` TEXT NULL,
    `foto` VARCHAR(255) DEFAULT NULL,
    `linkedin` VARCHAR(255) DEFAULT NULL,
    `instagram` VARCHAR(255) DEFAULT NULL,
    `youtube` VARCHAR(255) DEFAULT NULL,
    `twitter_x` VARCHAR(255) DEFAULT NULL,
    `status` VARCHAR(20) DEFAULT 'Ativo',
    `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Registro de exemplo inicial (Seed para demonstração)
INSERT INTO `desenvolvedores` (`nome`, `email`, `cpf`, `telefone`, `cargo`, `nivel`, `habilidades`, `bio`) 
VALUES 
('Guilherme Siqueira', 'guilherme.ads@exemplo.com.br', '123.456.789-00', '(11) 98765-4321', 'Desenvolvedor Full-Stack', 'Pleno', 'HTML5/CSS3, JavaScript, PHP, SQL/Relacional, Git/GitHub', 'Estudante concluinte de ADS com foco no desenvolvimento de aplicações web escaláveis e seguras.');

