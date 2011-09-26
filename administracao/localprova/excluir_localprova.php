<?php
session_start();
include("../classes/DB.php");
include("../classes/Localprova.php");
include("../classes/Inscrito.php");

$id = addslashes($_GET['id']);

/*Acesso ao banco de dados */
$banco    = DB::getInstance();
$conexao  = $banco->ConectarDB();

$localprova = new Localprova();

$existeLocalAssociado = $localprova->existeLocalAssociadoAcandidato($conexao, $id);
$local_eliminado = false;
$local_inativado = false;

if ($existeLocalAssociado) {
	$local_inativado = $localprova->inativar($conexao, $id);
} else {
	$local_eliminado = $localprova->apagar($conexao, $id);
}

if ($local_eliminado) {
	$_SESSION['flashMensagem'] = 'Local de Prova excluido com sucesso.';
} elseif ($local_inativado) {
	$_SESSION['flashMensagem'] = 'O Local de prova selecionado possui candidatos associados e foi inativado.';
} else {
	$_SESSION['flashMensagem'] = 'Problemas ao efetuar o transa&ccedil;&atilde;o.';
}
header('Location: ../login/menu.php');
exit;

if ($local_eliminado) {
	echo("<table width='90%' border='0'>");
	echo("  <tr>");
	echo("    <td height='280'><div align='center'><font size='6'>Local de Prova excluido com sucesso!</font><font size='6'></font></div></td>");
	echo("  </tr>");
	echo("</table>");
} else if ($local_inativado) {
	echo("<table width='90%' border='0'>");
	echo("  <tr>");
	echo("    <td height='280'><div align='center'><font size='6'>O Local de prova selecionado possui candidatos associados e foi inativado.</font><font size='6'></font></div></td>");
	echo("  </tr>");
	echo("</table>");
} else {
	echo("<table width='90%' border='0'>");
	echo("  <tr>");
	echo("    <td height='280'><div align='center'><font size='6'>Problemas ao efetuar o transação.</font><font size='6'></font></div></td>");
	echo("  </tr>");
	echo("</table>");
}
$banco->DesconectarDB($conexao);