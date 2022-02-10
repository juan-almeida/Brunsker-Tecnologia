<?php

require_once 'usuarios.php';

session_start();

$_POST['action']();

function login()
{
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        $user = new Usuario();
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);

        if (!empty($email) && !empty($senha)) {
            $user->conectarBD();
            if (empty($user->msgErro)) {
                $logar = $user->logar($email, $senha);
                
                if (!empty($logar)) {
                    $_SESSION['login']['user'] = $logar['nome'];
                    $_SESSION['login']['expirate'] = date("d-m-Y H:i:s", strtotime("+1 hours"));
                    header('location: ../views/acessado.php');
                } else {
                    msgReturn("E-mail e/ou senha inválidos, tente novamente!", 'msg-erro');
                }
            } else {
                msgReturn('Erro' . $user->msgErro, 'msg-erro');
            }
        } else {
            msgReturn('Preencha todos os campos!', 'msg-erro');
        }
    } else {
        msgReturn("Preencha todos os campos, por gentileza", 'msg-erro');
    }
}

function register()
{
    if (isset($_POST['nome'])) {
        $user = new Usuario();
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $confirmaSenha = addslashes($_POST['confirma_senha']);
        //campo vazio?
        if (!empty($nome) && !empty($email) && !empty($senha) && !empty($confirmaSenha)) {
            $user->conectarBD();
            if (empty($user->msgErro)) {
                if ($senha == $confirmaSenha) {
                    if ($user->cadastrar($nome, $email, $senha)) {
                        msgReturn("Cadastrado com sucesso!", 'msg-sucesso');
                    } else {
                        msgReturn('Email já cadastrado!' ,'bg-danger');
                    }
                } else {
                    msgReturn('Senhas diferentes, favor conferir!', 'bg-danger');
                }
            } else {
                msgReturn('Erro' . $user->msgErro, 'bg-danger');
            }
        } else {
            msgReturn('É necessário o preenchimento de todos os campos!' , 'bg-warning');
        }
    }
}

function msgReturn($msg, $class)
{
    $_SESSION['return']['msg'] = $msg;
    $_SESSION['return']['class'] = $class;
    header("location: ../");
}
