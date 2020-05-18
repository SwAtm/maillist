<?php
class receipts_model extends CI_Model{
	public function __construct()
		{		
		$this->load->database();
	}
	public function get_details($id)
	//called by receipts/rprint
{
	$sql=$this->db->select('series, sub_series, no, date, name, address, city_pin, pan, amount, purpose, mode_payment, ch_no, tr_date, pmt_details' );
	$sql=$this->db->from('receipts');
	$sql=$this->db->where('id',"$id");
	$sql=$this->db->get();
	return $sql->row_array();
	
}



	public function get_max_no($series,$series1)
	//called by receipts/radd
	{
	$sql=$this->db->select_max('no');
	$sql=$this->db->from('receipts');
	$sql=$this->db->where('series', $series);
	$sql=$this->db->where('sub_series', $series1);
	$sql=$this->db->get();
	return $sql->row_array();
	
	}
	
	
	public function adddata($data)
	//called by receipts/radd
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
