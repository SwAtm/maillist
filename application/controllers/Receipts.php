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
			 ->columns('id','series','sub_series', 'no', 'name', 'address', 'amount', 'purpose','mode_payment')
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
			 ->unset_edit()
			 ->order_by('id','desc')
			 ->callback_column('address',array($this,'_callback_reduce_width'))
			 ->callback_column('name',array($this,'_callback_reduce_width'))
			 ->callback_column('name',array($this,'_callback_change_color'))
			 ->add_action('Print',base_url(IMGPATH.'print.png'),'receipts/rprint')
			 ->add_action('Delete',base_url(IMGPATH.'delete.jpeg'),'receipts/rdelete_confirm');
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
	$det['id']=$id;
	if ($det['deleted']=='Y'):
	$data['noprint']=$det;
	$this->load->view('templates/header');
	$this->load->view('receipts/noprint',$data);
	$this->load->view('templates/footer');
	else:
		if($det['tr_date']==NULL):
			$det['tr_date']='';
		else:
			$det['tr_date']=date('d-m-Y',strtotime($det['tr_date']));
		endif;
	$data['det']=$det;
	$this->load->view('receipts/rprint',$data);
	//$this->load->view('templates/header');
	//$this->output->append_output("Receipt saved at ".SAVEPATH."<a href=".site_url('login/home')."> Go Home</a>");
	//redirect ('login/home');
	endif;
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
		$data['donor']['city_pin']=($donor['city']).($donor['pin']=NULL?'':' - '.$donor['pin']);
		$data['donor']['pan']=$donor['pan'];
		$data['donor']['phone']=$donor['phone1'];
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
		
		
	public function _callback_reduce_width($value, $row)
	{
	return substr($value,0,30);
	
	}
	
	public function _callback_change_color($value, $row)
	{
	$det=$this->Receipts_model->get_details($row->id);
	if ("Y"==$det['deleted']):
	return '<span style="color:red">'.$value.'</span>';
	else:
	return $value;
	endif;
	}
	
	
	public function rdelete_confirm($id=null)
	{
	$det=$this->Receipts_model->get_details($id);	
	$data['det']=$det;
	$data['det']['id']=$id;
	$this->load->view('templates/header');
	$this->load->view('receipts/delete_confirm',$data);
	$this->load->view('templates/footer');	
	}
	
	public function rdelete($id=null)
	{
	$id=$_POST['id'];
	$affrows=$this->Receipts_model->rdelete($id);
	$this->load->view('templates/header');
	$this->output->append_output($affrows." row affected.<a href=".site_url('login/home').">Go Home</a>");
	$this->load->view('templates/footer');	
	
	}
	
	public function letter($id=null)
	{
	$det=$this->Receipts_model->get_details($id);	
	if($det['tr_date']==NULL):
		$det['tr_date']='';
	else:
		$det['tr_date']=date('d-m-Y',strtotime($det['tr_date']));
	endif;
	$data['det']=$det;
	$this->load->view('templates/header');
	$this->load->view('receipts/letter',$data);
	$this->load->view('templates/footer');
	
	echo "<a href=".site_url('login/home').">Home</a>";
	}
	
	public function letter_print()
	{
	$data['det']=$_POST;
	$this->load->view('receipts/letter_print',$data);
	}

	public function daily_cash_report($date=null)
	{
	$this->form_validation->set_rules('date','Date','required');	
	//unsubmitted or failed
	if ($this->form_validation->run()==false):
		$this->load->view('templates/header');
		$this->load->view('receipts/get_date');
		$this->load->view('templates/footer');
	else:
	//submitted OK
		$date=$_POST['date'];
		$this->load->view('templates/header');
		$this->output->append_output("<br>Total Cash Receitps for ".date('d-m-Y',strtotime($date))."<br><br>");
		if ($daydet=$this->Receipts_model->get_day_details($date)):
			$this->output->append_output("Receipt No. from: ".$daydet->minno." To: ".$daydet->maxno." = Rs. ".$daydet->amt."<br><br>");
		else:
			$this->output->append_output("No receipts");
		endif;
		$this->load->view('templates/footer');
	endif;
	
	}

	public function monthly_report()
	{
		$this->form_validation->set_rules('stdt','Starting Date','required');	
		$this->form_validation->set_rules('endt','Ending Date','required');	

		//unsubmitted/failed
		if ($this->form_validation->run()==false):
			$this->load->view('templates/header');
			$this->load->view('receipts/mreport_get_dates');
			$this->load->view('templates/footer');
		//OK	
		else:
			$stdt=$_POST['stdt'];
			$endt=$_POST['endt'];
			$mop1=$this->Pmode_model->list_all();
			$data['stdt']=$stdt;
			$data['endt']=$endt;
			foreach ($mop1 as $k=>$v):
			$mop[$v['name']]=$v['name'];
			endforeach;
			//$data['mop']=$mop;
			//$this->load->view('receipts/mreport',$data);
			
			foreach ($mop as $value) {
						$mreport[$value]['det']	= $this->Receipts_model->mreport($stdt, $endt, $value);
						$mreport[$value]['total']=$this->Receipts_model->mtotal($stdt, $endt, $value);
						}	
			//endforeach;				

			$data['stdt']=$stdt;
			$data['endt']=$endt;
			$data['report']=$mreport;
			$this->load->view('receipts/mreport',$data);
			
		endif;
	}

}
?>
