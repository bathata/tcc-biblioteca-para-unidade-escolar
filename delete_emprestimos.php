<?php
if (!empty($_GET['id_livro'])) {
    include_once('conexao.php');

    $id_livro = $_GET['id_livro'];

    // Exclua os empréstimos associados ao livro
    $sqlDeleteEmprestimos = "DELETE FROM emprestimo WHERE id_livro = '$id_livro'";
    $resultDeleteEmprestimos = $conexao->query($sqlDeleteEmprestimos);

    // Exclua o livro da tabela biblio_estoque
    $sqlDeleteLivro = "DELETE FROM biblio_estoque WHERE id_livro = '$id_livro'";
    $resultDeleteLivro = $conexao->query($sqlDeleteLivro);

    if ($resultDeleteEmprestimos && $resultDeleteLivro) {
        // Ambas as exclusões foram bem-sucedidas
        echo "<script>
                alert('Empréstimos e livro excluídos com sucesso!');
                window.close(); // Fecha a janela atual
                window.opener.location.reload(); // Atualiza a página anterior
              </script>";
        exit(); // Importante: encerrar o script após redirecionar
    } else {
        echo "Erro ao excluir: " . $conexao->error;
    }
} else {
    echo "ID do livro não fornecido.";
}
?>