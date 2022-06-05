<?php
session_start();
ob_start();
include_once '../config/conexao.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);


if (empty($id)) 
{
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Filme não encontrado!</p>";
    header("Location:\CineHaus\lista_movie\lista_filmes.php");
    exit();
}

$query_filmes = "SELECT id FROM filmes WHERE id = $id LIMIT 1";
$result_filmes = $conn->prepare($query_filmes);
$result_filmes->execute();

if (($result_filmes) AND ($result_filmes->rowCount() != 0)) 
{
    $query_del_filmes = "DELETE FROM filmes WHERE id = $id";
    $apagar_filmes = $conn->prepare($query_del_filmes);

    if ($apagar_filmes->execute()) 
    {
        $_SESSION['msg'] = "<p style='color: green;'>Filme apagado com sucesso!</p>";
        header("Location:\CineHaus\lista_movie\lista_filmes.php");
    } 
    else 
    {
        $_SESSION['msg'] = "<p style='color: #f00;'>Filme não foi apagado!</p>";
       header("Location:\CineHaus\lista_movie\lista_filmes.php");
    }
} 
else 
{
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Filme não encontrado!</p>";
    header("Location:\CineHaus\lista_movie\lista_filmes.php");
}
