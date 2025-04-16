<?php
session_start();
include("../config.php");
require_once(DBAPI);
include(HEADER_TEMPLATE);
require_once("../usuarios/functions.php");

if (!empty($_POST) && (empty($_POST['login']) || empty($_POST['senha']))) {
    $_SESSION['message'] = "Preencha todos os campos de login e senha."; 
    $_SESSION['type'] = "danger";
    header("Location: " . BASEURL . "login.php");
    exit();
}

$bd = open_database();

if (!$bd) {
    die("Falha na conexão: Não foi possível estabelecer uma conexão com o banco.");
}

try {
    $usuario = $_POST['login'];
    $senha = $_POST['senha'];

    if (!empty($usuario) && !empty($senha)) {

        $stmt = $bd->prepare("SELECT id, nome, user, password FROM usuarios WHERE user = :user LIMIT 1");

        if ($stmt === false) {
            die("Erro ao preparar a consulta: " . implode(":", $bd->errorInfo()));
        }

        $stmt->bindParam(':user', $usuario, PDO::PARAM_STR);
        $stmt->execute();

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dados) {
            if (password_verify($senha, $dados['password'])) {
                $_SESSION['message'] = "Bem-vindo " . $dados['nome'] . "!";
                $_SESSION['type'] = "info";
                $_SESSION['id'] = $dados['id'];
                $_SESSION['nome'] = $dados['nome'];
                $_SESSION['user'] = $dados['user'];

                header("Location: " . BASEURL . "index.php");
                exit();
            } else {
                $_SESSION['message'] = "Usuário ou senha inválidos.";
                $_SESSION['type'] = "danger";
                header("Location: " . BASEURL . "inc/login.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Usuário ou senha inválidos.";
            $_SESSION['type'] = "danger";
            header("Location: " . BASEURL . "inc/login.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Preencha todos os campos de login e senha.";
        $_SESSION['type'] = "danger";
    }
} catch (Exception $e) {
    $_SESSION['message'] = "Erro: " . $e->getMessage();
    $_SESSION['type'] = "danger";
    header("Location: " . BASEURL . "inc/login.php");
    exit();
}
?>