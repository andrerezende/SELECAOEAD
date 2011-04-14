<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Concurso P&uacute;blico para Docente - 2011</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="estilo_selecao.css" rel="stylesheet" type="text/css" />
</head>

<?php
header("Content-Type: text/html; charset=ISO-8859-1", true);

@$sc = $_REQUEST['sc'];
@$scTitulo;

if ($sc == "") {
	$scTitulo = "P&aacute;gina Inicial";
	$sc = "inicial/pagina_inicial.html";
} elseif ($sc == "Inicial") {
	$scTitulo = "P&aacute;gina Inicial";
	$sc = "inicial/pagina_inicial.html";

//	Para encerrar as inscrições, comente os "elsif" 01 - Inscrição, 02 - Alterar e 03 - Requerimento.
//	Depois renomear os arquivos /administracao/inscrito/cadastro.php e cadastrar_inscrito.php
//	para um nome "difícil" de deduzir. Ex: cadastro_98732832dfs877ds6ds87.php

// "elsif" 01 - Inscrição
} elseif ($sc == "Inscricao") {
	$scTitulo = "Inscri&ccedil;&otilde;es";
	$sc = "inscricao/inscricao_aberta.html";
// "elsif" 02 - Alterar
} elseif ($sc == "Alterar") {
	$scTitulo = "Alterar / Imprimir Inscri&ccedil;&atilde;o";
	$sc = "inscricao/alterar_inscricao.php";
// "elsif" 03 - Requerimento
} elseif ($sc == "Requerimento") {
	$scTitulo = "Requerimento de Inscri&ccedil;&atilde;o";
	$sc = "administracao/inscrito/cadastro.php";
} elseif ($sc == "Recuperar Senha") {
	$scTitulo = "Recuperar Senha";
	$sc = "inscricao/recuperar_senha.html";
} elseif ($sc == "Recuperar") {
	$scTitulo = "Recuperar Senha";
	$sc = "inscricao/recuperar_senha.php";
} elseif ($sc == "Boleto") {
	$scTitulo = "Emiss&atilde;o de Boleto";
	$sc = "inscricao/emitir_boleto.php";
}