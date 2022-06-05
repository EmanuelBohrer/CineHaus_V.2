   <?php
session_start();
include_once "../config/conexao.php";


$nivelacesso[1] = "Basico";
$nivelacesso[2] = "Admin";

?>

    <!-- Links de CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard_user.css"/>
    <link rel="stylesheet" href="../css/tabela.css"/>
    <link rel="icon" href="../imgs/film-projector.png"/>

<title>Lista Usuários</title>
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
        <li><a href="../lista_movie/lista_filmes.php">Lista Filmes</a></li>
        <li><a href="../dashboard/dashboard_adm.php">Sua Conta</a></li>
        <li><a href="lista_user.php">Lista Usuários</a></li>
        <br>
        <br>
        <li><a href="../includes/logout.php">Sair</a></li>
        <li><a href="#0"></a></li>
        <li class="small"><a href="https://www.instagram.com/emanuel__bg/">Instagram Bohrer</a><a href="https://www.instagram.com/vicsroman/">Instagram Roma</a></li>
      </ul>
    </div>
  </div>

  <main>
      <br>
      <br>
      <h2> Lista de Usuários Cadastrados </h2>
      <br>
        <table border="1"> 
        <tr> 
          <td>Código</td> 
          <td>Nome</td> 
          <td>E-mail</td>
          <td>Fone</td>
          <td>Permissão</td>
          <td>Data de criação</td> 
 
          <td>Ação</td> 
        </tr> 
        <?php 
        
        $query_usuario = "SELECT * FROM usuarios";
        $resultado_usuario = $conn ->prepare($query_usuario);
        $resultado_usuario-> execute();
        if(($resultado_usuario) AND ($resultado_usuario->rowCount() != 0)) 
        {
            while($row_usuario = $resultado_usuario->fetch(PDO::FETCH_ASSOC)) 
        
        {?> 
        <tr> 
          <td><?php echo $row_usuario['id']; ?></td>
          <td><?php echo $row_usuario['nome']; ?></td> 
          <td><?php echo $row_usuario['email']; ?></td>
          <td><?php echo $row_usuario['fone']; ?></td>
          <td><?php echo $nivelacesso[$row_usuario['nivel_acesso_id']]; ?></td>

          <td><?php echo date('d/m/Y H:i:s', strtotime($row_usuario['created'])); ?></td> 
          <td> 
            <a href="editar_usuario.php?id=<?php echo $row_usuario['id']; ?>">Editar</a> 
            <a href="excluir_usuario.php?id=<?php echo $row_usuario['id']; ?>">Excluir</a> 
          </td> 
        </tr> 
        <?php 
        
        }
        
        }
        else
        {
        echo "Nenhum usuário encontrado.";
        }
        ?> 
        <?php
            if (isset($_SESSION['msg']))
            {           
             echo $_SESSION['msg'];
             unset($_SESSION['msg']);
            }
            
        ?>
        
      </table> 
      
      <br>
      <br>
      <hr> 
      <fieldset>
       <div class = "cadastro">
           
           <form method="POST" action="valida_cad_adm.php">
          <h2>Cadastro</h2> 
          <br>
          
           <div class="txt_field"> 
            <label>Usuário</label>
            <input type="text" name="nome" required>
            </div>
          <br>
          
            <div class="txt_field">
            <label>Senha</label>
            <input type="password" name="senha" required>
            </div>
          
          <br>
          
            <div class="txt_field">
            <label>E-mail</label>
            <input type="email" name="email" required>
            </div>
          
          <br>
          
            <div class="txt_field">
            <label>Número</label>
            <input type="text" name="fone" required>
            
            </div>
          
          <br>
          
            <label>Permisao :</label>
            <select name="nivel_acesso_id"> 
            <option value=1>Basico</option> 
            <option value=2>Admin</option> 
            
            <br>

            </select>
            <br><br>
 
          <input type="submit" name="bt_cadastrar_adm" value="Cadastrar">
            <?php
            if (isset($_SESSION['msg']))
            {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            
            }  
            ?>
           </form>
  
      </div>
      </fieldset>
  </main>
  </div>
