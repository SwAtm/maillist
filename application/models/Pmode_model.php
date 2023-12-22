<?php
class Pmode_model extends CI_Model{
	public function __construct()
		{		
		$this->load->database();
	}
	public function list_all()
	
{
	$sql=$this->db->select('*');
	$sql=$this->db->from('pmode');
	$sql=$this->db->get();
	return $sql->result_array();
}

	public function get_sub_series($mop)
	//
	{
	$sql=$this->db->select('sub_series');
	$sql=$this->db->from('pmode');
	$sql=$this->db->where('name',$mop);
	$sql=$this->db->get();
	return $sql->row();
	
	}
	
	public function get80G($pmode){
	//called by receipts/radd, receipts/add_receipt_wid_donor_notfound, receipts/add_receipt_wid_donor_found
	$sql=$this->db->select('G80');
	$sql=$this->db->from('pmode');
	$sql=$this->db->where('name',$pmode);
	$sql=$this->db->get();
	return $sql->row()->G80;
	
	}

}
?>
	
