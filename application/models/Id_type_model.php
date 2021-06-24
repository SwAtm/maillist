<?php
class Id_type_model extends CI_Model{
	public function __construct()
		{		
		$this->load->database();
	}
	public function list_all()
	//called by mlist/list_admin, mlist/mlistadd
{
	$sql=$this->db->select('name');
	$sql=$this->db->from('id_type');
	$sql=$this->db->get();
	$result= $sql->result_array();
	foreach ($result as $res):
	$result1[]=$res['name'];
	endforeach;
	$result2=array_combine($result1,$result1);
	return $result2;
}

	public function get_code_from_name($name){
	//called by mlist/toupper
	$sql = $this->db->select('code');
	$sql = $this->db->from('id_type');
	$sql = $this->db->where('name',$name);
	$sql = $this->db->get();
	$result = $sql->row();
	$idcode = $result->code;
	return $idcode;
	}
}
?>
	
