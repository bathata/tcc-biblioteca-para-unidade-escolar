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
        
    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = "SELECT * FROM biblio_estoque WHERE id_livro LIKE '%$data%' or titulo_livro LIKE '%$data%' or autor_livro LIKE '%$data%' ORDER BY titulo_livro ASC";
    }
    else
    {
        $sql = "SELECT * FROM biblio_estoque ORDER BY titulo_livro ASC";
    }
    $result = $conexao->query($sql);

    // Define um timeout para o sistema
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
                background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
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
            border: 3px solid blue;
            border-radius: 10px;
            padding: 10px;
            }
            .aBotao:hover{
                background-color: dodgerblue;
                color: black;
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
            echo "<h2>Consultar Livros</h2>";
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

        <a href="meus_emprestimos.php" class="aBotao"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2"><path d="M20 12v5c0 1.886 0 2.828-.586 3.414C18.828 21 17.886 21 16 21H6.5a2.5 2.5 0 0 1 0-5H16c1.886 0 2.828 0 3.414-.586C20 14.828 20 13.886 20 12V7c0-1.886 0-2.828-.586-3.414C18.828 3 17.886 3 16 3H8c-1.886 0-2.828 0-3.414.586C4 4.172 4 5.114 4 7v11.5"/><path stroke-linecap="round" d="m9 10l1.293 1.293a1 1 0 0 0 1.414 0L15 8"/></g>
        </svg> Meus Emprestimos</a>

        <div class="m-5">
            <table class="table text-white table-bg">
                <thead>
                    <tr>
                        <th scope="col">Cód.</th>
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Genêro</th>
                        <th scope="col">Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($user_data = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>".$user_data['id_livro']."</td>";
                            echo "<td>".$user_data['titulo_livro']."</td>";
                            echo "<td>".$user_data['autor_livro']."</td>";
                            echo "<td>".$user_data['genero_livro']."</td>";
                            echo "<td align='center'>".$user_data['qtd_livro']."</td>";
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
        window.location = 'consulta_livros.php?search='+search.value;
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
