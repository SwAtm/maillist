<?php
 header('Access-Control-Allow-Origin: *');  
//require(APPPATH.'/libraries/RestController.php');
use APPPATH.'/libraries/RestController.php'
class Mlistdata extends RestController{
	public function __construct()
{
	parent::__construct();
		$this->load->database();
		$this->load->model('city_model');
	}

public function country_get(){
		
        $country = $this->get('country'):
        //$mess = array('error'=>'well done');
        //endif;
        
        /*if ($country == 'INDIA'):
		
        $city = $this->city_model->get_india();
        else
        $city = $this->city_model->list_all();
        endif;*/
        $this->response($country, 200); // 200 being the HTTP response code
        //$this->response($mess, 200);
    }


}



?>

