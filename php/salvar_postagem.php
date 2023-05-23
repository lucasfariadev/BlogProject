<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios";

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION["logged_in"])) {
    // Redireciona para a página de login ou exibe uma mensagem de erro
    header("Location: login.php");
    exit;
}

// Obtém o nome de usuário do usuário logado
$user = $_GET["username"];
$escapedUser = $conn->real_escape_string($user);
$sql = "SELECT usuario_id FROM usuarios WHERE username = '$escapedUser'";
$result = $conn->query($sql);


if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $usuario_id = $row["usuario_id"];

}
// Obtém os valores enviados pelo formulário
$titulo = $_POST["titulo"];
$conteudo = $_POST["conteudo"];
$tag = $_POST["tag"];


// Verifica se um novo arquivo de imagem foi enviado
if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
    $imagem = $_FILES["imagem"]["name"];
    $diretorioDestino = "../bancoImagens/" . $imagem;

    // Move o novo arquivo enviado para o diretório de destino
    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $diretorioDestino)) {
        // O novo arquivo foi enviado com sucesso, agora você pode inserir a postagem no banco de dados
        $sql = "INSERT INTO postagens (titulo, conteudo, usuario_id, caminho_imagem, tag) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssiss', $titulo, $conteudo, $usuario_id, $diretorioDestino, $tag);

        if ($stmt->execute()) {
            echo "Postagem criada com sucesso!";
            // Redireciona para a página de postagens
            header("Location: ../pages/postagens.php?username=" . urlencode($user));
            exit;
        } else {
            echo "Erro ao criar a postagem: " . $stmt->error;
        }
    } else {
        // Ocorreu um erro ao mover o novo arquivo para o diretório de destino
        echo "Erro ao fazer upload da imagem.";
    }
} else {
    // Nenhum arquivo de imagem foi enviado
    $sql = "INSERT INTO postagens (titulo, conteudo, usuario_id, tag) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $titulo, $conteudo, $usuario_id, $tag);

    if ($stmt->execute()) {
        echo "Postagem criada com sucesso!";
        // Redireciona para a página de postagens
        header("Location: ../pages/postagens.php?username=" . urlencode($user));
        exit;
    } else {
        echo "Erro ao criar a postagem: " . $stmt->error;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
