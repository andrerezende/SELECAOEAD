<?php
ob_start();
session_start();
$ini = parse_ini_file('config.ini',true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Processo Seletivo para Cursos T&eacute;cnicos &agrave; Dist&acirc;ncia - 2011.2</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
       <script type="text/javascript" src="prototype.js"></script>

	<script language="javascript">
	function teste(){
		alert("teste");
	}
        function testarConexao() {

          new Ajax.Request("testar_conexao.php",
          {
            method:"get",

            onSuccess: function(transport) {
              var response = transport.responseText || "Nada Encontrado";
              alert(response);
            },
            onFailure: function(){ alert("Erro ao executar teste de conexao") }
          });

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
        	<div class="topo1_imagem1">
                    <img src="../../imgs/topo1/ministerio_educacao.jpg" alt="Minist�rio de Educa��o" />
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
	<div align="right" class="admin_logout">
		<p><a href="../login/logout.php" target="_self">Logout</a> </p>
	</div>
	<div class="config-conciliacao">
		<ul>
			<li>Servidor: <span class="descricao"><?php echo $ini['dbconfig']['server'];?></span></li>
			<li>Base de dados: <span class="descricao"><?php echo $ini['dbconfig']['database'];?></span></li>
			<li>Usuario: <span class="descricao"><?php echo $ini['dbconfig']['user'];?></span></li>
			<li>Convenio: <span class="descricao"><?php echo $ini['edital']['convenio'];?></span></li>
			<li>Numero do Edital: <span class="descricao"><?php echo $ini['edital']['numero'];?></span></li>
			<li>Ano do Edital: <span class="descricao"><?php echo $ini['edital']['ano'];?></span></li>
			<li><input type="button" value="Testar Conexao" onclick="testarConexao();"/></li>
			<li>
				<form method="post" action="recebe_upload.php" enctype="multipart/form-data">
					<label>Arquivo: </label>
					<input type="file" name="arquivo" />
					<input type="submit" value="Enviar" />
				</form>
			</li>
		</ul>
	</div>
	<div class="voltar">
	<form>
		<input type="button" value=" Voltar " onclick="history.go(-1)" />
	</form>
	</div>
</div>
</div>
</body>
</html>
<?php endif;?>
