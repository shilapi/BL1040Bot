<?php

class Horse{
	private $distance;
	private $maxDistance;
	private $dead;
	private $nb;
//	private const normalHorse = "[CQ:emoji,id=128052]";
//	private const nbHorse = "🦄"; //[CQ:emoji,id=129412]
	private const deadHorse = "[CQ:emoji,id=128128]";
	private $normalHorse;
	private $nbHorse;

	function __construct($n = 10, $m = 13, $h = "[CQ:emoji,id=128052]", $nh = "🦄"){
		$this->maxDistance = $m;
		$this->distance = $n;
		$this->dead = false;
		$this->normalHorse = $h;
		$this->nbHorse = $nh;
	}
	private function str_suffix($str, $n=1, $char=" "){
		for ($x=0;$x<$n;$x++){$str = $str.$char;}
		return $str;
	}
	public function display(){
		$str = $this->str_suffix("", $this->distance);
		if($this->dead)
			$str .= self::deadHorse;
		else if($this->nb)
			$str .= $this->nbHorse;
		else
			$str .= $this->normalHorse;
		$str = $this->str_suffix($str, $this->maxDistance - $this->distance);
		return $str."\n";
	}
	public function goAhead($n){
		$this->distance -= $n;
		if($this->distance < 0)
			$this->distance = 0;
		return;
	}
	public function goBack($n){
		$this->distance += $n;
		if($this->distance > $this->maxDistance)
			$this->distance = $this->maxDistance;
		return;
	}
	public function kill(){
		$this->dead = true;
		return;
	}
	public function makeAlive(){
		$this->dead = false;
		return;
	}
	public function nbIfy(){
		$this->nb = true;
		return;
	}
	public function sbIfy(){
		$this->nb = false;
		return;
	}
	public function isNb(){
		return $this->nb;
	}
	public function isDead(){
		return $this->dead;
	}
	public function isWin(){
		return !$this->distance;
	}
}

?>
