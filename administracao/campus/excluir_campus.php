<?php session_start("SELECAO"); ?>
<?php
session_start();
include("../classes/DB.php");
include("../classes/Campus.php");

$id = addslashes($_GET['id']);

/*Acesso ao banco de dados */
$banco    = DB::getInstance();
$conexao  = $banco->ConectarDB();

$campus = new Campus();

$existeCandidatoAssociado = $campus->existeCandidatoAssociado($conexao, $id);

$campus_eliminado = false;
$campus_inativado = false;

if ($existeCandidatoAssociado) {
	$campus_inativado = $campus->inativar($conexao, $id);
} else {
	$campus_eliminado = $campus->apagar($conexao, $id);
}

if ($campus_eliminado) {
	$_SESSION['flashMensagem'] = 'Curso excluido com sucesso.';
} elseif ($campus_inativado) {
	$_SESSION['flashMensagem'] = 'O Curso selecionado possui candidatos associados e foi inativado.';
} else {
	$_SESSION['flashMensagem'] = 'Problemas ao efetuar o transa&ccedil;&atilde;o.';
}
header('Location: ../login/menu.php');
exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title> <?php echo ($_SESSION["Gnomeprocessoseletivo"]);?> </title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
if ($campus_eliminado) {
	echo("<table width='90%' border='0'>");
	echo("  <tr>");
	echo("    <td height='280'><div align='center'><font size='6'>Campus excluido com sucesso!</font><font size='6'></font></div></td>");
	echo("  </tr>");
	echo("</table>");
} else if ($campus_inativado) {
	echo("<table width='90%' border='0'>");
	echo("  <tr>");
	echo("    <td height='280'><div align='center'><font size='6'>O Campus selecionado possui candidatos associados e foi inativado.</font><font size='6'></font></div></td>");
	echo("  </tr>");
	echo("</table>");
} else {
	echo("<table width='90%' border='0'>");
	echo("  <tr>");
	echo("    <td height='280'><div align='center'><font size='6'>Problemas ao efetuar o transa&ccdil;&atilde;o.</font><font size='6'></font></div></td>");
	echo("  </tr>");
	echo("</table>");
}
$banco->DesconectarDB($conexao);
?>
</body>
</html>
