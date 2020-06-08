<?php

    include_once(__DIR__.'/classes/DB.php');
    
    try {
        $db = new DB();
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    echo("executando...");
    $sql = 'INSERT INTO usuarios (nome, email, senha, username, foto) VALUES ("Sérgio","sergio@teste","123123","sergio",null)';
    if($db->query($sql)){
       echo("executado!");
    } else {
       echo "<pre>";
       print_r($db->errorInfo());
       echo "</pre>";
    }