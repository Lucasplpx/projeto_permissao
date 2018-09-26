<?php
session_start();
require 'config.php';
require 'classes/usuarios.class.php';

if(!isset($_SESSION['logado'])){
    header("Location: login.php");
    exit;
}

$usuario = new Usuarios($pdo);
$usuario->setUsuario($_SESSION['logado']);

if(!$usuario->temPermissao("SECRET")){
    header("Location: index.php");
}

?>
<h1>Página Secreta</h1>