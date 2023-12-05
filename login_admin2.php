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
        <h1>Login Administrador</h1>
        <form action="testLogin.php" method="POST">
            <input type="text" name="email" placeholder="Usuário" required>
            <br>
            <input type="password" name="senha" placeholder="Senha">
            <br>
            <div class="g-recaptcha" data-sitekey="6LcsRMUoAAAAAFemidzOJpmkcKifnlQvSKs9A3iW"></div>
            <p style="color: red;">Por favor, complete o reCAPTCHA.</p>
            <input class="inputSubmit" type="submit" name="submit" value="Entrar">
        </form>
        <a href="index.html">Voltar</a>
    </div>
</body>
</html>
