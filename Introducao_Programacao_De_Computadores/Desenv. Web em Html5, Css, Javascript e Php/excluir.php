<?php
/**
 * ==============================================================================
 * PROJETO: Sistema de Gestão de Desenvolvedores (DevPoint ADS)
 * DISCIPLINA: Desenvolvimento Web em HTML5, CSS, JavaScript e PHP (2026-2)
 * AUTOR: Wagner Pessoa (Matrícula: 2026 0178 4633) - ADS
 * ARQUIVO: excluir.php
 * CONCEITO: Exclusão Segura com Prepared Statement e Tratamento de Exceções
 * ==============================================================================
 */

declare(strict_types=1);

session_start();

require_once __DIR__ . '/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    $_SESSION['flash_tipo'] = 'erro';
    $_SESSION['flash_msg'] = "Identificador de registro inválido para exclusão.";
    header('Location: listar.php');
    exit;
}

try {
    $pdo = getDatabaseConnection();

    // Query parametrizada segura
    $stmt = $pdo->prepare("DELETE FROM desenvolvedores WHERE id = :id");
    $stmt->execute([':id' => $id]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['flash_tipo'] = 'sucesso';
        $_SESSION['flash_msg'] = "Registro #{$id} removido com sucesso da base de dados.";
    } else {
        $_SESSION['flash_tipo'] = 'erro';
        $_SESSION['flash_msg'] = "Nenhum desenvolvedor localizado com o ID informado.";
    }

} catch (PDOException $e) {
    error_log("Erro ao excluir registro: " . $e->getMessage());
    $_SESSION['flash_tipo'] = 'erro';
    $_SESSION['flash_msg'] = "Falha interna ao tentar excluir o registro da base.";
}

header('Location: listar.php');
exit;

