<?php
session_start();
include_once '../config/conexao.php';



$dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);



//1 IF - Valida se chegou dados do bt_login,
if(!empty($dados['bt_login'])){
    
    $query_usuarios ="SELECT id, nome,senha,nivel_acesso_id FROM usuarios WHERE nome=:usuario LIMIT 1";
    $result_usuario = $conn ->prepare($query_usuarios);
    $result_usuario ->bindparam(':usuario',$dados['usuario']);
    $result_usuario -> execute();
    
    //2 IF - Valida se tem conteúdo no $result, e se é mais que 0 linhas.
    if(($result_usuario) AND ($result_usuario ->rowCount()!=0)){
    $row_usuario = $result_usuario -> fetch(PDO::FETCH_ASSOC);
    
    //3 IF - Valida se a senha digitada é igual a senha que veio do banco.
    if ($dados['senha'] == $row_usuario['senha']){
        $_SESSION['id'] = $row_usuario['id'];
        $_SESSION['senha'] = $row_usuario['senha'];
        $_SESSION['nome'] = $row_usuario['nome'];
        $_SESSION['nivel_acesso_id'] = $row_usuario['nivel_acesso_id'];
        
        
    if ($_SESSION['nivel_acesso_id']=='1'){
        header("Location:\CineHaus\dashboard\dashboard_user.php");
    }elseif($_SESSION['nivel_acesso_id']=='2'){
        header("Location:\CineHaus\dashboard\dashboard_adm.php");
    }
    
    //(2) Valida se a senha é diferente, informando que é uma senha inválida.
    }else{
        $_SESSION['msg'] = "<p style = 'color:white'> Senha inválida! </p>";
        header("Location:\CineHaus\login\index.php");
    }
    
    // (3) Vê senão veio o usuário do $result_usuário
    }else{
    $_SESSION['msg']="<p style = 'color:white'> Usuário Inválido! </p>";
    header("Location:\CineHaus\login\index.php");
}
    //(1) Vê se não veio dados do bt_login.
    }else{
    $_SESSION['msg']="<style='color:white'> Não recebi dados alguns. </p>";
    header("Location:\CineHaus\login\index.php");
    
}
