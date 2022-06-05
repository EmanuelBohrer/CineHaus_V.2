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

$query_usuario = "SELECT id FROM usuarios WHERE id = $id LIMIT 1";
$result_usuario = $conn->prepare($query_usuario);
$result_usuario->execute();

if (($result_usuario) AND ($result_usuario->rowCount() != 0)) 
{
    $query_del_usuario = "DELETE FROM usuarios WHERE id = $id";
    $apagar_usuario = $conn->prepare($query_del_usuario);

    if ($apagar_usuario->execute()) 
    {
        $_SESSION['msg'] = "<p style='color: green;'>Usuário apagado com sucesso!</p>";
        header("Location:\CineHaus\control_user\lista_user.php");
    } 
    else 
    {
        $_SESSION['msg'] = "<p style='color: #f00;'>Usuário não apagado com sucesso!</p>";
       header("Location:\CineHaus\control_user\lista_user.php");
    }
} 
else 
{
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
    header("Location:\CineHaus\control_user\lista_user.php");
}


