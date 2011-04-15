<?php
session_start();
include("../classes/DB.php");
include("../classes/Inscrito.php");

if (!$_SESSION['validacao']) :
header("Location: ../login/login.php");
else :
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Concurso P&uacute;blico para Discente - 2011.2</title>
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
			<div align="right" class="admin_logout"><p><a href="logout.php" target="_self">Logout</a></p></div>
			<div align='center'><h2>&Aacute;rea Administrativa - Inscritos</h2></div>
			<?php
			/* Acesso ao banco de dados */
			$banco = DB::getInstance();
			$conexao = $banco->ConectarDB();

			$inscrito = new Inscrito(null,null,null,null,null,null,null,null,null,null,null,null,null);
			$vetorinscrito = $inscrito->SelectByAll($conexao);

			/* Varaveis auxiliares */
			$i = 0;
			$total = count($vetorinscrito);

			echo('<body>');
			echo('  <table width="100%" border="1">');
			echo('  <tr>');
			echo('    <td width="35%"><strong>Nome</strong></td>');
			echo('    <td width="35%"><strong>CPF</strong></td>');
			echo('    <td width="35%"><strong>RG</strong></td>');
			echo('    <td width="35%"><strong>Editar</strong></td>');
			echo('    <td width="35%"><strong>Excluir</strong></td>');
			echo('  </tr>');

			while ($total > $i) {
				$nome = $vetorinscrito[$i]->getnome();
				$cpf = $vetorinscrito[$i]->getcpf();
				$rg = $vetorinscrito[$i]->getrg();
				$id = $vetorinscrito[$i]->getid();

				if ($cpf == ""){
					$cpf = 'N&atilde;o informado';
				}
				$i = $i + 1;
				echo('  <tr>');
				echo('       <td>'.$i.'-'. $nome. '</td>');
				echo('       <td>' . $cpf. '</td>');
				echo('       <td>' . $rg. '</td>');
				echo("       <td>
				<form id=\"frmeditar$id\" name=\"frmeditar$id\" action=\"editar.php\" method=\"post\">
				<input type=\"hidden\" name=\"id\" value=\"$id\"/>
				<a href=\"#\" onclick=\"document.forms['frmeditar$id'].submit();\">Editar</a>
				</form>
				</td>");
				echo("       <td>
				<form id=\"frmexcluir$id\" name=\"frmexcluir$id\" action=\"excluir.php\" method=\"post\">
				<input type=\"hidden\" name=\"id\" value=\"$id\"/>
				<a href=\"#\" onclick=\"document.forms['frmexcluir$id'].submit();\">Excluir</a>
				</form>
				</td>");
				echo('  </tr>');
			}
			echo('  </table>');
			echo('  </body>');
			echo("</form");
			?>
			<br />
			<div class="voltar">
				<form>
					<input type="button" value=" Voltar " onclick="history.go(-1)" />
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<?php endif;?>