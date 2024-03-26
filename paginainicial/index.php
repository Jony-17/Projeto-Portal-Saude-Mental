<?php
session_start();
require_once ("../conn/conn.php");

// Verifica se a sessão do usuário está definida
if (isset ($_SESSION['id_utilizador'])) {

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


<!DOCTYPE html>
<html>

<head>
    <title>Portal de Saúde Mental</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imgs/logo.png">

    <link rel="stylesheet" type="text/css" href="css/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kode+Mono:wght@400..700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Saira+Condensed:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <style>
        #chatbotContainer {
            position: fixed;
            bottom: 50px;
            right: -10px;
            z-index: 9999;
            /* Z-index alto para garantir que o iframe fique acima de outros elementos */
        }

        /* Estilo para o iframe */
        #chatbotFrame {
            width: 400px;
            height: 600px;
            border: none;
        }
    </style>

    <header>
        <div class="navbar">
            <div class="logo">Portal de <br> Saúde Mental.</div>

            <ul class="links">
                <li><a href="#about">Sobre Nós</a></li>
                <li><a href="../perturbacoes">Perturbações</a></li>
                <li><a href="../artigos">Artigos</a></li>
                <li><a href="#noticias">Notícias</a></li>
                <li><a href="#">Conteúdo Educativo</a>
                    <i class="fas fa-chevron-down"></i>
                    <ul class="dropdown">
                        <li><a href="../quizzes">Quizzes</a></li>
                        <li><a href="#">Exercícios Mindfulness</a></li>
                        <li><a href="#">TED Talks</a></li>
                    </ul>
                </li>
                </li>
            </ul>

            <?php if (!empty ($_SESSION['id_utilizador'])): ?>
                <li class="dropdown-container">
                    <div class="profile-dropdown">
                        <img class="img-profile rounded-circle" src="../areacliente/registo/imgs/<?php if (!empty ($row["img_perfil"])) {
                            echo $row["img_perfil"];
                        } else {
                            echo "teste.jpeg";
                        } ?>" alt="Imagem de Perfil">
                        <i class="fas fa-chevron-down" style="margin-right: 20px;"></i>
                        <ul class="dropdown-p">
                            <li><a href="../perfil/">Perfil</a></li>
                            <!--<li><a href="#">Termos e Condições</a></li>
                            <li><a href="#">Definições</a></li>-->
                        </ul>
                    </div>
                    <a class="btn" onclick="funcao1()">Terminar Sessão</a>
                </li>
            <?php else: ?>
                <li><a class="btn" href="../areacliente/login/">Iniciar Sessão</a></li>
            <?php endif ?>

            <div class="toggle_btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>


        <div class="dropdown_menu">
            <li><a href="../quizzes/index.php">Sobre Nós</a></li>
            <li><a href="../perturbacoes">Perturbações</a></li>
            <li><a href="../artigos">Artigos</a></li>
            <li><a href="#portfolio">Notícias</a></li>
            <li class="dropdown-trigger"><a href="#">Conteúdo Educativo <i class="fas fa-chevron-down"></i></a>
                <ul class="dropdown">
                    <li><a href="../quizzes">Quizzes</a></li>
                    <li><a href="#">Exercícios Mindfulness</a></li>
                    <li><a href="#">TED Talks</a></li>
                </ul>
            </li>

            <?php if (!empty ($_SESSION['id_utilizador'])): ?>
                <li class="dropdown-trigger">
                    <a href="#">
                        <img class="img-profile rounded-circle" src="../areacliente/registo/imgs/<?php if (!empty ($row["img_perfil"])) {
                            echo $row["img_perfil"];
                        } else {
                            echo "teste.jpeg";
                        } ?>" alt="Imagem de Perfil">
                        <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown">
                        <li><a href="../perfil/">Perfil</a></li>
                        <!--<li><a href="#">Termos e Condições</a></li>
                        <li><a href="#">Definições</a></li>-->
                    </ul>
                </li>
                <li><a class="btn" onclick="funcao1()">Terminar Sessão</a></li>
            <?php else: ?>
                <li><a class="btn" href="../areacliente/login/">Iniciar Sessão</a></li>
            <?php endif ?>


            <script>
                function funcao1() {
                    var r = confirm("Deseja realmente terminar sessão?");
                    if (r == true) {
                        var url = "../logout/logout.php";
                        window.location = url;
                    }
                    document.getElementById("demo").innerHTML = x;
                }
            </script>
        </div>
    </header>

    <!--Home-->
    <section class="home" id="home">
        <div class="home-banner-container">
            <div class="home-bannerImage-container">
                <img src="imgs/imgs-backgrounds/background1.png" alt="banner background" />
            </div>

            <div class="home-text-section">
                <h1 class="home-primary-heading">
                    Saúde Mental <br> É Uma Prioridade
                </h1>
                <p class="home-primary-text">
                    Healthy switcher chefs do all the prep work, like
                    peeding, chopping & marinating, so you can cook
                    a fresh food.
                </p>
                <a href="#about" class="secondary-button">
                    <i class="fas fa-arrow-down"></i> Sabe mais
                </a>
            </div>
            <div class="image-container2">
                <img src="imgs/imgs-home/image1.png" alt="" />
            </div>
        </div>
    </section>


    <!--About-->
    <section class="about" id="about">
        <div class="about-banner-container">
            <div class="about-bannerImage2-container">
                <img src="imgs/imgs-backgrounds/background2.png" alt="banner background" />
            </div>

            <div class="about-bannerImage3-container">
                <img src="imgs/imgs-backgrounds/background3.png" alt="banner background" />
            </div>

            <div class="image-container">
                <img src="imgs/imgs-about/image2.png" alt="" />
            </div>

            <div class="about-text-section">
                <h2 class="about-primary-heading">A nossa missão</h2>
                <h1 class="primary-heading">
                    Nós queremos <br> saber de ti
                </h1>
                <p class="about-primary-text">
                    Healthy switcher chefs do all the prep work, like
                    peeding, chopping & marinating, so you can cook
                    a fresh food.
                </p>
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-comments"></i>
                        <h1 class="card-title">Fórum de discussão</h1>
                    </div>

                    <div class="card-body">
                        <i class="fas fa-robot"></i>
                        <h1 class="card-title">Chatbot com ajuda personalizada</h1>
                    </div>

                    <div class="card-body">
                        <i class="fas fa-sticky-note"></i>
                        <h1 class="card-title">Conteúdo educativo</h1>
                    </div>

                    <div class="card-body">
                        <i class="far fa-newspaper"></i>
                        <h1 class="card-title">Notícias de saúde mental sempre atualizadas</h1>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!--Tipos Perturbações Mentais-->
    <section class="perturbacoes" id="perturbacoes">
        <div class="perturbacoes-banner-container">
            <h2 class="perturbacoes-primary-heading">Tipos</h2>
            <div class="perturbacoes-banner-container2">
                <h1 class="perturbacoes-second-heading">
                    Perturbações Mentais
                </h1>
                <a href="../perturbacoes" class="third-button">Ver mais</a>
            </div>
        </div>
        <div class="card2-container">
            <div class="card2">
                <a href="#">
                    <img src="imgs/imgs-perturbacoes/pert-perso-circle.png" alt="Depressão">
                </a>
                <h1>Perturbações de Personalidade</h1>
            </div>
            <div class="card2">
                <a href="#">
                    <img src="imgs/imgs-perturbacoes/pert-humor-circle.png" alt="Depressão">
                </a>
                <h1>Perturbações de Humor</h1>
            </div>
            <div class="card2">
                <a href="#">
                    <img src="imgs/imgs-perturbacoes/pert-sono-circle.png" alt="Depressão">
                </a>
                <h1>Perturbações do Sono</h1>
            </div>
            <div class="card2">
                <a href="../perturbacoes/perturbacoes-ansiedade/">
                    <img src="imgs/imgs-perturbacoes/pert-ansie-circle.png" alt="Depressão">
                </a>
                <h1>Perturbações de Ansiedade</h1>
            </div>
        </div>
    </section>


    <!--Artigos científicos-->
    <section class="artigos" id="artigos">
        <div class="artigos-banner-container">
            <div class="artigos-bannerImage2-container">
                <img src="imgs/imgs-backgrounds/background2.png" alt="banner background" />
            </div>
            <h2 class="artigos-primary-heading">Artigos Científicos</h2>
            <h1 class="artigos-second-heading">
                Últimas publicações
            </h1>
        </div>
        <div class="card3-container">
            <div class="card3">
                <a href="#">
                    <img src="imgs/imgs-artigos/artigo1.webp" alt="O que é a saúde mental?">
                </a>
                <div class="card3-content">
                    <h1>O que é a saúde mental?</h1>
                    <p>Publicado: 20 de fevereiro de 2024</p>
                    <p>Autor: João Araújo</p>
                </div>
            </div>
            <div class="card3">
                <a href="#">
                    <img src="imgs/imgs-artigos/artigo2.webp" alt="Os traumas e consequências">
                </a>
                <div class="card3-content">
                    <h1>Os traumas e consequências</h1>
                    <p>Publicado: 20 de fevereiro de 2024</p>
                    <p>Autor: João Araújo</p>
                </div>
            </div>
            <div class="card3">
                <a href="#">
                    <img src="imgs/imgs-artigos/artigo2.webp" alt="Os traumas e consequências">
                </a>
                <div class="card3-content">
                    <h1>Os traumas e consequências</h1>
                    <p>Publicado: 20 de fevereiro de 2024</p>
                    <p>Autor: João Araújo</p>
                </div>
            </div>
        </div>
        <a href="#" class="fourth-button">Ver mais</a>
    </section>


    <!--Quizzes-->
    <section class="quizzes" id="quizzes">
        <div class="quizzes-banner-container">
            <div class="quizzes-bannerImage4-container">
                <img src="imgs/imgs-backgrounds/background4.png" alt="banner background" />
            </div>
            <h2 class="quizzes-primary-heading">Quizzes</h2>
            <h1 class="quizzes-second-heading">
                Descobre o que és
            </h1>
        </div>
        <div class="card4-container">
            <a href="../quizzes/quizzes-empatia">
                <div class="card4">
                    <div class="card4-content">
                        <h1>O quão empática/o és?</h1>
                    </div>
                    <div class="card4-content2">
                        <img src="imgs/imgs-quizzes/emocao.png" alt="O que é a saúde mental?">
                    </div>
                </div>
            </a>
            <a href="../quizzes/quizzes-emocao">
                <div class="card4">
                    <div class="card4-content">
                        <h1>O quão livre és, emocionalmente?</h1>
                    </div>
                    <div class="card4-content2">
                        <img src="imgs/imgs-quizzes/lider.png" alt="O que é a saúde mental?">
                    </div>
                </div>
            </a>
        </div>
        <a href="../quizzes" class="fifth-button">Ver mais</a>
    </section>


    <!--Notícias-->
    <section class="noticias" id="noticias">
        <div class="noticias-banner-container">
            <div class="noticias-bannerImage2-container">
                <img src="imgs/imgs-backgrounds/background2.png" alt="banner background" />
            </div>
            <h2 class="noticias-primary-heading">Notícias</h2>
            <div class="noticias-banner-container2">
                <h1 class="noticias-second-heading">
                    Saúde Mental
                </h1>
                <a href="#" class="sixth-button">Ver mais</a>
            </div>
        </div>


        <div class="image-grid">

            <div class="image-grid-container1">
                <a href="#">
                    <div class="image-grid-container1text">
                        <h2>Vamos falar de saúde mental</h2>
                        <p>João Araújo</p>
                    </div>
                </a>
            </div>

            <div class="image-grid-container2">
                <a href="#">
                    <div class="image-grid-container2text">
                        <h2>Vamos falar de saúde mental</h2>
                        <p>João Araújo</p>
                    </div>
                </a>
            </div>

            <div class="image-grid-container3">
                <a href="#">
                    <div class="image-grid-container2text">
                        <h2>Vamos falar de saúde mental</h2>
                        <p>João Araújo</p>
                    </div>
                </a>
            </div>

            <div class="image-grid-container4">
                <a href="#">
                    <div class="image-grid-container2text">
                        <h2>Vamos falar de saúde mental</h2>
                        <p>João Araújo</p>
                    </div>
                </a>
            </div>

            <div class="image-grid-container5">
                <a href="#">
                    <div class="image-grid-container2text">
                        <h2>Vamos falar de saúde mental</h2>
                        <p>João Araújo</p>
                    </div>
                </a>
            </div>

        </div>
    </section>

    <!--Perguntas Frequentes-->
    <section class="perguntas" id="perguntas">
        <div class="perguntas-banner-container">
            <div class="perguntas-bannerImage5-container">
                <img src="imgs/imgs-backgrounds/background5.png" alt="banner background" />
            </div>
            <h2 class="perguntas-primary-heading">O que precisas de saber</h2>
            <h1 class="perguntas-second-heading">
                Perguntas Frequentes
            </h1>
        </div>
        <div class="faq">
            <div class="question">
                <h3>What is</h3>
                <svg width="15" height="10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M207 381.5L12.7 187.1c-9.4-9.4-9.4-24.6 0-33.9l22.7-22.7c9.4-9.4 24.5-9.4 33.9 0L224 284.5l154.7-154c9.4-9.3 24.5-9.3 33.9 0l22.7 22.7c9.4 9.4 9.4 24.6 0 33.9L241 381.5c-9.4 9.4-24.6 9.4-33.9 0z" />
                </svg>
            </div>
            <div class="answer">
                <p>testetestestestetetetetetetetetete</p>
            </div>
        </div>

        <div class="faq">
            <div class="question">
                <h3>It is</h3>
                <svg width="15" height="10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M207 381.5L12.7 187.1c-9.4-9.4-9.4-24.6 0-33.9l22.7-22.7c9.4-9.4 24.5-9.4 33.9 0L224 284.5l154.7-154c9.4-9.3 24.5-9.3 33.9 0l22.7 22.7c9.4 9.4 9.4 24.6 0 33.9L241 381.5c-9.4 9.4-24.6 9.4-33.9 0z" />
                </svg>
            </div>
            <div class="answer">
                <p>testetestestestetetetetetetetetete</p>
            </div>
        </div>

        <div class="faq">
            <div class="question">
                <h3>Why the</h3>
                <svg width="15" height="10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M207 381.5L12.7 187.1c-9.4-9.4-9.4-24.6 0-33.9l22.7-22.7c9.4-9.4 24.5-9.4 33.9 0L224 284.5l154.7-154c9.4-9.3 24.5-9.3 33.9 0l22.7 22.7c9.4 9.4 9.4 24.6 0 33.9L241 381.5c-9.4 9.4-24.6 9.4-33.9 0z" />
                </svg>
            </div>
            <div class="answer">
                <p>testetestestestetetetetetetetetete</p>
            </div>
        </div>
    </section>


    <!--Newsletter-->
    <?php if (empty ($_SESSION['id_utilizador'])): ?>
        <section class="newsletter" id="newsletter">
            <div class="newsletter-container">
                <div class="box-newsletter">
                    <h2>Junta-te à nossa comunidade!</h2>
                    <p>Aqui poderás ter acesso a informação credível e fundamental
                        no que toca à saúde mental</p>
                    <a href="../areacliente/registo/">Registar</a>
                </div>
            </div>
        </section>
    <?php endif; ?>


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

            <div class="footer-col">
                <h3>Perturbações</h3>
                <ul>
                    <li><a href="../perturbacoes/perturbacoes-ansiedade/">Perturbações de Ansiedade</a></li>
                    <li><a href="#">Perturbações do Sono - Vigília</a></li>
                    <li><a href="#">Perturbações de Humor</a></li>
                    <li><a href="#">Perturbações Alimentares</a></li>
                    <li><a href="#">Perturbações Obsessivo-Compulsivas</a></li>
                    <li><a href="#">Perturbações de Personalidade</a></li>
                    <li><a href="#">Perturbações relacionadas com trauma<br>e fatores de stress</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Artigos</h3>
                <ul>
                    <li><a href="#">Depressão</a></li>
                    <li><a href="#">Depressão</a></li>
                    <li><a href="#">Depressão</a></li>
                    <li><a href="#">Depressão</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Notícias</h3>
                <ul>
                    <li><a href="#">Depressão</a></li>
                    <li><a href="#">Depressão</a></li>
                    <li><a href="#">Depressão</a></li>
                    <li><a href="#">Depressão</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Conteúdo Educativo</h3>
                <ul>
                    <li><a href="../quizzes">Quizzes</a></li>
                    <li><a href="#">Exercícios Mindfulness</a></li>
                    <li><a href="#">TED Talks</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Contactos</h3>
                <ul>
                    <li><a href="#" target="_blank">Apoio Psicológico</a>
                        <ul>
                            <li style="color: #DADADA;">24h/dia</li>
                        </ul>
                    </li>
                    <li><a href="#" target="_blank">Vira(l)Solidariedade</a>
                        <ul>
                            <li style="color: #DADADA;">Todos os dias das 08h00 às 00h00</li>
                        </ul>
                    </li>
                    <li><a href="#" target="_blank">SOS Voz Amiga</a>
                        <ul>
                            <li style="color: #DADADA;">Todos os dias das 15:30h às 00:30h</li>
                        </ul>
                    </li>
                    <li><a href="#" target="_blank">Linha Conversa Amiga</a>
                        <ul>
                            <li style="color: #DADADA;">Dias úteis das 15h00 às 22h00</li>
                            <li style="color: #DADADA;">Fins de semana das 19h00 às 22h00</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <hr>

        <div class="footer-links">
            <p class="copyright">@2024 Todos os direitos reservados</p>
            <div class="footer-links-2">
                <a href="#">Termos & Condições</a>

                <div class="vertical-hr"></div>

                <!--<li class="dropdown-trigger-f"><i class="fas fa-globe"></i>Idioma <i class="fas fa-chevron-down"></i>
                    <ul class="dropdown-f">
                        <li><a href="#" id="portugues" onclick="changeLanguage('portuguese')">Português</a></li>
                        <li><a href="#" id="ingles" onclick="changeLanguage('english')">Inglês</a></li>
                    </ul>
                </li>-->

                <span><a href="?lang=en-GB" class="lang-link active">EN</a> / <a href="?lang=pt-PT"
                        class="lang-link">PT</a></span>

                <div class="vertical-hr"></div>

                <input type="checkbox" id="darkmode-toggle">
                Light/Dark
                <label class="change" for="darkmode-toggle">
            </div>
        </div>
    </footer>


    <!--Chatbot-->
    <!--<div id="chatbotContainer">
        <iframe id="chatbotFrame" src="http://127.0.0.1:5000/"></iframe>
    </div>-->


    <script src="js/script.js"></script>

</body>

</html>