<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//PT-BR" >
<HTML lang="pt-br">
<HEAD>
<title> Ficha de Inscri&ccedil;&atilde;o </title>
</head>

<?php
  $rg       = addslashes($_POST['rg']);
  header('Content-type: application/vnd.ms-excel');
  header('Content-type: application/force-download');
  header('Content-Disposition: attachment; filename=ficha_'.$rg.'.xls');
  header('Pragma: no-cache');

  include("../classes/DB.php");
  include("../classes/Inscrito.php");
  include("../classes/Inscrito_Curso.php");

  


  /* Acesso ao banco de dados */
  $banco   = DB::getInstance();
  $conexao = $banco->ConectarDB();

  $inscrito    = new Inscrito(null,null,null,null,null,null,null,null,null,null,null,null,null);
  $objinscrito = $inscrito->SelectByRg($conexao, $rg);
  
    if (count($objinscrito)==0){
    echo("<table width='90%' border='0'>");
    echo("  <tr>");
    echo("    <td height='280'><div align='center'><font size='6'>Inscri&ccedil;&atilde;o n&atilde;o encontrada na base de dados.</font><font size='6'></font></div></td>");
    echo("  </tr>");
    echo("</table>");
  }
  else{
?>

<body>
<div align='center'><H2>Ficha de Inscri&ccedil;&atilde;o</H2></div>
<form id='formfichainscricao' name='formfichainscricao' action='' method='post' onsubmit='' >
<table border='0' align='left'>
<tr>
	<td colspan='3'></td>
</tr>

<tr>
    <TD align='left'>
            Nome:
        </TD>
       <td align='left'>
           <?echo($objinscrito[0]->getNome()); ?>
	</td>
</tr>

<tr>
	<TD align='left'>Endere&ccedil;o:
        </TD>
	<td colspan='2' align='left'>
            <? echo($objinscrito[0]->getEndereco());?>
        </td>
</tr>

<tr>
	<TD align='left'>
            Bairro:
        </TD>
	<td>
            <?echo($objinscrito[0]->getBairro());?>
    </td>
    <td>
        CEP:
    </td>
    <td>
        <?echo($objinscrito[0]->getCEP());?>
    </td>
</tr>

<tr>
	<TD align='left'>
            Cidade:
        </TD>
	<td>
            <?echo($objinscrito[0]->getCidade());?>
        </td>
        <td>
            Estado:
        </td>
        <td>
            <?echo($objinscrito[0]->getEstado());?>
        </td>
    
	 
</tr>

<tr>
	<TD align='left'>
            E-mail:
        </TD>
	<td>
            <?echo($objinscrito[0]->getEmail());?>
        </td>
</tr>

<tr>
    <TD align='left'>
        Telefone:
    </TD>
	<td>
            <?echo($objinscrito[0]->getTelefone());?>
        </td>
</tr>

<tr>
	<TD align='left'>
            Celular:
        </TD>
	<td>
            <?echo($objinscrito[0]->getCelular());?>
        </td>
</tr>

<tr>
	<TD align='left'>
            CPF:
        </TD>
	<td>
            <?echo($objinscrito[0]->getCPF());?>
        </td>
</tr>

<tr>
	<TD align='left'>
            RG:
        </TD>
	<td align='left'>
            <?echo($objinscrito[0]->getRG());?>
        </td>
</tr>

<tr>
	<TD height="27" align='left'>
            Local da Prova:
        </TD>
	<td>
            <?
                include("../classes/Localprova.php");


                $localprova      = new Localprova(null, null);
                $vetorlocaprova = $localprova->SelectByPrimaryKey($conexao,$objinscrito[0]->getlocalprova());
                echo($vetorlocaprova[0]->getnome());
            ?>
            
        </td>
</tr>
<tr>
	<TD height="27" align='left'>
            Necessidade Especial:
        </TD>
	<td>
            <?echo($objinscrito[0]->getespecial());?>
        </td>
</tr>


<tr>
  <TD align='left'><LABEL for=curso>Curso Selecionado:</LABEL>
  </TD>
  	<td colspan='2'>
    
    <?

    $inscrito_curso       = new Inscrito_Curso(null,null,null);
    $vetor_inscrito_curso = $inscrito_curso->ListarCurso($conexao, $objinscrito[0]->getid());

    /* Varaveis auxiliares */
    $i =0;
    $total = count($vetor_inscrito_curso);

    while ($total > $i) {

      $nome    = $vetor_inscrito_curso[$i]->getnome();
      
      echo($nome);
      

      $i= $i + 1;
    }
    $banco->DesconectarDB($conexao);
   ?>

</td>
</tr>
<br>
<tr><td></td></td> </tr>
<br>
<?}?>

</table>
</form>

</body>
</html>
