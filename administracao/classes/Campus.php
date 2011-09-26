<?php
class Campus {
	protected $idCampus;
	protected $nome;

	public function Campus($pidCampus = null, $pnome = null) {
		$this->idCampus = $pidCampus;
		$this->nome = $pnome;
	}

	public function getIdCampus() {
		return $this->idCampus;
	}

	public function setIdCampus($pidcampus) {
		$this->idCampus = $pidcampus;
	}

	public function getNome() {
		return $this->nome;
	}

	public function setNome($pnome) {
		$this->nome = $pnome;
	}

	public function SelectByAll($sock) {
		$ssql = "SELECT id, nome FROM campus A " ;
		$ssql .= " WHERE ativo is null";
		$ssql .= " ORDER BY nome ASC";
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
		$ssql .= " WHERE id = $pidCampus";
		$rs = mysql_query($ssql, $sock);

		$linha = mysql_fetch_row($rs);
		return new Campus($linha[0], $linha[1]);
	}

	public function Inserir($sock) {
		$ssql = 'INSERT INTO campus (nome) VALUES ';
		$ssql .= " ('". $this->nome . "')";

		$rs = mysql_query($ssql, $sock);

		return $rs;
	}

	public function existeCandidatoAssociado($sock, $id) {
		$ssql = "SELECT * FROM inscrito";
		$ssql .= " WHERE curso = " . $id;

		$rs = mysql_query($ssql, $sock);

		$linha = mysql_affected_rows();

		if ($linha > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function inativar($sock, $id) {
		$ssql = "UPDATE campus SET";
		$ssql .= " ativo = 'N'";
		$ssql .= " WHERE id = ".$id;

		$rs = mysql_query($ssql, $sock);

		$linha = mysql_affected_rows();

		if ($linha > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function apagar($sock, $id) {
		$ssql = "DELETE FROM campus";
		$ssql .= " WHERE id = ".$id;

		$rs = mysql_query($ssql, $sock);

		$linha = mysql_affected_rows();

		if ($linha > 0) {
			return true;
		} else {
			return false;
		}
	}
}