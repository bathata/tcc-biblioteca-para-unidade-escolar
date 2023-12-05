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
        
        body {
            font-family: Arial, Helvetica, sans-serif;
            background:linear-gradient(to left, #7a60ff, #cd9ffa);;
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
            margin-bottom: 20px; 
            border-radius: 6px;
            border: 2px solid #440f7d;

        }

        .inputSubmit {
            background-color:#7F00FF;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-size: 15px;
        }

        .inputSubmit:hover {
            background-color:#9c7cfc;
            cursor: pointer;
        }

        a {
            text-decoration: none;
            color: white;
            border: 2px solid white;
            border-radius: 10px;
            padding: 10px;
            display: block;
            margin-top: 10px;
        }

        a:hover {
            background-color:#7F00FF;
            color: black;
        }

        #senha-info {
            color: #9c8ccc;
            font-size: 12px;
            margin-top: 5px;
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
