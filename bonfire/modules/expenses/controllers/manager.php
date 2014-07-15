<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Bonfire
 *
 * An open source project to allow developers get a jumpstart their development of CodeIgniter applications
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2012, Bonfire Dev Team
 * @license   http://guides.cibonfire.com/license.html
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Database Tools controller
 *
 * Various tools to manage the Database tables.
 *
 * @package    Bonfire
 * @subpackage Modules_Database
 * @category   Controllers
 * @author     Bonfire Dev Team
 * @link       http://guides.cibonfire.com/helpers/file_helpers.html
 *
 */
class Manager extends Authenticated_Controller
{
	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		if (!class_exists('Expense_model'))
		{
			$this->load->model('Expense_model', 'expense_model');
		}
		

	}//end __construct()

	
	public function index()
	{
		$expenses = $this->expense_model->get_for_all();
		Template::set('expenses',$expenses);
		Template::render();

	}//end index()
	
	public function insert()
	{
		if(has_permission('App.Expenses.Add')){
			$expense = array(
				'stringer_name' => null
			);
			$expense = $this->expense_model->insert($expense);
			Template::set('response',$expense);
			Template::set_view('response.php');
			Template::render();
		}

	}//end index()
	
	public function update()
	{
    	
		// TODO : MOVE BELOW CODE TO MODEL OF FILTERING REQUEST.
		// OPTIMIZE THIS CODE FOR SPEED AND SECURITY AND VALIDATION
		$arr =  $_GET;
		$data =  array();
		
		if(isset($arr['stringer_name'])){
			
			$data['stringer_name'] = $arr['stringer_name'];
			$this->form_validation->set_rules('stringer_name', 'Stringer name', 'required|trim|xss_clean');
		}
		
		if(isset($arr['costs'])){
			$data['costs'] = $arr['costs'];
			$this->form_validation->set_rules('stringer_name', 'Costs', 'required|trim|is_numeric|xss_clean');
		}
		
		
		if(isset($arr['expense_date'])){
			$data['expense_date'] = $arr['expense_date'];
			$this->form_validation->set_rules('stringer_name', 'Expense date', 'required|trim|date|xss_clean');
		}
		
		if(has_permission('App.Expenses.PaidDate')){
			if(isset($arr['paid_date'])){
				$data['paid_date'] = $arr['paid_date'];
				$this->form_validation->set_rules('paid_date','Paid date', 'required|trim|date|xss_clean');
			}
		}
		
		
		if(isset($arr['description'])){
			$data['description'] = $arr['description'];
			$this->form_validation->set_rules('description', 'Description', 'trim|alpha_numeric|xss_clean');
		}
		if(isset($arr['released_from_received'])){
			$data['released_from_received'] = $arr['released_from_received'];
			$this->form_validation->set_rules('released_from_received', 'Stringer name', 'trim|alpha_numeric|xss_clean');
		}
		
    		 
		if ($this->form_validation->run() !== false){
    		$this->expense_model->update($arr['id'],$data);
			Template::set('response','sucessfully saved');
    	}else{
    		echo $this->form_validation->error_string();
    		Template::set('response',$this->form_validation->error_string());
    	}
		var_dump($this->form_validation->run());
		Template::set_view('response.php');
		Template::render();

	}//end index()
	
	public function delete($id = false)
	{
		if(has_permission('App.Expenses.Delete')){
			if($id){
				//TODO : VALIDATE REQUEST AND ID. GIVE PROPER RESPONSE TO REQUEST.
				$this->expense_model->delete($id);
				Template::set('expenses','TRUE');
				Template::set_view('response.php');
				Template::render('ajax');
			}
		}

	}//end index()
}//end class
