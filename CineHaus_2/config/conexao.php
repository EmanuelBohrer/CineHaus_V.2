<?php

$host="localhost"; //provedor
$user = "root";  // usuario
$pass ="";  // senha do usuario
$dbname = "cinephp"; //bancao de dados
$port = 3306;  // o ip


try{
    $conn = new PDO("mysql:host;porta=$port;dbname=".$dbname,$user,$pass);
} catch (Exception $erro) {
    echo "<p style = 'color:red'> Não foi possível conectar. Erro gerado : </p><br>".$erro->getMessage();
   
}






