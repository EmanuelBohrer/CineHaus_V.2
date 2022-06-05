<?php
session_start();

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);        
}
include_once'../config/conexao.php';

?>

<html lang="pt-br">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>CineHaus - S-A em PHP</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css"/>
    <link rel="icon" href="../imgs/film-projector.png"/>
   
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="POST" action="valida_login.php">
        <h3>Login no Site</h3>

        <label>Nome</label>
        <input type="text" placeholder="Digite seu nome de usuário"  name="usuario" required>

        <label>Senha</label>
        <input type="password" placeholder="Digite sua senha"  name="senha" required>
        <br>
        <input type="submit" name="bt_login" value="Acessar">
        <br>
        <div class="signup_link"> 
            Não tem conta? <a href="../cad/cadastro.php">Cadastrar </a>
        </div>
        <br>
       
    </form>
</body>
</html>
