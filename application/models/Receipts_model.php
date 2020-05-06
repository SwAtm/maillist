<?php
class receipts_model extends CI_Model{
	public function __construct()
		{		
		$this->load->database();
	}
	public function get_details($id)
	//called by receipts/rprint
{
	$sql=$this->db->select('series, no, name, address, amount, date, purpose, mode_payment, pmt_details, pan');
	$sql=$this->db->from('receipts');
	$sql=$this->db->where('id',"$id");
	$sql=$this->db->get();
	return $sql->row_array();
	
}



	public function get_max_no()
	//called by receipts/radd1
	{
	$sql=$this->db->select_max('no');
	//$sql=$this->db->from('receipts');
	$sql=$this->db->get('receipts');
	return $sql->row_array();
	
	}
	
	
	public function adddata($data)
	//called by receipts/radd1
	{
	if($this->db->insert('receipts', $data)):
	return true;
	else:
	return false;
	endif;
	}



	public function getmaxid()
	//called by receipts/radd1
	{
	$sql=$this->db->select_max('id');
	$sql=$this->db->get('receipts');
	return $sql->row_array();
	}
	
}
?>
