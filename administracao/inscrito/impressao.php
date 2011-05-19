<?php
include("../classes/DB.php");
include("../classes/Inscrito.php");
include("../classes/Inscrito_Curso.php");
include("../classes/Campus.php");
include("../classes/Localprova.php");

$cpf = addslashes($_POST['cpf']);
$id = $_POST['id'];

/* Acesso ao banco de dados */
$banco   = DB::getInstance();
$conexao = $banco->ConectarDB();
$inscrito  = new Inscrito();//36
if ($id) {
	$objinscrito = $inscrito->SelectById($conexao, $id);
} elseif ($cpf) {
	$objinscrito = $inscrito->SelectByCpf($conexao, $cpf);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Processo Seletivo para Cursos Técnicos à Distância - 2011.2</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
</head>

<?php
if (count($objinscrito) == 0) {
	echo("<table width='90%' border='0'>");
	echo("  <tr>");
	echo("    <td height='280'><div align='center'><font size='5'>Inscri&ccedil;&atilde;o n&atilde;o encontrada na base de dados.</font><font size='5'></font></div></td>");
	echo("  </tr>");
	echo("</table>");
} else{
?>

<body class="formImpressao">

<div align='center'>
	<p><img src="../../imgs/logo.gif" width="178" height="100" alt="logotipo do Ifbaiano"></p>
        <p><h2>Processo Seletivo para Cursos Técnicos à Distância - 2011.2</h2>
	<p><h3>Ficha de Inscri&ccedil;&atilde;o</h3>
</div>

<form id='frmficha' name='frmficha' action='ficha_excel.php' method='post' onsubmit='' >
<!--    <input type="hidden" name="cpf" id="cpf" value="<?php //echo($cpf);?>">-->

    <table width="760px" border="0" align="center">
        <tr>
            <td align='right'>
                <input name="id" id="id" type="hidden" disabled="disabled" value="<?php echo $objinscrito[0]->getid(); ?>" />
                <label for=numinscricao>N&uacute;mero de Inscri&ccedil;&atilde;o:</label>
            </td>
            <td>
                <span class="textoDestaque3">
                    <input name="numinscricao" id="numinscricao" readonly="readonly" style="font-size: 16px;" value="<?php echo $objinscrito[0]->getnuminscricao(); ?>" />
                </span>
            </td>
        </tr>

        <tr>
            <td align='right'><label for=nome>Nome:</label></td>
            <td colspan='2'>
                <input style="text-transform:uppercase" name="nome" id="nome" disabled="disabled" type="text" tabindex=1 size='65' maxlength="65" alt="Nome Completo" value="<?php echo($objinscrito[0]->getNome()); ?>" />
            </td>
        </tr>

        <tr>
            <td align='right'><label for=cpf >CPF:</label></td>
            <td>
                <input name="cpf" type="text" id="cpf" disabled="disabled" tabindex=2 value="<?php echo($objinscrito[0]->getcpf()); ?>" size="15" maxlength="11" alt="CPF" />
            </td>
        </tr>

        <tr>
            <td height="27" align='right'><label for=rg>RG:</label></td>
            <td>
                <input name="rg" type="text" id="rg" disabled="disabled" tabindex=3 value="<?php echo($objinscrito[0]->getrg()); ?>" size="15" maxlength="11" alt="RG" />
            </td>
        </tr>

        <tr>
            <td align='right'><label for=orgaoexpedidor>&Oacute;rg&atilde;o Expedidor:</label></td>
            <td>
                <input style="text-transform:uppercase" name="orgaoexpedidor" id="orgaoexpedidor" disabled="disabled" type="text" tabindex=6 size="8" maxlength="8" alt="Órgão Expedidor" value="<?php echo($objinscrito[0]->getorgaoexpedidor()); ?>" />
                    &nbsp;&nbsp;UF:&nbsp;&nbsp;
                    <input name="uf" type="text" id="uf" disabled="disabled" tabindex=3 value="<?echo($objinscrito[0]->getuf()); ?>" size="2" />
            </td>
        </tr>

        <tr>
            <td align='right'><label for=dataexpedicao>Data de Expedi&ccedil;&atilde;o:</label></td>
            <td>
                <input name="dataexpedicao" id="dataexpedicao" disabled="disabled" type="text" tabindex=8 size="10" maxlength="10" alt="Data de Expedi&ccedil;&atilde;o (RG)" onKeyPress="Mascara('DATA',this,event);" value="<?php echo($objinscrito[0]->getdataexpedicao()); ?>" />
            </td>
        </tr>

        <tr>
            <td align='right'><label for=nacionalidade>Nacionalidade:</label></td>
            <td>
                <input style="text-transform:uppercase" name="nacionalidade" id="nacionalidade" disabled="disabled" type="text" tabindex=9 size="30" maxlength="30" alt="Nacionalidade" value="<?php echo($objinscrito[0]->getnacionalidade()); ?>" />
            </td>
        </tr>

        <tr>
            <td align='right'><label for=datanascimento>Data de Nascimento:</label></td>
            <td>
                <input name="datanascimento" id="datanascimento" disabled="disabled" type="text" tabindex=10 size="10" maxlength="10" readonly="readonly" alt="Data de Nascimento" onKeyPress="Mascara('DATA',this,event);" value="<?php echo($objinscrito[0]->getdatanascimento()); ?>" />
            </td>
        </tr>

        <tr>
            <td align='right'><label for=sexo>Sexo:</label></td>
            <td>
                <input name="sexo" id="sexo" disabled="disabled" type="text" tabindex=10 size="10" maxlength="10" value="<?php echo($objinscrito[0]->getsexo()); ?>" />
            </td>
        </tr>

        <tr>
            <td align='right'><label for=endereco>Endere&ccedil;o:</label></td>
            <td colspan='2'>
                <input style="text-transform:uppercase" name="endereco" id="endereco" disabled="disabled" type="text" tabindex=12 size='65' maxlength="65" alt="Endereco" value="<?php echo($objinscrito[0]->getendereco()); ?>" />
            </td>
        </tr>

        <tr>
            <td align='right'><label for=bairro>Bairro:</label></td>
            <td>
                <input style="text-transform:uppercase" name="bairro" id="bairro" disabled="disabled" type="text" tabindex=13 size="30" maxlength="30" alt="Bairro" value="<?php echo($objinscrito[0]->getbairro()); ?>" />
                &nbsp;&nbsp;CEP:&nbsp;&nbsp;
                <input name="cep" type="text" id="cep" disabled="disabled" tabindex=14 onKeyPress="formata(this, '#####-###');" size='09' maxlength="09" alt="CEP" value="<?php echo($objinscrito[0]->getcep()); ?>" />
            </td>
        </tr>

        <tr>
            <td align='right'><label for=cidade>Cidade:</label></td>
            <td>
                <input style="text-transform:uppercase" name="cidade" id="cidade" disabled="disabled" type="text" tabindex=15 size="30" maxlength="30" alt="Cidade" value="<?php echo($objinscrito[0]->getcidade()); ?>" />
                &nbsp;&nbsp;Estado:&nbsp;&nbsp;
                <input style="text-transform:uppercase" name="estado" id="estado" disabled="disabled" type="text" tabindex=16 size="2" maxlength="2" alt="Estado" value="<?php echo($objinscrito[0]->getestado()); ?>" />
            </td>
        </tr>

        <tr>
            <td align='right'><label for=telefone>Telefone:</label></td>
            <td>
                <input name="telefone" id="telefone" disabled="disabled" type="text" tabindex=17 size="15" maxlength="14" alt="Telefone" onKeyPress="Mascara('TEL',this,event);" value="<?php echo($objinscrito[0]->gettelefone()); ?>" />
            </td>
        </tr>

        <tr>
            <td align='right'><label for=celular >Celular:</label></td>
            <td>
                <input name="celular" id="celular" disabled="disabled" type="text" tabindex=19 size="15" maxlength="14" alt="Celular" onKeyPress="Mascara('TEL',this,event);" value="<?php echo($objinscrito[0]->getcelular()); ?>" />
            </td>
        </tr>

        <tr>
            <td align='right'><label for=email>E-mail:</label></td>
            <td>
                <input style="text-transform:uppercase" name="email" id="email" disabled="disabled" type="text" tabindex=20 size='40' maxlength="40" alt="E-mail" value="<?php echo($objinscrito[0]->getemail()); ?>"/>
            </td>
        </tr>

        <tr>
            <td align='right'><label for=estadocivil>Estado Civil:</label></td>
            <td>
                <input style="text-transform:uppercase" name="estadocivil" id="estadocivil" disabled="disabled" type="text" tabindex=21 alt="Estado Civil" value="<?php echo($objinscrito[0]->getestadocivil()); ?>"/>
            </td>
        </tr>

		<tr>
            <td align='right'><label for=responsavel>Respons&aacute;vel:</label></td>
            <td>
                <input style="text-transform:uppercase" name="responsavel" id="responsavel" disabled="disabled" type="text" tabindex=21 alt="Responsável" value="<?php echo($objinscrito[0]->getresponsavel()); ?>"/>
            </td>
        </tr>

        <tr>
            <td height="28" align='right'><label for=especial>Necessidade Especial:</label></td>
            <td>
                <input style="text-transform:uppercase" name="especial" id="especial" disabled="disabled" type="text" tabindex=23 value="<?php echo($objinscrito[0]->getespecial()); ?>" />

                <label for=especial_descricao>Outra: </label>
                <input style="text-transform:uppercase" name="especial_descricao" type="text" id="especial_descricao" disabled="disabled" tabindex=24 size='40' maxlength="40" alt="Qual deficiência?" value="<?php echo($objinscrito[0]->getespecial_descricao()); ?>" />
            </td>
        </tr>

        <tr>
            <td height="28" align='right'><label for=campus>Campus:</label></td>
            <td>
               <?
                    $campus = new Campus(null, null);
                    $campusInscrito = $objinscrito[0]->getcampus();
                    $vetorCampusIncrito = $campus->SelectNomeCampus($conexao, $campusInscrito);
                    $nomeCampus = $vetorCampusIncrito[0]->getNome();
               ?>
                <input style="text-transform:uppercase" name="campus" id="campus" disabled="disabled" type="text" tabindex=23 value="<?php echo($nomeCampus); ?>" />
            </td>
        </tr>

        <tr>
            <td align='right' width="200px">
                <label for=curso>&Aacute;rea:</label>
            </td>
            <td colspan='2'>
				<?php
				$inscrito_curso       = new Inscrito_Curso(null,null,null);
				$vetor_inscrito_curso = $inscrito_curso->ListarCurso($conexao, $objinscrito[0]->getid());

				/* Varaveis auxiliares */
				$i =0;
				$total = count($vetor_inscrito_curso);

				while ($total > $i) {
					$curso    = $vetor_inscrito_curso[$i]->getnome();
					$codigoSelecionado  = $vetor_inscrito_curso[$i]->getcodcurso();
					//echo("	<option selected value=".$codigoSelecionado.">".$nome."</option>\n");
					$i= $i + 1;
				}
				//$banco->DesconectarDB($conexao);
				?>
				<input name="curso" disabled="disabled" id="curso" tabindex=25 size="80" value="<?php echo($curso)?>" />
            </td>
        </tr>

		<tr style="display: none;">
			<td height="28" align='right'><label for=localprova>Local de realiza&ccedil;&atilde;o da prova:</label></td>
			<td>
				<?php
				$localprova = new Localprova(null, null, null);
				$localprovaInscrito = $objinscrito[0]->getlocalprova();
				$vetorLocalprovaIncrito = $localprova->SelectNomeLocalProva($conexao, $localprovaInscrito);
				$nomeLocalprova = $vetorLocalprovaIncrito[0]->getNome();
				?>
				<input style="text-transform:uppercase" name="campus" id="campus" disabled="disabled" type="text" tabindex=23 value="<?php echo($nomeLocalprova); ?>" />
			</td>
		</tr>

        <tr>
            <td height="28" align='right'><label for=isencao>Solicita Isen&ccedil;&atilde;o de Taxa?</label></td>
            <td>
                <input name="isencao" id="isencao" disabled="disabled" id="curso" tabindex=26 size="3" value="<?php echo($objinscrito[0]->getisencao()); ?>" />
            </td>
        </tr>

        <tr>
            <td height="28" align='right'><label for=especial_prova>Condi&ccedil;&otilde;es especiais para realiza&ccedil;&atilde;o da prova:</label></td>
            <td>
                <input style="text-transform:uppercase" name="especial_prova" id="especial_prova" disabled="disabled" id="especial_prova" tabindex=27 size="3" value="<?php echo($objinscrito[0]->getespecialprova()); ?>" />
                <label for=especial_prova>Qual:</label>
                <input style="text-transform:uppercase" name="especial_prova_descricao" disabled="disabled" id="especial_prova_descricao" tabindex=28 size='40' value="<?php echo($objinscrito[0]->getespecialprovadescricao()); ?>" />
            </td>
        </tr>

        <tr>
            <td height="28" align='right'><label for=vaga_especial>Concorrer &agrave;s vagas reservadas para alunos com Necessidades Especiais:</label></td>
            <td>
                <input style="text-transform:uppercase" name="vaga_especial" id="especial_prova" disabled="disabled" tabindex=29 size="3" value="<?php echo($objinscrito[0]->getvagaespecial()); ?>" />
            </td>
        </tr>

        <tr>
            <td height="28" align='right'><label for=vaga_rede_publica>Concorrer &agrave;s vagas reservadas para alunos oriundos da Rede P&uacute;blica:</label></td>
            <td>
                <input style="text-transform:uppercase" name="vaga_rede_publica" id="vaga_rede_publica" disabled="disabled" tabindex=30 size="3" value="<?php echo($objinscrito[0]->getvagaredepublica()); ?>" />
            </td>
        </tr>

        <tr style="display: none">
            <td height="28" align='right'><label for=vaga_rural>Concorrer &agrave;s vagas reservadas para alunos filhos de Pequenos Produtores Rurais, Assentados, Lavradores e Trabalhadores Rurais:</label></td>
            <td>
                <input style="text-transform:uppercase" name="vaga_rural" id="vaga_rural" disabled="disabled" tabindex=30 size="3" value="<?php echo($objinscrito[0]->getvagarural()); ?>" />
            </td>
        </tr>

       	<tr>
			<td height="28" align='right'><label for="curso_superior">Curso Superior:</label></td>
			<td>
				<input style="text-transform:uppercase" name="curso_superior" id="curso_superior" disabled="disabled" tabindex=30 size="3" value="<?php echo($objinscrito[0]->getcursosuperior()); ?>" />
			</td>
		</tr>

		<tr>
			<?php
			$medias_portugues = $objinscrito[0]->getMediasPortugues();
			$medias_matematica = $objinscrito[0]->getMediasMatematica();
			?>
			<td align='right' width="200px">M&eacute;dias de Portugu&ecirc;s:</td>
			<td>
				&emsp;1&deg; Ano: <input disabled="disabled" name="media_por_1" type="text" id="media_por_1" onkeypress="javascript:return Onlynumber(event);" value="<?php echo $medias_portugues[0]; ?>" size="3" maxlength="3" alt="Média de Portugu&ecirc;s 1&deg;" />
				&emsp;2&deg; Ano: <input disabled="disabled" name="media_por_2" type="text" id="media_por_2" onkeypress="javascript:return Onlynumber(event);" value="<?php echo $medias_portugues[1]; ?>" size="3" maxlength="3" alt="Média de Portugu&ecirc;s 2&deg;" />
				&emsp;3&deg; Ano: <input disabled="disabled" name="media_por_3" type="text" id="media_por_3" onkeypress="javascript:return Onlynumber(event);" value="<?php echo $medias_portugues[2]; ?>" size="3" maxlength="3" alt="Média de Portugu&ecirc;s 3&deg;" />
			</td>
		</tr>

		<tr>
			<td align='right' width="200px">M&eacute;dias de Matem&aacute;tica:</td>
			<td>
				&emsp;1&deg; Ano: <input disabled="disabled" name="media_mat_1" type="text" id="media_mat_1" onkeypress="javascript:return Onlynumber(event);" value="<?php echo $medias_matematica[0]; ?>" size="3" maxlength="3" alt="Média de Matem&aacute;tica 1&deg;" />
				&emsp;2&deg; Ano: <input disabled="disabled" name="media_mat_2" type="text" id="media_mat_2" onkeypress="javascript:return Onlynumber(event);" value="<?php echo $medias_matematica[1]; ?>" size="3" maxlength="3" alt="Média de Matem&aacute;tica 2&deg;" />
				&emsp;3&deg; Ano: <input disabled="disabled" name="media_mat_3" type="text" id="media_mat_3" onkeypress="javascript:return Onlynumber(event);" value="<?php echo $medias_matematica[2]; ?>" size="3" maxlength="3" alt="Média de Matem&aacute;tica 3&deg;" />
			</td>
		</tr>

        <tr>
            <td colspan="2" align="justify">
                <hr />
                    <p>
                        Declaro, que estou ciente
                        e de acordo com todas as regras que norteiam a presente sele&ccedil;&atilde;o e que a declara&ccedil;&atilde;o
                        de informa&ccedil;&otilde;es falsas sujeita-me &agrave;s san&ccedil;&otilde;es administrativa, c&iacute;vel e criminal.
                    </p>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <a href="#" onclick="window.print();"><img src="../../imgs/icone_impressao.gif" alt="Imprimir" /> Imprimir</a> /
                <a href="../../index.php">P&aacute;gina Inicial</a> /
            </td>
			<td><a href="javascript:history.go(-1)">Voltar</a></td>
        </tr>
    </table>
<?php }?>
</form>
</body>
</html>