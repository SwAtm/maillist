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

	public function get_sub_series($mop)
	//called by receipts/radd
	{
	$sql=$this->db->select('sub_series');
	$sql=$this->db->from('pmode');
	$sql=$this->db->where('name',$mop);
	$sql=$this->db->get();
	return $sql->row();
	
	}


}
?>
	
