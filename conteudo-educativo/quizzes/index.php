<?php
include '../../includes/header.php';

session_start();
require_once ("../../conn/conn.php");

// Verifica se a sessão do usuário está definida
if (isset($_SESSION['id_utilizador'])) {

    // Se a sessão do usuário já estiver definida, você pode executar outras ações aqui
    echo "Sessão do utilizador já está definida. ID do utilizador: " . $_SESSION['id_utilizador'];

    $utilizador_id = $_SESSION['id_utilizador'];

    // Consulta SQL para buscar o campo img_perfil
    $query = "SELECT nome, img_perfil FROM utilizadores WHERE utilizador_id = $utilizador_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // Extrair o resultado da consulta
        $row = mysqli_fetch_assoc($result);
    }
} else {
    echo "NÃO DEU";
}
?>

<body>
    <style>
        #chatbotContainer {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            /* Z-index alto para garantir que o iframe fique acima de outros elementos */
        }

        /* Estilo para o iframe */
        #chatbotFrame {
            width: 400px;
            height: 600px;
            border: none;
        }

        .btn-confirm {
            background-color: #fe9e0d;
            color: white;
            border: none;
            outline: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        .btn-confirm:hover {
            background-color: #c27500;
        }

        .btn-cancel {
            background-color: #d33;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }

        .btn-cancel:hover {
            background-color: #b32424;
        }
    </style>
    <header>
        <div class="navbar">
            <div class="logo">Portal de <br> Saúde Mental.</div>

            <ul class="links">
                <li><a href="../../paginainicial">Página Inicial</a></li>
                <li><a href="../../sobre-nos">Sobre Nós</a></li>
                <li><a href="../../perturbacoes">Perturbações</a></li>
                <li><a href="../../artigos">Artigos</a></li>
                <li><a href="../../noticias">Notícias</a></li>
                <li><a href="..">Conteúdo Educativo</a>
                    <i class="fas fa-chevron-down"></i>
                    <ul class="dropdown">
                        <li><a href="">Quizzes</a></li>
                        <li><a href="../exercicios-mindfulness">Exercícios Mindfulness</a></li>
                        <li><a href="../ted-talks">TED Talks</a></li>
                    </ul>
                </li>
                </li>
            </ul>

            <?php if (!empty($_SESSION['id_utilizador'])): ?>
                <li class="dropdown-container">
                    <div class="profile-dropdown">
                        <img class="img-profile rounded-circle" src="../../areacliente/registo/imgs/<?php if (!empty($row["img_perfil"])) {
                            echo $row["img_perfil"];
                        } else {
                            echo "teste.jpeg";
                        } ?>" alt="Imagem de Perfil">
                        <i class="fas fa-chevron-down" style="margin-right: 20px;"></i>
                        <ul class="dropdown-p">
                            <li><a href="../../perfil/">Perfil</a></li>
                            <!--<li><a href="#">Termos e Condições</a></li>
                            <li><a href="#">Definições</a></li>-->
                        </ul>
                    </div>
                    <a class="btn" onclick="logout()">Terminar Sessão</a>
                </li>
            <?php else: ?>
                <li><a class="btn" href="../../areacliente/login/">Iniciar Sessão</a></li>
            <?php endif ?>

            <div class="toggle_btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>


        <div class="dropdown_menu">
            <li><a href="../../paginainicial">Página Inicial</a></li>
            <li><a href="../../sobre-nos">Sobre Nós</a></li>
            <li><a href="../../perturbacoes">Perturbações</a></li>
            <li><a href="../../artigos">Artigos</a></li>
            <li><a href="../../noticias">Notícias</a></li>
            <li class="dropdown-trigger"><a href="..">Conteúdo Educativo <i class="fas fa-chevron-down"></i></a>
                <ul class="dropdown">
                    <li><a href="">Quizzes</a></li>
                    <li><a href="../exercicios-mindfulness">Exercícios Mindfulness</a></li>
                    <li><a href="../ted-talks">TED Talks</a></li>
                </ul>
            </li>

            <?php if (!empty($_SESSION['id_utilizador'])): ?>
                <li class="dropdown-trigger">
                    <a href="#">
                        <img class="img-profile rounded-circle" src="../../areacliente/registo/imgs/<?php if (!empty($row["img_perfil"])) {
                            echo $row["img_perfil"];
                        } else {
                            echo "teste.jpeg";
                        } ?>" alt="Imagem de Perfil">
                        <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown">
                        <li><a href="../../perfil/">Perfil</a></li>
                        <!--<li><a href="#">Termos e Condições</a></li>
                        <li><a href="#">Definições</a></li>-->
                    </ul>
                </li>
                <li><a class="btn" onclick="logout()">Terminar Sessão</a></li>
            <?php else: ?>
                <li><a class="btn" href="../../areacliente/login/">Iniciar Sessão</a></li>
            <?php endif ?>


            <script>
                function logout() {
                    Swal.fire({
                        title: 'Deseja realmente terminar sessão?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sim',
                        cancelButtonText: 'Não',
                        customClass: {
                            confirmButton: 'btn-confirm',
                            cancelButton: 'btn-cancel'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "../../logout/logout.php";
                        }
                    });
                }
            </script>
        </div>
    </header>


    <ol role="list">
        <li class="list">
            <div class="items">
                <a href=".." class="text-sm">
                    Conteúdo Educativo</a>
                <span class="separator">/</span>
            </div>
        </li>

        <li class="list">
            <div class="items-current">
                <div class="text-sm" aria-current=page>
                    Quizzes
                </div>
            </div>
        </li>
    </ol>

    <div class="heading">
        <h1>
            Descobre o que és
        </h1>
    </div>


    <!--Backgrounds-->
    <div class="background1">
        <img src="../ted-talks/imgs/imgs-backgrounds/background2.png" alt="banner background" />
    </div>

    <div class="background2">
        <img src="../ted-talks/imgs/imgs-backgrounds/background2.png" alt="banner background" />
    </div>

    <!--Quizzes-->
    <section class="quizzes" id="quizzes">
        <div class="quizzes-banner-container">
            <div class="quizzes-bannerImage4-container">
                <img src="imgs/imgs-backgrounds/background4.png" alt="banner background" />
            </div>
            <h1 class="quizzes-second-heading"></h1>
        </div>
        <div class="card4-container">
            <?php
            $query = "SELECT * FROM quiz_nome";
            $query_run = mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>
                    <?php
                    $nome_codificado = urlencode($row["nome"]);
                    ?>
                    <a href="quizz/?nome=<?php echo $nome_codificado; ?>&quiz_nome_id=<?php echo $row['quiz_nome_id']; ?>"
                        onclick="loadQuizData(<?php echo $row['quiz_nome_id']; ?>);">

                        <!-- Conteúdo do link aqui -->

                        <!-- Adicione o onclick aqui -->
                        <div class="card4">
                            <div class="card4-content">
                                <h1><?php echo $row['nome']; ?></h1>
                            </div>
                            <div class="card4-content2">
                                <img src="../../admin/inserir/imgs/quizzes/<?php if (!empty($row["img_quiz"])) {
                                    echo $row["img_quiz"];
                                } else {
                                    echo "teste.jpeg";
                                } ?>" alt="Quizz">
                            </div>
                        </div>
                    </a>
                    <?php
                }
            } else {
                echo '<div style="margin: 100px 100px 30px 100px; font-size: 20px;">Nenhuma perturbação encontrada.</div>';
            }
            ?>
        </div>
    </section>




    <!--Scroll to top-->
    <button onclick="scrollTopFunction()" id="scrollToTopBtn" title="Go to top"><i
            class="fas fa-chevron-up"></i></button>



    <!--Footer-->
    <footer>
        <div class="footer-row">
            <div class="footer-col">
                <h1>Portal de <br> Saúde Mental.</h1>
                <p>Tu mereces ser feliz.</p>
            </div>

            <?php

            $query = "SELECT nome, img_perturbacao FROM perturbacoes";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                ?>
                <div class="footer-col">
                    <h3>Perturbações</h3>
                    <?php

                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <ul>
                            <?php

                            $nome_codificado = urlencode($row["nome"]);
                            ?>
                            <li><a
                                    href="../../perturbacoes/grupo-perturbacoes/?nome=<?php echo $nome_codificado; ?>"><?php echo $row["nome"] ?></a>
                            </li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>

            <!--Artigos-->
            <?php

            $query = "SELECT titulo FROM artigos LIMIT 3";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                ?>

                <div class="footer-col">
                    <h3>Artigos</h3>
                    <?php

                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                        <ul>
                            <?php
                            $titulo_codificado = urlencode($row["titulo"]);
                            ?>
                            <li><a
                                    href="../../artigos/artigo/?titulo=<?php echo $titulo_codificado; ?>"><?php echo $row["titulo"] ?></a>
                            </li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>

            <!--Notícias-->
            <?php

            $query = "SELECT titulo FROM noticias LIMIT 3";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                ?>

                <div class="footer-col">
                    <h3>Notícias</h3>
                    <?php

                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                        <ul>
                            <?php
                            $titulo_codificado = urlencode($row["titulo"]);
                            ?>
                            <li><a
                                    href="../../noticias/noticia/?titulo=<?php echo $titulo_codificado; ?>"><?php echo $row["titulo"] ?></a>
                            </li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>

            <!--Contactos-->
            <div class="footer-col">
                <h3>Contactos</h3>
                <ul>
                    <li><a href="#" target="_blank">Apoio Psicológico</a>
                        <ul>
                            <li>24h/dia</li>
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li><a href="#" target="_blank">Vira(l)Solidariedade</a>
                        <ul>
                            <li>Todos os dias das 08h00 às 00h00</li>
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li><a href="#" target="_blank">SOS Voz Amiga</a>
                        <ul>
                            <li>Todos os dias das 15:30h às 00:30h</li>
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li><a href="#" target="_blank">Linha Conversa Amiga</a>
                        <ul>
                            <li>Dias úteis das 15h00 às 22h00</li>
                            <li>Fins de semana das 19h00 às 22h00</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <hr>

        <div class="footer-links">
            <p class="copyright">@2024 Todos os direitos reservados</p>
            <div class="footer-links-2">
                <a href="../../termos-e-condicoes">Termos e Condições</a>

                <div class="vertical-hr"></div>

                <a href="../../perguntas-frequentes">Perguntas Frequentes</a>

                <div class="vertical-hr"></div>

                <!--<li class="dropdown-trigger-f"><i class="fas fa-globe"></i>Idioma <i class="fas fa-chevron-down"></i>
                    <ul class="dropdown-f">
                        <li><a href="#" id="portugues" onclick="changeLanguage('portuguese')">Português</a></li>
                        <li><a href="#" id="ingles" onclick="changeLanguage('english')">Inglês</a></li>
                    </ul>
                </li>

                <span><a href="?lang=en-GB" class="lang-link active">EN</a> / <a href="?lang=pt-PT"
                        class="lang-link">PT</a></span>

                <div class="vertical-hr"></div>-->

                Light/Dark<button id="dark-mode-toggle" class="dark-mode-toggle">
                    <svg width="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 496">
                        <path fill="currentColor"
                            d="M8,256C8,393,119,504,256,504S504,393,504,256,393,8,256,8,8,119,8,256ZM256,440V72a184,184,0,0,1,0,368Z"
                            transform="translate(-8 -8)" />
                    </svg>
                </button>
            </div>
        </div>
    </footer>

    <div class="loader">A carregar...</div>

    <!--Chatbot-->
    <!--<div id="chatbotContainer">
        <iframe id="chatbotFrame" src="http://127.0.0.1:5000/"></iframe>
    </div>-->


    <script src="js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="../../darkmode/darkmode.js"></script>

</body>

</html>