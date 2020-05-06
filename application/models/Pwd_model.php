<?php
class pwd_model extends CI_Model{
	public function __construct()
		{		
		$this->load->database();
	}
	public function get_pwd()
	//called by login/verify
{
	$sql=$this->db->select('*');
	$sql=$this->db->from('pwd');
	$sql=$this->db->where('user',"admin");
	$sql=$this->db->get();
	if ($sql && $sql->num_rows()>0):
	return $sql->row_array();
	else:
	return false;
	endif;
}
}
?>
