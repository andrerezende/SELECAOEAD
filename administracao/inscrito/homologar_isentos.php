<?php session_start("SELECAO"); ?>
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
				<div class="topo1_imagem1">
					<img src="../../imgs/topo1/ministerio_educacao.jpg"
						alt="Ministï¿½rio de Educa&ccedil;&atilde;o" />
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
			<div align="right" class="admin_logout"><p><a href="../login/logout.php" target="_self">Logout</a></p></div>
			<div align='center'><h2>&Aacute;rea Administrativa - Homologar Isentos</h2></div>
			<form action="homologar.php" method="post" enctype="multipart/form-data" accept="text/plain" >
				<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
				<label for="file">Arquivo:</label>
				<input type="file" id="file" name="file" accept="text/plain" />
				<input type="submit" value="Enviar Arquivo" />
			</form>
					<td colspan="2" align="left">
						<hr />
						<p>Os CPF devem ser separados por vírgula</p>
					</td>

			<br />
			<div class="voltar"><form><input type="button" value=" Voltar " onclick="history.go(-1)" /></form></div>
		</div>
	</div>
</body>
</html>