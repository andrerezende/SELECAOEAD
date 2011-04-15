<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Concurso P&uacute;blico para Discente - 2011.2</title>
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
		var pwd = document.getElementById("pwd");

		resultado = true;
		if (cpf.value == "") {
			alert('Informe o CPF.');
			cpf.focus();
			resultado = false;
		} else if (pwd.value == "") {
			alert('Informe a Senha.');
			pwd.focus();
			resultado = false;
		}
		return resultado;
	}
	</script>

</head>

<body>
	<form id='frminscricao' name='frminscricao' action='administracao/inscrito/mostrar.php' method='post' onsubmit='return validar()' >
		<p><strong>Alterar ou Imprimir o Requerimento de Inscri&ccedil;&atilde;o</strong></p>
		<?php if (isset($_SESSION['flashMensagem']) && $_SESSION['flashMensagem'] != null) :?>
			<p class="textoDestaque"><?php echo $_SESSION['flashMensagem']?></p>
		<?php
			unset($_SESSION['flashMensagem']);
		endif;
		?>
		<label for="cpf">CPF:</label>
		<input name="cpf" id="cpf" type="text" tabindex=1 size="15" maxlength="11" alt="RG" onkeypress="javascript:return Onlynumber(event);" />
		<label for="senha">Senha:</label>
		<input name="pwd" id="pwd" type="password" tabindex=2 size="15" maxlength="15" alt="senha" />
		<input name="Entrar" type="submit" id="Entrar" tabindex=3 value="Acessar" />
		<p>Informe o CPF e a Senha e clique no bot&atilde;o "Acessar".</p>
	</form>
</body>
</html>