<?php
  include("../classes/DB.php");
  include("../classes/Curso.php");

  $nome    = addslashes($_POST['nome']);

  /* Acesso ao banco de dados */
  $banco   = DB::getInstance();
  $conexao = $banco->ConectarDB();

  $curso = new Curso(null,$nome);
  $resultado = $curso->Inserir($conexao);
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
  if($resutado=true){
    echo("<table width='90%' border='0'>");
    echo("  <tr>");
    echo("    <td height='280'><div align='center'><font size='6'><a href='../login/menu.php'>Cadastro efetuado com sucesso</font><font size='6'></font></div></td>");
    echo("  </tr>");
    echo("</table>");
  }
  else{
    echo("<table width='90%' border='0'>");
    echo("  <tr>");
    echo("    <td height='280'><div align='center'><font size='6'><a href='../login/menu.php'>Problemas ao efetuar o cadastro</font><font size='6'></font></div></td>");
    echo("  </tr>");
    echo("</table>");
  }

  $banco->DesconectarDB($conexao);
  ?>
  </body>
  </html>