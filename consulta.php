<?php
session_start();
include_once('conexao.php');

include_once('sinopses.php');
    // Array associativo para sinopses
    $id_sinopses = [
        0 => $id_sinopse0,
        1 => $id_sinopse1,
        2 => $id_sinopse2,
        3 => $id_sinopse3,
        4 => $id_sinopse4,
        5 => $id_sinopse5,
        6 => $id_sinopse6,
        7 => $id_sinopse7,
        8 => $id_sinopse8,
        9 => $id_sinopse9,
        10 => $id_sinopse10,
        11 => $id_sinopse11,
        12 => $id_sinopse12,
        13 => $id_sinopse13,
        14 => $id_sinopse14,
        15 => $id_sinopse15,
        16 => $id_sinopse16,
        17 => $id_sinopse17,
        18 => $id_sinopse18,
        19 => $id_sinopse19,
        20 => $id_sinopse20,
        21 => $id_sinopse21,
        22 => $id_sinopse22,
        23 => $id_sinopse23,
        24 => $id_sinopse24,
        25 => $id_sinopse25,
        26 => $id_sinopse26,
        27 => $id_sinopse27,
        28 => $id_sinopse28,
        29 => $id_sinopse29,
        30 => $id_sinopse30,
        31 => $id_sinopse31,
        32 => $id_sinopse32,
        33 => $id_sinopse33,
        34 => $id_sinopse34,
        35 => $id_sinopse35,
        36 => $id_sinopse36,
        37 => $id_sinopse37,
        38 => $id_sinopse38,
        39 => $id_sinopse39,
        40 => $id_sinopse40,
        41 => $id_sinopse41,
        42 => $id_sinopse42,
        43 => $id_sinopse43,
        44 => $id_sinopse44,
        45 => $id_sinopse45,
        46 => $id_sinopse46,
        47 => $id_sinopse47,
        48 => $id_sinopse48,
        49 => $id_sinopse49,
        50 => $id_sinopse50,
        51 => $id_sinopse51,
        52 => $id_sinopse52,
        69 => $id_sinopse69,
        70 => $id_sinopse70,
        71 => $id_sinopse71,
        72 => $id_sinopse72,
        73 => $id_sinopse73,
        74 => $id_sinopse74,
        75 => $id_sinopse75,
        76 => $id_sinopse76,
        77 => $id_sinopse77,
        78 => $id_sinopse78,
        79 => $id_sinopse79,
        80 => $id_sinopse80,
        81 => $id_sinopse81,
        82 => $id_sinopse82,
        83 => $id_sinopse83,
        84 => $id_sinopse84,
        85 => $id_sinopse85,
        86 => $id_sinopse86,
        87 => $id_sinopse87,
        88 => $id_sinopse88,
        89 => $id_sinopse89,
        90 => $id_sinopse90,
        91 => $id_sinopse91,
        92 => $id_sinopse92,
        93 => $id_sinopse93,
        94 => $id_sinopse94,
        95 => $id_sinopse95,
        96 => $id_sinopse96,
        97 => $id_sinopse97,
        98 => $id_sinopse98,
        99 => $id_sinopse99,
        101 => $id_sinopse101,
        102 => $id_sinopse102,
        113 => $id_sinopse113,
        114 => $id_sinopse114,
        115 => $id_sinopse115,
        116 => $id_sinopse116,
        117 => $id_sinopse117,
        118 => $id_sinopse118,
        119 => $id_sinopse119,
        120 => $id_sinopse120,
        121 => $id_sinopse121,
        122 => $id_sinopse122,
        123 => $id_sinopse123,
        124 => $id_sinopse124,
        125 => $id_sinopse125,
        126 => $id_sinopse126,
        127 => $id_sinopse127,
        128 => $id_sinopse128,
        130 => $id_sinopse130,
        131 => $id_sinopse131,
        132 => $id_sinopse132,
        133 => $id_sinopse133,
        134 => $id_sinopse134,
        135 => $id_sinopse135,
        136 => $id_sinopse136,
        137 => $id_sinopse137,
        138 => $id_sinopse138,
        139 => $id_sinopse139,
        140 => $id_sinopse140,
        141 => $id_sinopse141,
        142 => $id_sinopse142,
        143 => $id_sinopse143,
        144 => $id_sinopse144,
        145 => $id_sinopse145,
        146 => $id_sinopse146,
        147 => $id_sinopse147,
        148 => $id_sinopse148,
        149 => $id_sinopse149,
        150 => $id_sinopse150,
        151 => $id_sinopse151,
        152 => $id_sinopse152,
        153 => $id_sinopse153,
        154 => $id_sinopse154,
        155 => $id_sinopse155,
        156 => $id_sinopse156,
        157 => $id_sinopse157,
        182 => $id_sinopse182,
        183 => $id_sinopse183,
        184 => $id_sinopse184,
        185 => $id_sinopse185,
        186 => $id_sinopse186,
        187 => $id_sinopse187,
        188 => $id_sinopse188,
        189 => $id_sinopse189,
        190 => $id_sinopse190,
        191 => $id_sinopse191,
        192 => $id_sinopse192,
        193 => $id_sinopse193,
        194 => $id_sinopse194,
        195 => $id_sinopse195,
        196 => $id_sinopse196,
        197 => $id_sinopse197,
        198 => $id_sinopse198,
    ];

    // Array associativo para imagens
    $id_imagens = [
        0 => $id_img0,
        1 => $id_img1,
        2 => $id_img2,
        3 => $id_img3,
        4 => $id_img4,
        5 => $id_img5,
        6 => $id_img6,
        7 => $id_img7,
        8 => $id_img8,
        9 => $id_img9,
        10 => $id_img10,
        11 => $id_img11,
        12 => $id_img12,
        13 => $id_img13,
        14 => $id_img14,
        15 => $id_img15,
        16 => $id_img16,
        17 => $id_img17,
        18 => $id_img18,
        19 => $id_img19,
        20 => $id_img20,
        21 => $id_img21,
        22 => $id_img22,
        23 => $id_img23,
        24 => $id_img24,
        25 => $id_img25,
        26 => $id_img26,
        27 => $id_img27,
        28 => $id_img28,
        29 => $id_img29,
        30 => $id_img30,
        31 => $id_img31,
        32 => $id_img32,
        33 => $id_img33,
        34 => $id_img34,
        35 => $id_img35,
        36 => $id_img36,
        37 => $id_img37,
        38 => $id_img38,
        39 => $id_img39,
        40 => $id_img40,
        41 => $id_img41,
        42 => $id_img42,
        43 => $id_img43,
        44 => $id_img44,
        45 => $id_img45,
        46 => $id_img46,
        47 => $id_img47,
        48 => $id_img48,
        49 => $id_img49,
        50 => $id_img50,
        51 => $id_img51,
        52 => $id_img52,
        69 => $id_img69,
        70 => $id_img70,
        71 => $id_img71,
        72 => $id_img72,
        73 => $id_img73,
        74 => $id_img74,
        75 => $id_img75,
        76 => $id_img76,
        77 => $id_img77,
        78 => $id_img78,
        79 => $id_img79,
        80 => $id_img80,
        81 => $id_img81,
        82 => $id_img82,
        83 => $id_img83,
        84 => $id_img84,
        85 => $id_img85,
        86 => $id_img86,
        87 => $id_img87,
        88 => $id_img88,
        89 => $id_img89,
        90 => $id_img90,
        91 => $id_img91,
        92 => $id_img92,
        93 => $id_img93,
        94 => $id_img94,
        95 => $id_img95,
        96 => $id_img96,
        97 => $id_img97,
        98 => $id_img98,
        99 => $id_img99,
        101 => $id_img101,
        102 => $id_img102,
        113 => $id_img113,
        114 => $id_img114,
        115 => $id_img115,
        116 => $id_img116,
        117 => $id_img117,
        118 => $id_img118,
        119 => $id_img119,
        120 => $id_img120,
        121 => $id_img121,
        122 => $id_img122,
        123 => $id_img123,
        124 => $id_img124,
        125 => $id_img125,
        126 => $id_img126,
        127 => $id_img127,
        128 => $id_img128,
        130 => $id_img130,
        131 => $id_img131,
        132 => $id_img132,
        133 => $id_img133,
        134 => $id_img134,
        135 => $id_img135,
        136 => $id_img136,
        137 => $id_img137,
        138 => $id_img138,
        139 => $id_img139,
        140 => $id_img140,
        141 => $id_img141,
        142 => $id_img142,
        143 => $id_img143,
        144 => $id_img144,
        145 => $id_img145,
        146 => $id_img146,
        147 => $id_img147,
        148 => $id_img148,
        149 => $id_img149,
        150 => $id_img150,
        151 => $id_img151,
        152 => $id_img152,
        153 => $id_img153,
        154 => $id_img154,
        155 => $id_img155,
        156 => $id_img156,
        182 => $id_img182,
        183 => $id_img183,
        184 => $id_img184,
        185 => $id_img185,
        186 => $id_img186,
        187 => $id_img187,
        188 => $id_img188,
        189 => $id_img189,
        190 => $id_img190,
        191 => $id_img191,
        192 => $id_img192,
        193 => $id_img193,
        194 => $id_img194,
        195 => $id_img195,
        196 => $id_img196,
        197 => $id_img197,
        198 => $id_img198,
    ];

    // Função para obter a sinopse com base no ID do livro
    function getSinopse($livroId, $sinopses)
    {
        return isset($sinopses[$livroId]) ? $sinopses[$livroId] : 'Sinopse não disponível';
    }

    // Função para obter a URL da imagem com base no ID do livro
    function getImagemUrl($livroId, $imagens)
    {
        return isset($imagens[$livroId]) ? $imagens[$livroId] : "src='capas/0.jpg'";
    }

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
                background: linear-gradient(to right, #7a60ff, #cd9ffa);
                color: white;
                text-align: center;
            }
            .bg-navbar{
                background: rgba(210, 191, 191, 0.493);
            }
            .table-bg{
                background: rgba(0, 0, 0, 0.3);
                border-radius: 15px 15px 0 0;
            }

            .box-search{
                display: flex;
                justify-content: center;
                gap: .0.5%;
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
                background-color: #8466fb;
                box-sizing: border-box;
            }
            .aBotao:hover{
                background-color:#9c7cfc;
                color: black;
            }
            @media (min-width: 600px) {
                .aBotao {
                    width: auto;
                }
            }
            #counter {
            font-size: 16px;
            color: white;
            cursor: pointer;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">BIBLIOTECA</a>
            </div>
            <div class="d-flex">
                <a href="index.html" class="btn btn-danger me-5">Voltar</a>
            </div>
        </nav>
        <br>
        <?php
            echo "<h1>Bem Vindo!</h1>";
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

        <a href="consulta.php" class="aBotao"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6.5 2A2.5 2.5 0 0 0 4 4.5v15A2.5 2.5 0 0 0 6.5 22h6.034c-.318-.416-.534-.924-.534-1.5H6.5a1 1 0 0 1-1-1H12v-5.207l.008.007c.099-1.166 1.052-1.984 2.01-2.462C15.087 11.302 16.497 11 18 11c.573 0 1.13.044 1.655.127c.29.045.573.103.845.172V4.5A2.5 2.5 0 0 0 18 2H6.5ZM8 5h8a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm11.5 7.114a7.684 7.684 0 0 1 1.5.386c1.214.456 2 1.182 2 2c0 .818-.786 1.544-2 2a7.71 7.71 0 0 1-1.5.386A9.691 9.691 0 0 1 18 17c-2.761 0-5-1.12-5-2.5s2.239-2.5 5-2.5c.523 0 1.026.04 1.5.114Zm0 5.782a9.081 9.081 0 0 0 1.5-.338c.35-.112.68-.245.983-.396a4.86 4.86 0 0 0 1.017-.67V20.5c0 1.38-2.239 2.5-5 2.5c-2.05 0-3.812-.617-4.584-1.5c-.268-.306-.416-.644-.416-1v-4.008c.31.27.663.493 1.017.67c1.071.536 2.48.838 3.983.838c.514 0 1.017-.035 1.5-.104Z"/>
        </svg> Consultar Livros</a>

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
                    while ($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $user_data['id_livro'] . "</td>";
                        echo "<td>" . $user_data['titulo_livro'] . "</td>";
                        echo "<td>" . $user_data['autor_livro'] . "</td>";
                        echo "<td>" . $user_data['genero_livro'] . "</td>";
                        echo "<td align='center'>" . $user_data['qtd_livro'] . "</td>";

                        // Obtendo sinopse e URL da imagem com base no ID do livro
                        $livroId = $user_data['id_livro'];
                        $sinopse = getSinopse($livroId, $id_sinopses);
                        $imagemUrl = getImagemUrl($livroId, $id_imagens);

                        echo "</tr>";
                        // Exibindo a sinopse e a imagem dentro da tabela
                        echo "<tr>";
                        echo "<td colspan='6'>
                                <div style='display: flex; align-items: center;'>
                                    <img src='$imagemUrl' alt='Capa do Livro' style='max-width: 150px; margin-right: 20px;'>
                                    <div style='max-width: 600px; margin-right: 20px;'>
                                        <p>Sinopse: $sinopse</p>
                                    </div>
                                </div>
                            </td>";
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
        window.location = 'consulta.php?search='+search.value;
    }
    </script>
</html>