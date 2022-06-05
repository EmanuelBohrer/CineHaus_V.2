<?php
session_start();
ob_start();
include_once '../config/conexao.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) 
{
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
    header("Location:\CineHaus\control_user\lista_user.php");
    exit();
}

$query_usuario = "SELECT id, nome, email FROM usuarios WHERE id = $id LIMIT 1";
$result_usuario = $conn->prepare($query_usuario);
$result_usuario->execute();

if (($result_usuario) AND ($result_usuario->rowCount() != 0)) 
{
    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
    //var_dump($row_usuario);
} 
else 
{
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
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
        if (!empty($dados['EditUsuario'])) 
        {
            $empty_input = false;
            $dados = array_map('trim', $dados);
            if (in_array("", $dados)) 
            {
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher todos campos!</p>";
            } 
            elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) 
            {
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher com e-mail válido!</p>";
            }

            if (!$empty_input) 
            {
                $query_up_usuario= "UPDATE usuarios SET nome=:nome, email=:email, senha=:senha, fone=:fone WHERE id=:id";
                $edit_usuario = $conn->prepare($query_up_usuario);
                $edit_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':senha', $dados['senha'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':fone', $dados['fone'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':id', $id, PDO::PARAM_INT);
                if($edit_usuario->execute())
                {
                    $_SESSION['msg'] = "<p style='color: green;'>Usuário editado com sucesso!</p>";
                    header("Location:\CineHaus\control_user\lista_user.php");
                }
                else
                {
                    echo "<p style='color: #f00;'>Erro: Usuário não editado com sucesso!</p>";
                }
            }
        }
        ?>

        <form id="edit-usuario" method="POST" action="">
            <label>Nome: </label>
            <input type="text" name="nome" id="nome" placeholder="Nome completo" value="<?php
            if (isset($dados['nome'])) 
            {
                echo $dados['nome'];
            } 
            elseif (isset($row_usuario['nome'])) 
            {
                echo $row_usuario['nome'];
            }
            ?>" ><br><br>

            <label>E-mail: </label>
            <input type="email" name="email" id="email" placeholder="Melhor e-mail" value="<?php
                   if (isset($dados['email'])) 
                   {
                       echo $dados['email'];
                   } 
                   elseif (isset($row_usuario['email'])) 
                   {
                       echo $row_usuario['email'];
                   }
                   ?>" ><br><br>
            
              <label>Numero: </label>
            <input type="text" name="fone" id="fone" placeholder="Numero" value="<?php
                   if (isset($dados['fone'])) 
                   {
                       echo $dados['fone'];
                   } 
                   elseif (isset($row_usuario['fone'])) 
                   {
                       echo $row_usuario['fone'];
                   }
                   ?>" ><br><br>
            
               <label>Senha: </label>
            <input type="text" name="senha" id="senha" placeholder="Numero" value="<?php
                   if (isset($dados['senha'])) 
                   {
                       echo $dados['senha'];
                   } 
                   elseif (isset($row_usuario['senha'])) 
                   {
                       echo $row_usuario['senha'];
                   }
                   ?>" ><br><br>

            <input type="submit" value="Salvar" name="EditUsuario">
        </form>
      
      
     
      
  </main>
</div>