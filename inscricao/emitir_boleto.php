<?php session_start();?>
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

		function validar() {
			var cpf = document.getElementById("cpf");
			resultado = true;
			if (cpf.value == "") {
				alert('Informe o CPF.');
				cpf.focus();
				resultado = false;
			}
			return resultado;
		}
	</script>

</head>

<body>
	<form id='frmrecupera_senha' name='frmrecupera_senha' action='administracao/boleto/boleto_bb.php' method='post' onsubmit='return validar()'>
		<p><strong>Emitir Boleto</strong></p>
		<?php if (isset($_SESSION['flashMensagem']) && $_SESSION['flashMensagem'] != null) :?>
			<p class="textoDestaque"><?php echo $_SESSION['flashMensagem']?></p>
		<?php
			unset($_SESSION['flashMensagem']);
		endif;
		?>
		<label for="cpf">CPF:</label>
		<input name="cpf" id="cpf" type="text" tabindex=1 size="15" maxlength="11" alt="CPF" onkeypress="javascript:return Onlynumber(event);" />
		<input name="Gerar" type="submit" id="Gerar" tabindex=2 value="Gerar" />
		<p>Informe o CPF e clique no bot&atilde;o "Gerar".</p>
	</form>
</body>
</html>
