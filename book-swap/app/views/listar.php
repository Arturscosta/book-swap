<!DOCTYPE html>
<html>
<head>
    <title>Lista de Livros</title>
</head>
<body>
    <form action="index.php" method="post">
        <p>Título</p>
        <input type="text" name="titulo">
        <p>Autor</p>
        <input type="text" name="autor"><br><br>
        <input type="submit" name="Cadastrar Livro">
    </form>
    <h1>Livros Disponíveis</h1>
    <ul>
        <?php foreach ($livros as $livro): ?>
            <li><?= $livro['titulo'] ?> - <?= $livro['autor'] ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>