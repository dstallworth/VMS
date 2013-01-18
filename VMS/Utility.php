<?php

class Utility {
	
	public function formatDate($dateandtime) {
		$thisDate = explode(" ",$dateandtime);
		$datepart = $thisDate[0];
		$dateOnly = explode("-",$datepart);
		return $dateOnly[1]."/".$dateOnly[2]."/".$dateOnly[0];
	}	
	
	public function formatDBDate($delimiter, $datepart) {		
		$dateOnly = explode($delimiter,$datepart);
		return $dateOnly[0]."-".$dateOnly[1]."-".$dateOnly[2];
	}
	
	public function dbFormat($value) {
		$newValue = str_replace("`","'",$value);
		$newValue = str_replace("'","''",$newValue);
		return $newValue;
	}
	
	public function limitStringLength($value, $length) {
		$newString = substr($value,0,$length);
		
		if ($length > strlen($value)) {
			return $newString;
		} else {
			return $newString."...";
		}
	}
}

?>
