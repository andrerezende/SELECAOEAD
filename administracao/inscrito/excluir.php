<?php
session_start();
include("../classes/DB.php");
include("../classes/Inscrito.php");
include("../classes/Inscrito_Curso.php");

$id = addslashes($_POST['id']);

/*Acesso ao banco de dados */
$banco = DB::getInstance();
$conexao = $banco->ConectarDB();

$inscrito = new Inscrito(null,null,null,null,null,null,null,null,null,null,null,null,null,null);
$inscrito_curso = new Inscrito_Curso(null,null,null);

$inscrito_eliminado = $inscrito->apagar($conexao, $id);
$inscritoCurso_eliminado = $inscrito_curso->apagar($conexao, $id);

if ($inscrito_eliminado && $inscritoCurso_eliminado) {
	$_SESSION['flashMensagem'] = 'Inscrito exclu&iacute;do com sucesso.';
} else {
	$_SESSION['flashMensagem'] = 'Problemas ao efetuar o transa&ccedil;&atilde;o.';
}
header('Location: ../login/menu.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Concurso P&uacute;blico para Discente - 2011.2</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
	function delayer(){
		window.location = '../login/login.php';
	}
	</script>
</head>
<body onload="setTimeout('delayer()', 1000)">
<?php
if ($inscrito_eliminado && $inscritoCurso_eliminado ){
	echo("<table width='90%' border='0'>");
	echo("  <tr>");
	echo("    <td height='280'><div align='center'><font size='5'>Inscri&ccedil;&atilde;o excluida com sucesso!</font><font size='5'></font></div></td>");
	echo("  </tr>");
	echo("</table>");
} else {
	echo("<table width='90%' border='0'>");
	echo("  <tr>");
	echo("    <td height='280'><div align='center'><font size='5'>Problemas ao efetuar a exclus&atilde;o.</font><font size='5'></font></div></td>");
	echo("  </tr>");
	echo("</table>");
}
$banco->DesconectarDB($conexao);
?>
</body>
</html>