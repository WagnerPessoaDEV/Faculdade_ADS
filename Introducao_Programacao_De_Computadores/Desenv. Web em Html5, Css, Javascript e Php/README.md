# DevPoint ADS - Sistema de Gestão e Cadastro de Desenvolvedores

> **Aluno:** Wagner Pessoa ([GitHub / Portfólio](https://github.com/WagnerPessoaDEV))  
> **Matrícula:** 2026 0178 4633  
> **Curso:** Tecnologia em Análise e Desenvolvimento de Sistemas (ADS) — 2º Período  
> **Disciplina:** Desenvolvimento Web em HTML5, CSS, JavaScript e PHP (2026-2)  
> **Pontuação:** Até 2,0 pontos  
> **Prazo de Entrega:** Até 24/11/2026  
> **Entrega:** Individual via SAVA / Trabalho  

---

## 🎯 Visão Geral do Projeto

O **DevPoint ADS** é uma aplicação web completa desenvolvida para cadastrar, validar, persistir e gerenciar perfis de desenvolvedores e profissionais de tecnologia. O projeto integra de forma coesa as quatro tecnologias fundamentais da web moderna (**HTML5**, **CSS3**, **JavaScript** e **PHP** com **PDO / SQLite**), oferecendo tema **Claro e Escuro**, upload de foto de perfil, validação matemática de CPF e integração com redes sociais.

---

## ✅ Checklist de Requisitos Atendidos

| Requisito da Disciplina | Arquivos / Implementação | Status |
| :--- | :--- | :---: |
| **Páginas HTML** | `index.html` (Página Inicial), `sobre.html` (Documentação Acadêmica e Perfil) | **100% Atendido** |
| **Página de Cadastro** | `cadastro.html` (Formulário completo com upload de foto, redes sociais e validações) | **100% Atendido** |
| **Arquivo CSS** | `css/style.css` (Design System autoral com CSS Variables, Tema Claro/Escuro, Flexbox, Grid e Responsividade) | **100% Atendido** |
| **Arquivo JS** | `js/main.js` (Alternância de tema Claro/Escuro, pré-visualização de foto, máscaras de telefone/CPF, módulo 11 de CPF, filtro em tempo real) | **100% Atendido** |
| **Arquivo PHP** | `processa_cadastro.php`, `listar.php`, `excluir.php`, `db.php` (PDO, Prepared Statements, Upload seguro e Sanitização) | **100% Atendido** |

---

## 📁 Estrutura de Diretórios do Projeto

```text
Desenv. Web em Html5, Css, Javascript e Php/
│
├── css/
│   └── style.css            # Folha de estilos autoral (Tema Claro/Escuro, Grid, Flexbox, Responsivo)
│
├── img/
│   ├── wagner-perfil.png    # Foto de perfil do autor exibida na página sobre.html
│   └── avatar-default.svg   # Avatar SVG padrão de fallback
│
├── js/
│   └── main.js              # Tema Claro/Escuro, preview de foto, máscaras, validação de CPF e filtro
│
├── uploads/                 # Diretório de armazenamento das fotos enviadas pelo formulário
│
├── index.html               # Página inicial (Landing page e apresentação das camadas)
├── cadastro.html            # Página de cadastro com upload de imagem, redes sociais e validações
├── sobre.html               # Documentação acadêmica do projeto e perfil do aluno
│
├── db.php                   # Camada de conexão PDO e inicialização/migração automática do banco
├── processa_cadastro.php    # Controlador de recebimento POST, upload de foto, sanitização e persistência
├── listar.php               # Listagem dinâmica PHP com foto, badges de redes sociais e busca reativa
├── excluir.php              # Script PHP para exclusão segura de registros por ID
│
├── database.sql             # Script SQL opcional para uso com MySQL / phpMyAdmin
├── database.sqlite          # Banco de dados relacional SQLite (gerado automaticamente na execução)
└── README.md                # Manual do projeto e documentação acadêmica
```

---

## 🚀 Como Executar o Projeto

O projeto utiliza **SQLite via PDO** para garantir **portabilidade imediata (Zero-Configuração)**: ao executar a aplicação, a base `database.sqlite` e a tabela `desenvolvedores` são criadas automaticamente sem exigir configuração manual de usuário/senha de banco de dados.

### 💡 Opção 1: Servidor Embutido do PHP (Recomendado e mais rápido)

1. Abra o terminal (PowerShell, CMD ou Bash) dentro da pasta do projeto:
   ```bash
   cd "e:\Faculdade_ADS\Introducao_Programacao_De_Computadores\Desenv. Web em Html5, Css, Javascript e Php"
   ```
2. Inicie o servidor PHP nativo:
   ```bash
   php -S 127.0.0.1:8000
   ```
3. Abra seu navegador e acesse:
   ```text
   http://127.0.0.1:8000
   ```

---

### 💡 Opção 2: Via XAMPP / Laragon / WampServer

1. Copie toda a pasta do projeto para o diretório raiz do seu servidor local:
   - No **XAMPP**: `C:\xampp\htdocs\devpoint-ads`
   - No **Laragon**: `C:\laragon\www\devpoint-ads`
2. Inicie o **Apache** pelo painel do servidor.
3. Acesse pelo navegador:
   ```text
   http://localhost/devpoint-ads/
   ```
4. *(Opcional)* Se desejar utilizar **MySQL** em vez de SQLite:
   - Abra `db.php` e altere `define('DB_DRIVER', 'mysql');`.
   - No phpMyAdmin, importe o arquivo `database.sql` incluído na pasta.

---

## 🛡️ Destaques Técnicos e Funcionalidades

1. **Tema Claro e Escuro Completo (`css/style.css` + `js/main.js`):**
   - Alternância instantânea entre modo Claro e Escuro pelo botão no cabeçalho de todas as páginas.
   - Persistência da preferência em `localStorage` (`devpoint-theme`), detecção automática do sistema operacional (`prefers-color-scheme`) e inicialização no `<head>` para evitar flashes visuais na troca de páginas.

2. **Upload de Foto de Perfil com Pré-visualização:**
   - No formulário (`cadastro.html`), o JavaScript lê a imagem via `FileReader`, valida formato (`JPG`, `PNG`, `WEBP`) e tamanho (máximo 2 MB) e exibe o preview instantâneo.
   - No back-end (`processa_cadastro.php`), o PHP valida novamente o arquivo e o armazena em `uploads/` com nome único.

3. **Segurança em Camadas (Front-End + Back-End):**
   - **Client-Side:** JavaScript aplica máscaras dinâmicas de telefone e CPF, contador de caracteres da biografia e cálculo matemático oficial dos dígitos verificadores do CPF (módulo 11).
   - **Server-Side:** O PHP valida e sanitiza todas as entradas (`filter_input`, `htmlspecialchars`, `trim`) e utiliza **Prepared Statements** no PDO, prevenindo ataques XSS e SQL Injection.

4. **Listagem Dinâmica e Pesquisa Reativa (`listar.php`):**
   - Exibe avatar, dados formatados, links diretos das redes sociais (LinkedIn, Instagram, YouTube, X), competências técnicas, data de cadastro e exclusão segura com confirmação.
   - Campo de busca instantânea em JavaScript filtra registros em tempo real sem recarregar a página.

5. **Redes Sociais e Portfólio no Rodapé:**
   - Ícones vetoriais SVG oficiais para **LinkedIn**, **Instagram**, **YouTube**, **X** e **TikTok**, além de link direto no nome do autor para o portfólio no GitHub.

---

## 👨‍💻 Dados de Envio para a Professora no SAVA

- **Aluno:** Wagner Pessoa
- **Matrícula:** 2026 0178 4633
- **Curso:** Tecnologia em Análise e Desenvolvimento de Sistemas (ADS) — 2º Período
- **Disciplina:** Desenvolvimento Web em HTML5, CSS, JavaScript e PHP (2026-2)
- **Data da Entrega:** Até 24/11/2026
- **Ambiente Testado:** PHP 8.3.33 + Navegadores modernos (Google Chrome, Firefox, Microsoft Edge)
