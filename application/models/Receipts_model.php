<?php
class receipts_model extends CI_Model{
	public function __construct()
		{		
		$this->load->database();
	}
	public function get_details($id)
	//called by receipts/rprint, receipts/rdelete_confirm, receipts/_callback_change_color, receipts/letter
{
	$sql=$this->db->select('series, no, date, name, address, city_pin, phone, id_name, id_no, section_code, amount, purpose, mode_payment, ch_no, tr_date, pmt_details, deleted, panname' );
	$sql=$this->db->from('receipts');
	$sql=$this->db->where('id',"$id");
	$sql=$this->db->get();
	return $sql->row_array();
	
}



	public function get_max_no($series)
	//called by receipts/radd, receipts/add_receipt_woid, receipts/add_receipt_wid_donor_notfound, receipts/add_receipt_wid_donor_found
	{
	$sql=$this->db->select_max('no');
	$sql=$this->db->from('receipts');
	$sql=$this->db->where('series', $series);
	//$sql=$this->db->where('sub_series', $series1);
	$sql=$this->db->get();
	return $sql->row_array();
	
	}
	
	
	public function adddata($data)
	//called by receipts/radd, receipts/add_receipt_woid, receipts/add_receipt_wid_donor_notfound, receipts/add_receipt_wid_donor_found
	{
	if($this->db->insert('receipts', $data)):
	return true;
	else:
	return false;
	endif;
	}



	public function getmaxid()
	//called by receipts/radd, receipts/add_receipt_woid, receipts/add_receipt_wid_donor_notfound, receipts/add_receipt_wid_donor_found
	{
	$sql=$this->db->select_max('id');
	$sql=$this->db->get('receipts');
	return $sql->row_array();
	}
	
	public function rdelete($id)
	//called by receipts/rdelete
	{
	$sql=$this->db->set('deleted','Y');
	$sql=$this->db->where('id',$id);
	$sql=$this->db->update('receipts');
	$done=$this->db->affected_rows();
	return $done;	
	}
	
	public function get_day_details($date, $user)
	//called by receipts/daily_cash_report
	{
	/*$sql="select min(no) as minno, max(no) as maxno, sum(amount) as amt from 
	receipts join series on receipts.series=series.series
	where date=? and receipts.mode_payment=Cash and series.user=$this->session->logged"; */
	$sql=$this->db->select_min('no', 'minno');
	$sql=$this->db->select_max('no', 'maxno');
	$sql=$this->db->select_sum('amount', 'amt');
	$sql=$this->db->where('date',$date);
	$sql=$this->db->where('mode_payment','Cash');
	$sql=$this->db->where('deleted', 'N');
	$sql=$this->db->where('user', $user);
	$sql=$this->db->get('receipts');
	$result=$sql->row();
	if($result->minno!==null):
	return $result;
	else:
	return false;
	endif;
	}

	public function mreport($stdt, $endt, $mop, $user)
	//called by receipts/monthly_report, receipts/report_ex
	{
		/*
		$sql="select * from receipts join series on receipts.series=series.series where
		receipts.date>=? and receipts.date<=? and receipts.mode_payment=? and receipts.deleted='N' and series.user=$user";*/
		
		$sql=$this->db->select('*');
		$sql=$this->db->where('date>=', $stdt);
		$sql=$this->db->where('date<=', $endt);
		$sql=$this->db->where('mode_payment', $mop);
		$sql=$this->db->where('deleted', 'N');
		$sql=$this->db->where('user', $user);
		$sql=$this->db->get('receipts');
		$result=$sql->result_array();
		//$result=$this->db->query($sql, array($stdt, $endt, $mop))->result_array();
		return $result;

	}

