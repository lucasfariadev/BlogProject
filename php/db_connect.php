<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "usuarios";

// Função para iniciar a conexão com o banco de dados
function conectarBancoDados()
{
    global $servername, $db_username, $db_password, $dbname;
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    return $conn;
}

// Função para fechar a conexão com o banco de dados
function fecharConexao($conn)
{
    $conn->close();
}

// Função para inserir um novo usuário
function inserirUsuario($username, $password)
{
    $conn = conectarBancoDados();
    $sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        fecharConexao($conn);
        return true;
    } else {
        fecharConexao($conn);
        return false;
    }
}

// Restante do código...




// Função para buscar um usuário pelo ID
function buscarUsuario($usuario_id)
{
    $conn = conectarBancoDados();
    $sql = "SELECT * FROM usuarios WHERE usuario_id = $usuario_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return false;
    }
}

// Função para atualizar os dados de um usuário
function atualizarUsuario($usuario_id, $username, $password)
{
    $conn = conectarBancoDados();
    $sql = "UPDATE usuarios SET username = '$username', password = '$password' WHERE usuario_id = $usuario_id";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Função para excluir um usuário
function excluirUsuario($usuario_id)
{
    $conn = conectarBancoDados();
    $sql = "DELETE FROM usuarios WHERE usuario_id = $usuario_id";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Função para inserir uma nova postagem
function inserirPostagem($titulo, $conteudo, $caminho_imagem, $data_publicacao, $usuario_id)
{
    $conn = conectarBancoDados();
    $sql = "INSERT INTO postagens (titulo, conteudo, caminho_imagem, data_publicacao, usuario_id) VALUES ('$titulo', '$conteudo', '$caminho_imagem', '$data_publicacao', $usuario_id)";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Função para buscar uma postagem pelo ID
function buscarPostagem($id_postagem)
{
    $conn = conectarBancoDados();
    $sql = "SELECT * FROM postagens WHERE id_postagem = $id_postagem";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return false;
    }
}


function buscarPostagens($userId)
{
    $conn = conectarBancoDados();
    $sql = "SELECT postagens.*, usuarios.username 
    FROM postagens 
    LEFT JOIN usuarios ON postagens.usuario_id = usuarios.usuario_id 
    WHERE postagens.usuario_id = $userId
    ORDER BY postagens.data_publicacao DESC";

    $result = $conn->query($sql);

    fecharConexao($conn);
    return $result;
}

// Função para atualizar os dados de uma postagem
function atualizarPostagem($id_postagem, $titulo, $conteudo, $caminho_imagem, $data_publicacao, $usuario_id)
{
    $conn = conectarBancoDados();
    $sql = "UPDATE postagens SET titulo = '$titulo', conteudo = '$conteudo', caminho_imagem = '$caminho_imagem', data_publicacao = '$data_publicacao', usuario_id = $usuario_id WHERE id_postagem = $id_postagem";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Função para excluir uma postagem
function excluirPostagem($id_postagem)
{
    $conn = conectarBancoDados();
    $sql = "DELETE FROM postagens WHERE id_postagem = $id_postagem";

    if ($conn->query($sql) === TRUE) {
        return true;

    } else {
        return false;
    }
}


// Fecha a conexão com o banco de dados

?>