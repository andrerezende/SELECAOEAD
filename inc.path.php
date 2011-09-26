<?php
session_start("SELECAO"); //sempre session_start antes de usar sessions

//Atribuição da página parametrizada respons�vel pelo cadastro do candidato 
$pagina_cadastro = $_SESSION["Gpaginacadastro"];

//Controle de término do processo seletivo
$data_incio   = $_SESSION["Gdatainicio"];
$data_fim     = $_SESSION["Gdatatermino"];
$data_atual   = strtotime(date("d/m/Y")); 

//var_DUMP($data_incio, $data_fim, $data_atual);
//exit;
?>


<?php session_start();

@$sc = $_REQUEST['sc'];
@$scTitulo;

if ($sc == "") {
	$scTitulo = "P&aacute;gina Inicial";
	$sc = "inicial/pagina_inicial.php";
} elseif ($sc == "Inicial") {
	$scTitulo = "P&aacute;gina Inicial";
	$sc = "inicial/pagina_inicial.php";
} elseif ($sc == "Inscricao") {

	$scTitulo = "Inscri&ccedil;&otilde;es";

	if ($data_fim >= $data_atual){
		$sc = "inscricao/inscricao_aberta.html";
	}else{
		$sc = "inscricao/inscricao_encerrada.html";
	}

} elseif ($sc == "Requerimento") {
	$scTitulo = "Requerimento de Inscri&ccedil;&atilde;o";
	$sc = "administracao/inscrito/<?php echo($pagina_cadastro)?>";
} elseif ($sc == "Alterar") {
	$scTitulo = "Alterar / Imprimir Inscri&ccedil;&atilde;o";
	$sc = "inscricao/alterar_inscricao.php";
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