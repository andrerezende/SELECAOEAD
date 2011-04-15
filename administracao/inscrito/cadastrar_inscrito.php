<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Concurso P&uacute;blico para Discente - 2011.2</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include("../classes/DB.php");
include("../classes/Inscrito.php");
include("../classes/Inscrito_Curso.php");

foreach ($_POST as $key => $valor) {
	$$key = addslashes(strtoupper($valor));
}

/*Acesso ao banco de dados */
$banco    = DB::getInstance();
$conexao  = $banco->ConectarDB();

$resultado = $banco->ExecutaQueryGenerica('SELECT MAX(id) +1 AS novo_id FROM inscrito');
$resultado = mysql_fetch_assoc($resultado);
$id = $resultado['novo_id'];
$numinscricao = substr($cpf, 0,4).$id;

/*Verificar se possui cadastrado na base*/
$inscrito = new Inscrito($nome, $endereco, $bairro, $cep, $cidade, $estado,
			$email, $cpf, $rg, $especial, $senha, $nacionalidade, $telefone, null, $celular, $datanascimento,
			$sexo, $estadocivil, $orgaoexpedidor, $uf, $dataexpedicao, $especial_descricao, $responsavel,
			$isencao, $declaracao, $localprova, $numinscricao, $especial_prova, $especial_prova_descricao,
			$vaga_especial, $vaga_rede_publica, $vaga_rural, $campus);
			$resultado = $inscrito->Inserir($conexao);
$existe = $inscrito->Existe($conexao);

if ($existe) {
	echo("<div align='center'");
		echo("<img src="."../../imgs/topo2/topo_formulario.png"." alt="."Instituto Federal Baiano"." />");
		echo("<h2>Requerimento de Inscri&ccedil;&atilde;o</h2>");
		echo("<table border='0'>");
		echo("	<tr>");
		echo("		<td><div align='center'>Problemas ao preencher o requerimento de inscri&ccedil;&atilde;o. O CPF informado (<b>".$cpf."</b>) encontra-se associado a outro candidato.<br/>Caso ocorra algum problema, favor entrar em contato (P&aacute;gina Inicial / Contato).</div></td>");
		echo("	</tr>");
		echo("	<tr>");
		echo("		<td><br /><div align='center'><a href="."javascript:window.history.go(-1)".">Voltar</a>"." - "."<a href="."../../index.php".">P&aacute;gina Inicial</a></div></td>");
		echo("	</tr>");
		echo("</table>");
	echo("</div>");
} else {
	$resultado = $inscrito->Inserir($conexao);
	if ($resultado > 0) {
		$inscrito_curso = new Inscrito_Curso(null,null,$resultado);
		$resultado = $inscrito_curso->Inserir($conexao, $curso);

		echo("<div align=".'"'."center".'"'.">");
			echo("<img src=".'"'."../../imgs/topo2/topo_formulario.png".'"'." alt=".'"'."Instituto Federal Baiano".'"'." />");
			echo("<table border='0'>");
			echo("	<tr>");
			echo("		<td><div>Ficha de Inscri&ccedil;&atilde;o preenchido com sucesso. Utilize o n&uacute;mero do CPF informado (<b>".$cpf."</b>) para imprimir a ficha de inscri&ccedil;&atilde;o.</div></td>");
			echo("	</tr>");
			echo("	<tr>");
?>
					<tr>
						<td>
							<div align='center'>
								<form id="frmeditar" name="frmeditar" action="editar.php" method="post">
									<input type="hidden" name="id" value="<?php echo($id);?>" />
									<a href="#" onclick="document.forms['frmeditar'].submit();">Editar Inscri&ccedil;&atilde;o</a>
								</form>
							</div>
						</td>
					</tr>
                        <tr>
                        <td>
                            <div align='center'>
                                <form id='frmboleto' name='frmboleto' action='../boleto/boleto_bb.php' method='post'>
                                    <input type='hidden' name='id' value="<?php echo($id);?>" />
                                    <a href='#' onclick="document.forms['frmboleto'].submit();">Imprimir Boleto para Pagamento</a>
                                </form>
                            </div>
                        </td>
                        </tr>
<?php
			echo("		<td align=".'"'."center".'"'.">"."<br /><div><a href="."javascript:window.history.go(-1)".">Voltar</a>"." - "."<a href="."../../index.php".">P&aacute;gina Inicial</a></div></td>");
			echo("	</tr>");
			echo("</table>");
			echo("</div>");
} else {
	echo("<div align='center'");
		echo("<img src="."../../imgs/topo2/topo_formulario.png"." alt="."Instituto Federal Baiano"." />");
		echo("<h2>Ficha de Inscri&ccedil;&atilde;o</h2>");
		echo("<table border='0'>");
		echo("	<tr>");
		echo("		<td><br /><div align='center'><a href='#'>Problemas ao efetuar inscri&ccedil;&atilde;o</div></td>");
		echo("	</tr>");
		echo("</table>");
	echo("</div>");
	}
}

$banco->DesconectarDB($conexao);

?>
</body>
</html>
