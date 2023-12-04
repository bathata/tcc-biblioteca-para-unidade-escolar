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
    <title>Confirmação de Devolução</title>
    <script>
        function fecharJanela() {
            window.close(); // Fecha a janela atual
            window.opener.location.reload(); // Atualiza a página anterior
        }
    </script>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        #confirmation-info {
            text-align: center;
            color: white;
            background-color: rgba(0, 0, 0, 0.3);
            padding: 15px;
            border-radius: 15px;
            width: 30%;
            margin: 30px;
        }

        form {
            text-align: center;
            color: white;
            background-color: rgba(0, 0, 0, 0.3);
            padding: 15px;
            border-radius: 15px;
            width: 30%;
        }

        label {
            margin-top: 10px;
            display: block;
        }

        input[type="submit"] {
            background-image: linear-gradient(to right, rgb(0, 92, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            margin-top: 15px;
        }

        input[type="submit"]:hover {
            background-image: linear-gradient(to right, rgb(0, 80, 172), rgb(80, 19, 195));
        }

        a {
            text-decoration: none;
            color: white;
            border: 3px solid blue;
            border-radius: 10px;
            padding: 10px;
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        a:hover {
            background-color: dodgerblue;
            color: black;
        }
    </style>
</head>
<body>
<?php
    if (isset($_POST['id_emprest'])) {
        $id_emprest = $_POST['id_emprest'];

        // Recuperar informações do empréstimo usando prepared statement
        $sql = "SELECT * FROM emprestimo WHERE id_emprest = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id_emprest);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $emprestimo = $result->fetch_assoc();

            // Recuperar informações do aluno
            $aluno_id = $emprestimo['ra_dig'];
            $sql_aluno = "SELECT * FROM usuario WHERE ra_dig = ?";
            $stmt_aluno = $conexao->prepare($sql_aluno);
            $stmt_aluno->bind_param("i", $aluno_id);
            $stmt_aluno->execute();
            $result_aluno = $stmt_aluno->get_result();

            if ($result_aluno->num_rows > 0) {
                $aluno = $result_aluno->fetch_assoc();

                // Exibir informações do empréstimo e do aluno
                echo "<div id='confirmation-info'>";
                echo "<h1>Confirmação de Devolução</h1>";
                echo "<p><strong>Nome do Aluno:</strong> " . $aluno['nome'] . " " . $aluno['sobrenome'] . "</p>";
                echo "<p><strong>R.A. do Aluno:</strong> " . $aluno['ra_dig'] . "</p>";
                echo "<p><strong>Título do Livro:</strong> " . $emprestimo['titulo_livro'] . "</p>";
                echo "<p><strong>Data do Empréstimo:</strong> " . date('d/m/Y H:i:s', strtotime($emprestimo['data_emprest'])) . "</p>";
                echo "<p><strong>Data para Devolução:</strong> " . date('d/m/Y H:i:s', strtotime($emprestimo['data_devolver'])) . "</p>";
                echo "</div>";

                // Adicionar botão de confirmação de devolução
                echo "
                    <form action='devolver.php' method='POST' id='formDevolucao' onsubmit='confirmarDevolucao()'>
                        <input type='hidden' name='id_emprest' value='$id_emprest' />
                        <input type='submit' value='Confirmar Devolução'>
                        <a href='javascript:void(0);' onclick='fecharJanela();'>Voltar</a>
                    </form>
                ";
            } else {
                echo "Erro ao recuperar informações do aluno.";
            }
        } else {
            echo "Erro ao recuperar informações do empréstimo.";
        }
    } else {
        echo "ID de empréstimo não fornecido.";
    }
?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function confirmarDevolucao() {
            var formData = $('#formDevolucao').serialize();
            $.ajax({
                type: 'POST',
                url: 'devolver.php',
                data: formData,
                success: function(response) {
                    alert("Devolução confirmada com sucesso!");
                    // Recarrega a página anterior
                    if (window.opener) {
                        window.opener.location.reload();
                    }
                    // Fecha a aba atual
                    window.close();
                },
                error: function(error) {
                    alert("Erro ao processar a devolução.");
                }
            });
            return false;
        }
    </script>
</body>
</html>