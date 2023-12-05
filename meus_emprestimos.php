<?php
session_start();
include_once('conexao.php');
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
        {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('Location: login_aluno.php');
        }
        $logado = $_SESSION['email'];

        // Recuperar informações do aluno
        $sqlUsuario = "SELECT nome, sobrenome, ra_dig FROM usuario WHERE email = '$logado'";
        $resultUsuario = $conexao->query($sqlUsuario);
        $userInfo = mysqli_fetch_assoc($resultUsuario);
        
        $nomeAluno = $userInfo['nome'];
        $sobrenomeAluno = $userInfo['sobrenome'];
        $raAluno = $userInfo['ra_dig'];

        if (!empty($_GET['search'])) {
            $data = $_GET['search'];
            $sql = "SELECT * FROM emprestimo WHERE (id_emprest LIKE '%$data%' or titulo_livro LIKE '%$data%' or nome LIKE '%$data%') ORDER BY data_devolucao ASC";
        } else {
            $sql = "SELECT * FROM emprestimo WHERE ra_dig = '$raAluno' ORDER BY data_devolucao ASC";
        }
        
        $result = $conexao->query($sql);
        
        // Verificar se houve algum erro na consulta
        if (!$result) {
            die('Erro na consulta: ' . $conexao->error);
        }

    $timeout = 1440; // tempo sem segundos - 24 minutos

// Verificar se a última atividade da sessão ocorreu há mais tempo que o timeout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
    // Se o timeout foi atingido, destruir a sessão
    session_unset();
    session_destroy();
    echo "Sessão expirou devido à inatividade.";
}

// Atualizar o tempo da última atividade
$_SESSION['last_activity'] = time();

