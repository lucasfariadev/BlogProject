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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <title>Postagens</title>
</head>

<body>



    <?php

    // Restante do código PHP
    $user = $_GET["username"]; // Substitua "exemplo" pelo username desejado
    // Consulta as postagens do banco de dados do usuário atual
    $sql = "SELECT usuario_id FROM usuarios WHERE username = '$user'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row["usuario_id"];
    }


    $result = buscarPostagens($userId);
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Cabeçalho HTML -->
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
                            <a class="nav-link" aria-current="page" href="principal.php?username=<?php echo urlencode($user); ?>">Principal</a>
                            <a class="nav-link" href="postagens_importante.php">Importante</a>
                            <a class="nav-link" href="postagens_programacao.php">Programacao</a>
                            <a class="nav-link" href="postagens_teste.php">Teste</a>

                        </div>
                    </div>
                </div>
            </nav>
           
            <div class="sair">
                <form action="../php/logout.php" method="POST">
                    <button type="submit" class="button-img">
                        <img src="../img/sair.png" alt="Sair">
                        <span>sair</span>
                    </button>

                </form>
            </div>

            </div>

        </header>

        <?php
        // Verifica se existem postagens
        $user = $_GET["username"];
        if ($result->num_rows > 0) {
            // Exibe as postagens
            while ($row = $result->fetch_assoc()) {
                // Exibir cada postagem individualmente
                echo "<section>";
                echo "<h2>" . $row["titulo"] . "</h2>";
                echo "<p>Autor: " . ($row["username"] ? $row["username"] : "Desconhecido") . "</p>";
                echo "<p>" . $row["conteudo"] . "</p>";

                // Verifica se a postagem possui imagem
                if ($row["caminho_imagem"]) {
                    echo "<img class='img_post' src='" . $row["caminho_imagem"] . "' alt='Imagem da Postagem'>";
                }

                echo "<p>Data de publicação: " . $row["data_publicacao"] . "</p>";
                echo "<div class='actions'>";
                echo "<a href='../php/editar_postagem.php?id=" . $row["id_postagem"] . "&username=" . urlencode($user) . "'><img class='pub_icon' src='../img/lapis.png'></a>";
                echo " | ";
                echo "<a href='postagens.php?excluir_id=" . $row["id_postagem"] . "&username=" . urlencode($user) . "'><img class='pub_icon' src='../img/lixeira.png'></a>";
                echo "<p>" . ($row["tag"] ? $row["tag"] : "N/A") . "</p>";
                echo "</div>";
                echo "<hr>";
                echo "</section>";

            }
        } else {
            echo "<p>Nenhuma postagem encontrada.</p>";
        }

        // Restante do código HTML
        ?>
        <section>
            <h3>Nova postagem</h3>
            <form action="../php/salvar_postagem.php?username=<?php echo urlencode($user); ?>" method="POST"
                enctype="multipart/form-data">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required><br><br>

                <label for="conteudo">Conteúdo:</label><br>
                <textarea id="conteudo" name="conteudo" required></textarea><br><br>

                <label for="tag">Tag:</label>
                <input type="text" id="tag" name="tag"><br><br>

                <label for="imagem">Imagem:</label>
                <input type="file" id="imagem" name="imagem"><br><br>

                <input type="submit" value="Salvar">
            </form>

        </section>
    </body>

    </html>