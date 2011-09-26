<?php session_start("SELECAO"); ?>
<?php
ob_start();
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title> <?php echo ($_SESSION["nome"]);?> </title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
	function validar() {
		var data_final_isencao = document.getElementById("data_final_isencao");
		if (data_final_isencao.value == "") {
			alert('Informe a data final de isencao.');
			data_final_isencao.focus();
			resultado = false;
		}
		return resultado;
	}
	function Mascara(tipo, campo, teclaPress) {
		if (window.event) {
			var tecla = teclaPress.keyCode;
		} else {
			tecla = teclaPress.which;
        }

		var s = new String(campo.value);

		// Remove todos os caracteres a seguir: ( ) / - . e espaÃ§o, para tratar a string denovo.
        s = s.replace(/(\.|\(|\)|\/|\-| )+/g,'');

		tam = s.length + 1;
		if ( tecla != 9 && tecla != 8 ) {
			switch (tipo) {
				case 'CPF' :
					if (tam > 3 && tam < 7)
						campo.value = s.substr(0,3) + '.' + s.substr(3, tam);
					if (tam >= 7 && tam < 10)
						campo.value = s.substr(0,3) + '.' + s.substr(3,3) + '.' + s.substr(6,tam-6);
					if (tam >= 10 && tam < 12)
						campo.value = s.substr(0,3) + '.' + s.substr(3,3) + '.' + s.substr(6,3) + '-' + s.substr(9,tam-9);
					break;
				case 'CNPJ' :
					if (tam > 2 && tam < 6)
						campo.value = s.substr(0,2) + '.' + s.substr(2, tam);
					if (tam >= 6 && tam < 9)
						campo.value = s.substr(0,2) + '.' + s.substr(2,3) + '.' + s.substr(5,tam-5);
					if (tam >= 9 && tam < 13)
						campo.value = s.substr(0,2) + '.' + s.substr(2,3) + '.' + s.substr(5,3) + '/' + s.substr(8,tam-8);
					if (tam >= 13 && tam < 15)
						campo.value = s.substr(0,2) + '.' + s.substr(2,3) + '.' + s.substr(5,3) + '/' + s.substr(8,4)+ '-' + s.substr(12,tam-12);
					break;
				case 'TEL' :
					if (tam > 2 && tam < 4)
						campo.value = '(' + s.substr(0,2) + ') ' + s.substr(2,tam);
					if (tam >= 7 && tam < 11)
						campo.value = '(' + s.substr(0,2) + ') ' + s.substr(2,4) + '-' + s.substr(6,tam-6);
					break;
				case 'DATA' :
					if (tam > 2 && tam < 4)
						campo.value = s.substr(0,2) + '/' + s.substr(2, tam);
					if (tam > 4 && tam < 11)
						campo.value = s.substr(0,2) + '/' + s.substr(2,2) + '/' + s.substr(4,tam-4);
					break;
				case 'CEP' :
					if (tam > 5 && tam < 7)
						campo.value = s.substr(0,5) + '-' + s.substr(5, tam);
					break;
			}
        }
}
	</script>
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
				<div id="topo2Texto">
					<?php echo ($_SESSION["Gnomeprocessoseletivo"]);?>
				</div>
					
		</div>	
	<div align="right" class="admin_logout">
		<p><a href="../login/logout.php" target="_self">Logout</a></p>
	</div>
	<div align='center'>
		<h2>&Aacute;rea Administrativa - Relat&oacute;rios</h2>
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
				<td><b>Candidatos que possuem necessidades especiais</b></td>
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
			<th>Relat&oacute;rio</th>
			<th colspan="2">Filtro de Pagamento</th>
			<th>&nbsp;</th>
		</tr>
		<tr>
			<form id='campusform' name='campusform' action='relatorio_total_inscritos.php' method='post'>
				<input type='hidden' value='inscritos_por_campus' name="tipo" />
				<td><b>Total de inscritos por campus</b></td>
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
			<form id='cursoform' name='cursoform' action='relatorio_total_inscritos.php' method='post'>
				<input type='hidden' value='inscritos_por_curso' name="tipo" />
				<td><b>Total de inscritos por curso</b></td>
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
				<td><b>Rela&ccedil;&atilde;o completa de candidatos</b></td>
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
		<tr>
			<form id='relatorioisentos' name='relatorioisentos' action='relatorio_isentos.php' method='post' onsubmit='return validar()'>
				<input type='hidden' value='relacao_isentos' name="tipo" />
				<td><b>Relat&oacute;rio de isenções solicitadas</b></td>
				<td>&nbsp;</td>
				<td>
					<input type="text" name="data_final_isencao" size="11" maxlength="10" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" id="data_final_isencao" />
				</td>
				<td><input name="visualizar_relatorio" type="submit" id="visualizar_relatorio" value="Visualizar"></td>
			</form>
		</tr>
		<tr>
			<form id='relatorioisencaoconfirmada' name='relatorioisencaoconfirmada' action='relatorio_isentos_confirmados.php' method='post'>
				<input type='hidden' value='relatorioisencaoconfirmada' name="tipo" />
				<td><b>Relat&oacute;rio de isenções confirmadas</b></td>
				<td>&nbsp;</td>
				<td>
					&nbsp;
				</td>
				<td><input name="visualizar_relatorio" type="submit" id="visualizar_relatorio" value="Visualizar"></td>
			</form>
		</tr>

		<tr>
			<form id='relatorionotas' name='relatorionotas' action='relatorio_notas.php' method='post'>
				<input type='hidden' value='relatorionotas' name="tipo" />
				<td><b>Relat&oacute;rio de ordenado por notas</b></td>
				<td>&nbsp;</td>
				<td>
					&nbsp;
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
