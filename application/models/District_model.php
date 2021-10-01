<?php
class District_model extends CI_Model{
	public function __construct()
		{		
		$this->load->database();
	}
	public function list_all()
	//called by mlist/list_admin
{
	$sql=$this->db->select('name');
	$sql=$this->db->from('district');
	$sql=$this->db->get();
	$result= $sql->result_array();
	if ($result):
	foreach ($result as $res):
	$result1[]=$res['name'];
	endforeach;
	$result2=array_combine($result1,$result1);
	return $result2;
	else:
	return false;
	endif;
}

	public function get_details($id)
	//called by district/delete_check
	{
	$sql=$this->db->select('name');
	$sql=$this->db->from('district');
	$sql=$this->db->where('id',$id);
	$sql=$this->db->get();
	$result= $sql->row();
	return $result->name;
	}
/*
	public function get_id_from_name($name){
		//called by mlist/mlistadd
	$sql=$this->db->select('id');
	$sql=$this->db->from('district');
	$sql=$this->db->where('name',$name);
	$sql=$this->db->get();
	$result= $sql->row();
	if ($result and $result->num_rows()!=0):
	return $result->id;	
	else:
	return false;
	endif;
}
*/

	public function findname($str){
		//called by mlist/mlistadd
	$sql=$this->db->select('*');
	$sql=$this->db->from('district');
	$sql=$this->db->where('name',$str);
	$num=$sql->count_all_results();
	if ($num and $num>0):
	return true;
	else:
	return false;
	endif;
	
	}
	public function add($dist){
		//called by mlist/mlistadd
		$this->db->insert('district',$dist);
		//return true;
	
	}
}
?>
	
