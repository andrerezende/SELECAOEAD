<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Processo Seletivo para Professor Substituto - 2011</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
</head>

<?php
  header("Content-Type: text/html; charset=ISO-8859-1", true);
  include("../classes/DB.php");
  include("../classes/Inscrito.php");
  include("../classes/Inscrito_Curso.php");
  include("../classes/Campus.php");
  include("../classes/Localprova.php");

  $nome                 = addslashes(strtoupper($_POST['nome']));
  $endereco             = addslashes(strtoupper($_POST['endereco']));
  $bairro               = addslashes(strtoupper($_POST['bairro']));
  $cep                  = addslashes($_POST['cep']);
  $cidade               = addslashes(strtoupper($_POST['cidade']));
  $estado               = addslashes($_POST['estado']);
  $email                = addslashes(strtoupper($_POST['email']));
  $cpf                  = addslashes($_POST['cpf']);
  $rg                   = addslashes($_POST['rg']);
  $especial             = addslashes($_POST['especial']);
  $senha                = addslashes($_POST['senha']);
  $nacionalidade        = addslashes(strtoupper($_POST['nacionalidade']));
  $telefone             = addslashes($_POST['telefone']);
  $celular              = addslashes($_POST['celular']);
  $datanascimento       = addslashes($_POST['datanascimento']);
  $sexo                 = addslashes(strtoupper($_POST['sexo']));
  $estadocivil          = addslashes(strtoupper($_POST['estadocivil']));
  $orgaoexpedidor       = addslashes(strtoupper($_POST['orgaoexpedidor']));
  $uf                   = addslashes($_POST['uf']);
  $dataexpedicao        = addslashes($_POST['dataexpedicao']);
  $especial_descricao   = addslashes(strtoupper($_POST['especial_descricao']));
  $isencao              = addslashes($_POST['isencao']);
  $declaracao           = addslashes($_POST['declaracao']);

  //$numinscricao         = $_POST['numinscricao'];
  // Número de inscrição é igual a código do curso + rg + 4 últimos números do telefone2
  //$numinscricao         = $curso.$rg.substr($datanascimento, 0,2).substr($datanascimento, 3,2).substr($datanascimento, 8,2);
  $numinscricao         = addslashes($_POST['numinscricao']);
  $curso                = addslashes($_POST['curso']);
  $id                   = addslashes($_POST['id']);

  $especial_prova       = addslashes(strtoupper($_POST['especial_prova']));
  $especial_prova_descricao = addslashes(strtoupper($_POST['especial_prova_descricao']));
  $vaga_especial        = addslashes(strtoupper($_POST['vaga_especial']));

  $campus               = addslashes($_POST['campus']);
  $nis               = addslashes($_POST['nis']);

  /*Acesso ao banco de dados */
  $banco    = DB::getInstance();
  $conexao  = $banco->ConectarDB();
  
  /*Verificar se possui cadastrado na base*/
  //$inscrito = new Inscrito($nome,$endereco,$bairro,$cep,$cidade,$estado, $email,$telefone,$celular,$cpf,$rg,$localprova,$especial,$senha, $id);

  $inscrito = new Inscrito($nome, $endereco, $bairro, $cep, $cidade, $estado,
            $email, $cpf, $rg, $especial, $senha, $nacionalidade, $telefone, null, $celular, $datanascimento,
            $sexo, $estadocivil, $orgaoexpedidor, $uf, $dataexpedicao, $especial_descricao, null,
            $isencao, $declaracao, null, $numinscricao, $especial_prova, $especial_prova_descricao,
            $vaga_especial, null, null, $campus, $nis, null, null, $id); //37
  
   $resultado = $inscrito->atualizar($conexao);

   if ($resultado) {

       $inscrito_curso = new Inscrito_Curso(null,null,$id);
       $resultado = $inscrito_curso->atualizar($conexao, $curso);

                    echo("<div align=".'"'."center".'"'.">");
                            echo("<img src=".'"'."../../imgs/topo2/topo_formulario.png".'"'." alt=".'"'."Instituto Federal Baiano".'"'." />");
                            echo("<table border='0'>");
                            echo("	<tr align='center'>");
                            echo("		<td><div aligne='center'>Ficha de Inscri&ccedil;&atilde;o alterada com sucesso.<br />
                                                Utilize o n&uacute;mero do CPF (<b>".$cpf."</b>) e Senha informados
                                                para imprimir a ficha de inscri&ccedil;&atilde;o <br />
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
                        			<div align='center'>
                            			<form id='frmboleto' name='frmboleto' action='../boleto/boleto_bb.php' method='post'>
                                			<input type='hidden' name='id' value="<?php echo($id);?>" />
                                			<a href='#' onClick="document.forms['frmboleto'].submit();">Imprimir Boleto para Pagamento</a>
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
 
  //$banco->DesconectarDB($conexao);