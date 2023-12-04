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
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
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
            border: 3px solid dodgerblue;
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
        a{
            text-decoration: none;
            color: white;
            border: 3px solid blue;
            border-radius: 10px;
            padding: 10px;
        }
        a:hover{
            background-color: dodgerblue;
            color: black;
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