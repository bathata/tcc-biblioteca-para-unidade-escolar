<?php
    session_start();
    if (isset($_POST['submit'])) {
        require_once('conexao.php');
        $_SESSION['livro_cadastrado'] = true;

        $titulo = $_POST['titulo_livro'];
        $autor = $_POST['autor_livro'];
        $genero = $_POST['genero_livro'];
        $qtd = $_POST['qtd_livro'];
        
        $sql = "INSERT INTO biblio_estoque (titulo_livro, autor_livro, genero_livro, qtd_livro) VALUES ('$titulo', '$autor','$genero','$qtd')";
        if ($conexao->query($sql) === TRUE) {
            echo '<script>
                    alert("Livro cadastrado com sucesso!");
                    window.opener.location.reload(); // Recarrega a página anterior (lista_livros.php) na janela pai
                    window.close(); // Fecha a janela popout
                  </script>';
        } else {
            echo "Erro ao adicionar livro: " . $conexao->error;
        }
        $conexao->close();
    }
    // Inicialize as variáveis para evitar erros
$titulo = '';
$autor = '';
$genero = '';
$qtd = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Livro</title>
    <style>
      
      body{
            font-family: Arial, Helvetica, sans-serif;
            background-image:  linear-gradient(to left, #7a60ff, #cd9ffa);
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
            border: 3px solid #9c7cfc;
        }
        legend{
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            background-color: #9c7cfc;
            border-radius: 8px;
        }
        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 2px solid white;
            outline: none;
            color: black;
            font-size: 15px;
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
            font-size: 12px;
            color: #9c7cfc;
        }
        #submit{
            background-color:#8466fb;
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover{
            background-color: #9c7cfc;
        }
        a{
            text-decoration: none;
            color: white;
            border: 1px solid white;
            border-radius: 10px;
            padding: 9px;
        }
        a:hover{
            background-color: #8466fb;
        }
    </style>
</head>
<body>
    <div class="box">
        <form action="novo_livro.php" method="POST">
            <fieldset>
                <legend><b>Cadastro de Livro</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="titulo_livro" id="titulo_livro" class="inputUser" value="<?php echo $titulo;?>" required>
                    <label for="titulo_livro" class="labelInput">Título</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="autor_livro" id="autor_livro" class="inputUser" value="<?php echo $autor;?>" required>
                    <label for="autor_livro" class="labelInput">Autor</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="genero_livro" id="genero_livro" class="inputUser" value="<?php echo $genero;?>" required>
                    <label for="genero_livro" class="labelInput">Genero</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="number" name="qtd_livro" id="qtd_livro" class="inputUser" value="<?php echo $qtd;?>" required>
                    <label for="qtd_livro" class="labelInput">Quantidade</label>
                </div>
                <br><br>
                <input type="submit" name="submit" id="submit" value="Cadastrar">
                <br><br><br><br>
                <a href="javascript:void(0);" onclick="fecharJanela()">Voltar</a>
            </fieldset>
        </form>
    </div>
    <script>
        <?php if(isset($_SESSION['livro_cadastrado'])): ?>
            alert("Livro cadastrado com sucesso!");
            <?php unset($_SESSION['livro_cadastrado']); ?>

            // Fecha a janela popout
            window.open('', '_self', '');
            window.close();

            // Recarrega a página anterior (lista_livros.php) na janela pai
            window.opener.location.reload();
        <?php endif; ?>

        // Função para fechar a janela ao clicar no botão "Voltar"
        function fecharJanela() {
            window.close();
        }
    </script>
</body>
</html>