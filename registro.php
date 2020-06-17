<?php 
    // Includes
    include_once(__DIR__."/classes/Usuario.php");
    die(__DIR__."/classes/Usuario.php");

    // Testando para verificar o envio do formulário
    if($_POST){
        
        // Criar um objeto da classe usuário
        extract($_POST);
        $usuario = new Usuario($nome, $username, $email, $senha);

        // Salvar o objeto no banco de dados
        $usuario->save();

        // Criar uma session para marcar o usuário como logado
        session_start();
        $_SESSION['logado'] = true;

        // Direcionar ele para página interna
        header('location: feed.php');

    }

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Fake Instagram</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='css/style.css' />
  </head>
  <body>
    <main class="container content-auth">
        <div id="banner">
            <img src="img/banner-login.png" alt="" srcset="">
            <p>
                Cadastre-se para ver fotos dos seus amigos
            </p>
        </div>
        <form class="form-auth card" method="POST">
            
            <div id="logo">
                <img src="img/logo.png" alt="">
            </div>
            <input name="email" type="email" placeholder="Digite seu email">
            <input name="nome" type="text" placeholder="Digite seu nome completo">
            <input name="username" type="text" placeholder="Digite seu nome de usuario">
            <input name="senha" type="password" placeholder="Senha">
            <button type="submit">
                Cadastra-se
            </button>
            <p>
                Ao se cadastrar, você concorda com nossos <b>Termos, Política de Dados e Política de Cookies.</b>
            </p>
            <div class="register card">
                <p> Tem uma conta? <a href="/"><b>Conecte-se</b></a> </p>
            </div>
        </form>
       
    </main>
  </body>
</html>
