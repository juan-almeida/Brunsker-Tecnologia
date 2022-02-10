<?php

class controllerImoveis
{


    public $msgErro = "";
    private $pdo;

    public function connection()
    {
        include '../db.php';
        try {
            $this->pdo = new PDO(DB_SERVIDOR, DB_USUARIO, DB_SENHA);
        } catch (PDOException $e) {
            $this->msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nome, $valor, $tipo, $locacao, $quartos, $banheiros, $vagas,
     $cep, $rua, $bairro, $cidade, $uf, $complemento, $numero )
    {
        //Verificação de cadastro
        $sql = $this->pdo->prepare("SELECT id_imovel FROM imoveis
            WHERE nome = :n");
        $sql->bindValue(":n", $nome);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return false; //ja cadastrado
        }
        //Caso não cadastrado, cadastrar
        else {
            $sql = $this->pdo->prepare("INSERT INTO imoveis(nome, valor, tipo, locacao, quartos, banheiros, vagas, cep, rua, bairro, cidade, uf, complemento, numero)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $sql->execute([
                $nome,
                $valor,
                $tipo,
                $locacao,
                $quartos,
                $banheiros,
                $vagas,
                $cep, 
                $rua, 
                $bairro, 
                $cidade, 
                $uf, 
                $complemento, 
                $numero
            ]);

            return true;
        }
    }

    public function deletar($id)
    {
        $this->connection();
        
        $query = "DELETE FROM imoveis WHERE id_imovel = ?";

        $preparar = $this->pdo->prepare($query);
        $preparar->execute([
            $id
        ]);
    }

    public function editar($id_imovel, $nome, $valor, $tipo, $locacao, $quartos, $banheiros, $vagas,
    $cep, $rua, $bairro, $cidade, $uf, $complemento, $numero )
   {
       //Verificação de cadastro
       $sql = $this->pdo->prepare("SELECT id_imovel FROM imoveis
           WHERE id_imovel = :i");
       $sql->bindValue(":i", $id_imovel);
       $sql->execute();
       if ($sql->rowCount() < 1) {
           return false; //ja cadastrado
       }
       //Caso não cadastrado, cadastrar
       else {
           $sql = $this->pdo->prepare("UPDATE imoveis SET nome = ?, valor=?, tipo=?, locacao=?, quartos=?, banheiros=?, vagas=?, cep=?, rua=?, bairro=?, cidade=?, uf=?, complemento=?, numero=? WHERE id_imovel = ?");

           $sql->execute([
               $nome,
               $valor,
               $tipo,
               $locacao,
               $quartos,
               $banheiros,
               $vagas,
               $cep, 
               $rua, 
               $bairro, 
               $cidade, 
               $uf, 
               $complemento, 
               $numero,
               $id_imovel
           ]);

           return true;
       }
   }
    public function show()
    {
        $this->connection();
        $query = "SELECT * FROM imoveis";
        $sql = $this->pdo->query($query);
        if ($sql->rowCount() > 0) {
            return $sql->fetchAll();
        } else {
            
            return false; //não foi encontrado no BD :(
        }
    }
    public function getImovel($id_imovel)
    {
        $this->connection();
        $query = "SELECT * FROM imoveis where id_imovel = ?";
        $sql = $this->pdo->prepare($query);
        $sql->execute([
            $id_imovel
        ]);
        if ($sql->rowCount() > 0) {
            return $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            
            return false; //não foi encontrado no BD :(
        }
    }
}


// $conn = new PDO(DB_SERVIDOR , DB_USUARIO, DB_SENHA);
//         $stmt = $conn->prepare("SELECT * FROM imoveis");
//         $stmt->execute();

//         $result = $stmt->fetchAll();
//         var_dump($result);    
//         exit;
