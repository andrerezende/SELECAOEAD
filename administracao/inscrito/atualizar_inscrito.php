<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Processo Seletivo para Ingresso de Estudantes - 2011.2</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include("../classes/DB.php");
include("../classes/Inscrito.php");
include("../classes/Inscrito_Curso.php");
include("../classes/Campus.php");
include("../classes/Localprova.php");

foreach ($_POST as $key => $valor) {
	$$key = addslashes(strtoupper($valor));
}

/*Acesso ao banco de dados */
$banco    = DB::getInstance();
$conexao  = $banco->ConectarDB();

/*Verificar se possui cadastrado na base*/
$inscrito = new Inscrito($nome, $endereco, $bairro, $cep, $cidade, $estado,
			$email, $cpf, $rg, $especial, $senha, $nacionalidade, $telefone, null, $celular, $datanascimento,
			$sexo, $estadocivil, $orgaoexpedidor, $uf, $dataexpedicao, $especial_descricao, $responsavel,
			$isencao, $declaracao, $localprova, $numinscricao, $especial_prova, $especial_prova_descricao,
			$vaga_especial, $vaga_rede_publica, $vaga_rural, $campus, $media_por_1, $media_por_2, $media_por_3, $media_mat_1, $media_mat_2, $media_mat_3, $id, null, null, $curso_superior);
$resultado = $inscrito->atualizar($conexao);

if ($resultado) {
	$inscrito_curso = new Inscrito_Curso(null,null,$id);
	$resultado = $inscrito_curso->atualizar($conexao, $curso);

	echo("<div align=".'"'."center".'"'.">");
		echo("<img src=".'"'."../../imgs/topo2/topo_formulario.png".'"'." alt=".'"'."Instituto Federal Baiano".'"'." />");
		echo("<table border='0'>");
		echo("	<tr align='center'>");
		echo("		<td><div aligne='center'>Ficha de Inscri&ccedil;&atilde;o alterada com sucesso.<br />
					Utilize o n&uacute;mero do CPF (<b>".$cpf."</b>) e Senha informados para imprimir a ficha de inscri&ccedil;&atilde;o <br />
					na P&aacute;gina Inicial / Inscri&ccedil;&otilde;es.</div></td>");
		echo("	</tr>");
?>
				<tr>
					<td>
						<div align='center'>
							<form id="frmeditar" name="frmeditar" action="editar.php" method="post">
								<input type="hidden" name="id" value="<?php echo($id);?>" />
								<a href="#" onClick="document.forms['frmeditar'].submit();">Editar Inscri&ccedil;&atilde;o</a>
							</form>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div align="center">
							<form id="frmimpressao" name="frmimpressao" action="impressao.php" method="post">
								<input type="hidden" name="cpf" value="<?php echo($cpf);?>" />
								<a href="#" onclick="document.forms['frmimpressao'].submit();">Imprimir Ficha de Inscri&ccedil;&atilde;o</a>
							</form>
						</div>
					</td>
				</tr>
<?php
		echo("	<tr>");
		echo("		<td align=".'"'."center".'"'.">"."<br /><div><a href="."javascript:window.history.go(-1)".">Voltar</a>"
							." - "
							."<a href="."../../index.php".">P&aacute;gina Inicial</a></div></td>");
		echo("	</tr>");
		echo("</table>");
	echo("</div>");
	echo ("</form>");
} else {
	echo("<div align=".'"'."center".'"'.">");
		echo("<img src=".'"'."../../imgs/topo2/topo_formulario.png".'"'." alt=".'"'."Instituto Federal Baiano".'"'." />");
		echo("<table border='0'>");
		echo("	<tr>");
		echo("		<td><div>Problemas ao alterar a inscri&ccedil;&atilde;o.</div></td>");
		echo("	</tr>");
		echo("	<tr>");
		echo("		<td align=".'"'."center".'"'.">"."<br /><div><a href="."javascript:window.history.go(-1)".">Voltar</a>"." - "."<a href="."../../index.php".">P&aacute;gina Inicial</a></div></td>");
		echo("	</tr>");
		echo("</table>");
	echo("</div>");
}
?>
</body>
</html>
