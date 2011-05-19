<?php
ini_set('display_errors', 1);
session_start();

include("../classes/DB.php");
include("../classes/Curso.php");

if (!$_SESSION['validacao']) {
	header("Location: ../login/login.php");
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Processo Seletivo para Cursos Técnicos à Distância - 2011.2</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="tudo" align='center'>
<div id="conteudoGeral">
		<div id="topo1">
        	<div class="topo1_imagem1">
                    <img src="../../imgs/topo1/ministerio_educacao.jpg" alt="Minist�rio de Educa��o" />
            </div>
            <div id="topo1_destaqueGoveno">
            	<form action="">
 				    <select name="destaque_governo" id="destaque_governo" onchange="if( this.value != '0' )window.open(this.value);">
                        <option value="0">Destaques do Governo</option>
                        <option value="http://www.brasil.gov.br">Portal de Servi&ccedil;os do Governo</option>
                        <option value="http://www.radiobras.gov.br/">Portal da Ag&ecirc;ncia de Not&iacute;cias</option>
                        <option value="http://www.brasil.gov.br/noticias/em_questao">Em Quest&atilde;o</option>
                        <option value="http://www.fomezero.gov.br/">Programa Fome Zero</option>
                    </select>
                </form>
			</div>
        </div>
        <div id="topo2" align="left">
			<img src="../../imgs/topo2/topo2.png" alt="Instituto Federal Baiano" />
     	</div>
	<div align="right" class="admin_logout">
		<p><a href="../login/logout.php" target="_self">Logout</a> </p>
	</div>
	<div align="center"><h2>&Aacute;rea Administrativa - Cursos</h2></div>
<?php
/* Acesso ao banco de dados */
$banco = DB::getInstance();
$conexao = $banco->ConectarDB();

$curso = new Curso(null, null, null);
$vetorcurso = $curso->SelectByAll($conexao);

echo("<form id='excluircurso' name='excluircurso' action='' method='post'>");
echo('  <table width="76%" border="1">');
echo('  <tr>');
echo('    <td width="50%"><strong>Nome do Curso</strong></td>');
echo('    <td width="50%"><strong>Campus</strong></td>');
echo('    <td width="35%"><strong>Excluir</strong></td>');
echo('  </tr>');

foreach ($vetorcurso as $curso) {
	$resultado = $curso->SelectCampusPorCurso($conexao);
	echo('  <tr>');
	while ($row = mysql_fetch_assoc($resultado)) {
		$val = array_values($row);
		echo('       <td>' . $val[1]. '</td>');
		echo('       <td>' . $val[2]. '</td>');
		echo("       <td><a href='#' onclick='excluir(".$val[0].")'>Excluir</a></td>");
	}
	echo('  </tr>');
}
echo('  </table>');
}
?>
<script type="text/javascript">
	function excluir(id){
		document.forms["excluircurso"].action = "excluir_curso.php?id="+id;
		document.forms["excluircurso"].submit();
	}
</script>
<br />
<div class="voltar">
<form>
	<input type="button" value=" Voltar " onclick="history.go(-1)" />
</form>
</div></div></div>
</body>
</html>
