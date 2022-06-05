<?php
session_start();
include_once '../config/conexao.php';


$dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);


if (!empty($dados['bt_cadastrar_adm']))
{
  $query_cadastro = "INSERT INTO usuarios(nome, senha, email, fone, nivel_acesso_id, created) VALUES ('".$dados['nome']."','".$dados['senha']."','".$dados['email']."','".$dados['fone']."','".$dados['nivel_acesso_id']."',NOW())";

  $resultado_usuario = $conn ->prepare($query_cadastro);
  $resultado_usuario-> execute();
  
  
    if (($resultado_usuario) AND ($resultado_usuario->rowCount() != 0)) 
    {
        $row_usuario = $resultado_usuario->fetch(PDO::FETCH_ASSOC);
        $_SESSION['msg'] = "<h2><p style='color: green'>Usuario cadastrado!</p></h2>";
        header("Location:\CineHaus\control_user\lista_user.php");
    } 
    else 
    {
        $_SESSION['msg'] = "<h2><p style='color: blue'>Não foi possível inserir usuário!</p></h2>";
        header("Location:\CineHaus\control_user\lista_user.php");
        
    } 
}
else
{
  $_SESSION['msg']="<h2><p style ='color: blue'>Não foi possivel cadastrar!</p></h2>";
  header("Location:\CineHaus\control_user\lista_user.php");
}



