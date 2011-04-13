<?php

  $ini = parse_ini_file('config.ini',true);
  $servidor = $ini['dbconfig']['server'];
  $database = $ini['dbconfig']['database'];
  $usuario = $ini['dbconfig']['user'];
  $senha   = $ini['dbconfig']['password'];
  Header("Content-type:application/xml;charset=iso-8859-1"); 
  if(!($id = mysql_connect($servidor,$usuario,$senha))){
    echo "Falha ao conectar no servidor.";

  }else{
    if(!($con= mysql_select_db($database,$id))){
      echo "Falha ao conectar na Base de dados.";
    }else{
      
      echo "Conexao realizada com sucesso!";
    }
    
  }
 ?>