<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Cadastrar Novo Livro</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-container">
            <form method="POST" action="/livro/cadastrar">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título *</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                </div>

                <div class="mb-3">
                    <label for="autor" class="form-label">Autor *</label>
                    <input type="text" class="form-control" id="autor" name="autor" required>
                </div>

                <div class="mb-3">
                    <label for="editora" class="form-label">Editora</label>
                    <input type="text" class="form-control" id="editora" name="editora">
                </div>

                <div class="mb-3">
                    <label for="ano" class="form-label">Ano de Publicação</label>
                    <input type="number" class="form-control" id="ano" name="ano" min="1900" max="<?php echo date('Y'); ?>">
                </div>

                <div class="mb-3">
                    <label for="condicao" class="form-label">Condição do Livro</label>
                    <select class="form-select" id="condicao" name="condicao">
                        <option value="Novo">Novo</option>
                        <option value="Seminovo">Seminovo</option>
                        <option value="Usado">Usado</option>
                        <option value="Bem usado">Bem usado</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="4"></textarea>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Cadastrar Livro</button>
                    <a href="/livro/meus-livros" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div> 