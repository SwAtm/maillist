<?php
class Token_model extends CI_Model{
	public function __construct()
		{		
		$this->load->database();
	}
	
	public function getall(){
	//called by mlist/mlistaddpan, receipts/getpanname, mlist/getid
	$sql=$this->db->select('*');
	$sql=$this->db->from('token');
	$sql=$this->db->get();
	$result= $sql->row_array();
	return $result;
}

	public function updatetoken($tokenupdate){
	//called by mlist/mlistaddpan, receipt/getpanname, mlist/getid
	$this->db->update('token',$tokenupdate);	
}
	}


?>
	
