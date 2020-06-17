<?php 
    include_once(__DIR__.'/Usuario.php');

    // Testando a criação do usuário
    $u = new Usuario("Nat Lira","nat","nat@ceo-grandes-negocios.com","!2s32");
    echo "<pre>";
    print_r($u);
    echo "</pre>";
    
    // Testando a salvação do usuário
    $u->save();

    // Testando função de login
    $novoUsuario = Usuario::login("jonathas@dh.com","123456");
    
    echo "<pre>";
    print_r($novoUsuario);
    echo "</pre>";
    echo("...");
    
 ?>