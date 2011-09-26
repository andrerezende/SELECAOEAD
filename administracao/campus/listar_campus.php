<?php session_start("SELECAO"); ?>
<?php
ini_set('display_errors', 1);
session_start();

include("../classes/DB.php");
include("../classes/Campus.php");

if (!$_SESSION['validacao']) {
	header("Location: ../login/login.php");
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title> <?php echo ($_SESSION["Gnomeprocessoseletivo"]);?> </title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="tudo" align='center'>
		<div id="conteudoGeral">
			<div id="topo1">
        		<div class="topo1_imagem1"><img src="../../imgs/topo1/ministerio_educacao.jpg" alt="Minist�rio de Educa��o" /></div>
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
				<div id="topo2Texto">
					<?php echo ($_SESSION["Gnomeprocessoseletivo"]);?>
				</div>
					
		</div>	
		<div align="right" class="admin_logout"><p><a href="../login/logout.php" target="_self">Logout</a></p></div>
		<div align="center"><h2>&Aacute;rea Administrativa - Cursos</h2></div>
<?php
	/* Acesso ao banco de dados */
	$banco = DB::getInstance();
	$conexao = $banco->ConectarDB();

	$campus = new Campus();
	$vetorcampus = $campus->SelectByAll($conexao);

	echo("<form id='excluircampus' name='excluircampus' action='' method='post'>");
	echo('  <table width="76%" border="1">');
	echo('  <tr>');
	echo('    <td width="80%"><strong>Campus</strong></td>');
	echo('    <td width="20%"><strong>Excluir</strong></td>');
	echo('  </tr>');

	foreach ($vetorcampus as $campus) {
		echo('  <tr>');
		echo('       <td>' . $campus->getNome(). '</td>');
		echo("       <td><a href='#' onclick='excluir(".$campus->getIdCampus().")'>Excluir</a></td>");
		echo('  </tr>');
	}
	echo('  </table>');
}
?>
		<script type="text/javascript">
		function excluir(id){
			document.forms["excluircampus"].action = "excluir_campus.php?id=" + id;
			document.forms["excluircampus"].submit();
		}
		</script>
		<br />
		<div class="voltar"><form><input type="button" value=" Voltar " onclick="history.go(-1)" /></form></div>
	</div>
</div>
</body>
</html>
