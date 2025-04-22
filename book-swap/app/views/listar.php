<!DOCTYPE html>
<html>
<head>
    <title>Lista de Livros</title>
    <link rel="stylesheet" type="text/css" href="/book-swap/public/style.css">
</head>
<body>
    <header>
        <h1>Book Swap</h1>
    </header>
    <div>
        <h2>Adicione um livro!</h2>
        <form action="index.php" method="post">
            <p>Título</p>
            <input class="input-text" type="text" name="titulo">
            <p>Autor</p>
            <input class="input-text" type="text" name="autor"><br><br>
            <input class="input-submit" type="submit" name="Cadastrar Livro">
        </form>
    </div>
    <h2>Livros Disponíveis</h2>
    <ul>
        <?php foreach ($livros as $livro): ?>
            <li>Livro: <?= $livro['titulo'] ?> <br>Autor: <?= $livro['autor'] ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>