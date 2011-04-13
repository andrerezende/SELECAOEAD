<?php
  include("../classes/DB.php");
  include("../classes/Curso.php");
  include("../classes/Inscrito_Curso.php");

  $id       = addslashes($_GET['id']);
  
  /*Acesso ao banco de dados */
  $banco    = DB::getInstance();
  $conexao  = $banco->ConectarDB();
  
  
  $curso = new Curso(null,null);
  $inscrito_curso = new Inscrito_Curso(null,null,null);

  $existeCandidatoAssociado   = $curso->existeCursoAssociadoAcandidato($conexao, $id);
  $curso_eliminado = false;
  $curso_inativado = false;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Concurso p&uacute;blico para Docentes - 2011</title>
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
if ($existeCandidatoAssociado) {
	$curso_inativado   = $curso->inativar($conexao, $id);
} else {
	$curso_eliminado   = $curso->apagar($conexao, $id);
}
if ($curso_eliminado) {
	echo("<table width='90%' border='0'>");
	echo("  <tr>");
	echo("    <td height='280'><div align='center'><font size='6'>Curso excluido com sucesso!</font><font size='6'></font></div></td>");
	echo("  </tr>");
	echo("</table>");
} else if ($curso_inativado) {
	echo("<table width='90%' border='0'>");
	echo("  <tr>");
	echo("    <td height='280'><div align='center'><font size='6'>O Curso selecionado possui candidatos associados e foi inativado.</font><font size='6'></font></div></td>");
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
?>
</body>
</html>