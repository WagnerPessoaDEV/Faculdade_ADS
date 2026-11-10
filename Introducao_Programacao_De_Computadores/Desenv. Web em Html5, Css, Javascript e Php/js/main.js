/**
 * ==============================================================================
 * PROJETO: Sistema de Gestão de Desenvolvedores (DevPoint ADS)
 * DISCIPLINA: Desenvolvimento Web em HTML5, CSS, JavaScript e PHP (2026-2)
 * AUTOR: Wagner Pessoa (Matrícula: 2026 0178 4633) - ADS
 * ARQUIVO: js/main.js
 * CONCEITO: Validações dinâmicas, máscaras em tempo real e manipulação do DOM
 * ==============================================================================
 */

document.addEventListener('DOMContentLoaded', () => {
    initThemeToggle();
    initMascaraTelefone();
    initMascaraCPF();
    initContadorCaracteres();
    initValidacaoFormulario();
    initFiltroTabela();
    initAlertDismiss();
    initPreviewFoto();
});

/**
 * Gerencia o tema Claro/Escuro em todo o sistema com persistência em localStorage
 */
function initThemeToggle() {
    const STORAGE_KEY = 'devpoint-theme';
    const root = document.documentElement;
    const toggleBtn = document.getElementById('theme-toggle');

    const getPreferredTheme = () => {
        const saved = localStorage.getItem(STORAGE_KEY);
        if (saved === 'light' || saved === 'dark') return saved;
        return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    };

    const renderToggleButton = (theme) => {
        if (!toggleBtn) return;
        const isDark = theme === 'dark';

        const sunIcon = '<svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>';
        const moonIcon = '<svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>';

        toggleBtn.innerHTML = isDark ? `${sunIcon}<span>Claro</span>` : `${moonIcon}<span>Escuro</span>`;
        toggleBtn.setAttribute('aria-pressed', String(isDark));
        toggleBtn.setAttribute('title', isDark ? 'Mudar para o tema claro' : 'Mudar para o tema escuro');
    };

    const applyTheme = (theme) => {
        root.setAttribute('data-theme', theme);
        renderToggleButton(theme);
    };

    applyTheme(getPreferredTheme());

    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            const current = root.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
            const next = current === 'dark' ? 'light' : 'dark';
            localStorage.setItem(STORAGE_KEY, next);
            applyTheme(next);
        });
    }

    if (window.matchMedia) {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (!localStorage.getItem(STORAGE_KEY)) {
                applyTheme(e.matches ? 'dark' : 'light');
            }
        });
    }
}

/**
 * Aplica máscara de telefone dinamicamente: (XX) XXXXX-XXXX ou (XX) XXXX-XXXX
 */
function initMascaraTelefone() {
    const telInput = document.getElementById('telefone');
    if (!telInput) return;

    telInput.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 11) value = value.slice(0, 11);

        if (value.length > 10) {
            // (11) 98765-4321
            value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
        } else if (value.length > 6) {
            // (11) 8765-4321
            value = value.replace(/^(\d{2})(\d{4})(\d{0,4})$/, '($1) $2-$3');
        } else if (value.length > 2) {
            value = value.replace(/^(\d{2})(\d{0,5})$/, '($1) $2');
        } else if (value.length > 0) {
            value = value.replace(/^(\d*)$/, '($1');
        }

        e.target.value = value;
    });
}

/**
 * Aplica máscara de CPF: 000.000.000-00
 */
function initMascaraCPF() {
    const cpfInput = document.getElementById('cpf');
    if (!cpfInput) return;

    cpfInput.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 11) value = value.slice(0, 11);

        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

        e.target.value = value;
    });

    // Validação ao perder o foco (blur)
    cpfInput.addEventListener('blur', () => {
        if (cpfInput.value.length === 0) return;
        const valido = validarAlgoritmoCPF(cpfInput.value);
        marcarCampo(cpfInput, valido, valido ? '' : 'CPF inválido no cálculo dos dígitos verificadores.');
    });
}

/**
 * Validação algorítmica oficial do CPF brasileiro (cálculo de módulo 11)
 * Conceito fundamental em Análise de Sistemas para garantir consistência de dados.
 */
