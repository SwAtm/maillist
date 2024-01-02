<?php
class Daccount_model extends CI_Model{
	public function __construct()
		{		
		$this->load->database();
	}
	public function list_all()
	//called by receipts/radd, receipts/add_receipt_woid, receipts/add_receipt_wid_donor_notfound, receipts/add_receipt_wid_donor_found
{
	$sql=$this->db->select('*');
	$sql=$this->db->from('daccount');
	$sql=$this->db->order_by('name');
	$sql=$this->db->get();
	return $sql->result_array();
}
	public function get80G($daccount){
	//called by receipts/radd, receipts/add_receipt_wid_donor_notfound, receipts/add_receipt_wid_donor_found
	$sql=$this->db->select('G80');
	$sql=$this->db->from('daccount');
	$sql=$this->db->where('name',$daccount);
	$sql=$this->db->get();
	return $sql->row()->G80;
	
	}

}
?>
	
