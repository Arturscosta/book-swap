<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Livros Disponíveis para Troca</h1>
    </div>
</div>

<div class="row">
    <?php if (empty($livros)): ?>
        <div class="col-12">
            <div class="alert alert-info">
                Nenhum livro disponível para troca no momento.
            </div>
        </div>
    <?php else: ?>
        <?php foreach ($livros as $livro): ?>
            <div class="col-md-4">
                <div class="card livro-card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($livro->getTitulo()); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($livro->getAutor()); ?></h6>
                        <p class="card-text">
                            <strong>Editora:</strong> <?php echo htmlspecialchars($livro->getEditora()); ?><br>
                            <strong>Ano:</strong> <?php echo htmlspecialchars($livro->getAno()); ?><br>
                            <strong>Condição:</strong> <?php echo htmlspecialchars($livro->getCondicao()); ?>
                        </p>
                        <p class="card-text"><?php echo htmlspecialchars($livro->getDescricao()); ?></p>
                        <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] != $livro->getUsuarioId()): ?>
                            <a href="/troca/propor/<?php echo $livro->getId(); ?>" class="btn btn-primary">
                                Propor Troca
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php if (isset($_SESSION['usuario_id'])): ?>
    <div class="row mt-4">
        <div class="col-12 text-center">
            <a href="/livro/cadastrar" class="btn btn-success">
                Cadastrar Novo Livro
            </a>
        </div>
    </div>
<?php endif; ?> 