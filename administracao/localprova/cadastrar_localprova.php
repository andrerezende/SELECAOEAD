<?php
  include("../classes/DB.php");
  include("../classes/Localprova.php");
    
  $nome    = addslashes($_POST['nome']);

  /* Acesso ao banco de dados */
  $banco   = DB::getInstance();
  $conexao = $banco->ConectarDB();

  $localprova = new Localprova(null,$nome);
  $resultado = $localprova->Inserir($conexao);

  if($resutado=true){
    echo("<table width='90%' border='0'>");
    echo("  <tr>");
    echo("    <td height='280'><div align='center'><font size='6'><a href='../login/menu.php'>Cadastro efetuado com sucesso</font><font size='6'></font></div></td>");
    echo("  </tr>");
    echo("</table>");
  }
  else{
    echo("<table width='90%' border='0'>");
    echo("  <tr>");
    echo("    <td height='280'><div align='center'><font size='6'><a href='../login/menu.php'>Problemas ao efetuar o cadastro</font><font size='6'></font></div></td>");
    echo("  </tr>");
    echo("</table>");
  }

  $banco->DesconectarDB($conexao);

?>

