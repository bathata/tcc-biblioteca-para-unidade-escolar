<?php
    include_once('conexao.php');

    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $genero = $_POST['genero'];
        $qtd = $_POST['qtd'];

        $sqlUpdate = "UPDATE biblio_estoque 
        SET titulo_livro='$titulo',autor_livro='$autor',genero_livro='$genero',qtd_livro='$qtd'
        WHERE id_livro=$id";
        
        $result = $conexao->query($sqlUpdate);

        if ($result) {
            // Edição bem-sucedida
            echo "<script>alert('Livro editado com sucesso!'); window.opener.location.reload(); window.close();</script>";
        } else {
            // Erro na edição
            echo "<script>alert('Erro ao editar livro: " . $conexao->error . "'); window.close();</script>";
        }
    }
    else {
        // Caso o formulário não tenha sido submetido corretamente
        echo "<script>alert('Erro: O formulário não foi submetido corretamente.'); window.close();</script>";
    }
?>
