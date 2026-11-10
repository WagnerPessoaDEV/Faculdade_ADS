<?php
/**
 * ==============================================================================
 * PROJETO: Sistema de Gestão de Desenvolvedores (DevPoint ADS)
 * DISCIPLINA: Desenvolvimento Web em HTML5, CSS, JavaScript e PHP (2026-2)
 * AUTOR: Wagner Pessoa (Matrícula: 2026 0178 4633) - ADS
 * ARQUIVO: processa_cadastro.php
 * CONCEITO: Backend Controller - Validação, Sanitização, Segurança e Persistência
 * ==============================================================================
 */

declare(strict_types=1);

// Inicia sessão para mensagens de feedback (Flash Messages)
session_start();

require_once __DIR__ . '/db.php';

// 1. RESTRITO APENAS A REQUISIÇÕES POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Location: cadastro.html');
    exit;
}

// 2. SANITIZAÇÃO DE ENTRADA (Defesa contra XSS e espaços desnecessários)
$nome        = trim(filter_input(INPUT_POST, 'nome', FILTER_DEFAULT) ?? '');
$email       = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '');
$cpf         = trim(filter_input(INPUT_POST, 'cpf', FILTER_DEFAULT) ?? '');
$telefone    = trim(filter_input(INPUT_POST, 'telefone', FILTER_DEFAULT) ?? '');
$cargo       = trim(filter_input(INPUT_POST, 'cargo', FILTER_DEFAULT) ?? '');
$nivel       = trim(filter_input(INPUT_POST, 'nivel', FILTER_DEFAULT) ?? '');
$bio         = trim(filter_input(INPUT_POST, 'bio', FILTER_DEFAULT) ?? '');
$termos      = filter_input(INPUT_POST, 'termos', FILTER_DEFAULT);
$linkedin    = trim(filter_input(INPUT_POST, 'linkedin', FILTER_SANITIZE_URL) ?? '');
$instagram   = trim(filter_input(INPUT_POST, 'instagram', FILTER_DEFAULT) ?? '');
$youtube     = trim(filter_input(INPUT_POST, 'youtube', FILTER_SANITIZE_URL) ?? '');
$twitter_x   = trim(filter_input(INPUT_POST, 'twitter_x', FILTER_DEFAULT) ?? '');

$habilidades = isset($_POST['habilidades']) && is_array($_POST['habilidades']) 
    ? array_map('trim', $_POST['habilidades']) 
    : [];

// Processamento de Upload de Foto de Perfil (Opcional)
$caminhoFoto = null;
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $arquivoTmp = $_FILES['foto']['tmp_name'];
    $nomeOriginal = $_FILES['foto']['name'];
    $tamanho = $_FILES['foto']['size'];
    $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];

    if (in_array($extensao, $extensoesPermitidas) && $tamanho <= 2 * 1024 * 1024) {
        $pastaUploads = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';
        if (!is_dir($pastaUploads)) {
            mkdir($pastaUploads, 0755, true);
        }

        $novoNomeFoto = 'dev_' . uniqid('', true) . '.' . $extensao;
        $destinoCompleto = $pastaUploads . DIRECTORY_SEPARATOR . $novoNomeFoto;

        if (move_uploaded_file($arquivoTmp, $destinoCompleto)) {
            $caminhoFoto = 'uploads/' . $novoNomeFoto;
        }
    }
}

// 3. VALIDAÇÕES CRÍTICAS NO SERVIDOR (Server-Side Validation)
// Como futuros Analistas de Sistemas, sabemos que nunca devemos confiar 
// exclusivamente na validação client-side.
$erros = [];

if (mb_strlen($nome) < 3) {
    $erros[] = "O campo Nome Completo deve possuir no mínimo 3 caracteres.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erros[] = "O e-mail informado não possui um formato RFC válido.";
}

