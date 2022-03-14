<?php

function hecele($s) {
	$dizi = [];
	$hece = "";
	for($i = mb_strlen($s,"UTF-8") - 1; $i >= 0; $i--) {
		$hece = mb_substr($s,$i,1,"UTF-8") . $hece;
		if(mb_substr($s,$i,1,"UTF-8") == "'" && $i > 0 && sesli(mb_substr($s,$i-1,1,"UTF-8")) == true && mb_strlen($hece,"UTF-8") > 2) {
			$dizi[]=$hece;
		} else if(mb_substr($s,$i,1,"UTF-8") == "'" && $i > 1 && sesli(mb_substr($s,$i-1,1,"UTF-8")) == false && sesli(mb_substr($s,$i+1,1,"UTF-8")) == true) {
			$dizi[]=$hece;
			$hece = "";
			$i--;
		} else {
			if($i == 0) {
				$dizi[]=$hece;
				$hece = "";
			} else {
				if(mb_strlen($hece,"UTF-8") == 1) {
					if($i > 0 && sesli(mb_substr($s,$i,1,"UTF-8")) == true && sesli(mb_substr($s,$i-1,1,"UTF-8")) == true) {
						$dizi[]=$hece;
						$hece = "";
					}
				}
				if(mb_strlen($hece,"UTF-8") == 2) {
					if($hece[0] == "r" && mb_substr($s,$i-1,1,"UTF-8") == "t" && sesli(mb_substr($s,$i-2,1,"UTF-8")) == false) {} else {
						if($i > 1 && mb_substr($s,$i-1,1,"UTF-8") != "'") {
							if(sesli(mb_substr($s,$i,1,"UTF-8")) == false && sesli(mb_substr($s,$i+1,1,"UTF-8")) == true) {
								$dizi[]=$hece;
								$hece = "";
							}
							if(sesli(mb_substr($s,$i,1,"UTF-8")) == true && sesli(mb_substr($s,$i-1,1,"UTF-8")) == true) {
								$dizi[]=$hece;
								$hece = "";
							}
						} else if(sesli(mb_substr($s,$i,1,"UTF-8")) == false && sesli(mb_substr($s,$i-1,1,"UTF-8")) == true && sesli(mb_substr($s,$i+1,1,"UTF-8")) == true) {
							$dizi[]=$hece;
							$hece = "";
						}
					}
				}
				if(mb_strlen($hece,"UTF-8") == 3) {
					if($i > 1) {
						if($hece[0] == "r" && mb_substr($s,$i-1,1,"UTF-8") == "t" && sesli(mb_substr($s,$i-2,1,"UTF-8")) == false) {} else {
							if(sesli(mb_substr($s,$i,1,"UTF-8")) == false && mb_substr($s,$i-1,1,"UTF-8") != "'") {
								$dizi[]=$hece;
								$hece = "";
							}
						}
					} else if(sesli(mb_substr($s,$i,1,"UTF-8")) == false && sesli(mb_substr($s,$i-1,1,"UTF-8")) == true) {
						$dizi[]=$hece;
						$hece = "";
					}
				}
				if(mb_strlen($hece,"UTF-8") == 4) {
					$dizi[]=$hece;
					$hece = "";
				}
			}
		}
	}
	return $dizi;
}

function sesli($harf) {
	$sesliharfler = "âîûaeıioöuüÂÎÛAEIİOÖUÜ";
	if(!mb_strpos($sesliharfler,$harf,0,"UTF-8")) {
		return false;
	} else {
		return true;
	}
}
$kelime="şampuanlık";
print_r(hecele($kelime));

echo "<br />";
echo "<br />";
echo "<br />";
echo $kelime;

?>
