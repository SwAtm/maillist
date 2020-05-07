<?php
class Misc extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		//$this->output->enable_profiler(TRUE);
		$this->load->library('session');
		$this->load->model('mlist_model');
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');
}

	public function mlistcsv()
	{
	$mlist=$this->mlist_model->list_all();
	$mlisthead=$this->mlist_model->getheader();
	$mlisthead=array_values($mlisthead);
	//print_r($mlisthead);
	$dt=date('d-m-Y-H-i');
	$filename="maillist_".$dt;
	$fp = fopen(SAVEPATH.$filename, 'w');
	fputcsv($fp, array_values($mlisthead)); 
	foreach ($mlist as $data):
		fputcsv($fp, $data);
	endforeach;
	fclose($fp);
	
	$this->load->view('templates/header');
	$this->output->append_output("File ".$filename. " Saved at ".SAVEPATH."<a href=".site_url('login/home')."> GO HOme</a>");
	}

	public function backup()
	{
		$this->mlist_model->db_backup();
		$this->load->view('templates/header');
		$this->output->append_output("Backup taken at ".SAVEPATH."<a href=".site_url('login/home')."> Home</a>");
		
	}

}

?>
