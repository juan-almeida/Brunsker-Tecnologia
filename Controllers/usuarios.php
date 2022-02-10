<?php

class Usuario
{


    public $msgErro = "";
    private $pdo;

    public function conectarBD()
    {
        include '../db.php';
        try {
            $this->pdo = new PDO(DB_SERVIDOR, DB_USUARIO, DB_SENHA);
        } catch (PDOException $e) {
            $this->msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nome, $email, $senha)
    {
        //Verificação de cadastro
        $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios
            WHERE email = :e");
        $sql->bindValue(":e", $email );
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return false; //ja cadastrado
        }
        //Caso não cadastrado, cadastrar
        else {
            $sql = $this->pdo->prepare("INSERT INTO usuarios(nome, email, senha)
            VALUES(?, ?, ?)");

            $sql->execute([
                $nome,
                $email,
                md5($senha)
            ]);

            return true;
        }
    }

    public function logar($email, $senha)
    {
        //verificar se o email e senha estão cadastrados, se sim
        $sql = $this->pdo->prepare("SELECT id_usuario, nome FROM usuarios
        WHERE email = ? AND senha = ?");
        $sql->execute([
            $email,
            md5($senha)
        ]);
        if ($sql->rowCount() > 0) {
            //entrar no sistema (sessao)
            $dado = $sql->fetch(PDO::FETCH_ASSOC);
            return $dado; //Logado no sistema
        } else {
            
            return false; //não foi encontrado no BD :(
        }
    }
}
