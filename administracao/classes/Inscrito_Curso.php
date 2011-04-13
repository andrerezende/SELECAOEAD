<?php

Class Inscrito_Curso {

    protected $cod_curso;
    protected $nome;
    protected $id_inscrito;

    public function Inscrito_curso ($a, $b, $c){

       $this->cod_curso = $a;
       $this->nome      = $b;
       $this->id_inscrito  = $c;
    }

    public function getcodcurso(){

        return $this->cod_curso;
    }

    public function setcodcurso($a){

        $this->cod_curso = $a;
    }

    public function getidinscrito(){

        return $this->id_inscrito;
    }

    public function setidinscrito($a) {

        $this->id_inscrito = $a;
    }

    public function setnome($a){

        $this->nome = $a;
    }

    public function getnome(){

        return $this->nome;
    }

    public function Inserir ($sock, $pcod_curso){

         //$i =0;
         //$total = count($vetor_inscrito_curso);
         //armazenando no objeto
         //while ($total > $i) {

             $ssql = "insert into inscrito_curso (cod_curso, id_inscrito) values ";
             $ssql = $ssql. " (".$pcod_curso.",". $this->id_inscrito.")";

             $rs = mysql_query($ssql, $sock);

             $linha = mysql_affected_rows();

             if ($linha >0){
                $resultado = true;
             }
             else{
                $resultado = false;
             }

             //$i= $i + 1;
         //}

         return $resultado;
    }
    public function atualizar ($sock, $pcod_curso){

         //$i =0;
         //$total = count($vetor_inscrito_curso);
         //armazenando no objeto
         //while ($total > $i) {

             $ssql = "update inscrito_curso set cod_curso = ";
             $ssql = $ssql. "".$pcod_curso." WHERE id_inscrito = ". $this->id_inscrito;

             $rs = mysql_query($ssql, $sock);

             $linha = mysql_affected_rows();

             if ($linha >0){
                $resultado = true;
             }
             else{
                $resultado = false;
             }

             //$i= $i + 1;
         //}

         return $resultado;
    }

        public function apagar ($sock,$id){

        $ssql = "delete from inscrito_curso";
        $ssql = $ssql. " WHERE id_inscrito = ".$id;


        $rs = mysql_query($ssql, $sock);

        $linha = mysql_affected_rows();

        if ($linha >0){
           return true;
        }
        else{
           return false;
        }
    }

	public function ListarCurso($sock,$codigo) {

		$ssql = "SELECT A.cod_curso, B.nome, A.id_inscrito as inicio FROM inscrito_curso A, curso B " ;
		$ssql = $ssql . " WHERE A.cod_curso = B.cod_curso ";
		$ssql = $ssql . " AND A.id_inscrito  =" .$codigo;
		$ssql = $ssql . " ORDER BY nome ASC";

		$rs = mysql_query($ssql, $sock);
		echo(mysql_error());
		$ar = array();

		while ($linha = mysql_fetch_row($rs)){
			$obj = new Inscrito_Curso($linha[0], $linha[1], $linha[2]);
			$ar[] = $obj;
		}
		return ($ar);
	}

}

?>

