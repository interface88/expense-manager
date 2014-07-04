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
class Expenses extends Front_Controller
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
			$this->load->model('expenses/Expense_model', 'expense_model');
		}
		

	}//end __construct()

	
	public function index()
	{
		$expenses = $this->expense_model->get_for_all();
		Template::set('expenses',$expenses);
		Template::render();

	}//end index()
	
	public function data_list()
	{
		$offset = $this->input->get('iDisplayStart') ?  $this->input->get('iDisplayStart') : 0;
		$limit = $this->input->get('iDisplayLength') ?  $this->input->get('iDisplayLength') : 10;
		
		
		// -------------- search code block ------------- 
		/**
		 * HERE WE ARE SEARCHING ON stringer AND description. But we can add more paramter in future
		 */
		$search_term =  $this->input->get('sSearch');
		$expenses = $this->expense_model->search($search_term, $limit , $offset);
		$no_of_expenses = $this->expense_model->count_search_result($search_term);
		
		 
		// -------------- end search code block -------------
		
		// ------ preparing data for datatable
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $no_of_expenses,
			"iTotalDisplayRecords" => $limit,
			"aaData" => array()
		);
		
		if($expenses){
			foreach ($expenses as $expense) {
				$row = array();
				$row[] = $expense->expense_date;
				$row[] = $expense->stringer_name;
				$row[] = $expense->costs;
				$row[] = $expense->description;
				$row[] = $expense->released_from_received;
				$row[] = $expense->paid_date;
				$output['aaData'][] = $row;
			}
		}
		
		
		 echo json_encode( $output );
	}//end index()
	
	
	
}//end class
