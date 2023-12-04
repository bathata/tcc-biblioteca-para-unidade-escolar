<?php
session_start();
include_once('conexao.php');

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
// Adicione uma variável para verificar se a senha foi atualizada com sucesso
$senhaAtualizadaComSucesso = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se o formulário foi enviado

    // Você pode adicionar aqui a verificação do reCAPTCHA, se necessário

    $ra_dig = $_POST['ra_dig'];
    $nova_senha = $_POST['nova_senha'];

    // Atualize a senha no banco de dados
    $sql = "UPDATE usuario SET senha = md5('$nova_senha') WHERE ra_dig = '$ra_dig'";
    $result = $conexao->query($sql);

    if ($result) {
         // Defina a variável como verdadeira se a senha foi atualizada com sucesso
         $senhaAtualizadaComSucesso = true;
    } else {
        echo "<p>Ocorreu um erro ao atualizar a senha. Tente novamente.</p>";
    }
} else {
    // Se não foi enviado por POST, exiba o formulário

    // Recupere o ra_dig da URL
    $ra_dig = $_GET['ra_dig'];

    // Exiba o formulário para atualização da senha
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
        function fecharJanelaEMostrarMensagem() {
        // Exibe a mensagem de sucesso
        alert("Senha atualizada com sucesso!");

        // Fecha a janela atual
        window.close();

        // Atualiza a página anterior
        window.opener.location.reload();
        }
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

        #senha-info {
            color: dodgerblue;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class='login'>
        <h2>Atualizar Senha</h2>
        <form action="atualizar_senha.php" method="POST" oninput="verificarForcaSenha()">
            <!-- Adicione um campo oculto para enviar o ra_dig junto com o formulário -->
            <input type="hidden" name="ra_dig" value="<?php echo $ra_dig; ?>">
            <label for="nova_senha">Nova Senha:</label>
            <input type="password" name="nova_senha" id="nova_senha" required>
            <div id="senha-info"></div>
            <br>
            <div class="g-recaptcha" data-sitekey="6LcsRMUoAAAAAFemidzOJpmkcKifnlQvSKs9A3iW"></div>
            <br>
            <input class="inputSubmit" type="submit" name="submit" value="Atualizar Senha">
        </form>
        <a href="javascript:void(0);" onclick="fecharJanela();">Voltar</a>
        <div>
        <script>
            function verificarForcaSenha() {
                var senha = document.getElementById('nova_senha').value;
                var infoDiv = document.getElementById('senha-info');

                // Adicione suas regras de verificação aqui
                var comprimentoMinimo = senha.length >= 8;
                var contemLetraMaiuscula = /[A-Z]/.test(senha);
                var contemLetraMinuscula = /[a-z]/.test(senha);
                var contemNumero = /[0-9]/.test(senha);
                var contemCaractereEspecial = /[!@#$%^&*()\-_+=\[\]{};:,.<>?]/.test(senha);

                // Mensagens informativas
                var mensagens = [];
                mensagens.push(comprimentoMinimo ? '✅ Mínimo 8 caracteres' : '❌ Mínimo 8 caracteres');
                mensagens.push(contemLetraMaiuscula ? '✅ Pelo menos uma letra maiúscula' : '❌ Pelo menos uma letra maiúscula');
                mensagens.push(contemLetraMinuscula ? '✅ Pelo menos uma letra minúscula' : '❌ Pelo menos uma letra minúscula');
                mensagens.push(contemNumero ? '✅ Pelo menos um número' : '❌ Pelo menos um número');
                mensagens.push(contemCaractereEspecial ? '✅ Pelo menos um caractere especial' : '❌ Pelo menos um caractere especial');

                // Atualize a div de informações
                infoDiv.innerHTML = mensagens.join('<br>');
            }
        </script>
        <?php
            // Adicione um script para chamar a função JavaScript se a senha foi atualizada com sucesso
            if ($senhaAtualizadaComSucesso) {
                echo '<script>fecharJanelaEMostrarMensagem();</script>';
            }
        ?>
    </body>
</html>