	public function mtotal ($stdt, $endt, $mop, $user)
	//called by receipts/monthly_report
		{
		/*
		$sql="select sum(amount) from receipts join series on receipts.series=series.series where
		receipts.date>=? and receipts.date<=? and receipts.mode_payment=? and receipts.deleted='N' and series.user=$user";*/
		
		$sql=$this->db->select_sum('amount');
		$sql=$this->db->where('date>=', $stdt);
		$sql=$this->db->where('date<=', $endt);
		$sql=$this->db->where('mode_payment', $mop);
		$sql=$this->db->where('deleted', 'N');
		$sql=$this->db->where('user', $user);
		$sql=$this->db->get('receipts');
		$result=$sql->row_array();
		//$result=$this->db->query($sql, array($stdt, $endt, $mop))->row_array();
		$result=$result['amount'];
		return $result;
	}

	public function rreport($stdt, $endt)
	//called by receipts/receipt_report
	{
		$sql=$this->db->select('*');
		$sql=$this->db->where('date>=', $stdt);
		$sql=$this->db->where('date<=', $endt);
		$sql=$this->db->where('deleted', 'N');
		$sql=$this->db->like('purpose', 'Donation');
		$sql=$this->db->get('receipts');
		$result=$sql->result_array();
		return $result;

	}

		public function mreport_subsr($stdt, $endt, $subsr){
		//called by receipts/report_ex
		$sql=$this->db->select('*');
		$sql=$this->db->where('date>=', $stdt);
		$sql=$this->db->where('date<=', $endt);
		$sql=$this->db->where('sub_series', $subsr);
		$sql=$this->db->where('deleted', 'N');
		$sql=$this->db->get('receipts');
		$result=$sql->result_array();
		return $result;
		}
		
		public function mtotal_subsr ($stdt, $endt, $subsr)
		//called by receipts/report_ex
	{
		$sql=$this->db->select_sum('amount');
		$sql=$this->db->where('date>=', $stdt);
		$sql=$this->db->where('date<=', $endt);
		$sql=$this->db->where('sub_series', $subsr);
		$sql=$this->db->where('deleted', 'N');
		$sql=$this->db->get('receipts');
		$result=$sql->row_array();
		$result=$result['amount'];
		return $result;
	}
	
			public function xreport_purpose($stdt, $endt)
		//called by receipts/xml_report
	{
		$sql=$this->db->distinct();
		$sql=$this->db->select('purpose');
		$sql=$this->db->where('date>=', $stdt);
		$sql=$this->db->where('date<=', $endt);
		$sql=$this->db->where('deleted', 'N');
		$sql=$this->db->get('receipts');
		$result=$sql->result_array();
		return $result;

	}
	
		public function xreport_mop($stdt, $endt)
		//called by receipts/xml_report
	{
		$sql=$this->db->distinct();
		$sql=$this->db->select('mode_payment');
		$sql=$this->db->where('date>=', $stdt);
		$sql=$this->db->where('date<=', $endt);
		$sql=$this->db->where('deleted', 'N');
		$sql=$this->db->get('receipts');
		$result=$sql->result_array();
		return $result;

	}
	
		public function xreport($stdt, $endt)
	//called by receipts/xml_report
	{
		$sql=$this->db->select('*');
		$sql=$this->db->where('date>=', $stdt);
		$sql=$this->db->where('date<=', $endt);
		$sql=$this->db->where('deleted', 'N');
		//$sql=$this->db->like('purpose', 'Donation');
		$sql=$this->db->get('receipts');
		$result=$sql->result_array();
		return $result;

	}
/*
	public function arrayToXml($array, $rootElement = null, $xml = null) {
		$_xml = $xml;
	
			// If there is no Root Element then insert root
			if ($_xml === null) {
				$_xml = new SimpleXMLElement($rootElement !== null ? $rootElement : '<root/>');
			}
			
			// Visit all key value pair
			foreach ($array as $k => $v) {
				
				// If there is nested array then
				if (is_array($v)) { 
					
					// Call function for nested array
					$this->arrayToXml($v, $k, $_xml->addChild($k));
					}
					
				else {
					
					// Simply add child element. 
					$_xml->addChild($k, $v);
				}
			}
			
			//return $_xml->asXML();
			$_xml->saveXML('/home/freak/tally.xml');
		}
	
	*/
}
?>
