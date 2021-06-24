<?php
class City_model extends CI_Model{
	public function __construct()
		{		
		$this->load->database();
	}
	public function list_all()
	//called by mlist/list_admin, mlist/mlistadd
{
	$sql=$this->db->select('name');
	$sql=$this->db->from('city');
	$sql=$this->db->get();
	$result= $sql->result_array();
	foreach ($result as $res):
	$result1[]=$res['name'];
	endforeach;
	$result2=array_combine($result1,$result1);
	return $result2;
}

	public function get_details($id)
	//called by city/delete_check
	{
	$sql=$this->db->select('name');
	$sql=$this->db->from('city');
	$sql=$this->db->where('id',$id);
	$sql=$this->db->get();
	$result= $sql->row();
	return $result->name;
	}
}
?>
	
