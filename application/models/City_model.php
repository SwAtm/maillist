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
	
	public function get_name_indian(){
		//called by mlist/mlistadd
		$sql = $this->db->query('SELECT `name` FROM `city` WHERE not exists (select * from country where country.name = city.name)');
		$result= $sql->result_array();
		foreach ($result as $res):
		$result1[]=$res['name'];
		endforeach;
		//$result2=array_combine($result1,$result1);
		return $result1;
	
}



	public function get_name_non_indian(){
		//called by mlist/mlistadd
		$sql = $this->db->query('SELECT `name` FROM `city` WHERE exists (select * from country where country.name = city.name)');
		$result= $sql->result_array();
		foreach ($result as $res):
		$result1[]=$res['name'];
		endforeach;
		//$result2=array_combine($result1,$result1);
		return $result1;
	
}
	
	/*
	public function get_id_from_name($name){
		//called by mlist/mlistadd
	$sql=$this->db->select('id');
	$sql=$this->db->from('city');
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
		//called by mlist/mlistadd??
	$sql=$this->db->select('*');
	$sql=$this->db->from('city');
	$sql=$this->db->where('name',$str);
	$num=$sql->count_all_results();
	if ($num and $num>0):
	return true;
	else:
	return false;
	endif;
	
	}

	public function add($city){
		//called by mlist/mlistadd??
		$this->db->insert('city',$city);
		//return true;
	
	}

}
?>
	
