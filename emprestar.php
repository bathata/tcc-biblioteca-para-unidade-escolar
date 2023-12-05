<?php
session_start();
include_once('conexao.php');
date_default_timezone_set('America/Sao_Paulo'); // Substitua 'America/Sao_Paulo' pelo fuso horário desejado
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimo de Livro</title>
    <script>
        function fecharJanela() {
            window.close(); // Fecha a janela atual
            window.opener.location.reload(); // Atualiza a página anterior
        }
    </script>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image:  linear-gradient(to left, #7a60ff, #cd9ffa);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        #book-info {
            text-align: center;
            color: white;
            background-color:#9c8ccc;
            padding: 15px;
            border-radius: 15px;
            width: 30%;
            margin: 30px;
            border:3px solid #440f7d ;
        }

        form {
            color: white;
            background-color: rgba(0, 0, 0, 0.3);
            padding: 15px;
            border-radius: 15px;
            width: 30%;
            border:3px solid #440f7d ;
        }

        label {
            margin-top: 10px;
            display: block;
        }

        select {
            width: 99%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid white;
            border-radius: 5px;
            background: none;
            background: rgba(255, 255, 255, 0.5); /* Cor de fundo do select */
            color: white;
            outline: none;
        }

        input[type="date"] {
            width: 95%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid white;
            border-radius: 5px;
            background: none;
            background: rgba(255, 255, 255, 0.5); /* Cor de fundo do select */
            color: black;
            outline: none;
        }

        input[type="submit"] {
            background-color:#8466fb;
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }

        input[type="submit"]:hover {
            background-color: #9c7cfc;
        }

        a {
            text-decoration: none;
            color: white;
            border: 3px solid black;
            border-radius: 10px;
            padding: 10px;
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        a:hover {
            background-color:#8466fb;
            color: black;
        }
    </style>
</head>
<body>
    <?php
    if (isset($_GET['id_livro'])) {
        $id_livro = $_GET['id_livro'];

        // Recuperar informações do livro
        $sql_livro = "SELECT * FROM biblio_estoque WHERE id_livro = '$id_livro'";
        $result_livro = $conexao->query($sql_livro);

        if ($result_livro->num_rows > 0) {
            $livro = mysqli_fetch_assoc($result_livro);
    ?>
            <div id="book-info">
                <h2>Livro Selecionado:</h2>
                <h2><?php echo $livro['titulo_livro']; ?></h2>
                <p>Cód.: <?php echo $livro['id_livro']; ?></p>
                <p>Autor: <?php echo $livro['autor_livro']; ?></p>
                <p>Gênero: <?php echo $livro['genero_livro']; ?></p>
                <p>Quantidade disponível: <?php echo $livro['qtd_livro']; ?></p>
            </div>

            <form method='post' action='processar_emprestimo.php'>
                <input type='hidden' name='id_livro' value='<?php echo $id_livro; ?>'>
                <label for='id_aluno'>Selecione o Aluno:</label>
                <select name='id_aluno'>
                    <?php
                    // Recuperar a lista de alunos para permitir a seleção manual
                    $sql_alunos = "SELECT * FROM usuario";
                    $result_alunos = $conexao->query($sql_alunos);

                    while ($aluno = mysqli_fetch_assoc($result_alunos)) {
                        echo "<option value='{$aluno['id_aluno']}'>{$aluno['nome']} {$aluno['sobrenome']} (RA: {$aluno['ra_dig']})</option>";
                    }
                    ?>
                </select>
                <br>
                <label for='data_devolver'>Data de Devolução:</label>
                <input type='date' name='data_devolver' required>
                <br>
                <input type='submit' value='Confirmar Empréstimo'>
                <br>
                <a href="javascript:void(0);" onclick="fecharJanela();">Cancelar</a>
            </form>
    <?php
        } else {
            echo "Livro não encontrado.";
        }
    } else {
        // Redirecionar ou exibir mensagem de erro se o id_livro não estiver presente
        header('Location: lista_livros.php?error=1');
    }
    ?>
</body>
</html>