function validarAlgoritmoCPF(cpfLimpo) {
    cpfLimpo = cpfLimpo.replace(/\D/g, '');

    if (cpfLimpo.length !== 11) return false;

    // Elimina CPFs conhecidos inválidos (ex: 111.111.111-11)
    if (/^(\d)\1{10}$/.test(cpfLimpo)) return false;

    // Validação do 1º dígito verificador
    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpfLimpo.charAt(i)) * (10 - i);
    }
    let resto = 11 - (soma % 11);
    let digito1 = (resto === 10 || resto === 11) ? 0 : resto;
    if (digito1 !== parseInt(cpfLimpo.charAt(9))) return false;

    // Validação do 2º dígito verificador
    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpfLimpo.charAt(i)) * (11 - i);
    }
    resto = 11 - (soma % 11);
    let digito2 = (resto === 10 || resto === 11) ? 0 : resto;
    if (digito2 !== parseInt(cpfLimpo.charAt(10))) return false;

    return true;
}

/**
 * Contador de caracteres em tempo real para a Biografia
 */
function initContadorCaracteres() {
    const bioInput = document.getElementById('bio');
    const counterDisplay = document.getElementById('bio-contador');
    if (!bioInput || !counterDisplay) return;

    const max = bioInput.getAttribute('maxlength') || 300;

    bioInput.addEventListener('input', () => {
        const atual = bioInput.value.length;
        counterDisplay.textContent = `${atual} / ${max} caracteres`;

        if (atual >= max) {
            counterDisplay.style.color = 'var(--danger)';
        } else {
            counterDisplay.style.color = 'var(--text-muted)';
        }
    });
}

/**
 * Validação completa do formulário antes do envio
 */
function initValidacaoFormulario() {
    const form = document.getElementById('form-cadastro');
    if (!form) return;

    const nome = document.getElementById('nome');
    const email = document.getElementById('email');
    const cpf = document.getElementById('cpf');
    const telefone = document.getElementById('telefone');
    const cargo = document.getElementById('cargo');
    const termos = document.getElementById('termos');

    // Validações em tempo real nos inputs individuais
    nome.addEventListener('input', () => {
        const valido = nome.value.trim().length >= 3;
        marcarCampo(nome, valido, valido ? '' : 'Nome deve conter ao menos 3 caracteres.');
    });

    email.addEventListener('input', () => {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const valido = emailRegex.test(email.value.trim());
        marcarCampo(email, valido, valido ? '' : 'Informe um endereço de e-mail válido.');
    });

    cargo.addEventListener('change', () => {
        const valido = cargo.value !== '';
        marcarCampo(cargo, valido, valido ? '' : 'Selecione uma especialidade/cargo.');
    });

    // Interceptação do submit
    form.addEventListener('submit', (e) => {
        let formValido = true;

        // 1. Validar Nome
        if (nome.value.trim().length < 3) {
            marcarCampo(nome, false, 'Informe o nome completo (mínimo 3 letras).');
            formValido = false;
        }

        // 2. Validar E-mail
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value.trim())) {
            marcarCampo(email, false, 'E-mail corporativo/acadêmico inválido.');
            formValido = false;
        }

        // 3. Validar CPF
        if (!validarAlgoritmoCPF(cpf.value)) {
            marcarCampo(cpf, false, 'Número de CPF inválido.');
            formValido = false;
        }

        // 4. Validar Telefone
        const foneLimpo = telefone.value.replace(/\D/g, '');
        if (foneLimpo.length < 10) {
            marcarCampo(telefone, false, 'Telefone incompleto. Preencha com DDD.');
            formValido = false;
        }

        // 5. Validar Cargo
        if (cargo.value === '') {
            marcarCampo(cargo, false, 'Por favor, selecione um cargo.');
            formValido = false;
        }

        // 6. Validar Nível (Radio)
        const nivelSelecionado = document.querySelector('input[name="nivel"]:checked');
        const feedbackNivel = document.getElementById('feedback-nivel');
        if (!nivelSelecionado) {
            if (feedbackNivel) feedbackNivel.textContent = 'Selecione um nível de senioridade.';
            formValido = false;
        } else if (feedbackNivel) {
            feedbackNivel.textContent = '';
        }

        // 7. Validar Termos
        if (!termos.checked) {
            const feedbackTermos = document.getElementById('feedback-termos');
            if (feedbackTermos) feedbackTermos.textContent = 'Você precisa aceitar os termos para prosseguir.';
            formValido = false;
        }

        // Se houver qualquer inconsistência, cancela o submit
        if (!formValido) {
            e.preventDefault();
            // Dá scroll até o primeiro campo inválido
            const primeiroInvalido = form.querySelector('.is-invalid');
            if (primeiroInvalido) {
                primeiroInvalido.scrollIntoView({ behavior: 'smooth', block: 'center' });
                primeiroInvalido.focus();
            }
        } else {
            // Prevenção de múltiplos cliques
            const btnSubmit = form.querySelector('button[type="submit"]');
            if (btnSubmit) {
                btnSubmit.disabled = true;
                btnSubmit.innerHTML = 'Gravando dados...';
            }
        }
    });
}

