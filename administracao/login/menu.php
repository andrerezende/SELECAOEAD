<?php
ob_start();
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Concurso P&uacute;blico para Discente - 2011.2</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
<?php
if (!$_SESSION['validacao']) :
    header("Location: login.php");
else :
?>
</head>
<body>
<div id="tudo" align='center'>
<div id="conteudoGeral">
		<div id="topo1">
        	<div class="topo1_imagem1">
                    <img src="../../imgs/topo1/ministerio_educacao.jpg" alt="Minist&eacute;rio de Educa&ccedil;&atilde;o" />
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
		<p><a href="logout.php" target="_self">Logout</a> </p>
	</div>
	<div align="center"><h2>&Aacute;rea Administrativa - Menu</h2></div>
	<?php if (isset($_SESSION['flashMensagem']) && $_SESSION['flashMensagem'] != null) :?>
		<p class="textoDestaque2"><?php echo $_SESSION['flashMensagem']?></p>
	<?php
		unset($_SESSION['flashMensagem']);
	endif;
	?>
	<ul class="menu_admin">
		<li><a href="../curso/cadastrar_curso.php">Cadastrar Curso</a></li>
		<li><a href="../curso/listar_curso.php" target="_self">Listar Curso</a></li>
		<li><a href="../inscrito/cadastro.php">Cadastrar Inscrito</a></li>
		<li><a href="../inscrito/listar_inscrito.php" target="_self">Listar Inscrito</a></li>
		<li><a href="../relatorio/relatorios.php" target="_self">Relat&oacute;rios</a></li>
		<li><a href="../conciliacao/configuracao.php" target="_self">Concilia&ccedil;&atilde;o</a></li>
	</ul>
</div></div>
</body>
</html>
<?php endif;?>