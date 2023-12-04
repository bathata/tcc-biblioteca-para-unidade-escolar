<?php
session_start();
include_once('conexao.php');

if (isset($_POST['submit']) && !empty($_POST['email'])) {
    $email = $_POST['email'];

    // Busque as informações do aluno no banco de dados
    $sql = "SELECT nome, sobrenome, ra_dig FROM usuario WHERE email = '$email'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $aluno = $result->fetch_assoc();
        echo "<div class='login'>";
        // Exiba as informações do aluno
        echo "<h2>Informações do Aluno</h2>";
        echo "<p>Nome: {$aluno['nome']}</p>";
        echo "<p>Sobrenome: {$aluno['sobrenome']}</p>";
        echo "<p>R.A.: {$aluno['ra_dig']}</p>";
        
        // Adicione um link para permitir a atualização da senha
        echo "<a href='atualizar_senha.php?ra_dig={$aluno['ra_dig']}'>Atualizar Senha</a>";
        echo "<a href='javascript:void(0);' onclick='fecharJanela();'>Voltar</a>";
        echo "</div>";
    } else {
        echo "<p>E-mail não encontrado. Verifique se o e-mail está correto.</p>";
    }
}
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <title>Atualizar Senha</title>
        <script>
            function fecharJanela() {
                window.close(); // Fecha a janela atual
                window.opener.location.reload(); // Atualiza a página anterior
            }
        </script>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            .login {
                background-color: rgba(0, 0, 0, 0.6);
                position: relative;
                padding: 80px;
                border-radius: 15px;
                color: #fff;
                box-sizing: border-box;
                text-align: center;
            }

            input {
                padding: 15px;
                border: none;
                outline: none;
                font-size: 15px;
                width: 90%;
                margin-bottom: 20px; /* Espaçamento entre os inputs */
            }

            .inputSubmit {
                background-color: dodgerblue;
                border: none;
                padding: 15px;
                width: 100%;
                border-radius: 10px;
                color: white;
                font-size: 15px;
            }

            .inputSubmit:hover {
                background-color: deepskyblue;
                cursor: pointer;
            }

            a {
                text-decoration: none;
                color: white;
                border: 3px solid blue;
                border-radius: 10px;
                padding: 10px;
                display: block;
                margin-top: 10px;
            }

            a:hover {
                background-color: dodgerblue;
                color: black;
            }
        </style>
    </head>
    <body>
    </body>
    </html>