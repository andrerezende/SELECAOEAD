<?php
  session_start();
  include("../classes/DB.php");
  include("../classes/Inscrito.php");
  
  if (!$_SESSION['validacao']) :
	header("Location: ../login/login.php");
  else :
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Concurso p&uacute;blico para Docentes - 2011</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href="../../estilo_selecao.css" rel="stylesheet" type="text/css" />
</head>
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
	<div align="right" class="admin_logout">
		<p><a href="logout.php" target="_self">Logout</a> </p>
	</div>
	<div align='center'>
		<h2>Área Administrativa - Inscritos</h2>
	</div>
<?php
  /* Acesso ao banco de dados */
  $banco   = DB::getInstance();
  $conexao = $banco->ConectarDB();

  $inscrito      = new Inscrito(null,null,null,null,null,null,null,null,null,null,null,null,null);
  $vetorinscrito = $inscrito->SelectByAll($conexao);

  /* Varaveis auxiliares */
  $i =0;
  $total = count($vetorinscrito); 
  
  echo("<form id='frmexcluir' name='frmexcluir' action='' method='post'>");
  echo('<body>');
  echo('  <table width="100%" border="1">');
  echo('  <tr>');
  echo('    <td width="35%"><strong>Nome</strong></td>');
  echo('    <td width="35%"><strong>CPF</strong></td>');
  echo('    <td width="35%"><strong>RG</strong></td>');
  echo('    <td width="35%"><strong>Editar</strong></td>');
  echo('    <td width="35%"><strong>Excluir</strong></td>');
  echo('  </tr>');


  while ($total > $i) {

      $nome   = $vetorinscrito[$i]->getnome();
      $cpf    = $vetorinscrito[$i]->getcpf();
      $rg     = $vetorinscrito[$i]->getrg();
      $id     = $vetorinscrito[$i]->getid();
 
      if ($cpf == ""){
	  $cpf = 'N&atilde;o informado';
      }	   	 

      $i= $i + 1;

      echo('  <tr>');
      echo('       <td>'.$i.'-'. $nome. '</td>');
      echo('       <td>' . $cpf. '</td>');
      echo('       <td>' . $rg. '</td>');
      echo("       <td><a href='#' onclick='editar()'>Editar</a></td>");
      echo("       <td><a href='#' onclick='excluir(".$id.")'>Excluir</a></td>");
      echo('  </tr>');  
}

  echo('  </table>');
  echo('  </body>');
  echo("</form");
  
  echo(" <form id='frmeditar' name='frmeditar' action='editar.php' method='post'>");
  echo(" <input type='hidden' name='id' value=".$id.">");
  echo(" </form>"); 

?>
<script type="text/javascript">
    function excluir(id){
        document.forms["frmexcluir"].action = "excluir.php?id="+id;
        document.forms["frmexcluir"].submit();
    }
	function editar(){   
		document.forms["frmeditar"].submit();
    }
</script>
<br />
<div class="voltar">
<form>
	<input type="button" value=" Voltar " onclick="history.go(-1)" />
</form>
</div></div></div>
</body>
</html>
<?php endif;?>