<?php
session_start();
include_once('conexao.php');
date_default_timezone_set('America/Sao_Paulo'); // Substitua 'America/Sao_Paulo' pelo fuso horário desejado


if (isset($_POST['id_emprest'])) {
    $id_emprest = $_POST['id_emprest'];

    // Obter informações do empréstimo
    $query_emprestimo = "SELECT * FROM emprestimo WHERE id_emprest = $id_emprest";
    $result_emprestimo = $conexao->query($query_emprestimo);
    $emprestimo_data = mysqli_fetch_assoc($result_emprestimo);

    // Obter informações do estoque
    $titulo_livro = $emprestimo_data['titulo_livro'];
    $query_estoque = "SELECT * FROM biblio_estoque WHERE titulo_livro = '$titulo_livro'";
    $result_estoque = $conexao->query($query_estoque);
    $estoque_data = mysqli_fetch_assoc($result_estoque);

    // Atualizar a tabela emprestimo com a data de devolução
    $data_devolucao = date('Y-m-d H:i:s');
    $update_query = "UPDATE emprestimo SET data_devolucao = '$data_devolucao' WHERE id_emprest = $id_emprest";
    $conexao->query($update_query);

    // Atualizar a quantidade de livros disponíveis na tabela biblio_estoque
    $nova_qtd_livro = $estoque_data['qtd_livro'] + 1;
    $update_estoque_query = "UPDATE biblio_estoque SET qtd_livro = $nova_qtd_livro WHERE titulo_livro = '$titulo_livro'";
    $conexao->query($update_estoque_query);
}
?>
