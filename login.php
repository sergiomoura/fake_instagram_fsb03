<?php 
    include_once("classes/Usuario.php");

    $loginOk = true;

    // Form do POST veio?
    if($_POST) {
        
        // Tentando efetuar login
        $usuario = Usuario::login($_POST['email'],$_POST['senha']);

        if($usuario) {
            // Criar uma session para marcar o usuário como logado
            session_start();
            $_SESSION['logado'] = true;

            // Direcionar ele para página interna
            header('location: feed.php');
        } else {

            // Alterando o loginOk para mostrar msg de erro
            $loginOk = false;

        }
    }

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Fake Instagram</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='css/style.css' />
  </head>
  <body class="auth">
    <main class="container content-auth">
        <div id="banner">
            <img src="img/banner-login.png" alt="" srcset="">
        </div>
        <div class="content">
            <form class="form-auth card" method="POST">
            
                <div id="logo">
                    <img src="img/logo.png" alt="">
                </div>
                <input name="email" type="email" placeholder="Digite seu email">
                <input name="senha" type="password" placeholder="Senha">
                <?php if(!$loginOk): ?>
                    <div class="error">Login inválido</div>
                <?php endif ?>
                <button type="submit">
                    Entrar
                </button>
                <div class="register card">
                    <p> Não tem uma conta? <a href="registro.php"><b>Cadastre-se</b></a> </p>
                </div>
            </form>
        </div>        
    </main>
  </body>
</html>