/**
 * Função utilitária para aplicar feedback visual no campo
 */
function marcarCampo(inputElement, valido, mensagemErro = '') {
    const feedbackId = `feedback-${inputElement.id}`;
    const feedbackEl = document.getElementById(feedbackId);

    if (valido) {
        inputElement.classList.remove('is-invalid');
        inputElement.classList.add('is-valid');
        if (feedbackEl) feedbackEl.textContent = '';
    } else {
        inputElement.classList.remove('is-valid');
        inputElement.classList.add('is-invalid');
        if (feedbackEl) feedbackEl.textContent = mensagemErro;
    }
}

/**
 * Filtro de pesquisa em tempo real na listagem de desenvolvedores (listar.php)
 */
function initFiltroTabela() {
    const inputBusca = document.getElementById('tabela-busca');
    const tabelaCorpo = document.getElementById('tabela-devs-corpo');
    const msgSemResultados = document.getElementById('sem-resultados');

    if (!inputBusca || !tabelaCorpo) return;

    inputBusca.addEventListener('input', () => {
        const termo = inputBusca.value.toLowerCase().trim();
        const linhas = tabelaCorpo.querySelectorAll('tr');
        let encontrados = 0;

        linhas.forEach(linha => {
            const textoLinha = linha.textContent.toLowerCase();
            if (textoLinha.includes(termo)) {
                linha.style.display = '';
                encontrados++;
            } else {
                linha.style.display = 'none';
            }
        });

        if (msgSemResultados) {
            msgSemResultados.style.display = (encontrados === 0 && linhas.length > 0) ? 'block' : 'none';
        }
    });
}

/**
 * Fechamento suave de mensagens flash de alerta
 */
function initAlertDismiss() {
    const closeButtons = document.querySelectorAll('.alert-close');
    closeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const alert = btn.closest('.alert');
            if (alert) {
                alert.style.transition = 'opacity 0.3s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }
        });
    });

    // Auto-fechar alertas de sucesso após 6 segundos
    const alertSuccess = document.querySelector('.alert-success');
    if (alertSuccess) {
        setTimeout(() => {
            alertSuccess.style.transition = 'opacity 0.4s ease';
            alertSuccess.style.opacity = '0';
            setTimeout(() => alertSuccess.remove(), 400);
        }, 6000);
    }
}

/**
 * Confirmação de exclusão segura
 */
function confirmarExclusao(id, nome) {
    if (confirm(`Tem certeza que deseja remover o cadastro de "${nome}"?\nEsta ação não poderá ser desfeita.`)) {
        window.location.href = `excluir.php?id=${encodeURIComponent(id)}`;
    }
}

/**
 * Pré-visualização instantânea da foto de perfil selecionada
 */
function initPreviewFoto() {
    const fotoInput = document.getElementById('foto');
    const avatarImg = document.getElementById('avatar-img');
    const avatarIcon = document.getElementById('avatar-icon');
    const btnRemover = document.getElementById('btn-remover-foto');

    if (!fotoInput || !avatarImg || !avatarIcon) return;

    fotoInput.addEventListener('change', () => {
        const file = fotoInput.files[0];
        if (!file) return;

        // Validação de tipo de arquivo
        if (!file.type.startsWith('image/')) {
            alert('Por favor, selecione apenas arquivos de imagem válidos (JPG, PNG ou WEBP).');
            fotoInput.value = '';
            return;
        }

        // Validação de tamanho (máximo 2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('A foto selecionada ultrapassa o limite de 2MB. Por favor, escolha uma imagem mais leve.');
            fotoInput.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            avatarImg.src = e.target.result;
            avatarImg.style.display = 'block';
            avatarIcon.style.display = 'none';
            if (btnRemover) btnRemover.style.display = 'inline-block';
        };
        reader.readAsDataURL(file);
    });

    if (btnRemover) {
        btnRemover.addEventListener('click', () => {
            fotoInput.value = '';
            avatarImg.src = '';
            avatarImg.style.display = 'none';
            avatarIcon.style.display = 'block';
            btnRemover.style.display = 'none';
        });
    }
}

