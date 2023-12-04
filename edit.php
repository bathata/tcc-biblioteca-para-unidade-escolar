<?php
    include_once('conexao.php');

    if(!empty($_GET['id_livro']))
    {
        $id = $_GET['id_livro'];
        $sqlSelect = "SELECT * FROM biblio_estoque WHERE id_livro=$id";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {
                $titulo = $user_data['titulo_livro'];
                $autor = $user_data['autor_livro'];
                $genero = $user_data['genero_livro'];
                $qtd = $user_data['qtd_livro'];
            }
        }
        else{
            header('Location: lista_livros.php');
        }
    }
    else{
        header('Location: lista_livros.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR LIVRO</title>
    <script>
        function fecharJanela() {
            window.close(); // Fecha a janela atual
            window.opener.location.reload(); // Atualiza a página anterior
        }
    </script>
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
        #data_nascimento{
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
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
        <form action="saveEdit.php" method="POST">
            <fieldset>
                <legend><b>Editar Livro</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="titulo" id="titulo" class="inputUser" value="<?php echo $titulo;?>" required>
                    <label for="titulo" class="labelInput">Título</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="autor" id="autor" class="inputUser" value="<?php echo $autor;?>" required>
                    <label for="autor" class="labelInput">Autor</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="genero" id="genero" class="inputUser" value="<?php echo $genero;?>" required>
                    <label for="genero" class="labelInput">Genero</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="number" name="qtd" id="qtd" class="inputUser" value="<?php echo $qtd;?>" required>
                    <label for="qtd" class="labelInput">Quantidade</label>
                </div>
                <br><br>
				<input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="update" id="submit" value="Atualizar">
                <br><br><br>
                <a href="javascript:void(0);" onclick="fecharJanela();">Voltar</a>
                <br>
            </fieldset>
        </form>
    </div>
</body>
</html>