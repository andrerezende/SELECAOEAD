<?php session_start("SELECAO"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title> <?php echo ($_SESSION["Gnomeprocessoseletivo"]);?> </title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="prototype.js"></script>
	<script language="javascript">

	function redireciona() {
		window.location="configuracao.php"; //redereciona para a página inicial.
	}
	</script>
</head>
<?php
if (!$_SESSION['validacao']) :
	header("Location:../login/login.php");
else :
?>
<body>
<div id="tudo" align="center">
	<div id="conteudoGeral">
		<div id="topo1">
        	<div class="topo1_imagem1"><img src="../../imgs/topo1/ministerio_educacao.jpg" alt="Ministï¿½rio de Educa&atilde;&ccedil;o" /></div>
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
				<div id="topo2Texto">
					<?php echo ($_SESSION["Gnomeprocessoseletivo"]);?>
				</div>				
		</div>	
		<div align="right" class="admin_logout"><p><a href="../login/logout.php" target="_self">Logout</a></p></div>
		<div class="config-conciliacao">
			<ul>
					<?php

							include_once ("../classes/DB.php");
							$banco = DB::getInstance();
							
							$conexao = $banco->ConectarDB();
							
							//$ini = parse_ini_file('config.ini',true);
							//$servidor = $ini['dbconfig']['server'];
							//$database = $ini['dbconfig']['database'];
							//$usuario = $ini['dbconfig']['user'];
							//$senha = $ini['dbconfig']['password'];
							//$error = "";
							//if (!($id = mysql_connect($servidor,$usuario,$senha))) {
							//	echo "Falha ao conectar no servidor.";
							//	exit;
							//} else {
							//	if (!($con= mysql_select_db($database,$id))) {
							//		echo "Falha ao conectar na Base de dados";
							//		exit;
							//	}
							//}
							
							$file_lines = file($_POST['caminho']);
							$arqRetorno = $_POST['nome'];
							
							$tamanho = sizeof($file_lines);
							$posicao = 1;
							
							for ($i= 2 ; $i < $tamanho -2; $i++) {
								if ($posicao == 1) {
									$id_inscrito = "";
									for ($j = 46; $j < 54; $j++) {
										$id_inscrito .= $file_lines[$i]{$j};
									}
									$posicao++;
								} else if ($posicao = 2) {
									$data_pagamento = "";
									$diaPagamento   = $file_lines[$i][137] . $file_lines[$i][138];
									$mesPagamaento  = $file_lines[$i][139] . $file_lines[$i][140]."-";
									$anoPagamento   = $file_lines[$i][141] . $file_lines[$i][142] . $file_lines[$i][143] . $file_lines[$i][144] . "-";
							
									for ($k = 137; $k < 145; $k++) {
										$data_pagamento .= $file_lines[$i]{$k};
										if ($k == 138 || $k == 140) {
											$data_pagamento .= "/";
										}
									}
									
									$data_arquivo = "";
									$diaArquivo = $file_lines[$i][145] . $file_lines[$i][146];
									$mesArquivo = $file_lines[$i][147] . $file_lines[$i][148] . "-";
									$anoArquivo = $file_lines[$i][149] . $file_lines[$i][150] .$file_lines[$i][151] . $file_lines[$i][152] . "-";
							
									for ($l = 145 ; $l < 154; $l++) {
										$data_arquivo .= $file_lines[$i]{$l};
										if ($l == 146 || $l == 148) {
											$data_arquivo .= "/";
										}
									}
									
									$data_pagamento = $anoPagamento . $mesPagamaento . $diaPagamento;
									$data_arquivo = $anoArquivo . $mesArquivo . $diaArquivo;
							
									$sql = "insert into pagamentos(id_inscrito,arqretorno,datapagamento,dataretorno,dataimportacao) values('" . $id_inscrito . "','" . $arqRetorno . "','" . $data_pagamento . "','" . $data_arquivo . "',curdate());";
							
									$res = mysql_query($sql,$conexao);
									if (!$res) {
										$count++;
										$error .= $id_inscrito ."   Erro : " . mysql_error($conexao) . "<br>";
									}
									$posicao = 1;

								}
							}
							if ($error == "") {
								echo "Arquivo importado com sucesso.<br>";
							} else {
								echo "Os Seguintes Registros nao foram importados : <br><br>" . $error;
								echo "Total de Registros Nao Importados : " . $count;
							}						
				?>

			</ul>
		</div>
		<div class="voltar"><form><input type="button" value=" Voltar " onclick="redireciona()" /></form></div>
	</div>
</div>
</body>
</html>
<?php endif;?>