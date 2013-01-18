<?php
//require("Common.php");

class VideoFormat {

	var $id;
	var $format_extension;
	var $format_description;
	
	public function getID() {
		return $this->id;
	}
	
	public function setID($id) {
		$this->id = $id;
	}
	
	public function getFormatExtension() {
		return $this->format_extension;
	}
	
	public function setFormatExtension($ext) {
		$this->format_extension = $ext;		
	}
	
	public function getFormatDescription() {
		return $this->format_description;
	}
	
	public function setFormatDescription($desc) {
		$this->format_description = $desc;		
	}
	
	public function load($row) {
		$this->id = $row['id'];
		$this->format_extension = $row['format_extension'];
		$this->format_description = $row['format_description'];
	}
}
?>