// Exemplo de definição e leitura de variável de sessão
if (!isset($_SESSION['email'])) {
    $_SESSION['username'] = 'usuário_teste';
    echo "Variável de sessão 'username' definida.";
} else {
    echo "Tempo de espera de inatividade: <span id='counter'>24:00</span>";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>BIBLIOTECA | VICENTE LEPORACE</title>
        <style>
            body{
                background:  linear-gradient(to left, #7a60ff, #cd9ffa);;
                color: white;
                text-align: center;
            }
            .table-bg{
                background: rgba(0, 0, 0, 0.3);
                border-radius: 15px 15px 0 0;
            }

            .box-search{
                display: flex;
                justify-content: center;
                gap: .1%;
            }
            .aBotao{
            text-decoration: none;
            color: white;
            border: 3px solid #8466fb;
            border-radius: 10px;
            padding: 10px;
            background - color:#8466fb
            }
            .aBotao:hover{
                background-color: #9c7cfc;
                color:  white;
            }
            #counter {
            font-size: 16px;
            color: white;
            cursor: pointer;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">SISTEMA BIBLIOTECA</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="d-flex">
                <a href="sairAluno.php" class="btn btn-danger me-5">Sair</a>
            </div>
        </nav>
        <br>
        <?php
            echo "<h1>Bem-vindo $nomeAluno $sobrenomeAluno (RA: $raAluno)</h1>";
            echo "<h2>Meus Emprestimos</h2>";
        ?>
        <br>
        <div class="box-search">
            <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
            <button onclick="searchData()" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </div>
        <br><br>

        <!-- BOTÕES DE CONTROLES PARA NOVOS LIVROS E EMPRESTIMOS -->
        <a href="consulta_livros.php" class="aBotao"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6.5 2A2.5 2.5 0 0 0 4 4.5v15A2.5 2.5 0 0 0 6.5 22h6.034c-.318-.416-.534-.924-.534-1.5H6.5a1 1 0 0 1-1-1H12v-5.207l.008.007c.099-1.166 1.052-1.984 2.01-2.462C15.087 11.302 16.497 11 18 11c.573 0 1.13.044 1.655.127c.29.045.573.103.845.172V4.5A2.5 2.5 0 0 0 18 2H6.5ZM8 5h8a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm11.5 7.114a7.684 7.684 0 0 1 1.5.386c1.214.456 2 1.182 2 2c0 .818-.786 1.544-2 2a7.71 7.71 0 0 1-1.5.386A9.691 9.691 0 0 1 18 17c-2.761 0-5-1.12-5-2.5s2.239-2.5 5-2.5c.523 0 1.026.04 1.5.114Zm0 5.782a9.081 9.081 0 0 0 1.5-.338c.35-.112.68-.245.983-.396a4.86 4.86 0 0 0 1.017-.67V20.5c0 1.38-2.239 2.5-5 2.5c-2.05 0-3.812-.617-4.584-1.5c-.268-.306-.416-.644-.416-1v-4.008c.31.27.663.493 1.017.67c1.071.536 2.48.838 3.983.838c.514 0 1.017-.035 1.5-.104Z"/>
        </svg> Consultar Livros</a>

        <div class="m-5">
            <table class="table text-white table-bg">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Sobrenome</th>
                        <th scope="col">R.A.</th>
                        <th scope="col">Cód.</th>
                        <th scope="col">Título do Livro</th>
                        <th scope="col">Data do Emprestimo</th>
                        <th scope="col">Data Para Devolver</th>
                        <th scope="col">Data da Devolução</th>
                        <th scope="col">Situação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($user_data = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $user_data['nome'] . "</td>";
                            echo "<td>" . $user_data['sobrenome'] . "</td>";
                            echo "<td>" . $user_data['ra_dig'] . "</td>";
                            echo "<td>".$user_data['id_livro']."</td>";
                            echo "<td>" . $user_data['titulo_livro'] . "</td>";
                        
                            // Formatando as datas para o formato brasileiro com hora
                            $data_emprest_formatada = date('d/m/Y H:i:s', strtotime($user_data['data_emprest']));
                            $data_devolver_formatada = date('d/m/Y H:i:s', strtotime($user_data['data_devolver']));
                            $data_devolucao_formatada = !empty($user_data['data_devolucao']) ? date('d/m/Y H:i:s', strtotime($user_data['data_devolucao'])) : "-";
                        
                            echo "<td>" . $data_emprest_formatada . "</td>";
                            echo "<td>" . $data_devolver_formatada . "</td>";
                            echo "<td>" . $data_devolucao_formatada . "</td>";
                            echo "<td>";
            
                            if (empty($user_data['data_devolucao'])) {
                                echo "
                                        <button type='submit' class='btn btn-sm btn-danger' title='Não Devolvido'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'>
                                        <path fill='currentColor' d='M12 18.5c0 1.29.39 2.5 1.04 3.5H6c-1.11 0-2-.89-2-2V4a2 2 0 0 1 2-2h1v7l2.5-1.5L12 9V2h6a2 2 0 0 1 2 2v8.18c-.5-.11-1-.18-1.5-.18a6.5 6.5 0 0 0-6.5 6.5m10 0v-4l-1.17 1.17A3.99 3.99 0 0 0 18 14.5c-2.21 0-4 1.79-4 4s1.79 4 4 4c1.68 0 3.12-1.03 3.71-2.5H20a2.5 2.5 0 1 1-.23-3.27L18 18.5h4Z'/>
                                        </svg>
                                        </button>";
                            } else {
                                echo "
                                    <button class='btn btn-sm btn-success' title='Devolvido'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><g fill='white'><path fill='white' fill-rule='evenodd' d='M6.5 16H16c1.886 0 2.828 0 3.414-.586C20 14.828 20 13.886 20 12V7c0-1.886 0-2.828-.586-3.414C18.828 3 17.886 3 16 3H8c-1.886 0-2.828 0-3.414.586C4 4.172 4 5.114 4 7v11.5A2.5 2.5 0 0 1 6.5 16Zm9.914-6.586a2 2 0 1 0-2.828-2.828L11 9.172l-.586-.586a2 2 0 1 0-2.828 2.828l1.293 1.293a3 3 0 0 0 4.242 0l3.293-3.293Z' clip-rule='evenodd'/><path fill='white' d='m19.414 15.414l-.707-.707l.707.707Zm0-11.828l-.707.707l.707-.707Zm-3 3l.707-.707l-.707.707Zm0 2.828l-.707-.707l.707.707Zm-2.828-2.828l-.707-.707l.707.707ZM11 9.172l-.707.707l.707.707l.707-.707L11 9.172Zm-.586-.586l-.707.707l.707-.707Zm-2.828 0l.707.707l-.707-.707Zm0 2.828l.707-.707l-.707.707Zm1.293 1.293l-.707.707l.707-.707Zm4.242 0L12.414 12l.707.707ZM16 15H6.5v2H16v-2Zm2.707-.293c-.076.076-.212.17-.646.229c-.462.062-1.09.064-2.061.064v2c.915 0 1.701.002 2.328-.082c.655-.088 1.284-.287 1.793-.797l-1.414-1.414ZM19 12c0 .971-.002 1.599-.064 2.061c-.059.434-.153.57-.229.646l1.414 1.414c.51-.51.709-1.138.797-1.793C21.002 13.7 21 12.915 21 12h-2Zm0-5v5h2V7h-2Zm-.293-2.707c.076.076.17.212.229.646C18.998 5.4 19 6.029 19 7h2c0-.915.002-1.701-.082-2.328c-.088-.655-.287-1.284-.797-1.793l-1.414 1.414ZM16 4c.971 0 1.599.002 2.061.064c.434.059.57.153.646.229l1.414-1.414c-.51-.51-1.138-.709-1.793-.797C17.7 1.998 16.915 2 16 2v2ZM8 4h8V2H8v2Zm-2.707.293c.076-.076.212-.17.646-.229C6.4 4.002 7.029 4 8 4V2c-.915 0-1.701-.002-2.328.082c-.655.088-1.284.287-1.793.797l1.414 1.414ZM5 7c0-.971.002-1.599.064-2.061c.059-.434.153-.57.229-.646L3.879 2.879c-.51.51-.709 1.138-.797 1.793C2.998 5.3 3 6.085 3 7h2Zm0 11.5V7H3v11.5h2ZM6.5 15A3.5 3.5 0 0 0 3 18.5h2A1.5 1.5 0 0 1 6.5 17v-2Zm9.207-7.707a1 1 0 0 1 0 1.414l1.414 1.414a3 3 0 0 0 0-4.242l-1.414 1.414Zm-1.414 0a1 1 0 0 1 1.414 0l1.414-1.414a3 3 0 0 0-4.242 0l1.414 1.414Zm-2.586 2.586l2.586-2.586l-1.414-1.414l-2.586 2.585l1.414 1.415Zm-2-.586l.586.586l1.414-1.415l-.586-.585l-1.414 1.414Zm-1.414 0a1 1 0 0 1 1.414 0l1.414-1.414a3 3 0 0 0-4.242 0l1.414 1.414Zm0 1.414a1 1 0 0 1 0-1.414L6.879 7.879a3 3 0 0 0 0 4.242l1.414-1.414ZM9.586 12l-1.293-1.293l-1.414 1.414l1.293 1.293L9.586 12Zm2.828 0a2 2 0 0 1-2.828 0l-1.414 1.414a4 4 0 0 0 5.656 0L12.414 12Zm3.293-3.293L12.414 12l1.414 1.414l3.293-3.293l-1.414-1.414ZM11 20H6.5v2H11v-2Zm-8-1.5A3.5 3.5 0 0 0 6.5 22v-2A1.5 1.5 0 0 1 5 18.5H3Z'/><path stroke='white' stroke-linecap='round' stroke-width='2' d='M20 21H10'/></g></svg>
                                    </button>";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </body>
    <script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });

    function searchData()
    {
        window.location = 'meus_emprestimos.php?search='+ search.value;
    }
    </script>
    <script>
        function startCounter() {
            let count = 24 * 60; // 24 minutos em segundos
            const counterElement = document.getElementById('counter');

            function updateCounter() {
                const minutes = Math.floor(count / 60);
                const seconds = count % 60;

                const formattedTime = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                counterElement.textContent = formattedTime;
            }
            function decrement() {
                count--;

                if (count < 0) {
                    count = 24 * 60; // Reinicia para 24 minutos
                }
                updateCounter();
            }
            updateCounter();

            const intervalId = setInterval(decrement, 1000);

            document.addEventListener('click', function () {
                count = 24 * 60;
                updateCounter();
            });
        }
        document.addEventListener('DOMContentLoaded', startCounter);
    </script>
</html>
