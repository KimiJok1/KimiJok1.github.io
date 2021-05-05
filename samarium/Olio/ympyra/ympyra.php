<?php
class Ympyra {
	private $sade;
	private $jarjestysnumero;

	public function laske_pinta_ala() {
		$pa = 3.14 * $this->sade * $this->sade;
		return $pa;
	}

	public function laske_piiri() {
		$pa = 2 * 3.14 * $this->sade;
		return $pa;
	}

	public function palauta_nro() {
		return $this->jarjestysnumero;
	}
	
	public function __construct($sade, $jarjestysnumero)
	{
		$this->sade=$sade;
		$this->jarjestysnumero=$jarjestysnumero;}
	}

?>