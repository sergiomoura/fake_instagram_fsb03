<?php 

include_once(__DIR__."/DB.php");

class Usuario {

    private $nome;
    private $username;
    private $email;
    private $senha;

    public function __construct($nome, $username, $email, $senha){
        $this->nome = $nome;
        $this->username = $username;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function save(){

        // Inserir um usuário na tabela de usuários
        $db = new DB();
        
        // Escrever a string de consulta
        $sql = "INSERT INTO usuarios (nome, username, email, senha) VALUES (:nome, :username, :email, :senha)";

        // Preparar a consulta
        $consulta = $db->prepare($sql);

        // Executar a consulta
        $consulta->execute(
            [
                ':nome' => $this->nome,
                ':username' => $this->username,
                ':email' => $this->email,
                ':senha' => $this->senha
            ]
        );

        // Pra que executar a consulta dessa forma?
        // 1 - Deixa a sua string de consulta mais limpinha
        // 2 - Permite que o PDO evite SQL Injection

        $db = null;

    }

    public static function login($email, $senha){

        // Criar a conexão com BD
        $db = new DB();
        
        // Criando a string consulta
        $sql = "SELECT nome, username, email, senha FROM usuarios WHERE email = :email";

        // Cria a consulta em si
        $consulta = $db->prepare($sql);

        // Executa a consulta
        $result = $consulta->execute([":email" => $email]);

        // Verificando se a consulta deu certo
        if(!$result){
            die("falha na consulta");
        }

        // Carregar resultados da consulta
        $linhas = $consulta->fetchAll(PDO::FETCH_ASSOC);
        
        // Se usuário não existir, return false
        if(count($linhas) == 0){
            return false;
        }

        $linha = $linhas[0];

        // Verificar senha. Se senha não ok, return false
        if($linha['senha'] != $senha){
            return false;
        }

        // Criar um objeto Usuario e rotornar o danado
        $usuario = new Usuario($linha['nome'], $linha['username'], $linha['email'], $linha['senha']);
        return $usuario;


    }

}

