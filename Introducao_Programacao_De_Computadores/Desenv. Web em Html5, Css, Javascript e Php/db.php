<?php
/**
 * ==============================================================================
 * PROJETO: Sistema de Gestão de Desenvolvedores (DevPoint ADS)
 * DISCIPLINA: Desenvolvimento Web em HTML5, CSS, JavaScript e PHP (2026-2)
 * AUTOR: Wagner Pessoa (Matrícula: 2026 0178 4633) - ADS
 * DESCRIÇÃO: Módulo de Conexão com Banco de Dados via PDO (SQLite com suporte a MySQL)
 * ==============================================================================
 */

// Configurações gerais de ambiente
declare(strict_types=1);

// Definindo timezone padrão
date_default_timezone_set('America/Sao_Paulo');

// Constantes de configuração do banco de dados
// Por padrão de portabilidade acadêmica, utilizamos SQLite para que o projeto
// funcione imediatamente sem necessidade de configuração prévia de servidor MySQL.
define('DB_DRIVER', 'sqlite'); 
define('DB_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'database.sqlite');

// Configurações caso opte por MySQL (basta alterar DB_DRIVER para 'mysql')
define('DB_HOST', 'localhost');
define('DB_NAME', 'devpoint_ads');
define('DB_USER', 'root');
define('DB_PASS', '');

/**
 * Retorna uma instância PDO configurada e inicializa o esquema se necessário.
 *
 * @return PDO
 * @throws PDOException
 */
function getDatabaseConnection(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        try {
            if (DB_DRIVER === 'sqlite') {
                $dsn = 'sqlite:' . DB_PATH;
                $pdo = new PDO($dsn);
                // Ativar chaves estrangeiras no SQLite
                $pdo->exec('PRAGMA foreign_keys = ON;');
            } else {
                $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', DB_HOST, DB_NAME);
                $pdo = new PDO($dsn, DB_USER, DB_PASS);
            }

            // Configurar tratamento rigoroso de erros e modo de fetch padrão
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            // Garante que a tabela exista na inicialização
            inicializarTabela($pdo);

        } catch (PDOException $e) {
            // Log do erro técnico e mensagem amigável
            error_log("Erro de Conexão com o Banco de Dados: " . $e->getMessage());
            die("Erro crítico ao conectar com a base de dados. Verifique as permissões de gravação.");
        }
    }

    return $pdo;
}

/**
 * Cria a estrutura da tabela de usuários/desenvolvedores se ainda não existir.
 *
 * @param PDO $pdo
 * @return void
 */
function inicializarTabela(PDO $pdo): void {
    if (DB_DRIVER === 'sqlite') {
        $sql = "CREATE TABLE IF NOT EXISTS desenvolvedores (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE,
            cpf TEXT NOT NULL,
            telefone TEXT NOT NULL,
            cargo TEXT NOT NULL,
            nivel TEXT NOT NULL,
            habilidades TEXT,
            bio TEXT,
            foto TEXT DEFAULT NULL,
            linkedin TEXT DEFAULT NULL,
            instagram TEXT DEFAULT NULL,
            youtube TEXT DEFAULT NULL,
            twitter_x TEXT DEFAULT NULL,
            status TEXT DEFAULT 'Ativo',
            criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
        );";
        $pdo->exec($sql);

        // Migração suave para bases já criadas anteriormente
        $cols = $pdo->query("PRAGMA table_info(desenvolvedores)")->fetchAll(PDO::FETCH_COLUMN, 1);
        $novasColunas = [
            'foto'      => 'TEXT DEFAULT NULL',
            'linkedin'  => 'TEXT DEFAULT NULL',
            'instagram' => 'TEXT DEFAULT NULL',
            'youtube'   => 'TEXT DEFAULT NULL',
            'twitter_x' => 'TEXT DEFAULT NULL'
        ];
        foreach ($novasColunas as $col => $tipo) {
            if (!in_array($col, $cols)) {
                $pdo->exec("ALTER TABLE desenvolvedores ADD COLUMN $col $tipo;");
            }
        }
    } else {
        $sql = "CREATE TABLE IF NOT EXISTS desenvolvedores (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(150) NOT NULL,
            email VARCHAR(150) NOT NULL UNIQUE,
            cpf VARCHAR(14) NOT NULL,
            telefone VARCHAR(20) NOT NULL,
            cargo VARCHAR(50) NOT NULL,
            nivel VARCHAR(30) NOT NULL,
            habilidades TEXT,
            bio TEXT,
            foto VARCHAR(255) DEFAULT NULL,
            linkedin VARCHAR(255) DEFAULT NULL,
            instagram VARCHAR(255) DEFAULT NULL,
            youtube VARCHAR(255) DEFAULT NULL,
            twitter_x VARCHAR(255) DEFAULT NULL,
            status VARCHAR(20) DEFAULT 'Ativo',
            criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $pdo->exec($sql);
    }
}

