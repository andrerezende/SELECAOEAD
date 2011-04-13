<?php

class Campus {

    protected $idCampus;
    protected $nome;

    public function Campus ($pidCampus, $pnome){
       $this->idCampus  = $pidCampus;
       $this->nome      = $pnome;
    }

    public function getIdCampus(){

        return $this->idCampus;
    }

    public function setIdCampus($pidcampus){

        $this->idCampus = $pidcampus;
    }

    public function getNome(){

        return $this->nome;
    }

    public function setNome($pnome){

        $this->nome = $pnome;
    }

    public function SelectByAll($sock){

        $ssql = "SELECT id, nome FROM campus A " ;
        $ssql = $ssql . " WHERE ativo is null";
        $ssql = $ssql . " ORDER BY nome ASC";
        $rs = mysql_query($ssql, $sock);

        $ar = array();

        while ($linha = mysql_fetch_row($rs)){
           $obj = new Campus($linha[0], $linha[1]);
	       $ar[] = $obj;
        }
        return ($ar);
    }

    public function SelectNomeCampus($sock, $pidCampus) {
        $ssql = "SELECT id, nome FROM campus A " ;
        $ssql = $ssql . " WHERE id = '$pidCampus' ";
        $rs = mysql_query($ssql, $sock);

        $ar = array();

        $linha = mysql_fetch_row($rs);
        $obj = new Campus($linha[0], $linha[1]);
        $ar[] = $obj;

        return $ar;
    }

      
    
}
?>
