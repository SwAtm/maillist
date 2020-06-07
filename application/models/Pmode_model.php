<?php
class Pmode_model extends CI_Model{
	public function __construct()
		{		
		$this->load->database();
	}
	public function list_all()
	//called by receipts/radd, receipts/monthly_report
{
	$sql=$this->db->select('*');
	$sql=$this->db->from('pmode');
	$sql=$this->db->get();
	return $sql->result_array();
}


}
?>
	
