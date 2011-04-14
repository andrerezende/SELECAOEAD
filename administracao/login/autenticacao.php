<?php
include("../classes/DB.php");
include("../classes/Usuario.php");
require_once('../classes/recaptcha/recaptchalib.php');
session_start();

$usuario  = $_POST['usuario'];
$senha    = $_POST['senha'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Concurso P&uacute;blico para Discente - 2011.2</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
	function delayer(){
		window.location = 'login.php';
	}
	</script>
</head>

<?php
/* Acesso ao banco de dados */
$banco    = DB::getInstance();
$conexao  = $banco->ConectarDB();

$usuario = new Usuario($usuario,$senha);
$resultado = $usuario->Autenticar($conexao);

if ($resultado) {
	$_SESSION['validacao'] = true;
	$urlOK = 'menu.php';
	header("Location:".$urlOK);
	echo "<script type='text/javascript'>
		window.location = 'menu.php';
	</script>";
} else {
?>
<body onload="setTimeout('delayer()', 3000)">
<?php
	echo("<table width='90%' border='0'>");
	echo("  <tr>");
	echo("    <td height='280'><div align='center'><font size='5'>Erro na autentica&ccedil;&atilde;o!Tente novamente.</font><font size='5'></font></div></td>");
	echo("  </tr>");
	echo("</table>");
}
$banco->DesconectarDB($conexao);
?>
</body>
</html>