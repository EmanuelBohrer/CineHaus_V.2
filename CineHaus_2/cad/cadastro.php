<?php

session_start();

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

?>

<html lang="pt-br">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>CineHaus - S-A em PHP (CAD)</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/cad.css"/>
    <link rel="icon" href="../imgs/film-projector.png"/>
    
   
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="POST" action="valida_cad.php">
        <h3>Cadastro no Site</h3>
        
        <!-- Nome de Usuário -->
        <label for="username">Nome</label>
        <input type="text" placeholder="Digite seu nome de usuário" id="username" name="nome" required>

        <!-- Email do Usuário -->
        <label for="email">Email</label>
        <input type="text" placeholder="Digite seu email" id="email" name="email" required>
        <br>
        
        <!-- Senha do Usuário -->
        <label for="senha">Senha</label>
        <input type="password" placeholder="Digite uma senha" id="senha" name="senha" required>
        <br>
        
        <!-- Telefone do Usuário -->
        <label for="fone">Telefone</label>
        <input type="text" placeholder="Digite seu telefone" id="fone" name="fone" required>
        <br>
        
        <input type="submit" name="bt_cadastrar" value="Cadastrar">
        <br>
        <div class="signup_link"> 
            Já tem conta? <a href="../login/index.php">Voltar ao Login </a>
        </div>
        <br>
       
    </form>
</body>
</html>