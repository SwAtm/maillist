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
	//called by receipts/radd, mlist/_callback_change_color
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
		$sql=$this->db->order_by('name','ASC');
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
		$sql=$this->db->order_by('name','ASC');
		$sql=$this->db->get();
		return $sql->result_array();
	}
	
	
		public function getbgm_dist()
		//called by mlist/labels_bgm_dist
	{
		$sql=$this->db->select ('id, hon , name, add1, add2, add3, add4, city, pin');
		$sql=$this->db->from('mlist');
		$sql=$this->db->where('dist','BELGAUM');
		$sql=$this->db->where('deleted','N');
		$sql=$this->db->where('send','Y');
		$sql=$this->db->order_by('name','ASC');
		$sql=$this->db->get();
		return $sql->result_array();
	}
	
		public function getkar()
		//called by mlist/labels_kar
	{
		$sql=$this->db->select ('id, hon , name, add1, add2, add3, add4, city, pin');
		$sql=$this->db->from('mlist');
		$sql=$this->db->where('state','KARNATAKA');
		$sql=$this->db->where('deleted','N');
		$sql=$this->db->where('send','Y');
		$sql=$this->db->order_by('name','ASC');
		$sql=$this->db->get();
		return $sql->result_array();
	}
	
		public function getindia()
		//called by mlist/labels_ind
	{
		$sql=$this->db->select ('id, hon , name, add1, add2, add3, add4, city, pin');
		$sql=$this->db->from('mlist');
		$sql=$this->db->where('country','INDIA');
		$sql=$this->db->where('deleted','N');
		$sql=$this->db->where('send','Y');
		$sql=$this->db->order_by('name','ASC');
		$sql=$this->db->get();
		return $sql->result_array();
	}

		public function used_or_not($city)
		//called by city/delete_check
		{
		$sql=$this->db->select ('name');
		$sql=$this->db->from('mlist');
		$sql=$this->db->where('city',$city);
		$sql=$this->db->get();
		//$result= $sql->result();
		if ($sql && $sql->num_rows()>0):
		return true;
		else:
		return false;
		endif;	
		}

		public function used_or_not_d($dist)
		//called by district/delete_check
		{
		$sql=$this->db->select ('name');
		$sql=$this->db->from('mlist');
		$sql=$this->db->where('dist',$dist);
		$sql=$this->db->get();
		//$result= $sql->result();
		if ($sql && $sql->num_rows()>0):
		return true;
		else:
		return false;
		endif;	
		}
		
		
		public function used_or_not_s($state)
		//called by state/delete_check
		{
		$sql=$this->db->select ('name');
		$sql=$this->db->from('mlist');
		$sql=$this->db->where('state',$state);
		$sql=$this->db->get();
		//$result= $sql->result();
		if ($sql && $sql->num_rows()>0):
		return true;
		else:
		return false;
		endif;	
		}
		
		public function used_or_not_c($country)
		//called by country/delete_check
		{
		$sql=$this->db->select ('name');
		$sql=$this->db->from('mlist');
		$sql=$this->db->where('country',$country);
		$sql=$this->db->get();
		//$result= $sql->result();
		if ($sql && $sql->num_rows()>0):
		return true;
		else:
		return false;
		endif;	
		}
		
		
}


?>
	
