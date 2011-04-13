<?
  include("../classes/DB.php");
  include("../classes/Localprova.php");

  /* Acesso ao banco de dados */
  $banco   = DB::getInstance();
  $conexao = $banco->ConectarDB();

  $localprova = new Localprova(null,null);
  $vetorlocalprova = $localprova->SelectByAll($conexao);

  /* Varaveis auxiliares */
  $i =0;
  $total = count($vetorlocalprova);
  echo("<form id='excluirlocal' name='excluirlocal' action='' method='post'>");
  echo('<body>');
  echo('  <table width="76%" border="1">');
  echo('  <tr>');
  echo('    <td width="50%"><strong>Local de Prova</strong></td>');
  echo('    <td width="35%"><strong>Excluir</strong></td>');
  echo('  </tr>');
  


  while ($total > $i) {

	  $nome   = $vetorlocalprova[$i]->getnome();
          $id     = $vetorlocalprova[$i]->getcodlocalprova();
      $i= $i + 1;

      echo('  <tr>');
      echo('       <td>' . $nome. '</td>');
      echo("       <td><a href='#' onclick='excluir(".$id.")'>Excluir</a></td>");
      echo('  </tr>');
  }

  echo('  </table>');
  echo('  </body>');

?>

<script>
    function excluir(id){

        document.forms["excluirlocal"].action = "excluir_localprova.php?id="+id;
        document.forms["excluirlocal"].submit();

    }
</script>

