<?php
session_start();
require_once '../classes/DB.php';
require_once '../classes/Inscrito.php';
require_once '../classes/swift-mailer/lib/swift_required.php';

$cpf = addslashes($_POST['cpf']);
/*Acesso ao banco de dados */
$banco = DB::getInstance();
$conexao  = $banco->ConectarDB();

$inscrito = new Inscrito(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);//36
$objinscrito = $inscrito->SelectByCpf($conexao, $cpf);
if (empty($objinscrito)) {
	$_SESSION['flashMensagem'] = 'CPF n&atilde;o encontrado na nossa base de dados.';
	header("Location:" . $_SERVER['HTTP_REFERER']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Processo Seletivo para Ingresso de Estudantes - 2011.2</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../../js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$(".mensagem").fadeIn(function() {
			setTimeout(function () {
				$(".mensagem").fadeOut("slow");
			}, 2000);
			setTimeout("location.href='../../index.php",3000);
		});
	});
	</script>
</head>

<body>
<?php
if (count($objinscrito) == 0) :
	echo("<table width='90%' border='0' class='mensagem'>");
	echo("  <tr>");
	echo("    <td height='280'><div align='center'><font size='5'>Inscri&ccedil;&atilde;o n&atilde;o encontrada na base de dados.</font><font size='5'></font></div></td>");
	echo("  </tr>");
	echo("</table>");
else :
	$emailInscrito = strtolower($objinscrito[0]->getemail());
	$nomeInscrito = $objinscrito[0]->getnome();
	$senhaInscrito = $objinscrito[0]->getsenha();
	$servidorSMTP = '';
	$usuarioSMTP = '';
	$senhaSMTP = '';
	$configSmtp = Swift_SmtpTransport::newInstance($servidorSMTP, 25)
		->setUsername($usuarioSMTP)
		->setPassword($senhaSMTP)
	;

	$mailer = Swift_Mailer::newInstance($configSmtp);

	$mensagem = Swift_Message::newInstance()
		->setSubject('Recupera Senha - Processo Seletivo')
		->setFrom(array('selecaodiscente2011@ifbaiano.edu.br' => 'IF Baiano - Processo Seletivo para Ingresso de Estudantes - 2011.2'))
		->setTo(array($emailInscrito => $nomeInscrito))
		->setBody(
			'<p>Candidato: ' .$nomeInscrito. '</p>' .
			''.
			'<p>Sua senha: <b>' .$senhaInscrito. '</b></p>',
		'text/html')
		->setSender('selecaodiscente2011@ifbaiano.edu.br')
		->setPriority(2)
	;

	$result = $mailer->send($mensagem);
	if ($result) {
		echo("<table width='90%' border='0' class='mensagem'>");
		echo("  <tr>");
		echo("    <td height='280'><div align='center'><font size='5'>A senha foi enviada ao seu email.</font></div></td>");
		echo("  </tr>");
		echo("</table>");
	} else {
		echo("<table width='90%' border='0' class='mensagem'>");
		echo("  <tr>");
		echo("    <td height='280'><div align='center'><font size='5'>Problemas ao enviar o email.</font></div></td>");
		echo("  </tr>");
		echo("</table>");
	}
endif;
?>
</body>
</html>
