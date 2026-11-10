<?php
/**
 * ==============================================================================
 * PROJETO: Sistema de Gestão de Desenvolvedores (DevPoint ADS)
 * DISCIPLINA: Desenvolvimento Web em HTML5, CSS, JavaScript e PHP (2026-2)
 * AUTOR: Wagner Pessoa (Matrícula: 2026 0178 4633) - ADS
 * ARQUIVO: listar.php
 * CONCEITO: Consulta de Dados com PDO, Renderização Dinâmica e Filtro Reativo
 * ==============================================================================
 */

declare(strict_types=1);

session_start();

require_once __DIR__ . '/db.php';

// Resgate de mensagens flash de feedback
$flashTipo = $_SESSION['flash_tipo'] ?? null;
$flashMsg  = $_SESSION['flash_msg'] ?? null;
unset($_SESSION['flash_tipo'], $_SESSION['flash_msg']);

// Busca de desenvolvedores cadastrados na base de dados
$desenvolvedores = [];
try {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->query("SELECT * FROM desenvolvedores ORDER BY id DESC");
    $desenvolvedores = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log("Erro ao listar dados: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Desenvolvedores - DevPoint ADS</title>
    <script>
        (function () {
            var t = localStorage.getItem('devpoint-theme');
            if (!t) t = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', t);
        })();
    </script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- CABEÇALHO / NAVBAR -->
    <header class="navbar">
        <div class="nav-container">
            <a href="index.html" class="brand">
                <div class="brand-icon">&lt;/&gt;</div>
                DevPoint <span>ADS</span>
            </a>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.html">Início</a></li>
                    <li><a href="cadastro.html">Novo Cadastro</a></li>
                    <li><a href="listar.php" class="active">Listagem (PHP)</a></li>
                    <li><a href="sobre.html">Sobre o Projeto</a></li>
                    <li>
                        <button type="button" id="theme-toggle" class="theme-toggle-btn" aria-label="Alternar tema claro e escuro">
                            <span>Escuro</span>
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-wrapper">

        <!-- MENSAGENS FLASH DE FEEDBACK -->
        <?php if ($flashTipo === 'sucesso' && !empty($flashMsg)): ?>
            <div class="alert alert-success">
                <span>&#9989; <?= $flashMsg ?></span>
                <button type="button" class="alert-close" aria-label="Fechar">&times;</button>
            </div>
        <?php elseif ($flashTipo === 'erro' && !empty($flashMsg)): ?>
            <div class="alert alert-danger">
                <span>&#9888; <?= $flashMsg ?></span>
                <button type="button" class="alert-close" aria-label="Fechar">&times;</button>
            </div>
        <?php endif; ?>

        <!-- PAINEL DA TABELA -->
        <div class="table-card">
            
            <div class="table-toolbar">
                <div>
                    <h2>Base de Talentos Cadastrados</h2>
                    <p style="color: var(--text-muted); font-size: 0.9rem;">
                        Total de registros ativos: <strong><?= count($desenvolvedores) ?></strong>
                    </p>
                </div>

                <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                    <!-- BUSCA INSTANTÂNEA FILTRADA VIA JAVASCRIPT -->
                    <div class="search-box">
                        <span class="search-icon">&#128269;</span>
                        <input type="text" id="tabela-busca" class="form-control" placeholder="Buscar por nome, cargo ou stack...">
                    </div>

                    <a href="cadastro.html" class="btn btn-primary btn-sm">+ Novo Registro</a>
                </div>
            </div>

            <!-- TABELA RESPONSIVA -->
            <?php if (!empty($desenvolvedores)): ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Desenvolvedor</th>
                                <th>Contato</th>
                                <th>Cargo &amp; Nível</th>
                                <th>Competências</th>
                                <th>Data Cadastro</th>
                                <th style="text-align: center;">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="tabela-devs-corpo">
                            <?php foreach ($desenvolvedores as $dev): ?>
                                <?php
                                    // Definição de classe de estilo para o badge de senioridade
                                    $badgeClass = 'badge-junior';
                                    if (stripos($dev['nivel'], 'pleno') !== false) {
                                        $badgeClass = 'badge-pleno';
                                    } elseif (stripos($dev['nivel'], 'sênior') !== false || stripos($dev['nivel'], 'senior') !== false || stripos($dev['nivel'], 'lead') !== false) {
                                        $badgeClass = 'badge-senior';
                                    }

                                    // Separação de tags de tecnologias
                                    $skillsArray = array_map('trim', explode(',', $dev['habilidades'] ?? ''));
                                    
                                    // Formatação de data brasileira
                                    $dataHora = date('d/m/Y H:i', strtotime($dev['criado_em']));
                                ?>
                                <tr>
                                    <td style="white-space: nowrap; color: var(--text-muted);"><strong>#<?= (int)$dev['id'] ?></strong></td>
                                    <td>
                                        <div class="dev-profile-cell">
                                            <?php if (!empty($dev['foto']) && file_exists(__DIR__ . '/' . $dev['foto'])): ?>
                                                <img src="<?= htmlspecialchars($dev['foto']) ?>" class="dev-avatar-table" alt="Avatar">
                                            <?php else: ?>
                                                <div class="dev-avatar-fallback">&#128100;</div>
                                            <?php endif; ?>
                                            <div class="dev-profile-info">
                                                <span class="dev-name"><?= htmlspecialchars($dev['nome']) ?></span>
                                                <span class="dev-cpf">CPF: <?= htmlspecialchars($dev['cpf']) ?></span>
                                                
                                                <!-- BADGES DAS REDES SOCIAIS -->
                                                <?php
                                                    $temRedes = !empty($dev['linkedin']) || !empty($dev['instagram']) || !empty($dev['youtube']) || !empty($dev['twitter_x']);
                                                ?>
                                                <?php if ($temRedes): ?>
                                                    <div class="social-badges">
                                                        <?php if (!empty($dev['linkedin'])): ?>
                                                            <?php
                                                                $urlIn = str_starts_with($dev['linkedin'], 'http') ? $dev['linkedin'] : 'https://' . $dev['linkedin'];
                                                            ?>
                                                            <a href="<?= htmlspecialchars($urlIn) ?>" target="_blank" rel="noopener noreferrer" class="social-btn social-btn-linkedin" title="LinkedIn">
                                                                <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($dev['instagram'])): ?>
                                                            <?php
                                                                $handleIg = ltrim($dev['instagram'], '@');
                                                                $urlIg = str_starts_with($dev['instagram'], 'http') ? $dev['instagram'] : "https://instagram.com/{$handleIg}";
                                                            ?>
                                                            <a href="<?= htmlspecialchars($urlIg) ?>" target="_blank" rel="noopener noreferrer" class="social-btn social-btn-instagram" title="Instagram">
                                                                <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($dev['youtube'])): ?>
                                                            <?php
                                                                $urlYt = str_starts_with($dev['youtube'], 'http') ? $dev['youtube'] : 'https://' . $dev['youtube'];
                                                            ?>
                                                            <a href="<?= htmlspecialchars($urlYt) ?>" target="_blank" rel="noopener noreferrer" class="social-btn social-btn-youtube" title="YouTube">
                                                                <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($dev['twitter_x'])): ?>
                                                            <?php
                                                                $handleX = ltrim($dev['twitter_x'], '@');
                                                                $urlX = str_starts_with($dev['twitter_x'], 'http') ? $dev['twitter_x'] : "https://x.com/{$handleX}";
                                                            ?>
                                                            <a href="<?= htmlspecialchars($urlX) ?>" target="_blank" rel="noopener noreferrer" class="social-btn social-btn-x" title="X (Twitter)">
                                                                <svg viewBox="0 0 24 24" width="12" height="12" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dev-contact-cell">
                                            <a href="mailto:<?= htmlspecialchars($dev['email']) ?>" class="dev-email"><?= htmlspecialchars($dev['email']) ?></a>
                                            <span class="dev-phone"><?= htmlspecialchars($dev['telefone']) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dev-role-cell">
                                            <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($dev['nivel']) ?></span>
                                            <span class="dev-cargo"><?= htmlspecialchars($dev['cargo']) ?></span>
                                        </div>
                                    </td>
                                    <td class="dev-skills-cell">
                                        <div class="skills-list">
                                            <?php foreach ($skillsArray as $skill): ?>
                                                <?php if (!empty($skill) && $skill !== 'Nenhuma selecionada'): ?>
                                                    <span class="badge badge-tech"><?= htmlspecialchars($skill) ?></span>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php if (!empty($dev['bio'])): ?>
                                            <p class="dev-bio-snippet">
                                                "<?= htmlspecialchars($dev['bio']) ?>"
                                            </p>
                                        <?php endif; ?>
                                    </td>
                                    <td class="dev-date-cell">
                                        <?= $dataHora ?>
                                    </td>
                                    <td style="text-align: center; white-space: nowrap;">
                                        <button 
                                            type="button" 
                                            class="btn btn-danger btn-sm"
                                            onclick="confirmarExclusao(<?= (int)$dev['id'] ?>, '<?= addslashes(htmlspecialchars($dev['nome'])) ?>')"
                                            title="Remover cadastro da base">
                                            Excluir
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- AVISO QUANDO A BUSCA CLIENT-SIDE NÃO RETORNA RESULTADO -->
                <div id="sem-resultados" style="display: none; padding: 2rem; text-align: center; color: var(--text-muted);">
                    Nenhum registro encontrado correspondente aos termos digitados.
                </div>

            <?php else: ?>
                <!-- ESTADO VAZIO (EMPTY STATE) -->
                <div style="text-align: center; padding: 3.5rem 1rem;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">&#128194;</div>
                    <h3>Nenhum desenvolvedor cadastrado até o momento</h3>
                    <p style="color: var(--text-muted); max-width: 450px; margin: 0.5rem auto 1.5rem;">
                        A base de dados SQLite está pronta e conectada. Adicione o primeiro registro através da página de cadastro.
                    </p>
                    <a href="cadastro.html" class="btn btn-primary">Cadastrar Primeiro Desenvolvedor</a>
                </div>
            <?php endif; ?>

        </div>

    </main>

    <!-- RODAPÉ -->
    <footer>
        <div class="footer-content">
            <span class="footer-badge">Análise e Desenvolvimento de Sistemas &bull; Segundo Período</span>
            <p><strong>Desenvolvido por:</strong> <a href="https://github.com/WagnerPessoaDEV" target="_blank" rel="noopener noreferrer" class="author-name-link" title="Acessar Portfólio de Wagner Pessoa">Wagner Pessoa</a> &bull; <strong>Matrícula:</strong> 2026 0178 4633</p>
            <div class="footer-socials">
                <a href="https://www.linkedin.com/in/wagnerpessoadev/" target="_blank" rel="noopener noreferrer" class="social-btn social-btn-linkedin" title="LinkedIn">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor" aria-hidden="true"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                </a>
                <a href="https://www.instagram.com/wagnerpessoadev/" target="_blank" rel="noopener noreferrer" class="social-btn social-btn-instagram" title="Instagram">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="https://www.youtube.com/@wagnerpessoaDEV" target="_blank" rel="noopener noreferrer" class="social-btn social-btn-youtube" title="YouTube">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
                <a href="https://x.com/WagnerPessoaDEV" target="_blank" rel="noopener noreferrer" class="social-btn social-btn-x" title="X (Twitter)">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="https://www.tiktok.com/@wagnerpessoadev" target="_blank" rel="noopener noreferrer" class="social-btn social-btn-tiktok" title="TikTok">
                    <svg viewBox="0 0 24 24" width="15" height="15" aria-hidden="true">
                        <path transform="translate(-0.7, -0.7)" fill="#25F4EE" d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                        <path transform="translate(0.7, 0.7)" fill="#FE2C55" d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                        <path fill="#FFFFFF" d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                    </svg>
                </a>
            </div>
            <p>&copy; 2026 DevPoint ADS &bull; Disciplina de Desenvolvimento Web em HTML5, CSS, JavaScript e PHP</p>
            <p style="font-size: 0.8rem; color: #94a3b8;">Entrega individual via SAVA &bull; Semestre Letivo 2026-2</p>
        </div>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>

