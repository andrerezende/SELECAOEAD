<?php session_start("SELECAO"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title> <?php echo ($_SESSION["Gnomeprocessoseletivo"]);?> </title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="estilo_selecao.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php
//ob_start();
session_start();
include("../classes/DB.php");
include("../classes/Inscrito.php");
include("../classes/Localprova.php");

$banco   = DB::getInstance();
$conexao = $banco->ConectarDB();

$inscrito = new Inscrito(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);//36 null
$local_prova = new Localprova(null, null, null);

if (isset($_POST['id']) && !empty($_POST['id'])) {
	$id = addslashes($_POST['id']);
	$objinscrito = $inscrito->SelectById($conexao, $id);
} else if(isset($_POST['cpf']) && !empty($_POST['cpf'])) {
	$cpf = addslashes($_POST['cpf']);
	$objinscrito = $inscrito->SelectByCpf($conexao, $cpf);
}

if (empty($objinscrito)) {
	$_SESSION['flashMensagem'] = 'CPF n&atilde;o encontrado na nossa base de dados.';
	header("Location:" . $_SERVER['HTTP_REFERER']);
	exit;
}
?>
<div class="voltar" style="margin-left: 30px; margin-top: 15px;">
	<a href="javascript:history.go(-1)">Voltar</a>
</div>
<?php
// +----------------------------------------------------------------------+
// | BoletoPhp - Versão Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo está disponível sob a Licença GPL disponível pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Você deve ter recebido uma cópia da GNU Public License junto com     |
// | esse pacote; se não, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colaborações de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de João Prado Maia e Pablo Martins F. Costa				        |
// | 														                                   			  |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +--------------------------------------------------------------------------------------------------------+
// | Equipe Coordenação Projeto BoletoPhp: <boletophp@boletophp.com.br>              		             				|
// | Desenvolvimento Boleto Banco do Brasil: Daniel William Schultz / Leandro Maniezo / Rogério Dias Pereira|
// +--------------------------------------------------------------------------------------------------------+


// ------------------------- DADOS DINÂMICOS DO SEU CLIENTE PARA A GERAÇÃO DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formulário c/ POST, GET ou de BD (MySql,Postgre,etc)	//

// DADOS DO BOLETO PARA O SEU CLIENTE
//Variav�is da session
$data_venc     = date('d/m/Y', $_SESSION["Gdatatermino"]); // Prazo de X dias OU informe data: "13/04/2006";
$valor_cobrado = $_SESSION["Gvalorboleto"];  // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$nome_selecao  = $_SESSION["Gnomeprocessoseletivo"];

$dias_de_prazo_para_pagamento = 1;
$taxa_boleto = 0.0;
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["nosso_numero"]       = $objinscrito[0]->getnuminscricao(); //getid();
$dadosboleto["numero_documento"]   = $objinscrito[0]->getnuminscricao(); //"27.030195.10";	// Num do pedido ou do documento
$dadosboleto["data_vencimento"]    = $data_venc;    // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"]     = date("d/m/Y"); // Data de emiss�o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"]       = $valor_boleto; // Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
//$dadosboleto["sacado"] = "Nome do seu Cliente";
$dadosboleto["sacado"] = $objinscrito[0]->getnome();
$dadosboleto["endereco1"] = $objinscrito[0]->getendereco()." - ".$objinscrito[0]->getbairro();
$dadosboleto["endereco2"] = $objinscrito[0]->getcidade()." - ".$objinscrito[0]->getestado()." - ".$objinscrito[0]->getcep();

// INFORMACOES PARA O CLIENTE
$local_prova = $local_prova->SelectByPrimaryKey($conexao, $objinscrito[0]->getlocalprova());
$dadosboleto["demonstrativo1"] = "Pagamento de Taxa de Inscri&ccedil;&atilde;o - " .$nome_selecao;
$dadosboleto["demonstrativo2"] = " CPF do Candidato: ".$objinscrito[0]->getcpf();
//$dadosboleto["demonstrativo3"] = " Local de prova: " . $local_prova[0]->getnome();
//$dadosboleto["demonstrativo2"] = "Taxa bancária - R$ ".number_format($taxa_boleto, 2, ',', '');
$dadosboleto["demonstrativo4"] = "N&uacute;mero de Inscri&ccedil;&atilde;o: ".$objinscrito[0]->getnuminscricao();

// INSTRUÇÕES PARA O CAIXA
$dadosboleto["instrucoes1"] = " - ";
$dadosboleto["instrucoes2"] = "- Sr. Caixa, favor n&atilde;o receber ap&oacute;s o vencimento";
$dadosboleto["instrucoes3"] = "";
$dadosboleto["instrucoes4"] = "";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "N";
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "RC";


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - BANCO DO BRASIL
$dadosboleto["agencia"] = "3832"; // Num da agencia, sem digito
$dadosboleto["conta"] = "333017"; 	// Num da conta, sem digito

// DADOS PERSONALIZADOS - BANCO DO BRASIL
$dadosboleto["convenio"] = "2203078";  // Num do convênio - REGRA: 6 ou 7 ou 8 dígitos
$dadosboleto["contrato"] = "18680937"; // Num do seu contrato
$dadosboleto["carteira"] = "18";
$dadosboleto["variacao_carteira"] = "-019";  // Variação da Carteira, com traço (opcional)

// TIPO DO BOLETO
$dadosboleto["formatacao_convenio"] = "7"; // REGRA: 8 p/ Convênio c/ 8 dígitos, 7 p/ Convênio c/ 7 dígitos, ou 6 se Convênio c/ 6 dígitos
$dadosboleto["formatacao_nosso_numero"] = "2"; // REGRA: Usado apenas p/ Convênio c/ 6 dígitos: informe 1 se for NossoNúmero de até 5 dígitos ou 2 para opção de até 17 dígitos

/*
#################################################
DESENVOLVIDO PARA CARTEIRA 18

- Carteira 18 com Convenio de 8 digitos
  Nosso número: pode ser até 9 dígitos

- Carteira 18 com Convenio de 7 digitos
  Nosso número: pode ser até 10 dígitos

- Carteira 18 com Convenio de 6 digitos
  Nosso número:
  de 1 a 99999 para opção de até 5 dígitos
  de 1 a 99999999999999999 para opção de até 17 dígitos

#################################################
*/

// SEUS DADOS
$dadosboleto["identificacao"] = "Instituto Federal Baiano";
$dadosboleto["cpf_cnpj"] = "10.724.903/0001-79";
$dadosboleto["endereco"] = "Rua do Rouxinol, 115 - Imbu&iacute; - CEP: 41.720-052";
$dadosboleto["cidade_uf"] = "Salvador / Bahia";
$dadosboleto["cedente"] = "Instituto Federal de Educa&ccedil;&atilde;o, Ci&ecirc;ncia e Tecnologia Baiano";

// N�O ALTERAR!
include("include/funcoes_bb.php");
include("include/layout_bb.php");
?>
</body>
</html>


