<?php
session_start();
include_once "../config/conexao.php";

$gen[1]="Drama";
$gen[2]="Ação";
$gen[3]="Comédia";
$gen[4]="Romance";
$gen[5]="Ficção";
$gen[6]="Musical";
$gen[7]="Suspense";
$gen[8]="Terror";
$gen[9]="Faroeste";
$gen[10]="Documentário";

$dir[1]="George Lucas";
$dir[2]="Robert Eggers";
$dir[3]="Christopher Nolan";
$dir[4]="Quentin Tarantino";


?>

    <!-- Links de CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard_user.css"/>
    <link rel="stylesheet" href="../css/tabela.css"/>
    <link rel="icon" href="../imgs/film-projector.png"/>

<title>Lista Filmes</title>
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
        <li><a href="lista_filmes.php">Lista Filmes</a></li>
        <li><a href="../dashboard/dashboard_adm.php">Sua Conta</a></li>
        <li><a href="../control_user/lista_user.php">Lista Usuários</a></li>
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
      <h2> Lista de Filmes Cadastrados </h2>
      <br>
        <table border="1"> 
        <tr> 
          <td>Código</td> 
          <td>Nome</td> 
          <td>Ano</td>
          <td>Rank</td>
          <td>Gênero</td>
          <td>Diretor</td> 
          <td>Ação</td> 
        </tr> 
        <?php 
        
        $query_filmes = "SELECT * FROM filmes";
        $resultado_filmes = $conn ->prepare($query_filmes);
        $resultado_filmes-> execute();
        if(($resultado_filmes) AND ($resultado_filmes->rowCount() != 0)) 
        {
            while($row_filmes = $resultado_filmes->fetch(PDO::FETCH_ASSOC)) 
        
        {?> 
        <tr> 
          <td><?php echo $row_filmes['id']; ?></td>
          <td><?php echo $row_filmes['nome_filme']; ?></td> 
          <td><?php echo $row_filmes['ano']; ?></td>
          <td><?php echo $row_filmes['ranking']; ?></td>
          <td><?php echo $gen[$row_filmes['genero_id']]; ?></td>
          <td><?php echo $dir[$row_filmes['diretore_id']]; ?></td>

          <td> 
              <a href="editar_filmes.php?id=<?php echo $row_filmes['id']; ?>">Editar</a> 
            <a href="excluir_filme.php?id=<?php echo $row_filmes['id']; ?>">Excluir</a> 
          </td> 
        </tr> 
        <?php 
        
        }
        
        }
        else
        {
        echo "Nenhum filme encontrado.";
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
      
     
      <hr> 
      <fieldset>
          <form method="POST" action="../control_user/valida_filme.php">
          <h2> Incluir Filme </h2>
          <br>
                <div class="">
                    <label> Nome do Filme : </label>
                    <input type="text" name="nome" required>
                </div>
                <br>
                <div clas="">
                    <label> Ano de lançamento : </label> 
                    <input type="text" name="ano" required> 
                </div>
                <br>
                <div clas="">
                    <label> Ranking : </label> 
                    <input type="number" name="rank" step= 0.01 required> 
                </div>
                <br> 
                <div clas="">
                    <label> Gênero do Filme : </label> 
                    <select name='genero' id='gen'>
                        <option value=''>Selecione</option>
                        <option value='1'>Drama</option>
                        <option value='2'>Ação</option>
                        <option value='3'>Comédia</option>
                        <option value='4'>Romance</option>
                        <option value='5'>Ficção</option>
                        <option value='6'>Musical</option>
                        <option value='7'>Suspense</option>
                        <option value='8'>Terror</option>
                        <option value='9'>Faroeste</option>
                        <option value='10'>Documentário</option>
                    </select>
                </div>
                <br> 
                <div class=''>
                    <label> Diretor do Filme : </label> 
                    <select name='diretor' id='dir'>
                        <option value=''>Selecione</option>
                        <option value='1'>George Lucas</option>
                        <option value='2'>Robert Eggers</option>
                        <option value='3'>Christopher Nolan</option>
                        <option value='4'>Quentin Tarantino</option>
                    </select>
                </div>
                <br>
                <input type ='submit' name='bt_incluir' value="Incluir Filme">
                
                    <?php
                if (isset($_SESSION['msg'])) {
                    echo  $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>

                
                </div>
      </fieldset>
  </main>
 







