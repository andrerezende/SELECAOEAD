<?php
ob_start();
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Concurso p&uacute;blico para Docentes - 2011</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../../js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript">
	function validateCaptcha() {
		challengeField = $("input#recaptcha_challenge_field").val();
		responseField = $("input#recaptcha_response_field").val();
		// debug
		//console.log(challengeField);
		//console.log(responseField);
		//return false;
		var html = $.ajax({
			type: "POST",
			url: "validacao_ajax.php",
			data: "recaptcha_challenge_field=" + challengeField + "&recaptcha_response_field=" + responseField,
			async: false
		}).responseText;
		// debug
		//console.log( html );
		if (html == "success") {
			//Add the Action to the Form
			$("#formsenha").attr("action", "autenticacao.php");
			//Indicate a Successful Captcha
			$("#captchaStatus").html("Success!");
			// Uncomment the following line in your application
			return true;
		} else {
			Recaptcha.reload();
			$("#captchaStatus").html("O código de segurança digitado não corresponde ao exibido. Por favor tente novamente.");
			return false;
		}
	}

	// tema recaptcha
	var RecaptchaOptions = {
		theme : 'clean'
	};

	// validaçã formulário
	function validar() {
		var usuario = document.getElementById("usuario");
		var senha = document.getElementById("senha");
		resultado = true;
		if (usuario.value == "") {
			alert('Informe o nome do usuário.');
			usuario.focus();
			resultado = false;
		} else if (senha.value == "") {
			alert('Informe a senha.');
			senha.focus();
			resultado = false;
		}
		if (resultado) {
			resultado = validateCaptcha();
		} else {
			Recaptcha.reload();
		}
		return resultado;
	}
</script>
</head>
<?php
if (isset($_SESSION['validacao']) && $_SESSION['validacao']) {
	header("Location:menu.php");
} else {
?>
<body>
<div id="tudo" align='center'>
<div id="conteudoGeral">
		<div id="topo1">
        	<div class="topo1_imagem1">
                    <img src="../../imgs/topo1/ministerio_educacao.jpg" alt="Ministério de Educação" />
            </div>
            <div id="topo1_destaqueGoveno">
            	<form action="">
 				    <select name="destaque_governo" id="destaque_governo" onchange="if( this.value != '0' )window.open(this.value);">
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
     	</div>
	<h2>Autentica&ccedil;&atilde;o</h2>
	<form id="formsenha" name="formsenha" method="post" onsubmit="return validar()" >
	<table width="220" border="0" align="center">
	<tr align="center">
		<td align="right"><label for=usuario>Usu&aacute;rio:</label></td>
		<td align="left"><input name="usuario" id="usuario" type="text" size='15' maxlength="15" alt="Usu&aacute;rio" /></td>
	</tr>
	<tr align="center">
		<td align="right"><label for=senha>Senha:</label></td>
		<td align="left"><input name="senha" id="senha" type="password" size='15' maxlength="15" alt="Senha" /></td>
	</tr>
	<tr>
		<td colspan="3">
			<?php
			require_once('../classes/recaptcha/recaptchalib.php');
			$publickey = "6LeToMESAAAAAIWRV-LetAxpYqMbDwrswSIiiExs"; // you got this from the signup page
			echo recaptcha_get_html($publickey);
			?>
		</td>
	</tr>
	<tr>
		<td colspan="3"><div id="captchaStatus" style="color:red;font-size:12px"></div></td>
	</tr>
	<tr><td height="41" colspan='3' align='center'><input name="Enviar" type="submit" id="Enviar" value="Enviar" />  &nbsp;&nbsp;</td>
	</tr>
	</table>
	</form>
</div>
</div>
</body>
</html>
<?}?>
