# DevPoint ADS — Sistema de Gestão e Cadastro de Desenvolvedores

![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6%2B-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-PDO-003B57?style=for-the-badge&logo=sqlite&logoColor=white)

> Aplicação web full-stack desenvolvida para a disciplina **Desenvolvimento Web em HTML5, CSS, JavaScript e PHP (2026-2)** do curso de **Análise e Desenvolvimento de Sistemas (ADS)**.

---

## 📋 Informações Acadêmicas

| Campo | Detalhe |
| :--- | :--- |
| **Aluno** | Wagner Pessoa |
| **Matrícula** | `2026 0178 4633` |
| **Curso / Período** | Análise e Desenvolvimento de Sistemas (ADS) — 2º Período |
| **Disciplina** | Desenvolvimento Web em HTML5, CSS, JavaScript e PHP (2026-2) |
| **Pontuação** | Até 2,0 pontos |
| **Entrega** | Individual via SAVA / Trabalho (até 24/11/2026) |

---

## 🎯 Visão Geral do Projeto

O **DevPoint ADS** é uma plataforma para cadastro, validação, persistência e gerenciamento de perfis de desenvolvedores. O sistema foi construído integrando de ponta a ponta as quatro tecnologias exigidas na disciplina — **HTML5 semântico**, **CSS3 autoral com Tema Claro e Escuro**, **JavaScript ES6+ reativo** e **PHP 8+ com PDO** — priorizando portabilidade imediata, responsividade e segurança em camadas.

---

## ✅ Checklist de Requisitos da Disciplina

| Requisito | Implementação no Projeto | Status |
| :--- | :--- | :---: |
| **Páginas HTML** | `index.html` (Apresentação), `cadastro.html` (Formulário), `sobre.html` (Documentação e Perfil) | Concluído |
| **Página de Cadastro** | `cadastro.html` com inputs HTML5, upload de foto, redes sociais e validações | Concluído |
| **Arquivo CSS** | `css/style.css` com Design System por variáveis, Tema Claro/Escuro, Grid, Flexbox e layout responsivo | Concluído |
| **Arquivo JS** | `js/main.js` com alternância de tema, preview de foto, máscaras, validação de CPF e filtro em tempo real | Concluído |
| **Arquivos PHP** | `db.php`, `processa_cadastro.php`, `listar.php` e `excluir.php` com PDO, Prepared Statements e sanitização | Concluído |

---

## ✨ Principais Funcionalidades

- **🌗 Tema Claro e Escuro em Todo o Sistema:** Alternância instantânea no menu superior, salvando a preferência no `localStorage` (`devpoint-theme`), respeitando o tema do sistema operacional (`prefers-color-scheme`) e evitando flash visual na navegação entre páginas.
- **📸 Upload de Foto de Perfil com Preview:** Seleção de imagem (`JPG`, `PNG` ou `WEBP`, até 2 MB) com pré-visualização instantânea no navegador via `FileReader` e armazenamento seguro em `uploads/`.
- **🛡️ Validações em Duas Camadas (Front-End + Back-End):**
  - **Client-Side (`js/main.js`):** Máscara dinâmica para telefone e CPF, contador de caracteres na biografia (máximo 300) e validação matemática oficial do CPF pelo algoritmo de módulo 11.
  - **Server-Side (`processa_cadastro.php`):** Revalidação completa no PHP, sanitização contra XSS (`filter_input`, `htmlspecialchars`) e proteção contra SQL Injection com **Prepared Statements** no PDO.
- **🔎 Listagem Dinâmica e Busca Instantânea (`listar.php`):** Tabela responsiva com avatar, dados formatados, badges clicáveis das redes sociais cadastradas, tags de competências, mensagens flash de feedback, filtro em tempo real sem recarregar a página e exclusão segura (`excluir.php`).
- **🔗 Rodapé Integrado:** Ícones SVG oficiais para **LinkedIn**, **Instagram**, **YouTube**, **X**, **TikTok**, **GitHub** e botão direto para o **Portfólio** (`wagnerpessoa.me`).

---

## 📁 Estrutura de Diretórios

```text
Desenv. Web em Html5, Css, Javascript e Php/
├── css/
│   └── style.css               # Estilos globais, Tema Claro/Escuro, Grid, Flexbox e responsividade
├── img/
│   ├── wagner-perfil.png       # Foto de perfil do autor exibida em sobre.html
│   └── avatar-default.svg      # Avatar SVG padrão de fallback
├── js/
│   └── main.js                 # Tema Claro/Escuro, preview de foto, máscaras, CPF e busca na tabela
├── uploads/                    # Armazenamento das fotos enviadas pelo formulário
├── index.html                  # Página inicial (Landing Page)
├── cadastro.html               # Página de cadastro de desenvolvedores
├── sobre.html                  # Documentação acadêmica e card de perfil do aluno
├── db.php                      # Conexão PDO e criação/migração automática da tabela
├── processa_cadastro.php       # Recebimento POST, upload de imagem, validação e INSERT
├── listar.php                  # Consulta PDO e exibição dinâmica dos cadastros
├── excluir.php                 # Exclusão segura de registro por ID
├── database.sql                # Script SQL opcional para uso com MySQL / phpMyAdmin
├── database.sqlite             # Banco SQLite gerado automaticamente na primeira execução
└── README.md                   # Documentação do projeto
```

