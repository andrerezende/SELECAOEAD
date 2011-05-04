<?php session_start()?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Processo Seletivo para Ingresso de Estudantes - 2011.2</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="estilo_selecao.css" rel="stylesheet" type="text/css" />
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

		function ValidaCPF(campo) {
			var CPF = campo.value; // Recebe o valor digitado no campo

			// Aqui começa a checagem do CPF
			var POSICAO, I, SOMA, DV, DV_INFORMADO;
			var DIGITO = new Array(10);
			DV_INFORMADO = CPF.substr(9, 2); // Retira os dois últimos dígitos do número informado

			// Desemembra o número do CPF na array DIGITO
			for (I=0; I<=8; I++) {
				DIGITO[I] = CPF.substr( I, 1);
			}

			// Calcula o valor do 10 dígito da verificação
			POSICAO = 10;
			SOMA = 0;
			for (I=0; I<=8; I++) {
				SOMA = SOMA + DIGITO[I] * POSICAO;
				POSICAO = POSICAO - 1;
			}
			DIGITO[9] = SOMA % 11;
			if (DIGITO[9] < 2) {
				DIGITO[9] = 0;
			} else {
				DIGITO[9] = 11 - DIGITO[9];
			}

			// Calcula o valor do 11 dígito da verificação
			POSICAO = 11;
			SOMA = 0;
			for (I=0; I<=9; I++) {
				SOMA = SOMA + DIGITO[I] * POSICAO;
				POSICAO = POSICAO - 1;
			}
			DIGITO[10] = SOMA % 11;
			if (DIGITO[10] < 2) {
				DIGITO[10] = 0;
			} else {
				DIGITO[10] = 11 - DIGITO[10];
			}

			// Verifica se os valores dos dígitos verificadores conferem
			DV = DIGITO[9] * 10 + DIGITO[10];
			if (DV != DV_INFORMADO) {
				alert('CPF invalido');
				campo.value = '';
				campo.focus();
				return false;
			}
			return true;
		}

		function validar() {
			var cpf = document.getElementById("cpf");
			resultado = true;
			if (cpf.value == "") {
				alert('Informe o CPF.');
				cpf.focus();
				resultado = false;
			} else if (!ValidaCPF(cpf)) {
				resultado = false;
			}
			return resultado;
		}
	</script>

</head>

<body>
	<form id='frmrecupera_senha' name='frmrecupera_senha' action='administracao/inscrito/recuperar.php' method='post' onsubmit='return validar()' >
		<p><strong>Recuperar Senha</strong></p>
		<?php if (isset($_SESSION['flashMensagem']) && $_SESSION['flashMensagem'] != null) :?>
			<p class="textoDestaque"><?php echo $_SESSION['flashMensagem']?></p>
		<?php
			unset($_SESSION['flashMensagem']);
		endif;
		?>
		<label for="cpf">CPF:</label>
		<input name="cpf" id="cpf" type="text" tabindex=1 size="15" maxlength="11" alt="RG" onKeyPress="javascript:return Onlynumber(event);" />
		<input name="Entrar" type="submit" id="Enviar" tabindex=3 value="Enviar" />
		<p>Informe o CPF e clique no bot&atilde;o "Enviar".</p>
	</form>
</body>
</html>