<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Processo Seletivo para Professor Substituto - 2011</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../../js/jquery-1.3.2.min.js"></script>
	<script language="JavaScript" type="text/JavaScript">
		function Onlynumber(e){
			var tecla=new Number();
			if (window.event) {
				tecla = e.keyCode;
			} else if (e.which) {
				tecla = e.which;
			} else {
				return true;
			}
			if (((tecla < 48) || (tecla > 57)) && (tecla!=8)) {
				return false;
			}
		}

		function validar() {
			var nome            = document.getElementById("nome");
			var endereco        = document.getElementById("endereco");
			var bairro          = document.getElementById("bairro");
//			var cep             = document.getElementById("cep");
			var cidade          = document.getElementById("cidade");
			var estado          = document.getElementById("estado");
			var rg              = document.getElementById("rg");
			var cpf             = document.getElementById("cpf");
			var especial        = document.getElementById("especial");
			var senha           = document.getElementById("senha");
			var senhaConfirm    = document.getElementById("senhaConfirm");
			var declaracao      = document.getElementById("declaracao");
			var nacionalidade   = document.getElementById("nacionalidade");
			var dataNascimento  = document.getElementById("datanascimento");
			var sexo            = document.getElementById("sexo");
			var email            = document.getElementById("email");

			resultado = true;

			if (nome.value == "") {
				alert('Informe o nome!');
				nome.focus();
				resultado = false;
			} else if (cpf.value== "") {
				alert('Informe o CPF!');
				cpf.focus();
				resultado = false;
			} else if (rg.value == "") {
				alert('Informe o RG!');
				rg.focus();
				resultado = false;
			} else if (senha.value== "") {
				alert('Informe a senha!');
				senha.focus();
				resultado = false;
			} else if (senhaConfirm.value == "") {
				alert('Informe a confirmacao de senha!');
				senhaConfirm.focus();
				resultado = false;
			} else if (senhaConfirm.value != senha.value) {
				alert('Confirmacao de senha deve ser igual a senha!');
				senhaConfirm.focus();
				resultado = false;
			} else if (email.value == "") {
				alert('Informe o email!');
				email.focus();
				resultado = false;
			} else if (nacionalidade.value == "") {
				alert('Informe a nacionalidade!');
				senhaConfirm.focus();
				resultado = false;
			} else if (dataNascimento.value == "") {
				alert('Informe a data de nascimento!');
				senhaConfirm.focus();
				resultado = false;
			} else if (sexo.value == "") {
				alert('Informe sexo!');
				senhaConfirm.focus();
				resultado = false;
			} else if (endereco.value == "") {
				alert('Informe o endereco!');
				endereco.focus();
				resultado = false;
			} else if (bairro.value == "") {
				alert('Informe o bairro!');
				bairro.focus();
				resultado = false;
			} else if (cidade.value == "") {
				alert('Informe a cidade!');
				cidade.focus();
				resultado = false;
			} else if (estado.value == "") {
				alert('Informe o estado!');
				estado.focus();
				resultado = false;
			} else if (campus.value <= 0) {
				alert('Favor preencher o Campus e Area!');
				campus.focus();
				resultado = false;
			} else if (especial.value == "") {
				alert('Informe se possui necessidades especiais!');
				especial.focus();
				resultado = false;
			} else if (declaracao.value == "NAO") {
				alert('Voce precisa aceitar a declaracao!');
				declaracao.focus();
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
			// Remove todos os caracteres � seguir: ( ) / - . e espa�o, para tratar a string denovo.
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

		function formata(src, mask) {
			//funcao para formatar qualquer campo.Ex.:cep,cpf,telefone,cnpj.
			var i = src.value.length;
			var saida = '#';
			var texto = mask.substring(i)
			if (texto.substring(0,1) != saida) {
				src.value += texto.substring(0,1);
			}
		}

		function necessidadeEspecial() {
			// Habilita / Desabilita campo especial_descricao
			// de acordo com a escolha do campo 'especial'
			var especial = document.getElementById("especial");
			if (especial.value == "OUTRA") {
				document.getElementById("especial_descricao").readOnly = false;
			} else {
				document.getElementById("especial_descricao").value = "";
				document.getElementById("especial_descricao").readOnly = true;
			}
		}

		function redireciona() {
			window.location="../../index.php"; //redereciona para a página inicial.
		}

		$(document).ready(function() {
			$("#isencao").change(function() {
				$("#isencao option:selected").each(function() {
					if (this.value == "SIM") {
						$("#nis").removeAttr("disabled");
					} else if(this.value == "NAO") {
						$("#nis").val("");
						$("#nis").attr("disabled", true);
					}
				});
			});

			$("#especial_prova").change(function() {
				$("#especial_prova option:selected").each(function() {
					if (this.value == "SIM") {
						$("#especial_prova_descricao").removeAttr("disabled");
					} else {
						$("#especial_prova_descricao").val("");
						$("#especial_prova_descricao").attr("disabled", true);
					}
				});
			});

			$("select[name=campus]").change(function(){
				$("select[name=curso]").html('<option value="0">Carregando...</option>');
				$.post("cursos.php",
					{campus:$(this).val()},
					function(valor){
						$("select[name=curso]").html(valor);
					}
				)
			})

			$("select[name=campus]").change(function(){
				$("select[name=localprova]").html('<option value="0">Carregando...</option>');
				$.post("locais.php",
					{campus:$(this).val()},
					function(valor){
						$("select[name=localprova]").html(valor);
					}
				)
			})
		})
	</script>
</head>
<body>
<?php
include ("../classes/DB.php");
include ("../classes/Inscrito.php");
include ("../classes/Inscrito_Curso.php");
include ("../classes/Curso.php");
include ("../classes/Campus.php");
include ("../classes/Localprova.php");

$id = $_POST['id'];

/* Acesso ao banco de dados */
$banco = DB::getInstance();
$conexao = $banco->ConectarDB();

$inscrito = new Inscrito(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);//36 null
$objinscrito = $inscrito->SelectById($conexao, $id);

if (count($objinscrito)==0){
	echo("<div align=".'"'."center".'"'.">");
		echo("<img src=".'"'."../../imgs/topo2/topo_formulario.png".'"'." alt=".'"'."Instituto Federal Baiano".'"'." />");
		echo("<h2>Formul&aacute;rio de Inscri&ccedil;&atilde;o</h2>");
		echo("<table border='0'>");
		echo("	<tr>");
		echo("		<td><div>Inscri&ccedil;&atilde;o n&atilde;o cadastrada na base de dados ou CPF e Senha n&atilde;o conferem.</div></td>");
		echo("	</tr>");
		echo("	<tr>");
		echo("		<td><br /><div><a href="."javascript:window.history.go(-1)".">Voltar</a>"." - "."<a href="."../../index.php".">P&aacute;gina Inicial</a></div></td>");
		echo("	</tr>");
		echo("</table>");
	echo("</div>");
} else {
?>
<div align="center">
	<img src="../../imgs/topo2/topo_formulario.png" alt="Instituto Federal Baiano" />
	<h2>Ficha de Inscri&ccedil;&atilde;o</h2>
</div>
<div id="formularioInscricao">
	<form id='frmeditarinscricao' name='formeditarinscricao' action='atualizar_inscrito.php' method='post' onsubmit='return validar()' >
		<table width="760px" border="0" align="center">
			<tr>
				<td align='right'>
					<input name="id" id="id" type="hidden" value="<?php echo $objinscrito[0]->getid(); ?>" />
					<label for=numinscricao>N&uacute;mero de Inscri&ccedil;&atilde;o:</label>
				</td>
				<td>
					<span class="textoDestaque3">
						<?php echo $objinscrito[0]->getnuminscricao(); ?>
						<input name="numinscricao" id="numinscricao" type="hidden" value="<?php echo $objinscrito[0]->getnuminscricao(); ?>" />
					</span>
				</td>
			</tr>

			<tr>
				<td align='right'><label for=nome>Nome:</label></td>
				<td colspan='2'>
					<input style="text-transform:uppercase" name="nome" id="nome" type="text" tabindex=1 size='65' maxlength="65" alt="Nome Completo" value="<?php echo($objinscrito[0]->getNome()); ?>" />
					<span class="textoSobrescrito">*</span>
				</td>
			</tr>

			<tr>
				<td align='right'><label for=cpf >CPF:</label></td>
				<td>
					<input name="cpf" type="text" id="cpf" readonly="readonly" tabindex=2 onkeypress="javascript:return Onlynumber(event);" value="<?php echo($objinscrito[0]->getcpf()); ?>" size="15" maxlength="11" alt="CPF" />
					<span class="textoSobrescrito">*</span>
				</td>
			</tr>

			<tr>
				<td height="27" align='right'><label for="senha">Senha:</label></td>
				<td>
					<input name="senha" id="senha" type="password" tabindex=4 size="15" maxlength="15" alt="Senha" value="<?php echo($objinscrito[0]->getsenha()); ?>" />
					<span class="textoSobrescrito">*</span>
				</td>
			</tr>

			<tr>
				<td height="27" align='right'><label for="senha">Confirmar Senha:</label></td>
				<td>
					<input name="senhaConfirm" id="senhaConfirm" type="password" tabindex=5 size="15" maxlength="15" alt="Confirmar Senha" value="<?php echo($objinscrito[0]->getsenha()); ?>" />
					<span class="textoSobrescrito">*</span>
				</td>
			</tr>

			<tr>
				<td height="27" align='right'><label for=rg>RG:</label></td>
				<td>
					<input name="rg" type="text" id="rg" tabindex=5 onkeypress="javascript:return Onlynumber(event);" value="<?php echo($objinscrito[0]->getrg()); ?>" size="15" maxlength="11" alt="RG" />
					<span class="textoSobrescrito">*</span>
				</td>
			</tr>

			<tr>
				<td align='right'><label for=orgaoexpedidor>&Oacute;rg&atilde;o Expedidor:</label></td>
				<td>
					<input style="text-transform:uppercase" name="orgaoexpedidor" id="orgaoexpedidor" type="text" tabindex=6 size="8" maxlength="8" alt="Órgão Expedidor" value="<?echo($objinscrito[0]->getorgaoexpedidor()); ?>" />
					&nbsp;&nbsp;UF:&nbsp;&nbsp;
					<select name="uf" id="uf" tabindex=7>
						<?php
						$uf = array("BA","SE","RJ","MA","MT","ES","MG","SP","AC","RR","RS","AL","PE","MS","PI","CE","CE","PR","DF");
						$total = count($uf);
						$i = 0;
						while ($total > $i) {
							if ($uf[$i] != $objinscrito[0]->getuf()) {
								echo("	<option value=".$uf[$i].">".$uf[$i]."</option>\n");
							} else {
								echo("	<option selected value=".$uf[$i].">".$uf[$i]."</option>\n");
							}
							$i = $i + 1;
						}
						?>
					</select>
				</td>
			</tr>

			<tr>
				<td align='right'><label for=dataexpedicao>Data de Expedi&ccedil;&atilde;o:</label></td>
				<td>
					<input name="dataexpedicao" id="dataexpedicao" type="text" tabindex=8 size="10" maxlength="10" alt="Data de Expedi&ccedil;&atilde;o (RG)" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" value="<?echo($objinscrito[0]->getdataexpedicao()); ?>" />
				</td>
			</tr>

			<tr>
				<td align='right'><label for=nacionalidade>Nacionalidade:</label></td>
				<td>
					<input style="text-transform:uppercase" name="nacionalidade" id="nacionalidade" type="text" tabindex=9 size="30" maxlength="30" alt="Nacionalidade" value="<?echo($objinscrito[0]->getnacionalidade()); ?>" />
					<span class="textoSobrescrito">*</span>
				</td>
			</tr>

			<tr>
				<td align='right'><label for=datanascimento>Data de Nascimento:</label></td>
				<td>
					<input name="datanascimento" id="datanascimento" type="text" tabindex=10 size="10" maxlength="10" alt="Data de Nascimento" onkeypress="Mascara('DATA',this,event); return Onlynumber(event);" value="<?echo($objinscrito[0]->getdatanascimento()); ?>" />
					<span class="textoSobrescrito">*</span>
				</td>
			</tr>

			<tr>
				<td align='right'><label for=sexo>Sexo:</label></td>
				<td>
					<select name="sexo" id="sexo" tabindex=11>
						<?php
						$sexo = array("MASCULINO","FEMININO");
						$total = count($sexo);
						$i = 0;
						while ($total > $i) {
							if ($sexo[$i] != $objinscrito[0]->getsexo()) {
								echo("	<option value=".$sexo[$i].">".$sexo[$i]."</option>\n");
							} else {
								echo("	<option selected value=".$sexo[$i].">".$sexo[$i]."</option>\n");
							}
							$i = $i + 1;
						}
						?>
					</select>
					<span class="textoSobrescrito">*</span>
				</td>
			</tr>

			<tr>
				<td align='right'><label for=endereco>Endere&ccedil;o:</label></td>
				<td colspan='2'>
					<input style="text-transform:uppercase" name="endereco" id="endereco" type="text" tabindex=12 size='65' maxlength="65" alt="Endereco" value="<?echo($objinscrito[0]->getendereco()); ?>" />
					<span class="textoSobrescrito">*</span>
				</td>
			</tr>

			<tr>
				<td align='right'><label for=bairro>Bairro:</label></td>
				<td>
					<input style="text-transform:uppercase" name="bairro" id="bairro" type="text" tabindex=13 size="30" maxlength="30" alt="Bairro" value="<?echo($objinscrito[0]->getbairro()); ?>" />
					<span class="textoSobrescrito">*</span>
					&nbsp;&nbsp;CEP:&nbsp;&nbsp;
					<input name="cep" type="text" id="cep" tabindex=14 onkeypress="Mascara('CEP',this,event); return Onlynumber(event);" size='09' maxlength="09" alt="CEP" value="<?echo($objinscrito[0]->getcep()); ?>" />
				</td>
			</tr>

			<tr>
				<td align='right'><label for=cidade>Cidade:</label></td>
				<td>
					<input style="text-transform:uppercase" name="cidade" id="cidade"  type="text" tabindex=15 size="30" maxlength="30" alt="Cidade" value="<?echo($objinscrito[0]->getcidade()); ?>" />
					<span class="textoSobrescrito">*</span>
					&nbsp;&nbsp;Estado:&nbsp;&nbsp;
					<select name="estado" id="estado" tabindex=16>
						<?php
						$estado = array("BA","SE","RJ","MA","MT","ES","MG","SP","AC","RR","RS","AL","PE","MS","PI","CE","CE","PR","DF");
						$total = count($estado);
						$i = 0;
						while ($total > $i) {
							if ($estado[$i] != $objinscrito[0]->getestado()) {
								echo("	<option value=".$estado[$i].">".$estado[$i]."</option>\n");
							} else {
								echo("	<option selected value=".$estado[$i].">".$estado[$i]."</option>\n");
							}
							$i = $i + 1;
						}
						?>
					</select>
					<span class="textoSobrescrito">*</span>
				</td>
			</tr>

			<tr>
                    <td align='right'><label for=telefone>Telefone:</label></td>
                    <td>
                        <input name="telefone" id="telefone" type="text" tabindex=17 size="15" maxlength="14" alt="Telefone" onkeypress="Mascara('TEL',this,event); return Onlynumber(event);" value="<?echo($objinscrito[0]->gettelefone()); ?>" />
                    </td>
                </tr>

                <tr>
                    <td align='right'><label for=celular >Celular:</label></td>
                    <td>
                        <input name="celular" id="celular" type="text" tabindex=19 size="15" maxlength="14" alt="Celular" onkeypress="Mascara('TEL',this,event); return Onlynumber(event);" value="<?echo($objinscrito[0]->getcelular()); ?>" />
                    </td>
                </tr>

                <tr>
                    <td align='right'><label for=email>E-mail:</label></td>
                    <td>
                        <input style="text-transform:uppercase" name="email" id="email" type="text" tabindex=20 size='40' maxlength="40" alt="E-mail" value="<?echo($objinscrito[0]->getemail()); ?>"/>
                        <span class="textoSobrescrito">*</span>
                    </td>
                </tr>

                <tr>
                    <td align='right'><label for=estadocivil>Estado Civil:</label></td>
                    <td>
                        <select name="estadocivil" id="estadocivil" tabindex=21>
                            <?php
                                $estadocivil = array("SOLTEIRO(A)","CASADO(A)","VI&Uacute;VO(A)","SEPARADO(A)","DIVORCIADO(A)");
                                $total = count($estadocivil);
                                $i =0;
                                while ($total > $i){
                                    if($estadocivil[$i] != $objinscrito[0]->getestadocivil() ){
                                            echo("	<option value=".$estadocivil[$i].">".$estadocivil[$i]."</option>\n");
                                    }else{
                                            echo("	<option selected value=".$estadocivil[$i].">".$estadocivil[$i]."</option>\n");
                                    }
                                    $i= $i + 1;
                                }
                            ?>
                         </select>
                    </td>
                </tr>

                <tr>
                    <td height="28" align='right'><label for=especial>Necessidade Especial:</label></td>
                    <td>
                        <select name="especial" id="especial" tabindex=23 onchange="javascript:necessidadeEspecial()">
                            <?php
                                $especial = array("N&Atilde;O","VISUAL","MOTORA","AUDITIVA","M&Uacute;LTIPLAS","OUTRA");
                                $total = count($especial);
                                $i =0;
                                while ($total > $i){
                                    if($especial[$i] != $objinscrito[0]->getespecial() ){
                                            echo("	<option value=".$especial[$i].">".$especial[$i]."</option>\n");
                                    }else{
                                            echo("	<option selected value=".$especial[$i].">".$especial[$i]."</option>\n");
                                    }
                                    $i= $i + 1;
                                }
                            ?>
                        </select>
                        <span class="textoSobrescrito">*</span>

                        <label for=especial_descricao>Outra: </label>
                        <input style="text-transform:uppercase" name="especial_descricao" type="text" id="especial_descricao" tabindex=24 size='40' maxlength="40" alt="Qual deficiência?" value="<?echo($objinscrito[0]->getespecial_descricao()); ?>" />
                    </td>
                </tr>

                <tr>
                    <td align='right' width="200px"><label for=campus>Campus:</label></td>
                    <td colspan='2'>
                        <select name="campus" tabindex="25">
                           <option value="0" selected="selected">Escolha um Campus</option>
                            <?php
							$campus = new Campus(null, null);
							$vetorcampus = $campus->SelectByAll($conexao);

							/* Varaveis auxiliares */
							$i =0;
							$sel="selected";
							$total = count($vetorcampus);

							while ($total > $i) {
								$codigo = $vetorcampus[$i]->getIdCampus();
								$nome = $vetorcampus[$i]->getnome();
								if ($vetorcampus[$i]->getIdCampus() != $objinscrito[0]->getcampus()) {
									echo("	<option value=".$codigo.">".$nome."</option>\n");
								} else {
									echo("	<option ".$sel." value=".$codigo.">".$nome."</option>\n");
								}
								$i= $i + 1;
							}
                            ?>
                        </select>
						<span class="textoSobrescrito">*</span>
					</td>
				</tr>

                <tr>
                    <td align='right' width="200px">
                        <label for=curso>Curso:</label>
                    </td>

                    <td colspan='2'>
                        <select name="curso" class=".text" id="curso" tabindex=26>
                            <?php
							$inscrito_curso         = new Inscrito_Curso(null, null, null);
								$vetor_inscrito_curso   = $inscrito_curso->ListarCurso($conexao, $objinscrito[0]->getid());
								$nomeCurso              = $vetor_inscrito_curso[0]->getnome();
								$codigoCurso            = $vetor_inscrito_curso[0]->getcodcurso();

								$cod_campus_selecionado = $objinscrito[0]->getcampus();

								$cursosCampus           = new Curso(null, null, null);
								$vetor_cursosCampus     = $cursosCampus->SelectCursoPorCampus($conexao, $cod_campus_selecionado);

								$i=0;
								$total = count($vetor_cursosCampus);

								while ($total > $i) {
									$nomes      = $vetor_cursosCampus[$i]->getnome();
									$codigos    = $vetor_cursosCampus[$i]->getcodcurso();
									if ($codigos == $codigoCurso) {
										echo("	<option selected value=".$codigos.">".$nomes."</option>\n");
									}
									else {
										echo("	<option value=".$codigos.">".$nomes."</option>\n");
									}
									$i= $i + 1;
								}
                            ?>
						</select>
                        <span class="textoSobrescrito">*</span>
                    </td>
                </tr>

				<tr>
					<td align='right' width="200px">
						<label for=localprova>Local de realiza&ccedil;&atilde;o da prova</label>
					</td>
					<td colspan='2'>
						<select name="localprova" tabindex="27">
							<option value="0" selected="selected">Escolha um Local de prova</option>
							<?php
							$localprova = new Localprova(null, null, null);
							$campusLocal = $objinscrito[0]->getcampus();
							$vetorlocalprova = $localprova->SelectLocalPorCampus($conexao, $campusLocal);

							/* Varaveis auxiliares */
							$i = 0;
							$sel = "selected";
							$total = count($vetorlocalprova);

							while ($total > $i) {
								$codigo = $vetorlocalprova[$i]->getcodlocalprova();
								$nome = $vetorlocalprova[$i]->getnome();
								if ($vetorlocalprova[$i]->getcodlocalprova() != $objinscrito[0]->getlocalprova()) {
									echo("	<option value=".$codigo.">".$nome."</option>\n");
								} else {
									echo("	<option ".$sel." value=".$codigo.">".$nome."</option>\n");
								}
								$i= $i + 1;
							}
							?>
						</select>
						<span class="textoSobrescrito">*</span>
					</td>
				</tr>

				<tr>
					<td height="28" align='right'><label for=isencao>Isen&ccedil;&atilde;o de Taxa?</label></td>
					<td>
						<select name="isencao" id="isencao" tabindex=28>
							<?php
							$isencao = array("NAO","SIM");
							$total = count($isencao);
							$i = 0;
							while ($total > $i) {
								$string = 'SIM';
								if ($isencao[$i] == 'NAO') {
									$string = 'N&Atilde;O';
								}
								if ($isencao[$i] != $objinscrito[0]->getisencao()) {
									echo("	<option value=".$isencao[$i].">".$string."</option>\n");
								} else {
									echo("	<option selected value=".$isencao[$i].">".$string."</option>\n");
								}
								$i = $i + 1;
							}
							?>
						</select>
						<span class="textoSobrescrito">* Caso positivo, veja as condi&ccedil;&otilde;es de atendimento no Edital<br /></span>
					</td>
				</tr>

				<tr>
					<td></td>
					<td>
						<span class="textoSobrescrito">
								&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;
								* Caso a modalidade do curso seja PROEJA, ignore este campo
						</span>
					</td>
				</tr>

				<tr>
					<td height="28" align='right'><label for=especial_prova>Condi&ccedil;&otilde;es especiais para realiza&ccedil;&atilde;o da prova:</label></td>
					<td>
						<select name="especial_prova" id="especial_prova" tabindex=29>
							<?php
							$especial_prova = array("N&Atilde;O","SIM");
							$total = count($especial_prova);
							$i = 0;
							while ($total > $i) {
								if ($especial_prova[$i] != $objinscrito[0]->getespecialprova()) {
									echo("	<option value=".$especial_prova[$i].">".$especial_prova[$i]."</option>\n");
								} else {
									echo("	<option selected value=".$especial_prova[$i].">".$especial_prova[$i]."</option>\n");
								}
								$i = $i + 1;
							}
							?>
						</select>
						<span class="textoSobrescrito">*</span>
						&nbsp;&nbsp;Qual?&nbsp;&nbsp;
						<input style="text-transform:uppercase" name="especial_prova_descricao" type="text" id="especial_prova_descricao" tabindex=30 size='40' maxlength="40" alt="Qual?" value="<?echo($objinscrito[0]->getespecialprovadescricao()); ?>" />
					</td>
				</tr>

				<tr>
                    <td height="28" align='right'><label for=vaga_especial>Concorrer &agrave;s vagas reservadas para alunos com Necessidades Especiais:</label></td>
					<td>
						<select name="vaga_especial" id="vaga_especial" tabindex=31>
							<?php
							$vaga_especial = array("N&Atilde;O","SIM");
							$total = count($vaga_especial);
							$i = 0;
							while ($total > $i) {
								if ($vaga_especial[$i] != $objinscrito[0]->getvagaespecial()) {
									echo("	<option value=".$vaga_especial[$i].">".$vaga_especial[$i]."</option>\n");
								} else {
									echo("	<option selected value=".$vaga_especial[$i].">".$vaga_especial[$i]."</option>\n");
								}
								$i = $i + 1;
							}
							?>
						</select>
						<span class="textoSobrescrito">*</span>
					</td>
				</tr>

                <tr>
                    <td height="28" align='right'><label for=vaga_rede_publica>Concorrer &agrave;s vagas reservadas para alunos oriundos da Rede P&uacute;blica:</label></td>
                    <td>
                        <select name="vaga_rede_publica" id="vaga_especial" tabindex=32>
							<?php
							$vaga_especial = array("N&Atilde;O","SIM");
							$total = count($vaga_especial);
							$i = 0;
							while ($total > $i) {
								if ($vaga_especial[$i] != $objinscrito[0]->getvagaredepublica()) {
									echo("	<option value=".$vaga_especial[$i].">".$vaga_especial[$i]."</option>\n");
								} else {
									echo("	<option selected value=".$vaga_especial[$i].">".$vaga_especial[$i]."</option>\n");
								}
								$i = $i + 1;
							}
							?>
                        </select>
                        <span class="textoSobrescrito">*</span>
                    </td>
                </tr>

                <tr>
                    <td height="28" align='right'><label for=vaga_rural>Concorrer &agrave;s vagas reservadas para alunos filhos de Pequenos Produtores Rurais, Assentados, Lavradores e Trabalhadores Rurais:</label></td>
                    <td>
                        <select name="vaga_rural" id="vaga_especial" tabindex=33>
							<?php
							$vaga_especial = array("N&Atilde;O","SIM");
							$total = count($vaga_especial);
							$i = 0;
							while ($total > $i) {
								if ($vaga_especial[$i] != $objinscrito[0]->getvagarural()) {
									echo("	<option value=".$vaga_especial[$i].">".$vaga_especial[$i]."</option>\n");
								} else {
									echo("	<option selected value=".$vaga_especial[$i].">".$vaga_especial[$i]."</option>\n");
								}
								$i = $i + 1;
							}
							?>
                        </select>
                        <span class="textoSobrescrito">*</span>
                    </td>
                </tr>

				<tr>
					<td colspan="2" align="justify">
						<hr />
						<p>Declaro, que estou ciente e de acordo com todas as regras que norteiam a presente sele&ccedil;&atilde;o e que a
						declara&ccedil;&atilde;o de informa&ccedil;&otilde;es falsas sujeita-me &agrave;s san&ccedil;&otilde;es
						administrativa, c&iacute;vel e criminal.</p>
					</td>
				</tr>

				<tr>
					<td colspan="2" align="center">
						Confirma?
						<select name="declaracao" id="declaracao" tabindex=34>
							<option value="NAO" selected="selected">N&Atilde;O</option>
							<option value="SIM">SIM</option>
						</select>
						<br />
						<br />
					</td>
				</tr>

				<tr>
					<td colspan='3' align='center'>
						<input name="Gravar" type="submit" id="Gravar" tabindex=35 value="Gravar Dados" />
						<input type="button" value="Cancelar" onclick="javascript:redireciona();" />
					</td>
				</tr>
<?php }?>
			</table>
	</form>
</div>
</body>
</html>