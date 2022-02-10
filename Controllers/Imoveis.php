<?php

include 'ControllerImoveis.php';

session_start();


$_POST['action']();


function connection()
{
    include '../db.php';
    try {
        return $pdo = new PDO(DB_SERVIDOR, DB_USUARIO, DB_SENHA);
    } catch (PDOException $e) {
        return $msgErro = $e->getMessage();
    }
}

function register()
{
    if (isset($_POST['nome'])) {
        $imoveis = new controllerImoveis();
        $nome = addslashes($_POST['nome']);
        $valor = addslashes($_POST['valor']);
        $tipo = addslashes($_POST['tipo']);
        $locacao = addslashes($_POST['locacao']);
        $quartos = addslashes($_POST['quartos']);
        $banheiros = addslashes($_POST['banheiros']);
        $vagas = addslashes($_POST['vagas']);
        $cep = addslashes($_POST['cep']);
        $rua = addslashes($_POST['rua']);
        $bairro = addslashes($_POST['bairro']);
        $cidade = addslashes($_POST['cidade']);
        $uf = addslashes($_POST['uf']);
        $complemento = addslashes($_POST['complemento']);
        $numero = addslashes($_POST['numero']);


        //campo vazio?
        if (!empty($nome) && !empty($valor) && !empty($tipo) && !empty($locacao) && !empty($quartos) && !empty($banheiros) && !empty($vagas) && !empty($cep) && !empty($rua) && !empty($bairro) 
        && !empty($cidade) && !empty($uf) && !empty($complemento) && !empty($numero) ) {
            $imoveis->connection();
            if (empty($imoveis->msgErro)) {
                    if ($imoveis->cadastrar($nome, $valor, $tipo, $locacao, $quartos, $banheiros, $vagas,
                    $cep, $rua, $bairro, $cidade, $uf, $complemento, $numero)) {
                        msgReturn("Cadastrado com sucesso!", 'bg-success text-light pl-2');
                        header('location: ../views/acessado.php');
                    } else {
?>
                        <div class="msg-erro">
                            Imóveis já cadastrado!
                        </div>

                    <?php
                    }
                
            } else {
                ?>
                <div class="msg-erro">
                    <?php
                    echo "Erro: " . $imoveis->msgErro;
                    ?>
                </div>

            <?php
            }
        } else {
            ?>
            <div class="msg-erro">
                É necessário o preenchimento de todos os campos!
            </div>
<?php
        }
    }
}

function update(){
    $id = $_POST['id_imovel'];
    header("location: ../views/formUpdate.php?id_imovel=$id");
}


function updateData()
{
    if (isset($_POST['id_imovel'])) {
        $imoveis = new controllerImoveis();
        $id_imovel = addslashes($_POST['id_imovel']);
        $nome = addslashes($_POST['nome']);
        $valor = addslashes($_POST['valor']);
        $tipo = addslashes($_POST['tipo']);
        $locacao = addslashes($_POST['locacao']);
        $quartos = addslashes($_POST['quartos']);
        $banheiros = addslashes($_POST['banheiros']);
        $vagas = addslashes($_POST['vagas']);
        $cep = addslashes($_POST['cep']);
        $rua = addslashes($_POST['rua']);
        $bairro = addslashes($_POST['bairro']);
        $cidade = addslashes($_POST['cidade']);
        $uf = addslashes($_POST['uf']);
        $complemento = addslashes($_POST['complemento']);
        $numero = addslashes($_POST['numero']);


        //campo vazio?
        if (!empty($id_imovel) && !empty($nome) && !empty($valor) && !empty($tipo) && !empty($locacao) && !empty($quartos) && !empty($banheiros) && !empty($vagas) && !empty($cep) && !empty($rua) && !empty($bairro) 
        && !empty($cidade) && !empty($uf) && !empty($complemento) && !empty($numero) ) {
            $imoveis->connection();
            if (empty($imoveis->msgErro)) {
                    if ($imoveis->editar($id_imovel, $nome, $valor, $tipo, $locacao, $quartos, $banheiros, $vagas,
                    $cep, $rua, $bairro, $cidade, $uf, $complemento, $numero)) {
                        msgReturn("Editado com sucesso!", 'bg-success text-light pl-2');
                        header('location: ../views/acessado.php');
                    } else {
?>
                        <div class="msg-erro">
                            Imóveis já cadastrado!
                        </div>

                    <?php
                    }
                
            } else {
                ?>
                <div class="msg-erro">
                    <?php
                    echo "Erro: " . $imoveis->msgErro;
                    ?>
                </div>

            <?php
            }
        } else {
            ?>
            <div class="msg-erro">
                É necessário o preenchimento de todos os campos!
            </div>
<?php
        }
    }
}

function delete(){
    $id = $_POST['id'];

    $imoveis=new controllerImoveis();

    $imoveis->deletar($id);
    MsgReturn("Deletado com sucesso", "bg-danger text-light pl-2");
    header('location: ../views/acessado.php');

}
function msgReturn($msg, $class)
{
    $_SESSION['return']['msg'] = $msg;
    $_SESSION['return']['class'] = $class;
}