---

## 🗄️ Estrutura do Banco de Dados (`desenvolvedores`)

O banco SQLite (`database.sqlite`) é criado automaticamente por `inicializarTabela()` em `db.php` na primeira execução, contendo as seguintes colunas:

| Coluna | Tipo (SQLite / MySQL) | Descrição |
| :--- | :--- | :--- |
| `id` | `INTEGER` / `INT` (PK, Auto Increment) | Identificador único do registro |
| `nome` | `TEXT` / `VARCHAR(150)` | Nome completo do desenvolvedor |
| `email` | `TEXT` / `VARCHAR(150)` (UNIQUE) | E-mail profissional/acadêmico |
| `cpf` | `TEXT` / `VARCHAR(14)` | CPF formatado e validado |
| `telefone` | `TEXT` / `VARCHAR(20)` | Telefone / WhatsApp com DDD |
| `cargo` | `TEXT` / `VARCHAR(50)` | Especialidade / cargo selecionado |
| `nivel` | `TEXT` / `VARCHAR(30)` | Nível de senioridade |
| `habilidades` | `TEXT` | Lista de tecnologias marcadas |
| `bio` | `TEXT` | Resumo profissional (até 300 caracteres) |
| `foto` | `TEXT` / `VARCHAR(255)` | Caminho relativo da foto salva em `uploads/` |
| `linkedin` | `TEXT` / `VARCHAR(255)` | URL do perfil no LinkedIn |
| `instagram` | `TEXT` / `VARCHAR(255)` | Usuário ou URL do Instagram |
| `youtube` | `TEXT` / `VARCHAR(255)` | URL do canal no YouTube |
| `twitter_x` | `TEXT` / `VARCHAR(255)` | Usuário ou URL no X (Twitter) |
| `status` | `TEXT` / `VARCHAR(20)` | Status do cadastro (padrão `'Ativo'`) |
| `criado_em` | `DATETIME` / `TIMESTAMP` | Data e hora do cadastro |

---

## 🚀 Como Executar Localmente

Por utilizar **SQLite via PDO** como driver padrão, o projeto funciona imediatamente sem necessidade de configurar usuário, senha ou importar bancos manualmente.

### Opção 1: Servidor Embutido do PHP (Recomendado)

1. Abra o terminal na pasta do projeto:
   ```powershell
   cd "e:\Faculdade_ADS\Introducao_Programacao_De_Computadores\Desenv. Web em Html5, Css, Javascript e Php"
   ```
2. Inicie o servidor local:
   ```powershell
   php -S 127.0.0.1:8000
   ```
3. Acesse no navegador:
   ```text
   http://127.0.0.1:8000
   ```

> **Requisito:** Ter a extensão `pdo_sqlite` habilitada no `php.ini` (PHP 8+).

### Opção 2: XAMPP / Laragon / WampServer

1. Copie a pasta do projeto para o diretório web do servidor (`C:\xampp\htdocs\devpoint-ads` ou `C:\laragon\www\devpoint-ads`).
2. Inicie o serviço **Apache**.
3. Acesse `http://localhost/devpoint-ads/`.
4. *(Opcional)* Para utilizar **MySQL** em vez de SQLite:
   - Altere `define('DB_DRIVER', 'mysql');` em `db.php` (e ajuste host/usuário/senha se necessário).
   - Importe o arquivo `database.sql` no **phpMyAdmin**.

---

## 👨‍💻 Autor e Links

**Wagner Pessoa** — Estudante de Análise e Desenvolvimento de Sistemas (2º Período)

- 🌐 **Portfólio:** [wagnerpessoa.me](https://wagnerpessoa.me)
- 💻 **GitHub:** [github.com/WagnerPessoaDEV](https://github.com/WagnerPessoaDEV)
- 💼 **LinkedIn:** [linkedin.com/in/wagnerpessoadev](https://www.linkedin.com/in/wagnerpessoadev/)
- 📸 **Instagram:** [@wagnerpessoadev](https://www.instagram.com/wagnerpessoadev/)
- ▶️ **YouTube:** [@wagnerpessoaDEV](https://www.youtube.com/@wagnerpessoaDEV)
- ✖️ **X (Twitter):** [@WagnerPessoaDEV](https://x.com/WagnerPessoaDEV)
- 🎵 **TikTok:** [@wagnerpessoadev](https://www.tiktok.com/@wagnerpessoadev)
