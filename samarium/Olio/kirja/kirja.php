<?php

class Kirja {
	private $nimi;
	private $tekija;
    private $hinta;

	public function palauta_nimi() {
		return $this->nimi;
	}

	public function palauta_tekija() {
		return $this->tekija;
	}

	public function palauta_hinta() {
		return $this->hinta;
	}

    public function palauta_alennettu_hinta() {
		return $this->hinta - $this->hinta * 0.1;
	}
	
	public function __construct($nimi, $tekija, $hinta)
	{
		$this->nimi=$nimi;
		$this->tekija=$tekija;
        $this->hinta=$hinta;
    }
}

?>