// Limpeza de caracteres não numéricos do CPF
$cpfNumeros = preg_replace('/\D/', '', $cpf);
if (strlen($cpfNumeros) !== 11) {
    $erros[] = "O CPF informado é inválido ou está incompleto.";
}

$telNumeros = preg_replace('/\D/', '', $telefone);
if (strlen($telNumeros) < 10) {
    $erros[] = "O telefone informado deve conter DDD e no mínimo 10 dígitos.";
}

if (empty($cargo)) {
    $erros[] = "Por favor, selecione uma especialidade/cargo válida.";
}

if (empty($nivel)) {
    $erros[] = "Por favor, selecione o nível de senioridade.";
}

if ($termos !== 'aceito') {
    $erros[] = "É obrigatório aceitar os termos de uso dos dados para continuar.";
}

// Se houver erros de validação, redireciona informando os motivos
if (!empty($erros)) {
    $_SESSION['flash_tipo'] = 'erro';
    $_SESSION['flash_msg'] = implode('<br>', array_map('htmlspecialchars', $erros));
    header('Location: listar.php?status=erro');
    exit;
}

// Formatar lista de habilidades em string separada por vírgula
$habilidadesFormatadas = !empty($habilidades) ? implode(', ', $habilidades) : 'Nenhuma selecionada';

// 4. PERSISTÊNCIA NO BANCO DE DADOS RELACIONAL VIA PDO PREPARED STATEMENTS
try {
    $pdo = getDatabaseConnection();

    // Query parametrizada para impedir 100% de ataques de SQL Injection
    $sql = "INSERT INTO desenvolvedores 
            (nome, email, cpf, telefone, cargo, nivel, habilidades, bio, foto, linkedin, instagram, youtube, twitter_x, criado_em)
            VALUES 
            (:nome, :email, :cpf, :telefone, :cargo, :nivel, :habilidades, :bio, :foto, :linkedin, :instagram, :youtube, :twitter_x, :criado_em)";

    $stmt = $pdo->prepare($sql);
    
    $sucesso = $stmt->execute([
        ':nome'        => htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'),
        ':email'       => strtolower($email),
        ':cpf'         => $cpf,
        ':telefone'    => $telefone,
        ':cargo'       => $cargo,
        ':nivel'       => $nivel,
        ':habilidades' => $habilidadesFormatadas,
        ':bio'         => htmlspecialchars($bio, ENT_QUOTES, 'UTF-8'),
        ':foto'        => $caminhoFoto,
        ':linkedin'    => htmlspecialchars($linkedin, ENT_QUOTES, 'UTF-8'),
        ':instagram'   => htmlspecialchars($instagram, ENT_QUOTES, 'UTF-8'),
        ':youtube'     => htmlspecialchars($youtube, ENT_QUOTES, 'UTF-8'),
        ':twitter_x'   => htmlspecialchars($twitter_x, ENT_QUOTES, 'UTF-8'),
        ':criado_em'   => date('Y-m-d H:i:s')
    ]);

    if ($sucesso) {
        $_SESSION['flash_tipo'] = 'sucesso';
        $_SESSION['flash_msg'] = "Desenvolvedor <strong>" . htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') . "</strong> cadastrado com sucesso no sistema!";
        header('Location: listar.php?status=sucesso');
        exit;
    }

} catch (PDOException $e) {
    // Tratamento de duplicação de chave primária ou índice único (ex: e-mail já cadastrado)
    if ($e->getCode() == 23000 || str_contains($e->getMessage(), 'UNIQUE')) {
        $_SESSION['flash_tipo'] = 'erro';
        $_SESSION['flash_msg'] = "O e-mail informado (" . htmlspecialchars($email) . ") já está cadastrado na base de dados.";
    } else {
        error_log("Erro de inserção PDO: " . $e->getMessage());
        $_SESSION['flash_tipo'] = 'erro';
        $_SESSION['flash_msg'] = "Erro operacional ao gravar os dados. Detalhe: " . $e->getMessage();
    }
    
    header('Location: listar.php?status=erro');
    exit;
}

