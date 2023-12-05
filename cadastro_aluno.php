<?php
    function verificarForcaSenha($password) {
        // Verificar o comprimento mínimo
        if (strlen($password) < 8) {
            return false;
        }
        // Verificar se a senha contém pelo menos uma letra maiúscula
        if (!preg_match("/[A-Z]/", $password)) {
            return false;
        }
        // Verificar se a senha contém pelo menos uma letra minúscula
        if (!preg_match("/[a-z]/", $password)) {
            return false;
        }
        // Verificar se a senha contém pelo menos um número
        if (!preg_match("/[0-9]/", $password)) {
            return false;
        }
        // Verificar se a senha contém pelo menos um caractere especial
        if (!preg_match("/[!@#$%^&*()\-_+=\[\]{};:,.<>?]/", $password)) {
            return false;
        }
        return true;
    }

    if (isset($_POST['submit'])) {
        include_once('conexao.php');
    
        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $sobrenome = mysqli_real_escape_string($conexao, $_POST['sobrenome']);
        $email = mysqli_real_escape_string($conexao, $_POST['email']);
        $ra_dig = mysqli_real_escape_string($conexao, $_POST['ra_dig']);
        $senha = mysqli_real_escape_string($conexao, trim(md5($_POST['senha'])));
        
        $senhaValida = verificarForcaSenha($_POST['senha']);
    
        if ($senhaValida) {
            $result = mysqli_query($conexao, "INSERT INTO usuario (nome,sobrenome,email,senha,ra_dig) 
            VALUES ('$nome','$sobrenome','$email','$senha','$ra_dig')");
            if ($result) {
                // Exibir mensagem de sucesso
                $successMessage = "Aluno cadastrado com sucesso!";
                echo "<script>alert('$successMessage');</script>";
            header('Location: login_aluno.php');
            exit;
            } else {
                $senhaError = "Erro ao cadastrar aluno. Por favor, tente novamente.";
            }
        } else {
            $senhaError = "A senha não atende aos critérios de segurança.";
        }
    }  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aluno</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background:linear-gradient(to left, #7a60ff, #cd9ffa);
            font-size: 14px;
        }
        .box{
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 40%;
        }
        fieldset{
            border: 3px solid;
            color:black;
        }
        legend{
            border: 1px solid dodgerblue;
            padding: 10px;
            text-align: center;
            background-color: dodgerblue;
            border-radius: 8px;
        }
        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 12px;
            width: 100%;
            letter-spacing: 2px;
        }
        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 11px;
            color: dodgerblue;
        }
        #submit{
            background-image: linear-gradient(to right,rgb(0, 92, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover{
            background-image: linear-gradient(to right,rgb(0, 80, 172), rgb(80, 19, 195));
        }
        .aBotao{
            flex: 1;
            max-width: 300px;
            text-decoration: none;
            padding: 10px;
            padding-bottom: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
            color: #333;
            background-color: ##4b0082;
            box-sizing: border-box;
        }
        .aBotao:hover{
            background-color: :#4b0082;
            color: black;
        }
        @media (min-width: 600px) {
            .aBotao {
                width: auto;
            }
        }
        .aBotaoSpecial {
        text-align: center;
        border-radius: 10px;
        background-color:white;
        color: black;
        display: inline-block;
        text-decoration: none;
        padding: 10px 20px;
        margin: 10px;
        }
        .aBotaoSpecial:hover {
            background-color: #c2a2c8; /* Uma cor um pouco mais escura ao passar o mouse */
        }
    </style>
</head>
<body>
    <div class="box">
        <form action="cadastro_aluno.php" method="POST">
            <fieldset>
                <legend><b>Cadastro de Aluno</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="sobrenome" id="sobrenome" class="inputUser" required>
                    <label for="sobrenome" class="labelInput">Sobrenome</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelInput">E-mail</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="ra_dig" id="ra_dig" class="inputUser" required>
                    <label for="ra_dig" class="labelInput">R.A. Com o Dígito</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" onkeyup="verificarForcaSenha()" required>
                    <label for="senha" class="labelInput">Senha</label>
                    <div id="senha-info" style="color: dodgerblue; font-size: 12px; margin-top: 5px;"></div>
                </div>
                <span id="senha-error" style="color: dodgerblue; font-size: 12px; margin-top: 5px;"></span>
                <br>
                <input type="submit" name="submit" id="submit" value="Cadastrar">
                <br><br><br>
                <a href="" class="aBotaoSpecial">Voltar</a>
                <a href="login_aluno.php" class="aBotaoSpecial">Login</a>
                <br>
            </fieldset>
        </form>
    </div>
    <script>
        <?php if (isset($senhaError)): ?>
            document.getElementById('senha-error').textContent = "<?php echo $senhaError; ?>";
            document.getElementById('senha-error').style.display = 'block';
        <?php endif; ?>

        function verificarForcaSenha() {
            var senha = document.getElementById('senha').value;
            var infoDiv = document.getElementById('senha-info');

            var comprimentoMinimo = senha.length >= 8;
            var contemLetraMaiuscula = /[A-Z]/.test(senha);
            var contemLetraMinuscula = /[a-z]/.test(senha);
            var contemNumero = /[0-9]/.test(senha);
            var contemCaractereEspecial = /[!@#$%^&*()\-_+=\[\]{};:,.<>?]/.test(senha);

            var mensagens = [];
            mensagens.push(comprimentoMinimo ? '✅ Mínimo 8 caracteres' : '❌ Mínimo 8 caracteres');
            mensagens.push(contemLetraMaiuscula ? '✅ Pelo menos uma letra maiúscula' : '❌ Pelo menos uma letra maiúscula');
            mensagens.push(contemLetraMinuscula ? '✅ Pelo menos uma letra minúscula' : '❌ Pelo menos uma letra minúscula');
            mensagens.push(contemNumero ? '✅ Pelo menos um número' : '❌ Pelo menos um número');
            mensagens.push(contemCaractereEspecial ? '✅ Pelo menos um caractere especial' : '❌ Pelo menos um caractere especial');

            infoDiv.innerHTML = mensagens.join('<br>');
        }
    </script>
</body>
</html>