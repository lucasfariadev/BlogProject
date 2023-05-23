<?php
require_once('db_connect.php');

// Verifica se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Função para autenticar o usuário
    function autenticarUsuario($conn, $username, $password) {
        $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);
        
        if ($result->num_rows == 1) {
            // Usuário autenticado com sucesso
            return true;
        } else {
            // Falha na autenticação do usuário
            return false;
        }
    }
    
    // Conecta ao banco de dados
    $conn = conectarBancoDados();
    
    // Autentica o usuário
    if (autenticarUsuario($conn, $username, $password)) {
        // Usuário autenticado com sucesso
        session_start();
        $_SESSION['logged_in'] = true;

        header("Location: ../pages/principal.php?username=" . urlencode($username));

        // exit();
    } else {
        // Falha na autenticação do usuário
        echo "Usuário ou senha inválidos!";
    }
    
    // Fecha a conexão com o banco de dados
    fecharConexao($conn);
}
?>
