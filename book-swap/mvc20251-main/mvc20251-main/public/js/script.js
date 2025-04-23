// Função para confirmar ações importantes
function confirmarAcao(mensagem) {
    return confirm(mensagem);
}

// Função para exibir mensagens de erro
function exibirErro(mensagem) {
    const divErro = document.createElement('div');
    divErro.className = 'alert alert-danger';
    divErro.textContent = mensagem;
    
    const container = document.querySelector('.container');
    container.insertBefore(divErro, container.firstChild);
    
    setTimeout(() => {
        divErro.remove();
    }, 5000);
}

// Função para exibir mensagens de sucesso
function exibirSucesso(mensagem) {
    const divSucesso = document.createElement('div');
    divSucesso.className = 'alert alert-success';
    divSucesso.textContent = mensagem;
    
    const container = document.querySelector('.container');
    container.insertBefore(divSucesso, container.firstChild);
    
    setTimeout(() => {
        divSucesso.remove();
    }, 5000);
}

// Função para validar formulários
function validarFormulario(form) {
    const inputs = form.querySelectorAll('input[required], textarea[required]');
    let valido = true;
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('is-invalid');
            valido = false;
        } else {
            input.classList.remove('is-invalid');
        }
    });
    
    return valido;
}

// Adiciona validação em tempo real para campos obrigatórios
document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input[required], textarea[required]');
        
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                if (input.value.trim()) {
                    input.classList.remove('is-invalid');
                }
            });
        });
        
        form.addEventListener('submit', (e) => {
            if (!validarFormulario(form)) {
                e.preventDefault();
                exibirErro('Por favor, preencha todos os campos obrigatórios.');
            }
        });
    });
}); 