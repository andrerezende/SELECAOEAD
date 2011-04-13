<?php
ob_start();
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Concurso p&uacute;blico para Docentes - 2011</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
</head>
<?php
if (!$_SESSION['validacao']) :
	header("Location:../login/login.php");
else :
?>
<body>
<div id="tudo" align='center'>
<div id="conteudoGeral">
		<div id="topo1">
			<div class="topo1_imagem1">
				<img src="../../imgs/topo1/ministerio_educacao.jpg" alt="Minist&eacute;rio de Educa&ccedil;&atilde;o" />
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
		<p><a href="logout.php" target="_self">Logout</a></p>
	</div>
	<div align='center'>
		<h2>&Atilde;rea Administrativa - Relat&oacute;rios</h2>
	</div>
	<br />
	<table border='0' align='center'>
		<tr>
			<th>Relat&oacute;rio</th>
			<th colspan="2">Filtro de Necessidades Especiais</th>
			<th>&nbsp;</th>
		</tr>
		<tr><th>&nbsp;</th></tr>
		<tr>
			<form id='necessidadeform' name='necessidadeform' action='relatorio_geral.php' method='post'>
				<input type='hidden' value='candidatos_por_necessidade' name="tipo" />
				<td><b>Candidatos por Necessidade Especial</b></td>
				<td>&nbsp;</td>
				<td>
					<select name="necessidade_filtro" id="necessidade_filtro" alt="Filtro de Necessidades Especiais" >
						<option value="1">Sim</option>
						<option value="0">Nao</option>
					</select>
				</td>
				<td><input name="visualizar_portadores" type="submit" id="visualizar_portadores" value="Visualizar"></td>
			</form>
		</tr>
		<tr>
		<tr>
			<th>Relat&oacute;rio</th>
			<th colspan="2">Filtro de Pagamento</th>
			<th>&nbsp;</th>
		</tr>
			<form id='campusform' name='campusform' action='total_de_inscritos.php' method='post'>
				<input type='hidden' value='inscritos_por_campus' name="tipo" />
				<td><b>Total de Inscritos por Campus</b></td>
				<td>&nbsp;</td>
				<td>
					<select name="filtro_pagamento" id="filtro_pagamento" alt="Filtro de Pagamento" >
						<option value="">Todos</option>
						<option value="0">N&atilde;o Pagos</option>
						<option value="1">Pagos</option>
					</select>
				</td>
				<td><input name="visualizar_campus" type="submit" id="visualizar_campus" value="Visualizar"></td>
			</form>
		</tr>
		<tr>
			<form id='cursoform' name='cursoform' action='total_de_inscritos.php' method='post'>
				<input type='hidden' value='inscritos_por_curso' name="tipo" />
				<td><b>Total de Inscritos por Curso</b></td>
				<td>&nbsp;</td>
				<td>
					<select name="filtro_pagamento" id="filtro_pagamento" alt="Filtro de Pagamento" >
						<option value="">Todos</option>
						<option value="0">N&atilde;o Pagos</option>
						<option value="1">Pagos</option>
					</select>
				</td>
				<td><input name="visualizar_curso" type="submit" id="visualizar_curso" value="Visualizar"></td>
			</form>
		</tr>
		<tr>
			<form id='geralform' name='geralform' action='relatorio_geral.php' method='post'>
				<input type='hidden' value='relacao_cadidatos2' name="tipo" />
				<td><b>Rela&ccedil;&atilde;o Completa de Candidatos</b></td>
				<td>&nbsp;</td>
				<td>
					<select name="filtro_pagamento" id="filtro_pagamento" alt="Filtro de Pagamento" >
						<option value="">Todos</option>
						<option value="0">N&atilde;o Pagos</option>
						<option value="1">Pagos</option>
					</select>
				</td>
				<td><input name="visualizar_relatorio" type="submit" id="visualizar_relatorio" value="Visualizar"></td>
			</form>
		</tr>

	</table>
<br />
<div class="voltar">
<form>
	<input type="button" value=" Voltar " onclick="history.go(-1)" />
</form>
</div></div></div>
</body>
</html>
<?php endif;?>
