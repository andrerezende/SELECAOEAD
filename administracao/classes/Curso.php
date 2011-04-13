<?php 

Class Curso {

    protected $cod_curso;
    protected $nome;
    protected $id_campus;

    public function Curso ($a, $b, $c){
       $this->cod_curso = $a;
       $this->nome      = $b;
       $this->id_campus = $c;
    }

    public function getcodcurso(){

        return $this->cod_curso;
    }

    public function setCodcurso($a){

        $this->cod_curso = $a;
    }

    public function getnome(){

        return $this->nome;
    }

    public function setnome($a){

        $this->nome = $a;
    }

    public function getIdCampus(){

        return $this->id_campus;
    }

    public function setIdCampus($a){

        $this->id_campus = $a;
    }


    public function Inserir ($sock){

        $ssql = "insert into curso (nome) values ";
        $ssql = $ssql. " ('".$this->nome."')";

        $rs = mysql_query($ssql, $sock);

        $linha = mysql_affected_rows();
        
        if ($linha >0){
           return true;
        }
        else{
           return false;
        }
    }
    public function apagar ($sock,$id){

        $ssql = "delete from curso";
        $ssql = $ssql. " WHERE cod_curso = ".$id;


        $rs = mysql_query($ssql, $sock);

        $linha = mysql_affected_rows();

        if ($linha >0){
           return true;
        }
        else{
           return false;
        }
    }


    public function existeCursoAssociadoAcandidato ($sock,$id){
        
        $ssql = "select * from inscrito_curso";
        $ssql = $ssql. " WHERE cod_curso = ".$id;


        $rs = mysql_query($ssql, $sock);
        

        $linha = mysql_affected_rows();
        
        if ($linha >0){
           return true;
        }
        else{
           return false;
        }
    }

    public function inativar ($sock,$id){

        $ssql = "update curso set";

        $ssql = $ssql. " ativo = 'N'";
        $ssql = $ssql. " WHERE cod_curso = ".$id;


        $rs = mysql_query($ssql, $sock);
         
        $linha = mysql_affected_rows();

        if ($linha >0){
           return true;
        }
        else{
           return false;
        }
    }

    public function SelectByAll($sock){

        $ssql = "SELECT cod_curso, nome, campus FROM curso A " ;
        $ssql = $ssql . " WHERE ativo is null";
        $ssql = $ssql . " ORDER BY nome ASC";
        $rs = mysql_query($ssql, $sock);

        $ar = array();

        while ($linha = mysql_fetch_row($rs)){
           $obj = new Curso($linha[0], $linha[1], $linha[2]);
	   $ar[] = $obj;
        }
        return ($ar);
    }
    
    public function SelectByPrimaryKey($sock,$codigo){

        $ssql = "SELECT cod_curso, nome FROM curso A " ;
   	    $ssql = $ssql . " WHERE cod_curso  =" .$codigo;
   	    $ssql = $ssql . " ORDER BY cod_curso ASC";

        $rs = mysql_query($ssql, $sock);

        unset($ar);

        while ($linha = mysql_fetch_row($rs)){
           $obj = new Curso($linha[0], $linha[1]);
	       $ar[] = $obj;
        }
        return ($ar);
    }
    
    public function SelectCursoPorCampus($sock, $codigo){

        $ssql = "SELECT cod_curso, nome, campus FROM curso A " ;
   	    $ssql = $ssql . " WHERE campus  =" .$codigo;
   	    $ssql = $ssql . " ORDER BY nome ASC";

        $rs = mysql_query($ssql, $sock);

        //unset($ar);
        $ar = array();

        while ($linha = mysql_fetch_row($rs)){
           $obj = new Curso($linha[0], $linha[1], $linha[2]);
	       $ar[] = $obj;
        }
        return ($ar);
    }

} 

?>
