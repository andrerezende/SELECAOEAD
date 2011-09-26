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
		window.location="../login/menu.php"; //redereciona para a p�gina inicial.
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
        	<div class="topo1_imagem1"><img src="../../imgs/topo1/ministerio_educacao.jpg" alt="Minist�rio de Educa&atilde;&ccedil;o" /></div>
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
							ini_set('display_errors', 1);
							
							// $ini = parse_ini_file('config.ini',true);
							// Pasta onde o arquivo vai ser salvo
							// $_UP['pasta'] =  $ini['path']['caminho_upload'];
							
							// Pasta onde o arquivo vai ser salvo
							$_UP['pasta']   =  $_SESSION["Gcaminhoupload"];
							
							// Tamanho máximo do arquivo (em Bytes)
							$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
							
							// Array com as extensões permitidas
							$_UP['extensoes'] = array('ret');
							
							// Array com os tipos de erros de upload do PHP
							$_UP['erros'][0] = 'Não houve erro';
							$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
							$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
							$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
							$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
							
							// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
							if ($_FILES['arquivo']['error'] != 0) {
								die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
								exit; // Para a execução do script
							}

							// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
							// Faz a verificação da extensão do arquivo
							$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
							if (array_search($extensao, $_UP['extensoes']) === false) {
								echo "Por favor, envie arquivos com as seguintes extensões: .ret";
							} else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
								// Faz a verificação do tamanho do arquivo
								echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
							} else {
								//	 $nome_final = $_FILES['arquivo']['name'];
								// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
								$nome_final = $_FILES['arquivo']['name'];
								echo "Arquivo : ".$nome_final."<br><br>";
								if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
									$caminho_total = $_UP['pasta'] . "/" . $nome_final;
									$nome_final = $_FILES['arquivo']['name'];
									$file_lines = file($caminho_total);
									$tamanho = sizeof($file_lines);
									$posicao = 1;
									echo "<table>";
									echo "<th> Codigo do Inscrito</th>";
									echo "<th> Data de Pagamento</th>";
									echo "<th> Data do Arquivo de Retorno</th>";
									for ($i= 2 ; $i < $tamanho -2; $i++) {
										if ($posicao == 1) {
											$count++;
											echo "<tr>";
											$id_inscrito = "";
											for ($j= 47 ; $j <54; $j++) {
												$id_inscrito .= $file_lines[$i]{$j};
											}
											$posicao++;
											echo "<td>" . $id_inscrito . "</td>" ;
										} else if ($posicao = 2) {
											$data_pagamento ="";
											for ($k = 137;$k<145 ; $k++) {
												$data_pagamento .= $file_lines[$i]{$k};
											}
											$data_arquivo="";
											for ($l = 145 ; $l<154; $l++) {
												$data_arquivo .= $file_lines[$i]{$l};
											}
											echo "<td>" . $data_pagamento . "</td>";
											echo "<td>" . $data_arquivo . "</td>";
											echo "</tr>";
											$posicao = 1;
										}
									}
									echo "<tr><td>Total de Registros</td><td colspan='2'>".$count."</td></tr>";
									echo "</table><br><br>";
									echo "<form method='post' action='importar_arquivo.php'>
										<input type='hidden' name='caminho' value='" .$caminho_total."'/>
										<input type='hidden' name='nome' value='" .$nome_final."'/>
										<input type='submit' value='Importar' />
									</form>";
								} else {
									echo "Não foi possível enviar o arquivo, tente novamente";
								}
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