<?php
session_start();
include_once('conexao.php');

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    // Verifique o reCAPTCHA no lado do servidor
    $recaptchaSecretKey = '6LcsRMUoAAAAAFemidzOJpmkcKifnlQvSKs9A3iW';
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verifique se a chave secreta está definida
    if (empty($recaptchaSecretKey)) {
        die("A chave secreta do reCAPTCHA não está configurada. Por favor, defina a chave secreta.");
    }

    // Verifique se a resposta do reCAPTCHA está presente
    if (empty($recaptchaResponse)) {
       die(header('Location: login_aluno2.php'));
    }

    // Verifique o reCAPTCHA usando a API do Google
    $recaptchaVerification = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecretKey}&response={$recaptchaResponse}"));

    if (!$recaptchaVerification > 1) // ou (!$recaptchaVerification != "")
    {
        $recaptchaError = "Por favor, verifique o reCAPTCHA.";
    } else {
        // Continue com a verificação do email e senha
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuario WHERE email = '$email' and senha = md5('{$senha}')";

        $result = $conexao->query($sql);

        if (mysqli_num_rows($result) < 1) {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('Location: login_aluno3.php');
        } else {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: consulta_livros.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação</title>
</head>
<body> 
</body>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</html>