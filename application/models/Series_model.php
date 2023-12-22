<?php
class Series_model extends CI_Model{
	public function __construct()
		{		
		$this->load->database();
	}
	public function get_pmode_per_user($user){
	//called by receitps/radd, receipts/add_receipt_woid, receipts/add_receipt_wid_donor_notfound, receipts/add_receipt_wid_donor_found, receipts/monthly_report
	$sql=$this->db->select('*');
	$sql=$this->db->from('series');
	$sql=$this->db->where('user', $user);
	$sql=$this->db->get();
	return $sql->result_array();
	}
	
	public function get_series($mop, $user){
	//called by receitps/radd, receipts/add_receipt_woid, receipts/add_receipt_wid_donor_notfound, receipts/add_receipt_wid_donor_found
	$sql=$this->db->select('series');
	$sql=$this->db->from('series');
	$sql=$this->db->where('user', $user);
	$sql=$this->db->where('pmode', $mop);
	$sql=$this->db->get();
	return $sql->row()->series;
	
	}
}
?>	
	
