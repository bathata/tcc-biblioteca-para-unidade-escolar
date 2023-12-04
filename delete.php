<?php
if (!empty($_POST['id_livro'])) {
    include_once('conexao.php');

    $id_livro = $_POST['id_livro'];

    // Verifique se há registros na tabela filho (emprestimo) relacionados a este livro
    $sqlCheck = "SELECT * FROM emprestimo WHERE id_livro = '$id_livro'";
    $resultCheck = $conexao->query($sqlCheck);

    if ($resultCheck->num_rows > 0) {
        // Existem registros na tabela filho
        echo "<script>
                var confirmacao = confirm('Este livro tem empréstimos associados. Deseja excluir os empréstimos antes de excluir o livro?');

                if (confirmacao) {
                    window.location.href = 'delete_emprestimos.php?id_livro=$id_livro';
                } else {
                    alert('A exclusão foi cancelada.');
                    window.close(); // Fecha a janela atual
                    window.opener.location.reload(); // Atualiza a página anterior
                }
              </script>";
        exit();
    } else {
        // Não há registros na tabela filho, você pode excluir o livro da tabela pai
        $sqlDelete = "DELETE FROM biblio_estoque WHERE id_livro = '$id_livro'";
        $resultDelete = $conexao->query($sqlDelete);

        if ($resultDelete) {
            echo "<script>
                    alert('Livro excluído com sucesso!');
                    window.close(); // Fecha a janela atual
                    window.opener.location.reload(); // Atualiza a página anterior
                 </script>";
            exit(); // Importante: encerrar o script após redirecionar
        } else {
            echo "Erro ao excluir o livro: " . $conexao->error;
        }
    }
} else {
    echo "ID do livro não fornecido.";
}
?>