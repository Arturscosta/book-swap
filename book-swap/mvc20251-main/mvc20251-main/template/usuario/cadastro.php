<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Cadastro de Usuário</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="form-container">
            <form method="POST" action="/usuario/cadastro">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome *</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha *</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>

                <div class="mb-3">
                    <label for="endereco" class="form-label">Endereço</label>
                    <textarea class="form-control" id="endereco" name="endereco" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="tel" class="form-control" id="telefone" name="telefone">
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                    <a href="/usuario/login" class="btn btn-link">Já tem uma conta? Faça login</a>
                </div>
            </form>
        </div>
    </div>
</div> 