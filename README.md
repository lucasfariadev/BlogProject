# Blog Project

Este é um projeto de blog desenvolvido em PHP, HTML, CSS, Bootstrap, JavaScript e MySQL. O objetivo deste projeto é permitir que os usuários criem, visualizem, editem e excluam publicações no blog. O projeto inclui um banco de dados com as tabelas usuarios e postagens, onde os usuários podem se cadastrar, fazer login e interagir com as postagens.

## Configuração do Banco de Dados

Para que o projeto funcione corretamente, é necessário configurar as informações do banco de dados. No arquivo db_connect.php, você encontrará as configurações necessárias para se conectar ao banco de dados. Certifique-se de inserir as informações corretas do seu banco de dados, como nome do host, nome de usuário, senha e nome do banco de dados.

## Estrutura do Banco de Dados

O banco de dados deste projeto contém duas tabelas principais:

### Tabela usuarios

    usuario_id: identificador único do usuário (chave primária)
    username: nome de usuário
    password: senha do usuário

### Tabela postagens

    id_postagem: identificador único da postagem (chave primária)
    titulo: título da postagem
    conteudo: conteúdo da postagem
    caminho_imagem: caminho da imagem associada à postagem
    data_publicacao: data de publicação da postagem
    tag: tag da postagem
    usuario_id: identificador do usuário que criou a postagem (chave estrangeira)

## Páginas e Funcionalidades

O projeto inclui as seguintes páginas e funcionalidades:

### Página inicial

    Exibe todas as publicações do blog, permitindo que qualquer pessoa visualize as postagens.

### Página de login

    Permite que os usuários cadastrados façam login na plataforma.

### Página de cadastro

    Permite que novos usuários se cadastrem no blog.

### Página de criação de postagem

    Apenas usuários logados podem acessar essa página.
    Permite que os usuários criem novas postagens, fornecendo um título, conteúdo, imagem, tag e data de publicação.

### Página de edição de postagem

    Apenas o autor da postagem pode acessar essa página.
    Permite que o autor edite uma postagem existente, atualizando o título, conteúdo, imagem, tag e data de publicação.

O projeto utiliza PHP, HTML, CSS, Bootstrap, JavaScript e MySQL. Além disso, há alguns prints de tela disponíveis para visualização no projeto.