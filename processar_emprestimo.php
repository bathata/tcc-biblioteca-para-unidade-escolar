<?php
session_start();
include_once('conexao.php');
date_default_timezone_set('America/Sao_Paulo'); // Substitua 'America/Sao_Paulo' pelo fuso horário desejado

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_livro = $_POST['id_livro'];
    $id_aluno = $_POST['id_aluno'];
    $data_devolver = $_POST['data_devolver'];

    // Recuperar informações do aluno
    $sql_info_aluno = "SELECT nome, sobrenome, ra_dig FROM usuario WHERE id_aluno = $id_aluno";
    $result_info_aluno = $conexao->query($sql_info_aluno);
    $info_aluno = mysqli_fetch_assoc($result_info_aluno);

    // Recuperar informações do livro
    $sql_info_livro = "SELECT id_livro, titulo_livro, qtd_livro FROM biblio_estoque WHERE id_livro = $id_livro";
    $result_info_livro = $conexao->query($sql_info_livro);
    $info_livro = mysqli_fetch_assoc($result_info_livro);

    // Verificar se há livros disponíveis para empréstimo
    if ($info_livro['qtd_livro'] > 0) {
        // Criar um objeto DateTime com a data do formato brasileiro
        $data_devolver_obj = DateTime::createFromFormat('d/m/Y', $data_devolver);

        // Verificar se a criação do objeto DateTime foi bem-sucedida
        if ($data_devolver_obj !== false) {
            // Formatando a data para o formato do banco de dados
            $data_devolver_formatada = $data_devolver_obj->format('Y-m-d');
        } else {
            // Se a criação do objeto falhar, use uma data padrão (hoje + 7 dias)
            $data_devolver_formatada = date('Y-m-d', strtotime('+7 days'));
            echo "A data fornecida é inválida. Será usada uma data padrão de devolução (7 dias a partir de hoje).";
        }

        // Inserir dados na tabela emprestimo
        $sql_emprestimo = "INSERT INTO emprestimo (id_livro, nome, sobrenome, ra_dig, titulo_livro, data_emprest, data_devolver, data_devolucao) VALUES (
            '{$info_livro['id_livro']}',
            '{$info_aluno['nome']}',
            '{$info_aluno['sobrenome']}',
            '{$info_aluno['ra_dig']}',
            '{$info_livro['titulo_livro']}',
            CONVERT_TZ(NOW(), 'UTC', 'America/Sao_Paulo'), -- usar CONVERT_TZ para ajustar a hora do empréstimo
            CONVERT_TZ('$data_devolver_formatada', 'UTC', 'America/Sao_Paulo'), -- converter a data_devolver para o fuso horário desejado
            NULL  -- data_devolucao é inicialmente NULL
        )";
        if ($conexao->query($sql_emprestimo) === TRUE) {
            // Atualizar a tabela biblio_estoque para diminuir a quantidade de livros em 1
            $nova_qtd_livro = $info_livro['qtd_livro'] - 1;
            $sql_atualizar_livro = "UPDATE biblio_estoque SET qtd_livro = $nova_qtd_livro WHERE id_livro = $id_livro";
            $conexao->query($sql_atualizar_livro);

            // Redirecionar ou exibir mensagem de sucesso
            echo '<script>
                alert("Empréstimo realizado com sucesso!");
                window.opener.location.reload(); // Recarregar a janela anterior
                window.close(); // Fechar a janela pop-up
            </script>';
        }
    } else {
        echo '<script>
                alert("Livro não disponível!");
                window.opener.location.reload(); // Recarregar a janela anterior
                window.close(); // Fechar a janela pop-up
            </script>';
    }
}