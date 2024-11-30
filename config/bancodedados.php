<?php
    $host = "localhost";
    $db = "estacionamentobd_php";
    $usuario = "root";
    $senha = "";
    $port = "3306";

    try {
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;", $usuario, $senha);


        if ($pdo) {
            echo "";
        } else {
            echo "<p> Erro ao conectar o banco de dados</p>";
        }
    } catch (Exception $e) {
        echo "Erro". $e->getMessage();
    }