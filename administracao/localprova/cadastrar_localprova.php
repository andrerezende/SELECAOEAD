<?php session_start("SELECAO"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title> <?php echo ($_SESSION["Gnomeprocessoseletivo"]);?> </title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
	<script language="JavaScript" type="text/JavaScript">
	function validar() {
		var nome = document.getElementById("nome");
		var campus = document.getElementById("campus");

		resultado = true;
		if (nome.value == "") {
			alert('Informe o nome da localidade.');
			nome.focus();
			resultado = false;
		} else if (campus.value <= 0) {
			alert('Informe o Campus do curso.');
			campus.focus();
			resultado = false;
		}
		return resultado;
	}
	</script>
</head>
<body>
	<div id="tudo" align='center'>
		<div id="conteudoGeral">
			<div id="topo1">
				<div class="topo1_imagem1">
					<img src="../../imgs/topo1/ministerio_educacao.jpg"
						alt="Minist�rio de Educa��o" />
				</div>
				<div id="topo1_destaqueGoveno">
					<form action="">
						<select name="destaque_governo" id="destaque_governo"
							onchange="if( this.value != '0' )window.open(this.value);">
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
			<div align='center'> <h2>Cadastro das Localidades de Prova</h2></div>
			<form id='formlocalprova' name='formlocalprova' action='cadastrar.php' method='post' onsubmit='return validar()' >
				<table border='0' align='center' summary=" ">
					<tr>
						<td align='right'><label for="nome">Nome:</label></td>
						<td colspan='2'><input name="nome" id="nome" type="text" tabindex=1 size='70' maxlength="70" ALT="Nome da localidade"></td>
					</tr>
					<tr>
						<td align='right' width="200px"><label for=campus>Campus:</label>
						</td>
						<td colspan='2'><select name="campus" tabindex="25" id="campus">
								<option value="0" selected="selected">Escolha um Campus</option>
								<?php
								include ("../classes/DB.php");
								include ("../classes/Campus.php");
								$banco = DB::getInstance();
								$conexao = $banco->ConectarDB();

								$campus = new Campus(null, null);
								$vetorcampus = $campus->SelectByAll($conexao);

								/* Varaveis auxiliares */
								$i = 0;
								$sel = "selected";
								$total = count($vetorcampus);

								while ($total > $i) {
									$nome = $vetorcampus[$i]->getNome();
									$codigo = $vetorcampus[$i]->getIdCampus();
									echo("	<option value=".$codigo.">".$nome."</option>\n");
									$i = $i + 1;
								}
								?>
						</select>
						</td>
					</tr>
					<tr><td colspan='3' align='center'><input name="Enviar" type="submit" id="Enviar" tabindex=5 value="Enviar">&nbsp;&nbsp;</td></tr>
				</table>
			</form>
			<br />
			<div class="voltar">
				<form><input type="button" value=" Voltar " onclick="history.go(-1)" /></form>
			</div>
		</div>
	</div>
</body>
</html>