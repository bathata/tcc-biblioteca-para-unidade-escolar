<?php
session_start();
include_once('conexao.php');
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
        {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('Location: login_admin.php');
        }
        $logado = $_SESSION['email'];
    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = "SELECT * FROM usuario WHERE id_aluno LIKE '%$data%' or nome LIKE '%$data%' or sobrenome LIKE '%$data%' ORDER BY nome ASC";
    }
    else
    {
        $sql = "SELECT * FROM usuario ORDER BY nome ASC";
    }
    $result = $conexao->query($sql);

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
                flex: 1;
                max-width: 300px; /* Define a largura máxima para evitar que os botões fiquem muito largos */
                text-decoration: none;
                padding: 10px;
                margin: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                text-align: center;
                color: #333;
                background-color: #fff;
                box-sizing: border-box;
            }
            .aBotao:hover{
                background-color: dodgerblue;
                color: black;
            }
            @media (min-width: 600px) {
                .aBotao {
                    width: auto;
                }
            }
            svg {
                vertical-align: middle;
                margin-right: 8px;
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
                <a href="sair.php" class="btn btn-danger me-5">Sair</a>
            </div>
        </nav>
        <br>
        <?php
            echo "<h1>Bem vindo $logado</h1>";
            echo "<h2>Alunos Cadastrados</h2>";
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
        <a href="lista_livros.php" class="aBotao"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6.5 2A2.5 2.5 0 0 0 4 4.5v15A2.5 2.5 0 0 0 6.5 22h6.034c-.318-.416-.534-.924-.534-1.5H6.5a1 1 0 0 1-1-1H12v-5.207l.008.007c.099-1.166 1.052-1.984 2.01-2.462C15.087 11.302 16.497 11 18 11c.573 0 1.13.044 1.655.127c.29.045.573.103.845.172V4.5A2.5 2.5 0 0 0 18 2H6.5ZM8 5h8a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm11.5 7.114a7.684 7.684 0 0 1 1.5.386c1.214.456 2 1.182 2 2c0 .818-.786 1.544-2 2a7.71 7.71 0 0 1-1.5.386A9.691 9.691 0 0 1 18 17c-2.761 0-5-1.12-5-2.5s2.239-2.5 5-2.5c.523 0 1.026.04 1.5.114Zm0 5.782a9.081 9.081 0 0 0 1.5-.338c.35-.112.68-.245.983-.396a4.86 4.86 0 0 0 1.017-.67V20.5c0 1.38-2.239 2.5-5 2.5c-2.05 0-3.812-.617-4.584-1.5c-.268-.306-.416-.644-.416-1v-4.008c.31.27.663.493 1.017.67c1.071.536 2.48.838 3.983.838c.514 0 1.017-.035 1.5-.104Z"/>
        </svg> Consultar Livros</a>
        <a href="javascript:void(0);" onclick="openPopup('novo_livro.php')" class="aBotao"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6.5 2A2.5 2.5 0 0 0 4 4.5v15A2.5 2.5 0 0 0 6.5 22h6.31a6.518 6.518 0 0 1-1.078-1.5H6.5a1 1 0 0 1-1-1h5.813a6.5 6.5 0 0 1 9.187-7.768V4.5A2.5 2.5 0 0 0 18 2H6.5ZM8 5h8a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm15 12.5a5.5 5.5 0 1 0-11 0a5.5 5.5 0 0 0 11 0Zm-5 .5l.001 2.503a.5.5 0 1 1-1 0V18h-2.505a.5.5 0 0 1 0-1H17v-2.5a.5.5 0 1 1 1 0V17h2.497a.5.5 0 0 1 0 1H18Z"/>
        </svg> Novo Livro</a>
        <a href="emprestimos.php" class="aBotao"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2"><path d="M20 12v5c0 1.886 0 2.828-.586 3.414C18.828 21 17.886 21 16 21H6.5a2.5 2.5 0 0 1 0-5H16c1.886 0 2.828 0 3.414-.586C20 14.828 20 13.886 20 12V7c0-1.886 0-2.828-.586-3.414C18.828 3 17.886 3 16 3H8c-1.886 0-2.828 0-3.414.586C4 4.172 4 5.114 4 7v11.5"/><path stroke-linecap="round" d="m9 10l1.293 1.293a1 1 0 0 0 1.414 0L15 8"/></g>
        </svg> Emprestimos</a>
        <a href="lista_alunos.php" class="aBotao"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><g fill="currentColor"><path d="m224 64l-96 32l-96-32l96-32Z" opacity=".2"/><path d="m226.53 56.41l-96-32a8 8 0 0 0-5.06 0l-96 32a8 8 0 0 0-5.4 6.75A5 5 0 0 0 24 64v80a8 8 0 0 0 16 0V75.1l33.59 11.19a64 64 0 0 0 20.65 88.05c-18 7.06-33.56 19.83-44.94 37.29a8 8 0 1 0 13.4 8.74C77.77 197.25 101.57 184 128 184s50.23 13.25 65.3 36.37a8 8 0 0 0 13.4-8.74c-11.38-17.46-27-30.23-44.94-37.29a64 64 0 0 0 20.65-88l44.12-14.7a8 8 0 0 0 0-15.18ZM176 120a48 48 0 1 1-86.65-28.45l36.12 12a8 8 0 0 0 5.06 0l36.12-12A47.89 47.89 0 0 1 176 120Zm-48-32.43L57.3 64L128 40.43L198.7 64Z"/></g>
        </svg> Alunos Cadastrados</a>
        <a href="javascript:void(0);" onclick="openPopup('cadastro_aluno.php')" class="aBotao"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path fill="currentColor" d="m16 7.78l-.313.095l-12.5 4.188L.345 13L2 13.53v8.75c-.597.347-1 .98-1 1.72a2 2 0 1 0 4 0c0-.74-.403-1.373-1-1.72v-8.06l2 .655V20c0 .82.5 1.5 1.094 1.97c.594.467 1.332.797 2.218 1.093c1.774.59 4.112.937 6.688.937c2.576 0 4.914-.346 6.688-.938c.886-.295 1.624-.625 2.218-1.093C25.5 21.5 26 20.82 26 20v-5.125l2.813-.938L31.655 13l-2.843-.938l-12.5-4.187L16 7.78zm0 2.095L25.375 13L16 16.125L6.625 13L16 9.875zm-8 5.688l7.688 2.562l.312.094l.313-.095L24 15.562V20c0 .01.004.126-.313.375c-.316.25-.883.565-1.625.813C20.58 21.681 18.395 22 16 22c-2.395 0-4.58-.318-6.063-.813c-.74-.247-1.308-.563-1.624-.812C7.995 20.125 8 20.01 8 20v-4.438z"/>
        </svg> Cadastrar Aluno</a>
        <a href="javascript:void(0);" onclick="openPopup('cadastro_admin.php')" class="aBotao"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><path fill="currentColor" d="M213.3 384c0-87 65.2-158.7 149.3-169.2v-1.5c5.5-8 21.3-21.3 21.3-42.7s-21.3-42.7-21.3-53.3C362.7 32 319.2 0 256 0c-60.5 0-106.7 32-106.7 117.3c0 10.7-21.3 32-21.3 53.3s15.2 35.4 21.3 42.7c0 0 0 21.3 10.7 53.3c0 10.7 21.3 21.3 32 32c0 10.7 0 21.3-10.7 42.7L64 362.7C21.3 373.3 0 448 0 512h271.4c-35.5-31.3-58.1-77-58.1-128zM384 256c-70.7 0-128 57.3-128 128s57.3 128 128 128s128-57.3 128-128s-57.3-128-128-128zm85.3 149.3h-64v64h-42.7v-64h-64v-42.7h64v-64h42.7v64h64v42.7z"/>
        </svg> Cadastrar Adm</a>

        <div class="m-5">
            <table class="table text-white table-bg">
                <thead>
                    <tr>
                        <th scope="col">Cód.</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Sobrenome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">R.A.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($user_data = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>".$user_data['id_aluno']."</td>";
                            echo "<td>".$user_data['nome']."</td>";
                            echo "<td>".$user_data['sobrenome']."</td>";
                            echo "<td>".$user_data['email']."</td>";
                            echo "<td>".$user_data['ra_dig']."</td>";
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
        window.location = 'lista_alunos.php?search='+search.value;
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
        function openPopup(url, width = 900, height = 600) {
            // Calcula as coordenadas X e Y para centralizar o popup na tela
            const left = (window.innerWidth - width) / 2 + window.screenX;
            const top = (window.innerHeight - height) / 2 + window.screenY;

            // Abre o popup centralizado
            window.open(url, "Popup", `width=${width},height=${height},left=${left},top=${top}`);
        }
    </script>
</html>
