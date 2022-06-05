    <?php
session_start();
include_once "../config/conexao.php";
?>

    <!-- Links de CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard_user.css"/>
    <link rel="icon" href="../imgs/film-projector.png"/>

<title>Dashboard User</title>
<div class="page">
  <header tabindex="0">CineHaus</header>
  <div id="nav-container">
    <div class="bg"></div>
    <div class="button" tabindex="0">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </div>
    <div id="nav-content" tabindex="0">
      <ul>
        <li><a href="#0">Inicial</a></li>
        <li><a href="#0">Lista Filmes</a></li>
        <li><a href="dashboard_user.php">Sua Conta</a></li>
        <br>
        <br>
        <li><a href="../includes/logout.php">Sair</a></li>
        <li><a href="#0"></a></li>
        <li class="small"><a href="https://www.instagram.com/emanuel__bg/">Instagram Bohrer</a><a href="https://www.instagram.com/vicsroman/">Instagram Roma</a></li>
      </ul>
    </div>
  </div>

  <main>
         <?php
    echo" <h2> Olá ". $_SESSION['nome'].", você acessou com sucesso o login.</h1>";
    echo" <h2> Seu ID é : ".$_SESSION['id']."</h2>";
    echo" <h2> Sua senha é : ".$_SESSION['senha']."</h3>";
    ?>
  
  </main>
</div>