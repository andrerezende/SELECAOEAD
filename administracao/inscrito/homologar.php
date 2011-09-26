<?php session_start("SELECAO"); ?>
<?php
session_start();
require_once '../classes/DB.php';
require_once '../classes/Inscrito.php';

$banco = DB::getInstance();
$conexao = $banco->ConectarDB();

function add_aspas($cpf) {
	return "'$cpf'";
}
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
			<?php
			if (isset($_FILES['file'])) :
			?>
				<table width="76%" border="1">
					<tr>
						<td><strong>Id</strong></td>
						<td><strong>Nome</strong></td>
						<td><strong>N. Inscrição</strong></td>
						<td><strong>CPF</strong></td>
					</tr>
			<?php
				$cpfs = file_get_contents($_FILES['file']['tmp_name']);
				$ids = array();

				$cpfs = explode(',', $cpfs);

				$cpfs = array_map('trim', $cpfs);
				$cpfs = array_map('add_aspas', array_values($cpfs));

				$select = 'SELECT id, nome, numinscricao, cpf FROM inscrito WHERE cpf IN ('. implode(',', $cpfs) .') AND isento_homologado IS NULL AND isencao = \'SIM\';';

				$result = $banco->ExecutaQueryGenerica($select);

				$qtd = mysql_affected_rows();

				if ($qtd > 0) {
					while ($row = mysql_fetch_object($result)) {
						echo '<tr>';
						echo '	<td>'. $row->id .'</td>';
						echo '	<td>'. $row->nome .'</td>';
						echo '	<td>'. $row->numinscricao .'</td>';
						echo '	<td>'. $row->cpf .'</td>';
						echo '</tr>';
						$ids[] = $row->id;
					}
				} else {
					echo '<tr>';
					echo '	<td colspan="4">Não foram encotrados isentos a serem homologados.</td>';
					echo '</tr>';
				}
			endif;
			?>
			</table>
			<br />
			<form action="homologar.php" method="post">
				<input type="hidden" value="1" id="homologar" name="homologar" />
				<input type="hidden" value="<?php echo htmlspecialchars(serialize($ids));?>" id="ids" name="ids" />
				<input type="submit" value="Homologar Isentos" />
			</form>
			<?php
			if (isset($_POST['homologar']) && !empty($_POST['homologar'])) {
				$ids = implode(',', unserialize($_POST['ids']));
				$inscrito = new Inscrito();
				$resultado = $inscrito->homologarIsento($conexao, $ids);
				if ($resultado == true) {
					$_SESSION['flashMensagem'] = 'Isentos homologados com sucesso.';
				} else {
					$_SESSION['flashMensagem'] = 'Problemas ao efetuar o transa&ccedil;&atilde;o.';
				}
				header('Location: ../login/menu.php');
				exit;
			}
			?>
			<div class="voltar"><form><input type="button" value=" Voltar " onclick="history.go(-1)" /></form></div>
		</div>
	</div>
</body>
</html>