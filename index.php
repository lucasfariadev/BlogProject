<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="css/login.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>Document</title>
</head>

<body>
    <?php
    session_start();

    if (isset($_SESSION['logged_in'])) {
        // Redirecionar para a página de login ou exibir mensagem de erro
        header("Location: pages/principal.php");
    }

    ?>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="img/user.png" id="icon" alt="User Icon" />
            </div>
            <h2>Tela de Login</h2>
            <form action="php/login.php" method="POST">
                <label for="username"></label>
                <input type="text" id="username" name="username" class="fadeIn second" placeholder="username" required><br><br>

                <label for="password"></label>
                <input type="password" id="password" name="password" class="fadeIn third" placeholder="password" required><br><br>

                <input type="submit" class="fadeIn fourth" value="Entrar">
            </form>

            <br>
            <p>Ainda não possui uma conta?</p>
            <a href="pages/cadastro.html" class="fadeIn fifth"><button>Cadastrar</button></a>
        </div>
    </div>

</body>

</html>