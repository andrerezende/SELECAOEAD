<?php

class RelatorioInscrito {
     
     public function RelatorioInscrito(){
     
	 echo("entrou RelatorioInscrito4");
     }

     public function mostrarTodosAlunos($pconexao){
        
        $inscrito      = new Inscrito(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);//36 null
        $vetorinscrito = $inscrito->SelectByAll($pconexao);

        /* Varaveis auxiliares */
        $i =0;
        $contador=1;
	 $nomelocalprova="NDA";
        $total = count($vetorinscrito);

        echo("<table style='width: 100%'>");
        echo("<tr>");
        echo("<th colspan='4' style='text-align:left'>Todos Alunos</th>");
        echo("</tr>");
       
            while ($total > $i) {

              
		if (is_int($vetorinscrito[$i]->getlocalprova())){
              	/*Criado em virtude das linhas em branco*/
			$localProva      = new Localprova(null,null,null);
              	$vetorLocalProva = $localProva->SelectNomeLocalProva($pconexao, $vetorinscrito[$i]->getlocalprova());
			$nomelocalprova  = $vetorLocalProva[0]->getnome();
              }

              echo("<tr>");
              echo("<td><b>Nome </b>");
              echo("</td>");
              echo("<td>".($contador+$i)."-".$vetorinscrito[$i]->getnome()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Endereco </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getendereco()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Bairro </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getbairro()."</td>");
              echo("<td><b>CEP </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcep()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Cidade </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcidade()."</td>");
              echo("<td><b>Estado </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcidade()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Email </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getemail()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Telefone </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->gettelefone()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Celular </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcelular()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td ><b>RG </b>");
              echo("</td>");
              echo("<td style='text-align:left;'>".$vetorinscrito[$i]->getrg()."</td>");
              echo("<td><b>CPF </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcpf()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Local de Prova </b>");
              echo("</td>");
              echo("<td>".$nomelocalprova."</td>");
              echo("</tr>");

              $inscrito_curso       = new Inscrito_Curso(null,null,null);
              //$vetor_inscrito_curso = $inscrito_curso->ListarCurso($pconexao, $vetorinscrito[$i]->getid());
              //$curso                = $vetor_inscrito_curso[0]->getnome();

              echo("<tr>");
              echo("<td><b>Curso </b>");
              echo("</td>");
              echo("<td>".$curso."</td>");
              echo("</tr>");
              echo("<tr>");
              echo("<td colspan='4' bgcolor='#000000'>");
              echo("</td>");
             

              $i= $i + 1;
        }
        echo("<tr>");
        echo("<td colspan='3' align='center'>");
        echo("<td>");
        echo("<tr>");
        echo("</table>");
     }

      public function mostrarAlunosPorLocalidades($pconexao){


        $ssql = "SELECT id, nome FROM localprova A " ;
        $ssql = $ssql . " WHERE id in ( SELECT localprova FROM inscrito )";

        $rs = mysql_query($ssql, $pconexao);

        echo("<table style='width: 100%'>");
        echo("<tr>");
        echo("  <th colspan='4' style='text-align:left'>Alunos por Localidade</th>");
        echo("</tr>");

        while ($linha = mysql_fetch_row($rs)){

        echo("<tr>");
        echo("  <td colspan='4' style='text-align:left'><b><font color='#FF0000'>".$linha[1]."<fonte><b></th>");
        echo("</tr>");

        $inscrito      = new Inscrito(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);//34 null
        $vetorinscrito = $inscrito->SelectByLocalidade($pconexao,$linha[0]);

        $i =0;
        $contador=1;
        $total = count($vetorinscrito);

            while ($total > $i) {

             $localProva = new Localprova(null,null);
             $vetorLocalProva = $localProva->SelectByPrimaryKey($$pconexao, $vetorinscrito[$i]->getlocalprova());

              echo("<tr>");
              echo("<td><b>Nome </b>");
              echo("</td>");
              echo("<td>".($contador+$i)."-".$vetorinscrito[$i]->getnome()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Endereco </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getendereco()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Bairro </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getbairro()."</td>");
              echo("<td><b>CEP </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcep()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Cidade </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcidade()."</td>");
              echo("<td><b>Estado </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcidade()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Email </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getemail()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Telefone </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->gettelefone()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Celular </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcelular()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td ><b>RG </b>");
              echo("</td>");
              echo("<td style='text-align:left;'>".$vetorinscrito[$i]->getrg()."</td>");
              echo("<td><b>CPF </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcpf()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Local de Prova </b>");
              echo("</td>");
              echo("<td>".$vetorLocalProva[0]->getnome()."</td>");
              echo("</tr>");


              $inscrito_curso       = new Inscrito_Curso(null,null,null);
              $vetor_inscrito_curso = $inscrito_curso->ListarCurso($this->conexao, $vetorinscrito[$i]->getid());
              $curso    		 = $vetor_inscrito_curso[0]->getnome();

              echo("<tr>");
              echo("<td><b>Curso </b>");
              echo("</td>");
              echo("<td>".$curso."</td>");
              echo("</tr>");
              echo("<tr>");
              echo("<td colspan='4' bgcolor='#000000'>");
              echo("</td>");

                  $i= $i + 1;
            }
            echo("<tr>");
            echo("<td colspan='3'></td>");
            echo("</tr>");
        }
         echo("</table>");
      }

       public function mostrarAlunosPorCursos(){

        $ssql = "SELECT cod_curso, nome FROM curso C " ;
        $ssql = $ssql . " WHERE C.cod_curso in ( SELECT cod_curso FROM inscrito_curso )";
        //$ssql = $ssql . " order by nome ";

        $rs = mysql_query($ssql, $this->conexao);

        echo("<table style='width: 100%'>");
        echo("<tr>");
        echo("  <th colspan='4' style='text-align:left'>Alunos por Curso</th>");
        echo("</tr>");


        while ($linha = mysql_fetch_row($rs)){
       
        echo("<tr>");
        echo("  <td colspan='4' style='text-align:left'><b><font color='#FF0000'>".$linha[1]."</font></b></th>");
        echo("</tr>");

        $inscrito = new Inscrito(null,null,null,null,null,null, null,null,null,null,null,null,null, null);
        $vetorinscrito = $inscrito->SelectByCurso($this->conexao,$linha[0]);
        $i =0;
        $contador=1;
        $total = count($vetorinscrito);

            while ($total > $i) {


             $localProva = new Localprova(null,null);
             $vetorLocalProva = $localProva->SelectByPrimaryKey($this->conexao, $vetorinscrito[$i]->getlocalprova());

              echo("<tr>");
              echo("<td><b>Nome </b>");
              echo("</td>");
              echo("<td>".($contador+$i)."-".$vetorinscrito[$i]->getnome()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Endereco </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getendereco()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Bairro </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getbairro()."</td>");
              echo("<td><b>CEP </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcep()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Cidade </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcidade()."</td>");
              echo("<td><b>Estado </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcidade()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Email </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getemail()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Telefone </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->gettelefone()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Celular </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcelular()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td ><b>RG </b>");
              echo("</td>");
              echo("<td style='text-align:left;'>".$vetorinscrito[$i]->getrg()."</td>");
              echo("<td><b>CPF </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcpf()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Local de Prova </b>");
              echo("</td>");
              echo("<td>".$vetorLocalProva[0]->getnome()."</td>");
              echo("</tr>");


              $inscrito_curso       = new Inscrito_Curso(null,null,null);
              $vetor_inscrito_curso = $inscrito_curso->ListarCurso($this->conexao, $vetorinscrito[$i]->getid());
              $curso    = $vetor_inscrito_curso[0]->getnome();

              echo("<tr>");
              echo("<td><b>Curso </b>");
              echo("</td>");
              echo("<td>".$curso."</td>");
              echo("</tr>");
              echo("<tr>");
              echo("<td colspan='4' bgcolor='#000000'>");
              echo("</td>");

                  $i= $i + 1;
            }
            echo("<tr>");
            echo("<td colspan='3'></td>");
            echo("</tr>");
        }
        echo("</table>");


       }


	public function mostraralunosporlocalidadecurso(){

          $ssql = "select lp.id, lp.nome from localprova lp ";
          $ssql = $ssql . " where id in (select localprova from inscrito) "; 
          //$ssql = $ssql . " order by nome ";

	   $rs = mysql_query($ssql, $this->conexao);

	   echo("<table style='width: 100%'>");
          echo("<tr>");
          echo("  <th colspan='3' style='text-align:left'>alunos por localidade curso</th>");
          echo("</tr>");

        while ($linha = mysql_fetch_row($rs)){

          echo("<tr>");
          echo("  <td colspan='3'>");
          echo("<b><font color='#ff0000'>".$linha[1]."</font></b>");
          echo("  </td>");
          echo("</tr>");

          $ssql_2 = "select c.cod_curso,c.nome,trim(i.nome), i.rg from inscrito i " ;
          $ssql_2 = $ssql_2 . " join inscrito_curso ic on ic.id_inscrito = i.id ";
          $ssql_2 = $ssql_2 . " join curso c on c.cod_curso = ic.cod_curso ";
          $ssql_2 = $ssql_2 . " where i.localprova = ".$linha[0];
          $ssql_2 = $ssql_2 . " group by c.cod_curso,i.id ";
	   $ssql_2 = $ssql_2 . " order by c.cod_curso,trim(i.nome) asc ";
	   
 	   //echo($ssql_2); 	
	
          $rs_2 = mysql_query($ssql_2, $this->conexao);
          $curso = null;
	   /*contador de alunos */
          $contador=1;

          while ($linha_2 = mysql_fetch_row($rs_2)){
		
               if($curso != $linha_2[0]){
                   $totalalunos= 0;
                
                   $ssql_3 = "select count(*) from inscrito i " ;
                   $ssql_3 = $ssql_3 . " join inscrito_curso ic on ic.id_inscrito = i.id ";
                   $ssql_3 = $ssql_3 . " where i.localprova = ".$linha[0];
                   $ssql_3 = $ssql_3 . " and ic.cod_curso = ".$linha_2[0];
                   $rs_3 =mysql_query($ssql_3, $this->conexao);

                   while( $teste = mysql_fetch_row($rs_3)){
                        $totalalunos = $teste[0];
                   }
                    
                   echo("<tr>");
                   echo("   <td><b>");
                   echo($linha_2[1]);
                   echo("   </b></td>");
                   echo("   <td>");
                   echo("<b>total de alunos :</b>".$totalalunos);
                   echo("   </td>");
                   echo("</tr>");
                   $curso = $linha_2[0];

		     /*outro curso - zerar contador*/
	            $contador=1;
			
               }
               echo("<tr>");
               echo("   <td>".($contador)."-");
               echo($linha_2[2]);
               echo("  </td>");

               echo("   <td>");
               echo(" RG:".$linha_2[3]);
               echo("  </td>");

               echo("   <td>");
               echo("curso: ".$linha_2[1]);
               echo("   </td>");
               echo("</tr>");

		 /*incremento de alunos */
   	        $contador=$contador+1;

           }
           echo("<td colspan='3' bgcolor='#000000'>");
           echo("</td>");
        }
        echo("<tr>");
        echo("<td colspan='3' align='center'>");
        echo("<td>");
        echo("<tr>");
        echo("</table>");

      }


   public function mostrarAlunosPorNecessidade($necessidade){
         

       $inscrito = new Inscrito(null, null, null, null, null,null, null, null, null, null, null, null,null, null, null);
       $vetorinscrito = $inscrito->SelectByComNecessidade($this->conexao,$necessidade);

    
        /* Varaveis auxiliares */
        $i =0;
        $contador=1;
        $total = count($vetorinscrito);
        echo("<table style='width: 100%'>");
        echo("<tr>");
        echo("<th colspan='4' style='text-align:left'>Necessidade Especial :    ".$necessidade."</th>");
        echo("</tr>");


            while ($total > $i) {
             
             $localProva = new Localprova(null,null);
             $vetorLocalProva = $localProva->SelectByPrimaryKey($this->conexao, $vetorinscrito[$i]->getlocalprova());
            
              echo("<tr>");
              echo("<td><b>Nome </b>");
              echo("</td>");
              echo("<td>".($contador+$i)."-".$vetorinscrito[$i]->getnome()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Endereco </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getendereco()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Bairro </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getbairro()."</td>");
              echo("<td><b>CEP </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcep()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Cidade </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcidade()."</td>");
              echo("<td><b>Estado </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcidade()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Email </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getemail()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Telefone </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->gettelefone()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Celular </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcelular()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>RG </b>");
              echo("</td>");
              echo("<td align='left'>".$vetorinscrito[$i]->getrg()."</td>");
              echo("<td><b>CPF </b>");
              echo("</td>");
              echo("<td>".$vetorinscrito[$i]->getcpf()."</td>");
              echo("</tr>");

              echo("<tr>");
              echo("<td><b>Local de Prova </b>");
              echo("</td>");
              echo("<td>".$vetorLocalProva[0]->getnome()."</td>");
              echo("</tr>");


              $inscrito_curso       = new Inscrito_Curso(null,null,null);
              $vetor_inscrito_curso = $inscrito_curso->ListarCurso($this->conexao, $vetorinscrito[0]->getid());
              $curso    = $vetor_inscrito_curso[0]->getnome();
              echo("<tr>");
              echo("<td><b>Curso </b>");
              echo("</td>");
              echo("<td>".$curso."</td>");
              echo("</tr>");
              echo("<tr>");
              echo("<td colspan='4' bgcolor='#000000'>");
              echo("</td>");
              $i= $i + 1;
        }
        echo("<tr>");
        echo("<td colspan='3' align='center'>");
        echo("<td>");
        echo("<tr>");
        echo("</table>");
     }
   
}
?>
