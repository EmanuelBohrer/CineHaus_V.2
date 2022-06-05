<?php

session_start();
include_once'../config/conexao.php';


$dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);
var_dump($dados);
if(!empty($dados['bt_incluir'])){
    $query_incluir="INSERT INTO filmes(nome_filme, ano, ranking, genero_id, diretore_id, created) VALUES ('".$dados['nome']."','".$dados['ano']."','".$dados['rank']."','".$dados['genero']."','".$dados['diretor']."',NOW())";
    $result_filme = $conn->prepare($query_incluir);
    $result_filme->execute();
    
    if(($result_filme) AND ($result_filme->rowCount()!=0)){
        $row_filme = $result_filme ->fetch(PDO::FETCH_ASSOC);
        $_SESSION['msg']="<h2><p style='color:green'>Filme Incluido com Sucesso! </p></h2>";
        header("Location:\CineHaus\lista_movie\lista_filmes.php");
        
    }
}else{
    $_SESSION['msg']="<h2> <p=style='color:red'> Não foi possível incluir o filme.. </p></h2>";
    header("Location:\CineHaus\lista_movie\lista_filmes.php");
}
