<?php

class Boots extends CI_Controller
{
	public function __construct(){
		parent :: __construct();
		$this->load->helper(array('form','url'));
	}
public function getBoots()
{
$this->load->view('samplebootstrap');
}

}

?>