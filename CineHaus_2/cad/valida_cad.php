<?php

session_start();
include_once'../config/conexao.php';




$dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);
var_dump($dados);
if(!empty($dados['bt_cadastrar'])){
        
        
        $query_cadastro="INSERT INTO usuarios(nome, email, senha ,fone,nivel_acesso_id,created) VALUES ('".$dados['nome']."','".$dados['email']."','".$dados['senha']."','".$dados['fone']."','1',NOW())";
        $result_usuario = $conn ->prepare($query_cadastro);
        $result_usuario->execute();
        
        if (($result_usuario) AND ($result_usuario->rowCount()!=0)){
            $row_usuario = $result_usuario ->fetch(PDO::FETCH_ASSOC);
            $_SESSION['msg']="<h2><p style='color:white'>Cadastrado com sucesso!</p></h2>";
            header("Location:\CineHaus\login\index.php");
        }else{
            $_SESSION['msg'] = "<h2><p style='color:white'>Não foi possível inserir este usuário! </p></h2>";
                header("Location:\CineHaus\cad\cadastro.php");
        }
}else{
    $_SESSION['msg']="<h2> <p=style='color:white'> Não foi possível cadastrar </p></h2>";
    
    header("Location:\CineHaus\cad\cadastro.php");
}