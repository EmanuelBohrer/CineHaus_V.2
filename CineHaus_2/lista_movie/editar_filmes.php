<?php
session_start();
ob_start();
include_once '../config/conexao.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) 
{
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Filme não encontrado!</p>";
    header("Location:\CineHaus\control_user\lista_user.php");
    exit();
}

$query_filmes = "SELECT id, nome_filme, ano,ranking,genero_id,diretore_id FROM filmes WHERE id = $id LIMIT 1";
$result_filmes = $conn->prepare($query_filmes);
$result_filmes->execute();

if (($result_filmes) AND ($result_filmes->rowCount() != 0)) 
{
    $row_filmes = $result_filmes->fetch(PDO::FETCH_ASSOC);
    //var_dump($row_usuario);
} 
else 
{
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Filme não encontrado!</p>";
    header("Location:\CineHaus\control_user\lista_user.php");
    exit();
}
?>

    <!-- Links de CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard_user.css"/>
    <link rel="icon" href="../imgs/film-projector.png"/>

<title>Editar Usuário</title>
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
        <li><a href="dashboard_adm.php">Sua Conta</a></li>
        <li><a href="../control_user/lista_user.php">Lista de Usuários</a></li>
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
        //Receber os dados do formulário
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        //Verificar se o usuário clicou no botão
        if (!empty($dados['EditFilme'])) 
        {
            $empty_input = false;
            $dados = array_map('trim', $dados);
            if (in_array("", $dados)) 
            {
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher todos campos!</p>";
            } 
            

            if (!$empty_input) 
            {
                $query_up_filmes= "UPDATE filmes SET nome_filme=:nome_filme, ano=:ano, ranking=:ranking, genero_id=:genero_id, diretore_id=:diretore_id WHERE id=:id";
                $edit_filmes = $conn->prepare($query_up_filmes);
                $edit_filmes->bindParam(':nome_filme', $dados['nome_filme'], PDO::PARAM_STR);
                $edit_filmes->bindParam(':ano', $dados['ano'], PDO::PARAM_STR);
                $edit_filmes->bindParam(':ranking', $dados['ranking'], PDO::PARAM_STR);
                $edit_filmes->bindParam(':genero_id', $dados['genero_id'], PDO::PARAM_STR);
                $edit_filmes->bindParam(':diretore_id', $dados['diretore_id'], PDO::PARAM_STR);
                $edit_filmes->bindParam(':id', $id, PDO::PARAM_INT);
                if($edit_filmes->execute())
                {
                    $_SESSION['msg'] = "<p style='color: green;'>Filme editado com sucesso!</p>";
                    header("Location:\CineHaus\lista_movie\lista_filmes.php");
                }
                else
                {
                    echo "<p style='color: #f00;'>Erro: Filme não editado com sucesso!</p>";
                }
            }
        }
        ?>

        <form id="edit-usuario" method="POST" action="">
            <label>Nome: </label>
            <input type="text" name="nome_filme" id="nome_filme" placeholder="Nome filme" value="<?php
            if (isset($dados['nome_filme'])) 
            {
                echo $dados['nome_filme'];
            } 
            elseif (isset($row_usuario['nome_filme'])) 
            {
                echo $row_usuario['nome_filme'];
            }
            ?>" ><br><br>

            <label>Ano: </label>
            <input type="text" name="ano" id="ano" placeholder="Ano do filme" value="<?php
                   if (isset($dados['ano'])) 
                   {
                       echo $dados['ano'];
                   } 
                   elseif (isset($row_usuario['ano'])) 
                   {
                       echo $row_usuario['ano'];
                   }
                   ?>" ><br><br>
            
              <label>Ranking: </label>
            <input type="number" name="ranking" id="ranking" placeholder="Ranking do Filme" value="<?php
                   if (isset($dados['ranking'])) 
                   {
                       echo $dados['ranking'];
                   } 
                   elseif (isset($row_usuario['ranking'])) 
                   {
                       echo $row_usuario['ranking'];
                   }
                   ?>" ><br><br>
            
               <label> Gênero do Filme : </label> 
                    <select name='genero_id' id='genero_id'>
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
                    </select><?php
                   if (isset($dados['genero_id'])) 
                   {
                       echo $dados['genero_id'];
                   } 
                   elseif (isset($row_usuario['genero_id'])) 
                   {
                       echo $row_usuario['genero_id'];
                   }
                   ?>" ><br><br>
                   
                   <label> Diretor do Filme : </label> 
                    <select name='diretore_id' id='diretore_id'>
                        <option value=''>Selecione</option>
                        <option value='1'>George Lucas</option>
                        <option value='2'>Robert Eggers</option>
                        <option value='3'>Christopher Nolan</option>
                        <option value='4'>Quentin Tarantino</option>
                    </select><?php
                   if (isset($dados['diretore_id'])) 
                   {
                       echo $dados['diretore_id'];
                   } 
                   elseif (isset($row_usuario['diretore_id'])) 
                   {
                       echo $row_usuario['diretore_id'];
                   }
                   ?>" ><br><br>

            <input type="submit" value="Salvar" name="EditFilme">
        </form>
      
      
     
      
  </main>
</div>