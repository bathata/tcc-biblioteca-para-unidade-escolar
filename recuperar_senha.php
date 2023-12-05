<!-- recuperar_senha.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
    <script>
        function fecharJanela() {
            window.close(); // Fecha a janela atual
            window.opener.location.reload(); // Atualiza a página anterior
        }
    </script>
    <style>
        
        body{
        font-family: Arial, Helvetica, sans-serif;
            background:linear-gradient(to left, #7a60ff, #cd9ffa);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            border: radius 5px;px;
            max: width 500px;
            margin: auto;
            padding:2em;
            border width: 20px;
         
        }

        .login {
            background-color:white;
            position: relative;
            padding: 70px;
            border-radius:40px;
            color: black;
            box-sizing: border-box;
            text-align: center;
        }

        input {
            padding: 15px;
            border: black;
            font-size: 15px;
            width: 90%;
            margin-bottom: 20px;
            border-radius:5px;
            background-color:#c2a2c8;
        }

        .inputSubmit {
            background-color:#4b0082;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: black;
            font-size: 15px;
        }

        .inputSubmit:hover {
            background-color: #c9a0dc;
            cursor: pointer;
        }

        a {
            text-decoration: none;
            color: black;
            border: 3px solid;
            border-radius: 10px;
            padding: 10px;
            display: block;
            margin-top: 10px;
        }

        a:hover {
            background-color:#c9a0dc;
            color: black;
        }

    </style>
</head>
<body>
    <div class="login">
        <h2>Recuperação de Senha</h2>
        <form action="processar_recuperacao_senha.php" method="POST">
            <label for="email">Digite seu e-mail:</label>
            <input type="email" name="email" required>
            <br>
            <input class="inputSubmit" type="submit" name="submit" value="Recuperar Senha">
        </form>
        <br>
        <a href="javascript:void(0);" onclick="fecharJanela();">Voltar</a>
    </div>
</body>
</html>
