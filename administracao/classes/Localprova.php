<?php
class Localprova {
	protected $id;
	protected $nome;
	protected $campus;

	public function Localprova($a, $b, $c) {
		$this->id        = $a;
		$this->nome      = $b;
		$this->campus    = $c;
	}

	public function getcodlocalprova() {
		return $this->id;
	}

	public function setCodlocalprova($a){
		$this->id = $a;
	}

	public function getnome(){
		return $this->nome;
	}

	public function setnome($a){
		$this->nome = $a;
	}

	public function getcampus(){
		return $this->campus;
	}

	public function setcampus($a){
		$this->campus = $a;
	}

	public function Inserir ($sock){
		$ssql = "insert into localprova (nome) values ";
		$ssql .= " ('".$this->nome."')";

		$rs = mysql_query($ssql, $sock);

		$linha = mysql_affected_rows();

		if ($linha >0) {
			return true;
		} else {
			return false;
		}
	}

	public function SelectByAll($sock){
		$ssql = "SELECT id, nome, campus FROM localprova A " ;
		$ssql .= " WHERE ativo is null";
		$ssql .= " ORDER BY nome ASC";
		$rs = mysql_query($ssql, $sock);

		$ar = array();

		while ($linha = mysql_fetch_row($rs)) {
			$obj = new Localprova($linha[0], $linha[1], $linha[2]);
			$ar[] = $obj;
		}
		return ($ar);
	}

	public function SelectLocalPorCampus($sock, $pcampus){
		$ssql = "SELECT id, nome, campus FROM localprova A " ;
		$ssql .= " WHERE ativo is null";
		$ssql .= " AND campus = '$pcampus' ";
		$ssql .= " ORDER BY nome ASC";
		$rs = mysql_query($ssql, $sock);

		$ar = array();

		while ($linha = mysql_fetch_row($rs)) {
			$obj = new Localprova($linha[0], $linha[1], $linha[2]);
			$ar[] = $obj;
		}
		return ($ar);
	}

	public function SelectByPrimaryKey($sock,$codigo){
		$ssql = "SELECT id, nome, campus FROM localprova A " ;
		$ssql .= " WHERE id  =" .$codigo;

		$rs = mysql_query($ssql, $sock);

		$ar = array();

		while ($linha = mysql_fetch_row($rs)) {
			$obj = new Localprova($linha[0], $linha[1], $linha[2]);
			$ar[] = $obj;
		}
		return ($ar);
	}

	public function apagar ($sock,$id){
		$ssql = "delete from localprova";
        $ssql .= " WHERE id = ".$id;

		$rs = mysql_query($ssql, $sock);

		$linha = mysql_affected_rows();

		if ($linha >0) {
			return true;
		} else {
			return false;
		}
	}

	public function existeLocalAssociadoAcandidato ($sock,$id){
		$ssql = "select * from inscrito";
		$ssql .= " WHERE localprova = ".$id;

		$rs = mysql_query($ssql, $sock);

		$linha = mysql_affected_rows();

		if ($linha >0) {
			return true;
        } else {
			return false;
		}
	}

	public function inativar ($sock,$id){
		$ssql = "update localprova set";
		$ssql .= " ativo = 'N'";
		$ssql .= " WHERE id = ".$id;

		$rs = mysql_query($ssql, $sock);

		$linha = mysql_affected_rows();

		if ($linha >0) {
			return true;
        } else {
			return false;
		}
	}

	public function SelectNomeLocalProva($sock, $pidLocalprova) {
		$ssql = "SELECT id, nome, campus FROM localprova A " ;
		$ssql .= " WHERE id = '$pidLocalprova' ";

		$rs = mysql_query($ssql, $sock);

		$ar = array();

		$linha = mysql_fetch_row($rs);
		$obj = new Localprova($linha[0], $linha[1], $linha[2]);
		$ar[] = $obj;
		return $ar;
	}
}