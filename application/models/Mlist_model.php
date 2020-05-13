<?php
class Mlist_model extends CI_Model{
	public function __construct()
		{		
		$this->load->database();
	}
	public function list_all()
	//called by mlist/check_length, misc/mlistcsv
{
	$sql=$this->db->select('*');
	$sql=$this->db->from('mlist');
	$sql=$this->db->get();
	return $sql->result_array();
}

	public function get_details($id)
	//called by receipts/radd
	{
	$sql=$this->db->select('*');
	$sql=$this->db->from('mlist');
	$sql=$this->db->where('id',$id);
	$sql=$this->db->get();
	return $sql->row_array();
	
	
	}

	public function getheader()
	//called by misc/mlistcsv
	{
	$fields=$this->db->list_fields('mlist');
	return $fields;
	}
	
	
	public function db_backup()
	//called by misc/backup
	{
	    $pref=array(
		'add_drop'=> TRUE,
		'add_insert'=>TRUE,
		'foreign_key_checks'=>FALSE);
		$backup = $this->dbutil->backup($pref);  
		//force_download("backup_".date('dmYHi'),$backup);
		write_file(SAVEPATH.date('dmYHi').".zip", $backup);
		
	}
	
	public function getblore()
	//called by mlist/labels_blore
	{
		$sql=$this->db->select ('id, hon , name, add1, add2, add3, add4, city, pin');
		$sql=$this->db->from('mlist');
		$sql=$this->db->where('city','BANGALORE');
		$sql=$this->db->where('deleted','N');
		$sql=$this->db->where('send','Y');
		$sql=$this->db->get();
		return $sql->result_array();
	}
	
	
	public function getbgm()
	//called by mlist/labels_bgm
	{
		$sql=$this->db->select ('id, hon , name, add1, add2, add3, add4, city, pin');
		$sql=$this->db->from('mlist');
		$sql=$this->db->where('city','BELGAUM');
		$sql=$this->db->where('deleted','N');
		$sql=$this->db->where('send','Y');
		$sql=$this->db->get();
		return $sql->result_array();
	}
	
	
}
?>
	
