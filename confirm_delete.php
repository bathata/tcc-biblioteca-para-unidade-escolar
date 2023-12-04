<?php
session_start();
include_once('conexao.php');

if (!isset($_SESSION['email'])) {
    header('Location: login_admin.php');
    exit();
}

if (isset($_GET['id_livro'])) {
    $id_livro = $_GET['id_livro'];
    $sql = "SELECT * FROM biblio_estoque WHERE id_livro = $id_livro";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $livro_data = $result->fetch_assoc();
    } else {
        echo "Livro não encontrado.";
        exit();
    }
} else {
    echo "ID do livro não fornecido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <title>Confirmar Exclusão</title>
    <script>
        function fecharJanela() {
            window.close(); // Fecha a janela atual
            window.opener.location.reload(); // Atualiza a página anterior
        }
        function confirmarExclusao() {
            var confirmacao = confirm("Tem certeza de que deseja excluir o livro?");
            if (confirmacao) {
                window.opener.location.reload(); // Atualiza a página anterior
                window.close(); // Fecha a janela atual
            }
        }
    </script>
    <style>
        body {
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            color: white;
            text-align: center;
        }

        .confirmation-box {
            margin-top: 50px;
            padding: 20px;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px;
        }

        .btn-confirm {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="confirmation-box">
            <h2>Confirmar Exclusão</h2>
            <p>Tem certeza de que deseja excluir o livro?</p>
            <p><strong>Cód.:</strong> <?php echo $livro_data['id_livro']; ?></p>
            <p><strong>Título:</strong> <?php echo $livro_data['titulo_livro']; ?></p>
            <p><strong>Autor:</strong> <?php echo $livro_data['autor_livro']; ?></p>
            <p><strong>Gênero:</strong> <?php echo $livro_data['genero_livro']; ?></p>
            <p><strong>Quantidade disponível:</strong> <?php echo $livro_data['qtd_livro']; ?></p>
            <form action="delete.php" method="post">
            <input type="hidden" name="id_livro" value="<?php echo $livro_data['id_livro']; ?>">
            <button type="submit" class="btn btn-danger btn-confirm">Confirmar</button>
            <a href="javascript:void(0);" class="btn btn-secondary btn-confirm" onclick="fecharJanela();">Cancelar</a>
        </form>
        </div>
    </div>
</body>
</html>
