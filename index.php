<?php
session_start();
require 'config.php';
require 'classes/usuarios.class.php';
require 'classes/documentos.class.php';

if(!isset($_SESSION['logado'])){
    header("Location: login.php");
    exit;
}

$documento = new Documento($pdo);
$usuario = new Usuarios($pdo);
$usuario->setUsuario($_SESSION['logado']);

$lista = $documento->getDocumentos();


?>

<h1>Sistema</h1>

<?php if($usuario->temPermissao('SECRET')): ?>
    <a href="secreto.php" target="_blanck" >Pagina Secreta</a> <br/> <br/>
<?php endif; ?>

<?php if($usuario->temPermissao('ADD')): ?>
    <a href="adicionar.php">Adicionar Documento</a> <br/> <br/>
<?php endif; ?>

<table border="1" width="100%">

    <tr>
        <th>Nome do arquivo</th>
        <th>Ações</th>
    </tr>   

    <?php foreach ($lista as $item ): ?>
        <tr>
            <td><?php echo utf8_encode($item['titulo']); ?></td>
            <td>
                <?php if($usuario->temPermissao('EDIT')): ?>
                    <a href="editar.php?id=<?php echo $item['id'];?>">[ Editar ]</a>
                <?php endif; ?>
                |--|
                <?php if($usuario->temPermissao('DEL')): ?>
                    <a href="excluir.php?id=<?php echo $item['id'];?>">[ Excluir ]</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>

 


</table>