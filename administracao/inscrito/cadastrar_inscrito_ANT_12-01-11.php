<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Concurso P&uacute;blico para Discente - 2011.2</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />

<?php
  header("Content-Type: text/html; charset=ISO-8859-1", true);
  include("../classes/DB.php");
  include("../classes/Inscrito.php");
  include("../classes/Inscrito_Curso.php");

  $nome                 = strtoupper($_POST['nome']);
  $endereco             = strtoupper($_POST['endereco']);
  $bairro               = strtoupper($_POST['bairro']);
  $cep                  = $_POST['cep'];
  $cidade               = strtoupper($_POST['cidade']);
  $estado               = $_POST['estado'];
  $email                = strtoupper($_POST['email']);
  $cpf                  = $_POST['cpf'];
  $rg                   = $_POST['rg'];
  $especial             = $_POST['especial'];
  $senha                = $_POST['senha'];
  $nacionalidade        = strtoupper($_POST['nacionalidade']);
  $telefone             = $_POST['telefone'];
  $celular              = $_POST['celular'];
  $datanascimento       = strtoupper($_POST['datanascimento']);
  $sexo                 = $_POST['sexo'];
  $estadocivil          = $_POST['estadocivil'];
  $orgaoexpedidor       = strtoupper($_POST['orgaoexpedidor']);
  $uf                   = $_POST['uf'];
  $dataexpedicao        = $_POST['dataexpedicao'];
  $especial_descricao   = strtoupper($_POST['especial_descricao']);
  $isencao              = $_POST['isencao'];
  $declaracao           = $_POST['declaracao'];
  $curso                = $_POST['curso'];

  $especial_prova       = $_POST['especial_prova'];
  $especial_prova_descricao = $_POST['especial_prova_descricao'];
  $vaga_especial        = $_POST['vaga_especial'];
  $campus               = $_POST['campus'];
  $nis					= $_POST['nis'];

  /*Acesso ao banco de dados */
  $banco    = DB::getInstance();
  $conexao  = $banco->ConectarDB();

  $resultado = $banco->ExecutaQueryGenerica('SELECT MAX(id) +1 AS novo_id FROM inscrito');
  $id = $resultado['novo_id'];
  $numinscricao = substr($cpf, 0,4).$id;

  /*Verificar se possui cadastrado na base*/
  //$inscrito = new Inscrito($nome,$endereco,$bairro,$cep,$cidade,$estado, $email,$telefone,$celular,$cpf,$rg, $localprova, $especial, $senha);
  $inscrito = new Inscrito($nome, $endereco, $bairro, $cep, $cidade, $estado,
            $email, $cpf, $rg, $especial, $senha, $nacionalidade, $telefone, null, $celular, $datanascimento,
            $sexo, $estadocivil, $orgaoexpedidor, $uf, $dataexpedicao, $especial_descricao, null,
            $isencao, $declaracao, null, $numinscricao, $especial_prova, $especial_prova_descricao,
            $vaga_especial, null, null, $campus, $nis, null, null); //36

  $existe   = $inscrito->Existe($conexao);

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
                                        <a href="#" onClick="document.forms['frmeditar'].submit();">Editar Inscri&ccedil;&atilde;o</a>
			            </form>
                                </div>
                            </td>
                   	</tr>
                        <tr>
                        <td>
                            <div align='center'>
                                <form id='frmboleto' name='frmboleto' action='../boleto/boleto_bb.php' method='post'>
                                    <input type='hidden' name='id' value="<?php echo($id);?>" />
                                    <a href='#' onClick="document.forms['frmboleto'].submit();">Imprimir Boleto para Pagamento</a>
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
                    //echo("		<td><br /><div align='center'><a href='../login/menu.html'>Problemas ao efetuar inscri&ccedil;&atilde;o</div></td>");
                    echo("		<td><br /><div align='center'><a href='#'>Problemas ao efetuar inscri&ccedil;&atilde;o</div></td>");
                    echo("	</tr>");
                    echo("</table>");
            echo("</div>");
       }
  }

  $banco->DesconectarDB($conexao);

?>
</head>

