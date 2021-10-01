<?php
class Daccount_model extends CI_Model{
	public function __construct()
		{		
		$this->load->database();
	}
	public function list_all()
	//called by receipts/radd
{
	$sql=$this->db->select('*');
	$sql=$this->db->from('daccount');
	$sql=$this->db->get();
	$result = $sql->result_array();
	if ($result):
	return $result;
	else:
	return false;
	endif;
	
}


}
?>
	
