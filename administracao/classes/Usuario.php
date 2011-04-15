<?php
class Usuario{
	protected $usuario;
	protected $senha;

	public function Usuario($a, $b){
		$this->usuario = $a;
		$this->senha = $b;
	}

	public function getUsuario() {
		return $this->usuario;
	}

	public function setUsuario($a) {
		$this->usuario = $a;
	}

	public function getSenha() {
		return $this->senha;
	}

	public function setSenha($a) {
		$this->senha = $a;
	}

	public function Autenticar($sock) {
		$ssql = "SELECT usuario, senha FROM usuario A " ;
		$ssql .= " WHERE usuario  ='" .$this->usuario ."'";
		$ssql .= " AND   senha    ='" .$this->senha ."'";

		$rs = mysql_query($ssql, $sock);

		unset($ar);

		while ($linha = mysql_fetch_row($rs)){
			$obj = new Usuario(null, null);
			$obj->setUsuario($linha[0]);
			$obj->setSenha($linha[1]);
			$ar[] = $obj;
		}

		if (count($ar)>0) {
			return (true);
		} else {
			return (false);
		}

	}
}