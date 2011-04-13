<?php
  
        $ini = parse_ini_file('config.ini',true);
        $servidor = $ini['dbconfig']['server'];
        $database = $ini['dbconfig']['database'];
        $usuario = $ini['dbconfig']['user'];
        $senha   = $ini['dbconfig']['password'];
        $error="";
        if(!($id = mysql_connect($servidor,$usuario,$senha))){
         
         echo "Falha ao conectar no servidor.";
         exit;

        }else{
          if(!($con= mysql_select_db($database,$id))){

            echo "Falha ao conectar na Base de dados";
            exit;
          }                
        }
         

        $file_lines = file($_POST['caminho']);
        $arqRetorno = $_POST['nome'];
        
        $tamanho = sizeof($file_lines);
        $posicao = 1;

        for($i= 2 ; $i < $tamanho -2; $i++){
          
         
          if($posicao == 1){

            $id_inscrito= "";
            for($j= 47 ; $j <54; $j++){
              $id_inscrito .= $file_lines[$i]{$j};
            }

            $posicao++;
        
          }
          else if($posicao = 2){
            $data_pagamento ="";
            $diaPagamento= $file_lines[$i][137].$file_lines[$i][138];
            $mesPagamaento= $file_lines[$i][139].$file_lines[$i][140]."-";
            $anoPagamento= $file_lines[$i][141].$file_lines[$i][142]. $file_lines[$i][143].$file_lines[$i][144]."-";

            for($k = 137;$k<145 ; $k++){
              $data_pagamento .= $file_lines[$i]{$k};
              
              if($k==138 || $k ==140){
                $data_pagamento .="/";
              }
            }
            $data_arquivo="";
            $diaArquivo = $file_lines[$i][145] . $file_lines[$i][146];
            $mesArquivo = $file_lines[$i][147] . $file_lines[$i][148] . "-";
            $anoArquivo = $file_lines[$i][149] . $file_lines[$i][150]
              .$file_lines[$i][151] . $file_lines[$i][152] . "-";
             

            for($l = 145 ; $l<154; $l++){
              $data_arquivo .= $file_lines[$i]{$l};
              if($l == 146 || $l == 148){
                $data_arquivo .= "/";
              }
            }
            $data_pagamento = $anoPagamento . $mesPagamaento . $diaPagamento;
            $data_arquivo = $anoArquivo . $mesArquivo . $diaArquivo;

            $sql = "insert into pagamentos(id_iscrito,arqretorno,datapagamento,dataretorno,dataimportacao) values(".$id_inscrito .",'".$arqRetorno."','" .$data_pagamento . "','".$data_arquivo ."',curdate());";
            
            
            $res = @mysql_query($sql,$id);
            if(!$res){          
             $count++;
             $error .= $id_inscrito ."   Erro : " .mysql_error($id)."<br>";             
            }
            
            $posicao = 1;
          }
         
        }

        if($error == ""){

          echo "Arquivo importado com sucesso.<br>";
          echo "<a href='configuracao.php'>voltar</a>";

        }else{
          
          echo "Os Seguintes Registros nao foram importados : <br><br>" . $error;
          echo "Total de Registros Nao Importados : ".$count;
          echo "<br><br><a href='configuracao.php'>voltar</a>";

        }
	 
?>

