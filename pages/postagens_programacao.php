<?php
include 'funcoes_postagem.php';

// Verifica se o usuário está logado
// Coloque aqui a lógica para verificar a autenticação do usuário e obter o ID do usuário logado

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Postagens</title>
< <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <title>Postagens</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Postagens</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link disabled" href="#">Principal</a>
                        <a class="nav-link" href="postagens_importante.php">Importante</a>
                        <a class="nav-link active" href="postagens_programacao.php">Programacao</a>
                        <a class="nav-link" href="postagens_teste.php">Teste</a>

                    </div>
                </div>
            </div>
        </nav>
        <div class="sair">
            <form action="../php/logout.php" method="POST">
                <button type="submit" class="button-img">
                <img src="../img/entrar.png" alt="login">
                    <span>Entrar</span>
                </button>
            </form>
        </div>
    </header>



    <?php
    // Consulta todas as postagens do banco de dados
    $result = buscarProgramacao();

    if ($result->num_rows > 0) {
        // Exibe as postagens
        while ($row = $result->fetch_assoc()) {
            // Exibir cada postagem individualmente
            echo "<section>";

            echo "<h4>" . $row["titulo"] . "</h4>";
            echo "<p>Autor: " . ($row["username"] ? $row["username"] : "Desconhecido") . "</p>";
            echo "<p>" . $row["conteudo"] . "</p>";

            // Verifica se a postagem possui imagem
            if ($row["caminho_imagem"]) {
                echo "<img class='img_post' src='" . $row["caminho_imagem"] . "' alt='Imagem da Postagem'>";
            }

            echo "<p>Data de publicação: " . $row["data_publicacao"] . "</p>";
            echo "<p>Tag: " . ($row["tag"] ? $row["tag"] : "N/A") . "</p>";

            echo "<hr>";
            echo "</section>";
        }
    } else {
        echo "<section>";
        echo "<p>Nenhuma postagem encontrada.</p>";
        echo "</section>";    }
    ?>


</body>

</html>