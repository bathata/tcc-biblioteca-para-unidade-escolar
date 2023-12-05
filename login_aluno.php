<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Tela de login</title>
    <style>
        body {
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
        <h1>Login Aluno</h1>
        <form action="testLoginAluno.php" method="POST">
            <input type="text" name="email" placeholder="E-mail" required>
            <br>
            <input type="password" name="senha" placeholder="Senha">
            <br>
            <div class="g-recaptcha" data-sitekey="6LcsRMUoAAAAAFemidzOJpmkcKifnlQvSKs9A3iW"></div>
            <br>
            <input class="inputSubmit" type="submit" name="submit" value="Entrar">
        </form>
        <a href="javascript:void(0);" onclick="openPopup('recuperar_senha.php')">Esqueceu sua senha?</a>
        <a href="cadastro_aluno.php">Cadastre-se</a>
        <a href="index.html">Voltar</a>
    </div>
    <script>
        function openPopup(url, width = 900, height = 600) {
            // Calcula as coordenadas X e Y para centralizar o popup na tela
            const left = (window.innerWidth - width) / 2 + window.screenX;
            const top = (window.innerHeight - height) / 2 + window.screenY;

            // Abre o popup centralizado
            window.open(url, "Popup", `width=${width},height=${height},left=${left},top=${top}`);
        }
    </script>
</body>
</html>
