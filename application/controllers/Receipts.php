<?php
class Receipts extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->load->library('session');
		//$this->output->enable_profiler(TRUE);
		$this->load->model('Receipts_model');
		$this->load->model('Mlist_model');
		$this->load->model('Daccount_model');
		$this->load->model('Pmode_model');
		$this->load->helper('pdf_helper');
		$this->load->library('Ntw');
		$this->load->helper('form');
}

	public function rlist()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('receipts')
		     ->set_subject('Receipt')
			 ->columns('series','sub_series', 'no', 'name', 'address', 'amount', 'purpose','mode_payment')
			 ->display_as('id','Receipt Id')
			 ->display_as('series','Series')
			 ->display_as('sub_series','Sub_Series')
			 ->display_as('no','Receipt No')
			 ->display_as('name',"Donor's name")
			 ->display_as('address','Address')
			 ->display_as('amount','Amount')
			 ->display_as('purpose','Purpose')
			 ->display_as('mode_payment', 'Mode of Payment')
			 ->unset_add()
			 ->unset_delete()
			 ->order_by('id','desc')
			 //->callback_column('pmt_details',array($this,'_callback_reduce_width'))
			 ->callback_column('address',array($this,'_callback_reduce_width'))
			 ->callback_column('name',array($this,'_callback_reduce_width'))
			 //->add_action('Print',base_url('application/print.png'),'receipts/rprint');
			 ->add_action('Print',base_url(IMGPATH.'print.png'),'receipts/rprint');
			 //->add_action('Print',base_url('application/print.png'),'', '',array($this, 'url_callback_rprint'));
				$crud->field_type('id', 'readonly');
				$crud->field_type('series', 'readonly');
				$crud->field_type('no', 'readonly');
			//$operation=$crud->getState();
			//if($operation == 'edit' || $operation == 'update' || $operation == 'update_validation'):
			
			//endif;
			$output = $crud->render();
			$this->_example_output($output);                
	}



	function _example_output($output = null)
	{
		$this->load->view('templates/header');
		$this->load->view('our_template.php',$output);    
		$this->load->view('templates/footer');
	}    
	/*
	public function toupper($post_array)
	{
	foreach ($post_array as $k=>$v):
	$post_array[$k]=ucwords($v);
	endforeach;
	return $post_array;
	}
*/

	public function rprint($id){
	$det=$this->Receipts_model->get_details($id);
	if($det['tr_date']==NULL):
		$det['tr_date']='';
	else:
		$det['tr_date']=date('d-m-Y',strtotime($det['tr_date']));
	endif;
	$data['det']=$det;
	$this->load->view('receipts/rprint',$data);
	$this->load->view('templates/header');
	$this->output->append_output("Receipt saved at ".SAVEPATH."<a href=".site_url('login/home')."> Go Home</a>");
	//redirect ('login/home');
	}

	public function radd($id=null){
	$this->form_validation->set_rules('amount', 'Amount', 'greater_than[0]');
	$this->form_validation->set_rules('mode_payment','Mode of Payment','required');
	//not submitted
	if ($this->form_validation->run()==false and empty($_POST)) :
		$donor=$this->Mlist_model->get_details($id);
		$purpose1=$this->Daccount_model->list_all();
		//remove indexes from array
		foreach ($purpose1 as $k=>$v):
			$purpose[$v['name']]=$v['name'];
		endforeach;
	
		$mop1=$this->Pmode_model->list_all();
		//remove indexes from array
		foreach ($mop1 as $k=>$v):
			$mop[$v['name']]=$v['name'];
		endforeach;
		$mop=array(''=>'Select Mode of Payment')+$mop;
		$data['donor']['id']=$id;
		$data['donor']['name']=$donor['hon'].' '.$donor['name'];
		$data['donor']['address']=$donor['add1'].($donor['add2']!==''?', '.$donor['add2']:'').($donor['add3']!==''?', '.$donor['add3']:''). ($donor['add4']!==''?', '.$donor['add4']:'');
		$data['donor']['city_pin']=($donor['city']==''?'PIN ':$donor['city']).($donor['pin']=NULL?'':': '.$donor['pin']);
		$data['donor']['pan']=$donor['pan'];
		$data['amount']='';
		$data['purpose']=$purpose;
		$data['mop']=$mop;
		$data['ch_no']='';
		$data['tr_date']=Date('d-m-Y');
		$data['pmt_details']='';		
		$this->load->view('templates/header');
		$this->load->view('receipts/radd',$data);	
		$this->load->view('templates/footer');
	
	//submitted failed vlidation
	elseif($this->form_validation->run()==false and !empty($_POST)):
		//print_r($_POST);
		//echo "Post not empty";
		$id=$_POST['id'];
		unset($_POST);
		$_POST=array();
		$this->radd ($id);
		
	
	// submitted OK
	else:
		
		unset($_POST['id']);
		$mop=$_POST['mode_payment'];
		if ($mop=="Cash"):
			$series1="Cash";
		elseif ($mop=="Cheque"):
			$series1="Cheque";
		else:
			$series1="Bank";
		endif;
		if ($_POST['tr_date']==''):
			$_POST['tr_date']=null;
		endif;
		$series="Office";
		$rno=$this->Receipts_model->get_max_no($series, $series1);
		$rno=++$rno['no'];
		$_POST['series']=$series;
		$_POST['sub_series']=$series1;
		$_POST['no']=$rno;
		$_POST['date']=date("Y-m-d");
		
		unset($_POST['submit']);
		if ($this->Receipts_model->adddata($_POST)):
			$rid1=$this->Receipts_model->getmaxid();
			$rid=$rid1['id'];
			$this->rprint($rid);
			
		else:
			Die("Something Wrong <a href=".site_url('login/home').">Go Home</a>");
		endif;
		
	
	endif;
	
}	
		public function radd1(){
		$this->form_validation->set_rules('amount', 'Amount', 'greater_than[0]');
		if ($this->form_validation->run()==false):
			unset($_POST['submit']);
			$data[$donor]['name']=$_POST['name'];
			$data[$donor]['address']=$_POST['address'];
			$this->load->view('templates/header');
			$this->load->view('receipts/radd',$_POST);	
			print_r($_POST);
			$this->load->view('templates/footer');
		else:
			$rno=$this->Receipts_model->get_max_no();
			$rno=++$rno['no'];
			$_POST['series']='Office';
			$_POST['no']=$rno;
			$_POST['date']=date("Y-m-d");
			unset($_POST['submit']);
		//print_r($_POST);
			if ($this->Receipts_model->adddata($_POST)):
				$rid1=$this->Receipts_model->getmaxid();
				$rid=$rid1['id'];
				$this->rprint($rid);
				$this->load->view('templates/header');
				echo "<a href=".site_url('login/home').">Go Home</a><br>";
			else:
				Die("Something Wrong <a href=".site_url('login/home').">Go Home</a>");
			endif;
		//echo "<a href=".site_url('login/home').">Go Home</a>";
		endif;
		}
		
	public function _callback_reduce_width($value, $row)
	{
	return substr($value,0,30);
	
	}

}
?>
